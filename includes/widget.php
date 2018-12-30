<?php
/**
 * @package HHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

// Security check: Exit if script is called directly

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once(sprintf("%s/global.php", dirname(__FILE__)));
require_once(sprintf("%s/postprocess.php", dirname(__FILE__)));


/**
 Losungen widget for SQL
**/
 
class HHL_Losungen_Widget extends WP_Widget {
	
	/** constructor */
	function __construct() {
		parent::__construct( 
			/* Base ID */ 'hhl_losungen_widget' ,
			/* Name */ 'HHL Losungen Widget' ,
			array( 'description' => 'Zeigt die Losung des Tages an.' ) );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {

      	global
          $HHL_DefLabels ,
      	  $HHL_DownloadSettingNames, 
      	  $HHL_LosungenSettingNames,
      	  $HHL_DefValues;
 
	$wg_atts = $args;

	foreach ( $instance as $key => $value) {
		$wg_atts[$key] = Trim(empty($instance[$key]) ? $HHL_DefValues[$key] : $instance[$key]);
	}	
	$wg_atts['title'] = apply_filters('widget_title', $wg_atts['title']);
	//if ($wg_atts['script'] == '' ) $wg_atts['script'] = 'xml.php';
	// $termine=postprocess_xml(hhl_getlosungen($wg_atts,$HHL_LosungenSettingNames),'widget');

	if ( $wg_atts['title'] )
		echo $wg_atts['title'];
	echo "<p style=\"font-size: x-small;\">Powered by WP Losungen SQL Plugin - &copy Thomas Arend, Rheinbach</p>";

	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {

      	global
          $HHL_DefLabels ,
      	  $HHL_DownloadSettingNames, 
      	  $HHL_LosungenSettingNames,
      	  $HHL_DefValues;
  
	$instance = $old_instance;
	foreach ( $HHL_DefValues as $key => $value ) {
        	$instance[$key] = strip_tags($new_instance[$key]);
	}
     
	return $instance;
}

/** @see WP_Widget::form */
function form( $instance ) {

      	global
          $HHL_DefLabels ,
      	  $HHL_DownloadSettingNames, 
      	  $HHL_LosungenSettingNames,
      	  $HHL_DefValues;
 		
	if ( $instance ) {
		$instance = wp_parse_args( (array) $instance, $HHL_DefValues ); 
        	foreach ( $HHL_DefValues as $key => $value ) {
			$$key	= esc_attr( $instance[ $key ] );
		}
	}
	else {
        	foreach ( $HHL_DefValues as $key => $value ) {
			$$key	= __( $value , 'text_domain' );
		}
	}
	echo '<p>' ;

	foreach ( $HHL_DefValues as $key => $value ) {
	?>
		
	<label for="<?php echo $this->get_field_id($key); ?>"><?php _e($HHL_DefLabels[$key].':'); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" type="text" value="<?php echo $$key; ?>" />

	<?php
	}
	echo '</p>' ;

}

} // class HHL_Losungen_Widget

// register HHL_Losungen_Widget

add_action( 'widgets_init', create_function( '', 'register_widget("HHL_Losungen_Widget");' ) );

?>
