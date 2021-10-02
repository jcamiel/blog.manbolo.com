## Use Python Effectively on OS X

This post is an unorganised collection of notes about how I use Python _effectively_ on OS&nbsp;X. Disclaimer: I don't pretend to be a Python expert, by a far mesure, so there could be some Pythonic horrors in this article; if you think so, just [drop us a mail](mailto:contact@manbolo.com), and we'll update this article.

__TL&DR__: don't use the pre-installed OS&nbsp;X Python. Use Python with [Homebrew][]. Never ever `sudo pip`. Use [virtualenv][] / [virtualenvwrapper][]. [PyCharm][] worth the price. Python rocks.

1. [__OS X default Python installation__](#p1)
2. [__Installing brew__](#p2)
3. [__Installing Python 2.7 with brew__](#p3)
4. [__Installing third-party libraries__](#p4)
 * [Essential](#p4.1)
 * [virtualenv](#p4.2)
 * [virtualenvwrapper](#p4.3)
5. [__Shell scripts with Python__](#p5)
6. [__Must-have  packages__](#p6)
7. [__Python 3__](#p7)
8. [__IDEs on OS X__](#p8)
9. [__Various tools__](#p9)
 * [Fabric](#p9.1)

* * *

<h3 id="p1">1. OS X default Python installation</h3>

A quick word about the default Python installation. Python comes pre-installed on OS X. If you open a terminal, and simply ask for the location of the `python` binary, you will see:  

	$ which python
	/usr/bin/python

Launching the interpreter in a terminal window:

	$ python
	Python 2.7.5 (default, Mar  9 2014, 22:15:05)
	[GCC 4.2.1 Compatible Apple LLVM 5.0 (clang-500.0.68)] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>>

So Python 2.7.5 is the default `python` interpreter. If you need to, Python 2.6.8 and Python 2.5.6 are also available on a vanilla OS X.

Simply use `python2.6` for Python 2.6.8:

	$ python2.6
	Python 2.6.8 (unknown, Mar  9 2014, 22:16:00)
	[GCC 4.2.1 Compatible Apple LLVM 5.0 (clang-500.0.68)] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>>

And `python2.5` for Python 2.5.6:

	$ python2.5
	Python 2.5.6 (r256:Unversioned directory, Mar  9 2014, 22:15:03)
	[GCC 4.2.1 Compatible Apple LLVM 5.0 (clang-500.0.68)] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>>

While it can be convenient to have a pre-installed Python, my rookie advise __is to not use it__: Apple doesn’t always do a good job on keeping the Python runtime environment up to date, plus it can be cumbersome to play with permissions just to install third-party Python librairies, and finally, Apple has a tendency to wipe-out your [site-packages][] with every major OS upgrade. 

So I simply recommend to install Python _aside_ the default one, with [Homebrew][]. You'll never have to use `sudo` or have permissions problem; if you have any issues, you can drop `/usr/local` and start from fresh without having messed up your OS X system. Let's do it now!

* * *

<h3 id="p2">2. Installing brew</h3>

There are many package installers on OS X but I find [Homebrew][] very pleasant, simple and convenient. Homebrew, originally started by [Max Howell][], simplify the installation of open source tools (like [ImageMagick][], [wget][], [ag][] etc..) that are not by default on OS X.

What I really like with Homebrew is that everything is installed in a directory that is not conflicting with the system directories. By default, it's on `/usr/local` but you can change to whatever you like.

Installing Homebrew is very simple: open a Terminal window and type

	ruby -e "$(curl -fsSL https://raw.github.com/Homebrew/homebrew/go/install)"

* * *

<h3 id="p3">3. Installing Python 2.7 with brew</h3>

Now that our Homebrew installation is done, we can install Python. We're going to start by installing Python 2.7:

	$ brew install python

Now, we need to tell the system to use our freshly new Python interpreter instead of the default one.

	$ which python
	/usr/bin/python

The default Python interpreter is under `/usr/bin`, and the Homebrew's one is under `/usr/local/bin` so we're going to edit `/etc/paths` so the `/usr/local/bin` binaries will be prioritised over `/usr/bin`.

	$ sudo vi /etc/paths

If you open `/etc/paths`, you should see this:

	/usr/bin
	/bin
	/usr/sbin
	/sbin
	/usr/local/bin	

Move `/usr/local/bin` at the beginning of the file so Homebrew binaries take on system binaries;

	/usr/local/bin	
	/usr/bin
	/bin
	/usr/sbin
	/sbin

Finally, check everything is ok: typing `python` should launch the Homebrew version

	$ source /etc/paths
	$ which python
	/usr/local/bin/python

	$ python
	Python 2.7.8 (default, Jul  2 2014, 10:14:46)
	[GCC 4.2.1 Compatible Apple LLVM 5.1 (clang-503.0.40)] on darwin
	Type "help", "copyright", "credits" or "license" for more information.

[pip][] has been also installed alongside our brewed Python; pip will allow us to easily install and manage Python packages.

	$ which pip
	/usr/local/bin/pip	
	

With this setup (brewed python), __you'll NEVER have to use `sudo` to install any Python relative stuff__. If you end up doing this, something is broken in your brewed Python installation. 

* * *

<h3 id="p4">4. Installing third-party libraries</h3>

<h4 id="p4.1">4.1. Essential</h4>

There are two kind of third-party libraries: those you want _to be installed anytime with your default Python_, and those you like to play with, or use only for your toys projects. You don't want to mess your default Python, so I recommend to install only the essential libraries in your default Python (which is `/usr/bin/local/python` if you've followed my previous advices). 

Those essentials libraries depends on your needs, and will be different from one person to another. In [Must-have packages](#p6), I've listed some open source packages that I found convenient to be always present in my system.

You'll be able to install the other libraries in a _virtual Python environment_, that could be used and / or trash anytime, without messing up your brewed installation.

Let's take the example of a library that I want to always be available in my Python interpreter: [Requests][]. To install it, I simply `pip install request` in a terminal window. This way, each time I use my default Python, I can do HTTP requests really easily.

	$ pip install requests
	
	$ python
	Python 2.7.8 (default, Jul  2 2014, 10:14:46)
	[GCC 4.2.1 Compatible Apple LLVM 5.1 (clang-503.0.40)] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>> import requests
	>>> requests.__path__
	['/usr/local/lib/python2.7/site-packages/requests']
	>>>

<h4 id="p4.2">4.2. virtualenv</h4>

Now, you could theoretically install all the third parties libraries you need in your default Python. But, imagine you have a script that needs version 1 of LibFoo, but another script requires version 2. How can you use both these scripts? If you install everything into `/usr/local/lib/python2.7/site-packages/`, it’s easy to end up in a situation where you unintentionally upgrade something that shouldn’t be upgraded.

Or more generally, what if you want to install an application and leave it be? If an application works, any change in its libraries or the versions of those libraries can break the application.

To address this, we're going to use [virtualenv][]. [virtualenv][] allows you to create an optimised, independent and sandboxed copy of your default Python. You'll be able to install packages in this _virtual Python environment_, and __only__ in this environnement. You will be able to use this Python interpreter (or _activate_ it), play with it, and comes back (_deactivate_) to the default environnement. You will be able to have multiple venvs (shortcut for virtual Python environment), each one being completely independent of the others; you will be able to switch between environment, execute periodic scripts in a given environment etc...

To install [virtualenv][], just use your default pip:

	pip install virtualenv

Example: you want to play with latest version of [Django][]. So the first step is to create a venv for the latest version of [Django][]. You can create a venv anywhere on your disk, and __you do not need to be root to do this__, you just need write permissions. For example, you can install a new venv in your Documents directory:  

	$ cd ~/Documents
	$ virtualenv -p /usr/local/bin/python2.7 venv-django

This command has created a sandboxed version of your Python environment under the folder venv-django. By default, this copy comes clean, without the third-party packages that are installed in your default Python. This allows you to start from a clean, new state. You can open the folder `~/Documents/venv-django` and you will see a sandboxed Python environment:

	$ cd ~/Documents/venv-django
	$ ls -l
	total 0
	drwxr-xr-x  19 jc  staff  646 Sep 27 11:43 bin
	drwxr-xr-x   3 jc  staff  102 Sep 27 11:43 include
	drwxr-xr-x   3 jc  staff  102 Sep 27 11:43 lib
	$ cd bin
	$ ls -l
	total 160
	-rw-r--r--  1 jc  staff   2203 Sep 27 11:43 activate
	-rw-r--r--  1 jc  staff   1259 Sep 27 11:43 activate.csh
	-rw-r--r--  1 jc  staff   2472 Sep 27 11:43 activate.fish
	-rw-r--r--  1 jc  staff   1129 Sep 27 11:43 activate_this.py
	-rwxr-xr-x  1 jc  staff    253 Sep 27 11:43 easy_install
	-rwxr-xr-x  1 jc  staff    253 Sep 27 11:43 easy_install-2.7
	-rwxr-xr-x  1 jc  staff    150 Sep 27 11:43 get_env_details
	-rwxr-xr-x  1 jc  staff    225 Sep 27 11:43 pip
	-rwxr-xr-x  1 jc  staff    225 Sep 27 11:43 pip2
	-rwxr-xr-x  1 jc  staff    225 Sep 27 11:43 pip2.7
	-rw-r--r--  1 jc  staff     72 Sep 27 11:43 postactivate
	-rw-r--r--  1 jc  staff     74 Sep 27 11:43 postdeactivate
	-rwxr-xr-x  1 jc  staff     69 Sep 27 11:43 preactivate
	-rw-r--r--  1 jc  staff     75 Sep 27 11:43 predeactivate
	lrwxr-xr-x  1 jc  staff      9 Sep 27 11:43 python -> python2.7
	lrwxr-xr-x  1 jc  staff      9 Sep 27 11:43 python2 -> python2.7
	-rwxr-xr-x  1 jc  staff  12744 Sep 27 11:43 python2.7
	
A new python interpreter is here and ready to serve! But currently the Python interpreter is still the default one.
 
	$ which python
	/usr/local/bin/python

To switch to the interpreter of the venv, you need _to activate_ it. `source` the `bin/activate` script that have been created in the venv folder:
	
	$ source ~/Documents/venv-django/bin/activate
	(venv-django)$ 

	(venv-django)$ which python	
	/Users/jc/Documents/venv-django/bin/python

	(venv-django)$ which pip
	/Users/jc/Documents/venv-django/bin/pip

You can see that your shell prompt is now prefixed with the name of the current activated environment (_very convenient_). You can test that no third-party packages have been installed and that your virtual env is clean:

	(venv-django)$ python
	Python 2.7.8 (default, Jul  2 2014, 10:14:46)
	[GCC 4.2.1 Compatible Apple LLVM 5.1 (clang-503.0.40)] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>> import requests
	Traceback (most recent call last):
	  File "<stdin>", line 1, in <module>
	ImportError: No module named requests
	>>>

You can use this new Python environment without fearing to break anything, or to bloat you default Python. `activate` simply add the virtual env Python binaries to your PATH, in front of system defined binaries. Each time we'll use `pip` or `python`, we'll use the ones that are in this sandbox.

Now, we can safely install Django in your new environment:

	(venv-django)$ pip install django
	(venv-django)$ python
	Python 2.7.8 (default, Jul  2 2014, 10:14:46)
	[GCC 4.2.1 Compatible Apple LLVM 5.1 (clang-503.0.40)] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>> import django
	>>>
	

To leave the current virtualenv, and go back to the default Python, just  type `deactivate` in any path. 
	
	$(venv-django) deactivate	

Back to the default Python, Django is not installed and everything is clear. 

You don't need to do the activate/deactivate dance each time you want to use a particular venv. Let's say you want to execute a cron task `checker.py`. `checker.py` is using a virtual env defined at `~/Documents/venvs/myvenv`. You can use the venv python interpreter to launch `checker.py` (without calling `activate`), and everything will just works, your script  will be able to import any module defined in your venv:

	$ ~/Documents/venvs/myvenv/bin/python checker.py

<h4 id="p4.3">4.3. virtualenvwrapper</h4>

Working with multiple virtualenv can become really teddy and cumbersome: you have to switch and remember where is located the venv you want to use. This is where [virtualenvwrapper][] comes to place: virtualenvwrapper is a set of extensions to virtualenv tool. You can easily list, create and delete virtual environments; all of your virtual environments are organized in one place.

Installing virtualenv is really simple, with your main Python:

	pip install virtualenvwrapper

Next, you have to add `source /usr/local/bin/virtualenvwrapper.sh` to your shell startup file (on OS X, you can put this at the end of `~/.bash_profile`).

Then, everything is set up and you can create a new venv:

	$ mkvirtualenv env1
	New python executable in env1/bin/python2.7
	Also creating executable in env1/bin/python
	Installing setuptools, pip...done.
	(env1)~ $

By default, all your virtual environments will be created under `~/.virtualenvs/` but you can change it.

List all environnement:

	$ workon
	env1
	env2

Switch on environnement env1:

	$ workon env1


* * *

<h3 id="p5">5. Shell scripts with Python</h3>

If you write shell scripts in Python, you can launch your script by simply call:

	$ python myscript.py

This will execute your script, with the current python interpreter. If your script need a particular virtual environnement to run, you can run it in this virtual environment without having to activate it before. Simply hard code the python interpreter binary that ways:

	$ /Users/jc/.virtualenvs/env1/bin/python myscript.py

This will execute the script `myscript.py` in the virtual environnement defined at `/Users/jc/.virtualenvs/env1`. All the packages that you have installed in this virtual environnement will be callable in the script.

If you want to call directly your script without typing `python`, add the proper  permission on your script

	$ chmod u+x myscript.py

And add the following [shebang][] at the beginning of your script:

	#!/usr/bin/env python

You can also point to a particular python interpreter if you want:

	#!/Users/jc/.virtualenvs/env1/bin/python

Which is considerably less portable. `#!/usr/bin/env python` will use the current python interpreter of your shell session (which can be a `virtualenv` ones).

Finally, it's a best practice to declare the encoding of your script file. On OS X, use UTF-8.

For example, the following script:

	#!/usr/bin/env python
	
	
	if __name__ == '__main__':
		print("Hello こんにちは!")

will produced this error when executed:

	File "./testutf8.py", line 5
	SyntaxError: Non-ASCII character '\xe3' in file ./testutf8.py on line 5, but no encoding declared; see http://www.python.org/peps/pep-0263.html for details

With the proper encoding hint, everything works as it should be (you can even use [emojis][] if you want!):

	#!/usr/bin/env python
	# -*- coding: utf-8 -*-
	
	
	if __name__ == '__main__':
		print("Hello こんにちは!")
	

	$ ./testutf8.py
	Hello こんにちは!

* * *

<h3 id="p6">6. Must-have packages</h3>

I'm not a Python expert, and everyone's needs are different so take this list with a grain of salt.

- [Requests][]: simply HTTP for humans. If you deals with HTTP requests, just use Request and your life will get __a lot__ easier.
- [BeautifulSoup][]: parsing HTML and XML data. So good.
- [SQLAlchemy][]: efficient and high-performing SQL toolkit.
- [Pillow][]: imaging library (fork of the venerable PIL). Just works.
- [lxml][]: another HTML XML processing tookit. You can prefer BeautifulSoup APIs, but BeautifulSoup can also use lxml as a parser. It's a matter of choice, I prefer BeautifulSoup.
- [Jinga][]: full featured template engine.
- [Pyments][]: generic syntax highlighter for general use in all kinds of software such as forum systems, wikis or other applications that need to prettify source code.

If you want to do web development, you could try:

- [Django][]: unavoidable. Django is the behemoth of the Python web framework. I love it, for the documentation, the admin interface, the ORM, and the built-in authentication support. If you need something smaller, you can use [Flask][] or [Bottle][].
- [Flask][]: fast, simple and lightweight micro web framework.
- [Bottle][]: fast, simple and lightweight micro web framework.

Flask and Bottle are both excellent. Give both a try before deciding which one to use.

* * *

<h3 id="p7">7. Python 3</h3>

Everything I've just said works for Python 2 or Python 3. Python 3 doesn't come pre-installed on OS X, so if you want to install it, just use brew.

	brew install python3

Then you can launch `python3` and play with the new [asyncio][] module:

	$ python3
	Python 3.4.1 (default, May 19 2014, 13:10:29)
	[GCC 4.2.1 Compatible Apple LLVM 5.1 (clang-503.0.40)] on darwin
	Type "help", "copyright", "credits" or "license" for more information.
	>>> import asyncio
	>>>

Python 2 and Python 3 can coexist without any problem. If you want to launch the Python 2 interpreter, just use `python`. If you want to use the Python 3 interpreter, just use `python3`; if you want to install packages in Python 2 library, just use `pip`, if you want to install packages in your Python 3 library, just use `pip3`....__et voilà!!!__. 

You can create virtual env that will use Python 2 or Python 3, just use the `-p` option flag to target a specific Python. For instance:

	mkvirtualenv -p /usr/local/bin/python3 testasyncio
	
Will construct a venv with Python 3.

* * *

<h3 id="p8">8. IDEs on OS X</h3>

You can write Python code with `vim` but there are good and complete Python IDEs on OS X.

- [PyCharm][]: my Python IDE of choice. Starting at $99, it __totally worths it__. There is also a free edition. My only (minor) grip is that it isn't a totally native OS X app (and there are too much preferences!).
- [Exedore][]: much lighter than PyCharm and written entirely in Cocoa/Objective-C so it feels right at home on your Mac. Give-it a try (free trial, then $9.99).
- [PyDev][]: if you like Eclipse, PyDev is for you. [I've tried it][] but prefer PyCharm.

* * *

<h3 id="p9">9. Various tools</h3>

<h4 id="p9.1">9.1. Fabric</h4>

[Fabric][] is a command-line tool for streamlining the use of SSH for application deployment or systems administration tasks. I use it for deploying this blog from my Mac for instance. With Fabric, you can launch command as if you were on your server, and execute arbitrary Python functions via the command line.

For exemple, in a fabfile.py file you code:

	from fabric.api import local

	def prepare_deploy():
		local("./manage.py test my_app")
		local("git add -p && git commit")
		local("git push")

And then on the command line, you can launch:
	
	$ fab prepare_deploy

And the commands will be executed locally.

But the real power of Fabric it that it can run commands on your server, from your Mac! For instance:

	env.hosts = ['example.com']
	
	def deploy():
		code_dir = '/srv/django/myproject'
		with cd(code_dir):
			run("git pull")
			run("touch app.wsgi")

If you execute `fab deploy`, the commands will be sent from your Mac to your server (via SSH) and executed here! Fabric really simplify you deployment needs and you can deploy, run scripts on multiple servers easily. I use it to deploy the blog on our server, and we use it also to deploy our various Django projects.

From jc.

[Fabric]: http://www.fabfile.org
[I've tried it]: http://blog.manbolo.com/2013/02/04/how-to-install-python-3-and-pydev-on-osx
[PyDev]: http://pydev.org
[Exedore]: http://celestialteapot.com/exedore/
[asyncio]: https://docs.python.org/3/library/asyncio.html
[Flask]: http://flask.pocoo.org
[Bottle]: http://bottlepy.org/docs/dev/index.html
[emojis]: http://blog.manbolo.com/2012/10/29/supporting-new-emojis-on-ios-6
[pip]: https://github.com/pypa/pip
[ag]: https://github.com/ggreer/the_silver_searcher
[wget]: http://www.gnu.org/software/wget/
[Max Howell]: https://twitter.com/mxcl
[PyCharm]: http://www.jetbrains.com/pycharm/
[brew]: http://brew.sh
[Homebrew]: http://brew.sh
[Homebrew, The missing package manager for OS X]: http://brew.sh
[Requests]: http://docs.python-requests.org/en/latest/
[virtualenv]: http://virtualenv.readthedocs.org/en/latest/index.html
[Django]: https://www.djangoproject.com
[virtualenvwrapper]: http://virtualenvwrapper.readthedocs.org/en/latest/index.html
[shebang]: http://en.wikipedia.org/wiki/Shebang_%28Unix%29
[site-packages]: https://docs.python.org/2/install/
[ImageMagick]: http://www.imagemagick.org
[BeautifulSoup]: http://www.crummy.com/software/BeautifulSoup/bs4/doc/
[SQLAlchemy]: http://www.sqlalchemy.org
[Pillow]: http://pillow.readthedocs.org/en/latest/
[Jinga]: http://jinja.pocoo.org
[Pyments]: http://pygments.org
[lxml]: http://lxml.de
[PyCharm]: http://www.jetbrains.com/pycharm/
<hn>https://news.ycombinator.com/item?id=8378007</hn>