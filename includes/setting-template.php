<?php 
/**
/**
 * @package TAHHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */


//Security check!

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

?>

<!-- TAHHL Losungen Settings -->

  <h1>Herrnhuter Losungen (HHL)</h1>
  <h2>Beschreibung</h2>
  <p>
  Hier k&ouml;nnen die vorgegebenen Werte des Herrnhuter Plugins angepasst / &uuml;berschrieben werden. 
  </p>
  
  <form method="post" action="options.php"> 
    <?php @settings_fields('tahhl-group'); ?>
    <?php @do_settings_fields('tahhl-group'); ?>
    <?php do_settings_sections('tahhl_losungen'); ?>
    <?php @submit_button(); ?>
  </form>
  
  <h2>Parameter des Shortcodes [losungen]</h2>

  <p>Folgende Parameter werden unterstützt:
	<ol>
	<li>Datum</li>
	<li>Losungsvers</li>
	<li>Lehrtextvers</li>
	</ol>
  </p>
  

