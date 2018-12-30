<?php
/**
 * @package HHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */


//Security check!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!class_exists('HHL_Losungen_Settings'))
{
class HHL_Losungen_Settings
{
/**
* Construct the plugin object
**/

public function __construct()
{
	// register actions
	add_action('admin_init', array(&$this, 'admin_init'));
	add_action('admin_menu', array(&$this, 'add_menu'));
} // END public function __construct

/**
* hook into WP's admin_init action hook
**/

public function admin_init()
{

// global.php must be included here! Don't ask me why!
 
  require_once(sprintf("%s/global.php", dirname(__FILE__)));

  global
  $HHL_DefLabels,
  $HHL_DownloadSettingNames,
  $HHL_DefValues;
      
  
// register your plugin's settings


  foreach ($HHL_DefValues as $key => $value) {
    register_setting('hhl-group', 'hhl_'.$key, array( 'string',$key,'',false,$value));
  }

  add_settings_section(
    'hhl_DownloadSection', 
    'HHL Download Einsteliungen ', 
    array(&$this, 'settings_section_download'), 
    'hhl_losungen'
  );

// add your setting's fields

  foreach ($HHL_DownloadSettingNames as $key => $value) {
    add_settings_field(
      'hhl_'.$key, 
      $HHL_DefLabels[$key], 
      array(&$this, 'settings_field_input_text'), 
      'hhl_losungen', 
      'hhl_DownloadSection',
      array(
        'field' => 'hhl_'.$key
      )
    );
  }
	
// Possibly do additional admin_init tasks

            
} // END public static function activate
   
/**
* These functions place text after the title of the setting section
**/

public function settings_section_download() {

// Think of this as help text for the section.
  echo "\n<p>Hier k&ouml;nnen die Vorgabewerte die Download URL angepasst werden.</p>";
}
      
/**
* This function provides text inputs for settings fields
**/

public function settings_field_input_text($args) {
// Get the field name from the $args array
  $field = $args['field'];
// Get the value of this setting
  $value = get_option($field);
// echo a proper input type="text"
  echo "\n" . sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);

} // END public function settings_field_input_text($args)
        
/**
* add a menu
**/

public function add_menu() {
// Add a page to manage this plugin's settings
  add_options_page(
    'Herrnhuter Br&uuml;dergemeine', 
    'Losungen', 
    'manage_options', 
    'hhl_losungen', 
    array(&$this, 'plugin_settings_page')
  );

} // END public function add_menu()
    
/**
* Menu Callback
**/

public function plugin_settings_page() {
  if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }
	
// Render the settings template
    
  include(sprintf("%s/setting-template.php", dirname(__FILE__)));

} // END public function plugin_settings_page()
} // END class HHL_Losungen_Settings
} // END if(!class_exists('HHL_Losungen_Settings'))
?>
