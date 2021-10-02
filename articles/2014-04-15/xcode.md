## Automated Static Code Analysis with Xcode 5.1 and Jenkins

[Static code analysis][] is a tool to check your code against coding errors at build/edit time: [in these Dark Ages of apocalyptic error][], it's certainly a good weapon to add to your developer arsenal. 

1.  [__Analyze from the IDE__](#b1)
2.  [__Analyze from the command line__](#b2)
3.  [__Analyze from Jenkins__](#b3)

<h3 id="b1">1. Analyze from the IDE</h3>

Xcode has a powerful static code analyzer, really simple to use: just open your project, 'Product' > 'Analyze' or simply hit &#8679;&#8984;B:

<a href="/2014/04/15/analyze.png"><img src="/2014/04/15/analyze.png" width="600" height="434"></a>

The static analyzer can detect potential memory leaks, unused ivars, variables used but never read, dead code path etc... It can prevents a whole class of errors while sanitising your code. 

<a href="/2014/04/15/leaks.png"><img src="/2014/04/15/leaks.png" width="600" height="229"></a>

<h3 id="b2">2. Analyze from the command line</h3>

Launching the static analyze in command-line with Xcode 5.1 is really simple:

	xcodebuild -project PATH_TO_YOUR_XCODEPROJ -scheme YOU_APP_SCHEME -sdk iphonesimulator7.1 analyze

Example:

	xcodebuild -project Meon.xcodeproj -scheme iOS-Meon -sdk iphonesimulator7.1 analyze

If you're using a target / configuration approach over [a scheme approach][], you can simply use:

	xcodebuild -project PATH_TO_YOUR_XCODEPROJ -target YOUR_APP_TARGET -configuration Debug -sdk iphonesimulator7.1 analyse

Then, you will have the analysis result in your terminal window:

![Command line analysis][]

Just a detail: if you're using a scheme based approach (contrary to the traditional pre-Xcode 4 target / configuration), you don't need to set in the command line options which configuration you want to use. Well used, the scheme approach dispenses you to think in term of Release / Debug configurations: the archive scheme will used the Release configuration, because obviously you want to deliver your app compiled in Release; the Debug scheme will use the Debug configuration, and the analyze scheme is based on the Debug configuration because Release optimisation could alter the static code analyse. If you want to check on what configurations your schemes are based, just click on the current scheme name in Xcode status bar

![Manage schemes][]

Then 'Manage Schemes...' 

<a href="/2014/04/15/scheme.png"><img src="/2014/04/15/scheme.png" width="600" height="434"></a>

Viewing analysis results from the terminal is not very practical. To have a better rendering of the issues, we are going to use the last version of [Clang Static Analyzer][]. The advantage of using this analyzer is that it's often newer than the analyzer provided with Xcode, and thus can contain bug fixes, new checks, or simply better analysis.

For instance, the [last version of Clang Static Analyzer][] released in February 2014 includes the following improvements:

- includes about 9 months of change to Clang itself (improved C++11/14 support, etc.)
- more precise modelling of Objective-C properties, which enables the analyzer to find more bugs.
- includes a new "missing call to super" warning, which looks for common pattern in iOS/OSX APIs that require chaining a call to a super class's implementation of a method.
- accepts `-arch arm64` (which may be passed by Xcode 5.0), but for the time being analyses code in such cases as `-arch armv7s`.
- many sundry fixes, improvements to C++ support, etc.

To install it, just download the last version [checker-276.tar.bz2][] and unzip it. In the `checker-276` folder, you will find two important scripts: `scan-build` and `scan-view`.

To launch an analyse, just write the same command line as previously, prefixed with `scan-build`:

	scan-build xcodebuild -project PATH_TO_YOUR_XCODEPROJ -scheme YOU_APP_SCHEME -sdk iphonesimulator7.1 analyze 

Example:

	scan-build xcodebuild -project Meon.xcodeproj -scheme iOS-Meon -sdk iphonesimulator7.1 analyze

This should produce:

	...
	** ANALYZE SUCCEEDED **
	
	
	The following commands produced analyzer issues:
		Analyze iOS-Meon/Classes/MainMenuViewController.m
		Analyze iOS-Meon/Classes/RootViewController.m
		Analyze iOS-Meon/Classes/PlayViewController.m
		Analyze iOS-Meon/Classes/LevelManager.m
		Analyze iOS-Meon/Classes/NSData+Base64.m
		Analyze iOS-Meon/Classes/Reachability.m
		Analyze iOS-Meon/Classes/SolverAnimator.m
		Analyze iOS-Meon/Classes/SpriteSheetManager.m
	(8 commands with analyzer issues)
	scan-build: 15 bugs found.
	scan-build: Run 'scan-view /var/folders/kg/p23fnf1s2rl6zz79c762mp900000gn/T/scan-	build-2014-04-14-214518-2184-1' to examine bug reports.

`scan-build` produces a temporary report, and the last output ot the logs indicates of to launch the viewer:

	scan-view /var/folders/kg/p23fnf1s2rl6zz79c762mp900000gn/T/scan-	build-2014-04-14-214518-2184-1'

The report is HTML-based and offers a detailed view on each potential bug:

<a href="/2014/04/15/report.png"><img src="/2014/04/15/report.png" style="width:600px; height:517px;"></a>

<a href="/2014/04/15/report-detail.png"><img src="/2014/04/15/report-detail.png" style="width:600px; height:517px;"></a>

<h3 id="b3">3. Analyze from Jenkins</h3>

Launching analysis from the command line is cool, but what's cooler is to have your [Jenkins][] do it automatically for you while you drink a coffe (or play ping-pong). There is a [Clang Scan-Build Plugin][] that can be used, but unfortunately, as of 14 April 2014, the plugin only supports Xcode 4.

To support Xcode 5, we'll have to make small modifications to the plugin and recompile it. Fortunately, it's not as complicated as it sounds.

First thing is to install [Maven][] on your OSX (if you don't already have it - OSX prior to Mavericks/10.9 actually comes with Maven 3 built in). To install it, simply use [Homebrew][]:

	brew install maven

Once done, get the last version of the [Clang Scan-Build Plugin's sources on GitHub][].

	git clone git@github.com:jenkinsci/clang-scanbuild-plugin.git

The only mandatory change is in `clang-scanbuild-plugin/src/main/java/jenkins/plugins/clangscanbuild/commands/ScanBuildCommand.java`:

Replace these lines:

		args.add( "clean" ); // clang scan requires a clean
		args.add( "build" );

By these lines:

		args.add( "clean" ); // clang scan requires a clean
		args.add( "analyze" );

If you have only one `xcodeproj` with schemes and no workspace, you should also replace these lines:

			// Xcode 3,4 standalone project
			if( isNotBlank( getTarget() ) ){
				args.add( "-target", getTarget() );
			}else{
				args.add( "-activetarget" );
			}

With these lines:

			// Xcode 3,4 standalone project
			if( isNotBlank( getTarget() ) ){
				args.add( "-target", getTarget() );
			}else{
				args.add( "-scheme", getScheme() );
			}

This way, you'll be able to specify your `xcodeproj` and a scheme in the Jenkins plugin configuration.

Next, recompile the plugin: open a terminal, go in your working copy of the plugin and type

	mvn install
	
Or, if you want to skip tests

	mvn -Dmaven.test.skip=true install

Then after the compilation success, a `target` folder has been created; you will find inside the plugin installer file, `clang-scanbuild-plugin.hpi`, (which is simply a jar file). To install this modified plugin, copy it directly in the Jenkins plugins folder (on your Jenkins server), usually under `~/.jenkins/plugins`. Restart Jenkins, go to the plugins configuration page to check that your new plugin is installed (goto your Jenkins server homepage, then select 'Manage Jenkins', then 'Manage Plugins' and click on the 'Installed' tabs):

<img src="/2014/04/15/clang-plugin.png" alt="Clang Plugin" width="598" height="195" class="bordered">
  
Now that the plugin is ready, we're going to install the [Clang Static Analyzer][] on our Jenkins machine. Just unzip [checker-276.tar.bz2] on your custom binaries location: for instance, I unzip mine under `/usr/local/Cellar/scan-build/` to not mess with the system binaries.

Then we need to tell Jenkins where to find the static analyzer:

- Go to your Jenkins server homepage, then select 'Manage Jenkins' <img src="/2014/04/15/jenkins1.png" alt="Jenkins step 1" width="300" height="379" class="bordered">
- In the Clang Static Analyzer section, click on 'Clang Static Analyzer installations...' <img src="/2014/04/15/jenkins2.png" alt="Jenkins step 2" width="600" height="206" class="bordered">
- Type 'scan-build' in the Name text field, and `/usr/local/Cellar/scan-build` in the 'Installation directory' field (this is the folder containing the `scan-build` binary on the Jenkins server) <img src="/2014/04/15/jenkins3.png" alt="Jenkins step 3" width="598" height="213" class="bordered">

Finally, it's time to create a job for the analysis. If your iOS job is already using the [Warnings Plugin][], I advise to create create a dedicated job for the static analyze, because the warnings raised by the static analysis will be also counted by the warning plugin as "standard" warninngs.

So, create a new job for this build, and add a build step 'Clang Scan-build':

<img src="/2014/04/15/jenkins4.png" alt="Jenkins step 4" width="574" height="418" class="bordered">

Then add a post build action, 'Publish Clang scan-build reports':

<img src="/2014/04/15/jenkins6.png" alt="Jenkins Step 6" width="519" height="198" class="bordered">

You can customize the stable / unstable build threshold, for instance 5 means that over 5 issues, your build will be considered as instable. Go crazy and set it to 0! 

Finally, launch your first build. Open the job logs, and check the command line used at the beginning of the job:

	EXECUTING COMMAND:[/usr/local/Cellar/scan-build/scan-build, -k, -v, -v, -o, /Users/jenkins/.jenkins/jobs/Meon/workspace/clangScanBuildReports, xcodebuild, -scheme, Meon, -configuration, Debug, -sdk, iphonesimulator7.1, clean, analyze]
	[iOS] $ /usr/local/Cellar/scan-build/scan-build -k -v -v -o /Users/jenkins/.jenkins/jobs/Meon/workspace/clangScanBuildReports xcodebuild -scheme Meon -configuration Debug -sdk iphonesimulator7.1 clean analyze
	scan-build: Using '/usr/local/Cellar/scan-build/bin/clang' for static analysis
	scan-build: Emitting reports for this run to '/Users/jenkins/.jenkins/jobs/Meon/workspace/clangScanBuildReports/2014-04-15-184221-65970-1'.
	User defaults from command line:
    PBXBuildsContinueAfterErrors = YES

	Build settings from command line:
		CLANG_ANALYZER_EXEC = /usr/local/Cellar/scan-build/bin/clang
		CLANG_ANALYZER_OTHER_FLAGS = 
		CLANG_ANALYZER_OUTPUT = plist-html
		CLANG_ANALYZER_OUTPUT_DIR = /Users/jenkins/.jenkins/jobs/Meon/workspace/clangScanBuildReports/2014-04-15-184221-65970-1
		RUN_CLANG_STATIC_ANALYZER = YES
		SDKROOT = iphonesimulator7.1
	
	=== CLEAN TARGET Meon OF PROJECT Meon WITH CONFIGURATION Debug ===

	Check dependencies
	...
	
Extracted from the logs, you can see the command line call:

	/usr/local/Cellar/scan-build/scan-build -k -v -v -o /Users/jenkins/.jenkins/jobs/Meon/workspace/clangScanBuildReports xcodebuild -scheme Meon -configuration Debug -sdk iphonesimulator7.1 clean analyze
	
Which is exactly what we want. After a few builds, you will have this nice graph on your jobs homepage:

<img src="/2014/04/15/jenkins5.png" alt="Jenkins step 5" width="745" height="366" class="bordered">

If you select a particular job, you will see the list of each issues reported by the analyzer. At the end of each line, you have a link to the detail analysis for this particular issue: it is simply the same HTML report that you would have with `scan-view` but this time, it's integrated in the Jenkins jobs page.

Unfortunately, if you click on a bug detail, you will see a 404 page instead of the bug report. To fix it, copy the scan build output to a folder named ‘clangScanBuildReports’ inside the build directory (you can copy only the html files). For instance, in my case, I've added another build step after the static anlysis that will do:

	mkdir -p ${WORKSPACE}/../builds/${BUILD_NUMBER}/clangScanBuildReports/
	cp ${WORKSPACE}/clangScanBuildReports/*/StaticAnalyzer/Meon/Meon/normal/i386/*.html ${WORKSPACE}/../builds/${BUILD_NUMBER}/clangScanBuildReports/

And that should be sufficient to fix this issue (source: [Clang Scan-Build Jenkins Plugin][]).

From jc.

<hn>https://news.ycombinator.com/item?id=7595120</hn>

[Jenkins Step 6]: jenkins6.png
[Clang Scan-Build Jenkins Plugin]: http://deadmeta4.com/clang-scan-build-jenkins-plugin/
[in these Dark Ages of apocalyptic error]: http://heartbleed.com
[Warnings Plugin]: https://wiki.jenkins-ci.org/display/JENKINS/Warnings+Plugin
[Clang Scan-Build Plugin's sources on GitHub]: https://github.com/jenkinsci/clang-scanbuild-plugin
[Homebrew]: http://brew.sh
[Maven]: http://maven.apache.org
[Clang Scan-Build Plugin]: https://wiki.jenkins-ci.org/display/JENKINS/Clang+Scan-Build+Plugin
[Jenkins]: http://jenkins-ci.org
[last version of Clang Static Analyzer]: http://clang-analyzer.llvm.org/release_notes.html
[checker-276.tar.bz2]: http://clang-analyzer.llvm.org/downloads/checker-276.tar.bz2
[Clang Static Analyzer]: http://clang-analyzer.llvm.org
[a scheme approach]: https://developer.apple.com/library/mac/featuredarticles/XcodeConcepts/Concept-Schemes.html
[Static code analysis]: http://en.wikipedia.org/wiki/Static_program_analysis
[Manage schemes]: manage-schemes.png
[Command line analysis]: cli-analyse.png
[Clang Plugin]: clang-plugin.png