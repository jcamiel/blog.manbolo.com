## UIRequiredDeviceCapabilities and Device Compatibility Matrix

This is an update of the __Device Compatibility Matrix__ in the [iTunes Connect Developer Guide][], updated with the iPad 4 and the iPad mini. The matrix capabilities can be used with the `UIRequiredDeviceCapabilities` key of your `Info.plist` to precisely target your app and features (see [How to Indicate What Devices Are Supported by Your iOS App][]). Some interesting facts:

- The iPhone 5 is the first iPhone to be introduced without any new capabilities. The iPhone 5 has an `armv7s` cpu but there is no equivalent capabilities, 
- Except some weird flavours (the iPhone 4 Verizon iPhone) and the AppleTV, there are 22 iOS devices.


### iPod touch device compatibility

<table class="table-centered">

<tr>
	<th>Compatibility</th>
	<th>iPod touch</th>
	<th>iPod touch 2nd gen</th>
	<th>iPod touch 3rd gen</th>
	<th>iPod touch 4th gen</th>
	<th>iPod touch 5th gen</th>
</tr>

<tr>
	<td>accelerometer</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>armv6</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>armv7</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>auto-focus-camera*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
</tr>

<tr>
	<td>bluetooth-le*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
</tr>

<tr>
	<td>camera-flash*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
</tr>

<tr>
	<td>front-facing-camera*</td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>gamekit</td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>gps</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

<tr>
	<td>gyroscope*</td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>location-services*</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>magnetometer*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

<tr>
	<td>microphone</td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>opengles-1</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>opengles-2*</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>peer-peer</td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>sms</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

<tr>
	<td>still-camera</td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>telephony</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

<tr>
	<td>video-camera*</td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>wifi</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

</table>

### iPhone device compatibility

<table class="table-centered">

<tr>
	<th>Compatibility</th>
	<th>iPhone</th><th>iPhone 3G</th>
	<th>iPhone 3GS</th>
	<th>iPhone 3GS (China)</th>
	<th>iPhone 4</th>
	<th>iPhone 4S</th>
	<th>iPhone 5</th>
</tr>

<tr>
	<td>accelerometer</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>armv6</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>	
	<td>armv7</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>auto-focus-camera*</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>bluetooth-le*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>camera-flash*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>front-facing-camera*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>gamekit</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>gps</td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>gyroscope*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>location-services</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>magnetometer*</td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>microphone</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>opengles-1</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>opengles-2*</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>peer-peer</td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>sms</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>still-camera</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>telephony</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>video-camera*</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>wifi</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

</table>

### iPad device compatibility

<table class="table-centered">

<tr>
	<th>Compatibility</th>
	<th>iPad Wi-Fi</th>
	<th>iPad Wi-Fi + 3G</th>
	<th>iPad 2 Wi-Fi</th>
	<th>iPad 2 Wi-Fi + 3G</th>
	<th>iPad (3rd gen)</th>
	<th>iPad Wi-Fi + Cellular (3rd gen)</th>
	<th>iPad Wi-Fi (4th gen)</th>
	<th>iPad Wi-Fi + Cellular (4th gen)</th>
	<th>iPad mini</th>
	<th>iPad mini Wi-Fi + Cellular</th>
</tr>

<tr>
	<td>accelerometer</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>armv6</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>	
	<td>armv7</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>auto-focus-camera*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>bluetooth-le*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>camera-flash*</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

<tr>
	<td>front-facing-camera*</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>gamekit</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>gps</td>
	<td></td>
	<td>■</td>
	<td></td>
	<td>■</td>
	<td></td>
	<td>■</td>
	<td></td>
	<td>■</td>
	<td></td>
	<td>■</td>
</tr>

<tr>
	<td>gyroscope*</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>location-services</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>magnetometer*</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>microphone</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>opengles-1</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>opengles-2*</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>peer-peer</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>sms</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

<tr>
	<td>still-camera</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>telephony</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>

<tr>
	<td>video-camera*</td>
	<td></td>
	<td></td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

<tr>
	<td>wifi</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
	<td>■</td>
</tr>

</table>

In these table * indicates that the app _must be built with a fat binary (armv6 and armv7) or require a minimum iOS version of 4.3 or higher_.

From jc.

[iTunes Connect Developer Guide]: http://developer.apple.com/library/mac/#documentation/LanguagesUtilities/Conceptual/iTunesConnect_Guide

[How to Indicate What Devices Are Supported by Your iOS App]: http://blog.manbolo.com/2012/05/02/how-to-indicate-what-devices-are-supported-by-your-ios-app