<?php
/**
 * Do not update plugin from WordPress repository
 *
 * @since 1.0.0
 */
function joe_upm_do_not_update_plugin_wp( $r, $url ) {

	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) ) {

		return $r; // Not a plugin update request. Bail immediately.

	}

	$plugins = unserialize( $r['body']['plugins'] );

	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );

	$r['body']['plugins'] = serialize( $plugins );

	return $r;

}
add_filter( 'http_request_args', 'joe_upm_do_not_update_plugin_wp', 5, 2 );