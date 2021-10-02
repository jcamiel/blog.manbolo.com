## WWDC 2014 Predictions Game

Well, it's more a wish list than real predictions about what will be announced in June, [at the WWDC 2014][]. Let's go!

<img src="/2014/04/11/wwdc2014.png" style="width:600px; height:253px">

### iPhone 6 with a 5 inches screen

Having a new iPhone with a bigger screen is an evidence. What the physical screen size could be? And maybe more important (for a developer), what would be the screen size in pixel? Let's imagine that the number of pixels __will be the same as the current iPhone 5x line: 640 pixels by 1136 pixels__: no need to redesign apps, the whole UI will be simply _bigger_. Given this, a safe bet would be also that this new iPhone will use __the same PPI (pixel-per-inch) as the current iPad Air: 264 ppi__.

A pixel-width of 640 with a 264 ppi give us a 640 / 264 = __2.424 inches width__; and we get __1136 / 264 = 4.303 inches for the height__.

Our new screen will measure 2.424 inches by 4.303 inches, by consequence a 4.94 inches diagonal... Let's simply say: a __5 inches screen__.

Get a paper, a rule and draw a 2.424 inches by 4.303 inches (6.2 cm by 10.9 cm): it's big, but not insanely big... Of course, you have to add extra space for the home button and the phone bevels: I can really see the iPhone 6, top of the iPhone line, with a screen this big. 

![5 inches iPhone 6][]

But a 640 x 1136 pixels screen is a _very very conservative_ number of pixels, especially regarding the current Android phones: the [Nexus 5][] has a _1080 x 1920 pixels screen_, with a 445 ppi density. If you look at [high-definition smartphone displays][], you will get 3 different sizes: 720px by 1280px, 800px by 1280px and 1080px by 1920px, with a maximum ppi of 468 for the [HTC One][]: all these sizes will introduces a kind of fragmentation if chosen for the iPhone 6 (even with [AutoLayout][]), and some additional effort for developers. 

In my dream: the iPhone 6 has a 1280 px by 2272 px screen, double the pixel size in width and height of the current iPhone 5s. No need to redesign apps, just get `@4x` resources and done.  But certainly not this year.  

### New Apple TV

This WWDC will introduce the __App Store for Apple TV__, with a dedicated gamepad. Based on the iOS 8 beta SDK, developers will be able to develop apps for the Apple TV, and the Apple TV will receive a [Back to the Mac][] treatment: Game Center, Push Notifications etc... The Apple TV will become a true home media center: video game console, VOD, apps, a Siri driven UI, etc... it's the [Apple Bandai Pippin][] on steroids!

<img src="/2014/04/11/pippin.png" style="width:600px; height:297px;">

Why do I think this year will be the Apple TV's year ? Basically, four things:

__1. iOS 7 Game Controller:__ iOS 7 has seen the introduction of a [Game Controller framework][], making it easy to discover game controllers connected to a Mac or iOS device. Apple has even created specifications for distinct kinds of MFi game controllers with many common characteristics that must be implemented strictly according to the specification.  

<img src="/2014/04/11/gamepad-ios.png" style="width:600px; height:304px;">

Allowing gamepad accessories just for iPhone and iPad seems to me too limited and I dream for an Apple console, with a dedicated gamepad _and_ an unlimited App Store.

__2. Amazon Fire TV:__

Few days ago, Amazon announces the [Amazon Fire TV][], available in the US for $99:

![Amazon Fire TV screenshot][]

- Over 200,000 TV episodes and movies, and __over a hundred games__ (Minecraft-Pocket Edition, The Walking Dead, Monsters University etc...),
- Voice search,
- Fast quad-core processor, 2 GB of memory, dedicated GPU, plus 1080p HD video and Dolby Digital Plus surround sound

In my mind, the Amazon Fire TV is a direct Apple TV concurrent, and Apple has to respond to this threat with a better Apple TV.

__3. A7 aka Cyclone:__

Apple has undoubtedly great plans for the A7, the CPU used in the iPhone 5s. [This analyse by AnandTech][] shows that the A7 has a bright future and this future could be the Apple TV. 

