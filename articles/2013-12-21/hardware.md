## UIDevice Hardware Category

If you need a human readable description of an iOS device, check out [UIDevice+Hardware][] category on GitHub. Previously, I was using [Erica Sadun's various categories][] on `UIDevice` but the last commit happened a year ago. [UIDevice+Hardware][] seems simpler and more up to date.

The core of the code relies on Apple's internal naming:

	- (NSString*)hardwareString
	{
    	size_t size = 100;
	    char *hw_machine = malloc(size);
    	int name[] = {CTL_HW,HW_MACHINE};
	    sysctl(name, 2, hw_machine, &size, NULL, 0);
    	NSString *hardware = [NSString stringWithUTF8String:hw_machine];
	    free(hw_machine);
    	return hardware;
	}

The code is straightforward but could be a lot simpler by using a lookup table. Instead of this:

	- (NSString*)hardwareSimpleDescription
	{
    	NSString *hardware = [self hardwareString];
	    if ([hardware isEqualToString:@"iPhone1,1"])    return @"iPhone 2G";
    	if ([hardware isEqualToString:@"iPhone1,2"])    return @"iPhone 3G";
	    if ([hardware isEqualToString:@"iPhone2,1"])    return @"iPhone 3GS";
    	if ([hardware isEqualToString:@"iPhone3,1"])    return @"iPhone 4";
	    if ([hardware isEqualToString:@"iPhone3,2"])    return @"iPhone 4";
    	if ([hardware isEqualToString:@"iPhone3,3"])    return @"iPhone 4";
	    if ([hardware isEqualToString:@"iPhone4,1"])    return @"iPhone 4S";
    	if ([hardware isEqualToString:@"iPhone5,1"])    return @"iPhone 5";

		...
		return nil;
	}
	
Why not simply use [dictionary literals][]?

	- (NSString*)hardwareSimpleDescription
	{
    	NSString *hardware = [self hardwareString];
    	if (!hardware) return nil;
    	
    	NSDictionary *hardwareToSimple = @{
    										@"iPhone1,1": @"iPhone 2G",
    									  	@"iPhone1,2": @"iPhone 3G", 
    									  	@"iPhone2,1": @"iPhone 3GS",
    									  	@"iPhone3,1": @"iPhone 4", 
    									  	...
    									  }
    	return hardwareToSimple[hardware];
	}
	
	

For the record, the current list of iOS devices is:

<table style="border-collapse: collapse;">

<tr><th><code>platform</code></th><th><code>Hardware</code></th></tr>

<!-- iPhone -->

<tr><td><code>iPhone1,1</code></td><td><code>iPhone 2G</code></td></tr>
<tr><td><code>iPhone1,2</code></td><td><code>iPhone 3G</code></td></tr>

<tr><td><code>iPhone2,1</code></td><td><code>iPhone 3GS</code></td></tr>

<tr><td><code>iPhone3,1</code></td><td><code>iPhone 4</code></td></tr>
<tr><td><code>iPhone3,2</code></td><td><code>iPhone 4</code></td></tr>
<tr><td><code>iPhone3,3</code></td><td><code>iPhone 4</code></td></tr>

<tr><td><code>iPhone4,1</code></td><td><code>iPhone 4S</code></td></tr>

<tr><td><code>iPhone5,1</code></td><td><code>iPhone 5</code></td></tr>
<tr><td><code>iPhone5,2</code></td><td><code>iPhone 5</code></td></tr>
<tr><td><code>iPhone5,3</code></td><td><code>iPhone 5c</code></td></tr>
<tr><td><code>iPhone5,4</code></td><td><code>iPhone 5c</code></td></tr>

<tr><td><code>iPhone6,1</code></td><td><code>iPhone 5s</code></td></tr>
<tr style="border-bottom:1px solid black;"><td><code>iPhone6,2</code></td><td><code>iPhone 5s</code></td></tr>

<!-- iPod -->
<tr><td><code>iPod1,1</code></td><td><code>iPod Touch (1 Gen)</code></td></tr>
<tr><td><code>iPod2,1</code></td><td><code>iPod Touch (2 Gen)</code></td></tr>
<tr><td><code>iPod3,1</code></td><td><code>iPod Touch (3 Gen)</code></td></tr>
<tr><td><code>iPod4,1</code></td><td><code>iPod Touch (4 Gen)</code></td></tr>
<tr style="border-bottom:1px solid black;"><td><code>iPod5,1</code></td><td><code>iPod Touch (5 Gen)</code></td></tr>

<!-- iPad -->

<tr><td><code>iPad1,1</code></td><td><code>iPad</code></td></tr>
<tr><td><code>iPad1,2</code></td><td><code>iPad</code></td></tr>

<tr><td><code>iPad2,1</code></td><td><code>iPad 2</code></td></tr>
<tr><td><code>iPad2,2</code></td><td><code>iPad 2</code></td></tr>
<tr><td><code>iPad2,3</code></td><td><code>iPad 2</code></td></tr>
<tr><td><code>iPad2,4</code></td><td><code>iPad 2</code></td></tr>
<tr><td><code>iPad2,5</code></td><td><code>iPad mini</code></td></tr>
<tr><td><code>iPad2,6</code></td><td><code>iPad mini</code></td></tr>
<tr><td><code>iPad2,7</code></td><td><code>iPad mini</code></td></tr>

<tr><td><code>iPad3,1</code></td><td><code>iPad 3</code></td></tr>
<tr><td><code>iPad3,2</code></td><td><code>iPad 3</code></td></tr>
<tr><td><code>iPad3,3</code></td><td><code>iPad 3</code></td></tr>
<tr><td><code>iPad3,4</code></td><td><code>iPad 4</code></td></tr>
<tr><td><code>iPad3,5</code></td><td><code>iPad 4</code></td></tr>
<tr><td><code>iPad3,6</code></td><td><code>iPad 4</code></td></tr>

<tr><td><code>iPad4,1</code></td><td><code>iPad Air</code></td></tr>
<tr><td><code>iPad4,2</code></td><td><code>iPad Air</code></td></tr>
<tr><td><code>iPad4,3</code></td><td><code>iPad Air</code></td></tr>

<tr><td><code>iPad4,4</code></td><td><code>iPad mini Retina</code></td></tr>
<tr><td><code>iPad4,5</code></td><td><code>iPad mini Retina</code></td></tr>

</table>


From jc.

[dictionary literals]: http://clang.llvm.org/docs/ObjectiveCLiterals.html
[UIDevice+Hardware]: https://github.com/InderKumarRathore/UIDevice-Hardware
[Erica Sadun's various categories]: https://github.com/erica/uidevice-extension
[Erica Sadun]: http://ericasadun.com/