## Import Cheetah3D Model in SceneKit

This article is really for 3D rookies like me that would like to play with [SceneKit][]. SceneKit[^1] is a high-level 3D framework, introduced in Mountain Lion, that allows reading, manipulating and displaying 3D scenes. SceneKit is now part of iOS, starting from iOS 8, allowing developers to easily integrate 3D graphics or develop 3D casual games on iPhone / iPad / iOther.

SceneKit supports the import of [COLLADA][] scenes: COLLADA is an open XML file format for 3D assets, supported by a lot (if not all) 3D creation softwares (like [Blender][], [Maya][], [Bryce][] etc...). If you're new to 3D and just want to play with SceneKit, you can search for free COLLADA files on the web (*.dae), or use the ones included in Apple SceneKit samples ([Vehicle][], [Bananas][], or even the [complete WWDC 2014 SceneKit session][], available as a sample code!)

Besides using free models, you can also create your own using a 3D modelling tool: there are plenty of choices from free ([Blender][]) to very expensive ([Maya][]). On the mac, [Cheetah3D][] is really an excellent, and not very expensive, alternative. For $69, you have a complete 3D modelling, rendering and animation software for OSX ([buy directly on Cheetah3D web site][] or on the [Mac App Store][]). 

I'm just beginning to use Cheetah3D, and I really appreciate how easy is the creation of 3D models. Cheetah3D is also a native Cocoa app, with an intuitive, Macintosh-like user interface:

<a href="http://blog.manbolo.com/2014/08/10/cheetah3d.png"><img src="http://blog.manbolo.com/2014/08/10/cheetah3d.png" title="Cheetah3D on Mavericks." alt="Cheetah3D" width="600" height="377"></a>

Really a great software!

I've created this mug in a couple of minutes, following the first tutorial of [Learn 3D with Cheetah3D 6][], an excellent resource on Cheetah3D. To include this model in an iOS sample app, we need to first export it as a COLLADA file from Cheetah3D. Select File > Export, choose dae as File Format and save your file (or [download it here][]).

Then, create a SceneKit sample, with Xcode 6: New Project > Single View Application.

<a href="http://blog.manbolo.com/2014/08/10/scenekit-1.png"><img src="http://blog.manbolo.com/2014/08/10/scenekit-1-1200.png" alt="SceneKit sample step 1" width="600" height="406"></a>

Give it a product name:

<a href="http://blog.manbolo.com/2014/08/10/scenekit-2.png"><img src="http://blog.manbolo.com/2014/08/10/scenekit-2-1200.png" alt="SceneKit sample step 2" width="600" height="406"></a>

Select the main storyboard of the document, Main.storyboard	, then the ViewController scene, and remove the default view of the ViewController.

<a href="http://blog.manbolo.com/2014/08/10/scenekit-3.png"><img src="http://blog.manbolo.com/2014/08/10/scenekit-3-1200.png" alt="SceneKit sample step 3" width="600" height="340"></a>

Now, in the right corner of Xcode, select the Object library (as in the screenshot), and drag and drop a SceneKit view on the view controller.

<a href="http://blog.manbolo.com/2014/08/10/scenekit-4.png"><img src="http://blog.manbolo.com/2014/08/10/scenekit-4-1200.png" alt="SceneKit sample step 4" width="600" height="340"></a>

Now, some code! Open ViewController.m and add the following code:

	@import SceneKit;
	...
	@implementation ViewController
	...
	- (void)viewDidLoad
	{
		[super viewDidLoad];
		
		SCNView *myView = (SCNView *)self.view;
		myView.scene = [SCNScene sceneNamed:@"mug.dae"];
		myView.allowsCameraControl = YES;
		myView.autoenablesDefaultLighting = YES;
		myView.backgroundColor = [UIColor lightGrayColor];
	}

We've just loaded our mug COLLADA file into the 3D scene view. Now, we need to import the file into our project: File > Add Files to "TestSK" and select our our [mug.dae][] file. Then build and run:

<a href="http://blog.manbolo.com/2014/08/10/scenekit-5.png"><img src="http://blog.manbolo.com/2014/08/10/scenekit-5.png" alt="SceneKit sample step 5" width="600" height="354"></a>

Mmmm... Something must be missing, we don't have any textures displayed in the simulator! In fact, we forget something really important when importing our COLLADA files from Cheetah3D. In COLLADA files, textures are referenced and not included in the file; in other terms, the [mug.dae][] file is not sufficient, and must be accompanied by the textures files that it references. So, we just need to include our [mug-diffuse.png][] texture in our project: File > Add Files to "TestSK" and select the [mug-diffuse.png][] file. Before running again the sample, you can select the [mug.dae][] file in Xcode, and check that everything looks good now:

<a href="http://blog.manbolo.com/2014/08/10/scenekit-6.png"><img src="http://blog.manbolo.com/2014/08/10/scenekit-6.png" alt="SceneKit sample step 6" width="600" height="377"></a>

Then, run the sample, et voilà !

<a href="http://blog.manbolo.com/2014/08/10/ios-simulator.png"><img src="http://blog.manbolo.com/2014/08/10/ios-simulator.png" alt="iOS Simulator" title="The mug in the iOS simulator" width="600" height="430"></a>

### More on SceneKit

[WWDC 2012 - Session 504: Introducing Scene Kit](https://developer.apple.com/videos/wwdc/2012/index.php?id=504)

[WWDC 2013 - Session 500: What’s New in Scene Kit](https://developer.apple.com/videos/wwdc/2013/index.php?id=500)

[WWDC 2014 - Session 609: What's New in SceneKit](https://developer.apple.com/videos/wwdc/2014/index.php?id=609)

[WWDC 2014 - Session 610: Building a Game with SceneKit](https://developer.apple.com/videos/wwdc/2014/index.php?id=610)

From jc.

[COLLADA]: http://en.wikipedia.org/wiki/COLLADA
[Cheetah3D]: http://www.cheetah3d.com
[SceneKit]: https://developer.apple.com/librarY/mac/documentation/3DDrawing/Conceptual/SceneKit_PG/Introduction/Introduction.html
[Blender]: http://www.blender.org
[Maya]: http://www.autodesk.com/products/maya/overview
[Bryce]: http://www.daz3d.com/bryce-7-pro/
[Vehicle]: https://developer.apple.com/library/prerelease/ios/samplecode/SceneKitVehicle/Introduction/Intro.html#//apple_ref/doc/uid/TP40014549
[complete WWDC 2014 SceneKit session]: https://developer.apple.com/library/prerelease/ios/samplecode/SceneKitReel/Introduction/Intro.html#//apple_ref/doc/uid/TP40014550
[Bananas]: https://developer.apple.com/library/prerelease/ios/samplecode/Bananas/Introduction/Intro.html#//apple_ref/doc/uid/TP40014450
[buy directly on Cheetah3D web site]: http://www.cheetah3d.com/order.php
[Learn 3D with Cheetah3D 6]: http://loewald.com/c3dbook/
[download it here]: /2014/08/10/mug.dae
[mug-diffuse.png]: /2014/08/10/mug-diffuse.png
[mug.dae]: /2014/08/10/mug.dae
[Mac App Store]: https://itunes.apple.com/app/cheetah3d/id402708753?l=en&mt=12&at=11lqRB
[^1]: Spelled "Scene Kit" on Mountain Lion and Mavericks, and "SceneKit" on iOS 8  / OSX Yosemite

