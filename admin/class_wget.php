<?php
/**
 * class_wget.php
 *
 * @link    http://byggvir.de
 * @since   2019.0.1
 * @version 2019.0.4
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
 
class tahhl_wget {

	public $lastget ;
	public $error ;



	/**
	 * Construct the class
	 */
	private function __constrtruct(  ) {

		$this->lastget = "" ;

	}


	/**
	 * Get the Body of a page
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
		
		$this->lastget = '';
		
		$response = wp_remote_get ( $url )  ;
		if ( is_array( $response )  ) {
			$this->lastget = $response['body'] ;
		}

		return $this->lastget ;
	}


} // End class tahhl_wget

?>
