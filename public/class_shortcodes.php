<?php
/**
 * includes/class_shortcodes.php
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

require_once plugin_dir_path( __FILE__ ) . 'global.php';
require_once plugin_dir_path( __FILE__ ) . 'class_losung.php';
require_once plugin_dir_path( __FILE__ ) . 'copyright.php';

class TAHHL_ShortCodes {

	/**
	 * Constructor of the class
	 *
	 *
	 * @param NUL
	 */
	public function __construct() {

		// Add the Shortcode

		add_shortcode( 'losung', array($this, 'losung') );
		add_shortcode( 'riddle', array($this, 'riddle') );

	}


	/**
	 *
	 * @param unknown $atts
	 * @return unknown
	 */
	public function losung($atts) {


		global $Plugin_Prefix;

		global
		$TAHHL_DefLabels ,
		$TAHHL_CalenderSettingNames,
		$TAHHL_ServerSettingNames,
		$TAHHL_QuerySettingNames ,
		$TAHHL_DefValues;

		extract(shortcode_atts(array(
					'date' => '',
					'from' => '',
					'to' => '',
					'max' => '0',
				), $atts));

		$show = false;

		$API =  new TAHHL_Losung_APISQL ();

		if ( $date != '' ) {
			$Losung =  $API->getLosungOfTheDay($date);
			$show = true;
		} elseif (($from != '') or ($to != '')) {
			$Losung = $API->getLosungList($from, $to, $max) ;
			$show= false;
		} else {
			$Losung =  $API->getLosungOfTheDay();
			$show = true;
		}


		if ( is_singular () or $show ) {

			$Copyright = HH_CopyRight();

			return "
        <!-- Begin shortcode Losung -->
        <div class=\"tahhl-losungOfTheDay\">
        $Losung
        $Copyright
        </div>
        <!-- End shortcode Losung  -->
      ";
		}
		else { // if is_sigular
			return "<p>Die Losungen ... </p>";
		}
	}

	/**
	 *
	 * @param unknown $atts
	 * @return unknown
	 */

    public function riddle($atts) {


		global $Plugin_Prefix;

		global
		$TAHHL_DefLabels ,
		$TAHHL_CalenderSettingNames,
		$TAHHL_ServerSettingNames,
		$TAHHL_QuerySettingNames ,
		$TAHHL_DefValues;

		extract(shortcode_atts(array(
					'date' => '',
				), $atts));

		$show = false;

		$API =  new TAHHL_Losung_APISQL ();

		if ( $date != '' ) {
			$spruch =  $API->getLehrtext($date);
			$show = true;
		} else {
			$spruch =  $API->getLehrtext();
			$show = true;
		}

        $suchmuster = array();
        $suchmuster[0] = '/ä/';
        $suchmuster[1] = '/ö/';
        $suchmuster[2] = '/ü/';
        $suchmuster[3] = '/Ä/';
        $suchmuster[7] = '/Ö/';
        $suchmuster[5] = '/Ü/';
        $suchmuster[6] = '/ß/';

        $ersetzungen = array();
        $ersetzungen[0] = 'ae';
        $ersetzungen[1] = 'oe';
        $ersetzungen[2] = 'ue';
        $ersetzungen[3] = 'Ae';
        $ersetzungen[4] = 'Oe';
        $ersetzungen[5] = 'Ue';
        $ersetzungen[6] = 'ss';

        $spruch = preg_replace($suchmuster, $ersetzungen, $spruch);		
        $chars = str_split($spruch);

        $riddle = "";
        foreach($chars as $char){
            if ( strpos('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',$char) ){
                $riddle .= '<span class="tahhl_L' . strtoupper($char) . '">' . $char . '</span>';
            }
            else{
                $riddle .= $char;
            }
        }

        $letters = "";
        $chars = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        foreach($chars as $char){
            $letters .= '<button class="tahhl_letter" onClick="tahhl_guess(\'' . $char . '\');" id="tahhl_L' . $char .'">' . $char . '</button> ' . "\n";
        
        }

        $sp = strtoupper($spruch);
        
		if ( is_singular () or $show ) {

			$Copyright = HH_CopyRight();

			return "
        <!-- Begin shortcode lsgriddle -->
        <script>
        spruch = '$sp'; 
        spruch = spruch.replace(/[^A-Za-z]/g,'');
        </script>
        
        <div class=\"tahhl-riddle\">
        
        <p>Err&auml;st Du den Bibelvers?</p>

        <!-- Begin ABC -->
        <div style=\"font-family: monospace,monospace;\">
        $letters
        </div>
        <!-- End ABC -->

        <!-- Begin Vers -->
        <div id=\"tahhl_riddle\" style=\"font-family: monospace,monospace;\">
        $riddle
        </div>
        <!-- End Vers -->
        <div>
        <button class=\"tahhl_refresh\" onClick=\"window.location.reload();\" id=\"tahhl_refresh\">Der Vers noch nicht gelöst!</button>
        </div>
        
        </div>
        <!-- End shortcode riddle  -->
      ";
		}
		else { // if is_sigular
			return "<p>Rätsel</p>";
		}
	}


} // End class

$TAHHL_Shortcodes = new TAHHL_ShortCodes();

?>
