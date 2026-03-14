# Laravel Deployment Script for Multi-Project Server
# This script finds an available port and deploys the project without clashing with existing deployments

param(
    [string]$RemoteHost = "72.62.4.119",
    [string]$RemoteUser = "root",
    [string]$RemotePassword = "Mathscrusader123.",
    [int]$StartPort = 8000,
    [int]$EndPort = 8100,
    [string]$AppName = "mycrip"
)

# Colors for output
function Write-ColorOutput {
    param(
        [string]$Message,
        [string]$Type = "Info"
    )
    
    $colors = @{
        "Info" = "Cyan"
        "Success" = "Green"
        "Error" = "Red"
        "Warning" = "Yellow"
    }
    
    Write-Host "[$Type] $Message" -ForegroundColor $colors[$Type]
}

# Get list of existing deployments
function Get-ExistingDeployments {
    param(
        [string]$ServerAddress,
        [string]$User,
        [string]$Password,
        [string]$AppName
    )
    
    $cmd = "sshpass -p `"$Password`" ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null ${User}@${ServerAddress} `"ls -la /var/www/ 2>/dev/null | grep $AppName`""
    
    $result = Invoke-Expression $cmd 2>&1
    return $result
}

# Find available port on remote server
function Find-AvailablePort {
    param(
        [string]$ServerAddress,
        [string]$User,
        [string]$Password,
        [int]$StartPort,
        [int]$EndPort,
        [string]$AppName
    )
    
    Write-ColorOutput "Scanning for available ports between $StartPort and $EndPort..." "Info"
    
    # Create the check script content
    $checkScript = @"
#!/bin/bash
for port in `$(seq $StartPort $EndPort); do
    if netstat -tuln 2>/dev/null | grep -q ":`$port " || ss -tuln 2>/dev/null | grep -q ":`$port "; then
        continue
    fi
    if [ -d "/var/www/$AppName-`$port" ]; then
        continue
    fi
    echo `$port
    exit 0
done
echo "NO_PORT_AVAILABLE"
"@
    
    # Write to temp file
    $tempScript = [System.IO.Path]::GetTempFileName() + ".sh"
    $checkScript | Out-File -FilePath $tempScript -Encoding UTF8
    
    # Copy to remote and execute
    $copyCmd = "sshpass -p `"$Password`" scp -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null $tempScript ${User}@${ServerAddress}:/tmp/check_port.sh"
    Invoke-Expression $copyCmd | Out-Null
    
    $execCmd = "sshpass -p `"$Password`" ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null ${User}@${ServerAddress} `"bash /tmp/check_port.sh`""
    $availablePort = Invoke-Expression $execCmd 2>&1
    $availablePort = $availablePort.Trim()
    
    # Clean up
    Remove-Item $tempScript -Force -ErrorAction SilentlyContinue
    Invoke-Expression "sshpass -p `"$Password`" ssh -o StrictHostKeyChecking=no ${User}@${ServerAddress} `"rm -f /tmp/check_port.sh`"" | Out-Null
    
    if ($availablePort -eq "NO_PORT_AVAILABLE" -or [string]::IsNullOrWhiteSpace($availablePort)) {
        Write-ColorOutput "No available port found in range $StartPort-$EndPort" "Error"
        return $null
    }
    
    Write-ColorOutput "Found available port: $availablePort" "Success"
    return $availablePort
}

# Create deployment script for remote server
function New-RemoteDeploymentScript {
    param(
        [string]$ServerAddress,
        [string]$AppName,
        [int]$Port
    )
    
    $deployPath = "/var/www/$AppName-$Port"
    
    $script = @"
#!/bin/bash
set -e

APP_NAME="$AppName"
PORT=$Port
DEPLOY_PATH="$deployPath"

echo "=== Starting deployment of $APP_NAME on port $PORT ==="

# Create deployment directory
mkdir -p $DEPLOY_PATH
cd $DEPLOY_PATH

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
echo "Starting Laravel server on port $PORT..."
nohup php artisan serve --host=0.0.0.0 --port=$PORT > /var/log/$AppName-$Port.log 2>&1 &
sleep 2

# Verify server is running
if netstat -tuln 2>/dev/null | grep -q ":$PORT " || ss -tuln 2>/dev/null | grep -q ":$PORT "; then
    echo "=== Deployment complete on port $PORT ==="
    echo "Access URL: http://${ServerAddress}:${PORT}"
else
    echo "Warning: Server may not have started. Check logs at /var/log/$AppName-$Port.log"
fi
"@
    
    return $script
}

