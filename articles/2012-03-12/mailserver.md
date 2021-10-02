## Generalities About Mail Servers

You have just bought your beautiful domain name: doedoe.com.
You'd like very much your new brand email john.john@doedoe.com to be available.
Ok you could use the 10 emails (or about...) accounts that your domain name provider offers... (not very funny...) or... you could configure your own email server, communicating with others mail servers all over the world !

In this post you can read “another” tutorial which will explain to you how to configure from scratch an email server... 
Actually there will be several posts :

1.  Generalities about mail servers
2.  First configuration of your SMTP server : Postfix
3.  First configuration of your IMAP server : Dovecot
4.  Postfix, Dovecot, Mysql, SASL = my secured mail server 

Of course anything you’ll read here has been tested and tested on my servers, but don’t blame me if it doesn’t work on yours... :)

### MUA, MTA and MDA

The principal software on Internet which deals with mails is a MTA ([Mail Transfer Agent](http://en.wikipedia.org/wiki/Mail_Transfer_Agent)). Actually mails travel all over the world between MTAs...
When a mail is sent, at least 2 MTAs intervene : one sends the mail (let’s call it “A MTA”), the second receives it (“B MTA”).
We will configure our mail server either to send mails and receive some.

On one hand (emission part) some client softwares (called MUA for [Mail User Agent](http://en.wikipedia.org/wiki/Mail_User_Agent)) connect to MTA to send emails. But on the other hand (reception part) MUA doesn’t connect to MTA to receive email. The delivery is handled by MDA servers ([Mail Delivery Agent](http://en.wikipedia.org/wiki/Mail_Delivery_Agent)).
To be concise : 

-  a mail is written on a MUA (like Microdoft Outlook or Apple Mail or any other email client software)
-  when you send it the MUA talks to an MTA (“A MTA”)
-  “A MTA” looks for “B MTA” and sends him the email
-  when the mail is received, “B MTA” gives it to its dedicated MDA
-  someone connect with a MUA to the MDA to read the mail you sent 


In following posts, you’ll learn how to configure A and B MTAs, and a MDA.
We will use a real operating system dedicated to servers : “Debian” (the last one Debian Squeeze).

-  Postfix will be our MTA
-  And Dovecot the MDA.

### Mail is nothing without DNS

Why DNS (Domain Name System) is important ? In the mail travelling process explained before I wrote “A MTA” looks for “B MTA”. How does this work ?
“A MTA” has to sen an email to john.john@doedoe.com
he makes a DNS query to know the name of the email server dealing with doedoe.com emails, that means “A MTA” wants to know “MX records” of doedoe.com domain name.
this query returns for instance email server name : smtp.doedoe.com (in our story “B MTA).
after another DNS query “A MTA” obtains the IP address of “B MTA” and the mail is sent, with SMTP (Simple Mail Transfert Protocol)

From Paul.