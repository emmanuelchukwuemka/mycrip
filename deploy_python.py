#!/usr/bin/env python3
"""
Laravel Deployment Script using Python Paramiko
Connects to server and deploys your Laravel app
"""

import paramiko
import os
import sys
import time
import tarfile
import io
import traceback

# Server Configuration
CONFIG = {
    'host': '72.62.4.119',
    'username': 'root',
    'password': 'Mathscrusader123.',
    'app_name': 'mycrip',
    'start_port': 8000,
    'end_port': 8100,
    'target_port': 8002,  # Set to None to auto-scan, or specify a port
    'key_file': os.path.expanduser('~/.ssh/id_rsa')
}

def print_info(msg):
    print(f"\033[36m[INFO]\033[0m {msg}")

def print_success(msg):
    print(f"\033[32m[SUCCESS]\033[0m {msg}")

def print_error(msg):
    print(f"\033[31m[ERROR]\033[0m {msg}")

def print_warning(msg):
    print(f"\033[33m[WARNING]\033[0m {msg}")

def connect_ssh():
    """Connect to the server via SSH"""
    print_info("Connecting to server...")
    
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    
    try:
        # Try with password first
        client.connect(
            hostname=CONFIG['host'],
            username=CONFIG['username'],
            password=CONFIG['password'],
            timeout=30
        )
        print_success("Connected via SSH!")
        return client
    except Exception as e:
        print_warning(f"Password auth failed: {e}")
        
        # Try with SSH key
        try:
            key = paramiko.RSAKey.from_private_key_file(CONFIG['key_file'])
            client.connect(
                hostname=CONFIG['host'],
                username=CONFIG['username'],
                pkey=key,
                timeout=30
            )
            print_success("Connected via SSH key!")
            return client
        except Exception as e2:
            print_error(f"SSH key auth also failed: {e2}")
            return None

def run_command(client, command, timeout=30, background=False):
    """Run a command on the server"""
    print(f"Executing: {command}")
    stdin, stdout, stderr = client.exec_command(command, timeout=timeout)
    
    if background:
        return "", ""
        
    output = stdout.read().decode('utf-8')
    error = stderr.read().decode('utf-8')
    return output, error

def find_available_port(client):
    """Find an available port on the server"""
    print_info(f"Scanning for available ports between {CONFIG['start_port']} and {CONFIG['end_port']}...")
    
    # Check each port
    for port in range(CONFIG['start_port'], CONFIG['end_port'] + 1):
        # Check if port is in use
        output, _ = run_command(client, f"netstat -tuln 2>/dev/null | grep ':{port} ' || ss -tuln 2>/dev/null | grep ':{port} '")
        
        if output.strip():
            continue  # Port is in use
            
        # Check if deployment directory exists
        deploy_path = f"/var/www/{CONFIG['app_name']}-{port}"
        output, _ = run_command(client, f"ls -d {deploy_path} 2>/dev/null")
        
        if output.strip():
            continue  # Directory exists
        
        print_success(f"Found available port: {port}")
        return port
    
    return None

def check_existing_deployments(client):
    """Check for existing deployments"""
    print_info("Checking existing deployments...")
    output, _ = run_command(client, f"ls -la /var/www/ 2>/dev/null | grep {CONFIG['app_name']}")
    
    if output.strip():
        print_warning("Existing deployments found:")
        print(output)
    else:
        print_info("No existing deployments found")
    
    return output

