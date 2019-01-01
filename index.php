<?php

/*****
Plugin Name: Herrnhuter Losungen SQL
Plugin URI: http://byggvir.de/wp-losungen-sql/
Description: Dieses Plugin stellt eine Schnittstelle zu den Losungen der Herrnhuter Brüdergemeine bereit. Mit dem Shortcode hhl-losung kan eine Losung in Seiten und Artikel eingebunden werden. Daneben steht ein Widget für die Anzeige der Tages-, Jahres oder Wochenlosung zur Verfügung. Die Losungen werden in einer Tabelle der WordPress Datenbank gespeichert.

Author: Thomas Arend
Version: 2019.0.1
Date: 30.12.2018
Author URI: http://byggvir.de/
License: GPL 3 or later

*/

/**
 * @package TAHHL-Herrnhuter-Losungen
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

define( "TAHHL", 'TAHHL_' );

if ( !class_exists( TAHHL.'Losungen' ) )
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
      $TAHHL_Losungen_Settings = new TAHHL_Losungen_Settings();
      
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
    
   } // END class TAHHL.Losungen
  
 } // END if(!class_exists(TAHHL.'Losungen'))


if ( class_exists( TAHHL.'Losungen' ) )
 {
  
  // Installation and uninstallation hooks
  register_activation_hook( __FILE__, array(
    TAHHL.'Losungen',
    'activate' 
  ) );
  register_deactivation_hook( __FILE__, array(
    TAHHL.'Losungen',
    'deactivate' 
  ) );
  
  // Instantiate the plugin class
  
  $tahhl_losungen = new TAHHL_Losungen();
  
  // Add a link to the settings page onto the plugin page
  
  if ( isset( $hhl_losungen ) )
   {
    // Add the settings link to the plugins page
    function TAHHL_settings_link( $links )
     {
      
      $settings_link = '<a href="options-general.php?page=tahhl_losungen">Settings</a>';
      array_unshift( $links, $settings_link );
      return $links;
      
     }
    
    $plugin = plugin_basename( __FILE__ );
    add_filter( "plugin_action_links_$plugin", TAHHL . 'settings_link' );
    
   } //isset( $hhl_losungen )
  
 } //class_exists( 'HHL_Losungen' )

require_once( sprintf( "%s/includes/global.php", dirname( __FILE__ ) ) );
require_once( sprintf( "%s/includes/postprocess.php", dirname( __FILE__ ) ) );
require_once( sprintf( "%s/includes/lib.php", dirname( __FILE__ ) ) );
require_once( sprintf( "%s/includes/create_table.php", dirname( __FILE__ ) ) );

require_once( sprintf( "%s/includes/shortcodes.php", dirname( __FILE__ ) ) );
require_once( sprintf( "%s/includes/widget.php", dirname( __FILE__ ) ) );

// We need some CSS to format the Losung 

function tahhl_add_stylesheet( )
 {
  wp_register_style( TAHHL . 'StyleSheets', plugins_url( 'css/styles.css', __FILE__ ) );
  wp_enqueue_style( TAHHL . 'StyleSheets' );
 }

// Add the StyleSheets

add_action( 'wp_print_styles', 'tahhl_add_stylesheet' );

// Add the Shortcode

add_shortcode( 'losung', 'tahhl_losung' );

?>
