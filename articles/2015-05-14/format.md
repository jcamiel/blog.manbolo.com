## Code Beautifier in Xcode

Among various things, what I love about Python is that the style / formatting of Python code is "standardized", [PEP 8][] giving strong coding conventions that every (sane) Python developer follows with love. One of [Guido][]'s key insights is that code is read much more often than it is written, so it's important that your code is readable and consistent, particularly when you're working in team. [Go][] goes even further, with <a href="http://golang.org/cmd/gofmt/">`gofmt`</a> a tool that automatically standardize indentation, spacing and other details of code.

Objective-C is also heavily conventionalised: in [Apple developer library][], you can find [Coding Guidelines for Cocoa][], but this document is mainly about __naming conventions__. If you're an experienced Objective-C developer, chances are good that your functions, methods and class names will be the same as another Objective-C developer one's (for instance, very few chances to have a method named `-get_app_id:(NSString *)id`, instead of `-applicationForIdentifier:(NSString *)identifier`). 

But there are no strong conventions (at least from Apple) about __how to format your code__: spaces vs tabs, if-then-else braces style, parameters and operators formatting etc... Moreover, code formatting in Xcode (as Xcode 6.3.1) is quite limited. You can select your code and re-indent it (Editor > Structure > Re-Indent or ctrl+I), but you've very few possibilities to customize the formatting rules. 

Ultimately, what you want to do is having your code automatically formatted, following guidelines that you've defined in team and apply. Fortunately, Xcode can be easily extended for source code processing, as we've seen in our last post [Extend Xcode with Text Services][]. In this post, I'll show you two possibilities for formatting your code to your needs.

### 1. clang-format

<a href="http://clang.llvm.org/docs/ClangFormat.html">`clang-format`</a> is a command-line tool to format C/C++/Obj-C code. `clang-format` formats the code from standard input and writes the result to the standard output.

Instead of having hundreds of configuration options, `clang-format` has built-in styles:

- LLVM: a style complying with the [LLVM coding standards][],
- Google: a style complying with [Google’s C++ style guide][],
- Chromium: a style complying with [Chromium’s style guide][],
- Mozilla: A style complying with [Mozilla’s style guide][],
- WebKit A style complying with [WebKit’s style guide][].

You can base your `clang-format` configuration on these predefined style guides, and overrides some style options (see [the complete list here][]).

`clang-format` will search for a configuration file (named either `.clang-format` or `_clang-format`) in the folder of the source file, or recursively in the parent folder until it find a configuration file (this way, you can commit a configuration file to the root folder of your source project and have it shared by the whole team for a given project).

An example of such configuration file:

	---
	# We'll use defaults from the LLVM style, but with 4 columns indentation.
	BasedOnStyle: LLVM
	IndentWidth: 4
	---
	Language: Cpp
	# Force pointers to the type for C++.
	DerivePointerAlignment: false
	PointerAlignment: Left
	---
	Language: JavaScript
	# Use 100 columns for JS.
	ColumnLimit: 100
	---
	Language: Proto
	# Don't format .proto files.
	DisableFormat: true
	...

We've seen how to write text services in Automator [to extend Xcode text features][]. Now, we can use this method to write a service that will take text selection as input, and replace with it formatted output,

First, we need to install `clang-format` on our system. The easiest way is using [Homebrew][]:

	$ brew install clang-format

Then, we're going to write a text services that will use `clang-format` to format a text selection:

1. Launch Automator, click on 'Services', then 'Choose'
2. Select 'Run Shell Script' from the Library
3. In the shell script box, write this command:

		export PATH=/usr/local/bin:$PATH
		clang-format
4. Select ’Output replaces selected text’ and save under the name ’clang-format’ 
5. Create a `.clang-format` file __in your home directory__ and write your options. For instance:
	
		# We'll use defaults from the LLVM style, but with 4 columns indentation.
		BasedOnStyle: LLVM
		IndentWidth: 4	

Now, select some code in Xcode, right-click and select clang-format:

<img src="/2015/05/14/clang-format.gif" width=632 height=810>

