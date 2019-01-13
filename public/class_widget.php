<?php
/**
 * includes/class_losung.php
 *
 * @package           WP Losungen SQL
 * @link              http://byggvir.de
 * @since             2019.0.2
 * @version 2019.0.2
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

/**
 * Losungen widget for SQL
 *
 */
class TAHHL_Losungen_Widget extends WP_Widget {

	/** constructor */
	function __construct() {
		parent::__construct(
			/* Base ID */ 'tahhl_losungen_widget' ,
			/* Name */ 'TAHHL Losungen Widget' ,
			array( 'description' => 'Zeigt die Losung des Tages an.' ) );
	}


	/**
	 *
	 * @see WP_Widget::widget
	 * @param unknown $args
	 * @param unknown $instance
	 */
	function widget( $args, $instance ) {

		global
		$TAHHL_DefLabels ,
		$TAHHL_DownloadSettingNames,
		$TAHHL_LosungenSettingNames,
		$TAHHL_DefValues;

		$wg_atts = $args;

		foreach ( $instance as $key => $value) {
			$wg_atts[$key] = trim(empty($instance[$key]) ? $TAHHL_DefValues[$key] : $instance[$key]);
		}
		// * $wg_atts['title'] = apply_filters('widget_title', $wg_atts['title']);
		

		$API=new TAHHL_Losung_APISQL ();

		echo "<div class=\"tahhl-widget-losung\">";
		if ( $wg_atts['title'] )
			echo '<h3>' . $wg_atts['title'] . '<h3>';
		echo "<div class=\"tahhl-widget-inner\">";
		echo $API->getLosungOfTheDay();
		echo HH_Copyright();
		echo "</div></div>";

	}


	/**
	 *
	 * @see WP_Widget::update
	 * @param unknown $new_instance
	 * @param unknown $old_instance
	 * @return unknown
	 */
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


	/**
	 *
	 * @see WP_Widget::form
	 * @param unknown $instance
	 */
	function form( $instance ) {

		global
		$TAHHL_DefLabels ,
		$TAHHL_DownloadSettingNames,
		$TAHHL_LosungenSettingNames,
		$TAHHL_DefValues;

		if ( $instance ) {
			$instance = wp_parse_args( (array) $instance, $TAHHL_DefValues );
			foreach ( $TAHHL_DefValues as $key => $value ) {
				$$key = esc_attr( $instance[ $key ] );
			}
		}
		else {
			foreach ( $TAHHL_DefValues as $key => $value ) {
				$$key = __( $value , 'text_domain' );
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
