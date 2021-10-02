## Objective-C Coding Style Guide

Python developers have [PEP 8][] and Go devs have [gofmt][] but iOS developers have no Apple official convention for style. There is the [official Coding Guidelines for Cocoa][], but it has not been updated very often, and do not cover indentation, use of [objects literals][] etc... For a while, I was using [Google Objective-C Style Guide][], but recently I come over two others guidelines for Objective-C that I've begun to follow:

- the [New York Times Objective-C Style Guide][]
- the [Github Objective-C conventions][]

### New York Times Objective-C Style Guide

You can get it [here][]. I globally like this coding style, and it feels moderns. Here is some interesting extracts:

#### Use dot-notation syntax

> Always used dot-notation for accessing and mutating properties.

<span style="color:green;">Good:</span>

	view.backgroundColor = [UIColor orangeColor];
	[UIApplication sharedApplication].delegate;

<span style="color:red;">Bad:</span>

	[view setBackgroundColor:[UIColor orangeColor]];
	UIApplication.sharedApplication.delegate

I always use dot syntax when possible (i.e when properties are declared and public), the code is much more elegant and simpler. In this example, `sharedApplication` is a class method and should not be used with dot notation (even if dot syntax is purely a convenient wrapper around accessor method calls). Still, I use sometimes dot syntax with some selectors that make sense for me like `count` on `NSArray`. 

#### Spacing

> Method braces and other braces (if/else/switch/while etc.) always open on the
> same line as the statement but close on a new line.

<span style="color:green;">Good:</span>

	if (user.isHappy) {
		//Do something
	}
	else {
		//Do something else
	}

#### Methods

> In method signatures, there should be a space after the scope (-/+ symbol). 
> There should be a space between the method segments.

<span style="color:green;">Good:</span>

	- (void)setExampleText:(NSString *)text image:(UIImage *)image;

#### Variables

> Asterisks indicating pointers belong with the variable

<span style="color:green;">Good:</span>

	NSString *text;

<span style="color:red;">Bad:</span>

	NSString* text;

#### Naming

> Long, descriptive method and variable names are good.

<span style="color:green;">Good:</span>

	UIButton *settingsButton;

<span style="color:red;">Bad:</span>	

	UIButton *setBut;

> Properties should be camel-case with the leading word being lowercase. 
> __If Xcode can automatically synthesize the variable, then let it__.

If you used to write

<pre><code>Sprite.h:
	
@interface Sprite : NSObject
{
	NSString *_imageName;
} 
@property(nonatomic, copy) NSString *imageName;

@end
</code></pre>

<pre><code>Sprite.m:
	
@implementation

@synthesize imageName = _imageName;
...

@end
</code></pre>
	
You can write now 

<pre><code>Sprite.h:
	
@interface Sprite : NSObject

@property(nonatomic, copy) NSString *imageName;

@end
</code></pre>

<pre><code>Sprite.m:
	
@implementation

...

@end
</code></pre>

And the `_imageName` ivar will be automatically create by Xcode. Huge win, you can find more information on [automatic synthesis ivar here][].
	
#### Underscores

> When using properties, instance variables should always be accessed and
> mutated using self.

I'm not really sure about this one. I follow the guideline to always access an ivar by a property when an allocation is involved, but I find the code less clear with this NYT rule.

This code:

	self.sprite = [[Sprite alloc] init];
	_sprite.x = 10.0;
	_sprite.y = 10.0;
	_sprite.frameCount = 30;
	_sprite.imageName = @"Dragon.png"
	
Should be changed to:	
	
	self.sprite = [[Sprite alloc] init];
	self.sprite.x = 10.0;
	self.sprite.y = 10.0;
	self.sprite.frameCount = 30;
	self.sprite.imageName = @"Dragon.png"
	
I don't like...

#### init and dealloc

> dealloc methods should be placed at the top of the implementation, directly
> after the @synthesize and @dynamic statements.

Mmm... I see the rational behind this, (minimal distance between your properties declared in your .h, your internal properties declared in your .m and your dealloc method), but I prefer to have the init and [designated initializer][] at the beginning of the .m files.

#### Literals 

> `NSString`, `NSDictionary`, `NSArray`, and `NSNumber` literals should be
> used whenever creating immutable instances of those objects.

<span style="color:green;">Good:</span>

	NSArray *names = @[@"Brian", @"Matt", @"Chris", @"Alex", @"Steve", @"Paul"];
	NSDictionary *productManagers = @{@"iPhone" : @"Kate", @"iPad" : @"Kamal", @"Mobile Web" : @"Bill"};
	NSNumber *shouldUseLiterals = @YES;
	NSNumber *buildingZIPCode = @10018;
	
<span style="color:red;">Bad:</span>	
	
	NSArray *names = [NSArray arrayWithObjects:@"Brian", @"Matt", @"Chris", @"Alex", @"Steve", @"Paul", nil];
	NSDictionary *productManagers = [NSDictionary dictionaryWithObjectsAndKeys: @"Kate", @"iPhone", @"Kamal", @"iPad", @"Bill", @"Mobile Web", nil];
	NSNumber *shouldUseLiterals = [NSNumber numberWithBool:YES];
	NSNumber *buildingZIPCode = [NSNumber numberWithInteger:10018];

