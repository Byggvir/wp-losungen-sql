<?php
/**
 * includes/postprocess.php
 *
 * @package           WP Losungen SQL
 * @link              http://byggvir.de
 * @since             2019.0.1
 * @version 2019.0.1
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

require_once sprintf("%s/lib.php", dirname(__FILE__));


/**
 *
 * @param unknown $inxml
 * @param unknown $codeplace (optional)
 * @return unknown
 */
function tahhl_postprocess_xml( $inxml , $codeplace = 'article' ) {


	$xml = simplexml_load_string($inxml);
	if ( $xml ) {

		$outhtml = "\n<!-- Beginn der Losung -->\n";
		if ( $xml->count() !== 0 ) {

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
