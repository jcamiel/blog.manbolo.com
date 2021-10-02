## UIAlertView Bug on iOS 7

You like that [UIAlertView contentView property have been removed from iOS 7?][]
You will love this!

In iOS 7, [tint color][] plays a major role in your app. With the abandon of button's borders, tint color indicates strongly (if not exclusively) that a control is interactive.

From the [iOS 7 UI Transition Guide][]:

> When an alert or action sheet appears, iOS 7 automatically dims
> the tint color of the views behind it. To respond to this color change,
> a custom view subclass that uses tintColor in its rendering should override
> tintColorDidChange to refresh the rendering when appropriate.

When an `UIAlertView` is shown, all controls under the `UIAlertView` are greyed to emphasise the alert and re-colored on the `UIAlertView` dismiss. I find this default behaviour kind of cool and like it.

<div class="center">
<a href="/2013/12/04/step1.png"><img class="inline bordered" style="width:200px; height:300px;" src="/2013/12/04/step1.png" alt=""/></a>
<a href="/2013/12/04/step2.png"><img class="inline bordered" style="width:200px; height:300px;" src="/2013/12/04/step2.png" alt=""/></a>
</div>

A best practice very often advertised by Apple with `UIAlertView` is to dismiss an `UIAlertView` when your app goes into background. This is to insure not to present an `UIALertView` out-of-context the next time a user launch your app.

Doing this, from iOS 4 to iOS 6 has been really simple and straightforward. Given a view controller that has a `IBAction` showing an `UIAlertView`:

	- (IBAction)tap:(id)sender
	{
    	self.alertView = [[UIAlertView alloc] initWithTitle:@"Hello"
			message:@"A standard UIAlertView"
			delegate:nil
			cancelButtonTitle:@"OK"
			otherButtonTitles:nil];
			
    	[self.alertView show];
	}


One has just register to `UIApplicationDidEnterBackgroundNotification` in `viewDidLoad` :

	- (void)viewDidLoad
	{
    	[super viewDidLoad];
    
    	[[NSNotificationCenter defaultCenter] addObserver:self
    		selector:@selector(applicationDidEnterBackground:)
    		name:UIApplicationDidEnterBackgroundNotification
            	object:nil];
    
	}

and dismiss the `UIAlertView` when handling `UIApplicationDidEnterBackgroundNotification`:

	- (void)applicationDidEnterBackground:(NSNotification *)theNotification
	{
    	NSInteger cancelButtonIndex = self.alertView.cancelButtonIndex;
	    [self.alertView dismissWithClickedButtonIndex:cancelButtonIndex
	                                         animated:NO];
	}

On iOS 7, this code should have worked flawlessly. The alert view is dismissed when the app goes into background. But when the app is activated again into foreground, all controls that have been automatically dimmed by the system while the alert view was shown are still dimmed. Not only are they dimmed but they are also active and enable!

<div class="center">
<a href="/2013/12/04/step3.png"><img class="inline bordered" style="width:200px; height:300px;" src="/2013/12/04/step3.png" alt=""/></a>
<a href="/2013/12/04/step4.png"><img class="inline bordered" style="width:200px; height:300px;" src="/2013/12/04/step4.png" alt=""/></a>
</div>

The code is so simple that I'm pretty sure this is a bug of iOS 7 (or at least 7.0 to 7.0.4). You can download the [sample code for this bug here][] and I've filled a bug [rdar://15582862][] for it.

Let's hope it will be fixed soon!

From jc.

[iOS 7 UI Transition Guide]: [https://developer.apple.com/library/etc/redirect/WWDR/iOSUITransitionGuide
[UIAlertView contentView property have been removed from iOS 7?]: http://blog.manbolo.com/2013/08/05/uialertviews-contentview-property-removed-from-ios-7
[sample code for this bug here]: /2013/12/04/TestModal.zip
[rdar://15582862]: http://openradar.appspot.com/15582862
[tint color]: https://developer.apple.com/library/ios/documentation/userexperience/conceptual/transitionguide/AppearanceCustomization.html#//apple_ref/doc/uid/TP40013174-CH15-SW3