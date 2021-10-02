## How to Determine iOS Hardware Model?

In case you don't know, there is a [really useful category extension](https://github.com/erica/uidevice-extension/blob/master/UIDevice-Hardware.m) on `UIDevice` by [Erica Sadun](http://ericasadun.com). With this category, you can easily detect what hardware model your app is running on. It's always fun to see a new iPhone model in your stat before the “official” Apple announcement.

The `platform` selector will give you:

<!--- iPhone --->
<table>
<tr>
	<th><code>platform</code></th><th><code>Hardware</code></th>
</tr>
<tr>
	<td><code>iPhone1,1</code></td><td><code>iPhone 1G, M68</code></td>
</tr>
<tr>
	<td><code>iPhone1,2</code></td><td><code>iPhone 3G, N82</code></td>
</tr>
<tr>
	<td><code>iPhone2,1</code></td><td><code>iPhone 3GS, N88</code></td>
</tr>
<tr>
	<td><code>iPhone3,1</code></td><td><code>iPhone 4/AT&amp;T, N89</code></td>
</tr>
<tr>
	<td><code>iPhone3,2</code></td><td><code>iPhone 4/Other Carrier?, ??</code></td>
</tr>
<tr>
	<td><code>iPhone3,3</code></td><td><code>iPhone 4/Verizon, TBD</code></td>
</tr>
<tr>
	<td><code>iPhone4,1</code></td><td><code>(iPhone 4S/GSM), TBD</code></td>
</tr>
<tr>
	<td><code>iPhone4,2</code></td><td><code>(iPhone 4S/CDMA), TBD</code></td>
</tr>
<tr>
	<td><code>iPhone4,3</code></td><td><code>(iPhone 4S/???)</code></td>
</tr>
<tr>
	<td><code>iPhone5,1 </code></td><td><code>iPhone 5TBD</code></td>
</tr>
</table>

<!--- iPod Touch --->

<table>
<tr>
	<th><code>platform</code></th><th><code>Hardware</code></th>
</tr>
<tr>
	<td><code>iPod1,1</code></td><td><code>iPod touch 1G, N45</code></td>
</tr>
<tr>
	<td><code>iPod2,1</code></td><td><code>iPod touch 2G, N72</code></td>
</tr>
<tr>
	<td><code>iPod2,2</code></td><td><code>Unknown, ??</code></td>
</tr>
<tr>
	<td><code>iPod3,1</code></td><td><code>iPod touch 3G, N18</code></td>
</tr>
<tr>
	<td><code>iPod4,1</code></td><td><code>iPod touch 4G, N80</code></td>
</tr>
</table>

<!--- iPad --->

<table>
<tr>
	<th><code>platform</code></th><th><code>Hardware</code></th>
</tr>
<tr>
	<td><code>iPad1,1</code></td><td><code>iPad 1G, WiFi and 3G, K48</code></td>
</tr>
<tr>
	<td><code>iPad2,1</code></td><td><code>iPad 2G, WiFi, K93</code></td>
</tr>
<tr>
	<td><code>iPad2,2</code></td><td><code>iPad 2G, GSM 3G, K94</code></td>
</tr>
<tr>
	<td><code>iPad2,3</code></td><td><code>iPad 2G, CDMA 3G, K95</code></td>
</tr>
<tr>
	<td><code>iPad3,1</code></td><td><code>(iPad 3G, WiFi)</code></td>
</tr>
<tr>
	<td><code>iPad3,2</code></td><td><code>(iPad 3G, GSM)</code></td>
</tr>
<tr>
	<td><code>iPad3,3</code></td><td><code>(iPad 3G, CDMA)</code></td>
</tr>
<tr>
	<td><code>iPad4,1</code></td><td><code>(iPad 4G, WiFi)</code></td>
</tr>
<tr>
	<td><code>iPad4,2</code></td><td><code>(iPad 4G, GSM)</code></td>
</tr>
<tr>
	<td><code>iPad4,3</code></td><td><code>(iPad 4G, CDMA)</code></td>
</tr>
</table>
 
To be updated with the iPhone 5... and soon the iPad Mini <img src="smiley-happy.png" class="inline" style="vertical-align:middle;"/> ?...

From jc.