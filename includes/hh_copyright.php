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

/**
* Formtiere Markup eines Verses
* 
* @param NULL
* @return text Coppyriht der Herrnhuter Brüdergemeine
*/

function HHL_Copyright() {
echo "
  <p class=\"tahhl-losung-copy\">
  <a href=\"http://www.herrnhuter.de\" target=\"_blank\" title=\"Evangelische Br&uuml;der-Unit&auml;t\">&copy; Evangelische Br&uuml;der-Unit&auml;t – Herrnhuter Br&uuml;dergemeine</a> <br>
  <a href=\"https://www.losungen.de\" target=\"_blank\" title=\"www.losungen.de\">Weitere Informationen finden Sie hier</a>
";
}
?>