def deploy_laravel(client, port):
    """Deploy Laravel application to the server"""
    app_name = CONFIG['app_name']
    deploy_path = f"/var/www/{app_name}-{port}"
    
    print_info(f"Deploying to {deploy_path} on port {port}...")
    
    # Create deployment directory
    run_command(client, f"mkdir -p {deploy_path}")
    
    # For now, we'll use git to pull from repository
    git_repo = 'https://github.com/emmanuelchukwuemka/mycrip.git'
    
    print_info("Cloning/pulling from git repository...")
    output, error = run_command(client, f"cd {deploy_path} && git clone {git_repo} . 2>/dev/null || git pull origin main 2>/dev/null || git pull origin master")
    
    if error and 'fatal' in error.lower():
        print_warning("Git clone/pull may have issues, continuing...")
    
    # Setup Laravel
    print_info("Setting up Laravel...")
    
    # Copy env file
    run_command(client, f"cd {deploy_path} && cp .env.example .env 2>/dev/null || true")
    
    # Set permissions
    run_command(client, f"chmod -R 775 {deploy_path}/storage {deploy_path}/bootstrap/cache 2>/dev/null || true")
    
    # Install composer dependencies
    print_info("Installing PHP dependencies...")
    output, error = run_command(client, f"cd {deploy_path} && composer install --no-interaction --no-dev 2>&1 | tail -20", timeout=300)
    print_info(f"Composer output: {output[:500]}...")
    
    # Generate app key
    print_info("Generating application key...")
    output, _ = run_command(client, f"cd {deploy_path} && php artisan key:generate --force")
    
    # Run migrations
    print_info("Running database migrations...")
    output, _ = run_command(client, f"cd {deploy_path} && php artisan migrate --force 2>&1")
    
    # Clear cache
    print_info("Optimizing application...")
    run_command(client, f"cd {deploy_path} && php artisan optimize:clear")
    
    return True

def start_server(client, port):
    """Start the Laravel development server"""
    app_name = CONFIG['app_name']
    deploy_path = f"/var/www/{app_name}-{port}"
    
    print_info(f"Starting Laravel server on port {port}...")
    
    # Kill any existing process on this port more aggressively
    run_command(client, f"fuser -k {port}/tcp 2>/dev/null || true")
    run_command(client, f"pkill -f 'artisan serve.*port={port}' 2>/dev/null || true")
    run_command(client, f"pkill -f 'php.*-S.*:{port}' 2>/dev/null || true")
    time.sleep(2)
    
    # Start the server in background
    command = f"cd {deploy_path} && nohup php artisan serve --host=0.0.0.0 --port={port} < /dev/null > /var/log/{app_name}-{port}.log 2>&1 &"
    run_command(client, command, background=True)
    
    # Wait a moment
    time.sleep(3)
    
    # Verify server is running
    output, _ = run_command(client, f"netstat -tuln 2>/dev/null | grep ':{port} ' || ss -tuln 2>/dev/null | grep ':{port} '")
    
    if output.strip():
        return True
    else:
        # Try checking process list
        output, _ = run_command(client, f"ps aux | grep 'artisan serve' | grep {port}")
        return bool(output.strip())

def main():
    print("\n" + "="*50)
    print("  Laravel Auto-Deployment Script (Python)")
    print("="*50 + "\n")
    
    print_info(f"Server: {CONFIG['host']}")
    print_info(f"User: {CONFIG['username']}")
    print_info(f"App: {CONFIG['app_name']}")
    print_info(f"Port Range: {CONFIG['start_port']} - {CONFIG['end_port']}")
    print()
    
    # Connect to server
    client = connect_ssh()
    
    if not client:
        print_error("Failed to connect to server!")
        return False
    
    try:
        # Check existing deployments
        check_existing_deployments(client)
        
        # Determine port
        if CONFIG.get('target_port'):
            port = CONFIG['target_port']
            print_info(f"Using targeted port: {port}")
        else:
            # Find available port
            port = find_available_port(client)
        
        if not port:
            print_error("No port determined for deployment!")
            return False
        
        print()
        
        # Deploy Laravel
        deploy_laravel(client, port)
        
        # Start server
        if start_server(client, port):
            print()
            print("="*50)
            print_success(f"Deployment Complete!")
            print("="*50)
            print_success(f"App Name: {CONFIG['app_name']}")
            print_success(f"Port: {port}")
            print_success(f"Access URL: http://{CONFIG['host']}:{port}")
            print("="*50)
            return True
        else:
            print_warning("Server may not have started. Check logs on server.")
            return True  # Still consider it success since deployment happened
            
    except Exception as e:
        print_error(f"Deployment error: {e}")
        traceback.print_exc()
        return False
    
    finally:
        client.close()

if __name__ == "__main__":
    success = main()
    sys.exit(0 if success else 1)
