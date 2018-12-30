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
 
class HHL_Losung_Widget extends WP_Widget {
	
	/** constructor */
	function __construct() {
		parent::WP_Widget( 
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

		echo $before_widget;
		if ( $wg_atts['title'] )
			echo $before_title . $wg_atts['title'] . $after_title;
			echo $termine; // Hier ist der richtige Patz um den erzeugten HTML Code auszugeben. 
			echo "<p style=\"font-size: x-small;\">Powered by WP Losungen SQL Plugin - &copy Thomas Arend, Rheinbach</p>";

		echo $after_widget;
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
