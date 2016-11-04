<?php

/* Plugins Check
==============================================================================*/

function joeupmods_plugins_check() {

	// Set constants for active third party plugins
	define( 'JOEUPMODS_BLACKWOOD_PREMIUM_SEO_ACTIVE', function_exists( 'seo_automation_return_domain' ) );
	define( 'JOEUPMODS_GRAVITY_FORMS_ACTIVE', class_exists( 'RGForms' ) );
	define( 'JOEUPMODS_POPUP_MAKER_ACTIVE', class_exists( 'Popup_Maker' ) );
	define( 'JOEUPMODS_SLIDER_REVOLUTION_ACTIVE', class_exists( 'RevSlider' ) );
	define( 'JOEUPMODS_THE_EVENTS_CALENDAR_ACTIVE', class_exists( 'Tribe__Events__Main' ) );
	define( 'JOEUPMODS_VISUAL_COMPOSER_ACTIVE', class_exists( 'Vc_Manager' ) );
	define( 'JOEUPMODS_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
	define( 'JOEUPMODS_WP_HELP_ACTIVE', class_exists( 'CWS_WP_Help_Plugin' ) );

	// Bootstrap third party plugin modification files
	joeupmods_plugins_bootstrap();

}
add_action( 'plugins_loaded', 'joeupmods_plugins_check' );


/* Plugin Mods Bootstrap
==============================================================================*/

function joeupmods_plugins_bootstrap() {

	// Blackwood Premium SEO
	if ( JOEUPMODS_BLACKWOOD_PREMIUM_SEO_ACTIVE ) {
		require_once( JOEUPMODS_PLUGINS_DIR .'/bwp-premium-seo/config-bwp-premium-seo.php' );
	}

	// Gravity Forms
	if ( JOEUPMODS_GRAVITY_FORMS_ACTIVE ) {
		require_once( JOEUPMODS_PLUGINS_DIR .'/gravityforms/config-gravityforms.php' );
	}

	// Popup Maker
	if ( JOEUPMODS_POPUP_MAKER_ACTIVE ) {
		require_once( JOEUPMODS_PLUGINS_DIR .'/popup-maker/config-popup-maker.php' );
	}

	// Slider Revolution
	if ( JOEUPMODS_SLIDER_REVOLUTION_ACTIVE ) {
		require_once( JOEUPMODS_PLUGINS_DIR .'/revslider/config-revslider.php' );
	}

	// The Events Calendar
	if ( JOEUPMODS_THE_EVENTS_CALENDAR_ACTIVE ) {
		require_once( JOEUPMODS_PLUGINS_DIR .'/the-events-calendar/config-the-events-calendar.php' );
	}

	// Visual Composer
	if ( JOEUPMODS_VISUAL_COMPOSER_ACTIVE ) {
		require_once( JOEUPMODS_PLUGINS_DIR .'/js_composer/config-js_composer.php' );
	}

	// WooCommerce
	if ( JOEUPMODS_WOOCOMMERCE_ACTIVE ) {
		require_once( JOEUPMODS_PLUGINS_DIR .'/woocommerce/config-woocommerce.php' );
	}

	// WP Help
	if ( JOEUPMODS_WP_HELP_ACTIVE ) {
		require_once( JOEUPMODS_PLUGINS_DIR .'/wp-help/config-wp-help.php' );
	}

}