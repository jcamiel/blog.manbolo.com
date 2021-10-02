## ag is ack on Steroids

[ack][] is a powerful grep replacement, I use it everyday to search for patterns in source code files. From the [Top 10 reasons to use ack for source code][], it's blazing fast, (really it seems _instantaneous_), has extremely good defaults, and just works.

But [there is another][] and faster grep-like tool: [ag][], AKA __The Silver Searcher__. [ag is a code searching tool similar to ack][], with a focus on speed.

In fact, [ag][] is fast, _extremely_ fast. When you test it for the first time, you have the same feeling when you discoverered ack for the first time. It searches code about 3x to 5x faster than ack.

For instance, if I test a middle sized iOS app (~100,000 lines of code):

    $ time ack OEMWelcomeViewController
    ...
    real    0m0.625s
    user    0m0.545s
    sys     0m0.074s
    
Compared to:

    $ time ag OEMWelcomeViewController
    ...
    real    0m0.067s
    user    0m0.062s
    sys     0m0.092s

ag is almost 10x faster than ack on this test! That is blazing fast! 

To install ag on OSX, just use [Homebrew][] and run:

    brew install ag

You can learn more about ag on [The Silver Searcher: Better than Ack][] and on the [Github page][].

From jc.

[Top 10 reasons to use ack for source code]: http://beyondgrep.com/why-ack/
[there is another]: http://en.wikipedia.org/wiki/Yoda
[The Silver Searcher: Better than Ack]: http://geoff.greer.fm/2011/12/27/the-silver-searcher-better-than-ack/
[Github page]: https://github.com/ggreer/the_silver_searcher
[ag]: https://github.com/ggreer/the_silver_searcher
[ack]: http://beyondgrep.com
[ag is a code searching tool similar to ack]: https://github.com/ggreer/the_silver_searcher
[Homebrew]: http://brew.sh




