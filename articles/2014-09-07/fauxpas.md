## Faux App, Analyze your Xcode Projects

<img src="http://blog.manbolo.com/2014/09/07/fauxpas.png" width=600 height=381>

> What the Clang Static Analyzer is to your code, Faux Pas is to your 
> whole Xcode project.

[Faux Pas][] is an OS X application to inspect and check possible issues and bugs in your Xcode projects. From the features list:

- check bad APIs calls (for instance, directly call `layoutSubviews`, implementing `-isEqual` but not `-hash`),
- Objective-C / Cocoa / Cocoa Touch best practices: objects literals, three letter prefix etc, 
- bugs (use `strong` delegate),
- command-line interface
- localization errors (string not localized etc...)
- unreferenced images, 

[Faux Pas][] is not only highly configurable and simple, but it also helps you to learn and enforce best practices on your code. I already use the [Clang Static Analyser in combination with Jenkins][], and I'm looking forward to integrate Faux Pas in our continuous integration build server.

A must for iOS / OS X devs!

From jc.

[Faux Pas]: http://fauxpasapp.com
[Clang Static Analyser in combination with Jenkins]: http://blog.manbolo.com/2014/04/15/automated-static-code-analysis-with-xcode-5.1-and-jenkins