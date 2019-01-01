<?php
/**
 * @package WP-Losungen-SQL
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
 
$Plugin_Prefix = 'tahhl_';



/* 
 ----------------------------------------------------------------
 
 Die Labels für die Parameter der Widgets und Einstellungsseite
 
 ----------------------------------------------------------------
*/

$TAHHL_DefLabels = 
  array ( 
    'title'		=> 'Titel',
    'bible'     => 'Bibelausgabe' ,
    'DownloadURL'	=> 'DownloadURL'
    
    );

$TAHHL_DownloadSettingNames =
  array ( 
    'title'		=> 'Titel',
    'bible'     => 'Bibelausgabe (K&uuml;rzel)' ,
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
    'bible'		=> 'LUT',
    'DownloadURL'   => 'https://www.losungen.de/fileadmin/media-losungen/download/Losung_%s_XML.zip'

  );

?>
