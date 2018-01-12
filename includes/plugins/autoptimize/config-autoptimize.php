<?php
/**
 * Autoptimize Modifications
 */

/* Page Builders
==============================================================================*/

/**
 * Do not optimize frontend pages with page builders when logged in
 *
 * @link https://wordpress.org/plugins/autoptimize/faq/
 */
function joe_upm_autoptimize_pagebuilder_noptimize() {
	if ( is_user_logged_in() ) {
		return true;
	} else {
		return false;
	}
}
add_filter( 'autoptimize_filter_noptimize', 'joe_upm_autoptimize_pagebuilder_noptimize', 10, 0 );