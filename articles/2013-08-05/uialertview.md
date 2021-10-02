## UIAlertView's contentView Property Removed From iOS 7

This is bad news for iOS developers, the newly `contentView` property of `UIAlertView`, [announced in "Building User Interfaces for iOS 7" WWDC session][], has been cancelled. From the UIKit evangelist on [Apple forum][]:

> This API addition has been removed from iOS 7. Please file an enhancement
> request if you would like to see it in a future release.

Too bad, there were a hearty round of applause from developers after the announcement at the WWDC. Simply because, since iOS 2, appart from the addition of `textField` property, there has been no simple way to customize `UIAlertView`. Until iOS 6, you could add some views to the `UIAlertView` subviews hierarchy, but this doesn't seems to work anymore on iOS 7 (at least, in Beta 4). 

Not good...

From jc.

[Apple forum]: https://devforums.apple.com/thread/196613?tstart=0
[announced in "Building User Interfaces for iOS 7" WWDC session]: https://developer.apple.com/wwdc/videos/?include=201#201

