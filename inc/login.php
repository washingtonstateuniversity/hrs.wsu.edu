<?php
/**
 * Functions modifying the WordPress login page and behavior
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\login;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Changes the login logo link from wordpress.org to the site URL.
 *
 * @since 0.12.0
 *
 * @return string The login logo link URL value.
 */
function login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', __NAMESPACE__ . '\login_logo_url' );

/**
 * Changes the login logo text to the site title.
 *
 * @since 0.12.0
 * @since 3.1.0 switch to `login_headertext` hook
 *
 * @param string $login_header_text The login header logo link text.
 * @return string The login logo text.
 */
function login_logo_url_title( $login_header_text ) {
	$login_header_text = get_bloginfo( 'name' );

	return $login_header_text;
}
add_filter( 'login_headertext', __NAMESPACE__ . '\login_logo_url_title', 10, 1 );

/**
 * Redirects users to the home page on logout.
 *
 * @since 0.3.0
 *
 * @param string $redirect_to           The redirect destination URL.
 * @param string $requested_redirect_to The requested redirect destination URL passed as a parameter.
 * @return string URL of page to redirect users to on logout.
 */
function hrs_logout_redirect_home( $redirect_to, $requested_redirect_to ) {
	// Set requested redirect parameter to the home url.
	$requested_redirect_to = home_url( '/' );

	return $requested_redirect_to;
}
add_filter( 'logout_redirect', __NAMESPACE__ . '\hrs_logout_redirect_home', 10, 2 );
