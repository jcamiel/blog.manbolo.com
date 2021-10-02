## Compound Literals

	CGRect frame = CGRectMake(0,0,100,100)
	UIView *aView = [[UIView alloc] initWithFrame:frame];
	
is a classic snippet code for creating a 100pt x 100pt view in Cocoa Touch. On [NSBlog](http://www.mikeash.com/pyblog/friday-qa-2011-02-18-compound-literals.html), Mike Ash shows how to use compound literals to produce a more concise code:

	UIView *aView = [[UIView alloc] initWithFrame:(CGRect){0,0,100,100}];
	
`(CGRect){0,0,100,100}` is the equivalent of `CGRectMake(0,0,100,100)` without the need for an external function.	

Now, I use this syntax a lot, as in 

	myView.center = (CGPoint){160,240};
	
	
instead of

	myView.center = CGPointMake(160, 240);
	
It's more concise, and avoid a function call. Compound literals can even be used to initialize only one member of a structural, and let others set to zero:

	someView.frame = (CGRect){ .size = someSize }; 

And in arrays:

	int myarray[3] = { [1] = 3 }; //results in {0, 3, 0} 

I don't see any good reasons no to use them. Goodbye `CGRectMake`, `CGSizeMake` and `CGPointMake`!

From jc.
	 
