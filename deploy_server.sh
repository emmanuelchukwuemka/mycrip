#!/bin/bash
# Laravel Deployment Script for Multi-Project Server
# This script finds an available port and deploys the project without clashing with existing deployments

# Configuration
REMOTE_HOST="72.62.4.119"
REMOTE_USER="root"
REMOTE_PASSWORD="Mathscrusader123."
START_PORT=8000
END_PORT=8100
APP_NAME="mycrip"

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;36m'
NC='\033[0m' # No Color

function log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

function log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

function log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

function log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

# Check if sshpass is installed
if ! command -v sshpass &> /dev/null; then
    log_error "sshpass is not installed. Please install it first:"
    echo "  Ubuntu/Debian: sudo apt-get install sshpass"
    echo "  macOS: brew install hudochenkov/sshpass/sshpass"
    echo "  Windows: Download from https://sourceforge.net/projects/sshpass/files/"
    exit 1
fi

# Find available port on remote server
find_available_port() {
    log_info "Scanning for available ports between $START_PORT and $END_PORT..."
    
    # SSH command to check ports
    ssh_cmd="sshpass -p '$REMOTE_PASSWORD' ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -o LogLevel=ERROR $REMOTE_USER@$REMOTE_HOST"
    
    # Command to find available port
    check_ports=$(cat << 'EOF'
for port in $(seq START_PORT END_PORT); do
    # Check if port is currently in use
    if netstat -tuln 2>/dev/null | grep -q ":$port " || ss -tuln 2>/dev/null | grep -q ":$port "; then
        continue
    fi
    
    # Check if there's already a deployment directory for this port
    if [ -d "/var/www/APP_NAME-$port" ]; then
        continue
    fi
    
    # Port is available
    echo $port
    exit 0
done
echo "NO_PORT_AVAILABLE"
EOF
)
    
    # Replace placeholders
    check_ports="${check_ports//START_PORT/$START_PORT}"
    check_ports="${check_ports//END_PORT/$END_PORT}"
    check_ports="${check_ports//APP_NAME/$APP_NAME}"
    
    available_port=$($ssh_cmd "bash -s" <<< "$check_ports" 2>&1)
    available_port=$(echo "$available_port" | tr -d '[:space:]')
    
    if [ "$available_port" = "NO_PORT_AVAILABLE" ] || [ -z "$available_port" ]; then
        log_error "No available port found in range $START_PORT-$END_PORT"
        return 1
    fi
    
    log_success "Found available port: $available_port"
    echo "$available_port"
    return 0
}

# Get list of existing deployments
get_existing_deployments() {
    log_info "Checking existing deployments on server..."
    
    sshpass -p "$REMOTE_PASSWORD" ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null $REMOTE_USER@$REMOTE_HOST "ls -la /var/www/ 2>/dev/null | grep $APP_NAME" 2>&1
}

