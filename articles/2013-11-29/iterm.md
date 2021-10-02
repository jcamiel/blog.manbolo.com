## Configuring iTerm 2 with Python

<a href="/2013/11/29/panes.png"><img src="/2013/11/29/panes.png" alt="Panes" width="485" height="349"></a>

In [Automating Terminal Tasks on OSX][], I was describing how I used a combination of [iTerm 2][], AppleScript and Automator to launch a batch of shell commands in iTerm 2 tabs.

This solution was useful but not very configurable: if I wanted another set of commands or another configuration, I had to duplicate my Automator application, modify the AppleScript, and save the application. Not a big deal, but quite tedious.

### Introducing panes

So now, let me present you __[panes][]__!

`panes.py` is a Python 2.7+ script to configure an [iTerm 2][] window.
`panes.py` reads a configuration file at `~/.panesrc` and creates a new iTerm 2 window.

Based on the configuration file, `panes.py` creates additional horizontal or vertical split panes inside this window and can launch additional commands at the startup of the shell pane.

The configuration file uses Microsoft Windows INI files format. All configurations are described in one only file, `~/.panesrc`, and each configuration is a section in this file.
 
For instance, the default config file is:


	[Default]

	panes: [
    	{
	    "name": "Pane 1",
    	"split": "v",
	    "cmds": [
    	    "echo pane 1",
        	"ls -ltr",
	        ],
    	},
	    {
    	"name": "Pane 2",
	    "split": "h",
    	"cmds": [
        	"echo pane 2",
	        "ls -ltr",
    	    ],
	    },
    	{
	    "name": "Pane 3",
    	"split": "h",
	    "cmds": [
    	    "echo pane 3",
        	"ls -ltr",
	        ],
    	},
	]


To launch this config, simply type `panes.py default` or `panes.py`. This will create a new iTerm 2 window with three panes labeled 'Pane 1', 'Pane 2' and 'Pane 3'. Each pane will launch an `echo` command followed by a `ls -ltr` command. For instance, you can use it to ssh to your server and output some logs in a pane.

You can add another configuration by adding a section to `~/.panesrc`:

	[default]

	...

	[prod]

	panes: [
    	{
	    "name": "Pane 1",
    	"split": "v",
	    "cmds": [
    	    "ssh prod.example.com",
        	"tail -f /var/log/example.log",
        	],
	    }
    	]
    
	[preprod]

	...


And launch your prod environment like this: `panes.py prod`.

I now use [panes][] to setup my various Django projects, or connect to a server and watch some logs. If at any point I need to reboot my Mac, or if one of my shell session is [broken-pipe][], I just have to relaunch my panes session.

It's a kind of very very simple [tmux][] or [Screen][], but it is completely sufficient for my needs. And it can be perfectly integrated with [Alfred][] for instance...

### How does it work?

`panes.py` works by creating a temporary AppleScript script to pilot [iTerm 2][]. This script is totally based on [Luis Martin Gil][] iTerm 2 scripts that you can have at <https://github.com/luismartingil/per.scripts/blob/master/iterm_launcher02.applescript>. Kudos to Luis for mastering AppleScript which I have not the courage to do! Without Luis' work, I wouldn't be able to do what I wanted.

The Python script does the following:

- reads the configuration file in `~/.panesrc`,
- constructs a temporary AppleScript script for piloting iTerm 2, 
- executes this AppleScript with the OSX built-in command `osascript`.

I've chosen to do this because I wanted to have my configuration described in a simple text file and I didn't want to spend time doing this in AppleScript. Moreover, I find it rather cool to script an OSX app in Python. Seriously, [who likes AppleScript][]? Imagine you could script all your OSX apps in a decent language, like Python, Ruby or Javascript... Wouldn't it be super cool?

panes is [available on GitHub][]! If it can be useful to someone else, I would be happy. In the meantime, I'm ready for the pull requests!

Thanks [_oho][] for the debugging <img src="smiley-happy.png" class="inline" style="vertical-align:middle;"/>!

From jc.

[Alfred]: http://www.alfredapp.com/
[_oho]: https://twitter.com/_oho
[iTerm 2]: http://www.iterm2.com/
[panes]: https://github.com/manbolo/panes
[Automating Terminal Tasks on OSX]: http://blog.manbolo.com/2013/10/25/automating-terminal-tasks-on-osx
[broken-pipe]: http://en.wikipedia.org/wiki/Broken_pipe
[tmux]: http://tmux.sourceforge.net/
[Screen]: https://www.gnu.org/software/screen/
[available on GitHub]: https://github.com/manbolo/panes
[who likes AppleScript]: http://blog.hoachuck.biz/
[Luis Martin Gil]: http://www.luismartingil.com/