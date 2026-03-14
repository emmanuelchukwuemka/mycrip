#!/usr/bin/env powershell
# Setup script to authorize SSH key on remote server
# This should be run once to enable passwordless SSH deployment

$Host_IP = "72.62.4.119"
$User = "root"
$PubKey = @'
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQCyRb0/IqXAb2UahPmTymYLNhemr8DVgcv3a1s12hl94GkwiUCY+0jwK01xFmOklil2ObWfojhWUvIVTGiIOx9yaQyGe9R3VqoodH3n5PSyvBJNfoD/yUpk6iEfOssgKuso/p7yAYo3MU5OmGcorIhGWNg0TjobGkY8vn3mFDpSMIJPBzcpB32NMcJW2R9iLJlwe3PtC50Tt2nHnav1MSE7g1/v3szEN1J9MnDxNKTzMVopDN4tLXu4+nNryizQkh+LMcImvZay/wMLuJ9hSntZLqd8VQq7AI8HddvA45jQ0Ts26GXEVGfyiKpR3V4m38U5/Kl9aHS9Y7K+F6hOK3kevho9RAg4W2rmYPFoz2OtwOSBtzYfhk0+6vSxHzFJgatOfyxoNmPK7xrdQGttXVbDOtBSaS+tm4LQDE0A0gnGwqvJP0doVL8gP0YWhugyjb5Sj1rBk8ODGUjSnBA7n3SPDTVw/LvWs6Nk6HHraoNlHSu7b7OH4pekoartaVu5xdq82HbUHZYKhi9CFKqPVbAw1OGk5puO9YDtrz4QY+NOkA4UtyBgkHV+mAbTti24BvDwBfQMCBWGA4LxqbDZAUJauDD6Rc2DCCGQBS5qYuPtz+1XDlOJ4Z3iCZjc0HeTxvsp6WijrgNGAM1P/G4l5fE/13IY6yMiub7Bgt0J9AxmYQ== deployment@mycrip
'@

Write-Host "Setting up SSH key authorization..." -ForegroundColor Green
Write-Host "You will be prompted for the root password once" -ForegroundColor Yellow
Write-Host ""

# Build the remote command
$RemoteCmd = @"
mkdir -p ~/.ssh && `
echo '$PubKey' >> ~/.ssh/authorized_keys && `
chmod 600 ~/.ssh/authorized_keys && `
chmod 700 ~/.ssh && `
echo '[SUCCESS] SSH key authorized!'"
"@

# Execute the command on the remote server
try {
    & ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null "$User@$Host_IP" $RemoteCmd
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host ""
        Write-Host "✓ SSH key setup complete!" -ForegroundColor Green
        Write-Host "You can now run: php deploy.php" -ForegroundColor Cyan
    } else {
        throw "SSH command failed"
    }
} catch {
    Write-Host ""
    Write-Host "✗ Failed to authorize SSH key" -ForegroundColor Red
    Write-Host "Please try again or manually add the public key to ~/.ssh/authorized_keys on the server" -ForegroundColor Yellow
    exit 1
}
