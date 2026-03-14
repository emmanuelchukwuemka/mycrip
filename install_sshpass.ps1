# Download and install sshpass for Windows
# Run this script as Administrator

$ErrorActionPreference = "Stop"

# Check if already installed
$sshpassPath = "$env:ProgramData\sshpass\sshpass.exe"
if (Test-Path $sshpassPath) {
    Write-Host "sshpass is already installed at $sshpassPath" -ForegroundColor Green
    exit 0
}

# Create installation directory
$installDir = "$env:ProgramData\sshpass"
if (-not (Test-Path $installDir)) {
    New-Item -ItemType Directory -Path $installDir -Force
}

# Download sshpass binary (pre-built for Windows)
$url = "https://github.com/PowerShell/Win32-OpenSSH/releases/latest/download/OpenSSH-Win64.zip"

Write-Host "Downloading OpenSSH with sshpass support..." -ForegroundColor Cyan
try {
    # Try to download OpenSSH
    Invoke-WebRequest -Uri "https://github.com/PowerShell/Win32-OpenSSH/releases/download/v9.5.0.0p1-Beta/OpenSSH-Win64.zip" -OutFile "$env:TEMP\openssh.zip" -UseBasicParsing
    Expand-Archive -Path "$env:TEMP\openssh.zip" -DestinationPath $installDir -Force
    
    # Add to PATH
    $env:Path += ";$installDir"
    [Environment]::SetEnvironmentVariable("Path", $env:Path, [EnvironmentVariableTarget]::User)
    
    Write-Host "OpenSSH installed. Note: Password-based SSH requires additional configuration." -ForegroundColor Yellow
} catch {
    Write-Host "Failed to download. Trying alternative method..." -ForegroundColor Yellow
}

# Alternative: Use chocolatey if available
$choco = Get-Command choco -ErrorAction SilentlyContinue
if ($choco) {
    Write-Host "Installing sshpass via Chocolatey..." -ForegroundColor Cyan
    choco install sshpass -y
    if ($LASTEXITCODE -eq 0) {
        Write-Host "sshpass installed successfully!" -ForegroundColor Green
        exit 0
    }
}

# Alternative 2: Download from sourceforge
Write-Host "Trying to download sshpass from SourceForge..." -ForegroundColor Cyan
try {
    # This is a known working sshpass binary for Windows
    $urls = @(
        "https://sourceforge.net/projects/sshpass/files/sshpass/1.09/sshpass-win-1.09.zip/download",
        "https://downloads.sourceforge.net/project/sshpass/sshpass/1.09/sshpass-1.09-win.zip"
    )
    
    foreach ($url in $urls) {
        try {
            Invoke-WebRequest -Uri $url -OutFile "$env:TEMP\sshpass.zip" -UseBasicParsing -TimeoutSec 30
            Expand-Archive -Path "$env:TEMP\sshpass.zip" -DestinationPath $installDir -Force
            Copy-Item "$installDir\sshpass.exe" -Destination "$env:SystemRoot\System32\" -Force -ErrorAction SilentlyContinue
            Write-Host "sshpass installed successfully!" -ForegroundColor Green
            exit 0
        } catch {
            continue
        }
    }
} catch {
    Write-Host "Could not download sshpass automatically." -ForegroundColor Red
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Yellow
Write-Host "Manual Installation Required:" -ForegroundColor Yellow
Write-Host "========================================" -ForegroundColor Yellow
Write-Host ""
Write-Host "Option 1: Install Chocolatey" -ForegroundColor White
Write-Host "  Run in PowerShell as Admin:" -ForegroundColor Gray
Write-Host "    Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))" -ForegroundColor Gray
Write-Host "  Then run: choco install sshpass -y" -ForegroundColor Gray
Write-Host ""
Write-Host "Option 2: Use WSL (Windows Subsystem for Linux)" -ForegroundColor White
Write-Host "  Run: wsl --install" -ForegroundColor Gray
Write-Host "  Then use the bash script: bash deploy_server.sh" -ForegroundColor Gray
Write-Host ""
Write-Host "Option 3: Set up SSH key authentication" -ForegroundColor White
Write-Host "  Run: ssh-keygen -t rsa" -ForegroundColor Gray
Write-Host "  Then: ssh-copy-id root@72.62.4.119" -ForegroundColor Gray
Write-Host ""
