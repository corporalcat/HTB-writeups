
# Hackthebox - Passage

First I run Nmap. Nmap result:
![](nmap.png)

Port 80 which is HTTP is open, so I open the webpage and got this.
![](webpage.png)

Clicking on the article shows that you are sending a GET request with the id parameter. AFter trying a bunch of SQL Injection stuff, none of the work. Then I notice that the website says that it is powered by **CuteNews**.
![](cutenews.png)

I search for an exploit for CuteNews and found an exploit for version 2.1.2 (https://www.exploit-db.com/exploits/48800). I try to enumerate the CuteNews version for the box but I can't find it. I try going to the CuteNews official webpage (https://cutephp.com/cutenews/changelog.php) and according to its changelog, version 2.1.2 is the latest version. So the exploit is probably going to work.
![](cutenewschangelog.png)

Looking through the exploit script, it looks like uploading a php command execution file with an image magic bytes.
![](gif8php.png)

Then it registers a new user and upload the payload as an avatar.
![](avatar.png)

After understanding how the exploit works, I execute the script and got a shell as **www-data**.
![](shellwww.png)

The problem is the shell is not persistent, so I use a bash reverse shell command and get a persistent reverse shell.
![](bash-c.png)

Setup a listener and got the shell.
![](bashrevshell.png)

Next, the exploit script also have a function called "extract_credentials". It goes to a file which contains the user object encoded in base64. The function decoded and gives us the hashes of the users password.
![](hashes.png)

I go to https://crackstation.net/ to crack the hashes and got 2 potential passwords.
![](passcracked.png)

I try to identify which hash belongs to which user, so I go to the URL where the users object is located, base64 decode it and try to find the username. I use CyberChef to decode it and got that the password "atlanta1" belongs to the user "paul". So I switch to the user paul and got the user flag.
![](userflag.png)

The user Paul has an SSH key in the **.ssh** directory, and an SSH session will always be better thanmy current reverse shell. But when I look at the keys, it belongs to nadav which is another user in the box. So I SSH in to the box as the user nadav.
![](sshnadav.png)

Now I need to enumerate as the user nadav, so I use linpeas, but I didn't get anything interesting. So I started to poke around and then I notice the **.viminfo** file is not empty.

![](viminfo.png)

Looking at the content, there is USBCreator.
![](usbcreator.png)

After searching a bit, I find this article (https://unit42.paloaltonetworks.com/usbcreator-d-bus-privilege-escalation-in-ubuntu-desktop/) that shows how to privesc with USBCreator. Basically, you can copy any file regardless of who owns it to anywhere you want. So I copied root's SSH key to nadav's home directory.
![](usbcreatorcopy.png)

SSH into the box as root and got the root flag.
![](rooted.png)
