## Shell Scripting with Objective-C

__Updated on 2014/06/09:__ Interesting discussion on [Hacker News](https://news.ycombinator.com/item?id=7827651), with [a bash](https://github.com/manbolo/appicon/blob/master/appicon.sh) and [an Objective-Smalltalk](https://github.com/manbolo/appicon/blob/master/appicon.st) alternative. The [bash one](https://github.com/manbolo/appicon/blob/master/appicon.sh) is certainly the most concise.

* * * * *

Inspired by [Nicolas Bouilleaud's Objective-C Minimalism][], I've tried to see if I could use Objective-C for shell scripting on my Mac. I normally code my shell scripts in Python, I love the language, so easy to read, so fun to write, with a ton of brillant third-party libraries, like [Requests][], [Pillow][] or [Beautiful Soup][]. But I would like to see if Objective-C could also do the job for shell scripting: as I spend the most of my day job writings iOS apps, I could maybe reuse my knowledge for small utility scripts.

### The Challenge

Let's take an example: I would like to get the app icons for a list of iOS apps available in the store. I need these icons in different sizes, let's say 1024 pixels, 512 pixels, 120 pixels etc... and the icons should come with [the new iOS 7 shape][].

Getting an app icon from iTunes is really simple. The App Store [has a lookup web API][] to query for all metadata of an app (title, description, icon, screenshots, ratings etc...). For instance, given an app id, we can ask for the metadata of [Kingdom Rush Frontiers][]: <http://itunes.apple.com/us/lookup?id=598581396>

    {
    "resultCount": 1,
    "results": [{
        "artistId": 558612918,
        "artistName": "Ironhide Game Studio",
        "artistViewUrl": "https://itunes.apple.com/us/artist/ironhide-game-studio/id558612918?uo=4",
        "artworkUrl100": "http://a680.phobos.apple.com/us/r30/Purple/v4/55/92/7d/55927d0d-bf19-dd3f-ff72-ff6069e7c7b5/mzl.sfsarfno.png",
        "artworkUrl512": "http://a680.phobos.apple.com/us/r30/Purple/v4/55/92/7d/55927d0d-bf19-dd3f-ff72-ff6069e7c7b5/mzl.sfsarfno.png",
        "artworkUrl60": "http://a407.phobos.apple.com/us/r30/Purple/v4/dc/4a/01/dc4a0174-dde5-65b0-f952-862c0ea1d070/Icon.png",
        "averageUserRating": 4.5,
        "averageUserRatingForCurrentVersion": 4.5,
        ...

From the JSON result, we can see that the icon's URL is <http://a680.phobos.apple.com/us/r30/Purple/v4/55/92/7d/55927d0d-bf19-dd3f-ff72-ff6069e7c7b5/mzl.sfsarfno.png>. 

But the icon provided by the [iTunes Lookup API][] is totally square, and doesn't include the standard rounded iOS 7 shape. So, in our script, we'll also apply a mask on the 1024 x 1024 icon, and compute all the resized icons with this mask.

<img src="/2014/06/01/icons.png" width="575" height="170">


### In Python

This is the Python code:

    #!/usr/bin/env python
    from StringIO import StringIO
    import requests
    from PIL import Image
    from slugify import slugify
    
    
    def download_icon(icon_url, title, mask):
        """
        """
        # Download icon an apply mask.
        icon_data = requests.get(icon_url)
        icon = Image.open(StringIO(icon_data.content))
        icon.putalpha(mask)
    
        # Compute and save thumbnails.
        for size in [1024, 512, 120, 114, 60, 57]:
            icon_resized = icon.resize((size, size), Image.ANTIALIAS)
            icon_resized.save("icon_{0}_{1}x{1}.png".format(title, size))
    
    
    def download_app_metadata(app_id, mask):
        """
        """
        print("download_app_json {}".format(app_id))
    
        url = "http://itunes.apple.com/us/lookup?id={}".format(app_id)
        r = requests.get(url)
        if r.status_code != 200:
            print('Error downloading {} {}'.format(url, r.status_code))
            return
    
        results = r.json()
    
        meta = results["results"][0]
        icon_url = meta["artworkUrl512"]
        title = slugify(meta["trackCensoredName"])
    
        download_icon(icon_url, title, mask)
    
    
    def download_icon_mask():
        """
        """
        # Download the mask from Dropbox, this way we don't
        # have to provide mask.png and the script is self contained.
        mask_url = "https://raw.githubusercontent.com/manbolo/appicon/master/mask.png"
        mask_data = requests.get(mask_url)
        mask = Image.open(StringIO(mask_data.content))
        mask = mask.convert('L')
        return mask
    
    
    def download_apps():
        """
        """
        app_ids = [
            "400274934",  # Meon
            "598581396",  # Kingdom Rush Frontiers
            ]
    
        mask = download_icon_mask()
    
        [download_app_metadata(app_id, mask) for app_id in app_ids]
    
    
    if __name__ == '__main__':
    
        download_apps()

Really straightforward, you can [download the code here][].  I find it easy to read (especially since it's written by me!) understandable, and the code reflects the programmer's intent. A few notes:

- I have used 3 non standard libraries: [Pillow][] to apply a mask and resize images, [Requests][] to do simple HTTP requests and [python-slugify][] to easily get a filename from an arbitrary app title.
- I've hosted the mask on Github, this way I don't have to distribute it and the script is self contained.
- the script is not error prone __at all__!

### In Objective-C

Let's see how this script could be written in Objective-C. To this purpose, I've used [objc-run][]: [objc-run][] is a shell script which compiles and executes Objective-C source code files on the fly; basically, you're writing scripts in Objective-C (bonus: it also integrates with [CocoaPods][]).

The source code of the [Python script written is Objective-C][] is now:

    /*
     *
     */
    void downloadIcon(NSString *iconURLString, NSString *title, NSImage *mask)
    {
        NSURL *iconURL = [NSURL URLWithString:iconURLString];
        NSImage *icon = [[NSImage alloc] initWithContentsOfURL:iconURL];
        NSImage *iconMasked = [icon maskUsingMaskImage:mask];
    
        for(NSNumber *size in @[@1024, @512, @120, @114, @60, @57]){
            NSInteger width = [size integerValue];
            NSImage *iconResized = [iconMasked resizeToWidth:width];
    
            NSData *data = [iconResized pngData];
            [data writeToFile:[NSString stringWithFormat:@"icon_%@_%ld_%ld.png", title, width, width] atomically:YES];
        }
    
    }
    
    /*
     *
     */
    void downloadAppMetadata(NSString *appId, NSImage *mask)
    {
        NSLog(@"download_app_json %@\n", appId);
    
        NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"http://itunes.apple.com/us/lookup?id=%@", appId]];
        NSData *resultsData = [NSData dataWithContentsOfURL:url];
        if (!resultsData) {
            NSLog(@"Error downloading %@", url);
            return;
        }
    
        NSDictionary *results = [NSJSONSerialization JSONObjectWithData:resultsData options:0 error:nil];
    
        NSDictionary *meta = results[@"results"][0];
        NSString *iconURL = meta[@"artworkUrl512"];
        NSString *title = [meta[@"trackCensoredName"] slugString];
    
        downloadIcon(iconURL, title, mask);
    
    }
    
    
    /*
     * Download the mask from Github, this way we don't
     * have to provide mask.png and the script is self contained.
     */
    NSImage* downloadIconMask()
    {
        NSURL *maskURL = [NSURL URLWithString:@"https://raw.githubusercontent.com/manbolo/appicon/master/maskInverted.png"];
        NSImage *mask = [[NSImage alloc] initWithContentsOfURL:maskURL];
        return mask;
    }
    
    
    void downloadApps()
    {
        NSArray *appIds = @[
                            @"400274934",  // Meon
                            @"598581396",  // Kingdom Rush Frontiers
                            ];
    
        NSImage *mask = downloadIconMask();
    
        for(NSString *appId in appIds){
            downloadAppMetadata(appId, mask);
        }
    }
    
    
    int main()
    {
        downloadApps();
    }

_Note_: this script can simply be transformed into an executable by commenting the shebang and compiling it with:

    clang -g -fmodules -framework Foundation -framework AppKit -o appicon appicon.m


### Function by function comparison

Let's compare the two versions.

The Python script entry point is the function `download_apps`: given a list of apps ids, it downloads an icon mask and then downloads, masks and resizes each app icons.

The Python source is:

    def download_apps():
        """
        """
        app_ids = [
            "400274934",  # Meon
            "598581396",  # Kingdom Rush Frontiers
            ]
        
        mask = download_icon_mask()
        
        [download_app_metadata(app_id, mask) for app_id in app_ids]

In Objective-C, this becomes:

    void downloadApps()
    {
        NSArray *appIds = @[
                        @"400274934",  // Meon
                        @"598581396",  // Kingdom Rush Frontiers
                        ];
    
        NSImage *mask = downloadIconMask();
    
        for(NSString *appId in appIds){
            downloadAppMetadata(appId, mask);
        }
    }

Appart from the variables's type in Objective-C, the two codes are very similar, and the Objective-C code remains readable (big thumb up for the [Objects literals][], [Fast enumeration][] and [ARC][]).

Let's take a more interesting snippet. In the Python script, `download_app_metadata` downloads one app's metadata in JSON, and call a method to compute and save the icons for this app.

In Python:

    def download_app_metadata(app_id, mask):
        """
        """
        print("download_app_json {}".format(app_id))
        
        url = "http://itunes.apple.com/us/lookup?id={}".format(app_id)
        r = requests.get(url)
        if r.status_code != 200:
            print('Error downloading {} {}'.format(url, r.status_code))
            return
        
        results = r.json()
        
        meta = results["results"][0]
        icon_url = meta["artworkUrl512"]
        title = slugify(meta["trackCensoredName"])
        
        download_icon(icon_url, title, mask)


In Objective-C:

    void downloadAppMetadata(NSString *appId, NSImage *mask)
    {
        NSLog(@"download_app_json %@\n", appId);
    
        NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"http://itunes.apple.com/us/lookup?id=%@", appId]];
        NSData *resultsData = [NSData dataWithContentsOfURL:url];
        if (!resultsData) {
            NSLog(@"Error downloading %@", url);
            return;
        }
    
        NSDictionary *results = [NSJSONSerialization JSONObjectWithData:resultsData options:0 error:nil];
    
        NSDictionary *meta = results[@"results"][0];
        NSString *iconURL = meta[@"artworkUrl512"];
        NSString *title = [meta[@"trackCensoredName"] slugString];
    
        downloadIcon(iconURL, title, mask);
    
    }

The Objective-C counterpart is still simple and easy to read. I've used `NSLog` to replace `printf` statement: in my mind, it deals better with Objective-C objects (if you were sneaky, you could argue that the code is readable because it isn't error proof...).  

To get the JSON metadata, I first use `+[NSData dataWithContentsOfURL:]`. This method has a lot of sister in NSString, NSImage etc... Given an NSURL, there is always a simple way to get an NSData, NSString etc.. from this URL (this method is available since ...OS X v10.0 - 2001!)

But, you must be aware that this method is __synchronous__: it will block the calling thread until the data has been downloaded (or an error occurred). This is _perfectly_ fine in a shell script, but you __must__ always avoid this category of selectors in OSX / iOS apps. By the way, the Python code is also synchronous: `r.get()` will block until the data has been downloaded.   

Finally, to convert the NSData from JSON to a dictionary, I used `JSONObjectWithData`, introduced in iOS 5 / OSX 10.7. You can say that `[NSJSONSerialization JSONObjectWithData:resultsData options:0 error:nil];` is more verbose than `r.json()` but verbosity is an Objective-C convention, for the better or the worst...

Now, let's look at the function to download the mask applied on each icon. In Python, I use [Requests][] to download the data, and [Pillow][] to create an Image object with this data.

    def download_icon_mask():
        """
        """
        # Download the mask from Github, this way we don't
        # have to provide mask.png and the script is self contained.
        mask_url = "https://raw.githubusercontent.com/manbolo/appicon/master/mask.png"
        mask_data = requests.get(mask_url)
        mask = Image.open(StringIO(mask_data.content))
        mask = mask.convert('L')
        return mask

In Objective-C, I only use Foundation APIs, and once again use a synchronous selector to get an NSImage from an URL:

    NSImage* downloadIconMask()
    {
        NSURL *maskURL = [NSURL URLWithString:@"https://raw.githubusercontent.com/manbolo/appicon/master/maskInverted.png"];
        NSImage *mask = [[NSImage alloc] initWithContentsOfURL:maskURL];
        return mask;
    }

The Objective-C code is still neat and simple. The mask used in the Objective-C is inverted because of the way I will apply it to icons with Quartz. Both masks are black and white, and I was too lazy to make the two scripts work with the same mask.

Finally, let's compare the masking, resizing and saving functions. The Python code is using a combination of [Requests][] and [Pillow][]:

    def download_icon(icon_url, title, mask):
        """
        """
        # Download icon an apply mask.
        icon_data = requests.get(icon_url)
        icon = Image.open(StringIO(icon_data.content))
        icon.putalpha(mask)
    
        # Compute and save thumbnails.
        for size in [1024, 512, 120, 114, 60, 57]:
            icon_resized = icon.resize((size, size), Image.ANTIALIAS)
            icon_resized.save("icon_{0}_{1}x{1}.png".format(title, size))

In Objective-C:
    
    void downloadIcon(NSString *iconURLString, NSString *title, NSImage *mask)
    {
        NSURL *iconURL = [NSURL URLWithString:iconURLString];
        NSImage *icon = [[NSImage alloc] initWithContentsOfURL:iconURL];
        NSImage *iconMasked = [icon maskUsingMaskImage:mask];
    
        for(NSNumber *size in @[@1024, @512, @120, @114, @60, @57]){
            NSInteger width = [size integerValue];
            NSImage *iconResized = [iconMasked resizeToWidth:width];
        
            NSData *data = [iconResized pngData];
            [data writeToFile:[NSString stringWithFormat:@"icon_%@_%ld_%ld.png", title, width, width] atomically:YES];
        }
    }

Once again, [Objects literals][] simplify the code; it may be only [syntactic sugar][] but I love this addition to the language and hope there will be others soon. The code remains simple and easy to read / write.

In this last function, you may have noticed that `-[UIIMage maskUsingMaskImage:]` and `-[UIImage resizeToWidth:]` are not part of the OSX APIs. If you look [at the source code of the Objective-C script][], you will see that I've used small categories on NSImage and NSString. In my mind, this is the equivalent of using a third-party library (Pillow) in the Python code. [objc-run][] is also compatible with CocoaPods, so another possibility could have been to use it.

### In Bash

Rely on [ImageMagick][] and [jq][]:

    #!/bin/bash
    set -eu 
    
    curl -s "https://raw.githubusercontent.com/manbolo/appicon/master/mask.png" >"icon_mask.png"
    
    for app_id in "$@"
    do
        metadata=$(curl -s "http://itunes.apple.com/us/lookup?id=$app_id")
        icon_url=$(echo $metadata | jq -r ".results[0].artworkUrl512")
        name=$(echo $metadata | jq -r ".results[0].trackCensoredName")
    
        icon_base="icon_$name"
        curl -s "$icon_url" >"$icon_base.png"
        convert "$icon_base.png" "icon_mask.png" -compose copy-opacity -composite "$icon_base.png"
    
        for size in 1024 512 120 114 60 57
        do
        convert "$icon_base.png" -resize "${size}x${size}" "${icon_base}_${size}x${size}.png"
        done
    done
    
    rm icon_mask.png

### In [Objective-Smalltalk][]

    #!/usr/bin/env stsh
    #-<void>processIconForApp:appId
    framework:AppKit load.
    framework:EGOS_Cocoa load.
    
    nonChars := NSCharacterSet letterCharacterSet invertedSet.
    str := '_'.
    [ :self  |
       ((self componentsSeparatedByCharactersInSet:nonChars) componentsJoinedByString:str) lowercaseString
    ] installInClass: NSString  withMethodHeaderString:'slugString'.
    
    mask := http://raw.githubusercontent.com/manbolo/appicon/master/maskInverted.png.
    appInfo := ref:http://itunes.apple.com/us/lookup  getWithArgs id: appId
    
    iconURL := var:appInfo/results/0/artworkUrl512.
    name := var:appInfo/results/0/trackCensoredName.
    icon := context evaluateScriptString: iconURL.
    
    #(1024 512 120 114 60 57 ) do:[ :width  |
      c := MPWCGBitmapContext rgbBitmapContext: width @ width.
      c scale: width / icon pixelsWide.
      c maskedBy:mask draw:[ :aContext | aContext drawImage:icon. ].
      scaled := c image.
      outname := name slugString ,'_', width stringValue, '_', width stringValue , '_.png'.
      file:{outname} := scaled representationUsingType:4 properties:nil.
    ].

