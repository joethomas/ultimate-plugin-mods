<?php
/*
	Plugin Name: Ultimate Plugin Mods
	Description: This plugin contains useful modifications for various oft-used plugins, including Gravity Forms, Popup Maker, and WP Help.
	Plugin URI: https://github.com/joethomas/ultimate-plugin-mods
	Version: 1.2.2
	Author: Joe Thomas
	Author URI: https://github.com/joethomas
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	Text Domain: ultimate-plugin-mods
	Domain Path: /languages/

	GitHub Plugin URI: https://github.com/joethomas/ultimate-plugin-mods
	GitHub Branch: master
*/

// Prevent direct file access
defined( 'ABSPATH' ) or exit;


/* Global Variables & Constants
==============================================================================*/

/**
 * Define the constants for use within the plugin
 */

// Plugin
function joe_upm_get_plugin_data_version() {
	$plugin = get_plugin_data( __FILE__, false, false );

	define( 'JOE_UPM_VER', $plugin['Version'] );
	define( 'JOE_UPM_TEXTDOMAIN', $plugin['TextDomain'] );
	define( 'JOE_UPM_NAME', $plugin['Name'] );
}
add_action( 'init', 'joe_upm_get_plugin_data_version' );

define( 'JOE_UPM_PREFIX', 'ultimate-plugin-mods' );


/* Bootstrap
==============================================================================*/

require_once( 'includes/plugins-bootstrap.php' ); // controls bootstrapping for plugin mods
require_once( 'includes/updates.php' ); // controls plugin updates


/* Languages
==============================================================================*/

/**
 * Load text domain for plugin translations
 */
function joe_upm_load_textdomain() {
	load_plugin_textdomain( 'ultimate-plugin-mods', false, basename( __DIR__ ) . '/languages/' );
}
add_action( 'plugins_loaded', 'joe_upm_load_textdomain' );
