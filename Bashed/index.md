# **HACKTHEBOX – BASHED WRITEUP**

![](RackMultipart20200926-4-q1zhux_html_7f8027b43c1797f4.png)

# **IP: 10.10.10.68**

# **ENUMERATION**

First, we will run nmap to scan for open ports. The scan returns only port 80 is open.

![](RackMultipart20200926-4-q1zhux_html_e261f87c8adb88ee.png)

Opening the web shows us a simple static website.

# **FOOTHOLD**

I try running gobuster against the website. Because the website says php so I throw an extension flag to try for php files.

![](RackMultipart20200926-4-q1zhux_html_ced422f7f4003fe8.png)

It returns more hidden directories, and the most interesting is &quot;/dev&quot;.

![](RackMultipart20200926-4-q1zhux_html_8c02d67dea5e1833.png)

Opening &quot;/dev&quot; gives us 2 php files. I try opening &quot;phpbash.php&quot;.

![](RackMultipart20200926-4-q1zhux_html_4467e93d16e7529d.png)

It gives us a shell, so I will try a reverse shell.

![](RackMultipart20200926-4-q1zhux_html_51abf3e3d629ab42.png)

We got a shell!

# **USER**

Running the command &quot;sudo -l&quot; as www-data says that we can run as scriptmanager. So we can simply use scriptmanager to run bash to spawn a shell as scriptmanager.

![](RackMultipart20200926-4-q1zhux_html_ef86978fe73817f6.png)

# **ROOT**

After enumerating the box as scriptmanager, there is a directory called &quot;/scripts&quot; which is not default on linux. So I decided to take a look at it.

![](RackMultipart20200926-4-q1zhux_html_788997d12f785861.png)

After running &quot;ls -la&quot;, There is a python script called &quot;test.py&quot; that is ran every minute as root, because it is writing to &quot;test.txt&quot; which is writable by root only. We can just modify &quot;test.py&quot; to something malicious and we can get root.

I decided to put a python reverse shell payload and setup a listener.

![](RackMultipart20200926-4-q1zhux_html_56f35fb30a08038c.png)
