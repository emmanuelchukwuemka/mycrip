# Deployment Guide

This guide explains how to deploy your Laravel project to the server without port conflicts.

## Prerequisites

### On Your Local Machine (Windows)
- **PowerShell 5.0+** (built-in on Windows 10+)
- **OpenSSH Client** (built-in on Windows 10 1803+) OR PuTTY
- **Git** (optional, if using direct repo deployment)

To check if OpenSSH is installed:
```powershell
ssh -V
```

If not installed, add it via Windows Features or install Git for Windows.

### On Remote Server
- SSH access with root privileges
- PHP 8.0+ with composer
- Node.js (optional, for frontend builds)
- MySQL/PostgreSQL (for database)
- Nginx or Apache (for routing to different ports)

---

## Quick Start

### Option 1: Using PowerShell Script (Recommended for Windows)

1. **First time setup - Generate SSH key** (if you don't have one):
   ```powershell
   ssh-keygen -t rsa -b 4096 -f $env:USERPROFILE\.ssh\id_rsa
   ssh-copy-id -i $env:USERPROFILE\.ssh\id_rsa.pub root@72.62.4.119
   ```

2. **Run the deployment script**:
   ```powershell
   # Navigate to your project
   cd c:\xampp\htdocs\mycrip
   
   # Run deployment
   .\deploy.ps1 -RemoteHost "72.62.4.119" -RemoteUser "root" -AppName "mycrip"
   ```

3. **With Git repository**:
   ```powershell
   .\deploy.ps1 -RemoteHost "72.62.4.119" -RemoteUser "root" -AppName "mycrip" -GitRepo "https://github.com/yourname/mycrip.git"
   ```

---

### Option 2: Manual SSH + Bash Script

1. **Copy the bash script to your server**:
   ```powershell
   scp deploy.sh root@72.62.4.119:/root/
   ```

2. **SSH into your server**:
   ```powershell
   ssh root@72.62.4.119
   ```

3. **Run the deployment script on the server**:
   ```bash
   chmod +x ~/deploy.sh
   ~/deploy.sh 8000 8100 mycrip "https://github.com/yourname/mycrip.git"
   ```

   **Parameters**:
   - `8000` - Start port (default: 8000)
   - `8100` - End port (default: 8100)
   - `mycrip` - App name
   - `https://...git` - Git repository URL (optional)

---

## What The Scripts Do

### Port Discovery
Both scripts automatically:
1. Scan ports 8000-8100 on your server
2. Find the first available port
3. Deploy to that port to avoid conflicts

### Deployment Steps
1. ✅ Find available port
2. ✅ Create deployment directory
3. ✅ Clone/pull latest code
4. ✅ Copy `.env.example` to `.env`
5. ✅ Run `composer install`
6. ✅ Generate application key
7. ✅ Set file permissions
8. ✅ Run database migrations
9. ✅ Clear application cache
10. ✅ Start the application

---

## Configuration

### Modify Port Range
Edit the script to change the port scanning range - look for `$StartPort` and `$EndPort`:

**PowerShell**:
```powershell
.\deploy.ps1 -StartPort 9000 -EndPort 9100
```

**Bash**:
```bash
./deploy.sh 9000 9100 mycrip
```

### Custom Environment Variables
Before deployment, edit your `.env` file with:
- Database credentials
- Mail configuration
- API keys
- etc.

---

## Production Setup with Nginx

After deployment, configure Nginx to route requests to your app's port.

### Example Nginx Config
```nginx
upstream mycrip_backend {
    server 127.0.0.1:8050;  # Replace with your assigned port
}

server {
    listen 80;
    server_name yourdomain.com;
    
    location / {
        proxy_pass http://mycrip_backend;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

---

## Process Management

### Using PM2 (Node.js Process Manager)

Install on server:
```bash
npm install -g pm2
```

The bash script will automatically use PM2 if installed.

### Using Supervisor

Create a supervisor config file at `/etc/supervisor/conf.d/mycrip-PORT.conf`:

```ini
[program:mycrip-8050]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/mycrip-8050/artisan serve --host=0.0.0.0 --port=8050
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/log/supervisor/mycrip-8050.log
```

Then restart supervisor:
```bash
supervisorctl reread
supervisorctl update
supervisorctl start mycrip-8050:*
```

---

## Troubleshooting

### SSH Connection Issues
```powershell
# Test SSH connection
ssh -v root@72.62.4.119

# If password auth fails, generate SSH key first:
ssh-keygen -t rsa -b 4096
ssh-copy-id root@72.62.4.119
```

### Port Already in Use
The script scans 8000-8100. If all ports are taken:
1. Check running processes: `netstat -tuln | grep LISTEN`
2. Stop unused services
3. Extend the port range in the script

### Composer/PHP Issues
Ensure PHP and Composer are installed on the server:
```bash
php -v
composer --version
```

### Database Connection
Make sure your `.env` has correct database credentials:
```bash
# On server, after deployment
cd /var/www/mycrip-PORT
php artisan tinker # Test database connection
```

---

## Viewing Logs

### Application Logs
```bash
tail -f /var/www/mycrip-PORT/storage/logs/laravel.log
```

### PM2 Logs
```bash
pm2 logs mycrip-8050
```

### Supervisor Logs
```bash
tail -f /var/log/supervisor/mycrip-8050.log
```

---

## Cleanup & Management

### List All Deployments
```bash
ls -la /var/www/ | grep mycrip
```

### Stop a Deployment
```bash
pm2 stop mycrip-8050
# or
supervisorctl stop mycrip-8050
```

### Remove Old Deployment
```bash
rm -rf /var/www/mycrip-8050
```

---

## Security Notes

⚠️ **Important**:
1. Never commit `.env` file to Git
2. Rename `deploy.ps1` or Move to a safe location
3. Consider SSH key authentication instead of passwords
4. Set proper file permissions: `chmod 755` for directories, `chmod 644` for files
5. Keep Laravel and dependencies updated

---

## Support

For issues or questions:
1. Check the logs in `/var/www/mycrip-PORT/storage/logs/`
2. Test database connectivity
3. Verify PHP version compatibility
4. Check available disk space and memory

Good luck with your deployment! 🚀
