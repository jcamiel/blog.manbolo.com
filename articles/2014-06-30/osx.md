## Apple on Hamburger Menus

<hn>https://news.ycombinator.com/item?id=7967635</hn>

[Mike Stern][], Apple User Experience Evangelist in [Designing Intuitive User Experiences - 211][] WWDC 2014 session (at 31' 57"):

> <img src="http://blog.manbolo.com/2014/06/30/slide0.png" width="500" height="312">
>
> But I feel like  I would be remiss If I didn't use this opportunity __to talk 
> with you about hamburger menus__. AKA Slide out menus, AKA sidebars, AKA 
> basements, AKA drawers. 
>
> Now, these controls are very common on iOS, and on other platforms. And I'm
> sure many of you here work on apps that have these. You guys made the decision
> to put it in your app. And I'm sure that you did so with the very best of
> intentions. And I will say that these controls do a couple of things very 
> well.
>   
>   
> <img src="http://blog.manbolo.com/2014/06/30/slide1.png" width="500" height="312">
>
> For one thing, they save space. So rather than taking up a bunch of room at
> the bottom of the screen for a tab, you're just taking up a little bit of area 
> in the top left corner for the hamburger menu. 
>   
>   
> <img src="http://blog.manbolo.com/2014/06/30/slide2.png" width="500" height="312">
>
> And you practically have the 
> entire height of the screen to show options to people, and if that's not 
> enough, __you're going to cram more awesomeness into your app__, people can 
> scroll, right.
>       
>       
> <img src="http://blog.manbolo.com/2014/06/30/slide3.png" width="500" height="312">
>
> But, this is - I actually haven't played around with the latest version of 
> Xcode, so I really hope that they haven't changed this - I don't believe you'll
> find a hamburger menu controller inside of Xcode.
>
> Now, typically we don't provide design advice about the things that we don't
> offer to you guys, but I can't help myself, right? I've so many conversations
> with people about this control, spending hours and hours talking about it, and
> you know, I think it's important that we talk about it here today. 
>
> And again, I'm not going to say that there's no place for these controls 
> categorically. I think there are some apps that could maybe use one. But I 
> will say that __their value is greatly over-stated, and they have huge usabiliy 
> downsides too.__
>      
>      
> <img src="http://blog.manbolo.com/2014/06/30/slide4.png" width="500" height="312">
> 
> Remember, the three key things about an intuitive navigation system is that 
> they tell you where you are, and they show you where else you can go. 
> __Hamburger menus are terrible at both of those things, because the menu is not
> on the screen. It's not visible.__ Only the button to display the menu is. 
>
> And in practice, talking to developers, they found this out themselves. 
> __That people who use their app don't switch to different sections very 
> frequently when they use this menu.__ And the reason for that is because the 
> people who use their app don't know where else they can go. Right? They don't
> know because they can't see the options, or maybe they saw it at one point in
> time, but they have since forgotten.
>
> And if you use this control, you have to recognize that __the people who use your
> app may not realize the full potential of your app__.
> 
> Hamburger menus are also just tedious, right? If you want to switch sections
> from the Accounts tab to the Transfers tab, all you need to do is tap the 
> button and you're there instantly, and if you want to go back, you tap the 
> account button, and you're back where you started from.
>       
>      
> <img src="http://blog.manbolo.com/2014/06/30/slide5.png" width="500" height="312">
>
> Doing the same thing with the hamburger menu involves opening the menu, 
> waiting for the animation to finish, re-orienting yourself, finding the option
> you're interested in, tapping that, and then waiting for the animation to
> complete, getting back to where you were before, and if you want to go back, 
> you have to open the menu again, go through that whole process, and there you
> are, again.
> 
> __It takes at least twice as many taps to change sections. Something that should
> be very easy and fluid is made more difficult__. 
>    
>    
> <img src="http://blog.manbolo.com/2014/06/30/slide6.png" width="500" height="312">
> 
> And __the other thing the hamburger menus quite frankly do badly is that they 
> don't play nicely with back buttons.__ Right? I've seen this a lot. Back buttons
> are supposed to go in that top left corner position, but instead there's this
> hamburger menu there, so people put the back button right next to it, but no
> longer does this look like a back button anymore, it just looks like this
> arrow which is pointing to the hamburger menu, looks ridiculous, and sometimes
> people recognize that it looks ridiculous so when you drill down into the
> hirerarchy of an app, the hamburger menu goes away. __Now it takes even more 
> steps to switch to a different section.__ You have to go back up enough times
> to get to a level in the hierarchy of an app to get to a view that contains 
> the hamburger menu.
> 
> Now, sometimes people will try to solve this by putting the menu on the
> right-hand side, but that's not advisable either. That location is a really
> important location. Usually, you can put some kind of action there, you know, 
> like a plus sign to add something, or an edit button.
>     
>     
> <img src="http://blog.manbolo.com/2014/06/30/slide7.png" width="500" height="312">
>
> And finally, the downside of being able to show a lot of options is __that you
> can show a lot of options. Is that you will show a lot of options. The
> potential for bloat and misuse is tremendous__. They allow you to add all sort
> of stuff that your users don't really care about. Like information about the
> app. Or version history, or credits. I hate to break it to you, but no one 
> cares.
>    
>    
> <img src="http://blog.manbolo.com/2014/06/30/slide8.png" width="500" height="312">
> 
> And the other thing is that people wind up taking ads and special offers and
> making them look just like regular sections and putting it in there too. That 
> sucks. No one wants that either. __Look, drawers of any kind have a nasty 
> tendency to fill with junk.__
>
> Okay, let's move on. [ Applause ]

Apple could not be clearer: don't use hamburgers menus on iOS.

From jc.

[Mike Stern]: https://twitter.com/themikestern
[Designing Intuitive User Experiences - 211]: http://devstreaming.apple.com/videos/wwdc/2014/211xxmyz80g30i9/211/211_hd_designing_intuitive_user_experiences.mov?dl=1