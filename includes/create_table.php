<?php

/**
 * @package HHL-Herrnhuter-Losungen
 * @version 2019.0
 * @author Thomas Arend <thomas@arend-rhb.de>
 * @copyright 2019 Thomas Arend Rheinbach Germany
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
 
define ('hhl_db_tab', 'hhl_losungen');
define ('hhl_db_version','2019.0');

global $hhl_db_version;
$hhl_db_version = hhl_db_version;

function hhl_install() {
	global $wpdb;
	global $hhl_db_version;

	$table_name = $wpdb->prefix . hhl_db_tab;
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
        Datum datetime DEFAULT NULL,
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

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'hhl_db_version', $hhl_db_version );
}

function hhl_install_data() {
	global $wpdb;
	
	$table_name = $wpdb->prefix . hht_db_tab;
	
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

register_activation_hook( __FILE__, 'hhl_install' );
register_activation_hook( __FILE__, 'hhl_install_data' );

?>

