## Digging Through iOS Graphical Resources  

Sometimes you want to use the exact same graphical resources of the embedded Apple apps. For instance, let's say you want reproduce the garbage button animation in the Photo app:    
<img src="/2013/01/21/UIButtonBarGarbage.gif" alt="Garbage animation" width="86" height="88">    
<small>Yes the animation's frame rate is not good but, but did you know that GIFs in browser supports a minimum FPS?</small> 

Or you want to use the same iBooks' 'cream' popovers:    
![Winnie the Pooh][]

Fortunately, there is an app for that, and it's free and Open Source. [UIKit-Artwork-Extractor on GitHub][] by [Cédric Luthi][] extracts all the image artworks and emojis contained in `UIKit`. Get the source code, select a Simulator platform, build and run the app: that's done. Note: you can try to run it on a device, but the app seems to crash because of the too large memory consumption.

Once launched, you will see this screen:

![UIKit extractor][]

When you save the output, a folder on your desktop will be created (e.g. `~/Desktop/iPhone Simulator 6.0 artwork`) that contains all the Simulator resources, organized by framework.

For instance, you will find all the garbage animation's frames under `~/Desktop/iPhone Simulator 6.0 artwork/Shared artwork`: `UIButtonBarGarbageOpen0.png` to `UIButtonBarGarbage15.png` and  `UIButtonBarGarbageClose0.png` to `UIButtonBarGarbageClose16.png`.

The animated gear in the Settings apps, when installing a new OS update can be found under `~/Desktop/iPhone Simulator 6.0 artwork/Preferences app`: `GearAnimation0.png` to `GearAnimation35.png`.

![Gear animation][]

The 'cream' iBooks' UIPopover components are located under `~/Desktop/iPhone Simulator 6.0 artwork/Shared artwork`: `UIPopoverViewCreamBackgroundArrow*.png`

<img src="/2013/01/21/_UIPopoverViewCreamBackgroundArrowDown.png" alt="UIPopoverViewCreamBackgroundArrowDown" class="thumbnail">
<img src="/2013/01/21/_UIPopoverViewCreamBackgroundArrowDownRight.png" alt="UIPopoverViewCreamBackgroundArrowDownRight" class="thumbnail">
<img src="/2013/01/21/_UIPopoverViewCreamBackgroundArrowSide.png" alt="UIPopoverViewCreamBackgroundArrowSide" class="thumbnail">
<img src="/2013/01/21/_UIPopoverViewCreamBackgroundArrowSideBottom.png" alt="UIPopoverViewCreamBackgroundArrowSideBottom" class="thumbnail">
<img src="/2013/01/21/_UIPopoverViewCreamBackgroundArrowSideTop.png" alt="UIPopoverViewCreamBackgroundArrowSideTop" class="thumbnail">
<img src="/2013/01/21/_UIPopoverViewCreamBackgroundArrowUp.png" alt="UIPopoverViewCreamBackgroundArrowUp" class="thumbnail">
<img src="/2013/01/21/_UIPopoverViewCreamBackgroundArrowUpRight.png" alt="UIPopoverViewCreamBackgroundArrowUpRight" class="thumbnail">

The beautiful and textured Map's signs background are under `~/Desktop/iPhone Simulator 6.0 artwork/MapsLockScreen lockbundle`

![Map signs background][]

There are a lot of developers that prefer to code using only `Core Graphics` and no png at all, but if you look at Apple's bundles, you will see that a lot of the `UIKit` components are png's based. I prefer to use png instead of coding because:

- it's simpler,
- your graphic designer can work independently and will iterate faster,
- png on iOS is hardware decoded so performances should be really OK,
- even Apple does it (but not exclusively: `Core Graphics` graphics are also light and retina ready, see the Stock app's reconstruction in [WWDC 2011 Session - ￼Practical Drawing for iOS][]).


### Little gems

Finally, digging through `UIKit` will show you beautiful, unknown (by me et least!) and sometimes _unused_ Apple images:

![Newstand Magazine][]

![Newstand Newspaper][]

Have you ever seen this clumsy animated splash screen when you boot your iPhone? However, it's here!
 
![Apple Logo][]

From jc.

[UIKit-Artwork-Extractor on GitHub]: https://github.com/0xced/UIKit-Artwork-Extractor
[Cédric Luthi]: http://0xced.blogspot.fr
[Winnie the Pooh]: winnie.png
[Garbage animation]: UIButtonBarGarbage.gif
[Gear animation]: GearAnimation.gif
[Newstand Magazine]: NewsstandDefaultMagazine_1only_.png
[Newstand Newspaper]: NewsstandDefaultNewspaper_1only_.png
[Apple Logo]: logoFlareAnim.gif
[UIKit extractor]: extractor-uikit.png
[Map signs background]: MNBannerSignViewBackgroundTeal@2x.png
[WWDC 2011 Session - ￼Practical Drawing for iOS]: https://developer.apple.com/videos/wwdc/2011/?id=129
