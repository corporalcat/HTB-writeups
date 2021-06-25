# Hackthebox - Ready

FIrst I run Nmap to scan for open ports.
Nmap result:
![](nmap.png)

There is HTTP on port 5080, So I open the web page and got this page.
![](webpage.png)

There is an admin directory based on robots.txt from the Nmap result. I try accessing it but just got an error saying that I need to sign in first.
![](signinerror.png)

So next I register an account and log in.
![](loggedin.png)

There is 1 public project on the server, so I try accessing it.
![](projectdrupal.png)

It looks like a web project using Drupal. But the files are not really hosted in a web server so I can't exploit the php files in the project.

Next I try enumerating the version of the Gitlab by accessing the **/help**, it tells us that it is version **11.4.7**.
![](gitlabversion.png)

It says that it needs to be updated ASAP. So there must be an exploit to this version of Gitlab. So I started searching and found an exploit (https://github.com/jas502n/gitlab-SSRF-redis-RCE) which leads to RCE.

I use Burpsuite to craft the payload. I command the server to curl to my machine.
![](burpsuitecurl.png)

I send the request and I got a hit to my machine.
![](curled.png)

After confirming the payload works, now I craft a payload for a reverse shell.
![](revshellpayload.png)

I setup a listener, send the request and got a reverse shell as the user git.
![](usergit.png)

Next, I try running linpeas to enumerate for privilege escalation vectors. Linpeas tells me that I am in a docker container.
![](container.png)

It also tells me there is a backup directory in /opt which is unusual.
![](optbackup.png)

Searching through the backup directory, I got a password from the **gitlab.rb** file.
![](password.png)

I try switching to root and it worked.
![](dockerroot.png)

But right now, i am just root in a docker container, so I run linpeas again for enumeration.
![](sda.png)
 Linpeas tells me that **/dev/sda** which is a hard disk is present, After researching a bit, I find an article (https://book.hacktricks.xyz/linux-unix/privilege-escalation/docker-breakout#i-own-root) that talks about how to break out of containers which also have /dev/sda present. So I follow the article and run the commands and got the root flag.
 ![](rooted.png)
 
 If you want to get a root shell, you can take the SSH key of root
 ![](rootssh.png)
 
 Gives the key the proper permission.
 ![](chmod.png)
 
 SSH into the box and got a shell as root.
 ![](ssh.png)