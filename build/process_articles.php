<?php
include_once "markdown.php";
include_once "manbolo/filemanager.php";

$css = "";

/**
 *
 */
function generate_html_header($title, $blog_uri)
{
    global $css;
    
    $text = '<!DOCTYPE html>' . "\n";
	$text .= '<html lang="en">' . "\n";
    $text .= '<head>' . "\n";
	$text .= '<meta charset="UTF-8" />' . "\n";
	$text .= '<meta name="viewport" content="width=640px" />' . "\n";
    $text .= '<style>' . "\n";
    $text .= $css;
    $text .= '</style>' . "\n";
	$text .= '<link rel="shortcut icon" type="image/png" href="'. $blog_uri . '/favicon.png"/>' . "\n";
	$text .= '<title>' . $title  .'</title>' . "\n";
	$text .= '<link rel="alternate" type="application/rss+xml" title="RSS" href="' . $blog_uri . '/rss.xml" />' . "\n";
    $text .= '</head>' . "\n";
	$text .= '<body>' . "\n";
	$text .= '<div id="m" class="left"></div><h1><a href="' . $blog_uri . '">Manbolo Blog</a></h1>' . "\n";
	$text .= '<p id="description"><a href="http://www.manbolo.com">Manbolo</a> Team Blog, creators of <a href="';
	$text .= 'http://www.manbolo.com/meon';
	$text .= '">Meon</a>';
	$text .= '<span id="archive_header_link"><a href="' .$blog_uri. '/archives">Archives</a></span>';
	$text .= '</p>';	
	$text .= '<section>' . "\n";
	
	return $text;
}

/**
 *
 */
function generate_html_footer($blog_uri, $generate_archive_link, $newer=NULL, $older=NULL)
{
	$text = '';
	
	if ($generate_archive_link == TRUE){
		$text .= '<p>';
		$text .= '<a href="' .$blog_uri. '/archives">All Posts</a>';
		//if ($newer) $text .= '<a href=".">Newer</a>';
		//if ($older) $text .= '<a href=".">Older</a>';
		$text .= '</p>' . "\n";
	}
	$text .= '<footer><p>';
	$text .= '© 2015 <a href="http://www.manbolo.com">Manbolo</a> Team Blog';
	$text .= '  • <a href="http://twitter.com/manboloGames">Twitter</a>';
	$text .= '  • <a href="' . $blog_uri . '/rss.xml">RSS feed</a>';
	$text .= '</p></footer>' . "\n";
	$text .= '</section>' . "\n";
	$text .= '</body>' . "\n";
	$text .= '</html>' . "\n";
	return $text;
}

/**
 *
 */
function generate_xml_header( $blog_uri )
{
	$date = new DateTime('now', new DateTimeZone('Europe/Paris'));
	
	$text = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
	$text .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
	$text .= '<channel>' . "\n";
	$text .= '<title>Manbolo Games</title>' . "\n";
	$text .= '<link>http://blog.manbolo.com/</link>' . "\n";
	$text .= '<atom:link href="' . $blog_uri . '/rss.xml" rel="self" type="application/rss+xml" />' . "\n";
	$text .= '<description>Manbolo developement and news</description>' . "\n";
	$text .= '<lastBuildDate>' . $date->format('D, d M Y H:i:s O') . '</lastBuildDate>' . "\n";
	$text .= '<language>en-us</language>' . "\n";
	return $text;
}

/**
 *
 */
function generate_xml_footer()
{
	$text = '</channel>' . "\n";
	$text .= '</rss>';
	return $text;
}

/**
 *
 */
function generate_archives_body( $article, $last_month_article)
{
	$date = $article['date'];
	$date_str = $date->format('d M Y');
	$path = $date->format('Y') . "/" . $date->format('m') . "/" . $date->format('d') . "/";
	$text ='';
	
	if ($last_month_article == TRUE){
		$text .= '<h3>' . $date->format('F Y') . '</h3>' . "\n";
	}
	
	$text .= '<p>';
	$text .= '<div class="archive_date"><time  datetime="' . $date->format('Y-m-d'). '" pubdate>' . $date->format('d M, Y') .'</time></div>';
	$text .= '<a href="' . $path . $article['filename'] .'">' . $article['title'] . '</a>';
	$text .= '</p>' . "\n";
	return $text;
}

