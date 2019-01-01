<?php
/**
 * @package TAHHL-Herrnhuter-Losungen
 * @version 2019.0.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License


 * Author: Thomas Arend
 * Version: 2019.0.0
 * Date: 01.01.2019
 * Author URI: http://byggvir.de/
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 *
 */

// Security check: Exit if script is called directly

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once plugin_dir_path( __FILE__ ) . 'global.php';
require_once plugin_dir_path( __FILE__ ) . 'class_losung.php';
require_once(plugin_dir_path( __FILE__ ) . 'copyright.php');
/**
 Losungen widget for SQL
**/
 
class TAHHL_Losungen_Widget extends WP_Widget {
	
	/** constructor */
	function __construct() {
		parent::__construct( 
			/* Base ID */ 'tahhl_losungen_widget' ,
			/* Name */ 'TAHHL Losungen Widget' ,
			array( 'description' => 'Zeigt die Losung des Tages an.' ) );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {

      	global
          $TAHHL_DefLabels ,
      	  $TAHHL_DownloadSettingNames, 
      	  $TAHHL_LosungenSettingNames,
      	  $TAHHL_DefValues;
 
	$wg_atts = $args;

	foreach ( $instance as $key => $value) {
		$wg_atts[$key] = Trim(empty($instance[$key]) ? $TAHHL_DefValues[$key] : $instance[$key]);
	}	
	$wg_atts['title'] = apply_filters('widget_title', $wg_atts['title']);
	//if ($wg_atts['script'] == '' ) $wg_atts['script'] = 'xml.php';
	// $termine=postprocess_xml(hhl_getlosungen($wg_atts,$TAHHL_LosungenSettingNames),'widget');

	if ( $wg_atts['title'] )
		echo $wg_atts['title'];
    
    $API=new TAHHL_Losung_APISQL ();
    
    echo "<div class=\"tahhl-widget-losung\">";
    echo $API->getLosungOfTheDay();
    echo HH_Copyright();
    echo "</div>";
    
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {

      	global
          $TAHHL_DefLabels ,
      	  $TAHHL_DownloadSettingNames, 
      	  $TAHHL_LosungenSettingNames,
      	  $TAHHL_DefValues;
  
	$instance = $old_instance;
	foreach ( $TAHHL_DefValues as $key => $value ) {
        	$instance[$key] = strip_tags($new_instance[$key]);
	}
     
	return $instance;
}

/** @see WP_Widget::form */
function form( $instance ) {

      	global
          $TAHHL_DefLabels ,
      	  $TAHHL_DownloadSettingNames, 
      	  $TAHHL_LosungenSettingNames,
      	  $TAHHL_DefValues;
 		
	if ( $instance ) {
		$instance = wp_parse_args( (array) $instance, $TAHHL_DefValues ); 
        	foreach ( $TAHHL_DefValues as $key => $value ) {
			$$key	= esc_attr( $instance[ $key ] );
		}
	}
	else {
        	foreach ( $TAHHL_DefValues as $key => $value ) {
			$$key	= __( $value , 'text_domain' );
		}
	}
	echo '<p>' ;

	foreach ( $TAHHL_DefValues as $key => $value ) {
	?>
		
	<label for="<?php echo $this->get_field_id($key); ?>"><?php _e($TAHHL_DefLabels[$key].':'); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" type="text" value="<?php echo $$key; ?>" />

	<?php
	}
	echo '</p>' ;

}

} // class TAHHL_Losungen_Widget

// register TAHHL_Losungen_Widget

add_action( 'widgets_init', create_function( '', 'register_widget("TAHHL_Losungen_Widget");' ) );

?>
