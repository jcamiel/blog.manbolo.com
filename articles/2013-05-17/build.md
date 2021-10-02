## Passing User Variable to xcodebuild

Building app in command line with `xcodebuild` can be sometimes incredibly difficult. You can use [Facebook's xctool][] to replace `xcodebuild`, but I prefer to stick with Apple's original tools.

My last isssue with `xcodebuild` was to pass a custom user variable at compile time. I wanted my compilation command to be something like:

	clang MyAppDelegate.m -DUSE_SETTINGS_XY=42-o MyAppDelegate.o

where `USE_SETTINGS_XY` is my custom settings that I can change before compilation.

Passing this custom variable from `xcodebuild` to the linker was really not simple. If you want to do this, just follow this how-to. 

Using `xcodebuild`, a command line looks like:

	xcodebuild \
		-project MyApp \
		-scheme MyApp \
		-sdk iphoneos6.1 \
		-configuration Release \
		build
		
You can then pass any custom environment variable:

	xcodebuild \
		-project TestPreprocessor \
		-scheme TestPreprocessor \
		-sdk iphoneos6.1 \
		-configuration Release \
		USE_XY_SETTING=42 \
		build

But that is not sufficient for `xcodebuild` to translate this in a `-DUSE_SETTINGS_XY=42`. To do this, in your Xcode project, select your target, then 'Build Settings' and add in the 'Preprocessor Macros':

	 USE_SETTINGS_XY=$(USE_SETTINGS_XY)
	 
<a href="/2013/05/17/preprocessor.png"><img src="/2013/05/17/preprocessor.png" alt="Preprocessor" width="600" height="320"></a>

You can then call `xcodebuild` with different values for your custom setting:

	xcodebuild ...  USE_XY_SETTING=3 build

or

	xcodebuild ...  USE_XY_SETTING=4 build

One last thing, you must give a default value to your custom setting, so your project can still be build with Xcode IDE. In your Xcode project, select your target, then 'Build Settings' and in the right corner click on 'Add Build Setting':

![Add build setting][] 

Select 'Add User-Defined Setting' and `USE_XY_SETTING=DEFAULT_VALUE`.

<a href="/2013/05/17/default.png"><img src="/2013/05/17/default.png" alt="Default" width="600" height="240"></a>

When you will build with the Xcode IDE, you will use `DEFAULT_VALUE`, and when you will build with `xcodebuild`, you will use the value pass in the command line argument.

From jc.

[Facebook's xctool]: https://github.com/facebook/xctool
[Preprocessor]: preprocessor.png 
[Add build setting]: addsetting.png
[Default]: default.png