# Deploy the application
function Deploy-Application {
    param(
        [string]$ServerAddress,
        [string]$User,
        [string]$Password,
        [string]$AppName,
        [int]$Port
    )
    
    Write-ColorOutput "Starting deployment to port $Port..." "Info"
    
    $script = New-RemoteDeploymentScript -ServerAddress $ServerAddress -AppName $AppName -Port $Port
    
    # Write script to temporary file
    $tempScript = [System.IO.Path]::GetTempFileName() + ".sh"
    $script | Out-File -FilePath $tempScript -Encoding UTF8
    
    # Copy script to remote server
    $copyCmd = "sshpass -p `"$Password`" scp -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null $tempScript ${User}@${ServerAddress}:/tmp/deploy_$AppName.sh"
    Invoke-Expression $copyCmd | Out-Null
    
    # Execute script on remote server
    $execCmd = "sshpass -p `"$Password`" ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null ${User}@${ServerAddress} `"bash /tmp/deploy_$AppName.sh`""
    Write-ColorOutput "Executing deployment script..." "Info"
    
    $output = Invoke-Expression $execCmd 2>&1
    Write-Host $output
    
    # Clean up
    Remove-Item $tempScript -Force -ErrorAction SilentlyContinue
    Invoke-Expression "sshpass -p `"$Password`" ssh -o StrictHostKeyChecking=no ${User}@${ServerAddress} `"rm -f /tmp/deploy_$AppName.sh`"" | Out-Null
    
    if ($LASTEXITCODE -eq 0) {
        Write-ColorOutput "Deployment completed successfully!" "Success"
        return $true
    } else {
        Write-ColorOutput "Deployment may have encountered issues. Check output above." "Warning"
        return $true
    }
}

# Main execution
function Main {
    Write-ColorOutput "========================================" "Info"
    Write-ColorOutput "  Laravel Multi-Project Deployment" "Info"
    Write-ColorOutput "========================================" "Info"
    Write-ColorOutput "Server: $RemoteHost" "Info"
    Write-ColorOutput "User: $RemoteUser" "Info"
    Write-ColorOutput "App Name: $AppName" "Info"
    Write-ColorOutput "Port Range: $StartPort - $EndPort" "Info"
    Write-ColorOutput "========================================" "Info"
    Write-Host ""
    
    # Check for existing deployments first
    Write-ColorOutput "Checking existing deployments on server..." "Info"
    $existing = Get-ExistingDeployments -ServerAddress $RemoteHost -User $RemoteUser -Password $RemotePassword -AppName $AppName
    if ($existing) {
        Write-ColorOutput "Existing deployments found:" "Warning"
        Write-Host $existing
    }
    Write-Host ""
    
    # Find available port
    $availablePort = Find-AvailablePort -ServerAddress $RemoteHost -User $RemoteUser -Password $RemotePassword -StartPort $StartPort -EndPort $EndPort -AppName $AppName
    
    if (-not $availablePort) {
        Write-ColorOutput "Deployment failed: No available ports" "Error"
        exit 1
    }
    
    $port = [int]$availablePort
    Write-Host ""
    
    # Deploy application
    $success = Deploy-Application -ServerAddress $RemoteHost -User $RemoteUser -Password $RemotePassword -AppName $AppName -Port $port
    
    if ($success) {
        Write-Host ""
        Write-ColorOutput "========================================" "Success"
        Write-ColorOutput "  Deployment Complete!" "Success"
        Write-ColorOutput "========================================" "Success"
        Write-ColorOutput "App Name: $AppName" "Success"
        Write-ColorOutput "Port: $port" "Success"
        Write-ColorOutput "Access URL: http://$RemoteHost`:$port" "Success"
        Write-ColorOutput "========================================" "Success"
    }
}

# Run main
Main
