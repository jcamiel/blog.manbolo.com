## Best Heartbleed Explanation Ever

[Best Heartbleed explanation ever by xkcd:][]

![HeartBleed explanation][]

Links:

[The Heartbleed Bug]:    
 > The Heartbleed bug allows anyone on the Internet to read the memory of the systems 
 > protected by the vulnerable versions of the OpenSSL software. This compromises 
 > the secret keys used to identify the service providers and to encrypt the traffic, 
 > the names and passwords of the users and the actual content. This allows attackers 
 > to eavesdrop on communications, steal data directly from the services and users
 > and to impersonate services and users.

[Answering the Critical Question: Can You Get Private SSL Keys Using Heartbleed?][]: TL;DR Yes.

[The Heartbleed Challenge][]:    
> We confirmed that both of these individuals have the private key and that it 
> was obtained through Heartbleed exploits.

[Test your server for Heartbleed (CVE-2014-0160)][] 

[Heartbleed by Bruce Schneier][]:    
> "Catastrophic" is the right word. On the scale of 1 to 10, this is an 11.

[What Heartbleed Can Teach The OSS Community About Marketing][]:    
> I want to take a moment to point at the marketing aspects of it: how
> the knowledge about Heartbleed managed to spread within a day and move,
> literally, hundreds of thousands of people to remediate the problem.    
>     
> Heartbleed is much better marketed than typical for the OSS community, principally
> because it has a name, a logo, and a dedicated web presence.

[Critical crypto bug exposes Yahoo Mail, other passwords Russian roulette-style][]:    
> All of this means that applying the OpenSSL patch is only the starting point
> on the multi-step path of Heartbleed recovery. Website operators should strongly
> consider replacing their X.509 certificates after applying the update and getting
> all users and administrators to change passwords as well. While it's possible that
> none of this data has been compromised, there's no way to rule it out, either.

[Wild at Heart: Were Intelligence Agencies Using Heartbleed in November 2013?][]:    
> A lot of the narratives around Heartbleed have viewed this bug through a worst-case lens,
> supposing that it might have been used for some time, and that there might be tricks
> to obtain private keys somewhat reliably with it. At least the first half of that scenario
> is starting to look likely.

[Using Heartbleed PoC for Hijacking User Sessions En Masse][]:    
> Matthew Sullivan posted a blog post earlier today about using CVE-2014-0160
> to hijack user sessions from vulnerable servers. I altered the proof of concept 
> code written by Jared Stafford to continuously query a given server for memory 
> chunks and parse those chunks for session ids. 

[Critical crypto bug in OpenSSL opens two-thirds of the Web to eavesdropping][]:    
> The researchers who discovered the vulnerability, however, were less optimistic 
> about the risks, saying the bug makes it possible for attackers to surreptitiously
> bypass virtually all TLS protections and to retrieve sensitive data residing 
> in the memory of computers or servers running OpenSSL-powered software.    
>      
> "We attacked ourselves from outside, without leaving a trace," they wrote. 
> "Without using any privileged information or credentials we were able steal 
> from ourselves the secret keys used for our X.509 certificates, 
> user names and passwords, instant messages, emails and business 
> critical documents and communication."

[Heartbleed Bug: What Can You Do?][]:    
> Finally, given the growing public awareness of this bug, it’s probable 
> that phishers and other scam artists will take full advantage of the 
> situation. Avoid responding to emailed invitations to reset your password; 
> rather, visit the site manually, either using a trusted bookmark or 
> searching for the site in question.

[How to protect yourself from Heartbleed][]:
> The Heartbleed vulnerability is one of the worst Internet security problems we have seen.
> I’ll be writing more about what we can learn from Heartbleed and the response to it.    
>       
> For now, here is a quick checklist of what you can do to protect yourself.

From jc.

[HeartBleed explanation]: heartbleed_explanation.png
[Best Heartbleed explanation ever by xkcd:]: http://xkcd.com/1354/
[Answering the Critical Question: Can You Get Private SSL Keys Using Heartbleed?]: http://blog.cloudflare.com/answering-the-critical-question-can-you-get-private-ssl-keys-using-heartbleed
[The Heartbleed Challenge]: https://www.cloudflarechallenge.com/heartbleed
[The Heartbleed Bug]: http://heartbleed.com
[Test your server for Heartbleed (CVE-2014-0160)]: http://filippo.io/Heartbleed/
[Heartbleed by Bruce Schneier]: https://www.schneier.com/blog/archives/2014/04/heartbleed.html
[Critical crypto bug exposes Yahoo Mail, other passwords Russian roulette-style]: http://arstechnica.com/security/2014/04/critical-crypto-bug-exposes-yahoo-mail-passwords-russian-roulette-style/
[Wild at Heart: Were Intelligence Agencies Using Heartbleed in November 2013?]: 
https://www.eff.org/deeplinks/2014/04/wild-heart-were-intelligence-agencies-using-heartbleed-november-2013
[What Heartbleed Can Teach The OSS Community About Marketing]: http://www.kalzumeus.com/2014/04/09/what-heartbleed-can-teach-the-oss-community-about-marketing/
[Using Heartbleed PoC for Hijacking User Sessions En Masse]: https://www.michael-p-davis.com/using-heartbleed-for-hijacking-user-sessions/
[Critical crypto bug in OpenSSL opens two-thirds of the Web to eavesdropping]: http://arstechnica.com/security/2014/04/critical-crypto-bug-in-openssl-opens-two-thirds-of-the-web-to-eavesdropping/
[Heartbleed Bug: What Can You Do?]: http://krebsonsecurity.com/2014/04/heartbleed-bug-what-can-you-do/
[How to protect yourself from Heartbleed]: https://freedom-to-tinker.com/blog/felten/how-to-protect-yourself-from-heartbleed/
