## Tiny Programs, the Atomic Edition by Mark Dalrymple

Speaking of developer tools, a very interesting way to quickly test code snippets with [tiny programs by Mark Dalrymple][]. Using Xcode all the day, it's easy to forget that building a program from the command line is dead simple. In Mark's example, you just have to type:

	clang -g -Wall -framework Foundation -o atomic atomic.m

And boom, you've an `atomic` executable ready to test if it's better to write `(nonatomic, assign)` or `(assign, nonatomic)`. I _love_ with way of testing quick snippets and I'm trying now to put it in practices.

For instance, I've written this snippet to run some test on GLKit matrix regarding 2D transformations. To test it, just create a `matrix.m` file with this code:

	#import <Foundation/Foundation.h>
	#import <GLKit/GLKit.h>

	// clang -g -framework Foundation -framework GLKit -o matrix matrix.m

	int main (void)	
	{
		float tx = 320;
		float ty = 250;
		float theta = 0.4;
		float sx = 0.7;
		float sy = 2.4;

		//
		// Compute model view matrix With GLKit 
		GLKMatrix4 _modelViewMatrix;
		CGFloat _rotation = theta;
		GLKVector2 _scale = (GLKVector2){sx, sy};
		GLKVector2 _center = (GLKVector2){tx, ty};

		GLKMatrix4 rotation = GLKMatrix4MakeRotation(_rotation, 0, 0, 1);
    	GLKMatrix4 scale = GLKMatrix4MakeScale(_scale.x, _scale.y, 1);
    	GLKMatrix4 translationPosition = GLKMatrix4MakeTranslation(_center.x,_center.y,0);
        
    	_modelViewMatrix = GLKMatrix4Multiply(scale,rotation);
    	_modelViewMatrix = GLKMatrix4Multiply(translationPosition,_modelViewMatrix);
        
    	NSLog(@"m1=%@", NSStringFromGLKMatrix4(_modelViewMatrix));

		// Compute model view matric "by hand"
		GLKMatrix4 m2;
		m2.m00 = sx*cos(theta);
		m2.m01 = sy*sin(theta);
		m2.m10 = -sx*sin(theta);
		m2.m11 = sy*cos(theta);
		m2.m22 = 1;
		m2.m33 = 1;
		m2.m30 = tx;
		m2.m31 = ty;

    	NSLog(@"m2=%@", NSStringFromGLKMatrix4(m2));
        
    	return 0;

	}  

To compile this tiny program, simply type in a terminal window:
	
	clang -g -framework Foundation -framework GLKit -o matrix matrix.m

A side note, you can test `GLKit` snippets because the framework is now available on iOS _and_ OSX. That's really cool!

You will need Xcode command line tools to use `clang` or `gcc` in a terminal. With Xcode 4, you can simply go to Xcode > Preferences > Downloads and click on 'Command Line Tools`:

![Download command line tools][]

From jc.

[tiny programs by Mark Dalrymple]: http://blog.bignerdranch.com/995-tiny-programs-the-atomic-edition/
[Download command line tools]: cmdlinetools.png