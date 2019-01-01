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

require_once(plugin_dir_path( __FILE__ ) . '/global.php');
require_once(plugin_dir_path( __FILE__ ) . '/postprocess.php');
require_once(plugin_dir_path( __FILE__ ) . '/hh_copyright.php');

// Function for the shorttag losung


/**
* Define class
* 
* @class TAHHL_Losung_APISQL 
*
*/

class TAHHL_Losung_APISQL {

/**
* Formatiere Markup eines Verses
* 
* @param text $text 
* @return formtierter text
*/
	 
  private function convertTextToHtml($text) {
	$text = preg_replace('#/(.*?:)/#', '<span class="tahhl_einleitung">$1</span>', $text, 1);
	$text = preg_replace('/#(.*?)#/', '<span class="tahhl_hervorhebung">$1</span>', $text);
	
	return $text;
  }

  private function linkToBibleServer($text) {
	$text = preg_replace('#(.*)#', '<a class="tahhl_bibleserverlink" href="https://www.bibleserver.com/text/' . get_option(TAHHL . 'bible', 'LUT') . '/$1" target="_blank">$1</a>', $text, 1);
	
	return $text;
  }

  private function convertDate ( $date = '') {

	if (($timestamp = strtotime($date)) === false) {
       return date('Y-m-d');
    } else {
       return date('Y-m-d', $timestamp);
    }
  
  }

  public function getLosungOfTheDay( $date = '' ) {

	global $wpdb ;
	
	$innerhtml="";
	
	$lday = $this->convertDate ($date);

    $LosungOfTheDay=$wpdb->get_results( "select * from losungen where Datum = '$lday';", ARRAY_A);
	
	if ( $LosungOfTheDay ) {
		foreach ( $LosungOfTheDay as $row) {
          
          ($lday == date('Y-m-d',time())) ? $hdate = 'Die heutige Losung' : $hdate = "Die Losung vom " . date('d.m.Y',strtotime($row['Datum']));
          $innerhtml  = '<h3 class="tahl-header3">' . $hdate . '</h3>' ."\n";
		  $innerhtml .= '<p class="tahhl-losungstext">' . $this->convertTextToHtml($row['Losungstext']) . '</p>' . "\n";
		  $innerhtml .= '<p class="tahhl-losungsvers">' .  $this->linkToBibleServer($row['Losungsvers']) . '</p>'  . "\n";
		  $innerhtml .= '<p class="tahhl-lehrtext">' . $this->convertTextToHtml($row['Lehrtext']) . '</p>' . "\n";
		  $innerhtml .= '<p class="tahhl-lehrtextvers">' . $this->linkToBibleServer($row['Lehrtextvers']) . '</p>' . "\n";
		}
	}

	return wptexturize( $innerhtml ) ;
}

  public function getLosungList ( $from = '', $to ='', $max = 0 ) {

	global $wpdb ;
	
	$innerhtml='<table class=tahhl-table">';
	
	$sqlfrom=$this->convertDate($from);
	$sqlto=$this->convertDate($to);
    
    ( is_numeric($max)) and ($max>0) ? $limit = "limit $max" : $limit = "";
    
	
	$SQL="select *	from losungen where ";
	$SQL .= ' Datum >= "' . $sqlfrom .'" and Datum <= "' . $sqlto .'" ' .$limit . ' ;';
	
    $Losungen=$wpdb->get_results( $SQL, ARRAY_A );
	
	if ( $Losungen ) {
		foreach ( $Losungen as $row) {

		  $innerhtml .= '<tr><td class="tahhl-datum">' . date('D., d.m.Y',strtotime($row['Datum'])) . '</td>'  . "\n";
		  $innerhtml .= '<td class="tahhl-cell tahhl-losungscell"><p class="tahhl-losungstext">' . $this->convertTextToHtml($row['Losungstext']) . '</p>' . "\n";
		  $innerhtml .= '<p class="tahhl-losungsvers">' .  $this->linkToBibleServer($row['Losungsvers']) . '<p></td>'  . "\n";
		  $innerhtml .= '<td class="tahhl-cell tahhl-lehrtextcell"><p class="tahhl-lehrtext">' . $this->convertTextToHtml($row['Lehrtext']) . '</p>' . "\n";
		  $innerhtml .= '<p class="tahhl-lehrtextvers">' . $this->linkToBibleServer($row['Lehrtextvers']) . '</p></td></tr>' . "\n";
		}
	}
    $innerhtml .= "</table>\n";
    
	return wptexturize( $innerhtml ) ;
  }
} // End of class

?>
