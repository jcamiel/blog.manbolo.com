## Extend Xcode with Text Services

Extend Xcode with customized scripts is really easy thanks to [Services][]. 
[WWDC 2012 session 402, Working Efficiently with Xcode,][] shows how to integrate a bash script in Xcode Services menu to sort and uniq headers imports in your Objective-C file.

1.	Launch Automator, click on 'Services', then 'Choose':
	
	<a href="/2015/04/01/services1.png"><img src="/2015/04/01/services1.png" width=600 height=423></a>

	This creates a new service that takes a text selection from any application 
	and replaces the selection with its output.
	
2.	Select 'Run Shell Script' from the Library (you can filter actions by name, 
	for instance 'Run') and drag it to the right window (your service
	workflow):
	
	<a href="/2015/04/01/services2.png"><img src="/2015/04/01/services2.png" width=600 height=423></a>

3.	In the shell script box, put this command:

		sort -f | uniq
		
	Select 'Output replaces selected text' and save under the name 'Sort and 
	Uniq' (this will create a file called 'Sort and Uniq.workflow' under 
	~/Services/). You can see that this service will receive selected text as 
	input from any application and will replace the selection with its output.
	
	<a href="/2015/04/01/services3.png"><img src="/2015/04/01/services3.png" width=600 height=423></a>
	
4.	Now, open an implementation file in Xcode, select your headers imports,
	right click and go to 'Services' then 'Sort and Uniq'. Et voilà!

	<a href="/2015/04/01/services4.png"><img src="/2015/04/01/services4.png" width=600 height=471></a>


This service will be available on text selection from any application. This shows you how easily you can integrate custom scripts, thanks to the venerable text services of OS X.

From jc.

[Services]: https://developer.apple.com/library/mac/documentation/Cocoa/Conceptual/SysServices/introduction.html
[WWDC 2012 session 402, Working Efficiently with Xcode,]: https://developer.apple.com/videos/wwdc/2012/?include=402#402