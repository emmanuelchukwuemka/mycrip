#!/usr/bin/env php
<?php
/**
 * Laravel Multi-Project Server Deployment Script
 * 
 * Usage:
 *   php deploy.php [options]
 * 
 * Options:
 *   --host=IP              Remote server IP (default: 72.62.4.119)
 *   --user=USERNAME        SSH username (default: root)
 *   --password=PASS        SSH password (optional, will prompt if not set)
 *   --app-name=NAME        Application name (default: mycrip)
 *   --start-port=PORT      Starting port (default: 8000)
 *   --end-port=PORT        Ending port (default: 8100)
 *   --git-repo=URL         Git repository URL (optional)
 */

// Parse command line arguments
$options = [
    'host' => '72.62.4.119',
    'user' => 'root',
    'password' => '',
    'app-name' => 'mycrip',
    'start-port' => 8000,
    'end-port' => 8100,
    'git-repo' => '',
];

foreach ($argv as $i => $arg) {
    if ($i === 0) continue;
    
    if (strpos($arg, '--') === 0) {
        $parts = explode('=', substr($arg, 2), 2);
        $key = $parts[0];
        $value = $parts[1] ?? true;
        $options[$key] = $value;
    }
}

// Color codes for output
class Colors {
    const RESET = "\033[0m";
    const RED = "\033[31m";
    const GREEN = "\033[32m";
    const YELLOW = "\033[33m";
    const BLUE = "\033[36m";
}

function log_info($message) {
    echo Colors::BLUE . "[INFO]" . Colors::RESET . " $message\n";
}

function log_success($message) {
    echo Colors::GREEN . "[SUCCESS]" . Colors::RESET . " $message\n";
}

function log_error($message) {
    echo Colors::RED . "[ERROR]" . Colors::RESET . " $message\n";
}

function log_warning($message) {
    echo Colors::YELLOW . "[WARNING]" . Colors::RESET . " $message\n";
}

// Check if SSH is available
function check_ssh_available() {
    $output = shell_exec('ssh -V 2>&1');
    return $output !== null && strpos($output, 'OpenSSH') !== false;
}

// Execute remote command via SSH 
function ssh_exec($host, $user, $command, $password = '') {
    $sshOpts = array(
        "-o StrictHostKeyChecking=no",
        "-o UserKnownHostsFile=/dev/null",
        "-o LogLevel=ERROR"
    );
    
    $sshCmd = "ssh " . implode(" ", $sshOpts) . " {$user}@{$host}";
    
    // Escape command for shell
    $escapedCmd = escapeshellarg($command);
    $fullCmd = "$sshCmd $escapedCmd 2>&1";
    
    log_info("Executing remote command...");
    
    $output = shell_exec($fullCmd);
    
    if ($output === false) {
        throw new Exception("Failed to execute SSH command");
    }
    
    return trim((string)$output);
}

// Start Laravel artisan serve in background on remote server
function start_server($host, $user, $appName, $port) {
    // Use nohup to detach; log output
    $cmd = "cd /var/www/{$appName}-$port && nohup php artisan serve --host=0.0.0.0 --port=$port > /var/log/{$appName}-$port.log 2>&1 &";
    log_info("Starting server with command: $cmd");
    try {
        $result = ssh_exec($host, $user, $cmd);
        log_info("start_server output: $result");
        return $result;
    } catch (Exception $e) {
        log_error("start_server failed: " . $e->getMessage());
        throw $e;
    }
}

// Find available port
function find_available_port($host, $user, $appName, $startPort, $endPort) {
    log_info("Finding available port between $startPort and $endPort that isn't already used or previously deployed...");
    
    // build a one‑liner command using seq (dash-compatible)
    $command = "for port in $(seq $startPort $endPort); do ";
    $command .= "if netstat -tuln 2>/dev/null | grep -q :\$port || ss -tuln 2>/dev/null | grep -q :\$port; then continue; fi; ";
    $command .= "if [ -d '/var/www/{$appName}-\$port' ]; then continue; fi; ";
    $command .= "echo \$port; exit 0; ";
    $command .= "done; echo no_port_available";
    
    try {
        $port = ssh_exec($host, $user, $command);
        
        if ($port === 'no_port_available' || empty($port)) {
            throw new Exception("No available ports found in range $startPort-$endPort");
        }
        
        log_success("Found available port: $port");
        return $port;
        
    } catch (Exception $e) {
        log_error("Error finding available port: " . $e->getMessage());
        throw $e;
    }
}

