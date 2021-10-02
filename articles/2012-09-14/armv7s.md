## Xcode 4.5 and Missing armv7s Architecture in Static Libraries

[Matt Galloway](http://www.galloway.me.uk) in [Hacking up an armv7s library](http://www.galloway.me.uk/2012/09/hacking-up-an-armv7s-library/) shows how to update any static library to include an `armv7s` architecture. You will need this if you're using Xcode 4.5 and include a static library in your code that doesn't have an `armv7s` architecture.

Clever, it works because `armv7s`, introduced with the iPhone 5 and A6 chip, is a small superset of `armv7`. The `armv7s` binary is _basically_ a copy of the `armv7` binary. It seems to work well but if you can, the best thing is probably to wait that the static library is updated for `armv7s`.
  
From jc.