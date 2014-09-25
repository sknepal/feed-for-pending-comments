<?php
/*
Author : Sk Nepal
Author URI : www.thelacunablog.com
*/

$numcom = 0;

function sk_rss_date( $timestamp = null ) {
  $timestamp = ($timestamp==null) ? time() : $timestamp;
  echo date(DATE_RSS, $timestamp);
}

$comments = get_comments('status=hold&number='.$numcom);
$lastcom = $numcom - 1;

header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0"?>';
?><rss version="2.0">
<channel>
  <title><?php echo bloginfo_rss('name'); ?></title>
  <link><?php echo bloginfo_rss('url') ?></link>
  <generator>http://www.thelacunablog.com</generator>
  <description><?php bloginfo_rss('description') ?></description>
  <language>en-us</language>
  <pubDate><?php sk_rss_date( strtotime($ps[$lastcom]->comment_date_gmt) ); ?></pubDate>
  <lastBuildDate><?php sk_rss_date( strtotime($ps[$lastcom]->comment_date_gmt) ); ?></lastBuildDate>
<?php 

foreach($comments as $comm) { ?>
  <item>
    <title><?php echo get_the_title($comm->comment_post_ID); ?></title>
    <link><?php echo get_permalink($comm->comment_post_ID); ?></link>
    <author><?php echo ($comm->comment_author); ?></author>
    <description><?php echo ($comm->comment_content); ?></description>
    <pubDate><?php sk_rss_date( strtotime($comm->comment_date_gmt) ); ?></pubDate>
    <guid><?php echo get_permalink($comm->comment_post_ID) . '#comment-' . ($comm->comment_ID); ?></guid>
  </item>
<?php } ?>
</channel>
</rss>