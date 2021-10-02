## [NSString boolValue]

If you don't know [NSHipster][], you're missing a real gem among Cocoa blogs. [Mattt Thompson][] has created this journal to weekly lighten unknown Cocoa / Cocoa Touch classes. And Mattt was even on stage at the WWDC 2013, presenting some [Hidden Gems in Cocoa and Cocoa Touch][].

As a tribute to NSHipster, let me present `[NSString boolValue]`. Every tailored iOS developer should know this method that converts a `BOOL` from a `NSString`. 

Reading [from the doc][]:

> __boolValue__    
> Returns the Boolean value of the receiver’s text.
>
> \- (BOOL)boolValue    
> __Return Value__    
> The Boolean value of the receiver’s text. Returns YES on encountering one of
> "Y", "y", "T", "t", or a digit 1-9—the method ignores any trailing characters.
> Returns NO if the receiver doesn’t begin with a valid decimal text
> representation of a number.

So `booValue` can scan and produce these outputs from the followings strings input:

<table>
<tr><th><code>string</code></th><th><code>boolValue</code></th></tr>
<tr><td><code>Y</code></td><td><code>YES</code></td></tr>
<tr><td><code>N</code></td><td><code>NO</code></td></tr>
<tr><td><code>T</code></td><td><code>YES</code></td></tr>
<tr><td><code>F</code></td><td><code>NO</code></td></tr>
<tr><td><code>t</code></td><td><code>YES</code></td></tr>
<tr><td><code>f</code></td><td><code>NO</code></td></tr>
<tr><td><code>1</code></td><td><code>YES</code></td></tr>
<tr><td><code>0</code></td><td><code>NO</code></td></tr>
<tr><td><code>Yes</code></td><td><code>YES</code></td></tr>
<tr><td><code>No</code></td><td><code>NO</code></td></tr>
<tr><td><code>No really no</code></td><td><code>NO</code></td></tr>
<tr><td><code>true</code></td><td><code>YES</code></td></tr>
<tr><td><code>false</code></td><td><code>NO</code></td></tr>
<tr><td><code>To be or not to be</code></td><td><code>YES</code></td></tr>
<tr><td><code>False</code></td><td><code>NO</code></td></tr>
<tr><td><code>3567</code></td><td><code>YES</code></td></tr>
<tr><td><code>0123456789</code></td><td><code>NO</code></td></tr>
</table>

With [this snippet][], you can to check the results:

	#import <Foundation/Foundation.h>

	// clang -g -framework Foundation -o bool bool.m

	int main (void)
	{
    	NSArray *tests = @[	@"Y", 
    						@"N", 
    						@"T", 
    						@"F", 
    						@"t", 
    						@"f", 
    						@"1", 
    						@"0", 
    						@"Yes", 
    						@"No", 
    						@"No really no", 
    						@"true", 
    						@"false", 
    						@"To be or not to be", 
    						@"False", 
    						@"3567",
							@"0123456789"
    						];
	    NSArray *boolToString = @[@"NO", @"YES"];

    	for (NSString *test in tests){
        	NSLog(@"boolValue:\"%@\" => %@", test, boolToString[[test boolValue]]);
    	}
    
	    return 0;
	}

Super minimalist and smart algorithm, you can also use `boolValue`'s companion: `doubleValue`, `floatValue`, `intValue`, `integerValue`, `longLongValue`. If you didn't learn anything, check [NSHipster][], I promisse you will learn a lot...

From jc.

[NSHipster]: http://nshipster.com/
[Mattt Thompson]: http://mattt.me/
[Hidden Gems in Cocoa and Cocoa Touch]: http:/developper.apple.com/videos/wwdc/2013/
[this snippet]: http://blog.manbolo.com/2012/12/04/tiny-programs-the-atomic-edition-by-mark-dalrymple
[from the doc]: http://developer.apple.com/library/mac/#documentation/Cocoa/Reference/Foundation/Classes/NSString_Class/Reference/NSString.html