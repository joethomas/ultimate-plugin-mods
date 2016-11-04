<?php
/**
 * WP Help Modifications
 */

/* Styles
==============================================================================*/

/**
 * Load custom CSS
 */
function joeupmods_wp_help_enqueue_admin_styles() {

	$current_screen = get_current_screen();

	// If on the wp-help-documents admin screen
	if ( strpos( $current_screen->id, 'wp-help-documents' ) !== FALSE ) {

		$pluginbase = basename(__DIR__);
		$handle     = JOEUPMODS_PREFIX . '-' . $pluginbase;
		$deps       = array( 'cws-wp-help' );

		wp_register_style( $handle, plugin_dir_url(__FILE__) . $pluginbase . '-mods.css', $deps, JOEUPMODS_VER );
		wp_enqueue_style( $handle );

	}

}
add_action( 'admin_enqueue_scripts', 'joeupmods_wp_help_enqueue_admin_styles' );