## Using IB, or not Using IB

From [Brent Simmons][] in [How Much, or How Little, I Use Interface Builder These Days][]:

> Eschewing IB does mean writing code to create and configure your views. And
> that is, no doubt about it, more code.
>
> But I look at it this way: it’s fewer entities. For each line of code there
> would have been a corresponding thing in IB.
>
> And fixing a thing in code is simpler than fixing it in IB — because as
> programmers we’re optimized for code-writing.
>
> Want to fix a color or change the position of a view? I like doing it the
> way I solve every other problem: I code it.

Convinced by fellows developers ([Hello Toulouse][]), I basically use less and less Interface Builder. If I've to code a very static screen, I will use Interface Builder; in all others use cases, I will do everything in code. 

Pros of coding vs Interface Builder:

- diff code is easy, whereas diff XIBs is practically impossible,
- search code is easier
- I find refactoring much much easier (put views in a container view etc...)
- reusing component and factoring is much more simple
- change in code are easier and quicker to do (especially if you have a lot of shared code)

By the way, Brent does also a very good podcast with Michael Simmons: [Identical Cousins][].

From jc.

[How Much, or How Little, I Use Interface Builder These Days]: http://inessential.com/2013/03/06/how_much_or_how_little_i_use_interface
[Hello Toulouse]: http://en.wikipedia.org/wiki/Toulouse_%E2%80%93_Blagnac_Airport
[Brent Simmons]: https://twitter.com/brentsimmons
[Identical Cousins]: http://identicalcousins.net/