# Quick Deployment Reference

## One-Line Deployment

### First Time Setup
```powershell
.\deploy.ps1
```

This will:
- Use default settings (port 8000-8100)
- Connect to 72.62.4.119
- Find the next available port
- Deploy your app

### With Custom Port Range
```powershell
.\deploy.ps1 -StartPort 9000 -EndPort 9100
```

### With Git Repository
```powershell
.\deploy.ps1 -GitRepo "https://github.com/username/mycrip.git"
```

---

## If SSH Key Not Configured

First time only:
```powershell
# Generate SSH key (press Enter for all prompts)
ssh-keygen -t rsa -b 4096

# Copy key to server (will prompt for password)
ssh-copy-id root@72.62.4.119
```

After this, password won't be needed.

---

## Alternative: Direct Server Script

1. **Copy script to server**:
   ```powershell
   scp deploy.sh root@72.62.4.119:~/
   ```

2. **Run on server**:
   ```powershell
   ssh root@72.62.4.119 "chmod +x ~/deploy.sh && ~/deploy.sh"
   ```

---

## Check Deployed Apps

```powershell
# List all running ports
ssh root@72.62.4.119 "netstat -tuln | grep LISTEN"

# Check specific app
ssh root@72.62.4.119 "curl http://localhost:8050"
```

---

## View Logs

```powershell
# Real-time logs
ssh root@72.62.4.119 "tail -f /var/www/mycrip-8050/storage/logs/laravel.log"

# Last 50 lines
ssh root@72.62.4.119 "tail -50 /var/www/mycrip-8050/storage/logs/laravel.log"
```

---

## Troubleshooting

**PowerShell Error: "cannot be loaded because running scripts is disabled"**
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

**SSH not found**
- Windows 10/11: Built-in, should work
- Windows 7/8: Install Git for Windows
- Alternative: Use PuTTY with manual setup

**Deployment fails at composer**
- Server may not have composer installed
- SSH and run: `curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer`

**Port conflict errors**
- Check occupied ports: `netstat -tuln`
- Increase port range (modify scripts)
- Stop conflicting application

---

## What Gets Created

After deployment:
```
/var/www/mycrip-8050/
├── app/
├── bootstrap/
├── composer.json
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env          ← Configuration
└── artisan       ← CLI tool
```

Access at: `http://72.62.4.119:8050`

---

## Common Commands After Deployment

SSH to server:
```powershell
ssh root@72.62.4.119
```

Into your app:
```bash
cd /var/www/mycrip-8050
```

Run artisan commands:
```bash
php artisan migrate
php artisan cache:clear
php artisan queue:work
```

---

## Production Checklist

- [ ] Set `.env` APP_DEBUG=false
- [ ] Configure database in `.env`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Set up Nginx/Apache proxy
- [ ] Configure SSL certificate
- [ ] Set up PM2/Supervisor
- [ ] Configure firewall rules
- [ ] Test application access
- [ ] Set up database backups
- [ ] Configure logging

---

Need more info? See `DEPLOYMENT_GUIDE.md`