If you prefer, you can specify your options style directly in the workflow (instead of relying on the `.clang-format` file in your home):

		clang-format -style="{IndentWidth: 4, TabWidth: 4, UseTab: Never, 	BreakBeforeBraces: Stroustrup}"


`clang-format` is very promising, and easy to use. There are a limited set of configurable options, the downside is that it might not suit your style well. For instance, configuring the breaking braces is either Linux, Stroustrup, Allman or GNU, period. If you find `clang-format` not enough configurable, you can use another solution, like <a href="http://uncrustify.sourceforge.net">`uncrustify`</a>.

_Note:_ you can easily create a default `.clang-format` file if you need to see all the default options:

	clang-format -style=llvm -dump-config > .clang-format 

### 2. uncrustify

`uncrustify` is another source code beautifier, but contrary to `clang-format`, it's _highly_ configurable (454 configurable options as of version 0.60). The documentation is quite limited, you will need to find what your want in [the latest configuration file on GitHub][]. But you will be able to create a style that suit you perfectly.

The simplest way to configure `uncrustify` is to have a configuration file named `.uncrustify.cfg` in your home directory. You will find some examples of configuration files <a href="https://github.com/bengardner/uncrustify/tree/master/etc">on the `uncrustify` GitHub repo</a>, but my best advise is to start with an empty configuration file, and add option one by one, by testing the output (`uncrustify` specific options to Objective-C contains `_oc_` in the name, like `sp_after_oc_scope`, `sp_after_oc_return_type` etc...)

As with `clang-format`, we can write a service that will take text selection as input and replace with it formatted output,

First, we need to install `uncrustify` on our system. The easiest way is using [Homebrew][]:

	$ brew install uncrustify

Then, we're going to write a text services that will use `uncrustify` to format a text selection:

1. Launch Automator, click on 'Services', then 'Choose'
2. Select 'Run Shell Script' from the Library
3. In the shell script box, write this command:

		export PATH=/usr/local/bin:$PATH
		uncrustify -l oc
4. Select ’Output replaces selected text’ and save under the name ’uncrustify’ 
5. Create a `.uncrustify.cfg` file __in your home directory__ and write your options. For instance:

		# The number of columns to indent per level.
		# Usually 2, 3, 4, or 8.
		indent_columns = 4        # number
		
		# How to use tabs when indenting code
		# 0=spaces only	
		# 1=indent with tabs to brace level, align with spaces
		# 2=indent and align with tabs, using spaces when not on a tabstop
		indent_with_tabs = 0        # number
		
		
		# Add or remove space around assignment operator '=', '+=', etc
		sp_assign = force   # ignore/add/remove/force

Now, select some code in Xcode, right-click and select uncrustify.

That's all folks!

From jc.

[the latest configuration file on GitHub]: https://github.com/bengardner/uncrustify/blob/master/etc/defaults.cfg
[the complete list here]: http://clang.llvm.org/docs/ClangFormatStyleOptions.html#configurable-format-style-options
[Homebrew]: http://brew.sh
[LLVM coding standards]: http://llvm.org/docs/CodingStandards.html
[Google’s C++ style guide]: http://google-styleguide.googlecode.com/svn/trunk/cppguide.xml
[Chromium’s style guide]: http://www.chromium.org/developers/coding-style
[Mozilla’s style guide]: https://developer.mozilla.org/en-US/docs/Developer_Guide/Coding_Style
[WebKit’s style guide]: http://www.webkit.org/coding/coding-style.html
[Apple Developer Library]: https://developer.apple.com/library/
[PEP 8]: https://www.python.org/dev/peps/pep-0008/
[Guido]: http://en.wikipedia.org/wiki/Guido_van_Rossum
[Go]: http://en.wikipedia.org/wiki/Go_(programming_language)
[Coding Guidelines for Cocoa]: https://developer.apple.com/library/mac/documentation/Cocoa/Conceptual/CodingGuidelines/CodingGuidelines.html
[Extend Xcode with Text Services]: http://blog.manbolo.com/2015/04/01/extend-xcode-with-text-services
[to extend Xcode text features]: http://blog.manbolo.com/2015/04/01/extend-xcode-with-text-services
