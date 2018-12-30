<?php 
/**
/**
 * @package HHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */


//Security check!

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

?>

<!-- HHL Losungen Settings -->

  <h1>Herrnhuter Losungen</h1>
  <h2>Beschreibung</h2>
  <p>
  Hier k&ouml;nnen die vorgegebenen Werte des Herrnhuter Plugins angepasst / &uuml;berschrieben werden. 
  </p>
  
  <h3>Liste der Parameter des Shortcodes</h3>

  <p>Folgender Parameter wird unterstützt: Datum, Losungsvers, Lehrtextvers
  </p>
  
  <h2>Vorgabewerte<h2>
  
  <form method="post" action="options.php"> 
    <?php @settings_fields('hhl-group'); ?>
    <?php @do_settings_fields('hhl-group'); ?>
    <?php do_settings_sections('hhl_losungen'); ?>
    <?php @submit_button(); ?>
  </form>
