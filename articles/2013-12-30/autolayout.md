## view.translatesAutoresizingMaskIntoContraints = NO

[iOS Auto Layout Demystified][] by [Erica Sadun][] is an excellent book on Auto Layout.

From the preface:

> You'll explore many of the strengths of Auto Layout as well. It's a 
> technoloy that has a lot going for it:
>
> - __Auto Layout is declarative.__ You express the interface behavior 
> without worrying about _how_ those rules get implemented. Just describe 
> the layout; let Auto Layout calculate the frame.
> - __Auto Layout is descriptive and relational.__ You describe how items
> relate to each other onscreen. Forget about sizes and positions. What
> matters is the relationships. 
> - __Auto Layout is centralized.__ Whether in IB or a layout section in
> your own code, Auto Layout rules tend to migrate to a single nexus, 
> making it easier to inspect and debug.
> - __Auto Layout is dynamic.__ Your interface updates as needed to respond
> to user- and application-sourced changes.
> - __Auto Layout is localizable.__ Conquer the world with Auto Layout. 
> It's built to adapt to varying word and phrase lengths while maintaining 
> interface integrity.
> - __Auto Layout is expressive.__ You can describe many more relationships 
> than you could in the older springs-and-struts system. Go beyond "hug
> this edge" or "resize along this axis" and express the way a view 
> relates to other views, not just its superview.
> - __Auto Layout is incremental.__ Adopt it on your own timescale. Add it 
> to just parts of your apps and parts of your interfaces, or jump in
> feet first for a full Auto Layout experience. Auto Layout offers
> backward compatibility, enabling you to build your interfaces using all 
> springs-and-struts, all constraints, or a bit ob both.

What I love about Auto Layout is that the [system is declarative][]: you just tell what you want and the system computes the frames for you, sometimes better than you could do by hand, see [Cocoa Auto Layout Release Notes][]:

> The benefits of this approach are most clear for localization and
> resolution independence. With this architecture, your localization
> effort is typically confined to translating strings. You don’t have to
> specify new layout, even for right-to-left languages such as Hebrew and
> Arabic (in which the left-to-right ordering of elements in the window
> should generally be reversed). For resolution independence, this system
> allows for pixel-perfect layout at nonintegral scale factors for
> interfaces designed in Interface Builder. Neither was previously
> possible.

Erica Sadun's [iOS Auto Layout Demystified][] does a very good job at explaining the system's motivations and gives a lot of tips & tricks on Auto Layout. The second edition have been revised for iOS 7 and Xcode 5, and I've particularly appreciated the parts explaing Interface Builder.

Highly recommended.

If you're looking for other Auto Layout pointers, the WWDC conferences are a good start:

WWDC 2012:

- [Introduction to Auto Layout for iOS and OS X - Session 202][]
- [Auto Layout by Example - Session 232][]
- [Best Practices for Mastering Auto Layout - Session 228][]

WWDC 2013:

- [Taking Control of Auto Layout in Xcode 5 - Session 406][]
- [Interface Builder Core Concepts - Session 405][]

We don't know what will be iOS in 5 years, but I bet we will have more resolutions and more screen forms factors. Auto Layout is designed to help you build interfaces, it's the future, so adopt it.


From jc.

[iOS Auto Layout Demystified]: http://www.amazon.com/Layout-Demystified-Edition-Mobile-Programming/dp/0321967194
[Erica Sadun]: http://ericasadun.com/
[system is declarative]: https://github.com/robrix/Postmodern-Programming/blob/master/Postmodern%20Programming.md
[Cocoa Auto Layout Release Notes]: https://developer.apple.com/library/mac/releasenotes/UserExperience/RNAutomaticLayout/index.html
[Best Practices for Mastering Auto Layout - Session 228]: https://developer.apple.com/videos/wwdc/2012/?include=228#228
[Auto Layout by Example - Session 232]: https://developer.apple.com/videos/wwdc/2012/?include=232#232
[Introduction to Auto Layout for iOS and OS X - Session 202]: https://developer.apple.com/videos/wwdc/2012/?include=202#202
[Taking Control of Auto Layout in Xcode 5 - Session 406]: https://developer.apple.com/wwdc/videos/?include=406#406
[Interface Builder Core Concepts - Session 405]: https://developer.apple.com/wwdc/videos/?include=405#405
