<?php
/**
 * includes/copyright.php
 *
 * @package           WP Losungen SQL
 * @link              http://byggvir.de
 * @since             2019.0.1
 * @version 2019.0.4
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
/**
 * Formtiere Markup eines Verses
 *
 * @param NULL
 * @return text Coppyright der Herrnhuter Brüdergemeine
 */
function HH_Copyright() {
	return "
  <p class=\"tahhl-losung-copyright\">
  <a href=\"http://www.herrnhuter.de\" target=\"_blank\" title=\"Evangelische Br&uuml;der-Unit&auml;t\">&copy; Evangelische Br&uuml;der-Unit&auml;t – Herrnhuter Br&uuml;dergemeine</a> <br>
  <a href=\"https://www.losungen.de\" target=\"_blank\" title=\"www.losungen.de\">Weitere Informationen finden Sie hier</a>
";
}


/**
 *
 * @return Copyright des Autors
 */
function TA_Copyright() {

	return "
  <div class=\"tahhl-copyright\">&copy 2019 - Thomas Arend - WP Losungen SQL 2019.0.4</div>
";
}


?>
