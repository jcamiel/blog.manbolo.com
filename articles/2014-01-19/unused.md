## Find Unused Images in Xcode Project

### Introducing ack

[ack][] is a powerful grep replacement, I use it everyday to search for patterns in files. For instance, if I want to search for occurrences of `CMBitmapNumberView` in my source project, I just type:

	ack CMBitmapNumberView 
	
and _instantaneously_, I can see where this string is used. The good thing about `ack` is that `ack` defaults to only searching source code. In case of iOS projects, it means that it will search inside \*.h, \*.m, \*.xib, *.plist etc... It just works and if you're not already convinced, read the [Top 10 reasons to use ack for source code][].

### Installing ack on OSX (piece of cake)

On OSX, you can install `ack` with [homebrew][]:

	brew install ack
	
### Find unused images in Xcode project

As `ack` is searching through source code files __and__ xib files, you can use it to search for images usage.

For instance, if I want to know where is used the image 'BigButton.png', I just type: 

	ack BigButton
	
and `ack` will look though .m, .h and .xib files. Thanks to this [Stack Overflow thread][], I use ack to find unused images in my Xcode project, with this litte script:

	#!/bin/bash

	for i in `find . -name "*.png" -o -name "*.jpg"`; do 
		file=`basename -s .jpg "$i" | xargs basename -s .png | xargs basename -s @2x`
		result=`ack -i "$file"`
		if [ -z "$result" ]; then
			echo "$i"
		fi
	done

So usefull if you like to have a clean project!	

From jc.

[ack]: http://beyondgrep.com/
[Top 10 reasons to use ack for source code]: http://beyondgrep.com/why-ack/
[homebrew]: http://brew.sh/
[Stack Overflow thread]: http://stackoverflow.com/questions/6113243/how-to-find-unused-images-in-an-xcode-project