function html_twitter_button($uri_dst, $url, $title)
{
	$title_html = urlencode($title);
	$text = '<a class="gray" href="http://twitter.com/share?url=' . $url . '&amp;text=' . $title_html . '&amp;via=ManboloGames&amp;related=manboloGames">tweet</a>';
	return $text;
}

function html_hn_button($hn_url)
{
	$text = '<span class="gray"> • </span><a class="gray" href="' . $hn_url . '">hacker news</a>';
	return $text;
}


/**
 * Generate the HTML fragment article and the RSS item associated
 */
function generate_article($src_path, $date, $blog_uri, $uri_dst)
{
	$article = array();
	
	$md = file_get_contents($src_path);
	
	$html = Markdown( $md );

	//-- some html satinazation	
	$html = str_replace('...', '&hellip;', $html);
	$html = str_replace('\'', '&#8217;', $html);


	//-- identify the title, first and only h2 tag
	$doc = new DOMDocument();
	$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'); 
	
	$doc->loadHTML($html);
	$h2_tag = $doc->getElementsByTagName('h2')->item(0);
	$title = $h2_tag->textContent;
	$h2_tag->parentNode->removeChild( $h2_tag );
	
	//-- check if there is a Hacker news link
	$hn_tags = $doc->getElementsByTagName('hn');
	if ($hn_tags->length){
		$hn_tag = $hn_tags->item(0);
		$p_tag = $hn_tag->parentNode;
		$hn_url = $hn_tag->nodeValue;
		$p_tag->parentNode->removeChild( $p_tag );
	}
	
	
	//-- iterate through img tag, find the local ones and absolute them
	$imgs_tag = $doc->getElementsByTagName('img');
	foreach ($imgs_tag as $img_tag) {
		
		$image_file = $img_tag->getAttribute('src');
		$image_fullpath = dirname($src_path) . '/' . $image_file;
		//echo "img= $image_file \n";
		
		if (file_exists($image_fullpath)){
			$img_tag->setAttribute('src', $uri_dst . '/' . $image_file);
			$sizes = getimagesize( $image_fullpath );
			$width = $sizes[0];
			$height = $sizes[1];
			
			if (!$img_tag->getAttribute('width'))
				$img_tag->setAttribute('width', $sizes[0]);
	
			if (!$img_tag->getAttribute('height'))
				$img_tag->setAttribute('height', $sizes[1]);
		}
		
		// TODO: may be a bug put width height on all image!
		//-- add a caption under each image if there is a title
		$img_title = $img_tag->getAttribute('title');
		if ($img_title){
			$small_node = $doc->createElement('small',$img_title);
			$small_node->setAttribute('class', 'caption');
			$img_tag->parentNode->appendChild( $small_node);
		}
	}
	
	
	//-- remove the doctype html body tag etc...
	$html = preg_replace(array("/^\<\!DOCTYPE.*?<html><body>/si",
                                  "!</body></html>$!si"),
                            "",
                            $doc->saveHTML());

	$filename = preg_replace("%[\[\]\?=#\-:\!\(\),\+’/]%", "", $title);
	$filename = preg_replace("/@/", "at", $filename);
	$filename = trim( $filename );
	$filename = str_replace('  ','-',$filename);
	$filename = str_replace(' ','-',$filename);
	$filename = strtolower(urlencode($filename));
	
	//-- construct the RSS 2.0 item
    $xml = htmlspecialchars($html);
    
	$rss = '<item>'  . "\n";
	$rss .= '<title>' . $title . '</title>' . "\n";
	$rss .= '<link>' . $uri_dst . '/' . $filename . '</link>' . "\n";
	$rss .= '<guid>' . $uri_dst . '/' . $filename . '</guid>' . "\n";
	$rss .= '<pubDate>' . $date->format('D, d M Y H:i:s O') . '</pubDate>' . "\n";
	$rss .= '<description>' . $xml .'</description>' . "\n";
	$rss .= '</item>' . "\n";
	
	//-- identify author...
	
	$html = preg_replace('/<p>From (jc|Paul).<\/p>/', '<p><span class="author">From $1.</span></p>', $html);
	
	//-- construct the full article	
	$full_html = '<article>' . "\n";
	$full_html .= '<header>' . "\n";
	$full_html .= '<h2><a href="' . $uri_dst . '/' . $filename . '">' . $title . '</a></h2>' . "\n";
	$full_html .= '<time datetime="' . $date->format('Y-m-d'). '" pubdate>' . $date->format('F j, Y') .'</time>' . "\n";
	$full_html .= '<div class="right">';
	$full_html .= html_twitter_button($blog_uri, $uri_dst . '/' . $filename, $title);
	if (isset($hn_url)){
		$full_html .= html_hn_button($hn_url);
	}
	$full_html .= '</div>';
	$full_html .= '<div class="clear"></div>';
	$full_html .= '</header>';
	$full_html .= $html;
	$full_html .= '</article>' . "\n";

	$article['html'] = $full_html;
	$article['title'] = $title;
	$article['filename'] = $filename;
	$article['md'] = $md;
	$article['rss'] = $rss;
	$article['date'] = $date;
	return $article;
}


