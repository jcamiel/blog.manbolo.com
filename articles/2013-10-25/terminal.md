## Automating Terminal Tasks on OSX

<img src="/2013/10/25/iterm2.png" alt="iTerm2 Icon" width="245" height="218">

### My local Django setup

Part of my setup to work locally on my Mac with [Django][] includes always the same tasks:

- task 1: Activate the [virtualenv][] of the project on which I'm working,
- task 2: Start the Django development server locally,
- task 3: Start [Redis][], as a broker for my [Celery][] asynchronous tasks,  
- task 4: Start the Celery worker server

I usually have an open Terminal window dedicated to one Django project, and each task has its own tab.

Each task is launched with one or two command lines, very simple but tedious to remember. This way, I've output of Redis, Celery, and Django HTTP server in each tab and I can see live if something is not working. 

On the first tab, task 1 commands are:

	# Activate the virtual env for this project
	source ~/Documents/Dev/VirtualEnv/venv-python-2.7-example/bin/activate
	
	# Go in the Django project directory to commit/push/run manage.py etc...
	cd ~/Documents/Dev/example_project/example
	
On the second tab, task 2 commands are:

	# Activate the virtual env for this project, cd in the Django project directory
	source ~/Documents/Dev/VirtualEnv/venv-python-2.7-example/bin/activate
	cd ~/Documents/Dev/example_project/example
	
	# Launch the Django developement server
	./manage.py runserver --insecure
	
On the third tab, task 3 commands are:

	# Start Redis, and wait for task
	redis-server /usr/local/etc/redis.conf
	
On the fourth tab, task 4 commands are:

	# Activate the virtual env for this project, cd in the Django project directory

	source ~/Documents/Dev/VirtualEnv/venv-python-2.7-example/bin/activate
	cd ~/Documents/Dev/example_project/example
	
	# Start the Celery worker.
	./manage.py celery worker --loglevel=info

It's not so complicated, not too long, but each time I've to restart my Mac or when I accidentally kill my terminal window, I've to relaunch each task. It's sufficiently boring that I've wanted to automated all this.

### Automator and Terminal.app

All this sounds a perfect [Automator][] use's case. Automator allows you to create workflows for automating repetitive tasks, using a wide variety of programs like Finder, Safari and ... Terminal! Basically, you can drag and drop predefined application actions and/or use [Applescript][] for more complex tasks.

If you launch Automator, and look at the Library (View > Show Library), you can have the list of drag & drop commands exposed by applications. If you look for the commands with the Terminal.app icon, you will see the followings available commands:

![Automator Library][]

- Apple Versioning Tool
- CVS Add
- CVS Checkout
- CVS Commit
- CVS Update
- Run Shell Script

The later command 'Run Shell Script' seems interesting but unfortunately there is no 'Open a new tab' command. To confirm this, we are going to check the Terminal AppleScript scripting interface. This interface exposes how we can interact with an application using AppleScript (and by extension how we can interact with an application using Automator since we can include any AppleScript script in Automator).

Launch AppleScript Editor, go to 'File > Open Dictionary...'. You can select any application to open its dictionary interface. This dictionary lists all the objects and commands your application understands. For instance, we can browse to Terminal.app:

![AppleScript Library][]

And open it's 'scripting definition':

![Terminal.sdef][]

In the dictionary viewer, you can view these elements:

- <img src="suite@2x.png" class="inline" style="vertical-align:middle;width:24px; height:24px;"/> represent a __suite__, ie a container for objects, commands and events;
- <img src="class@2x.png" class="inline" style="vertical-align:middle;width:24px; height:24px;"/> represent a __class__, ie an object that can be used in an AppleScript script;
- <img src="property@2x.png" class="inline" style="vertical-align:middle;width:24px; height:24px;"/> is a __property__ of the object;
- <img src="event@2x.png" class="inline" style="vertical-align:middle;width:24px; height:24px;"/> is an __element__ contains by a class.

So we can see that there is only one command specific to Terminal, that is `do scrip`. That can be useful, but it will be difficult to do what we want to do: open tabs programatically in a Terminal window.

A quick search on the web shows thats, to open new tabs in AppleScript, people are [either sending keystroke to the Terminal][]:

	-- Open a new tab.
    tell application "System Events" to tell process "Terminal" to keystroke "t" using command down
    
	if (the (count of the window) = 0) or (the busy of window 1 = true) then
        tell application "System Events" keystroke "n" using command down
    end tell

