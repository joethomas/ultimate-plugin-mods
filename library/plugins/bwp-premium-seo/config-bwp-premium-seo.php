<?php
/**
 * Blackwood Premium SEO Modifications
 */

/* Styles
==============================================================================*/

/**
 * Load custom CSS
 */
function joeupmods_bwp_premium_seo_enqueue_styles() {

	$pluginbase = basename(__DIR__);
	$handle     = JOEUPMODS_PREFIX . '-' . $pluginbase;
	$deps       = array();

	if ( is_home() || is_front_page() ) {

		wp_register_style( $handle, plugin_dir_url(__FILE__) . $pluginbase . '-mods.css', $deps, JOEUPMODS_VER );
		wp_enqueue_style( $handle );

	}

}
add_action( 'wp_enqueue_scripts', 'joeupmods_bwp_premium_seo_enqueue_styles' );


/* Admin
==============================================================================*/

/**
 * Remove Blackwood SEO admin menu item
 */
function joe_remove_bwp_premium_seo_menu_item() {
	remove_menu_page( 'seo_automation' );
}
add_action( 'admin_menu', 'joe_remove_bwp_premium_seo_menu_item' );

/**
 * Modify Blackwood SEO admin user info
 */
function joeupmods_bwp_premium_seo_modify_seo_user_info() {

	$bwp_email = 'info@blackwood.productions';
	$user = get_user_by( 'email', $bwp_email );

	if ( $user ) {

		$author      = $user->ID;
		$nicename    = 'greententseo';
		$url         = 'http://www.greentent.com';
		$email       = 'seo@greentent.com';
		$displayname = 'GreenTent';
		$nickname    = 'greententseo';
		$firstname   = 'GreenTent SEO';
		$lastname    = '';
		$role        = 'administrator';

		update_option( 'seo_automation_owner_id', $author );
		wp_update_user( array( 'ID' => $author, 'user_nicename' => $nicename, 'user_url' => $url, 'user_email' => $email, 'display_name' => $displayname, 'nickname' => $nickname, 'first_name' => $firstname, 'last_name' => $lastname, 'role' => $role ) );

	}

}
add_action( 'wp_login', 'joeupmods_bwp_premium_seo_modify_seo_user_info' );