<?php

/**
 * @package HHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
 
$Plugin_Prefix = 'hhl_';


/* 
 ----------------------------------------------------------------
 
 Die Labels für die Parameter der Widgets und Einstellungsseite
 
 ----------------------------------------------------------------
*/

$HHl_DefLabels = 
  array ( 
    'DownloadURL'   => 'DownloadURL'.
    'id'            => 'Id',
    'Datum'         => 'Datum',
    'Wtag'	     	=> 'Wochentag',
    'Sonntag'		=> 'Sonntag',
    'Losungsvers'	=> 'Losungsvers',
    'Losungstext'	=> 'Losungstext',
    'Lehrstextvres'	=> 'Lehrtextvers',
    'Lehrtext'		=> 'Lehrtext'
    );

$HHL_DownloadSettingNames =
  array ( 
   'DownloadURL'		=> 'Download-URL'
  );

    
$HHL_LosungenSettingNames =
  array ( 
    'id'            => 'Id',
    'Datum'         => 'Datum',
    'Wtag'	     	=> 'Wochentag',
    'Sonntag'		=> 'Sonntag',
    'Losungsvers'	=> 'Losungsvers',
    'Losungstext'	=> 'Losungstext',
    'Lehrstextvres'	=> 'Lehrtextvers',
    'Lehrtext'		=> 'Lehrtext'
    );

/*
 ----------------------------------------------------------------
 Default Werte für die Widgets und Shortcodes!
  
 ----------------------------------------------------------------
*/

$HHL_DefValues = 
  array ( 
    'DownloadURL'   => 'https://www.losungen.de/fileadmin/media-losungen/download/Losung_%s_XML.zip',
    'id'        => '1',
    'Datum'		=> '17.04.1959',
    'Wtag'		=> 'Freitag',
    'Sonntag'		=> '',
    'Losungsvers'		=> '1. Mose 1,1',
    'Losungstext'		=> 'Am Anfang schuf Gott Himmel und Erde.',
    'Lehrstextvres'		=> 'Matt 1,1',
    'Lehrtext'		=> 'Dies ist das Buch der Geschichte Jesu Christi, des Sohnes Davids, des Sohnes Abrahams.'

  );


?>
