## Invasion of the Smart App Banners

On iOS 6, Apple has introduced the _Smart App Banners_, a new way to promote your native app from your website. It's basically a banner that is displayed automatically on your website, with the App Store icon of your app, the rating, and some screenshots on iPad. If the app is not installed, clicking on the Smart App Banner opens the App Store app page. If the app is installed, clicking on it will launch the app.

Here are some examples:
  
[Le Monde.fr](https://itunes.apple.com/fr/app/le-monde.fr/id294047850?mt=8):

<p><img src="/2012/10/19/lemonde.png" alt="Le Monde.fr Smart App Banner" width="400" height="600"></p>

[Instapaper](https://itunes.apple.com/fr/app/instapaper/id288545208?mt=8):

<p><img src="/2012/10/19/instapaper.png" alt="Instapaper Smart App Banner" width="400" height="409"></p>

[Photo Discover](https://itunes.apple.com/us/app/photo-discover/id446635942?mt=8):

<p><img src="/2012/10/19/photodiscover.png" alt="Photo Discover Smart App Banner" width="400" height="409"></p>

[Check The Weather](https://itunes.apple.com/us/app/check-the-weather/id557872119?mt=8):

<p><img src="/2012/10/19/checktheweather.png" alt="Check The Weather Smart App Banner" width="400" height="409"></p>

And, of course, [Meon](https://itunes.apple.com/app/meon/id400274934?mt=8) on iPhone:

<p><img src="/2012/10/19/meon.png" alt="Meon iPhone Smart App Banner" width="400" height="409"></p>

And on iPad (notice the additional screenshots):

<p><img src="/2012/10/19/meonipad.jpg" alt="Meon iPad Smart App Banner" width="600" height="299"></p>

Integrating a Smart App Banner in your website is straightforward: you just have to add one line in your html header, inside the `<head>` tag:

<pre><code>&lt;meta name="apple-itunes-app" content=<b>"app-id=400274934"</b>&gt;</code></pre>

where `400274934` is your application id. You can even provide an [URL scheme](http://developer.apple.com/library/ios/#documentation/iphone/conceptual/iphoneosprogrammingguide/AdvancedAppTricks/AdvancedAppTricks.html) that will be passed to your app when the app is installed and the user clics on 'Open'. You can add parameters to this custom URL scheme, to provide some context on your app; for instance: launch the app in a specific state, on some profiles etc... 

For example, let's say that Meon respond to the URL scheme `x-meon://`. This URL scheme can take an integer parameter, `level`, that indicates to the app to launch the specific level. Your smart app banners could then be:  

<pre><code>    &lt;meta name="apple-itunes-app" 
			content="app-id=400274934,
			<b>app-argument=x-meon://level=10</b>"&gt;
</code></pre>


In your application delegate, you juste have to implement the following selector: 

	- (BOOL)application:(UIApplication *)application
    	         openURL:(NSURL *)url
	   sourceApplication:(NSString *)sourceApplication
    	      annotation:(id)annotation
          
(available from iOS 4.2). This selector is called if your app is already running or if your app starts from scratch. In this example, the `url` variable would be the `app-argument` of the Smart App Banner `x-meon://level=10`. Usually, `sourceApplication` contains the bundleId of the launching application, but in the case of the Smart App Banner, the value is `nil`.

Finally, if you're a TradeDoubler or LinkShare affiliate [^1], you can add also your affiliate identifier and get a small percent of affiliation. 

<pre><code>    &lt;meta name="apple-itunes-app"
			content="app-id=400274934, 
			app-argument=x-meon://level=10,
			<b>affiliate-data=partnerId=30&amp;siteID=bk33jlLDYJo</b>"&gt;
</code></pre>

As you can see, adding a Smart App Banner to your website is very simple, so don't hesitate.

From jc.

[^1]: [Tools, Services, and APIs for iTunes Affiliate Program Marketing](http://developer.apple.com/devcenter/download.action?path=/wwdc_2012/wwdc_2012_session_pdfs/session_603__tools_services_and_apis_for_itunes_affiliate_program_marketing.pdf)