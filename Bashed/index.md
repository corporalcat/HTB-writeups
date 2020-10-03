<html>
  <head>
    <style>
      body{
      background-color: black;
      color: white;
      }
    </style>
  </head>
  <body>
<div markdown="1">
<h1 id="-hackthebox-bashed-writeup-"><strong>HACKTHEBOX – BASHED WRITEUP</strong></h1>
<p><img src="image001.jpg" alt=""></p>
<h1 id="-ip-10-10-10-68-"><strong>IP: 10.10.10.68</strong></h1>
<h1 id="-enumeration-"><strong>ENUMERATION</strong></h1>
<p>First, we will run nmap to scan for open ports. The scan returns only port 80 is open.</p>
<p><img src="image002.png" alt=""></p>
<p>Opening the web shows us a simple static website.</p>
<h1 id="-foothold-"><strong>FOOTHOLD</strong></h1>
<p>I try running gobuster against the website. Because the website says php so I throw an extension flag to try for php files.</p>
<p><img src="image003.png" alt=""></p>
<p>It returns more hidden directories, and the most interesting is &quot;/dev&quot;.</p>
<p><img src="image004.jpg" alt=""></p>
<p>Opening &quot;/dev&quot; gives us 2 php files. I try opening &quot;phpbash.php&quot;.</p>
<p><img src="image005.jpg" alt=""></p>
<p>It gives us a shell, so I will try a reverse shell.</p>
<p><img src="image006.png" alt=""></p>
<p>We got a shell!</p>
<h1 id="-user-"><strong>USER</strong></h1>
<p>Running the command &quot;sudo -l&quot; as www-data says that we can run as scriptmanager. So we can simply use scriptmanager to run bash to spawn a shell as scriptmanager.</p>
<p><img src="image007.jpg" alt=""></p>
<h1 id="-root-"><strong>ROOT</strong></h1>
<p>After enumerating the box as scriptmanager, there is a directory called &quot;/scripts&quot; which is not default on linux. So I decided to take a look at it.</p>
<p><img src="image008.png" alt=""></p>
<p>After running &quot;ls -la&quot;, There is a python script called &quot;test.py&quot; that is ran every minute as root, because it is writing to &quot;test.txt&quot; which is writable by root only. We can just modify &quot;test.py&quot; to something malicious and we can get root.</p>
<p>I decided to put a python reverse shell payload and setup a listener.</p>
<p><img src="image009.png" alt=""></p>
<p>We got root!</p>
</div>
</body>
</html>
