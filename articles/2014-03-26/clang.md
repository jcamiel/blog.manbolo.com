## Xcode 5.1 Breaks Python Native Extensions and Ruby Gems 


If you've installed Xcode 5.1 and want to install some of your favorite Python or Ruby toys on your OSX, you could have a bad surprise. For instance, if you try to install [Fabric][] after upgrading to Xcode 5.1, you will fail!

Installation:

	pip install Fabric
	
Results:

	...
	creating build/temp.macosx-10.9-intel-2.7/src

	cc -fno-strict-aliasing -fno-common -dynamic -arch x86_64 -arch i386 -pipe -fno-common -fno-strict-aliasing -fwrapv -mno-fused-madd -DENABLE_DTRACE -DMACOSX -Wall -Wstrict-prototypes -Wshorten-64-to-32 -fwrapv -Wall -Wstrict-prototypes -DENABLE_DTRACE -arch x86_64 -arch i386 -pipe -std=c99 -O3 -fomit-frame-pointer -Isrc/ -I/usr/include/ -I/System/Library/Frameworks/Python.framework/Versions/2.7/include/python2.7 -c src/_fastmath.c -o build/temp.macosx-10.9-intel-2.7/src/_fastmath.o
	
	clang: error: unknown argument: '-mno-fused-madd' [-Wunused-command-line-argument-hard-error-in-future]

	clang: note: this will be a hard error (cannot be downgraded to a warning) in the future

	error: command 'cc' failed with exit status 1

The installation of [Fabric][] failed because Fabric (probably [PyCrypto][]) is using an unused command line (`-mno-fused-madd`), and, as of Xcode 5.1, `clang` treats unrecognized command-line options as errors. 

Buried in the [Xcode 5.1 release notes][]:

> Compiler
>
> - As of Apple LLVM compiler version 5.1 (clang-502) and later, the optimization level `-O4` no longer implies 
> link time optimization (LTO). In order to build with LTO explicitly use the `-flto` option in addition to 
> the optimization level flag(15633276)
> 
> - __The Apple LLVM compiler in Xcode 5.1 treats unrecognized command-line options as errors. This issue has been 
> seen when building both Python native extensions and Ruby Gems, where some invalid compiler options are currently 
> specified.__
>
> Projects using invalid compiler options will need to be changed to remove those options. 
> To help ease that transition, the compiler will temporarily accept an option to downgrade the error to a warning:
>
>    `-Wno-error=unused-command-line-argument-hard-error-in-future`
> 
>
> Note: This option will not be supported in the future.
> 
> To workaround this issue, set the `ARCHFLAGS` environment variable to downgrade the error to a warning. 
> For example, you can install a Python native extension with:
>
> `$ ARCHFLAGS=-Wno-error=unused-command-line-argument-hard-error-in-future`
> `easy_install ExtensionName`
> 
> Similarly, you can install a Ruby Gem with:
>
> `$ ARCHFLAGS=-Wno-error=unused-command-line-argument-hard-error-in-future`
> `gem install GemName`

So if you want to install Fabric, you should type in a terminal:

	export ARCHFLAGS=-Wno-error=unused-command-line-argument-hard-error-in-future
	pip install Fabric
	
And everything will be fine... 

Xcode, always a good surprise with every update....

From jc.

[Xcode 5.1 release notes]: https://developer.apple.com/library/mac/releasenotes/DeveloperTools/RN-Xcode/Introduction/Introduction.html
[Fabric]: https://github.com/fabric/fabric
[Paramiko]: https://github.com/paramiko/paramiko
[PyCrypto]: https://www.dlitz.net/software/pycrypto/