## Build and Deploy a Django Project on OSX from Scratch

If you read this blog, you're certainly a front-end mobile developer (and certainly also an iOS dev). Guess what? __The server part is the most important piece of your project__: maybe tomorrow you will want to expand your app on Android, Windows 8, or you want a beautiful responsive HTML5 web site etc... All these frontends will speak to your back-end, and inevitably you will have to work on your backend.

Fortunately, there are tons of choice of technologies, that can really be fun to learn. At Manbolo, we have choosen to build on [Django][], one of the most famous Python framework.

This post is an attempt to show how to build and deploy a Django project from a new Mac, assuming you've nothing installed on it. The aim is to have a local developement server on our Mac, pretty similar to what can be your production server (hosted on your Linux box, or on [Heroku][] for instance). That's way, you can work on your server, even if your are offline. For the example, we're going to build `http://dev.mysite.com` that will be powered by Django and hosted locally on your mac. 

__WARNING__: this post describes a simple way to test a Django project in a development environnement (your local Mac). There is __no security consideration__, and _this is not a post about how to deploy a Django app on a production server_. 

1. [__Choices: Apache, MySQL, Python 2.7__](#1)
2. [__Install Xcode command line tools__](#2) 
3. [__Install Homebrew__](#3) 
4. [__Configure Apache__](#4)
	- [4.1. Enable mod_php](#4.1)
	- [4.2. Enable and configure Virtual Host](#4.2)
	- [4.3. Install MySQL (MariaDB)](#4.3)
	- [4.4. Install `phpMyAdmin`](#4.4)
5. [__Install `virtualenv`__](#5)
6. [__Create a Django project with `virtualenv`__](#6)
	- [6.1. Create a Python virtual environment](#6.1)
	- [6.2. Create a Django project](#6.1)
	- [6.3. Test the Django project in local](#6.2)
7. [__Deploy your Django project with `mod_wsgi`__](#7)
	- [7.1 Install `mod_wsgi`](#7.1)
	- [7.2. Configure VirtualHost for `mod_wsgi`](#7.2)
	- [7.3. Collect static files](#7.3)

* * * 

<h3 id="1">1. Choices: Apache, MySQL, Python 2.7</h3>

- __Apache__: already installed on Mac, we're going to use `mod_wsgi` for serving the Django project and also using the same Apache server for serving static files. The Django documentation on deployment recommends [to serve static pages with another lighter server][] (like [Nginx][] or [lighttpd][]), but for simplicity, we will use the same server (though the static pages won't be interpreted by the Python interpreter)
- __MySQL__: we use MySQL ([MariaDB][] more precisely) on our server and we have a good knowledge of it. [Django seems to be fan of PostgresSQL][], but we don't know it at all. For our needs, MySQL is simple to configure and rock solid.
- __Python 2.7__: this was a hard choice. Pretty new to Python, we've stared to invest on Python 3. But the state of MySQL on Python 3 is pretty bad: we've managed to play with [SQLAlchemy][] on Python 3, but failed with Django. Django is, of course, Python 3 compliant; but if you're using MySQL, you should better stick with Python 2.x. The good news is that you can have multiple versions of Python, with different modules, coexist on the same system, with [virtualenv][]. A last argument for Python 2.x is our production environment: we're using Debian-Squeeze distribution and the stable packages for Python on Squeeze is Python 2.6.6. 

* * *

<h3 id="2">2. Install Xcode command line tools</h3>

Let's start. First, Xcode command line tools are needed to build MySQL and to use Homebrew.

If you already have Xcode, just go to 'Preferences... > Downloads' then click on Command Line Tools Install button.

<img src="/2013/05/02/cli.png" alt="Xcode command line tools" width="600" height="460">

If you don't have Xcode, just go to <https://developer.apple.com/downloads> and search for _Command Line Tools (OS X Mountain Lion) for Xcode_, or _Command Line Tools (OS X Lion) for Xcode_ depending on your OS.

* * *

<h3 id="3">3. Install Homebrew</h3>

We'll need Homebrew to install `mod_wsgi`.

There are many package installers on OSX but I find [Homebrew][] very pleasant, simple and convenient. Homebrew, originally started by [Max Howell][], simplify the installation of open source tools (like [ImageMagick][], [wget][], [ack][] etc..) that are not by default on OSX.

What I really like with Homebrew is that everything is installed on a directory that is not conflicting with the system directories. By default, it's on `/usr/local` but you can change to whatever you like.

Installing Homebrew is very simple; open a Terminal window and type
 
	ruby -e "$(curl -fsSkL raw.github.com/mxcl/homebrew/go)"

* * *

<h3 id="4">4. Configure Apache</h3>

First, we enable php on the local Apache with `mod_php`, only to use [phpMyAdmin][]. You can manage your database by hand but franckly this is simpler with `phpMyAdmin`. Then we'll enable [Apache Virtual Host][]. This will allow us to test our Django project in our browser, at the url `http://dev.mysite.com`. Then, we'll install our MySQL database, needed by Django and create a first user/database for our Django project. 

Apache is installed by default on OSX Mountain Lion, open a terminal and start it:

	sudo apachectl start

Go to your browser, `http://localhost/`, and you should see classic 'It Works'

<h4 id="4.1">4.1. Enable mod_php</h4>

Enable `mod_php` in Apache:

	cd /etc/apache2
	sudo vi httpd.conf

Uncomment this line:

	# LoadModule php5_module libexec/apache2/libphp5.so

Make a copy of the default `php.ini.default` to `php.ini`

	cd /etc/
	sudo cp php.ini.default php.ini

In `php.ini`, change the MySQL Unix socket (MariaDB installed by Homebrew use `/tmp/mysql.sock` by default). If `php.ini` copied from `php.ini.default` is not writable, make it writable then replace every occurence of `/var/mysql/mysql.sock` with `/tmp/mysql.sock` (it should be at two places)

	sudo chmod +w php.ini
	sudo vi php.ini

Test Apache config is ok, and restart it:

	apachectl configtest
	sudo apachectl graceful


<h4 id="4.2">4.2. Enable and configure Virtual Host</h4>

We're going to enable Virtual Host on Apache. This give you a skeletton to easily manage multiple development sites, locally on your Mac. I usually put all my document root under `~/Sites/` so we're going to create a `~/Sites/mysite.com` document root for our dev site (with our Django app, only the web site static content will be located under `~/Sites/mysite.com`, our Django project will be located at `~/Documents/mysite`)

	cd /etc/apache2
	sudo vi httpd.conf
	
Uncomment this line

	#Include /private/etc/apache2/extra/httpd-vhosts.conf

Test Apache config is ok:

	apachectl configtest

The result should be:

	Warning: DocumentRoot [/usr/docs/dummy-host.example.com] does not exist
	Warning: DocumentRoot [/usr/docs/dummy-host2.example.com] does not exist
	Syntax OK

All is ok, we're going to configure virtual hosts configuration files

	cd /etc/apache2/extra/ 
	sudo vi httpd-vhosts.conf 
	
Replace the content of `httpd-vhosts.conf` with this one. This give us a good template for future vhosts configuration file.
	
	NameVirtualHost *:80

	include /private/etc/apache2/extra/vhosts/localhost.conf
	include /private/etc/apache2/extra/vhosts/dev.mysite.com.conf

For each new site you're building, you will have a corresponding Apache configuration file. Our Django site will be under `http://dev.mysite.com`, so we create a virtual host on our Apache for managing this site. If you want to manage other dev site, just add as many lines as there are web sites:

	include /private/etc/apache2/extra/vhosts/dev.mysite2.com.conf
	include /private/etc/apache2/extra/vhosts/dev.mysite3.com.conf
	include /private/etc/apache2/extra/vhosts/dev.mysite4.com.conf
	include /private/etc/apache2/extra/vhosts/dev.mysite5.com.conf

Currently, we just need an Apache conf for `localhost` and `dev.mysite.com`.

Create the virtual host configuration for `localhost`:

	sudo mkdir -p /etc/apache2/extra/vhosts/
	cd /etc/apache2/extra/vhosts/
	sudo vi localhost.conf 
	
Put this content in the `localhost.conf` and save it

	<VirtualHost *:80>
        DocumentRoot "/Users/jc/Sites/localhost"
        ServerName localhost
        ErrorLog "/Users/jc/Sites/logs/localhost-error_log"
        CustomLog "/Users/jc/Sites/logs/localhost-access_log" common
        <Directory "/Users/jc/Sites/localhost">
                Order deny,allow
                Allow from all
        </Directory>
	</VirtualHost>

Create the virtual host configuration for `dev.mysite.com`:

	cd /etc/apache2/extra/vhosts/
	sudo vi dev.mysite.com.conf 

Put this content in `dev.mysite.com.conf` and save it

	<VirtualHost *:80>
        DocumentRoot "/Users/jc/Sites/mysite.com"
        ServerName dev.mysite.com
        ErrorLog "/Users/jc/Sites/logs/mysite.com-error_log"
        CustomLog "/Users/jc/Sites/logs/mysite.com-access_log" common
        <Directory "/Users/jc/Sites/mysite.com">
                Order deny,allow
                Allow from all
        </Directory>
	</VirtualHost>


Create the log repository and document root for our virtual hosts

	mkdir -p  ~/Sites/logs/
	mkdir -p  ~/Sites/localhost/
	mkdir -p  ~/Sites/mysite.com/
	
	
Now the test for Apache should be ok:

	apachectl configtest
	Syntax OK

Then, restart Apache

	sudo apachectl graceful

Finally, we want to test our site in our browser locally by typing `http://dev.mysite.com`. To do this, we edit `/etc/hosts`:

	sudo vi /etc/hosts
	
And add lines for `dev.mysite.com`

	##
	# Host Database
	#
	# localhost is used to configure the loopback interface
	# when the system is booting.  Do not change this entry.
	##
	127.0.0.1	localhost
	255.255.255.255	broadcasthost
	::1             localhost 
	fe80::1%lo0	localhost
	127.0.0.1	dev.mysite.com
	fe80::1%lo0	dev.mysite.com

Open a terminal to check this config:
	
	ping dev.mysite.com

And the result should be

	PING dev.mysite.com (127.0.0.1): 56 data bytes
	64 bytes from 127.0.0.1: icmp_seq=0 ttl=64 time=0.035 ms
	64 bytes from 127.0.0.1: icmp_seq=1 ttl=64 time=0.109 ms
	64 bytes from 127.0.0.1: icmp_seq=2 ttl=64 time=0.065 ms
	64 bytes from 127.0.0.1: icmp_seq=3 ttl=64 time=0.096 ms

Now, we you type `http://dev.mysite.com` in your browser, you should point to your Apache virtual host.

<h4 id="4.3">4.3. Install MySQL (MariaDB)</h4>

Install MySQL with Homebrew

	brew install mariadb

As suggested by `brew`, finish the installation

	unset TMPDIR
	mysql_install_db --user=`whoami` --basedir="$(brew --prefix mariadb)" 	--datadir=/usr/local/var/mysql --tmpdir=/tmp

Start MariaDB at login

	mkdir -p ~/Library/LaunchAgents
    ln -sfv /usr/local/opt/mariadb/*.plist ~/Library/LaunchAgents

Then launch it now, 

	launchctl load ~/Library/LaunchAgents/homebrew.mxcl.mariadb.plist

Once you've launch the server, set a password for the MariaDB root user:

	mysqladmin -u root password 'NEW-PASSWORD'

<h4 id="4.4">4.4. Install phpMyAdmin</h4>


Download the [last version of phpMyAdmin][], unzip under 

	/Users/jc/Sites/localhost/phpmyadmin

In your browser type `http://localhost/phpmyadmin` and log with `root` and the password you've previously set.

Then go to the Users tab, and select 'Add user'

<a href="/2013/05/02/phpmyadmin-1.png"><img src="/2013/05/02/phpmyadmin-1.png" alt="phpMyAdmin create user step 1" width="600" height="427"></a>

Create you a user with login `project1` and password `project1`, and select 'Create database with same name and grant all privileges' then 'Add user':

<a href="/2013/05/02/phpmyadmin-2.png"><img src="/2013/05/02/phpmyadmin-2.png" alt="phpMyAdmin create user step 2" width="600" height="427"></a>

That's all, we have our database ready for our Django project.

* * *

<h3 id="5">5. Install virtualenv</h3>

`virtualenv` is a very powerful tool that will allow you to create a Python environment sandbox. That way, you can have multiple versions of Python with multiple modules and each environment is isolated from the others. We're going to install `virtualenv`, and then install Django in a virtual environment.

Just download [virtualenv-1.9.1.tar.gz][] in a temporary folder:

	tar xvzf virtualenv-1.9.1.tar.gz
	cd virtualenv-1.9.1
	sudo python setup.py install
	
* * *

<h3 id="6">6. Creating a Django project with virtualenv</h3>

To create a virtual environment of a specific Python version, use the `-p` option of `virtualenv` and put the path of a given Python interpreter. On OSX, Python 2.7 is installed by default, so, for our Django project, we're going to create a Python 2.7 virtual environment.

<h4 id="6.1">6.1. Create a Python virtual environment</h4>

	
1. Create a 2.7 virtual environment with Python 2.7:

		cd ~/Documents/VirtualEnvs/
		virtualenv --python=/usr/bin/python2.7 --no-site-packages venv-python2.7-django
		
2. Activate this virtual environment:

		cd ~/Documents/VirtualEnvs/venv-python2.7-django/
		source bin/activate
 		
 	Before your prompt, you should see the current virtual environment activated:
 	
 		(venv-python2.7-django) $
 	
 	Now, when you will launch a Python interpreter, you'll use the interpreter installed at `~/Documents/VirtualEnvs/venv-python2.7-django/bin`. When you will install any Python module with `pip`, you will install it only in this virtual environment and not in the system. You can deactivate the virtual environment with the command `deactivate` and come back to your system Python.
 	  
 	Finally, to test installation:
 	
 		which python
 	
 	Result:
 	
 		/Users/jc/Documents/VirtualEnvs/python2.7-django/bin/python
	
3. Install last version of Django in this virtual environment: download [Django-1.5.1.tar.gz][] in a temporary folder (doesn't need to be under your virtual environment, but be sure to be in a terminal where this env is activated)

		tar xzvf Django-1.5.1.tar.gz
		cd Django-1.5.1
		python setup.py install
		
	No need sudo as we are in a virtual environment now. To test it; launch `python` and import `django`
		
		python
		Python 2.7.2 (default, Oct 11 2012, 20:14:37) 
		[GCC 4.2.1 Compatible Apple Clang 4.0 (tags/Apple/clang-418.0.60)] on darwin
		Type "help", "copyright", "credits" or "license" for more information.
		>>> import django
		>>> 

	Everything seems OK, ctrl+D to quit the interactive interpreter.
	
4. Install `distribute` >= 0.6.28 (needed by MySQLdb). I prefer to do it manually, I don't know why it is much slower if we relly on MySQLdb to install distribute. Download [distribute-0.6.36.tar.gz][] in a temporary folder and

		tar xvzf distribute-0.6.36.tar.gz 
		cd distribute-0.6.36/
		python setup.py install
		
5. Install MySQLdb in this env. Download [MySQL-python-1.2.4b4.tar.gz][] in a temporary folder and

		tar xvzf MySQL-python-1.2.4b4.tar.gz
		cd MySQL-python-1.2.4b4
		python setup.py install
		
<h4 id="6.2">6.2. Create a Django project</h4>

We're going to create our Django project. Starting from now, you should have your Python virtual environement activated (remember that our system default Python doesn't know anything about Django). If you're new to Django, just follow the wonderful tutorials 'Writing your first Django' on the Django site, from [part 1][] to [part 6][]. I recommand also to read the section about [how to manage static files (CSS, images)][]. 

	cd ~/Documents
	django-admin.py startproject mysite
	
Edit mysite/settings.py to put the MySQL database settings

	DATABASES = {
    	'default': {
    	    'ENGINE': 'django.db.backends.mysql', 
        	'NAME': 'project1',
        	'USER': 'project1',
        	'PASSWORD': 'project1',
        	'HOST': '',					# Empty for localhost
        	'PORT': '',					# Set to empty string for default.
    	}
	}

<h4 id="6.3">6.3. Test the Django project in local</h4>
	
In command-line, test that your Django project is working. We're using the embedded Django server:

	cd ~/Documents/mysite/
	python manage.py runserver
	
	
<a href="/2013/05/02/django-local.png"><img src="/2013/05/02/django-local.png" alt="Django local admin page" width="600" height="374"></a>

* * *
	
<h3 id="7">7. Deploy your Django project with mod_wsgi</h3>

<h4 id="7.1">7.1 Install mod_wsgi</h4>

We're going to use Homebrew to install `mod_wsgi`. There is some extra step to install it, you can read <https://github.com/Homebrew/homebrew-apache> to have more information.

Before installation, run this command that will create a needed link for Homebrew `mod_wsgi` compilation:

	$ [ "$(sw_vers -productVersion | sed 's/^\(10\.[0-9]\).*/\1/')" = "10.8" ] && bash -c "[ -d /Applications/Xcode.app/Contents/Developer/Toolchains/XcodeDefault.xctoolchain ] && sudo bash -c 'cd /Applications/Xcode.app/Contents/Developer/Toolchains/ && ln -vs XcodeDefault.xctoolchain OSX10.8.xctoolchain' || sudo bash -c 'mkdir -vp /Applications/Xcode.app/Contents/Developer/Toolchains/OSX10.8.xctoolchain/usr && cd /Applications/Xcode.app/Contents/Developer/Toolchains/OSX10.8.xctoolchain/usr && ln -vs /usr/bin'"


Then, load new Formulas into brew:

	brew tap homebrew/apache
		
Finally install `mod_wsgi`

	brew install mod_wsgi
		
Once `mod_wsgi` installed, we'll enable it in Apache: edit `/etc/apache2/http.conf` and add this line

	LoadModule wsgi_module /usr/local/Cellar/mod_wsgi/3.4/libexec/mod_wsgi.so
		
Test the config and restart Apache if everything is ok:
	
	apachectl configtest
	sudo apachectl restart	
	
<h4 id="7.2">7.2 Configure VirtualHost for mod_wsgi</h4>
	
On the one hand, all static ressources will be served by Apache and will point to `/Users/jc/Sites/mysite.com/static`; on the other hand, the WSGI entry-point for our Python app will be at `/Users/jc/Documents/mysite/mysite/wsgi.py`

We're going to configure our virtual host configuration file for `dev.mysite.com` and enable `mod_wsgi`. Edit `/etc/apache2/extra/vhosts/dev.mysite.com.conf` and copy these lines: 

	<VirtualHost *:80>

    	LogLevel info

	    ServerName dev.mysite.com
    	ServerAdmin jc@mysite.com

	    # Static files
	    DocumentRoot "/Users/jc/Sites/mysite.com"
    	Alias /static/ /Users/jc/Sites/mysite.com/static/

	    <Directory "/Users/jc/Sites/mysite.com/static">
    	    Order deny,allow
        	Allow from all
	    </Directory>

    	# WGSI configuration
	    WSGIDaemonProcess mysite.com processes=2 threads=15 display-name=%{GROUP} python-path=/Users/jc/Documents/mysite/:/Users/jc/Documents/VirtualEnvs/python2.7-django/lib/python2.7/site-packages

	    WSGIProcessGroup mysite.com
    
    	WSGIScriptAlias / /Users/jc/Documents/mysite/mysite/wsgi.py

	    <Directory "/Users/jc/Documents/mysite/mysite">
    	    <Files wsgi.py>
        	    Order allow,deny
            	Allow from all
	        </Files>
    	</Directory>

	</VirtualHost>

We are using `mod_wsgi` in daemon mode, each Django instance will runs as a distinct user. You can get more informations on [How to use Django with Apache ad mod_wsgi][] on the Django docs, and on 
[official mod_wsgi documentation][].

You can see that the `WSGIDaemonProcess` variable allows us to specify which Python interpreter we will use: by changing this path, you can specify exactly which Python virtual environment you'll use for this Django app. Note tnat we specify the path to our Python project AND to our Python virtual environement `site-packages`.

I've not look for the right number of processes and thread one should put in `WSGIDaemonProcess` but 2 and 15 should be safe for our developement configuration.

Finally, put the right permissions on your local folder for Apache to acces your files:

	Chmod -R 755 ~/Documents/mysite/mysite
	Chmod -R 755 ~/Documents/Sites/mysite.com

Then restart Apache

	sudo apachectl graceful	 

<h4 id="7.3">7.3. Collect static files</h4>

Our static pages on your Django project will be under `~/Documents/Sites/mysite.com/static`, and accessible at `http://dev.mysite.com/static`. Note that, with our Apache virtual host configuration, static files won't go through the Python interpreter (there is no need to) but will be serve directly by Apache.

In your Django project, edit `settings.py` and change `STATIC_ROOT`:

	STATIC_ROOT = /Users/jc/Sites/mysite.com/static/  

Then, collect all statics files from your Django project:

	python manage.py collectstatic

Finally, type in your browser `http://dev.mysite.com/admin` and you should see:

<img src="/2013/05/02/mysite.png" alt="my Django site" width="600" height="427">
	
From jc.

[to serve static pages with another lighter server]: https://docs.djangoproject.com/en/dev/howto/deployment/wsgi/modwsgi/#serving-files
[Heroku]: https://www.heroku.com/
[Django]: https://www.djangoproject.com/
[Django seems to be fan of PostgresSQL]: https://docs.djangoproject.com/en/dev/faq/install/#what-are-django-s-prerequisites
[lighttpd]: http://www.lighttpd.net/
[Nginx]: http://wiki.nginx.org/Main
[Django local admin page]: django-local.png
[virtualenv]: http://www.virtualenv.org/en/latest/
[Django-1.5.1.tar.gz]: https://www.djangoproject.com/download/1.5.1/tarball/
[distribute-0.6.36.tar.gz]: https://pypi.python.org/packages/source/d/distribute/distribute-0.6.36.tar.gz
[MySQL-python-1.2.4b4.tar.gz]: http://sourceforge.net/projects/mysql-python/files/mysql-python-test/1.2.4b4/MySQL-python-1.2.4b4.tar.gz/download
[virtualenv-1.9.1.tar.gz]: 
https://pypi.python.org/packages/source/v/virtualenv/virtualenv-1.9.1.tar.gz
[MariaDB]: http://mariadb.org/
[SQLAlchemy]: http://www.sqlalchemy.org	
[Homebrew]: http://mxcl.github.com/homebrew
[Max Howell]: https://twitter.com/mxcl
[ImageMagick]: http://www.imagemagick.org
[wget]: http://www.gnu.org/software/wget
[ack]: http://betterthangrep.com
[phpMyAdmin]: http://www.phpmyadmin.net/home_page/index.php
[Apache Virtual Host]: http://httpd.apache.org/docs/2.2/vhosts/
[last version of phpMyAdmin]:  http://sourceforge.net/projects/phpmyadmin/files/phpMyAdmin/3.5.8.1/phpMyAdmin-3.5.8.1-all-languages.zip/download#!md5!a65d444787645735c75bca49cdb558cb
[how to manage static files (CSS, images)]: https://docs.djangoproject.com/en/1.5/howto/static-files/
[part 1]: https://docs.djangoproject.com/en/1.5/intro/tutorial01/
[part 6]: https://docs.djangoproject.com/en/1.5/intro/tutorial06/
[How to use Django with Apache ad mod_wsgi]: https://docs.djangoproject.com/en/1.5/howto/deployment/wsgi/modwsgi/
[official mod_wsgi documentation]: https://code.google.com/p/modwsgi/wiki/IntegrationWithDjango

