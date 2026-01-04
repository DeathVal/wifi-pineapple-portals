# WiFi Pineapple Portal Collection (MK7)

**wifi-pineapple-portals** is a collection of captive portal templates that can be loaded into the **Portal / Captive Portal module** on the **Hak5 WiFi Pineapple**.

These portals are intended for:
- Authorized captive portal deployments on networks you own
- Security awareness demonstrations
- Internal testing and training environments

> ⚠️ **Authorized Use Only**
> Use these portals only on networks where you have explicit permission to test.  
> Do not use for phishing, credential theft, or any unauthorized activity.


## Requirements

- Hak5 WiFi Pineapple **Mark VII (MK7)**
- Portal / Captive Portal module installed (via Pineapple web UI)
- SSH/SFTP access enabled (default on Pineapple)



## Tested Devices

 WiFi Pineapple **MK7** (Mark VII)  
*(Other models may work but are not officially tested.)*



## Usage

### 1) Clone the repository (on your PC)

```bash
git clone https://github.com/DeathVal/wifi-pineapple-portals.git


### 2) Change directory to the portals folder
cd wifi-pineapple-portals/Portals/

### 3) Copy the portal(s) you want to your Pineapple (MK7)

Most common portal directory on the Pineapple:

/root/portals/


Example using scp (from your PC):

scp -r Airport root@172.16.42.1:/root/portals/


You can repeat for other portals:

scp -r Hotel root@172.16.42.1:/root/portals/
scp -r Cafe root@172.16.42.1:/root/portals/

Upload using FileZilla (SFTP)

You can also use FileZilla to upload portals using SFTP.

Connection settings:

Host: sftp://172.16.42.1

Username: root

Password: (your WiFi Pineapple root password)

Port: 22

After connecting, upload portal folders to:

/root/portals/


Example:

/root/portals/Airport/
/root/portals/Hotel/
/root/portals/Cafe/