> Cyclone is a bold move by Apple, but not one that is without its challenges. I still
> find that there are almost no applications on iOS that really take advantage of the
> CPU power underneath the hood. More than anything Apple needs first party software 
> that really demonstrates what's possible.    
> ...    
> Looking at Cyclone makes one thing very clear: the rest of the players in the ultra 
> mobile CPU space didn't aim high enough. I wonder what happens next round.

__4. PrimeSense bought by Apple:__

[Apple has recently bought PrimeSense][], an Israeli company which provided 3D sensors for the first generation Microsoft Kinect. Seems like a really good fit for the Apple TV team...

### iOS APIs

WWDC 2014 will usually introduce new APIs for iOS 8. If you look at the current [iOS 7 private frameworks headers][], you will find some interesting ones:

- [OAuth][]: wouldn't it be cool to have this, built-in in the system as as public API?
- [VectorKit][]: how about an object-based for vectorial stuff (animations, 3D etc...); everything you need to re-build the Maps app.
- [RemoteUI][]: do you remember the [Ole Begemann][] [Remote View Controllers saga][] ([part 1][], [part 2][], [part 3][])? It could be really useful to easily share data and even UI between apps: think about a mini Drop box explorer in your app for instance... Data sharing between apps is the most obvious low-hanging fruit to me, so I expect Apple to address this in iOS 8.

Another interesting indicator is to look a [Github Objective-C popular projects on last month][]: 

- UI components: [DZNSegmentedControl][], [FXForms][], [BRFlabbyTable][], [JTSImageViewController][], [RPSlidingMenu][], [DeepBeliefSDK][]
- Core Components: [DateTools][], [AFNetworking][], [ReactiveCocoa][], [HHRouter][], [SDWebImage][]
- Tools / Debug: [Tweaks][], [Xtrace][]

UI is the crown jewels of iOS, and developers want more and more built-in UI components. Regarding [AFNetworking][] and [SDWebImage][], I find it sad that we still need a third party framework to deal easily with HTTP request, and web-based images. Come on Apple, bring-us something like [Requests][] for iOS 8!

### Developers tools: Xcode 6

Better developer tools for better apps! 

For WWDC 2014, I see: an enhanced version of [XCTest][] with code coverage for instance; some new tools _à la_ [RevealApp][], and finally a better Xcode editor / refactor, _à la_ [AppCode][].

__1. [XCTest][]:__

Since Xcode 4, Apple has really improved the Xcode tests tools; and even introduced last year the [XCTest framework][], a new test framework for Xcode. Currently, XCTest is not really more useful than the venerable SenTestingKit; but I bet Apple has great ambitions for XCTest. Why no add [code coverage][] this year for instance?  

__2. [RevealApp][]:__

Apple __has__ to integrate [RevealApp][] in Xcode. RevealApp has save me many times on really difficult UI bugs: it's an indispensable addition to the iOS developer arsenal. RevealApp gives you a visual representation of the views hierarchies of your app, and you can event interact with: 

<a href="/2014/04/11/reveal.jpg"><img src="/2014/04/11/reveal.jpg" style="width:600px; height=344px;"></a>

It's like [FireFox 3D View][], for iOS!

<a href="/2014/04/11/reveal.jpg"><img src="/2014/04/11/3dview.png" style="width:600px; height=371px;"></a>

In any case, just buy it, you will not regret it.

__3. Xcode enhanced editor__: 

XCode 6, the same Xcode with some good stuff from [AppCode][].

### Objective-C

I do not expect big news in the Objective-C land, apart new features to deal with dependencies. [Embrace][] [CocoaPods][] (the current de-facto standard dependency manager), and include it in OSX / iOS developers tools.

### No iWatch

WWDC 2014: no iWatch. 

From jc.