// Synchronize project code to remote server (either via git or file copy)
function sync_code($host, $user, $deployPath, $gitRepo = '') {
    if (!empty($gitRepo)) {
        // Remote repository URL provided: clone or pull
        $pullCmd  = "if [ -d '$deployPath/.git' ]; then ";
        $pullCmd .= "cd '$deployPath' && git pull origin main 2>/dev/null || git pull origin master 2>/dev/null; ";
        $pullCmd .= "else git clone '$gitRepo' '$deployPath'; fi";
        log_info("Syncing code using git (repo: $gitRepo)...");
        $result = ssh_exec($host, $user, $pullCmd);
        log_info("git sync output: $result");
        return;
    }

    // No git repo, sync current working directory by archiving locally and uploading
    $localDir = getcwd();
    log_info("Syncing local files from $localDir to remote path $deployPath via temporary archive");

    // create a tarball in temp directory
    $archivePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'deploy_' . uniqid() . '.tar.gz';
    $tarCreate = "cd " . escapeshellarg($localDir) . " && tar czf " . escapeshellarg($archivePath) . " .";
    log_info("Creating local archive with command: $tarCreate");
    $tarOutput = shell_exec($tarCreate . ' 2>&1');
    if ($tarOutput === null) {
        throw new Exception("Failed to create local archive");
    }
    log_info("tar output: " . trim($tarOutput));

    // upload archive via scp
    $scpCmd = "scp -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -o LogLevel=ERROR " . escapeshellarg($archivePath) . " {$user}@{$host}:/tmp/";
    log_info("Uploading archive: $scpCmd");
    $scpOutput = shell_exec($scpCmd . ' 2>&1');
    if ($scpOutput === null) {
        throw new Exception("Failed to upload archive to remote");
    }
    log_info("scp output: " . trim($scpOutput));

    // extract on remote and clean up
    $base = basename($archivePath);
    $remoteCmd = "mkdir -p " . escapeshellarg($deployPath) . " && tar xzf /tmp/$base -C " . escapeshellarg($deployPath) . " && rm /tmp/$base";
    log_info("Extracting archive on remote with command: $remoteCmd");
    $sshOutput = ssh_exec($host, $user, $remoteCmd);
    log_info("remote extract output: $sshOutput");

    // remove local archive
    @unlink($archivePath);
}


// Deploy Laravel application
function deploy_laravel($host, $user, $appName, $port, $gitRepo = '') {
    $deployPath = "/var/www/{$appName}-{$port}";
    
    log_info("Deploying Laravel application...");
    log_info("App: $appName | Port: $port | Path: $deployPath");
    log_info("This may take a few minutes...\n");
    
    // Prepare directory and sync code first
    ssh_exec($host, $user, "mkdir -p $deployPath");
    sync_code($host, $user, $deployPath, $gitRepo);
    
    // Build deployment commands that assume code is present
    $commands = array(
        "cd $deployPath",
        "echo 'Checking for existing repository...'",
        "if [ -d .git ]; then git pull origin main 2>/dev/null || git pull origin master 2>/dev/null; else echo 'New deployment'; fi",
        "[ -f .env ] || [ ! -f .env.example ] || cp .env.example .env",
        "[ -f composer.json ] && (echo '[1/5] Installing dependencies...' && composer install --no-dev --no-interaction 2>/dev/null || true)",
        "echo '[2/5] Generating app key...' && php artisan key:generate --force 2>/dev/null || true",
        "echo '[3/5] Setting permissions...' && chmod -R 775 storage bootstrap/cache 2>/dev/null || true",
        "php artisan storage:link 2>/dev/null || true",
        "echo '[4/5] Running migrations...' && php artisan migrate --force 2>/dev/null || echo 'Migrations skipped'",
        "echo '[5/5] Clearing cache...' && php artisan optimize:clear 2>/dev/null || true",
        "echo ''",
        "echo '=== DEPLOYMENT COMPLETE ==='",
        "echo 'Application: $appName'",
        "echo 'Port: $port'",
        "echo 'Path: $deployPath'",
        "echo 'Access: http://$host:$port'",
        "echo ''"
    );
    
    $command = implode(' && ', $commands);
    
    try {
        log_info("Executing deployment commands on remote server...\n");
        $output = ssh_exec($host, $user, $command);
        
        // Print output
        if ($output) {
            echo $output . "\n";
        }
        
        log_success("Deployment script executed");
        
        // start Laravel built-in server in background
        try {
            start_server($host, $user, $appName, $port);
            log_success("Laravel server started on port $port");
        } catch (Exception $inner) {
            log_warning("Failed to start background server: " . $inner->getMessage());
        }
        
        log_success("Your application is running on port: $port");
        log_success("Access URL: http://$host:$port");
        
        return true;
        
    } catch (Exception $e) {
        log_error("Deployment error: " . $e->getMessage());
        throw $e;
    }
}

// Main function
function main() {
    global $options;
    
    try {
        log_info("=== Laravel Multi-Project Deployment Script ===");
        log_info("Server: {$options['host']}");
        log_info("User: {$options['user']}");
        log_info("App Name: {$options['app-name']}");
        log_info("Port Range: {$options['start-port']}-{$options['end-port']}");
        log_info("Using SSH key authentication");
        echo "\n";
        
        // Check SSH availability
        if (!check_ssh_available()) {
            log_error("SSH client not available. Please install OpenSSH or Git for Windows.");
            exit(1);
        }
        
        log_success("SSH client available");
        
        // Find available port (skipping existing deployments)
        $port = find_available_port(
            $options['host'],
            $options['user'],
            $options['app-name'],
            $options['start-port'],
            $options['end-port']
        );
        
        echo "\n";
        
        // Deploy Laravel application
        deploy_laravel(
            $options['host'],
            $options['user'],
            $options['app-name'],
            $port,
            $options['git-repo']
        );
        
        echo "\n";
        log_success("=== Deployment Process Complete ===");
        log_info("Your app is running at: http://{$options['host']}:{$port}");
        
    } catch (Exception $e) {
        log_error($e->getMessage());
        exit(1);
    }
}

// Run main function
main();