Clearly, my favorite feature of [modern Objective-C][]. A huge win in clarity.

#### Enums

> When using enums, it is recommended to use the new fixed underlying type
> specification [...]

<span style="color:green;">Good:</span>
	
	typedef NS_ENUM(NSInteger, NYTAdRequestState) {
    	NYTAdRequestStateInactive,
	    NYTAdRequestStateLoading
	};
    
<span style="color:red;">Bad:</span>
	
	typedef enum {
    	NYTAdRequestStateInactive,
	    NYTAdRequestStateLoading
	} NYTAdRequestState;

If you use this new macro, Xcode will have better autocompletion. You can use also a new macro, `NS_OPTIONS`, for bitmask. For instance in iOS 7, `UIViewAutoresizing` is declared as:

	typedef NS_OPTIONS(NSUInteger, UIViewAutoresizing) {
    	UIViewAutoresizingNone                 = 0,
	    UIViewAutoresizingFlexibleLeftMargin   = 1 << 0,
    	UIViewAutoresizingFlexibleWidth        = 1 << 1,
	    UIViewAutoresizingFlexibleRightMargin  = 1 << 2,
    	UIViewAutoresizingFlexibleTopMargin    = 1 << 3,
	    UIViewAutoresizingFlexibleHeight       = 1 << 4,
    	UIViewAutoresizingFlexibleBottomMargin = 1 << 5
	};

[Mattt Thompson has more information][] on `NS_ENUM` and `NS_OPTIONS`.

#### Singletons

> Singleton objects should use a thread-safe pattern for creating their shared
> instance.

Here is the official snippet for singleton:

	+ (instancetype)sharedInstance {
		static id sharedInstance = nil;

		static dispatch_once_t onceToken;
		dispatch_once(&onceToken, ^{
			sharedInstance = [[self alloc] init];
		});
		return sharedInstance;
	}
	
### GitHub Objective-C style guide.
	
You can get it at <https://github.com/github/objective-c-conventions>. Some interesting points:

#### Documentation and organization

> Comments should be hard-wrapped at 80 characters.
> Comments should be Tomdoc-style.
> Use #pragma marks to categorize methods into functional groupings [...] 

I love to hard-wrapped my code (hard-wrapping is also present in [Google Objective-C Style Guide][] and [PEP 8][]), I find my code more clear, more organized and easier to diff against another file. To organise my implementation files, I also use constantly `#pragma mark Something` or better __`#pragma mark - Something`__ which insert a separator line like: 

![pragma mark -][]

#### Declarations

> - Always declare memory-management semantics even on readonly properties.
> - Don't use @synthesize unless the compiler requires it. Note that optional
> properties in protocols must be explicitly synthesized in order to exist.
> - Instance variables should be prefixed with an underscore (just like when
> implicitly synthesized).



> - Constructors should generally return instancetype rather than id.

Great [presentation of instancetype by Mattt Thompson][] again...

> - Always surround if bodies with curly braces if there is an else. Single-line
> if bodies without an else should be on the same line as the if.
> - All curly braces should begin on the same line as their associated
> statement. They should end on a new line.
> - Put a single space after keywords and before their parentheses.
> - Return and break early.
> - No spaces between parentheses and their contents.

_Love_ return and break early, remind me of [Zen of Python][] “Flat is better than nested.”

If you don't have a style guide, go pick one, your code will magically become beautiful!

From jc.

[presentation of instancetype by Mattt Thompson]: http://nshipster.com/instancetype/
[modern Objective-C]: https://developer.apple.com/videos/wwdc/2012/?id=405
[designated initializer]: https://developer.apple.com/library/ios/documentation/general/conceptual/CocoaEncyclopedia/Initialization/Initialization.html#//apple_ref/doc/uid/TP40010810-CH6-SW3
[automatic synthesis ivar here]: http://useyourloaf.com/blog/2012/08/01/property-synthesis-with-xcode-4-dot-4.html
[objects literals]: http://clang.llvm.org/docs/ObjectiveCLiterals.html
[PEP 8]: http://www.python.org/dev/peps/pep-0008/
[gofmt]: http://golang.org/cmd/gofmt/
[official Coding Guidelines for Cocoa]: https://developer.apple.com/library/mac/#documentation/Cocoa/Conceptual/CodingGuidelines/CodingGuidelines.html
[Google Objective-C Style Guide]: http://google-styleguide.googlecode.com/svn/trunk/objcguide.xml
[New York Times Objective-C Style Guide]: https://github.com/NYTimes/objective-c-style-guide
[Github Objective-C conventions]: https://github.com/github/objective-c-conventions
[pragma mark -]: separator.png
[Zen of Python]: http://www.python.org/dev/peps/pep-0020/
[here]: https://github.com/NYTimes/objective-c-style-guide
[Mattt Thompson has more information]: http://nshipster.com/ns_enum-ns_options/



