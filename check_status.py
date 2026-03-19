import paramiko
import os

CONFIG = {
    'host': '72.62.4.119',
    'username': 'root',
    'password': 'Mathscrusader123.',
    'port': 8002
}

def check_status():
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    try:
        client.connect(CONFIG['host'], username=CONFIG['username'], password=CONFIG['password'])
        stdin, stdout, stderr = client.exec_command(f"netstat -tuln | grep :{CONFIG['port']}")
        output = stdout.read().decode()
        if output:
            print(f"Server is running on port {CONFIG['port']}")
            print(output)
            
            stdin, stdout, stderr = client.exec_command(f"tail -n 20 /var/log/mycrip-{CONFIG['port']}.log")
            print("\nRecent Logs:")
            print(stdout.read().decode())
        else:
            print(f"Server is NOT running on port {CONFIG['port']}")
            
        client.close()
    except Exception as e:
        print(f"Error: {e}")

if __name__ == '__main__':
    check_status()
