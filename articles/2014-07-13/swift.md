## Official Apple Swift Blog

Another proof that Apple is changing, [this dedicated blog on Swift][]. [Swift is in flux][], and there are some important changes to the syntax before the official 1.0, so bookmark this official feed.

Already good advises [in the second article on compatibility][]:

> This means that frameworks need to be managed carefully. For instance, 
> if your project uses frameworks to share code with an embedded extension, 
> you will want to build the frameworks, app, and extensions together. 
> It would be dangerous to rely upon binary frameworks that use
> Swift — especially from third parties. As Swift changes, those frameworks
> will be incompatible with the rest of your app. When the binary interface
> stabilizes in a year or two, the Swift runtime will become part of the host
> OS and this limitation will no longer exist.

Beware of this issue: while the binary interface is not frozen, all components of your app (especially Swift framework that you don't have the source code) should be built with the same version of Xcode and the Swift compiler to ensure that they work together.

From jc.

[this dedicated blog on Swift]: https://developer.apple.com/swift/blog/
[Swift is in flux]: https://github.com/ksm/SwiftInFlux
[in the second article on compatibility]: https://developer.apple.com/swift/blog/?id=2