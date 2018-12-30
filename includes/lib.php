<?php

/**
/**
 * @package HHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

 
define ('DownloadError' , '<p class=\"hhl-warning\">Die Losungen sind derzeit nicht verf&uuml;gbar!</p>');

function is_utf8($string) 
{
  return preg_match('/(
    [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
    |    \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
    |    [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}    # straight 3-byte
    |    \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
    |    \xF0[\x90-\xBF][\x80-\xBF]{2}        # planes 1-3
    |    [\xF1-\xF3][\x80-\xBF]{3}        # planes 4-15
    |    \xF4[\x80-\x8F][\x80-\xBF]{2}        # plane 16
    )/x', $string);

}

/* Get Losungen if CURL is not available.  */

function get_withoutcurl ( $url ) 
{

  $page='';
  $fd = fopen($url,"r");
  if ($fd) 
  {
    while(!feof($fd))
    {
      $line = fgets($fd,4096);
      $returned .= $line;
    }
    fclose($fd);
  } 
  else
  {
    $returned = DownloadError ;
  }
  return $returned;
}

/* Get list of events if CURL is available.  */

function get_withcurl ( $url, $agent = 'WordpressPlugin' )
{
  // use curl
  $sobl = curl_init($url);

  curl_setopt($sobl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($sobl, CURLOPT_USERAGENT, $agent);
  curl_setopt($sobl, CURLOPT_REFERER, $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
  # timeout max 2 Sek.
  curl_setopt($sobl, CURLOPT_CONNECTTIMEOUT, 1);
  
  $pageContent = curl_exec ($sobl);
  
  $sobl_info = curl_getinfo ($sobl);
	
  if($sobl_info['http_code'] == '200')
  {
    $returned = $pageContent;
	
  } 
  else 
  {
    # Fehlermeldung:
    $returned = DownloadError;
  }
  return $returned;

} 

/**
  
 Convert date to 'Y-m-d' for XML-Script

 */

function converttoxmldate ( $datestr ) 
{
  date_default_timezone_set('UTC');
  if ($datestr != '') 
    return date ('Y-m-d' , strtotime ( $datestr )) ; 
  else 
    return '';
}

/**
 ----------------------------------------------------------------

  Get Losungen from download_url
 
 ----------------------------------------------------------------
 */

function hhl_getlosungen($download_url, $agent = 'WordPressPlugin' ) 

{

  if ( $download_url != '' ) 
  {
    if (function_exists('curl_init'))
      $resturned = get_withcurl ($url );
    else 
      $returned = get_withoutcurl($url);

    return $returned ;

  } 
  else 
    return "<p>Keine Datei angegeben:" . $download_url . "</p>";
 
}

?>
