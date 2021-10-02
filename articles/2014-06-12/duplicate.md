## How to Remove Duplicates in Open With Dialog on OSX

<img src="http://blog.manbolo.com/2014/06/12/duplicate.png" alt="Duplicate entries" width="600" height="191">

The OSX "Open With" menu can sometimes be clustered with duplicates. To remove them, close  all Finder windows, open a terminal and type:

    /System/Library/Frameworks/CoreServices.framework/Frameworks/LaunchServices.framework/Support/lsregister -kill -r -domain local -domain system -domain user

Done (works on Mavericks and +).

From jc.
