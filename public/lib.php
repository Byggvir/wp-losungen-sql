<?php
/**
 * includes/lib.php
 *
 * @package           WP Losungen SQL
 * @link              http://byggvir.de
 * @since             2019.0.1
 * @version 2019.0.1
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

require_once TAHHL_PATH . 'lib/class-csvget.php';

/**
 * Convert date to 'Y-m-d' for XML-Script
 *
 * @param unknown $datestr
 * @return unknown
 */

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


}


?>
