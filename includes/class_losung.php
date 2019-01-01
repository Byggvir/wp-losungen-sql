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
          $innerhtml  = '<h4 class="tahhl-header">' . $hdate . '</h4>' ."\n";
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
	
	$innerhtml='<table class=tahhl-table"><tr><th class="tahhl-tab-head tahhl-tab-head-datum">Tag</th><th class="tahhl-tab-head tahhl-tab-head-losung">Losung</th><th class="tahhl-tab-head tahhl-tab-head-lehrtext">Lehrtext</th></tr>';
	
	($from != '') ? $sqlfrom = ' Datum >="' . $this->convertDate($from) .'" ' : $sqlfrom ='' ;
	($to != '')   ? $sqlto = ' Datum <="' . $this->convertDate($to) .'" '  : $sqlto = '' ;
	
    ( is_numeric($max)) and ($max>0) ? $limit = " limit $max " : $limit = "";
    
	
	$SQL="select * from losungen ";
	
	if ($sqlfrom !='' or  $sqlto != '') { $SQL .= "where " ; }
	if ($sqlfrom !='' and  $sqlto != '') {
      $SQL .=  $sqlfrom . 'and' . $sqlto ; }
    else {
      $SQL .= $sqlfrom . $sqlto ;
    }
    
	
	$SQL .= $limit . " ;";
	
    $Losungen=$wpdb->get_results( $SQL, ARRAY_A );
	
	if ( $Losungen ) {
		foreach ( $Losungen as $row) {

		  $innerhtml .= '<tr><td class="tahhl-tab-cell tahhl-tab-cell-datum">' . date('D., d.m.Y',strtotime($row['Datum'])) . '</td>'  . "\n";
		  $innerhtml .= '<td class="tahhl-tab-cell tahhl-tab-cell-losung"><p class="tahhl-losungstext">' . $this->convertTextToHtml($row['Losungstext']) . '</p>' . "\n";
		  $innerhtml .= '<p class="tahhl-losungsvers">' .  $this->linkToBibleServer($row['Losungsvers']) . '<p></td>'  . "\n";
		  $innerhtml .= '<td class="tahhl-tab-cell tahhl-tab-cell-lehrtext"><p class="tahhl-lehrtext">' . $this->convertTextToHtml($row['Lehrtext']) . '</p>' . "\n";
		  $innerhtml .= '<p class="tahhl-lehrtextvers">' . $this->linkToBibleServer($row['Lehrtextvers']) . '</p></td></tr>' . "\n";
		}
	}
    $innerhtml .= "</table>\n";
    
	return wptexturize( $innerhtml ) ;
  }
} // End of class

?>
