## Supporting iOS 5 New Emoji Encoding

__Updated on 2012/10/29:__ Emojis added on iOS 6 break this solution! Read what you should do to [really support emojis on any iOS!](/2012/10/29/supporting-new-emojis-on-ios-6)

* * * * *

![Emojis](emojis.png)

### Roger, Meon has a bug

Started with [Meon 1.0](http://itunes.apple.com/app/meon/id400274934?mt=8) on iPhone, players can post their highscores when playing TimeAttack. Since the beginning, we wanted to give also this possibility to gamers that haven't Game Center activated on their phone. So, in parallel to posting their highscores on Game Center, we also post their scores to our web server.

Our highscores web service is very simple. It's basically a `POST`, with a `username` and a `scorevalue` parameter. Given that Meon is played worldwide, the `username` can contain any character set, from simple English to Korean. 

And, of course, can also contain [emojis](http://en.wikipedia.org/wiki/Emoji)!

On iOS <= 4.x, everything was fine. We encoded user's name in UTF8, sent a `POST` to our server, registered this score in our MySQL database (also in UTF8)... Sending and retrieving players’name, even those containing emojis, was flawless. 

On iOS 5, we found a strange bug. All username with emojis were retrieved from the server without any emoji! If you sent a score with the name “Toto the best <img src="smile-emoji.png" class="inline" />”, the name displayed in the highscores view was simply “Toto the best”. And if you name began with an emoji (“<img src="frog-emoji.png" class="inline" />The Frog”), the displayed username was simply ... Nothing!

This was a bug, and forced by _Manbolo Zero Bug's Policy_, we had to kill it.

### The route to debug

Solving this kind of bug, where an app client and a server are involved, is never simple. The first thing to do is to identify if the bug is on the client, on the server, or on both side! On the server side, we have switched few months ago from MySQL 5.5 to [MariaDB](http://mariadb.org/). To debug, we quickly reverted to MySQL 5.5 on our server, and checked that the bug was still here: sending name from a iOS 5 iPhone and getting it back, all emojis were still removed.

So MariaDB was not the guilty. 

Then we tested the scenario with an iOS 4.x device. With this phone, everything worked fine, emojis were sent and retreived without any problem. Hum... We launched Xcode to see what the debugger could find.

We tested sending a score with the username “Alien<img src="alien-emoji.png" class="inline" />”. On iOS 4, the raw bytes of the `NSString` content was:

    ... 41 6c 69 65 6e ee 84 8c

where `41`=“A”, `6c`=“l”, `69`=“i”, `65`=“e”, `6e`=“n” and `ee 84 8c`=“<img src="alien-emoji.png" class="inline" />”. On iOS 4, this alien emoji was coded on 3 bytes.

On iOS 5, the same string was coded like this:

    ... 41 6c 69 65 6e f0 9f 91 bd

This time, our little alien emoji occupied 4 bytes (`f0 9f 91 bd`)! Hum hum... Very strange... Going back to our MySQL server, we looked at the saved username, in the two configurations. While the iOS 4 encoded string seemed to be good, the iOS 5 string was truncated at the emoji position. OK, things were a little clearer. Some Google searches and we learned some things about emoji.

### Finally...

Beginning with iOS 5, Apple has changed the encoding for emoji. With previous versions of the OS, emojis were encoded using Softbank/Vodafone mapping. With iOS 5, Apple switched to an unified mapping, 
using Unicode Standard v6.0. The standard contains a shared proposal by Google and Apple to align and use a common character set for the emojis. That's way, user can send SMS containing emojis, from an Android to an iPhone, without any character losses! That's why our little alien emoji is coded now using 4 bytes instead of 3 on iOS 4.

Whereas the 3 bytes emojis were stored without any problem on our MySQL database, the 4 bytes were truncated. [As suggested here](http://mzsanford.wordpress.com/2010/12/28/mysql-and-unicode/), setting the encoding of the username to the new character set `utf8mb4` didn't solve the problem. Searching on the MySQL forum, we found [this post](http://forums.mysql.com/read.php?103,434779,435129#msg-435129) that explained our bug:

> If I understand correctly, you're inserting 
> the emoji character U+01F433 Spouting Whale. 
> This will not cause an error because the 
> code is valid, but we consider it unassigned. 
> Emoji is part of Unicode 6, which we don't 
> claim to support. So potential future 
> problems, for example with conversion to 
> other character sets or with index ordering, 
> may be answered with the words 'not a bug'. 
> 
> 
> Peter Gulutzan 
> MySQL / Oracle

Well, OK. So it seems that the solution was to save the username using the old 3 bytes/Softbank encoding. Doing with, we could even do the conversion on the server side, without requiring any update to the client. On github, we found this [interesting piece of php code](https://github.com/iamcal/php-emoji) that performs emojis conversions to-and-from various mapping. Using it, each time we get a highscore from Meon, we perform a Unicode-6-to-Softbank conversion on emojis and store them in our MySQL database. And our bug is solved!

Thanks to [Cal Henderson](http://www.iamcal.com/emoji-in-web-apps/) for having shared the emoji conversion code! That was a pretty interesting debugging journey and, now, you can use emoji in your name...

From jc.
