<?php
/**
 * WP Help Modifications
 */

/* Styles
==============================================================================*/

/**
 * Load custom CSS in Admin
 */
function joe_upm_wp_help_enqueue_admin_styles() {

	$current_screen = get_current_screen();

	// If on the wp-help-documents admin screen
	if ( strpos( $current_screen->id, 'wp-help-documents' ) !== FALSE ) {

		$pluginbase = basename( __DIR__ );
		$handle     = JOE_UPM_PREFIX . '-' . $pluginbase;
		$deps       = array( 'cws-wp-help' );

		wp_register_style( $handle, plugin_dir_url( __FILE__ ) . 'css/' . $pluginbase . '-mods.css', $deps, JOE_UPM_VER );
		wp_enqueue_style( $handle );

	}

}
add_action( 'admin_enqueue_scripts', 'joe_upm_wp_help_enqueue_admin_styles' );