## Hash and Salt

Matt Gemmell [vulgarizing hashing private data](http://mattgemmell.com/2012/02/11/hashing-for-privacy-in-social-apps/) after the Path fiasco: 

> If you’re a developer who’s implementing a social network, please do these things:
>
> 1. Educate yourself about hashing; it’s real, and very useful. Use hashing for personal info. Do the hashing client-side, and only upload hashed data for comparison on the server.
> 2. Delete the hashed data after you’ve done your fancy friend-matching stuff, because your users value their privacy, and you probably don’t even need to keep the data anyway.

Matt Gemmell addresses this problem in a simple and elegant way (as usual).

From jc.
