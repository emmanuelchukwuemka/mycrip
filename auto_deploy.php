<?php
/**
 * Complete Laravel Deployment Script
 * Deploys your Laravel app to a remote server with automatic port detection
 * 
 * Run: php auto_deploy.php
 * 
 * Server Configuration
 */
$config = [
    'host' => '72.62.4.119',
    'username' => 'root',
    'password' => 'Mathscrusader123.',
    'app_name' => 'mycrip',
    'start_port' => 8000,
    'end_port' => 8100,
    'git_repo' => 'https://github.com/emmanuelchukwuemka/mycrip.git'
];

/**
 * Color codes for terminal output
 */
class Colors {
    const RESET = "\033[0m";
    const RED = "\033[31m";
    const GREEN = "\033[32m";
    const YELLOW = "\033[33m";
    const BLUE = "\033[36m";
    const BOLD = "\033[1m";
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

/**
 * SSH Connection using shell commands via exec
 */
function ssh_connect($host, $user, $password, $command) {
    // Use SSH with password via sshpass if available, otherwise use expect-like approach
    $safePassword = addslashes($password);
    $cmd = "sshpass -p '$safePassword' ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -o LogLevel=ERROR $user@$host \"$command\" 2>&1";
    
    $output = [];
    $returnCode = 0;
    exec($cmd, $output, $returnCode);
    
    return [
        'output' => implode("\n", $output),
        'return_code' => $returnCode
    ];
}

/**
 * SCP file to remote server
 */
function scp_to_remote($host, $user, $password, $localFile, $remotePath) {
    $safePassword = addslashes($password);
    $cmd = "sshpass -p '$safePassword' scp -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null \"$localFile\" $user@$host:\"$remotePath\" 2>&1";
    
    $output = [];
    exec($cmd, $output, $returnCode);
    
    return $returnCode === 0;
}

/**
 * Upload directory to remote server
 */
function upload_directory($host, $user, $password, $localPath, $remotePath) {
    $safePassword = addslashes($password);
    
    // Create archive locally
    $archiveName = sys_get_temp_dir() . '/deploy_' . time() . '.tar.gz';
    $cmd = "cd \"" . $localPath . "\" && tar czf \"$archiveName\" . --exclude='.git' --exclude='node_modules' --exclude='vendor' --exclude='.env'";
    exec($cmd);
    
    if (!file_exists($archiveName)) {
        return false;
    }
    
    // Upload archive
    $scpCmd = "sshpass -p '$safePassword' scp -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null \"$archiveName\" $user@$host:/tmp/deploy.tar.gz";
    exec($scpCmd, $scpOutput, $scpReturn);
    
    // Clean up local archive
    unlink($archiveName);
    
    if ($scpReturn !== 0) {
        return false;
    }
    
    // Extract on remote
    $sshCmd = "sshpass -p '$safePassword' ssh -o StrictHostKeyChecking=no $user@$host \"mkdir -p $remotePath && tar xzf /tmp/deploy.tar.gz -C $remotePath && rm /tmp/deploy.tar.gz\"";
    exec($sshCmd, $extractOutput, $extractReturn);
    
    return $extractReturn === 0;
}

/**
 * Find available port on remote server
 */
function find_available_port($host, $user, $password, $appName, $startPort, $endPort) {
    log_info("Scanning for available ports between $startPort and $endPort...");
    
    // Create a script to check ports
    $checkScript = <<<BASH
for port in $(seq $startPort $endPort); do
    if netstat -tuln 2>/dev/null | grep -q ":$port " || ss -tuln 2>/dev/null | grep -q ":$port "; then
        continue
    fi
    if [ -d "/var/www/$appName-$port" ]; then
        continue
    fi
    echo $port
    exit 0
done
echo "NO_PORT"
BASH;

    $result = ssh_connect($host, $user, $password, $checkScript);
    $port = trim($result['output']);
    
    if ($port === 'NO_PORT' || empty($port)) {
        return null;
    }
    
    return $port;
}

/**
 * Check existing deployments
 */
function check_existing_deployments($host, $user, $password, $appName) {
    $result = ssh_connect($host, $user, $password, "ls -la /var/www/ 2>/dev/null | grep $appName");
    return $result['output'];
}

/**
 * Kill existing process on port
 */
function kill_port_process($host, $user, $password, $port) {
    $result = ssh_connect($host, $user, $password, "pkill -f 'artisan serve.*port=$port' 2>/dev/null || true");
    return true;
}

/**
 * Start Laravel server
 */
function start_laravel_server($host, $user, $password, $deployPath, $port) {
    $commands = [
        "cd $deployPath",
        "pkill -f 'artisan serve.*port=$port' 2>/dev/null || true",
        "nohup php artisan serve --host=0.0.0.0 --port=$port > /var/log/{$port}.log 2>&1 &",
        "sleep 2",
        "netstat -tuln 2>/dev/null | grep ':$port ' || ss -tuln 2>/dev/null | grep ':$port '"
    ];
    
    $result = ssh_connect($host, $user, $password, implode(' && ', $commands));
    return $result['output'];
}

/**
 * Deploy Laravel application
 */
function deploy_laravel($config) {
    extract($config);
    
    echo "\n";
    echo Colors::BOLD . "========================================\n";
    echo "  Laravel Auto-Deployment Script\n";
    echo "========================================\n" . Colors::RESET;
    echo "\n";
    log_info("Server: $host");
    log_info("User: $username");
    log_info("App Name: $app_name");
    log_info("Port Range: $start_port - $end_port");
    echo "\n";
    
    // Test SSH connection first
    log_info("Testing SSH connection...");
    $testResult = ssh_connect($host, $username, $password, "echo connected");
    if ($testResult['return_code'] !== 0) {
        log_error("Failed to connect to server. Please check credentials.");
        log_error("Output: " . $testResult['output']);
        return false;
    }
    log_success("SSH connection successful!");
    echo "\n";
    
    // Check existing deployments
    log_info("Checking existing deployments...");
    $existing = check_existing_deployments($host, $username, $password, $app_name);
    if (!empty($existing)) {
        log_warning("Existing deployments found:");
        echo $existing . "\n";
    }
    echo "\n";
    
    // Find available port
    $port = find_available_port($host, $username, $password, $app_name, $start_port, $end_port);
    
    if (!$port) {
        log_error("No available ports found in range $start_port - $end_port");
        return false;
    }
    
    log_success("Found available port: $port");
    echo "\n";
    
    $deployPath = "/var/www/$app_name-$port";
    
    // Create deployment directory
    log_info("Creating deployment directory...");
    ssh_connect($host, $username, $password, "mkdir -p $deployPath");
    
    // Upload code
    log_info("Uploading code to server...");
    $localPath = getcwd();
    
    // Check if git repo is provided
    if (!empty($git_repo)) {
        log_info("Cloning from git repository...");
        $cloneCmd = "cd $deployPath && git clone $git_repo . 2>/dev/null || (git pull origin main 2>/dev/null || git pull origin master 2>/dev/null)";
        $result = ssh_connect($host, $username, $password, $cloneCmd);
        log_info("Git output: " . $result['output']);
    } else {
        log_info("Uploading local files...");
        if (upload_directory($host, $username, $password, $localPath, $deployPath)) {
            log_success("Files uploaded successfully!");
        } else {
            log_error("Failed to upload files");
            return false;
        }
    }
    echo "\n";
    
    // Setup Laravel
    log_info("Setting up Laravel application...");
    
    $setupCommands = [
        "cd $deployPath",
        "[ -f .env.example ] && cp .env.example .env || true",
        "[ -f .env ] || echo 'APP_NAME=$app_name' > .env",
        "chmod -R 775 storage bootstrap/cache 2>/dev/null || true",
        "chown -R www-data:www-data . 2>/dev/null || true"
    ];
    
    $result = ssh_connect($host, $username, $password, implode(' && ', $setupCommands));
    
    // Install composer dependencies
    log_info("Installing PHP dependencies...");
    $composerCmd = "cd $deployPath && composer install --no-interaction --no-dev 2>&1 | tail -20";
    $result = ssh_connect($host, $username, $password, $composerCmd);
    log_info("Composer output: " . $result['output']);
    
    // Generate app key
    log_info("Generating application key...");
    $keyCmd = "cd $deployPath && php artisan key:generate --force 2>&1";
    $result = ssh_connect($host, $username, $password, $keyCmd);
    log_info("Key generation: " . $result['output']);
    
    // Run migrations
    log_info("Running database migrations...");
    $migrateCmd = "cd $deployPath && php artisan migrate --force 2>&1";
    $result = ssh_connect($host, $username, $password, $migrateCmd);
    log_info("Migrations: " . $result['output']);
    
    // Clear cache
    log_info("Optimizing application...");
    $optimizeCmd = "cd $deployPath && php artisan optimize:clear 2>&1";
    ssh_connect($host, $username, $password, $optimizeCmd);
    
    echo "\n";
    
    // Kill any existing process on this port
    kill_port_process($host, $username, $password, $port);
    
    // Start the server
    log_info("Starting Laravel server on port $port...");
    $startResult = start_laravel_server($host, $username, $password, $deployPath, $port);
    
    // Verify server is running
    $verifyCmd = "netstat -tuln 2>/dev/null | grep ':$port ' || ss -tuln 2>/dev/null | grep ':$port '";
    $verifyResult = ssh_connect($host, $username, $password, $verifyCmd);
    
    if (strpos($verifyResult['output'], ":$port ") !== false) {
        echo "\n";
        echo Colors::BOLD . Colors::GREEN;
        echo "========================================\n";
        echo "  Deployment Complete!\n";
        echo "========================================\n" . Colors::RESET;
        log_success("App Name: $app_name");
        log_success("Port: $port");
        log_success("Access URL: http://$host:$port");
        echo "========================================\n";
        return true;
    } else {
        log_warning("Server may not have started properly.");
        log_info("Check logs at: /var/log/$port.log");
        log_info("You can manually start with: cd $deployPath && php artisan serve --host=0.0.0.0 --port=$port");
        return false;
    }
}

// Run deployment
$success = deploy_laravel($config);

if (!$success) {
    log_error("Deployment failed!");
    exit(1);
}

exit(0);
