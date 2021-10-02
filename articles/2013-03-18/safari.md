## Safari Reader Source Code

![Reader javascript][]

I'm totally in love with Safari's Reader feature. But sometimes, on some web article, Reader doesn't display anything (or Reader's button is greyed). If you're like me, and want to see why Reader doesn't always work properly, there is a very simple way to get Safari Reader source code.

The crazy thing is that the functionality is all Javascript based (maybe due to its grand parent [Arc90][] [Readability project][]).

To see it and walk trough `ReaderArticleFinder` object, just do this (tested with Safari 6.0.3):

1. Quit Safari, launch it on a blank page.
2. Type an URL for a site that has a chance to activate Reader's button (every blog post can work, but you can use [this one][] if you want <img src="smiley-happy.png" class="inline" style="vertical-align:middle;"/>)
![Safari 1][]
3. Wait for the site to be loaded and open the WebKit Inspector ( Command &#8984; Option &#8997; I)
4. In the WebKit Inspector window, click __ONE TIME__ on the pause button. There is no visual feedback, I'm not sure why or if this step is necessary but just in case...
![Safari 2][]
5. Click on the Reader button, and _usually_ the Javascript debugger should directly step into Safari Reader source code (in Javascript!)
<a href="/2013/03/18/reader-source-code.png"><img src="/2013/03/18/reader-source-code.png" alt="Safari 3" width="600" height="638"></a>

Et voilà!

I've found the Web Inspector rather capricious so don't hesitate to try this many times before succeded.

<small style="color:#aaa">And if you don't succeed, you can download it <a href="/2013/03/18/safari-reader.js">here</a>&hellip;</small> 

From jc.

[Reader javascript]: reader.png
[this one]: http://blog.manbolo.com/2012/11/20/using-xcode-opengl-es-frame-capture
[Arc90]: http://lab.arc90.com/
[Readability project]: https://code.google.com/p/arc90labs-readability/source/browse/trunk/js/readability.js#164
[Safari 1]: safari-1.jpg
[Safari 2]: safari-2.png
[Safari 3]: reader-source-code.png