Or are trying to play with Terminal user saved settings. The best answer is [this StackOverflow answer][], that presents three different ways of opening terminal tabs.

### iTerm2 to the rescue

In all these solutions, I find the AppleScript scripts either fragile or too complicated. Fortunately there is a great and free alternative to the stock Terminal app on OSX: [iTerm2][]. 
 
iTerm2 is a replacement for Terminal and the successor to iTerm. It works on Macs with OS 10.5 (Leopard) or newer. Its focus is on performance, internationalisation, and supporting innovative features.

The best part is that iTerm2 [has a first-class AppleScript support][]. 

Once you have downloaded iTerm2, take a look at the iTerm2 AppleScript dictionary:

![iTerm2 sdef][]

iTerm2 has much more commands and classes than Terminal. In particular, it has a `launch` command that can launch a new `session` i.e a new tab! With this command, we can now write an AppleScript script that opens 4 tabs, each tab launching a task of the Django setup.

	tell application "iTerm 2"
		make new terminal
		tell the current terminal
			activate current session
	
			-- Go to my Django project
			launch session "Default Session"
			tell the last session
				write text "source ~/Documents/Dev/VirtualEnv/venv-python-2.7-example/bin/activate"
				write text "cd ~/Documents/Dev/example_project/example"
			end tell
	
			-- Launch Django server
			launch session "Default Session"
			tell the last session
				write text "source ~/Documents/Dev/VirtualEnv/venv-python-2.7-example/bin/activate"
				write text "cd ~/Documents/Dev/example_project/example"
				write text "./manage.py runserver --insecure"
			end tell
	
			-- Launch Redis
			launch session "Default Session"
			tell the last session
				write text "redis-server /usr/local/etc/redis.conf"
			end tell
	
			-- Launch Celery
			launch session "Default Session"
			tell the last session
				write text "source ~/Documents/Dev/VirtualEnv/venv-python-2.7-example/bin/activate"
				write text "cd ~/Documents/Devexample_project/example"
				write text "./manage.py celery worker --loglevel=info"
			end tell
	
		end tell
	end tell

Now that we have our AppleScript that automates the Django setup, we can use Automator to create an application that runs this script. To setup Django, all I will have to do is launching this app!

- Launch Automator
- 'File' > 'New'
- Choose Application
- From the library, search for 'Run AppleScript'
- Drag and drop 'Run appleScript' to the main windows, 
- Under the 'Options' segmented control, select 'Ignore this action's input'
- In the script, replace  `(* Your script goes here *)` with our AppleScript script
- Click `Save` to create your application and that's done.

<a href="/2013/10/25/automator.png"><img src="/2013/10/25/automator.png" alt="Automator with script" width="600" height="377"></a>

### Conclusion

iTerm2 is really a perfect replacement for Terminal and I use it now exclusively. It has really improved my productivity, and I'm sure you can reuse this example with a Rail setup for instance.

iTerm2 is free so [please consider donating][] to support this great product!

From jc.

[Celery]: http://www.celeryproject.org/
[Django]: https://www.djangoproject.com/
[Redis]: http://redis.io/
[Automator]: http://en.wikipedia.org/wiki/Automator_(software)
[AppleScript]: http://en.wikipedia.org/wiki/AppleScript
[AppleScript Language Guide]: https://developer.apple.com/library/mac/documentation/applescript/conceptual/applescriptlangguide/introduction/ASLR_intro.html
[this StackOverflow answer]: http://stackoverflow.com/questions/1794050/applescript-to-open-named-terminal-window
[Automator Library]: AutomatorLibrary.png
[AppleScript Library]: AppleScriptLibrary.png
[Terminal.sdef]: TerminalSdef.png
[either sending keystroke to the Terminal]: http://apple.stackexchange.com/questions/15317/how-can-i-write-a-script-to-open-multiple-terminal-tabs-and-execute-code-in-them
[iTerm2 Icon]: iterm2.png
[virtualenv]: http://www.virtualenv.org/en/latest/
[iTerm2]: http://www.iterm2.com/#/section/home
[has a first-class AppleScript Support]: http://www.iterm2.com/#/section/documentation/scripting
[please consider donating]: http://www.iterm2.com/#/section/home
[iTerm2 sdef]: iterm2sdef.png
[Automator with script]: automator.png


