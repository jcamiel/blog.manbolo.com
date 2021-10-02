## MVVM Pattern on iOS by Colin Wheeler

Mind blowing article from [Colin Wheeler][] on [Model-View-ViewModel (MVVM) design pattern][]:

> In the MVVM pattern the View Model encapsulates data/properties that the view
> can bind to, any validation logic and actions that can be performed. For
> Instance if you had a button that needs to change its title text you would
> have a property on the view model that the button can bind its title property
> to. The same goes if you need to change the color of a control or enable and
> disable the control. In this pattern we are essentially taking the state of
> our app and putting it into a view model. Its also good to note that as far as
> the View Model is concerned it doesn't care where it gets this state from. It
> doesn't matter if it gets it from its init method, a file on disk, Core Data,
> a database, etc.

Borrowed from the .Net world, I find this pattern very interesting. It's kind of having a View Controller that is independent from the model, just tied to a View  Model entity. With this pattern, the view seems more independent and swappable. You can develop your interface in an isolated way, provided you have defined your View Model. I'll try to dig around this pattern and see how it can be transferred in the iOS world, comparing it with [our venerable and beloved MVC][].
 
And it's the first article I've read that presents [ReactiveCocoa][] in a simple way. Combined with MVVM, it can be really powerfull while simplifying your code.

From jc.

[Model-View-ViewModel (MVVM) design pattern]: http://cocoasamurai.blogspot.fr/2013/03/basic-mvvm-with-reactivecocoa.html?m=1
[Colin Wheeler]: http://www.blogger.com/profile/16010768305821496589
[ReactiveCocoa]: https://github.com/blog/1107-reactivecocoa-for-a-better-world
[our venerable and beloved MVC]: http://developer.apple.com/library/ios/#documentation/Cocoa/Conceptual/CocoaFundamentals/CocoaDesignPatterns/CocoaDesignPatterns.html