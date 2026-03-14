#!/bin/bash
# Setup script to authorize SSH key on remote server
# This should be run once to enable passwordless SSH deployment

HOST="72.62.4.119"
USER="root"
PUB_KEY="ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQCyRb0/IqXAb2UahPmTymYLNhemr8DVgcv3a1s12hl94GkwiUCY+0jwK01xFmOklil2ObWfojhWUvIVTGiIOx9yaQyGe9R3VqoodH3n5PSyvBJNfoD/yUpk6iEfOssgKuso/p7yAYo3MU5OmGcorIhGWNg0TjobGkY8vn3mFDpSMIJPBzcpB32NMcJW2R9iLJlwe3PtC50Tt2nHnav1MSE7g1/v3szEN1J9MnDxNKTzMVopDN4tLXu4+nNryizQkh+LMcImvZay/wMLuJ9hSntZLqd8VQq7AI8HddvA45jQ0Ts26GXEVGfyiKpR3V4m38U5/Kl9aHS9Y7K+F6hOK3kevho9RAg4W2rmYPFoz2OtwOSBtzYfhk0+6vSxHzFJgatOfyxoNmPK7xrdQGttXVbDOtBSaS+tm4LQDE0A0gnGwqvJP0doVL8gP0YWhugyjb5Sj1rBk8ODGUjSnBA7n3SPDTVw/LvWs6Nk6HHraoNlHSu7b7OH4pekoartaVu5xdq82HbUHZYKhi9CFKqPVbAw1OGk5puO9YDtrz4QY+NOkA4UtyBgkHV+mAbTti24BvDwBfQMCBWGA4LxqbDZAUJauDD6Rc2DCCGQBS5qYuPtz+1XDlOJ4Z3iCZjc0HeTxvsp6WijrgNGAM1P/G4l5fE/13IY6yMiub7Bgt0J9AxmYQ== deployment@mycrip"

echo "Setting up SSH key authorization..."
echo "You will be prompted for the root password once"
echo ""

# Create .ssh directory and authorized_keys file
ssh -o StrictHostKeyChecking=no "$USER@$HOST" << EOF
mkdir -p ~/.ssh
echo "$PUB_KEY" >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
chmod 700 ~/.ssh
echo "SSH key authorized successfully!"
EOF

if [ $? -eq 0 ]; then
    echo ""
    echo "✓ SSH key setup complete!"
    echo "You can now run: php deploy.php"
else
    echo ""
    echo "✗ Failed to authorize SSH key"
    echo "Please try again or manually add the public key to ~/.ssh/authorized_keys on the server"
    exit 1
fi
