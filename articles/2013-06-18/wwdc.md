## Download Videos and Slides from WWDC 2013

If you want to download the videos and slides from WWDC 2013, we have written a small Python script that do this.

You can download this script here <https://github.com/manbolo/dwnldwwdc>. It's very simple to use, just type:

	 python dwnldwwdc.py ~/Tmp/ --pdf --sd
	 
to download PDF and SD videos slides under `~/Tmp`. You will need Python 2.7 or + (which is by default on OSX), and [Beautiful Soup 4][] package (which can simply be installed by typing `pip install beautifulsoup4`). In order to keep this very simple, this script doesn't connect to the [WWDC 2013 videos site][] but parse a local HTML copy. 

Finally, this script is under DWYW (Do What You Want) license.

__Update__: [a better version][], in full bash with no dependencies has been done by my friend [Olivier][]. This version connects directly to the WWDC page and does the authentication! Cool!

From jc.

[Beautiful Soup 4]: http://www.crummy.com/software/BeautifulSoup/ 
[WWDC 2013 videos site]: https://developer.apple.com/wwdc/videos/
[a better version]: http://blog.hoachuck.biz/blog/2013/06/15/script-to-download-wwdc-2013-videos/
[Olivier]: https://twitter.com/@_oho