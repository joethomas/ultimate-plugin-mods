<?php
/* Plugins Check
==============================================================================*/

function joe_upm_plugins_check() {

	// Set constants for active third party plugins
	define( 'JOE_UPM_AUTOPTIMIZE_ACTIVE', class_exists( 'autoptimizeBase' ) );
	define( 'JOE_UPM_GRAVITY_FORMS_ACTIVE', class_exists( 'RGForms' ) );
	define( 'JOE_UPM_POPUP_MAKER_ACTIVE', class_exists( 'Popup_Maker' ) );
	define( 'JOE_UPM_WP_HELP_ACTIVE', class_exists( 'CWS_WP_Help_Plugin' ) );

	// Bootstrap third party plugin modification files
	joe_upm_plugins_bootstrap();

}
add_action( 'plugins_loaded', 'joe_upm_plugins_check' );


/* Plugin Mods Bootstrap
==============================================================================*/

function joe_upm_plugins_bootstrap() {

	// Autoptimize
	if ( JOE_UPM_AUTOPTIMIZE_ACTIVE ) {
		require_once( 'plugins/autoptimize/config-autoptimize.php' );
	}
	
	// Gravity Forms
	if ( JOE_UPM_GRAVITY_FORMS_ACTIVE ) {
		require_once( 'plugins/gravityforms/config-gravityforms.php' );
	}

	// Popup Maker
	if ( JOE_UPM_POPUP_MAKER_ACTIVE ) {
		require_once( 'plugins/popup-maker/config-popup-maker.php' );
	}

	// WP Help
	if ( JOE_UPM_WP_HELP_ACTIVE ) {
		require_once( 'plugins/wp-help/config-wp-help.php' );
	}

}