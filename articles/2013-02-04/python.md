## How to Install Python 3 and PyDev on OSX

Here is a quick tour on how to setup an effective dev environment for Python 3 on your beloved OSX.

1. [__Installing Homebrew__](#1)
2. [__Installing Python 3__](#2)
3. [__Installing Eclipse__](#3)
4. [__Installing PyDev for Eclipse__](#4)

<h3 id="1">1. Installing Homebrew</h3>

There are many package installers on OSX but I find [Homebrew][] very pleasant, simple and convenient. Homebrew, originally started by [Max Howell][], simplify the installation of open source tools (like [ImageMagick][], [wget][], [ack][] etc..) that are not by default on OSX.

What I really like with Homebrew is that everything is installed on a directory that is not conflicting with the system directories. By default, it's on `/usr/local` but you can change to whatever you like.

Installing Homebrew is very simple; open a Terminal window and type
 
	ruby -e "$(curl -fsSkL raw.github.com/mxcl/homebrew/go)"
	
Once installed, just type `brew` in a terminal to check that Homebrew is installed. There are few commands to remember:

- Updating brew and formula (ie tools/components you have installed)

		brew update 

- Searching formula

		brew search ack

- Installing / Uninstalling

		brew install FORMULA
		brew uninstall FORMULA
	For example, `brew install imagemagick` will install [ImageMagick][] on your OS, `brew uninstall ack` will uninstall ack.

- Listing installed formula
	
		brew list

- And finally, troubleshooting

		brew doctor

Type `brew doctor` and if the output is `Your system is raring to brew`, everything is ok. You can have more information on the [Homebrew wiki][].

<h3 id="2">2. Installing Python 3</h3>

To install Python 3 with Homebrew, simply type

	brew install python3
	
Once Python 3 is installed, we're going to check that is it ready to use or our system by launching the interactive console

	python3

And you should see

	$ python3
	Python 3.3.0 (default, Feb  1 2013, 22:09:55) 
	[GCC 4.2.1 Compatible Apple Clang 4.1 ((tags/Apple/clang-421.11.66))] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>> 

Type Ctrl+D to exit the interpreter. It's interesting to note that `python` launch the default 2.7 python interpreter and `python3` is launching the 3.3 python interpreter.

Now that we have Python 3 installed on our system, we are going to install a package. Python 3 comes with pip. You should pay attention to which pip you are using:
	
- __pip is for Python 2.7__ 
- __pip3 is for Python 3__

The two package managers don't share their site-package directory. If you want a python package x for both pythons, you need to install it twice. Once via pip for Python 2.7 and once via pip3 for python 3.3.

If we want to install [SQLAlchemy][] for instance, type

	pip3 install sqlalchemy

Then launch the `python3` interactive console and test that SQLAlchemy is installed now

	$ python3
	Python 3.3.0 (default, Feb  1 2013, 22:09:55) 
	[GCC 4.2.1 Compatible Apple Clang 4.1 ((tags/Apple/clang-421.11.66))] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>> import sqlalchemy
	>>> 

No error, everything is OK! Note that, with Homebrew, Python 3 packages are installed under `/usr/local/lib/python3.3/site-packages`. 

<h3 id="3">3. Installing Eclipse</h3>

Now that we have Python 3 installed, we can use [any good text editor][] to write some code. It can be also useful, but not mandatory, to use a complete IDE with Python autocompletion, debugging facilities and so on. To do so, we're going to install Eclipse and [PyDev][].

To install Eclipse, go to <http://www.eclipse.org/downloads/>, choose Mac OSX (Cocoa) and download [Eclipse Classic 4.2.1][]. Untar the downloaded file and copy the `eclipse` directory under `Applications`.

<h3 id="4">4. Installing PyDev for Eclipse</h3>

[PyDev][] is a Python IDE for Eclipse. To install it, launch Eclipse, go to 'Help > Install New Software' (you can also follow these steps on [PyDev online documentation][])

![PyDev installation step 1][]

Click on 'Add...' then PyDev in 'Name' and http://pydev.org/updates/ in 'Location'

![PyDev installation step 2][]

Tap on 'OK', then select PyDev in the combo box 'Work with:'

![PyDev installation step 3][]

'Next', select 'PyDev for Eclipse', accept the Terms & Conditions, then 'Finish'.

Then accept the certificates and wait for Eclipse to restart.

After installing, we are going to configure PyDev to use our Python 3 interpreter.

1. Go to 'Eclipse > Preferences > PyDev > Interpreter - Python'
2. Select 'New', in 'Interpreter Name' set python3 and in 'Interpreter Executable' set '/usr/local/bin/python3' (which is a symlink to `/usr/local/Cellar/python3/3.3.0/Frameworks/Python.framework/Versions/3.3/bin/python3.3`) then 'OK'

![PyDev installation step 4][]
3. Just type OK on this window

![PyDev installation step 5][]

Now, PyDev is configured and ready to use in Eclipse. To test it, go to 'File > New > Project...' and select 'PyDev Project', name your new project 'Test', Project Type to 'Python', Grammar Version to '3.0', interpreter to 'python3', select 'Create 'src' folder and add it to the PYTHONPATH' and 'Finish'

![PyDev installation step 6][]

Once the project is created, you can see on the left the PyDev Package Explorer with the Test project. Select the src folder, 'File > New > File' and call it test.py. Copy/paste this code

	if __name__ == '__main__':
    	print('Hello World')
 
An run it from Eclipse (Run > Run). You can see the output directly in the Eclipse console. That's all, you're ready to code and debug! If you want to go further, check out the [PyDev online documentation][], it's really good and complete.

From jc.

[Homebrew]: http://mxcl.github.com/homebrew/
[Max Howell]: https://twitter.com/mxcl/
[Eclipse Classic 4.2.1]: http://www.eclipse.org/downloads/packages/eclipse-classic-421/junosr1
[PyDev installation step 1]: pydev.png
[PyDev installation step 2]: pydev1.png
[PyDev installation step 3]: pydev2.png
[PyDev installation step 4]: pydev3.png
[PyDev installation step 5]: pydev4.png
[PyDev installation step 6]: pydev5.png
[ImageMagick]: http://www.imagemagick.org/script/index.php
[wget]: http://www.gnu.org/software/wget/
[ack]: http://betterthangrep.com/
[Homebrew wiki]: https://github.com/mxcl/homebrew/wiki
[SQLAlchemy]: http://www.sqlalchemy.org/
[any good text editor]: https://itunes.apple.com/us/app/bbedit/id404009241?mt=
[PyDev]: http://pydev.org/
[PyDev online documentation]: http://pydev.org/manual.html