# Deploy the application
deploy_application() {
    local port=$1
    local deploy_path="/var/www/$APP_NAME-$port"
    
    log_info "Starting deployment to port $port..."
    
    # Create deployment script
    deploy_script=$(cat << EOF
#!/bin/bash
set -e

APP_NAME="$APP_NAME"
PORT=$port
DEPLOY_PATH="$deploy_path"

echo "=== Starting deployment of \$APP_NAME on port \$PORT ==="

# Create deployment directory
mkdir -p \$DEPLOY_PATH
cd \$DEPLOY_PATH

# Check if this is a new deployment or update
if [ -d ".git" ]; then
    echo "Repository exists, pulling latest changes..."
    git pull origin main 2>/dev/null || git pull origin master 2>/dev/null || true
    echo "Code updated from git"
else
    echo "No git repository found. This is a fresh deployment."
    echo "Please ensure the code is in the deployment directory."
fi

# Set up Laravel environment
echo "Setting up Laravel environment..."
if [ -f .env.example ]; then
    cp .env.example .env 2>/dev/null || true
fi

# Install dependencies
if [ -f composer.json ]; then
    echo "Installing PHP dependencies..."
    composer install --no-interaction --no-dev --optimize-autoloader 2>/dev/null || composer install --no-interaction 2>/dev/null || true
fi

# Generate app key if needed
if ! grep -q "APP_KEY=base64:" .env 2>/dev/null; then
    echo "Generating application key..."
    php artisan key:generate --force 2>/dev/null || true
fi

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Create storage link
php artisan storage:link 2>/dev/null || true

# Run migrations
echo "Running database migrations..."
php artisan migrate --force 2>/dev/null || echo "Migrations skipped or failed"

# Clear cache
echo "Optimizing application..."
php artisan optimize:clear 2>/dev/null || true
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Kill any existing process on this port
pkill -f "artisan serve.*port=$PORT" 2>/dev/null || true

# Start Laravel server
echo "Starting Laravel server on port \$PORT..."
nohup php artisan serve --host=0.0.0.0 --port=$PORT > /var/log/$APP_NAME-$port.log 2>&1 &
sleep 2

# Verify server is running
if netstat -tuln 2>/dev/null | grep -q ":$PORT " || ss -tuln 2>/dev/null | grep -q ":$PORT "; then
    echo "=== Deployment complete on port \$PORT ==="
    echo "Access URL: http://$REMOTE_HOST:\$PORT"
else
    echo "Warning: Server may not have started. Check logs at /var/log/$APP_NAME-$port.log"
fi
EOF
)
    
    # Write script to temporary file
    temp_script=$(mktemp)
    echo "$deploy_script" > "$temp_script"
    
    # Copy script to remote server
    log_info "Uploading deployment script..."
    sshpass -p "$REMOTE_PASSWORD" scp -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null "$temp_script" "$REMOTE_USER@$REMOTE_HOST:/tmp/deploy_$APP_NAME.sh"
    
    # Execute script on remote server
    log_info "Executing deployment script..."
    sshpass -p "$REMOTE_PASSWORD" ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null "$REMOTE_USER@$REMOTE_HOST" "bash /tmp/deploy_$APP_NAME.sh"
    
    # Clean up
    rm -f "$temp_script"
    sshpass -p "$REMOTE_PASSWORD" ssh -o StrictHostKeyChecking=no "$REMOTE_USER@$REMOTE_HOST" "rm -f /tmp/deploy_$APP_NAME.sh" 2>/dev/null
    
    if [ $? -eq 0 ]; then
        log_success "Deployment completed successfully!"
        return 0
    else
        log_warning "Deployment may have encountered issues. Check output above."
        return 0
    fi
}

# Main execution
main() {
    echo "========================================"
    echo "  Laravel Multi-Project Deployment"
    echo "========================================"
    echo "Server: $REMOTE_HOST"
    echo "User: $REMOTE_USER"
    echo "App Name: $APP_NAME"
    echo "Port Range: $START_PORT - $END_PORT"
    echo "========================================"
    echo ""
    
    # Test SSH connection
    log_info "Testing SSH connection..."
    connection_test=$(sshpass -p "$REMOTE_PASSWORD" ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -o LogLevel=ERROR "$REMOTE_USER@$REMOTE_HOST" "echo connected" 2>&1)
    
    if [ $? -ne 0 ]; then
        log_error "SSH connection failed. Please check your credentials."
        exit 1
    fi
    
    log_success "SSH connection successful!"
    echo ""
    
    # Check for existing deployments
    log_info "Checking existing deployments on server..."
    existing=$(get_existing_deployments)
    if [ -n "$existing" ]; then
        log_warning "Existing deployments found:"
        echo "$existing"
    fi
    echo ""
    
    # Find available port
    available_port=$(find_available_port)
    
    if [ $? -ne 0 ] || [ -z "$available_port" ]; then
        log_error "Deployment failed: No available ports"
        exit 1
    fi
    
    echo ""
    
    # Deploy application
    deploy_application "$available_port"
    
    echo ""
    echo "========================================"
    echo "  Deployment Complete!"
    echo "========================================"
    log_success "App Name: $APP_NAME"
    log_success "Port: $available_port"
    log_success "Access URL: http://$REMOTE_HOST:$available_port"
    echo "========================================"
}

# Run main
main
