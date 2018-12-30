<?php

/*****
Plugin Name: Herrnhuter Losungen SQL
Plugin URI: http://byggvir.de/wp-losungen-sql/
Description: Dieses Plugin stellt eine Schnittstelle zu den Losungen der Herrnhuter Brüdergemeine bereit. Mit dem Shortcode hhl-losung kan eine Losung in Seiten und Artikel eingebunden werden. Daneben steht ein Widget für die Anzeige der Tages-, Jahres oder Wochenlosung zur Verfügung. Die Losungen werden in einer Tabelle der WordPress Datenbank gespeichert.

Author: Thomas Arend
Version: 2019.0
Date: 30.12.2018
Author URI: http://byggvir.de/
License: GPL 3 or later

*/

/**
 * @package HHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

// Security check: Exit if script is called directly

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*****
 * Define a prefix for HHL
 */

define( "HHL", 'HHL_' );

if ( !class_exists( 'HHL_Losungen' ) )
 {
  class HHL_Losungen
   {
    /**
     * Construct the plugin object
     */
    public function __construct( )
     {
      // Initialize Settings
      require_once( sprintf( "%s/includes/settings.php", dirname( __FILE__ ) ) );
      $HHL_Losungen_Settings = new HHL_Losungen_Settings();
      
     } // END public function __construct
    
    /**
     * Activate the plugin
     */
    public static function activate( )
     {
      // Do nothing
     } // END public static function activate
    
    /**
     * Deactivate the plugin
     */
    public static function deactivate( )
     {
      // Do nothing
     } // END public static function deactivate
    
   } // END class HHL_Losungen
  
 } // END if(!class_exists(HHL.'Losungen'))


if ( class_exists( 'HHL_Losungen' ) )
 {
  
  // Installation and uninstallation hooks
  register_activation_hook( __FILE__, array(
    'HHL_Losungen',
    'activate' 
  ) );
  register_deactivation_hook( __FILE__, array(
    'HHL_Losungen',
    'deactivate' 
  ) );
  
  // Instantiate the plugin class
  
  $hhl_losung = new HHL_Losungen();
  
  // Add a link to the settings page onto the plugin page
  
  if ( isset( $hhl_losung ) )
   {
    // Add the settings link to the plugins page
    function HHL_settings_link( $links )
     {
      
      $settings_link = '<a href="options-general.php?page=hhl_losung">Settings</a>';
      array_unshift( $links, $settings_link );
      return $links;
      
     }
    
    $plugin = plugin_basename( __FILE__ );
    add_filter( "plugin_action_links_$plugin", HHL . 'settings_link' );
    
   } //isset( $hhl_losung )
  
 } //class_exists( 'HHL_Losungen' )

require_once( sprintf( "%s/includes/global.php", dirname( __FILE__ ) ) );
require_once( sprintf( "%s/includes/postprocess.php", dirname( __FILE__ ) ) );
require_once( sprintf( "%s/includes/lib.php", dirname( __FILE__ ) ) );
require_once( sprintf( "%s/includes/create_table.php", dirname( __FILE__ ) ) );

require_once( sprintf( "%s/includes/shortcode_calendar.php", dirname( __FILE__ ) ) );
require_once( sprintf( "%s/includes/widget.php", dirname( __FILE__ ) ) );

// We need some CSS to format the Losung 

function add_hhl_stylesheet( )
 {
  wp_register_style( HHL . 'StyleSheets', plugins_url( 'css/styles.css', __FILE__ ) );
  wp_enqueue_style( HHL . 'StyleSheets' );
 }

// Add the HHLStyleSheets

add_action( 'wp_print_styles', 'add_hhl_stylesheet' );

add_shortcode( 'losung', 'hhl_losung' );

?>
