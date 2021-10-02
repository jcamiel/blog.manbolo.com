## ASIHTTPRequest is Dead. Long Live MKNetworkKit

One of the joy of iOS programming is the really huge number of Open Source frameworks ready to integrate in your code. From UI, animations, to network, signal processing etc, you will find a lot of free source code to fit your need or to reproduce [the last impressive iPhone app](http://itunes.apple.com/us/app/path/id403639508?mt=8).

Among the most famous frameworks, [ASIHTTPRequest](http://allseeing-i.com/ASIHTTPRequest/) is certainly one of the most used. For instance, it's the second most popular Objective-C project on github, by both watchers and forks.
ASIHTTPRequest, developed by Ben Copsey, is an easy, powerful framework for performing basics and advanced HTTP requests, or dealing with REST-based services, Amazon S3, Rackspace etc..
Unfortunately, Ben announced he will discontinue the development and support of the framework, in a [post titled \[request release\](!)](http://allseeing-i.com/[request_release];).

Ben suggested a lot of replacements (like [AFNetworking](https://github.com/gowalla/AFNetworking), [RestKit](http://restkit.org/) or [LRResty](http://projects.lukeredpath.co.uk/resty/)) but I think one of the potential winner can be [MKNetworkKit](http://blog.mugunthkumar.com/products/ios-framework-introducing-mknetworkkit) by [Mugunth Kumar](http://blog.mugunthkumar.com/). Mugunth releases high quality open source code for iOS/MacOS and proposes this new framework as an inheritor of ASIHTTPRequest. MKNetworkKit is `ARC` ready, block based, easy and seems to be super efficient. We're already using one of Mugunth's kit,  [MKStoreKit](http://blog.mugunthkumar.com/coding/using-mkstorekit-in-your-apps/), to manage In App Purchases in Meon and the integration was really simple and straightforward. For network stuff, we mainly use basic [NSURLRequest and NSURLConnection](http://developer.apple.com/library/mac/#documentation/Cocoa/Conceptual/URLLoadingSystem/Tasks/UsingNSURLConnection.html), but MKNetworkKit seems very interesting and worth a serious look.

From jc.


