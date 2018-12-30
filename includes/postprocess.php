<?php
/**
 * @package HHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//Security check!

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once(sprintf("%s/lib.php", dirname(__FILE__)));

function postprocess_xml ( $inxml , $codeplace = 'article' ) {

  
  $xml = simplexml_load_string($inxml);
  if ( $xml ) { 
  
  $outhtml = "\n<!-- Beginn der Losung -->\n";
  if ( $xml->count() !== 0 )
  { 

  $outhtml .= "<div class=\"hhl-$codeplace\">Noch zu implementieren</div>\n";
  
  }
  else
    $outhtml .= "<div class=\"hhl-$codeplace\">Schade. Derzeit sind Losungen nicht verfügbar.</div>\n";
  $outhtml .= "<!-- Ende der Losung -->\n"; 
  return $outhtml;
  }
  else
    return $inxml;

}
?>
