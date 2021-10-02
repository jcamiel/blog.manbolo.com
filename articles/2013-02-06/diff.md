## How To Obtain Undocumented API Diffs Between iOS Versions by Ole Begemann

In [How To Obtain Undocumented API Diffs Between iOS Versions][], [Ole Begemann][], with the help of [Nicolas Seriot][], shows how to dissect the API differences for each new iOS versions. 

In a nutshell, in a terminal

	$ git clone https://github.com/nst/iOS-Runtime-Headers.git
	$ cd iOS-Runtime-Headers
	$ git difftool 6.0 6.1

To get the APIs diff between iOS 6.0 and iOS 6.1. As pointed in the article [Kaleidoscope 2][] is the perfect tool for this job:

<a href="/2013/02/06/diff.jpg"><img src="/2013/02/06/diff.jpg" alt="Kaleidoscope diff screen" width="600" height="479"></a>

With this approach, he discovers the undocumented `_MPGlowLabel` and  `_UIWebViewController`, or even `gyttNumTemperatures` and `rebuildGytt` in `CoreMotion`.

Another brilliant piece of work, after the [Remote View Controllers in iOS 6 saga][] [^1] [^2] [^3].

From jc.

[How To Obtain Undocumented API Diffs Between iOS Versions]: http://oleb.net/blog/2013/02/how-to-undocumented-ios-api-diffs/
[Kaleidoscope diff screen]: diff.png
[Kaleidoscope 2]: https://itunes.apple.com/us/app/kaleidoscope/id587512244?mt=12
[Remote View Controllers in iOS 6 saga]: http://oleb.net/blog/2012/10/remote-view-controllers-in-ios-6/
[Ole Begemann]: https://twitter.com/olebegemann
[Nicolas Seriot]: http://seriot.ch/
[^1]: <http://oleb.net/blog/2012/10/remote-view-controllers-in-ios-6/>
[^2]: <http://oleb.net/blog/2012/10/more-on-remote-view-controllers/>
[^3]: <http://oleb.net/blog/2012/10/update-on-remote-view-controllers/>
