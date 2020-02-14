<?php
/**
 * lib/class-wget.php
 *
 * @link    http://byggvir.de
 * @since   2019.1.0
 * @version 2019.1.0
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @plugin-wordpress
 *
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @package  tahhl
 */


/**
 * Security check: Exit if script is called directly
 */
class tahhl_getcsv {

	public $retcode ;

	/**
	 * Construct the class
	 */
	private function __constrtruct(  ) {

		$this->lastget = "" ;

	}


	/**
	 * Get the Body of a xml page
	 *
	 * @param string  $url
	 * @return string ( HTML )
	 */	 
	public function get( $url ) {

		global $wp_version ;
		
		$args = array (
			'timeout' => 5,
			'redirection' => 5,
			'httpversion' => '1.1',
			'user-agent' => 'WordPress/' . $wp_version . ' ; ' . home_url (  ) ,
			'blocking' => true,
			'headers' => array (  ) ,
			'cookies' => array (  ) ,
			'body' => null,
			'compress' => false,
			'decompress' => true,
			'sslverify' => true,
			'stream' => false,
			'filename' => null
		)  ;
		
		$response = wp_remote_get ( $url ) ;
		if ( is_array( $response )  ) {
			$this->retcode = wp_remote_retrieve_response_code( $response );
			return $response['body'] ;
			
		} else {

            return '' ;

		}


} // End class tahhl_getxml

?>
