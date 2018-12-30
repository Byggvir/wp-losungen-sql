<?php

/*
Plugin: Evangelische Termine
Author: Thomas Arend
Version: 0.6.2
Date: 07.02.2016
Author URI: http://byggvir.de/
License: GPL3

Changes 0.6.2
first version for github 

Changes 0.6
- renamed plugin and prefixes

Changes 0.5
- show calendar only when post is on a single page  

*/

//Security check!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once(sprintf("%s/global.php", dirname(__FILE__)));
require_once(sprintf("%s/postprocess.php", dirname(__FILE__)));

// Function for the shorttag. Include the event table.

function evt_calendar($atts) {

  global $Plugin_Prefix;
 
  global
    $EVT_DefLabels ,
    $EVT_CalenderSettingNames, 
    $EVT_ServerSettingNames,
    $EVT_QuerySettingNames ,
    $EVT_DefValues;
    
  if ( is_singular () ) {

  // Set the default values to settungs from settings page or to internal default
  $def_atts = $EVT_DefValues;
  foreach ( $EVT_DefValues as $key => $value ) {
    $def_atts[$key] = get_option('evt_'.$key);
    if ($def_atts[$key] == '') {
      // Set to internal default
      $def_atts[$key] = $value;
    } // if
  } // foreach
  
  // Get the attributs form shortcode
    $sc_atts = shortcode_atts( $def_atts, $atts, 'evtcalendar');

  if ($sc_atts['title'] == '')
	$eventheading = "<!-- No heading -->";
  else
	$eventheading = "<h3>" . $sc_atts['title'] . "</h3>";
 
  $termine = postprocess_xml(
	evt_getevents($sc_atts,$EVT_QuerySettingNames)
  );

  /* Debugging 
  foreach ($sc_atts as $key => $value) {
    $termine .= "<p>$key = $value</p>\n"; 
  } // foreach
  */
  
 return "
	<!-- Begin shortcode Ev. Termine -->
	<div class=\"evt-eventtab\">
	$eventheading
	$termine
	</div>
	<p style=\"font-size: x-small;\">Powered by Evangelische Termine Plugin - &copy Thomas Arend, Rheinbach</p>
	<!-- End shortcode Ev. Termine -->
	";
} else { // if is_sigular
  return "";
}
}

?>
