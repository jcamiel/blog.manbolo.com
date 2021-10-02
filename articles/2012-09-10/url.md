## Useful iTunes Web Services

Here is some public useful URLs from Apple to get contents (apps metadata, top apps from App Store, reviews). It's important to note that these APIs are now public and you don't need to web scrap the App Store to get contents, you can get it _legally_.

### iTunes Search apis

You will find [iTunes Search documentation here](http://www.apple.com/itunes/affiliates/resources/documentation/itunes-store-web-service-search-api.html).

The lookup API is really useful: given an app id, you will get the description, URL of app icons, screenshots, price, average rating, user rating count etc... 

Ex: Meon app id is `400274934`, so the lookup api will simply be <code>http://itunes.apple.com/lookup?<b>id=400274934</b></code>.

[The response](http://itunes.apple.com/lookup?id=400274934) is a JSON like this:

	{
	  "resultCount": 1, 
	  "results": [
		{
		  "artistId": 400274944, 
		  "artistName": "Manbolo", 
		  "artistViewUrl": "http://itunes.apple.com/us/artist/manbolo/id400274944?uo=4", 
		  "artworkUrl100": "http://a2.mzstatic.com/us/r1000/099/Purple/c0/49/e9/mzl.cqlmizvx.png", 
		  "artworkUrl512": "http://a2.mzstatic.com/us/r1000/099/Purple/c0/49/e9/mzl.cqlmizvx.png", 
		  "artworkUrl60": "http://a1.mzstatic.com/us/r1000/120/Purple/5a/c0/83/mzi.ppwwqrbf.png", 
		  "averageUserRating": 4.5, 
		  "averageUserRatingForCurrentVersion": 4.5, 
		  "bundleId": "com.manbolo.meon", 
		  "contentAdvisoryRating": "4+", 
		  "currency": "USD", 
		  "description": "Meon has been updated with...", 
		  "features": [
			"gameCenter"
		  ], 
		  "fileSizeBytes": "18572195", 
		  "formattedPrice": "$0.99", 
		  "genreIds": [
			"6014", 
			"7012", 
			"7009"
		  ], 
		  "genres": [
			"Games", 
			"Puzzle", 
			"Family"
		  ], 
		  "ipadScreenshotUrls": [], 
		  "isGameCenterEnabled": true, 
		  "kind": "software", 
		  "languageCodesISO2A": [
			"EN"
		  ], 
		  "price": 0.99, 
		  "primaryGenreId": 6014, 
		  "primaryGenreName": "Games", 
		  "releaseDate": "2010-11-04T03:13:35Z", 
		  "releaseNotes": "- Graphics updated for Retina Display!!\nMeons have never been so cute!", 
		  "screenshotUrls": [
			"http://a1.mzstatic.com/us/r1000/111/Purple/v4/e7/5f/71/e75f7112-2b68-fe35-54a2-7776de95bbc1/mza_4394313885464462105.png", 
			"http://a4.mzstatic.com/us/r1000/078/Purple/v4/11/2a/1c/112a1cdf-4bb4-fd7f-5030-13b5ad263b1b/mza_1866995569532933693.png", 
			"http://a2.mzstatic.com/us/r1000/062/Purple/v4/49/61/24/496124f5-12b7-d6c8-d66b-c8d1562ff50c/mza_8696811386359167051.png", 
			"http://a4.mzstatic.com/us/r1000/117/Purple/v4/ab/a7/31/aba731aa-e716-177a-466b-ff5d15931ef8/mza_7653833262248727786.png", 
			"http://a4.mzstatic.com/us/r1000/070/Purple/v4/a0/d4/13/a0d413fa-80c9-f2d6-4b2b-332f1b4b3a37/mza_9082699032422523757.png"
		  ], 
		  "sellerName": "Manbolo SARL", 
		  "sellerUrl": "http://www.manbolo.com/meon/", 
		  "supportedDevices": [
			"all"
		  ], 
		  "trackCensoredName": "Meon", 
		  "trackContentRating": "4+", 
		  "trackId": 400274934, 
		  "trackName": "Meon", 
		  "trackViewUrl": "http://itunes.apple.com/us/app/meon/id400274934?mt=8&uo=4", 
		  "userRatingCount": 614, 
		  "userRatingCountForCurrentVersion": 556, 
		  "version": "1.3", 
		  "wrapperType": "software"
		}
	  ]
	}
	
If you want to get datas from a particular country (for instance, to have the price in a country currency), you can add a two word country code for the store you want to search (see <http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2> for the complete list).

For instance, <code>http://itunes.apple.com/<b>fr</b>/lookup?id=400274934</code> will return the datas from the french App Store.

You can also get results for more than one app: for instance <http://itunes.apple.com/us/lookup?id=361304891,361309726,377298193> will aggregate and return results for [Numbers](https://itunes.apple.com/en/app/numbers/id361304891?mt=8), [Pages](https://itunes.apple.com/en/app/pages/id361309726?mt=8) and [iMovie](https://itunes.apple.com/us/app/imovie/id377298193?mt=8).

iTunes Search API can be used when you want to get sporadic infos on a particular app. Apple gives you also a much more powerful tool: a direct access to the entire App Store metadata database, called [Enterprise Partner Feed](http://www.apple.com/itunes/affiliates/resources/documentation/enterprise-partner-feed-flat.html), or simply EPF. EPF provides a daily access to the iTunes content entire database (apps, movies song) and you can use this tool to build your killer app: it's much more powerful than iTunes Search API but need more work.

### iTunes RSS Feeds

There are RSS feeds to get access to the top free and paid iPhone and iPad applications, in every countries. You can request the genre (game, utilities, weather...), the number of item (10,20,50, 300...).

Ex: <http://itunes.apple.com/us/rss/toppaidapplications/limit=300/genre=6014/xml> is the adress of the current 300 top paid games. The feed format can also be in JSON, just type  <http://itunes.apple.com/us/rss/toppaidapplications/limit=300/genre=6014/json>

You can construct the feed with the [iTunes Store RSS Generator](http://itunes.apple.com/rss).

### App Reviews 

You can now have access to your app review, as an RSS feed or in JSON.

Given an app id, the URLs are
 
- In JSON:    

		http://itunes.apple.com/rss/customerreviews/id=400274934/json

- In XML:    

		http://itunes.apple.com/rss/customerreviews/id=400274934/xml
	
To get users reviews in a particular country, just add the 2 identifier country in the URL:		
<code>http://itunes.apple.com/<b>fr</b>/rss/customerreviews/id=400274934/json</code>

Finally, there is a good WWDC 2012 presentation about all these web services, called [Tools, Services, and APIs for iTunes Affiliate Program Marketing](http://adcdownload.apple.com/wwdc_2012/wwdc_2012_session_pdfs/session_603__tools_services_and_apis_for_itunes_affiliate_program_marketing.pdf)
(you will need a developer account to access it).

From jc.


