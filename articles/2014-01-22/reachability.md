## Reachability Sample Broken on 64-bit Architecture

Here is what I'm waiting for iOS 8:

![Snow Leopard 0 new feature][]

<small>Courtesy of [John Siracusa][]</small>

There are a lot of [little annoyances in iOS 7 that should be fixed][]. I dream of a [Snow Leopard 0 new features release][] for iOS 8 with a lot of bug fixes. This time, [@\_wolfover\_](https://twitter.com/_wolfover_) has found a rather serious bug in the [Apple Reachability Sample][].


If you download the reachability sample, and launch it on an iPhone 5s, with an active cellular connection, you will see this result:

<img class="bordered" src="/2014/01/22/reach.png" alt="Reachability sample" width="320" height="360">

Everything looks OK, the cellular connection is well recognized.

Now, if you modify the sample build settings to take advantage of 64-bit architectures
 (Target > Build Settings > Architectures) from __"Standard Architectures (armv7, armv7s)"__ to __"Standard Architectures (including 64-bit) (armv7, armv7s, armv64)"__
 
<img class="bordered" src="/2014/01/22/buildsettings.png" alt="Build settings" width="663" height="204">

and run the sample, you should see this:

<img class="bordered" src="/2014/01/22/reach_arm64.png" alt="Reachability sample 64-bit" width="320" height="360">

Reachability thinks that _there is no active cellular connection_! I think it's a serious bug, I've certainly missed something but just recompiling Reachability for 64-bit shouldn't produce a different result. I hope I'm wrong, but in the meantime I've filled a bug report ([rdar://15880397][]) and you should too!

From jc.

[John Siracusa]: http://arstechnica.com/apple/2009/08/mac-os-x-10-6/
[Snow Leopard 0 new features release]: http://arstechnica.com/apple/2009/08/mac-os-x-10-6/
[Snow Leopard 0 new feature]: snow-leopard-0-new-features.jpg
[rdar://15880397]: http://openradar.appspot.com/15880397
[little annoyances in iOS 7 that should be fixed]: http://petersteinberger.com/blog/2014/fixing-what-apple-doesnt/
[Apple Reachability Sample]: https://developer.apple.com/library/ios/samplecode/Reachability/Introduction/Intro.html#//apple_ref/doc/uid/DTS40007324