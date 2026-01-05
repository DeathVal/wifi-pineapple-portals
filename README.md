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

### Clone the repository (on your PC)

```bash
git clone https://github.com/DeathVal/wifi-pineapple-portals.git

```
2) Go to the portals folder
cd wifi-pineapple-portals/portals/

3) Copy a portal to your Pineapple (Tetra / Mark VII)
scp -r airport-portal root@172.16.42.1:/root/portals/

4) (Nano) Copy to SD card instead
scp -r airport-portal root@172.16.42.1:/sd/portals/


 Then in Pineapple Web UI:
Modules → Evil Portal → Start → Activate portal

 Note about password

When SCP asks for password:
use your Pineapple root password,



