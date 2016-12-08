<?php
/**
 * Popup Maker Modifications
 */

/* Styles
==============================================================================*/

/**
 * Load custom CSS
 */
function joe_upm_popup_maker_enqueue_styles() {

	$pluginbase = basename( __DIR__ );
	$handle     = JOE_UPM_PREFIX . '-' . $pluginbase;
	$deps       = array();

	// If Popup Maker theme styles are enabled
	if ( ! get_option( 'disable_popup_theme_styles' ) ) {

		$deps       = array( 'popup-maker-site' );

	}

	wp_register_style( $handle, plugin_dir_url( __FILE__ ) . 'css/' . $pluginbase . '-mods.css', $deps, JOE_UPM_VER );
	wp_enqueue_style( $handle );

}
add_action( 'wp_enqueue_scripts', 'joe_upm_popup_maker_enqueue_styles' );