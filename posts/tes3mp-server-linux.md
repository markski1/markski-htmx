Deploying a TES3MP server on a Linux VPS
May 2, 2023
Using a Linux VPS to easily host a TES3MP server.

---

### Prelude
TES3MP is a fork of OpenMW, a drop-in engine replacement for TES: Morrowind.

In this page, I'll guide you through the process of setting up a dedicated TES3MP server on any VPS running a (hopefully any) Debian-based Linux distribution. I will be using Ubuntu 22.04, and we will set it up in such a way that it'll run as a systemd service.


### Prerequisites
- A VPS with at least 512mb of ram and around 1 gig of free drive space.
- A debian-based distribution.
- Patience. This should not take more than half an hour, but who knows.


### The process
Begin by installing the dependencies for the TES3MP server. Then, create a folder we can work in, I'd suggest just calling it tes3mp.

```
sudo apt-get install luajit liblua5.1 libluajit-5.1
mkdir tes3mp
cd tes3mp
```

Then, proceed to grab the [latest TES3MP server binaries](https://github.com/TES3MP/TES3MP/releases) (VR versions don't count).

As of the day of me writing this (May 2nd, 2023), 0.8.1 are the latest version, and we'd use the following commands to fetch them:

```
wget https://github.com/TES3MP/TES3MP/releases/download/tes3mp-0.8.1/tes3mp-server-GNU+Linux-x86_64-release-0.8.1-68954091c5-6da3fdea59.tar.gz
```

Once it's been downloaded, I'd suggest renaming it to something more friendly (perhaps tes3mp-server.tar.gz).

Now, we will be grabbing a bash script to do the initial set up for us. It'll unzip the files we just downloaded, create a new user (I'll call it tes3mp, but you can call it whatever you want), put everything in `opt/TES3MP`, and create a systemd service for the server.

In order, these 3 commands will: Download the bash script, make it executable, and run it as super user, providing the name of the server files, and a desired username for a dedicated user account.

```
wget https://gist.githubusercontent.com/markski1/c3d63ef32c9c07cbee6da2708f3406e5/raw/bc142e51295c5de6108faabcb7256039db98128e/ubuntu_tes3mp_deploy.sh
chmod +x ubuntu_tes3mp_deploy.sh
sudo ./ubuntu_tes3mp_deploy.sh tes3mp-server.tar.gz tes3mp
```

Next, you will want to open ports 25565 <small>(yes, the minecraft port)</small> for the game server, and 25561 for the master list. Assuming a standard Ubuntu server, simply do it with ufw.

```
sudo ufw allow 25565
sudo ufw allow 25561
```

### Settings
Your server is now set up and ready to run.

Please refer to [this steam guide](https://steamcommunity.com/groups/mwmulti/discussions/1/133258593388999187/) by TES3MP's lead dev himself, explaining all the things you can and should set up.

Remember: Your server files are in 'opt/TES3MP'!

To start the server, use `sudo systemctl start tes3mp`
