<?php
/**
 * Plugin Name:  WebWerk Datenschutz
 * Description:  Bindet Matomo datenschutzkonform mit Cookie-Banner ein.
 * Version:      1.0
 * Author:       Andreas Wagner
 *
 * @package WebWerk Datenschutz
 **/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * ACF Definitionen & Funktionen.
 */
require_once plugin_dir_path( __FILE__ ) . 'assets/acf-definitions.php';

/**
 * Functions.
 */
require_once plugin_dir_path( __FILE__ ) . 'functions.php';
