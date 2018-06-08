<?php
/**
 * WSU Human Resources Services functions and definitions
 *
 * Defines the primary HRS child theme variables and methods, these are all
 * loaded after the main Spine parent theme methods. The bulk of the child theme
 * setup happens in the required 'class-hrs-theme-setup.php' file. This class
 * also includes secondary methods such as shortcode and template tag files.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.1.0
 */

/**
 * Tracks HRS Child Theme Version
 *
 * @since 0.7.0
 */
$hrs_child_theme_version = '0.13.1';

/**
 * Sets up basic theme configuration and WordPress API settings.
 *
 * @since 0.12.0
 */
require_once 'includes/class-hrs-theme-setup.php';

/**
 * Creates a script version.
 *
 * @since 0.7.0
 */
function hrs_get_script_version() {
	global $hrs_child_theme_version;

	$script_version = $hrs_child_theme_version;

	return $script_version;
}

add_action( 'wp_enqueue_scripts', 'hrs_enqueue_styles', 25 );
/**
 * Add HRS Child Theme stylesheets and scripts.
 *
 * @since 0.7.0
 */
function hrs_enqueue_styles() {
	wp_enqueue_style( 'hrs-child-theme', get_stylesheet_directory_uri() . '/assets/css/style.css', array( 'wsu-spine' ), hrs_get_script_version() );
	wp_enqueue_style( 'source_sans_pro', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,900,900i' );
	wp_enqueue_script( 'hrs-custom', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', array(), spine_get_script_version(), true );
}

add_action( 'wp_print_styles', 'hrs_dequeue_styles' );
/**
 * Removes child theme style call from parent theme.
 *
 * @since 0.7.0
 */
function hrs_dequeue_styles() {
	wp_dequeue_style( 'spine-theme-child' );
}

add_action( 'login_enqueue_scripts', 'hrs_login_styles' );
/**
 * Calls custom CSS on the login page for fancy styling.
 *
 * @since 0.12.0
 */
function hrs_login_styles() {
	wp_enqueue_style( 'hrs-login-style', get_stylesheet_directory_uri() . '/assets/css/login-style.css', false, hrs_get_script_version() );
}

add_filter( 'login_headerurl', 'hrs_login_logo_url' );
/**
 * Changes the login logo link from wordpress.org to hrs.wsu.edu.
 *
 * @since 0.12.0
 *
 * @return string
 */
function hrs_login_logo_url() {
	return home_url();
}

add_filter( 'login_headertitle', 'hrs_login_logo_url_title' );
/**
 * Changes the login logo text to the site title.
 *
 * @since 0.12.0
 *
 * @return string
 */
function hrs_login_logo_url_title() {
	return get_bloginfo( 'name' );
}

add_filter( 'logout_redirect', 'hrs_logout_redirect_home', 10, 3 );
/**
 * Redirects users to the home page on logout.
 *
 * @since 0.3.0
 *
 * @param string $redirect_to The redirect destination URL.
 * @param string $requested_redirect_to The requested redirect destination URL passed as a parameter.
 * @param WP_User $user The WP_User object for the user that's logging out.
 * @return string URL of page to redirect users to on logout.
 */
function hrs_logout_redirect_home( $redirect_to, $requested_redirect_to, $user ) {
	// Set requested redirect parameter to the home url.
	$requested_redirect_to = home_url( '/' );

	return $requested_redirect_to;
}
