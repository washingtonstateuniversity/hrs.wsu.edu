<?php

/**
 * Tracks HRS Child Theme Version
 *
 * @since 0.7.0
 */
$hrs_child_theme_version = '0.10.2';

/**
 * Adds Microsoft SQL Server database connection class.
 */
require_once 'includes/class-msdb-connect.php';

/**
 * Add HRS Child Theme stylesheet.
 *
 * @since 0.7.0
 */
function hrs_enqueue_styles() {
	wp_enqueue_style( 'hrs-child-theme', get_stylesheet_directory_uri() . '/assets/css/style.css', array( 'wsu-spine' ), hrs_get_script_version() );
}
add_action( 'wp_enqueue_scripts', 'hrs_enqueue_styles' );

/**
 * Removes child theme style call from parent theme.
 *
 * @since 0.7.0
 */
function hrs_dequeue_styles() {
	wp_dequeue_style( 'spine-theme-child' );
}
add_action( 'wp_print_styles', 'hrs_dequeue_styles' );

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



/***** start old ******/

add_filter( 'spine_enable_builder_module', '__return_true' );

add_action( 'wp_enqueue_scripts', 'hrs_enqueue_scripts' );
/*
 * Enqueue custom scripting in child theme.
 */
function hrs_enqueue_scripts() {
	wp_enqueue_script( 'hrs-custom', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), spine_get_script_version(), true );
}
/*
 * Add HTML5 search box
 */
add_action( 'after_setup_theme', 'hrs_html_support' );

function hrs_html_support() {
	add_theme_support( 'html5', array( 'header-search-input' ) );
	register_nav_menu( 'hrs-common-search', 'Common Search' );
}

/** Remove lost password **/

function remove_lostpassword_text( $text ) {
	if ( 'Lost your password?' === $text ) {
		$text = '';
	}
	return $text;
}
add_filter( 'gettext', 'remove_lostpassword_text' );


/** Changes to login page **/
function my_login_logo() {
?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
			background-image: url(http://hrs.wsu.edu/wp-content/uploads/2016/09/new-logo.png);
		}
	</style>
<?php
}


add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
	return 'Human Resource Services';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
