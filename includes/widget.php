<?php
/*
  Plugin:	TA-Evangelische-Termine
  Autor:	Thomas Arend / Rheinbach
  E-Mail:	thomas@arend-rhb.de
  Version:	0.6.2
  Stand:	07.02.2016

  EvT Teaser Widget
  -------------------
  Erstellen eines EKiR Teaser Widget für die Anzeige
  der Termine eines EKiR / Evangelischen Terminkalenders
  in einem WordPress Sidebar 
  
  This widget is based on the code example in the Widget_API
  See http://codex.wordpress.org/Widgets_API

  Changes 0.6.2
  First version for github

  Changes 0.6
  - plugin and prefixes renamed
  - widget base on teaser interface deleted

 */

//Security check!
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
require_once(sprintf("%s/global.php", dirname(__FILE__)));
require_once(sprintf("%s/postprocess.php", dirname(__FILE__)));


/**************************************************************************
 Calendar Widget for XML interface to "Evangelische Termine" database
**************************************************************************/
 
class EVT_Calendar_Widget extends WP_Widget {
	
	/** constructor */
	function __construct() {
		parent::WP_Widget( 
			/* Base ID */ 'evt_calendar_widget' ,
			/* Name */ 'EVT Calendar Widget' ,
			array( 'description' => 'Zeigt eine &Uuml;bersicht der Termine eines Veranstalters aus dem Evangelischen Termine Kalender in einem Widget an! ' ) );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {

      	global
	  $EVT_DefLabels ,
      	  $EVT_CalenderSettingNames, 
      	  $EVT_ServerSettingNames,
      	  $EVT_QuerySettingNames ,
      	  $EVT_DefValues;
 
		$wg_atts = $args;

		foreach ( $instance as $key => $value) {
			$wg_atts[$key] = Trim(empty($instance[$key]) ? $EVT_DefValues[$key] : $instance[$key]);
		}	
		$wg_atts['title'] = apply_filters('widget_title', $wg_atts['title']);
		if ($wg_atts['script'] == '' ) $wg_atts['script'] = 'xml.php';
		$termine=postprocess_xml(evt_getevents($wg_atts,$EVT_QuerySettingNames),'widget');

		echo $before_widget;
		if ( $wg_atts['title'] )
			echo $before_title . $wg_atts['title'] . $after_title;
			echo $termine; // Hier ist der richtige Patz um den erzeugten HTML Code auszugeben. 
			echo "<p style=\"font-size: x-small;\">Powered by Evangelische Termine Plugin - &copy Thomas Arend, Rheinbach</p>";

		echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {

      	global
	  $EVT_DefLabels ,
      	  $EVT_CalenderSettingNames, 
      	  $EVT_ServerSettingNames,
      	  $EVT_QuerySettingNames ,
      	  $EVT_DefValues;
  
		$instance = $old_instance;
	        foreach ( $EVT_DefValues as $key => $value ) {
        		$instance[$key] = strip_tags($new_instance[$key]);
		}
     
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {

      	global
	  $EVT_DefLabels ,
      	  $EVT_CalenderSettingNames, 
      	  $EVT_ServerSettingNames,
      	  $EVT_QuerySettingNames ,
      	  $EVT_DefValues;
 		
		if ( $instance ) {
			$instance = wp_parse_args( (array) $instance, $EVT_DefValues ); 
	        	foreach ( $EVT_DefValues as $key => $value ) {
   				$$key	= esc_attr( $instance[ $key ] );
			}
			
		}
		else {
	        	foreach ( $EVT_DefValues as $key => $value ) {
				$$key	= __( $value , 'text_domain' );
			}
		}
		echo '<p>' ;

		foreach ( $EVT_DefValues as $key => $value ) {
		?>
		
		<label for="<?php echo $this->get_field_id($key); ?>"><?php _e($EVT_DefLabels[$key].':'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" type="text" value="<?php echo $$key; ?>" />

		<?php
		}
		echo '</p>' ;

	}

} // class EVT_Calendar_Widget

// register EVT_Calendar_Widget

add_action( 'widgets_init', create_function( '', 'register_widget("EVT_Calendar_Widget");' ) );

?>
