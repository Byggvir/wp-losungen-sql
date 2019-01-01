<?php
/**
 * @package WP-Losungen-SQL
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
 
$Plugin_Prefix = 'tahhl_';

$TAHHL_CopyRight = "
    	<p class=\"tahhl-losung-copy\">
		<a href=\"http://www.herrnhuter.de\" target=\"_blank\" title=\"Evangelische Br&uuml;der-Unit&auml;t\">&copy; Evangelische Br&uuml;der-Unit&auml;t – Herrnhuter Br&uuml;dergemeine</a> <br>
		<a href=\"https://www.losungen.de\" target=\"_blank\" title=\"www.losungen.de\">Weitere Informationen finden Sie hier</a>
";

/* 
 ----------------------------------------------------------------
 
 Die Labels für die Parameter der Widgets und Einstellungsseite
 
 ----------------------------------------------------------------
*/

$TAHHL_DefLabels = 
  array ( 
    'title'		=> 'Titel',
    'DownloadURL'	=> 'DownloadURL'
    );

$TAHHL_DownloadSettingNames =
  array ( 
    'title'		=> 'Titel',
    'DownloadURL'	=> 'DownloadURL'
  );

/*
 ----------------------------------------------------------------
 Default Werte für die Widgets und Shortcodes!
  
 ----------------------------------------------------------------
*/

$TAHHL_DefValues = 
  array ( 
    'title'		=> 'DIE LOSUNGEN',
    'DownloadURL'   => 'https://www.losungen.de/fileadmin/media-losungen/download/Losung_%s_XML.zip'

  );

?>
