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

function tahhl_losung($atts) {

  global $Plugin_Prefix;
 
  global
    $TAHHL_DefLabels ,
    $TAHHL_CalenderSettingNames, 
    $TAHHL_ServerSettingNames,
    $TAHHL_QuerySettingNames ,
    $TAHHL_DefValues;
    
  if ( is_singular () ) {

  return "
    <!-- Begin shortcode Losung -->
    <div class=\"tahhl-losung\">
    Noch nicht implementiert!
    </div>
    <p style=\"font-size: x-small;\">Powered by WP Losungen SQL Plugin - &copy Thomas Arend, Rheinbach</p>
    <!-- End shortcode Losung  -->
    ";
} else { // if is_sigular
  return "-";
}
}

?>
