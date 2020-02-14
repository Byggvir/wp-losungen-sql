<?php

/**
 * Fired during plugin activation
 *
 * @link       https://byggvir.de
 * @since      1.0.0
 *
 * @package    Tahhl
 * @subpackage Tahhl/includes
 */

define('TAHHL_TABLE', $wpdb->prefix . 'tahhl_losungen');
define('TAHHL_DB_VERSION', '2019.0.1');

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tahhl
 * @subpackage Tahhl/includes
 * @author     Thomas Arend <thomas@arend-rhb.de>
 */
class Tahhl_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

	global $wpdb;
	global $TAHHL_db_version;

	$table_name = TAHHL_TABLE ;

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
        Datum date DEFAULT NULL,
        Wtag varchar(16) DEFAULT NULL,
        Sonntag varchar(255) DEFAULT NULL,
        Losungsvers varchar(64) DEFAULT NULL,
        Losungstext varchar(2048) DEFAULT NULL,
        Lehrtextvers varchar(64) DEFAULT NULL,
        Lehrtext varchar(2048) DEFAULT NULL,
        PRIMARY KEY (datum),
        KEY Losungsvers (Losungsvers),
        KEY Lehrtextvers (Lehrtextvers)
        )  $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	add_option( 'tahhl_db_version', $TAHHL_db_version );
	
	$wpdb->insert(
		$table_name,
		array(
			'Datum' => '17.04.1959',
			'Wtag' => 'Freitag',
			'Sonntag' => '',
			'Losungsvers' => '1. Mose 1,1',
			'Losungstext' => 'Am Anfang schuf Gott Himmel und Erde.',
			'Lehrtextvers' => 'Matt 1,1',
			'Lehrtext' => 'Dies ist das Buch der Geschichte Jesu Christi, des Sohnes Davids, des Sohnes Abrahams.'
		)
	);


	}

}
