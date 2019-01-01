<?php

/**
 * @package TAHHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * Provides the functionality for the shortcodes
 *
 *
 */
 
//Security check!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once(plugin_dir_path( __FILE__ ) . '/global.php');
require_once(plugin_dir_path( __FILE__ ) . '/class_losung.php');
require_once(plugin_dir_path( __FILE__ ) . '/copyright.php');

class TAHHL_ShortCodes {

/**
* Constructor of the class
* 
* @param NUL
* 
*/

  public function __construct() {
     
     // Add the Shortcode

    add_shortcode( 'losung', array($this, 'losung') );
    
  }
  

  public function losung($atts) {


    global $Plugin_Prefix;
 
    global
      $TAHHL_DefLabels ,
      $TAHHL_CalenderSettingNames, 
      $TAHHL_ServerSettingNames,
      $TAHHL_QuerySettingNames ,
      $TAHHL_DefValues;
    
    extract(shortcode_atts(array(
        'date' => '',
        'from' => '',
        'to' => '',
        'max' => '0',
    ), $atts));
    
    $show = false;
    
    $API =  new TAHHL_Losung_APISQL ();
    
    if ( $date != '' ) {
      $Losung =  $API->getLosungOfTheDay($date);
      $show = true;
    } elseif (($from != '') or ($to != '')) {
      $Losung = $API->getLosungList($from, $to, $max) ;
      $show= false;    
    } else {
      $Losung =  $API->getLosungOfTheDay();
      $show = true;
    }
        
    
    if ( is_singular () or $show ) {
  
      $Copyright = HH_CopyRight();
  
      return "
        <!-- Begin shortcode Losung -->
        <div class=\"tahhl-losungOfTheDay\">
        $Losung
        $Copyright
        </div>
        <!-- End shortcode Losung  -->
      ";
    }
    else { // if is_sigular
      return "<p>Die Losungen ... </p>";
    }
  }
} // End class
$TAHHL_Shortcodes = new TAHHL_ShortCodes();

?>
