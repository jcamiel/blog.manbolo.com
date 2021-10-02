## Accessibility Improvements on iOS 6

Waiting for WWDC 2013 to begin, it's a good idea to watch the last unread sessions of last year.

Recently, I came across [WWDC 2012 Accessibility for iOS session][]. This session is titled "Raising the bar", because making your app accessible, is not only noble, but also it's a mark of care and polish from the developer. [Accessibility on iOS][] is huge, and simple to implement, so there is no good reason to avoid it! (must read: [Accessibility for iPhone and iPad apps][] and [iOS Accessibility Heroes and Villains][] by [Matt Gemmell][]).

iOS 6 brings some improvements to Accessibility (I wasn't aware of it until I watch the videos). The most impressive is [Speak Selection][]. Speak Selection lets you highlight text in any application by double tapping it. Even if you don’t have VoiceOver enabled, Speak Selection will read you the highlighted text
, and will detect automatically the language used. I've always found that computer generated voice and speaking wasn't good, but 'Speak Selection' has raised the bar.

<p align="center"><iframe src="http://player.vimeo.com/video/65652265?title=0&amp;byline=0&amp;portrait=0" width="600" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></p>

I find fascinating to have all this cleverness and power in a so small device. You can activate 'Speak Selection' by going to 'Settings' > 'General' > 'Accessibility' > 'Speak Selection' > 'On'.

Following the reading of this session, I've started to watch how Accessibility is supported by my today's apps. Interesting, [my bank app from la Société Générale][] switches the numerical input login screen with and 'audio' login as soon as VoiceOver has been detected. Clever and interesting (you can implement this by using `UIAccessibilityIsVoiceOverRunning()` and listening to `UIAccessibilityVoiceOverStatusChanged` notifications to find out when VoiceOver starts and stops).

<p>
<img class="left" src="/2013/05/07/normal.png" alt="App login normal" width="298" height="447">
<img class= "right" src="/2013/05/07/voiceover.png" alt="App login with VoiceOver" width="298" height="447">
</p>

From jc.

[WWDC 2012 Accessibility for iOS session]: https://developer.apple.com/videos/wwdc/2012/?id=210
[Accessibility on iOS]: http://developer.apple.com/library/ios/documentation/UserExperience/Conceptual/iPhoneAccessibility/Introduction/Introduction.html#//apple_ref/doc/uid/TP40008785
[Speak Selection]: http://www.apple.com/accessibility/iphone/vision.html
[Accessibility for iPhone and iPad apps]: http://mattgemmell.com/2010/12/19/accessibility-for-iphone-and-ipad-apps/
[iOS Accessibility Heroes and Villains]: http://mattgemmell.com/2012/10/26/ios-accessibility-heroes-and-villains/
[Matt Gemmell]: https://twitter.com/mattgemmell
[my bank app from la Société Générale]: https://itunes.apple.com/fr/app/lappli-societe-generale/id376991016?mt=8
[App login normal]: normal.png
[App login with VoiceOver]: voiceover.png
