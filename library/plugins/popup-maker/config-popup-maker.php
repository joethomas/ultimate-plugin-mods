<?php
/**
 * Popup Maker Modifications
 */

/* Styles
==============================================================================*/

/**
 * Load custom CSS
 */
function joeupmods_popup_maker_enqueue_styles() {

	$pluginbase = basename(__DIR__);
	$handle     = JOEUPMODS_PREFIX . '-' . $pluginbase;
	$deps       = array( 'popup-maker-site' );

	wp_register_style( $handle, plugin_dir_url(__FILE__) . $pluginbase . '-mods.css', $deps, JOEUPMODS_VER );
	wp_enqueue_style( $handle );

}
add_action( 'wp_enqueue_scripts', 'joeupmods_popup_maker_enqueue_styles' );