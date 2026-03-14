#!/bin/bash
# Laravel Multi-Project Server Deployment Helper
# Run this on the server to manage deployments across multiple ports

set -e

# Configuration
START_PORT=${1:-8000}
END_PORT=${2:-8100}
APP_NAME=${3:-mycrip}
GIT_REPO=${4:-}

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

# Function to find available port
find_available_port() {
    local start=$1
    local end=$2
    
    log_info "Scanning for available ports between $start and $end..."
    
    for port in $(seq $start $end); do
        # Check if port is in use
        if ! netstat -tuln 2>/dev/null | grep -q ":$port " && ! ss -tuln 2>/dev/null | grep -q ":$port "; then
            echo $port
            return 0
        fi
    done
    
    echo "0"
    return 1
}

# Function to setup Laravel application
setup_laravel_app() {
    local deploy_path=$1
    local port=$2
    local git_repo=$3
    
    log_info "Setting up Laravel application in $deploy_path"
    
    # Create directory
    mkdir -p "$deploy_path"
    cd "$deploy_path"
    
    # Clone or pull repository
    if [ -d ".git" ]; then
        log_info "Repository exists, pulling latest changes..."
        git pull origin main 2>/dev/null || git pull origin master 2>/dev/null || true
    elif [ -n "$git_repo" ]; then
        log_info "Cloning repository from $git_repo"
        git clone "$git_repo" .
    else
        log_error "No repository found and no git URL provided"
        return 1
    fi
    
    # Copy env file
    if [ ! -f ".env" ]; then
        if [ -f ".env.example" ]; then
            cp .env.example .env
            log_info "Created .env from .env.example"
        else
            log_warning "No .env.example found, creating basic .env"
            echo "APP_NAME=$APP_NAME" > .env
            echo "APP_ENV=production" >> .env
        fi
    fi
    
    # Update APP_URL and APP_PORT in .env if they exist
    if grep -q "APP_URL=" .env; then
        sed -i "s|APP_URL=.*|APP_URL=http://0.0.0.0:$port|g" .env
    else
        echo "APP_URL=http://0.0.0.0:$port" >> .env
    fi
    
    # Install dependencies
    if [ -f "composer.json" ]; then
        log_info "Installing PHP dependencies..."
        composer install --no-interaction --no-dev --optimize-autoloader 2>/dev/null || true
    fi
    
    # Generate app key if needed
    if ! grep -q "APP_KEY=" .env || [ -z "$(grep APP_KEY .env | cut -d= -f2)" ]; then
        log_info "Generating Laravel app key..."
        php artisan key:generate --force
    fi
    
    # Create storage links
    log_info "Setting up storage..."
    chmod -R 775 storage bootstrap/cache 2>/dev/null || true
    php artisan storage:link 2>/dev/null || true
    
    # Run migrations
    log_info "Running database migrations..."
    php artisan migrate --force 2>/dev/null || log_warning "Migrations skipped"
    
    # Clear cache
    php artisan optimize:clear 2>/dev/null || true
    
    return 0
}

# Function to start Laravel development server
start_laravel_server() {
    local deploy_path=$1
    local port=$2
    local app_name=$3
    
    log_info "Starting Laravel server on port $port..."
    
    cd "$deploy_path"
    
    # Check if PM2 is installed
    if command -v pm2 &> /dev/null; then
        pm2 start "php artisan serve --host=0.0.0.0 --port=$port" \
            --name="${app_name}-${port}" \
            --log="/var/log/pm2/${app_name}-${port}.log" \
            2>/dev/null || true
        pm2 save
        log_success "Server started with PM2"
    else
        log_info "PM2 not found. Configure Supervisor for production use."
        log_info "For testing, you can run: php artisan serve --host=0.0.0.0 --port=$port"
    fi
}

# Main execution
log_info "=== Laravel Multi-Project Deployment Assistant ==="
log_info "App: $APP_NAME | Port Range: $START_PORT-$END_PORT"

# Find available port
AVAILABLE_PORT=$(find_available_port $START_PORT $END_PORT)

if [ "$AVAILABLE_PORT" = "0" ]; then
    log_error "No available ports found in range $START_PORT-$END_PORT"
    exit 1
fi

log_success "Found available port: $AVAILABLE_PORT"

# Setup deployment path
DEPLOY_PATH="/var/www/${APP_NAME}-${AVAILABLE_PORT}"

# Setup Laravel application
setup_laravel_app "$DEPLOY_PATH" "$AVAILABLE_PORT" "$GIT_REPO"

if [ $? -eq 0 ]; then
    log_success "Application setup completed successfully"
    
    # Start server
    start_laravel_server "$DEPLOY_PATH" "$AVAILABLE_PORT" "$APP_NAME"
    
    log_success "=== Deployment Complete ==="
    log_info "Application: $APP_NAME"
    log_info "Port: $AVAILABLE_PORT"
    log_info "Path: $DEPLOY_PATH"
    log_info "Access: http://0.0.0.0:$AVAILABLE_PORT"
else
    log_error "Application setup failed"
    exit 1
fi
