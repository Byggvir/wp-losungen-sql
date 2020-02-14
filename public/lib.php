<?php
/**
 * includes/lib.php
 *
 * @package           WP Losungen SQL
 * @link              http://byggvir.de
 * @since             2019.0.1
 * @version 2019.0.4
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @plugin-wordpress
 *
 */

/**
 * Security check: Exit if script is called directly
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define('TAHHL_DownloadError' , '<p class=\"hhl-warning\">Die Losungen sind derzeit nicht verf&uuml;gbar!</p>');


/**
 *
 * @param unknown $string
 * @return unknown
 */
function tahhl_is_utf8($string) {
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


/**
 *
 * @param unknown $url
 * @return unknown
 */
function tahhl_get_withoutcurl( $url ) {

	$page='';
	$fd = fopen($url, "r");
	$returned = '';

	if ($fd) {
		while (!feof($fd)) {
			$line = fgets($fd, 4096);
			$returned .= $line;
		}
		fclose($fd);
	}
	else {
		$returned = DownloadError ;
	}
	return $returned;
}


/* Get list of events if CURL is available.  */


/**
 *
 * @param unknown $url
 * @param unknown $agent (optional)
 * @return unknown
 */
function tahhl_get_withcurl( $url, $agent = 'WordpressPlugin' ) {
	// use curl
	$sobl = curl_init($url);

	curl_setopt($sobl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($sobl, CURLOPT_USERAGENT, $agent);
	curl_setopt($sobl, CURLOPT_REFERER, $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	// timeout max 2 Sek.
	curl_setopt($sobl, CURLOPT_CONNECTTIMEOUT, 1);

	$pageContent = curl_exec ($sobl);

	$sobl_info = curl_getinfo ($sobl);
	$returned = '';

	if ($sobl_info['http_code'] == '200') {
		$returned = $pageContent;

	}
	else {
		// Fehlermeldung:
		$returned = TAHHL_DownloadError;
	}
	return $returned;

}


/**
 * Convert date to 'Y-m-d' for XML-Script
 *
 * @param unknown $datestr
 * @return unknown
 */
function tahhl_converttoxmldate( $datestr ) {
	date_default_timezone_set('UTC');
	if ($datestr != '')
		return date('Y-m-d' , strtotime( $datestr )) ;
	else
		return '';
}


/**
 * ----------------------------------------------------------------
 * Get Losungen from download_url
 * ----------------------------------------------------------------
 *
 * @param unknown $download_url
 * @param unknown $agent        (optional)
 * @return unknown
 */
function tahhl_getlosungen($download_url, $agent = 'WordPressPlugin' ) {

	if ( $download_url != '' ) {
		if (function_exists('curl_init'))
			$returned = tahhl_get_withcurl ($url );
		else
			$returned = tahhl_get_withoutcurl($url);

		return $returned ;

	}
	else
		return "<p>Keine Datei angegeben:" . $download_url . "</p>";

}


?>
