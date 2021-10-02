## Of Splash Screens and iOS Apps

> If you think that following these guidelines will result in a plain, boring 
> launch image, you’re right. Remember, the launch image is not meant to provide
> an opportunity for artistic expression; it is solely intended to enhance the
> user’s perception of your app as quick to launch and immediately ready for
> use. The following examples show you how plain a launch image can be.

<p style="text-align:right;"><a href="http://developer.apple.com/library/ios/#documentation/UserExperience/Conceptual/MobileHIG/Introduction/Introduction.html">Apple iOS Human Interface Guidelines</a></p>

When you're developing an app on a platform, one of the most important rule is [to respect the UI conventions of the platform](http://blog.manbolo.com/2011/12/23/respect-the-platform). For example, on iPad, an app is expected to run in all orientations (with the exception of some games); on iPhone/iPad, a Star icon is associated to 'Favorite' and a plus icon is associated to an 'Add' action. 

That's why I'm sad each time I see a splash screen in an iOS app. Because, on iOS, _none app should have a splash screen_. 

Apple recommends in the [iOS Human Interface Guidelines](http://developer.apple.com/library/ios/#documentation/UserExperience/Conceptual/MobileHIG/Introduction/Introduction.html) to provide a __placeholder UI__ that will be replaced by the real UI as soon as the app is ready. The idea is to give user the impression to __start instantly__:   

> __Display a launch image that closely resembles the first screen of the 
> application__. This practice decreases the perceived launch time of your 
> application.
>
> __Avoid displaying an About window or a splash screen__. In general, try to 
> avoid providing any type of startup experience that prevents people from using
> your application immediately.

If you look at Apple apps, you can see the difference between the splash screen of the app (on the left) and the first screen of the app:

<a href="http://blog.manbolo.com/2012/06/27/calculator_s.png"><img class="left" src="calculator_s-298.png" alt="Calculator app splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/calculator.png"><img class="right" src="calculator-298.png" alt="Calculator app screen"/></a>
<small class="clear">Caculator</small>

<a href="http://blog.manbolo.com/2012/06/27/clock_s.png"><img class="left" src="clock_s-298.png" alt="Clock app splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/clock.png"><img class="right" src="clock-298.png" alt="Clock app screen"/></a>
<small class="clear">Clock</small>

<a href="http://blog.manbolo.com/2012/06/27/gamecenter_s.png"><img class="left" src="gamecenter_s-298.png" alt="Game Center app splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/gamecenter.png"><img class="right" src="gamecenter-298.png" alt="Game Center app screen"/></a>
<small class="clear">Game Center</small>

<a href="http://blog.manbolo.com/2012/06/27/reminder_s.png"><img class="left" src="reminder_s-298.png" alt="Reminder splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/reminder.png"><img class="right" src="reminder-298.png" alt="Reminder app screen"/></a>
<small class="clear">Reminder</small>

<a href="http://blog.manbolo.com/2012/06/27/cal_s.png"><img class="left" src="cal_s-298.png" alt="Calendar splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/cal.png"><img class="right" src="cal-298.png" alt="Calendar app screen"/></a>
<small class="clear">Calendar</small>

<a href="http://blog.manbolo.com/2012/06/27/compass_s.png"><img class="left" src="compass_s-298.png" alt="Compass splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/compass.png"><img class="right" src="compass-298.png" alt="Compass app screen"/></a>
<small class="clear">Compass</small>

<a href="http://blog.manbolo.com/2012/06/27/garageband_s.png"><img class="left" src="garageband_s-298.png" alt="Garageband splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/garageband.png"><img class="right" src="garageband-298.png" alt="Garageband app screen"/></a>
<small class="clear">Garageband</small>

<a href="http://blog.manbolo.com/2012/06/27/iphoto_s.png"><img class="left" src="iphoto_s-298.png" alt="iPhoto splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/iphoto.png"><img class="right" src="iphoto-298.png" alt="iPhoto app screen"/></a>
<small class="clear">iPhoto</small>

<a href="http://blog.manbolo.com/2012/06/27/recorder_s.png"><img class="left" src="recorder_s-298.png" alt="Recorder splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/recorder.png"><img class="right" src="recorder-298.png" alt="Recorder app screen"/></a>
<small class="clear">Recorder</small>

<a href="http://blog.manbolo.com/2012/06/27/stock_s.png"><img class="left" src="stock_s-298.png" alt="Stock splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/stock.png"><img class="right" src="stock-298.png" alt="Stock app screen"/></a>
<small class="clear">Stock</small>

And some from third parties apps:

<a href="http://blog.manbolo.com/2012/06/27/twitter_s.png"><img class="left" src="twitter_s-298.png" alt="Twitter splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/twitter.png"><img class="right" src="twitter-298.png" alt="Twitter app screen"/></a>
<small class="clear">Twitter</small>

<a href="http://blog.manbolo.com/2012/06/27/chomp_s.png"><img class="left" src="chomp_s-298.png" alt="Chomp splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/chomp.png"><img class="right" src="chomp-298.png" alt="Chomp app screen"/></a>
<small class="clear">Chomp</small>

<a href="http://blog.manbolo.com/2012/06/27/calcbot_s.png"><img class="left" src="calcbot_s-298.png" alt="CalcBot splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/calcbot.png"><img class="right" src="calcbot-298.png" alt="CalcBot app screen"/></a>
<small class="clear">CalcBot</small>

<a href="http://blog.manbolo.com/2012/06/27/5by5_s.png"><img class="left" src="5by5_s-298.png" alt="5by5 splash screen"/></a>
<a href="http://blog.manbolo.com/2012/06/27/5by5.png"><img class="right" src="5by5-298.png" alt="5by5 app screen"/></a>
<small class="clear">5by5</small>

As you can see, the idea is really to create the splash screen as if the first page of the app doesn't have any content. You should also hide all the labels. You (or you marketing guy) may think that your branding is less strong. You can be even ask to add a real splash screen and delay it to N seconds so the user can really see your beautiful artwork. Please, defend yourself and argue that people spends no more than a minute or two evaluating a new app, and you have to make the most of this brief period by presenting useful content immediately.

Apple advices for creating a splash screen (or __Launch Images__ as Apple refers to it) are: 

> To enhance the user’s experience at application launch, you must provide at
> least one launch image. A launch image looks very similar to the first screen
> your application displays. iOS displays this image instantly when the user
> starts your application and until the app is fully ready to use. As soon as
> your app is ready for use, your app displays its first screen, replacing the
> launch placeholder image.    
> Supply a launch image to improve user experience.
> Avoid using your launch image as an opportunity to provide:
>
> - An “application entry experience,” such as a splash screen
> - An About window
> - Branding elements, unless they are a static part of your application’s first
> screen
>
> Because users are likely to switch among applications frequently, you should
> make every effort to cut launch time to a minimum, and you should design a
> launch image that downplays the experience rather than drawing attention to
> it.

### Games are Games

All the previous talk is perfect for “classic” apps but games are particular kind of apps. Because you want your game to be engaging and immersive, you will want to have a splash screen, with a super movie etc.. That's say, I still believe that these guidelines on splash screens still apply here: the quicker you can play, the better it is.  

From jc.