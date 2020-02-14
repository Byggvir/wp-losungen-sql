<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://byggvir.de
 * @since             2019.0.0
 * @package           Tahhl
 *
 * @wordpress-plugin
 * Plugin Name:       Herrnhuter Losungen SQL
 * Plugin URI:        https://github.com/Byggvir/wp-losungen-sql
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           2019.1.0
 * Author:            Thomas Arend
 * Author URI:        https://byggvir.de
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tahhl
 * Domain Path:       /languages
 * Plugin Name: Herrnhuter Losungen SQL
 * Plugin URI: http://byggvir.de/wp-losungen-sql/
 * Description: Dieses Plugin stellt die Losungen und Lehrtexte der Herrnhuter Brüdergemeine in Wordpress bereit.
 * Author: Thomas Arend
 * Version: 2019.1.0
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

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

define( "TAHHL", 'TAHHL_' );

define( 'TAHHL_VERSION'     , '2019.1.0' );

/**
 * Path of the plugin
 */
 
define( 'TAHHL_PATH'   , plugin_dir_path( __FILE__ ));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tahhl-activator.php
 */
function activate_tahhl() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tahhl-activator.php';
	Tahhl_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tahhl-deactivator.php
 */
function deactivate_tahhl() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tahhl-deactivator.php';
	Tahhl_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tahhl' );
register_deactivation_hook( __FILE__, 'deactivate_tahhl' );

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

add_filter( "plugin_action_links_". plugin_basename( __FILE__ ), TAHHL . 'settings_link' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

require_once plugin_dir_path( __FILE__ ) . 'includes/class-tahhl.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2019.0.0
 */
function run_tahhl() {

	$plugin = new Tahhl();
	$plugin->run();

}
run_tahhl();
