Fix Linux failing to find your headset microphone.
July 30, 2023
Audio devices issues on Linux are rare nowadays. But when they appear, they are non-trivial.

---

### Prelude

I recently made the choice of going back to daily driving Linux, specifically [Linux Mint](https://linuxmint.com/). This has been, mostly, a surprisingly smooth experience, one I wish to write about in the coming weeks.

However, I was stumped by what seemed at first a simple issue: Despite my headset being plugged into the 3.5mm combo jack of my laptop (specifically an ASUS GL553VD), the only audio input detected was the laptop's internal microphone.

In my particular scenario, and perhaps yours too, the solution was by modifying an [ALSA](https://alsa-project.org/wiki/Main_Page) file.

While it is not my intention to turn my personal blog into a generic "how to fix x issue" site, I was very frustrated by how long it took to come to a solution to this issue, so I figured I'd do my part on dumping it on this post.

### Process

While these steps may be distro specific, these worked for me, and I imagine should work for most Debian based distributions.

I'll begin by pointing out: **THIS FIX IS NOT RELEVANT FOR BLUETOOTH DEVICES.**

For starters, I had to figure out what type of sound chip my laptop has.
The command `aplay -l` listed a bunch of things, the first one being the answer:

```
card 0: PCH [HDA Intel PCH], device 0: ALC233 Analog [ALC233 Analog]
Subdevices: 0/1
Subdevice #0: subdevice #0
```

The relevant information being on the first line, `ALC233` is the answer.

Next, you must try to find the codec specific model for your laptop, in [this website](https://www.kernel.org/doc/html/latest/sound/hd-audio/models.html).

Because the naming schemes are rather inconsistent, I can't give suggestions on how to find yours, other than trying to do it by the audio chipset name, the computer's name, or both.

In my case, `alc233-eapd` was the most relevant one, as it contains the name of my chipset, and specifies resolving issues on ASUS machines.
If you fail to find one that looks relevant, you might be able to try using `auto` in it's place.

Next, we must modify the ALSA file mentioned in the prelude, which you must do as superuser.

```
sudo xed /etc/modprobe.d/alsa-base.conf
```
* Xed being the text editor I like to use for anything that isn't code. You may use whatever you want.

Now, go to the end of the file, and add the following two lines.

```
options snd-hda-intel position fix=1
options snd-hda-intel model=<model_name>
```
* where `<model_name>` is the value we found above.

Please note 'snd-hda-intel' may not be the module relevant to your laptop. although it usually is for Intel-based ASUS laptops.

After this, restart your laptop, and check your audio devices to, hopefully, find your headset's audio input.

### Afterwards

Hopefully, your issue is resolved. If that's not the case, I'm afraid I can't offer any further help.

If your issue wasn't resolved:
- Remove those 2 lines to avoid further issues.
- If you find a solution, and wish to have it on this post, tell me: 'me@markski.ar'.