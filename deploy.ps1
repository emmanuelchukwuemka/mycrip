# Laravel Deployment Script for Multi-Project Server
# This script deploys the Laravel project to an available port on the remote server

param(
    [string]$RemoteHost = "72.62.4.119",
    [string]$RemoteUser = "root",
    [string]$RemotePassword = "Mathscrusader123.",
    [int]$StartPort = 8000,
    [int]$EndPort = 8100,
    [string]$AppName = "mycrip",
    [string]$GitRepo = "" # Set this to your git repository URL if needed
)

# Colors for output
$Green = [ConsoleColor]::Green
$Red = [ConsoleColor]::Red
$Yellow = [ConsoleColor]::Yellow
$Blue = [ConsoleColor]::Cyan

function Write-Status {
    param([string]$Message, [ValidateSet("Info", "Success", "Error", "Warning")]$Type = "Info")
    $Color = switch ($Type) {
        "Success" { $Green }
        "Error" { $Red }
        "Warning" { $Yellow }
        default { $Blue }
    }
    Write-Host "[$Type] $Message" -ForegroundColor $Color
}

# Step 1: Find available port on remote server
Write-Status "Connecting to remote server..." "Info"
Write-Status "Finding available port between $StartPort and $EndPort..." "Info"

$SshCommand = @"
`#!/bin/bash
for port in {$StartPort..$EndPort}; do
  if ! netstat -tuln 2>/dev/null | grep -q :`$port || ! ss -tuln 2>/dev/null | grep -q :`$port; then
    echo `$port
    exit 0
  fi
done
echo "no_port_available"
`@

# Convert PowerShell secure string password to plain text for SSH
$BSTR = [System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($([Security.SecureString]::new()))

# Try using OpenSSH (if available on Windows)
try {
    $AvailablePort = ssh ${RemoteUser}@${RemoteHost} 'bash -c "for port in {8000..8100}; do if ! netstat -tuln 2>/dev/null | grep -q :$port && ! ss -tuln 2>/dev/null | grep -q :$port; then echo $port; exit 0; fi; done; echo no_port_available"'
    
    if ($LASTEXITCODE -ne 0) {
        Write-Status "SSH connection failed. Make sure you have OpenSSH client installed or SSH key configured." "Error"
        Write-Status "For password-based auth, consider using PuTTY or WSL." "Warning"
        exit 1
    }
} catch {
    Write-Status "Error: $_" "Error"
    exit 1
}

if ($AvailablePort -eq "no_port_available") {
    Write-Status "No available port found in range $StartPort-$EndPort" "Error"
    exit 1
}

Write-Status "Available port found: $AvailablePort" "Success"

# Step 2: Deploy to the available port
Write-Status "Starting deployment to port $AvailablePort..." "Info"

# Create deployment path
$DeployPath = "/var/www/$AppName-$AvailablePort"

$DeployScript = @"
#!/bin/bash
set -e

APP_NAME="$AppName"
PORT=$AvailablePort
DEPLOY_PATH="$DeployPath"

echo "=== Starting deployment of \$APP_NAME on port \$PORT ==="

# Create deployment directory
mkdir -p \$DEPLOY_PATH
cd \$DEPLOY_PATH

# Clone or update repository
if [ -d ".git" ]; then
    echo "Repository exists, pulling latest changes..."
    git pull origin main 2>/dev/null || git pull origin master
else
    echo "Cloning repository..."
    if [ -n "$GitRepo" ]; then
        git clone $GitRepo .
    else
        echo "NOTE: No git repo URL provided. Please manually clone/extract the code."
        exit 1
    fi
fi

# Set up Laravel environment
echo "Setting up Laravel environment..."
cp .env.example .env 2>/dev/null || true
composer install --no-interaction
php artisan key:generate --force

# Set up storage
chmod -R 775 storage bootstrap/cache
php artisan storage:link 2>/dev/null || true

# Run migrations
php artisan migrate --force

# Optimize
php artisan optimize:clear

echo "=== Deployment complete on port \$PORT ==="
echo "Access URL: http://$RemoteHost:\$PORT"

# Optional: Configure Supervisor/PM2 for process management
# Uncomment the section below if you want auto process management

# echo "Configuring supervisor..."
# cat > /etc/supervisor/conf.d/\${APP_NAME}-\${PORT}.conf << 'EOF'
# [program:\${APP_NAME}-\${PORT}]
# process_name=%(program_name)s_%(process_num)02d
# command=php /var/www/\${APP_NAME}-\${PORT}/artisan serve --host=0.0.0.0 --port=\${PORT}
# autostart=true
# autorestart=true
# user=www-data
# numprocs=1
# redirect_stderr=true
# stdout_logfile=/var/log/supervisor/\${APP_NAME}-\${PORT}.log
# EOF

# supervisorctl reread
# supervisorctl update
# supervisorctl start \${APP_NAME}-\${PORT}:*
"@

# Execute deployment on remote server
Write-Status "Executing deployment script on remote server..." "Info"

$DeployScript | ssh ${RemoteUser}@${RemoteHost} "bash"

if ($LASTEXITCODE -eq 0) {
    Write-Status "Deployment successful!" "Success"
    Write-Status "Your application is now running on port: $AvailablePort" "Success"
    Write-Status "Access URL: http://$RemoteHost`:$AvailablePort" "Success"
} else {
    Write-Status "Deployment encountered an error. Check the server logs for details." "Error"
    exit 1
}

Write-Status "Deployment completed!" "Success"
