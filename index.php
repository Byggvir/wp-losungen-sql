<?php
/**
 * index.php
 *
 * @link              http://byggvir.de
 * @since             2019.0.1
 * @package           WP Losungen SQL
 * @version 2019.0.2
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @plugin-wordpress
 *
 * Plugin Name: Herrnhuter Losungen SQL
 * Plugin URI: http://byggvir.de/wp-losungen-sql/
 * Description: Dieses Plugin stellt die Losungen und Lehrtexte der Herrnhuter Brüdergemeine in Wordpress bereit.
 * Author: Thomas Arend
 * Version: 2019.0.2
 * Date: 02.01.2019
 * Author URI: http://byggvir.de/
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
/**

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

The Losungen of the Herrnhuter Brüdergemeine are copyrighted. Owner of
copyright is the Evangelische Brüder-Unität – Herrnhuter Brüdergemeine.
The biblical texts from the Lutheran Bible, revised texts in 2017, 
and from the Lutheran Bible, revised texts in 1984, revised
edition with a new spelling, subject to the copyright of the German Bible
Society, Stuttgart.

Remind the restricted right to use only the "Die Losungen" from the
last, current and next year. The Losungen are not part of this package
and have to be installed separately.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Requirements:
==============================================================================
This plugin requires WordPress >= 5.0.0 and was tested with PHP Interpreter >= 7.0.33-0
 
 */
 
/**
 *
 * Usage shortcode losung
 * Mit dem Shortcode "losung" kann eine Losung in Seiten oder Artikel eingebunden werden.
 * Der shortcode versteht die Parameter date, from, to und max. 
 * date hat Vorrang vor den anderen Paratmetern. In "date", "from" und "to" kann
 * ein Datum in "Englisch eingegeben werden.
 *
 *
 * Beispiele: 
 *
 * [losung]
 *
 * Zeigt die Losung des aktuellen Tages (Systemdatumi des Web-Server) an.
 * [losung date="yesterday"]
 *
 * Zeigt die Losung des gestrigen Tages an.
 *
 * [losung from="last monday" to="next sunday"]
 *
 * Zeigt die Losungen der Woche in einer Tabelle an.i
 *
 */

/**
 * Security check: Exit if script is called directly
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Define a prefix for WP Losungen SQL
 */

define( "TAHHL", 'TAHHL_' );

if ( !class_exists( TAHHL.'Losungen' ) ) {
	class TAHHL_Losungen {

		/**
		 * Construct the plugin object
		 */
		public function __construct( ) {
			// Initialize Settings
			require_once plugin_dir_path( __FILE__ ) . 'admin/settings.php';
			$TAHHL_Losungen_Settings = new TAHHL_Losungen_Settings();

		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate( ) {
			// Do nothing
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate( ) {
			// Do nothing
		} // END public static function deactivate

	} // END class TAHHL.Losungen

} // END if(!class_exists(TAHHL.'Losungen'))


if ( class_exists( TAHHL.'Losungen' ) ) {

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

	if ( isset( $tahhl_losungen ) ) {


		/**
		 * Add the settings link to the plugins page
		 *
		 * @param unknown $links
		 * @return unknown
		 */
		function TAHHL_settings_link( $links ) {

			$settings_link = '<a href="options-general.php?page=tahhl_losungen">Settings</a>';
			array_unshift( $links, $settings_link );
			return $links;

		}


		$plugin = plugin_basename( __FILE__ );
		add_filter( "plugin_action_links_$plugin", TAHHL . 'settings_link' );

	} //isset( $hhl_losungen )

} //class_exists( 'HHL_Losungen' )

require_once plugin_dir_path( __FILE__ ) . 'public/global.php';
require_once plugin_dir_path( __FILE__ ) . 'public/lib.php';
#require_once plugin_dir_path( __FILE__ ) . 'public/create_table.php';
require_once plugin_dir_path( __FILE__ ) . 'public/class_shortcodes.php';
require_once plugin_dir_path( __FILE__ ) . 'public/class_widget.php';


// We need some CSS to format the Losung


/**
 *
 */
function tahhl_add_stylesheet( ) {
	wp_register_style( TAHHL . 'StyleSheets', plugins_url( 'css/styles.css', __FILE__ ) );
	wp_enqueue_style( TAHHL . 'StyleSheets' );
}


// Add the StyleSheets

add_action( 'wp_print_styles', 'tahhl_add_stylesheet' );


?>
