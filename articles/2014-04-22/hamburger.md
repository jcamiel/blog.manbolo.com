## RIP Hamburger Menu

<img src="/2014/04/22/gravestone.png" width="300" height="388" >

From [Brent Jackson, in Hamburgers & Basements: Why Not to Use Left Nav Flyouts][] (via [Michael Tsai][]):

> Another, more obvious downside to the left nav flyout is its
> inefficiency: tap a hard-to-reach button, wait for an animation,
> scroll a list while scanning for the item you want, tap again, 
> and wait for another animation. Your user doesn’t have time for
> that – don’t subject them to such nonsense.    
>       
> Having a lot of functionality and complexity in your product is no
> excuse. If your navigation has more than five items at the top-level, 
> that’s just lazy information architecture. Too many choices is bad 
> anywhere, especially on a 4-inch display.

I really dislike the Hamburger menu, and I'm glad that Facebook has ditched it. The reasons why I don't like it:

- The left corner is in one of the hardest-to-reach tap zone: ![Tap Zones][] <small> Courtesy of [Responsive Navigation: Optimizing for Touch Across Devices][]</small>
- Having a basement menu doesn't force you to focus on the 4-5 most important features of your app,
- On iOS 7, it can interfere with the [system swipe-to-back gesture][],
- In lot of cases, I've the impression that a tab bar could be a better way of organizing the app UI workflow, giving a direct tap access to categories:

	> In an app with a flat information structure, users can navigate directly from one
	> primary category to another because all primary categories are accessible from
	> the main screen. Music and App Store are good examples of apps that use a
	> flat structure.
	
	<video controls preload="auto" style="width:580px;height:360px;" src="/2014/04/22/navigation_flat.m4v" poster="/2014/04/22/navigation_flat.png"></video>

	From [Apple's iOS 7 Design Resources][].

Also, an interesting [Twitter thread from Marco Arment][] about hamburgers menu (considering that Instapaper is still using one):

> Can I admit here that I hate hamburger/basement navigation, I 
> think we’ll look back on it with regret as a bad fad, and I’m not using it?

In [Instapaper][], I really find it useless: the slide gesture to reveal the menu is not "interactive" (it doesn't follow your thumb), and doesn't feel like the standard iOS7 system gesture.

I really hope the hamburger menu will progressively disappear from iOS apps: if we have bigger 5 inch iPhones soon, it will really become irrevelant and harder to use.

From jc.

[Brent Jackson, in Hamburgers & Basements: Why Not to Use Left Nav Flyouts]: http://jxnblk.tumblr.com/post/36218805036/hamburgers-basements-why-not-to-use-left-nav-flyouts
[Twitter thread from Marco Arment]: https://twitter.com/gruber/status/454715952765366272
[Responsive Navigation: Optimizing for Touch Across Devices]: http://www.lukew.com/ff/entry.asp?1649
[Michael Tsai]: http://mjtsai.com/blog/2014/04/14/hamburgers-and-basements/
[Tap Zones]: tnav-touch-phones2.png
[Apple's iOS 7 Design Resources]: https://developer.apple.com/library/ios/documentation/userexperience/conceptual/MobileHIG/Navigation.html#//apple_ref/doc/uid/TP40006556-CH53-SW1
[Instapaper]: https://itunes.apple.com/en/app/instapaper/id288545208?mt=8
[system swipe-to-back gesture]: https://developer.apple.com/library/ios/documentation/uikit/reference/UINavigationController_Class/Reference/Reference.html#//apple_ref/doc/uid/TP40006934-CH3-SW34