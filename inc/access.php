<?php
/**
 * Manages HRS access.
 *
 * @package HrswpTheme
 */

namespace HrswpTheme\inc\access;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Requires users log in to access frontend as well as backend.
 *
 * @since 3.5.0
 *
 * @see nocache_headers
 * @see auth_redirect
 * @return void
 */
add_action(
	'template_redirect',
	function (): void {
		global $pagenow;

		// Double-check that login is required.
		if ( '1' !== get_option( 'hrswp_theme_require_login' ) ) {
			return;
		}

		// Allow AJAX, Cron, and WP-CLI to run as usual.
		if (
			( defined( 'DOING_AJAX' ) && DOING_AJAX ) ||
			( defined( 'DOING_CRON' ) && DOING_CRON ) ||
			( defined( 'WP_CLI' ) && WP_CLI )
		) {
			return;
		}

		// Exit early if user is logged in or this is the login page.
		if ( is_user_logged_in() || 'wp-login.php' === $pagenow ) {
			return;
		}

		// Set headers to prevent caching and redirect unauthorized users.
		nocache_headers();
		auth_redirect();
		exit();
	}
);

/**
 * Restricts access to the WP REST API to logged-in users.
 *
 * @param WP_Error|null|bool $errors WP_Error if authentication error, null if authentication method wasn't used, true if authentication succeeded.
 * @return WP_Error|void Returns a WP_Error is the user is not logged in.
 */
add_filter(
	'rest_authentication_errors',
	function ( $errors ) {
		if ( null === $errors && ! is_user_logged_in() ) {
			return new \WP_Error(
				'rest_unauthorized',
				__( 'Access to the REST API is restricted.', 'hrswp-theme' ),
				array( 'status' => rest_authorization_required_code() )
			);
		}
	},
	99
);
