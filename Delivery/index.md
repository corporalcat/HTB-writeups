
# Hackthebox - Delivery
### IP: 10.129.59.190

First, I ran Nmap to scan for open ports on the box.
Nmap results:
![](Pasted%20image%2020210615193712.png)

HTTP has a wider attack surface so I am enumerating it first.
Opening the page gives us a static html page.
![](Pasted%20image%2020210615193922.png)

While browsing the page, I found 2 new web pages in the machine which are **helpdesk.delivery.htb** and **delivery.htb**.  After adding them to my /etc/hosts file, I can access those 2 pages.

helpdesk.delivery.htb:
![](Pasted%20image%2020210615195033.png)

delivery.htb:
![](Pasted%20image%2020210615195120.png)

We can get an account to login by opening a ticket on the helpdesk.
![](Pasted%20image%2020210615202233.png)

The helpdesk will give us an email with the machine's domain.
![](Pasted%20image%2020210615202254.png)

Then we can register the email on the **delivery.htb** page.

![](Pasted%20image%2020210615202337.png)

Verify the email address.
![](Pasted%20image%2020210615202449.png)

Then login to Mattermost. After logging in to Mattermost, you can see a channel called internal which leaked a password for the user **maildeliverer**.
![](Pasted%20image%2020210615195714.png)

you can ssh with those credentials and got the user.txt.

![](Pasted%20image%2020210615195805.png)

Now for the privesc, the internal channel on the mattermost page gives us a hint on the root password which is a variant of **PleaseSubscribe!**. We can use hashcast to perform a rule based attack on this password.
the password.txt contains "PleaseSubscribe!" and we are using the best64.rule for the rules.
![](Pasted%20image%2020210615201242.png)

Now we can bruteforce su to switch to root. I am using this tool called su-bruteforce(https://github.com/carlospolop/su-bruteforce).

I host the passowrd list and the tool on a python web server.
![](Pasted%20image%2020210615201755.png)

Then I curl the files to the box.
![](Pasted%20image%2020210615201746.png)

Run the tool and you will get a successful password.
![](Pasted%20image%2020210615201956.png)

Switch to the root user and got the root flag.

![](Pasted%20image%2020210615202059.png)
