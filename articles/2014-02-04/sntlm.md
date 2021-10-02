## How to Use the iOS Simulator and Others OSX Apps Behind Your Corporate Proxy

In a word: [cntlm][]!

If you work in a big company, chances are good that you'be been fighting your proxies IT guys, in particular if your proxy is a [NTLM one][]. 

You should configure your login/password proxy in the System configuration of OSX. That way, every OSX application can read your proxy settings and use it.

While this method is really simple, I've found a lot of applications that doesn't work well with my company's NTLM proxy, even if I've configured it in the System Preferences:

- the iOS Simulator: doesn't use the System proxy configuration (Xcode 5.0.2  /Mavericks),
- [Jenkins][]: can't upgrade / download plugins through the web interface,
- A lot of [curl][] based tools: `git clone https://github.com/AFNetworking/AFNetworking.git` etc...,
- [brew][] (if you don't know it, you should!)


[cntlm][] is a simple command line that stands between your applications and the corporate proxy, adding NTLM authentication on-the-fly. Your OSX system uses a local proxy (by default localhost:3128) provided by `cntlm` and `cntlm` does the hard work of always adding the NTLM authentification. You can use `cntlm` in _interactive_ mode i.e. in a shell that you launch and stop on demand, or install it to be started at launch with your session. 

Installing and configuring `cntlm` is a matter of minute and, after, you will say goodbye to your proxy issues.

The best tutorial I've found on `cntlm` is from [_oho][]: [Howto Set Cntlm on Mac OS X][]. Installation and overview are simply described and there are some really good tip and tricks. If you work behind a corporate proxy, be sure to read it, your life will change! 


From jc.

[cntlm]: http://cntlm.sourceforge.net/
[NTLM one]: http://en.wikipedia.org/wiki/NT_LAN_Manager
[curl]: http://curl.haxx.se/
[Jenkins]: http://jenkins-ci.org/
[brew]: http://brew.sh/
[Howto Set Cntlm on Mac OS X]: http://blog.hoachuck.biz/blog/2013/03/21/howto-set-cntlm-on-mac-os-x/
[_oho]: https://twitter.com/_oho