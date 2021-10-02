## Samsung Xpress M2875FW / AirPrint iOS 8 Compatibility Issues

After upgrading to iOS 8, I've unpleasantly discovered that I couldn't print from any iOS 8 devices on [my beloved Samsung Xpress M2875FW][]. With Yosemite, AirPrint works flawlessly; with iOS 7 devices, AirPrint works fine; with my iPhone 5C on iOS 8.1, AirPrint just reboots my printer.

The iOS 8 AirPrint issues [seems not confined to the Samsung M2875FW printer][]: HP Deskjet 2540 and 4620, Samsung CLX-3305 FW, Epson WF3520 series, Canon MG5450 etc... A lot of printers still referenced on [Apple Air Print official][] pages have been broken by iOS 8. Sad, and __certainly a bad sign after the iOS 8 / iOS 8.0.1 general quality issues__.

Thanks to the [Apple Support Communities][] and particularly [arathorn357][], I've been able to make my printer works again with iOS 8.1.

These steps apply for the Samsung Xpress M2875FW, but if you've any AirPrint issues on iOS 8, you can try these:

1. Upgrade with the [last firmware from Samsung Xpress M2875FW][]: click on Firmware, download the _Firmware File (Firmware) (ver.V3.xx.01.27)_ for Mac OS
 and install it on your printer.
2. On the devices, from System Preferences / Wi-Fi, select 'Forget this Network' option to lose the Wi-Fi connection.
3. Re-boot the devices to let the OS load from a shutdown then a cold start.
4. Re-establish a connection for each device to the Wi-Fi you want to use from System Preferences again.
5. Shut down the printer at the power switch and then power it up again.
6. Re-connect the printer to the same Wi-Fi network.
7. Then try printing using AirPrint from an iOS 8 device.	

It works for me, it could work for you. If you still have issues, try [these other suggestions][].

From jc.

[Apple Support Communities]: https://discussions.apple.com/thread/6542075
[Apple Air Print official]: http://support.apple.com/en-us/ht4356
[my beloved Samsung Xpress M2875FW]: http://blog.manbolo.com/2014/08/18/samsung-xpress-m2875fw-a-really-good-and-affordable-airprint-laser-printer
[seems not confined to the Samsung M2875FW printer]: https://discussions.apple.com/thread/6542075?start=0&tstart=0
[arathorn357]: https://discussions.apple.com/people/arathorn357
[last firmware from Samsung Xpress M2875FW]: http://www.samsung.com/us/support/owners/product/SL-M2875FW/XAA-search#firmware
[these other suggestions]: http://www.iphonetopics.com/airprint-not-working-issue-ios8/