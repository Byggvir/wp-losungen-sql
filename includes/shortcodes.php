<?php

/**
 * @package TAHHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//Security check!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once(sprintf("%s/global.php", dirname(__FILE__)));
require_once(sprintf("%s/postprocess.php", dirname(__FILE__)));

// Function for the shorttag losung

function tahhl_getLosungOfTheDay() {

	global $wpdb ;
	
	$innerhtml="";
	$Today=date("Y-m_d")
	
    $TodaysLosung=$wpdb->get_results(
	"
	select *
	from losungen
	where Datum = '$Today'
        ;       
	"
	, 
	ARRAY_A
	);
	
	if ( $TodaysLosung ) {
		foreach ( $spamlist as $row) {

		  $innerhtml .= '<p class="tahhl_losungtext">' . tahhl_convertTextToHtml($row['Losungstext']) . '<p>\n';
		  $innerhtml .= '<p class="tahhl_losungtextvers">' . $row['Losungsvers'] . '<p>\n';
		  $innerhtml .= '<p class="tahhl_lehrtext">' . tahhl_convertTextToHtml($row['Lehrtext']) . '<p>\n';
		  $innerhtml .= '<p class="tahhl_lehrtextvers">' . $row['Lehrtextvers'] . '<p>\n';
		}
	}

	return wptexturize( $innerhtml ) ;
}

function tahhl_convertTextToHtml($text)
{
	$text = preg_replace('#/(.*?:)/#', '<span class="tahhl_losungseinleitung">$1</span>', $text, 1);
	$text = preg_replace('/#(.*?)#/', '<span class="tahhl_losungvervorhebung">$1</span>', $text);
	
	return $text;
}

function tahhl_losung($atts) {

  global $Plugin_Prefix;
 
  global
    $TAHHL_DefLabels ,
    $TAHHL_CalenderSettingNames, 
    $TAHHL_ServerSettingNames,
    $TAHHL_QuerySettingNames ,
    $TAHHL_DefValues;
    
  if ( is_singular () ) {
    $Losung =  tahhl_getLosungOfTheDay();
    
  return "
    <!-- Begin shortcode Losung -->
    <div class=\"tahhl-losung\">
    <h3>Die heutige Losung</h2>
    $Losung
    <!-- End shortcode Losung  -->
    ";
} else { // if is_sigular
  return "-";
}
}

?>