### Recap

On the Python side:

- very simple, readable, easy to write and debug,
- your script will work on any platforms (Linux, OSX, Windows etc...),
- many many great third-party libraries,
- Python is wonderful

On the Objective-C side:

- you can reuse / improve your C / Objective-C code,
- the script can be easily transformed into an executable

To my pleasure, the Objective-C doesn't look too bad, and you can easily get content (text, image, binary) from any URL and work on it in a simple script. But, by limiting your Objective-C script to the OSX world, it really can't compete with a Python script in my mind. So, I will keep writing my scripts in Python! It has been a fun experiment anyway!

[Python source code][].

[Objective-C source code][].

[Bash source code](https://github.com/manbolo/appicon/blob/master/appicon.sh).

[Objective-Smalltalk source code](https://github.com/manbolo/appicon/blob/master/appicon.st).

From jc.

<hn>https://news.ycombinator.com/item?id=7827651</hn>

[Requests]: http://docs.python-requests.org/en/latest/
[Pillow]: http://python-imaging.github.io
[Beautiful Soup]: http://www.crummy.com/software/BeautifulSoup/ 
[Nicolas Bouilleaud's Objective-C Minimalism]: http://bou.io/ObjectiveC-Minimalism.html
[the new iOS 7 shape]: http://blog.manbolo.com/2013/08/15/new-metrics-for-ios-7-app-icons
[has a lookup web API]: http://blog.manbolo.com/2012/09/10/useful-itunes-web-services
[Tiny Wings]: https://itunes.apple.com/en/app/tiny-wings/id417817520?mt=8
[Kingdom Rush Frontiers]: https://itunes.apple.com/us/app/kingdom-rush-frontiers/id598581396?l=en&mt=8
[download the code here]: https://github.com/manbolo/appicon/blob/master/appicon.py
[Python source code]: https://github.com/manbolo/appicon/blob/master/appicon.py
[objc-run]: https://github.com/iljaiwas/objc-run
[python-slugify]: https://github.com/un33k/python-slugify
[Objects literals]: http://clang.llvm.org/docs/ObjectiveCLiterals.html
[Fast enumeration]: http://www.cocoawithlove.com/2008/05/fast-enumeration-clarifications.html
[CocoaPods]: http://cocoapods.org
[Python script written is Objective-C]: https://github.com/manbolo/appicon/blob/master/appicon.m
[at the source code of the Objective-C script]: https://github.com/manbolo/appicon/blob/master/appicon.m
[Objective-C source code]: https://github.com/manbolo/appicon/blob/master/appicon.m
[syntactic sugar]: http://en.wikipedia.org/wiki/Syntactic_sugar
[iTunes Lookup API]: https://www.apple.com/itunes/affiliates/resources/documentation/itunes-store-web-service-search-api.html
[ARC]: http://en.wikipedia.org/wiki/Automatic_Reference_Counting
[ImageMagick]: http://www.imagemagick.org
[jq]: http://stedolan.github.io/jq/
[Objective-Smalltalk]: http://objective.st