[Apple has recently bought PrimeSense]: http://www.theguardian.com/technology/2013/nov/18/apple-buys-israels-primesense-kinect-sensor
[Embrace]: http://en.wikipedia.org/wiki/Embrace,_extend_and_extinguish
[AppCode]: http://www.jetbrains.com/objc/
[Requests]: http://docs.python-requests.org/en/latest/
[part 1]: http://oleb.net/blog/2012/10/remote-view-controllers-in-ios-6/
[part 2]: http://oleb.net/blog/2012/10/more-on-remote-view-controllers/
[part 3]: http://oleb.net/blog/2012/10/update-on-remote-view-controllers/
[Remote View Controllers saga]: http://oleb.net/blog/2012/10/remote-view-controllers-in-ios-6/
[Ole Begemann]: https://twitter.com/olebegemann
[RemoteUI]: https://github.com/MP0w/iOS-Headers/tree/master/iOS7/PrivateFrameworks/RemoteUI
[VectorKit]: https://github.com/MP0w/iOS-Headers/tree/master/iOS7/PrivateFrameworks/VectorKit
[OAuth]: https://github.com/MP0w/iOS-Headers/tree/master/iOS7/PrivateFrameworks/OAuth
[iOS 7 private frameworks headers]: https://github.com/MP0w/iOS-Headers/tree/master/iOS7/PrivateFrameworks 
[AutoLayout]: http://blog.manbolo.com/2013/12/30/view.translatesautoresizingmaskintocontraints-no
[HTC One]: http://www.htc.com/www/smartphones/htc-one-m8/
[high-definition smartphone displays]: http://en.wikipedia.org/wiki/Comparison_of_high-definition_smartphone_displays
[Nexus 5]: https://www.google.com/nexus/5/
[code coverage]: http://en.wikipedia.org/wiki/Code_coverage
[XCTest]: https://developer.apple.com/library/ios/documentation/ToolsLanguages/Conceptual/Xcode_Overview/UnitTestYourApp/UnitTestYourApp.html
[XCTest framework]: https://developer.apple.com/library/ios/documentation/ToolsLanguages/Conceptual/Xcode_Overview/UnitTestYourApp/UnitTestYourApp.html
[This analyse by AnandTech]: http://www.anandtech.com/show/7910/apples-cyclone-microarchitecture-detailed
[Apple Bandai Pippin]: http://en.wikipedia.org/wiki/Apple_Bandai_Pippin
[Back to The Mac]: https://www.apple.com/apple-events/october-2010/
[at the WWDC 2014]: https://developer.apple.com/wwdc/
[Amazon Fire TV screenshot]: amazon-fire-tv.jpg
[Amazon Fire TV]: http://www.amazon.com/Fire-TV-streaming-media-player/dp/B00CX5P8FC
[Game Controller framework]: https://developer.apple.com/library/ios/documentation/ServicesDiscovery/Conceptual/GameControllerPG/Introduction/Introduction.html
[RevealApp]: http://revealapp.com
[FireFox 3D View]: https://developer.mozilla.org/en-US/docs/Tools/3D_View
[CocoaPods]: http://cocoapods.org
[Tweaks]: https://github.com/facebook/Tweaks
[DateTools]: https://github.com/MatthewYork/DateTools
[AFNetworking]: https://github.com/AFNetworking/AFNetworking
[DZNSegmentedControl]: https://github.com/dzenbot/DZNSegmentedControl
[FXForms]: https://github.com/nicklockwood/FXForms
[Github Objective-C popular projects on last month]: https://github.com/trending?l=objective-c&since=monthly
[Xtrace]: https://github.com/johnno1962/Xtrace
[BRFlabbyTable]: https://github.com/brocoo/BRFlabbyTable
[JTSImageViewController]: https://github.com/jaredsinclair/JTSImageViewController
[BFNavigationBarDrawer]: https://github.com/DrummerB/BFNavigationBarDrawer
[RPSlidingMenu]: https://github.com/RobotsAndPencils/RPSlidingMenu
[ReactiveCocoa]: https://github.com/ReactiveCocoa/ReactiveCocoa
[HHRouter]: https://github.com/Huohua/HHRouter
[DeepBeliefSDK]: https://github.com/jetpacapp/DeepBeliefSDK
[SDWebImage]: https://github.com/rs/SDWebImage
[iOS 7 Private frameworks]: https://github.com/MP0w/iOS-Headers/tree/master/iOS7/PrivateFrameworks
[5 inches iPhone 6]: iphone6.png
