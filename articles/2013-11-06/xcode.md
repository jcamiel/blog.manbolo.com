## Xcode 5.0.1 Crashes 64-bit Devices

If you're developing on your shiny new iPhone 5s or iPad Air with Xcode 5.0.1, you may have encounter strange "screens of death" on your device.

These issues have been reported multiple times on Apple Developer forum [^1] [^2] and there is a solution: __Xcode 5.0.2 GM__.

From the [release notes][]:

> Issues Resolved in Xcode 5.0.2 GM seed    
> Launching a 64-bit application on a device from Xcode multiple times causes
> the device to stop responding (and require a soft-reset).  This has been
> resolved. (15338361)

If you're developing with Xcode 5.0.1, trash it and go [download Xcode 5.0.2 GM][] right now!

From jc.

[^1]: <https://devforums.apple.com/message/915567#915567>
[^2]: <https://devforums.apple.com/message/915566#915566>

[release notes]: http://adcdownload.apple.com/Developer_Tools/xcode_5.0.2_gm_seed/xcode_5.0.2_gm_seed_release_notes.pdf
[download Xcode 5.0.2 GM]: https://developer.apple.com/downloads/index.action
 