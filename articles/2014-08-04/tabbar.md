## Of Tab Bars

Tab bar is a standard navigation control present in iOS, since the first introduction of the iPhone. In the iOS Human Interface Guidelines, 

> A tab bar gives people the ability to switch between different subtasks,
> view or modes in an app.    
> [...]    
> Use a tab bar to give users access to different perspectives on the same
> set of data or different subtasks related to the overall function of your
> app.   
>    
> In general, use a tab bar to organize information at the app level. A tab
> bar is well suited for use in the main app view because it's a good way to
> flatten your information hierarchy and provide access to several peer 
> information categories or modes at one time.

### From gradient to flat

Tab bar has survived the iOS 7 shake-up, with minor modifications. From iOS 5 to iOS 7, the clock app tab bar's looks like this:

![Clock Tab bar Evolution](http://blog.manbolo.com/2014/08/04/clock_ios.png "Evolution of Clock's tab bar from iOS 5 to iOS 7")

Until iOS 6, tab bar icons were computed by applying a template blue gradient on a monocolor shape:

![Classic tab bar icon][]

Looking closely, rendered icons also included a drop shadow and a light glowing stroke:

![Favorites icon](http://blog.manbolo.com/2014/08/04/favorites.png)

All third-parties apps using a tab bar exhibited the same blue bar icons (maybe with the noticeable exemption of the Nike+ app): there was no easy way using public APIs to change the icon blue rendering.

On iOS 7, the blue gradient is dropped to a flat, plain and customisable color (aka _key color_ in [iOS Human Interface Guidelines][] or _tint color_). Now, the clock tab bar looks like:

![Clock Tab bar on iOS 7][]

Appart from minor design modifications, the tab bar uses now __two templates images__ for each icon: a selected/active one, and an unselected one:

![](http://blog.manbolo.com/2014/08/04/selection-iOS7.png)

The unselected icon is often just a thin silhouette of the selected icon. The selected image has more plain zone, filled with color: the attention is really focused on the selected icon. Another gain with the iOS 7 design is accessibility: even if you're color blind, you can still see where is the selection.

![](http://blog.manbolo.com/2014/08/04/selection-iOS7-unsaturated.png)

Forgetting to use two different icons for the two different states is really a common mistake in a lot of iOS 7 apps (maybe due to the fact that you can't use Interface Builder to set the image for each state). Programmatically, it's straightforward using `UITabBarItem` instances:

	NSString *imageOffName = @"ClockTabIconOff";
	NSString *imageOnName = @"ClockTabIconOn";
	
	tabBarItem.image = [UIImage imageNamed:imageOffName];
	tabBarItem.selectedImage = [UIImage imageNamed:imageOnName];

### iOS 6 experimentations

On iOS 6, a simple app built with the public SDK kept using the classic blue gradient. But some Apple apps showed that there were 'experimentations' around where should go the iOS design. For instance, the App Store app used a 'flatter' gradient, while keeping the blue selection against a black background:

![AppStore Tabbar Evolution](http://blog.manbolo.com/2014/08/04/appstore_ios.png "App Store on iOS 5, 6 and 7")

In the same time, the Music app used a completely greyed tab bar:

![Music Tabbar Evolution](http://blog.manbolo.com/2014/08/04/music_ios.png "Music on iOS 5, 6, 7. Notice the black pixels in the bottom corners to give a "rounded" layout" in iOS 6.")

Combine the new flat color selection of the App Store app and the lighter tab bar of the Music app, and we have something that can resemble to the iOS 7 aesthetic! What's surprising is that the iOS 7 tab bar, while being a real departure from the past, has kept a familiar look and feel, and could be seen as another design iteration.

### Back to basics

How to talk on tab bar and not mention Game Center? Introduced in iOS 4, Game Center (and more precisely the Game Center companion app) was the first built-in app to not use the classic blue icon / black background tab bar. It featured a rich faked wooden tab bar. Four releases latter, iOS 7 has come and put the Game Center app on the right track (more consistent, less fun):

![GameCenter Tabbar Evolution][]

From jc.

[Clock Tab bar on iOS 7]: http://blog.manbolo.com/2014/08/04/clock_ios7.png
[GameCenter Tabbar Evolution]: http://blog.manbolo.com/2014/08/04/gamecenter_ios.png
[Classic tab bar icon]: http://blog.manbolo.com/2014/08/04/gradient-iOS5.png
[iOS Human Interface Guidelines]: https://developer.apple.com/library/iOS/documentation/userexperience/conceptual/mobilehig/

