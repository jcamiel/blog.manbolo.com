## Compiler Warnings for Objective-C Developers by Ole Begemann

[Ole Begemann on compiler warning:][]

> You should always strive for a project that builds with zero warnings. A code
> base that leaves compiler warnings unfixed is a sign of carelessness on the
> part of the developer.

Because the compiler knows more about machine architecture, because he is less lazy than me, because he is clever, because he is rentless, I always care when he complains. 

* * *

A recent example of mine: I've declared an `IBAction` in a subclass of `UITableViewCell`  

in `GotoCell.h`:
	
	@interface GotoCell : UITableViewCell 
	
		- (IBAction)select:(id)sender;

	@end

in `GotoCell.m`:
 
	@implementation GotoCell 
	
		- (IBAction)select:(id)sender{
			NSLog(@"Cell has been selected")
		}

	@end

In Xcode 4.6.2, these apparently innocuous lines started to give warnings:

	/Users/jc/Documents/Dev/Meon/iOS-Meon/Classes/GotoCell.m:58:1: warning: attributes on method implementation and its declaration must match [-Wmismatched-method-attributes]
	{
	^
	/Users/jc/Documents/Dev/Meon/iOS-Meon/Classes/GotoCell.h:28:1: note: method 'select:' declared here
	- (IBAction)select:(id)sender;
	^
	1 warning generated.
 

How the hell this basic Objective-C code could raise warning? Command+click on the selector name in the implementation file gives me the answer:

![Warning popup][] 

In `UIResponder.h`, there is a category on `NSObject` called `UIResponderStandardEditActions`, that already declared `select:`. The difference is just in the returned type `void` instead of `IBAction`, which are exactly the same and `NS_AVAILABLE_IOS(3_0)` which decorates the selector 

	@interface NSObject(UIResponderStandardEditActions)   // these methods are not implemented in NSObject

	- (void)cut:(id)sender NS_AVAILABLE_IOS(3_0);
	- (void)copy:(id)sender NS_AVAILABLE_IOS(3_0);
	- (void)paste:(id)sender NS_AVAILABLE_IOS(3_0);
	- (void)select:(id)sender NS_AVAILABLE_IOS(3_0);

In this case, I thanks the compiler to warm me about this because I didn't want to override the select selector of `NSObject(UIResponderStandardEditActions)`, I just wanted to have my own selector.

So I rename my methods to `selectCell:`. (You can arguably say that there is a small risk that `selectCell:` is also declared somewhere... [If only we could have namespace in Objective-C!][])

* * *

    
<p><br/><em>Zen of Developer: always strive for 0 warning</em><br/><br/></p>
    

* * *

A last note: Xcode 4.6 brings new warnings, more information at <http://useyourloaf.com/blog/2013/03/03/xcode-4-dot-6-recommended-build-settings.html>


From jc.

[Warning popup]: warning.png
[Ole Begemann on compiler warning:]: http://oleb.net/blog/2013/04/compiler-warnings-for-objective-c-developers/
[If only we could have namespace in Objective-C!]: http://www.optshiftk.com/2012/04/draft-proposal-for-namespaces-in-objective-c/
