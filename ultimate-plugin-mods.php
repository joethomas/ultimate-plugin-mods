<?php
/*
	Plugin Name: Ultimate Plugin Mods
	Description: This plugin contains useful modifications for various oft-used plugins, including Gravity Forms, Popup Maker, Slider Revolution, The Events Calendar, Visual Composer, and WooCommerce.
	Plugin URI: https://github.com/joethomas/ultimate-plugin-mods
	Version: 1.0.3
	Author: Joe Thomas
	Author URI: http://joethomas.co
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	Text Domain: ultimate-plugin-mods
	Domain Path: /languages/
*/

// Prevent direct file access
defined( 'ABSPATH' ) or exit;


/* Setup Plugin
==============================================================================*/

/**
 * Define the constants for use within the plugin
 */

// Plugin
function joeupmods_get_plugin_data_version() {
	$plugin = get_plugin_data( __FILE__, false, false );

	define( 'JOEUPMODS_VER', $plugin['Version'] );
	define( 'JOEUPMODS_PREFIX', $plugin['TextDomain'] );
	define( 'JOEUPMODS_NAME', $plugin['Name'] );
}
add_action( 'init', 'joeupmods_get_plugin_data_version' );

// Plugin basename
define( 'JOEUPMODS_BASENAME', plugin_basename(__DIR__) );
define( 'JOEUPMODS_BASENAME_FILE', plugin_basename(__FILE__) );

// Plugin paths
define( 'JOEUPMODS_DIR', untrailingslashit( plugin_dir_path(__FILE__) ) );
define( 'JOEUPMODS_DIR_URI', untrailingslashit( plugin_dir_url(__FILE__) ) );

// Plugin directory paths
define( 'JOEUPMODS_INC_DIR', JOEUPMODS_DIR . '/includes' );
define( 'JOEUPMODS_INC_DIR_URI', JOEUPMODS_DIR_URI . '/includes' );

define( 'JOEUPMODS_LIB_DIR', JOEUPMODS_DIR . '/library' );
define( 'JOEUPMODS_LIB_DIR_URI', JOEUPMODS_DIR_URI . '/library' );

// Third party plugins path
define( 'JOEUPMODS_PLUGINS_DIR', JOEUPMODS_LIB_DIR . '/plugins' );
define( 'JOEUPMODS_PLUGINS_DIR_URI', JOEUPMODS_LIB_DIR_URI . '/plugins' );


/* Bootstrap Files
==============================================================================*/

// Plugin updates
require_once( JOEUPMODS_INC_DIR . '/updates.php' );

// Third party plugin bootstrap
require_once( JOEUPMODS_INC_DIR . '/plugins-bootstrap.php' );


/* Languages
==============================================================================*/

/**
 * Load text domain for plugin translations
 */
function joeupmods_load_textdomain() {
	load_plugin_textdomain( 'ultimate-plugin-mods', FALSE, JOEUPMODS_BASENAME . '/languages/' );
}
add_action( 'plugins_loaded', 'joeupmods_load_textdomain' );