/**
 *
 */
function generate_blog($dir_src, $dir_dst, $blog_uri, $display_all )
{
//	echo "dir_src= " . $dir_src . "\n";
//	echo "dir_dst= " . $dir_dst . "\n";
//	echo "blog_uri= " . $blog_uri . "\n";
//	echo "display_all= " . $display_all . "\n";
    global $css;

	//-- remove previous Blog generation
	shell_exec('rm -rfd ' .  $dir_dst);
	
	$days = Manbolo\FileManager::enumerateAt( $dir_src, '/\d{4}-\d{2}-\d{2}/');
	rsort($days, SORT_STRING);
	$months = array();

    $css = file_get_contents($dir_src . '/../ToCopy/main.css');

	//-- we register the last 10 articles for the Blog home page, and construct the 
	// rss with 100 items
	$last_articles_count = 0;
	$last_articles_maximum = 11;
	$rss_count = 0;
	$last_month = '';
	$body_last_articles = '';
	$body_rss = '';
	$body_monthly = '';
	$body_archives = '';
	
	
	$timezone = new DateTimeZone('Europe/Paris');
	
	$today = new DateTime( 'now', $timezone );


	//-- create each articles
	foreach($days as $day){
		//echo "Process articles for " . $day . "\n";

		$date = new DateTime( $day, $timezone );
	
		if (($date > $today) && !$display_all) {
			continue;	
		}
		

		// Ex. $dirname_src = /Users/jc/Documents/Dev/Blog/Articles/2011-12-04
		//     $dirname_dst = /Users/jc/Documents/Dev/www/blog.manbolo.com/2011/12/04
		//     $uri_dst = http://blog.manbolo.com/2011/12/04
		$dirname_src = $dir_src . "/" . $day;

		$current_month = $date->format('Y') . "/" . $date->format('m');
		$path =  $current_month . "/" . $date->format('d');
		$dirname_dst = $dir_dst . "/" .$path;
		if (!file_exists($dirname_dst)) mkdir($dirname_dst, 0777, TRUE);
		$uri_dst = $blog_uri . "/" . $path;

		//-- first, check if it's a new month
		// if it is, write the blog for the month
		if (($last_month != $current_month) && isset($body_monthly)){
			$html_monthly = generate_html_header('Manbolo Blog', $blog_uri );
			$html_monthly .= $body_monthly;
			$html_monthly .= generate_html_footer( $blog_uri, TRUE );
			file_put_contents($dir_dst . '/' . $last_month . '/index.html', $html_monthly);
			$months[] = $last_month;
			$body_monthly = '';
		}
		$last_month_article = ($last_month != $current_month);
		$last_month = $current_month;

		//-- for each md files, create a daily HTML article of it	
		$basenames_src =  Manbolo\FileManager::enumerateAt($dirname_src , '', FALSE);

		foreach($basenames_src as $basename_src){

			$fullname_src = $dirname_src . "/" . $basename_src;
			
			if (pathinfo($basename_src, PATHINFO_EXTENSION) == 'md'){

				$article_uri = $blog_uri . 
				
				//-- get the body of this article
				$article = generate_article( $fullname_src, $date, $blog_uri, $uri_dst );	
				$body_daily = $article['html'];
				$title = $article['title'];
			
				//-- create the permalink for this article
				$html_daily = generate_html_header( $title, $blog_uri );
				$html_daily .= $body_daily;
				$html_daily .= generate_html_footer( $blog_uri, TRUE );

				$fullname_dst = $dirname_dst . "/" . $article['filename' ] . '.html';
				file_put_contents($fullname_dst, $html_daily);
				
				// additionaly,copy the md
				file_put_contents($dirname_dst . "/" . $article['filename' ] . '.md', $article['md']);

				//-- add in the last_articles
				if ($last_articles_count < $last_articles_maximum){
					$body_last_articles .= $body_daily;
					$last_articles_count++;
				}
					
				//-- add in the RSS feedif
				if ($rss_count < 100){
					$body_rss .= $article['rss']; 
					$rss_count++;
				}

				//-- update the monthly
				$body_monthly .= $body_daily;
				
				//-- update the archives
				$body_archives .= generate_archives_body( $article, $last_month_article );
				$last_month_article = FALSE;		
				//echo 'creating article at ' . $fullname_dst . "\n";
			}
			else if (is_file($fullname_src)){
				//echo "copy " . $fullname_src . "\n";
				copy($fullname_src, $dirname_dst . "/" . $basename_src);
			}
		}
		
	}

	//-- Do the last monthly
	$html_monthly = generate_html_header('Manbolo Blog', $blog_uri );
	$html_monthly .= $body_monthly;
	$html_monthly .= generate_html_footer( $blog_uri, TRUE );
	file_put_contents($dir_dst . '/' . $last_month . '/index.html', $html_monthly);
	$months[] = $last_month;
	
	//-- Do the index.html last articles blog pages
	$html_last_articles = generate_html_header('Manbolo Blog', $blog_uri );
	$html_last_articles .= $body_last_articles;
	$html_last_articles .= generate_html_footer( $blog_uri , TRUE);
	file_put_contents($dir_dst . '/index.html', $html_last_articles);
	
	//-- Do the archives.html
	$html_archives = generate_html_header('Archives', $blog_uri );
	$html_archives .= $body_archives . "<br/>";
	$html_archives .= generate_html_footer( $blog_uri, FALSE );
	file_put_contents($dir_dst . '/archives.html', $html_archives);
	
	//-- Do the rss feed
	$rss = generate_xml_header( $blog_uri );
	$rss .= $body_rss;
	$rss .= generate_xml_footer();
	file_put_contents($dir_dst . '/rss.xml', $rss);

	// Copy files that are in ToCopy
	$files_to_copy = Manbolo\FileManager::enumerateAt( $dir_src . '/../ToCopy/','',FALSE);
	foreach($files_to_copy as $file_to_copy){
		copy($dir_src . '/../ToCopy/' . $file_to_copy, $dir_dst . '/' . $file_to_copy);
	}
	
}


//-- The blog generator

$shortopts  = '';
$shortopts .= 'i:'; // input
$shortopts .= 'o:'; // output
$shortopts.= 'u:';
$shortopts.= 'a';


$longopts  = array(
    'help',
);

$options = getopt($shortopts, $longopts);

// Help & usage
if (isset($options['help']) || empty($options) || !isset($options['i']) || !isset($options['o'])){
	echo 'Usage: php -f process_articles.php -i <dir_articles_src> -o <dir_root_blog> -a' ."\n";
	exit(0);
}

if (!isset($options['u'])){
	$blog_uri = 'http://blog.manbolo.com';
}
else{
	$blog_uri = $options['u'];
}

$display_all = isset( $options['a'] );

generate_blog($options['i'], $options['o'], $blog_uri, $display_all);


?>