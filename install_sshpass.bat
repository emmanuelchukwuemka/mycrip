@echo off
echo ========================================
echo Installing sshpass for Windows
echo ========================================

REM Check if winget is available
where winget >nul 2>nul
if %ERRORLEVEL% EQU 0 (
    echo Using winget to install sshpass...
    winget install -e --id hraban.sshpass --accept-source-agreements --accept-package-agreements
    if %ERRORLEVEL% EQU 0 (
        echo.
        echo sshpass installed successfully!
        echo.
    ) else (
        echo.
        echo Winget installation failed. Trying alternative method...
        goto manual_install
    )
) else (
    echo winget not found. Trying alternative method...
    goto manual_install
)

goto :done

:manual_install
echo.
echo ========================================
echo Manual Installation Instructions:
echo ========================================
echo.
echo Option 1: Install via scoop (if you have scoop)
echo   scoop install sshpass
echo.
echo Option 2: Download sshpass manually
echo   1. Download from: https://sourceforge.net/projects/sshpass/files/
echo   2. Extract sshpass.exe to a folder in your PATH
echo   3. Or place it in C:\Windows\System32\
echo.
echo Option 3: Use Windows Subsystem for Linux (WSL)
echo   1. Install WSL: wsl --install
echo   2. Run the script from WSL: bash deploy.sh
echo.
echo Option 4: Set up SSH key authentication
echo   1. Generate key: ssh-keygen -t rsa
echo   2. Copy to server: ssh-copy-id root@72.62.4.119
echo   3. Then modify deploy_to_server.ps1 to remove password
echo.

:done
echo.
echo After installation, run:
echo   powershell -ExecutionPolicy Bypass -File deploy_to_server.ps1
echo.
pause
