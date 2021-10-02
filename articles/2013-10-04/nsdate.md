## NSDateFormatter and Internet Dates

If you want to send or receive dates and times in your iOS app, you will need to insure that you're parsing or creating the right format string. Let's take an example: assume we're creating some `NSDate` object and we need to send a JSON representation of this `NSDate` to some web service. In this example, we want to format the date with the [RFC 3339-style][], a common format used by many Internet protocol.

A first naive approach looks like:

	- (NSString *)dateString
	{
		// Create our date formatter.
		NSDateFormatter *dateFormatter = [[NSDateFormatter alloc] init];
		[dateFormatter setDateFormat:@"yyyy'-'MM'-'dd'T'HH':'mm':'ssZ"];
	
		// We will upload the date at UTC 0.
    	dateFormatter.timeZone = [NSTimeZone timeZoneForSecondsFromGMT:0];
    
	    // Format our date object to a suitable string.
    	NSDate *date = [[NSDate alloc] init];
	    NSString *dateString = [dateFormatter stringFromDate:now];
 
 		return dateString;
	}

For instance, if we call this method in France (GMT+2), at 2:02 PM the 3 October 2013, `dateString` will be `2013-10-03T12:01:07+0000`. As you can see, one central class in Cocoa for dates and times handling is [NSDateFormatter][]. `NSDateFormater` will be your companion when going to/from `NSDate` and `NSString`; given `NSDateFormater` the right format string (in case of [RFC 3339-style][], you can use `@"yyyy'-'MM'-'dd'T'HH':'mm':'ssZ"`), and you're good.

Or not... In fact, this innocuous sample code has some issues.

First of all, there may be a performance problem. `NSDateFormater` can be expensive to create each time you need to format a string. A better approach would be to create an ivar and cache it in order to reuse it each time we need it.

	- (NSDateFormatter *)dateFormatter
	{
		if (_dateFormatter){
			return _dateFormatter;
		}
		_dateFormatter = [[NSDateFormatter alloc] init];
		[_dateFormatter setDateFormat:@"yyyy'-'MM'-'dd'T'HH':'mm':'ssZ"];
	    [_dateFormatter setTimeZone:[NSTimeZone timeZoneForSecondsFromGMT:0]];

	    return _dateFormatter;
	}
	
	- (NSString *)dateString
	{
		NSDateFormater *dateFormatter = [self dateFormatter];
		NSDate *date = [[NSDate alloc] init];
	    NSString *dateString = [dateFormatter stringFromDate:date];
		
		return dateString;
	}
	
But there are still some issues. On his iPhone, the user can have chosen a different calendar (Settings > General > International > Calendar), for instance [the Buddhist one][]. Running the example, `dateString` will return `2556-10-03T12:20:20+0000` simply because in the Buddhist calendar we are in 2556! 

You can force your date formatter to use the Gregorian calendar simply by setting the `calendar` property like this:

	_dateFormatter.calendar = [[NSCalendar alloc] initWithCalendarIdentifier:NSGregorianCalendar];
	
And no matter what calendar the user has chosen, your `NSDateFormatter` will always return the Gregorian year. 

But there is still an issue with this code! On iOS, the user can override the default AM/PM versus 24-hour time setting (via Settings > General > Date & Time > 24-Hour Time), and cause your formatting to failed. Arrgghhhh...

The real solution to this problem is addressed by Apple in the [Technical Q&A QA1480 NSDateFormatter and Internet Dates][]. To format a date to a fixed format regardless of both user and system preferences, you should use an particular local `en_US_POSIX` that is designed to be independent and fixed between machine. Using `en_US_POSIX`, you even don't need to specify to use the Gregorian calendar.

Now our fixed example is:

	- (NSDateFormatter *)dateFormatter
	{
		if (_dateFormatter){
			return _dateFormatter;
		}
		_dateFormatter = [[NSDateFormatter alloc] init];
		
		NSLocale *enUSPOSIXLocale = [[NSLocale alloc] initWithLocaleIdentifier:@"en_US_POSIX"];

		[_dateFormatter setDateFormat:@"yyyy'-'MM'-'dd'T'HH':'mm':'ssZ"];
	    [_dateFormatter setTimeZone:[NSTimeZone timeZoneForSecondsFromGMT:0]];
	    [_dateFormatter setLocale:enUSPOSIXLocale];
	    
	    return _dateFormatter;
	}
	
	- (NSString *)dateString
	{
		NSDateFormatter *dateFormatter = [self dateFormatter];
		NSDate *date = [[NSDate alloc] init];
	    NSString *dateString = [dateFormatter stringFromDate:date];
		
		return dateString;
	}
	
Who said handling dates was easy?

If you need more information about how to deal with dates on Cocoa, be sure to read [Ole Begemann's][] epic serie on Working with Date and Time in Cocoa:

- [Working with Date and Time in Cocoa (Part 1)][]
- [Working with Date and Time in Cocoa (Part 2)][]
- [Date and Time Handling in Cocoa Cheat Sheet][]
- [Tutorial: How to Sort and Group UITableView by Date][]

You can also check the [Data Formatting Guide][] on Apple Developer Library to get some additional informations on formatting datas.
  
From jc.

[RFC 3339-style]: http://www.ietf.org/rfc/rfc3339.txt
[Technical Q&A QA1480 NSDateFormatter and Internet Dates]: https://developer.apple.com/library/ios/qa/qa1480/_index.html
[Working with Date and Time in Cocoa (Part 1)]: http://oleb.net/blog/2011/11/working-with-date-and-time-in-cocoa-part-1/
[Working with Date and Time in Cocoa (Part 2)]: http://oleb.net/blog/2011/11/working-with-date-and-time-in-cocoa-part-2/
[Date and Time Handling in Cocoa Cheat Sheet]: http://oleb.net/blog/2011/11/date-and-time-in-cocoa-cheat-sheet/
[Tutorial: How to Sort and Group UITableView by Date]: http://oleb.net/blog/2011/12/tutorial-how-to-sort-and-group-uitableview-by-date/
[Ole Begemann's]: http://twitter.com/olebegemann
[the Buddhist one]: http://en.wikipedia.org/wiki/Buddhist_calendar
[NSDateFormatter]: https://developer.apple.com/library/mac/documentation/Cocoa/Reference/Foundation/Classes/NSDateFormatter_Class/Reference/Reference.html
[Data Formatting Guide]: https://developer.apple.com/library/mac/documentation/Cocoa/Conceptual/DataFormatting/DataFormatting.html#//apple_ref/doc/uid/10000029i


