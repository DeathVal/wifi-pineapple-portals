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

```
2) Go to the portals folder
```bash
cd wifi-pineapple-portals/portals/
```

4) Copy a portal to your Pineapple (Mark VII)
```bash
scp -r airport-portal root@172.16.42.1:/root/portals/
```
5) (Nano) Copy to SD card instead
```bash
scp -r airport-portal root@172.16.42.1:/sd/portals/
```

 Then in Pineapple Web UI:
Modules → Evil Portal → Start → Activate portal

 Note about password

When SCP asks for password:
use your Pineapple root password,


Screenshots

<img width="1545" height="794" alt="Screenshot 2026-01-06 122638" src="https://github.com/user-attachments/assets/5efa26d7-0b53-4b95-8ec9-943cd9f859f9" />
<img width="550" height="1230" alt="Screenshot 2026-01-06 122727" src="https://github.com/user-attachments/assets/77ccde1b-f836-4412-ada6-3dc486d452ec" />


