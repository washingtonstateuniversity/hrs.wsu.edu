<?php

/**
 * Tracks HRS Child Theme Version
 *
 * @since 0.7.0
 */
$hrs_child_theme_version = '0.12.0-alpha1';

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

/**
 * Add HRS Child Theme stylesheets and scripts.
 *
 * @since 0.7.0
 */
function hrs_enqueue_styles() {
	wp_enqueue_style( 'hrs-child-theme', get_stylesheet_directory_uri() . '/assets/css/style.css', array( 'wsu-spine' ), hrs_get_script_version() );
	wp_enqueue_style( 'source_sans_pro', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,900,900i' );
	wp_enqueue_script( 'hrs-custom', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), spine_get_script_version(), true );
}
add_action( 'wp_enqueue_scripts', 'hrs_enqueue_styles', 25 );

/**
 * Removes child theme style call from parent theme.
 *
 * @since 0.7.0
 */
function hrs_dequeue_styles() {
	wp_dequeue_style( 'spine-theme-child' );
}
add_action( 'wp_print_styles', 'hrs_dequeue_styles' );


/***** start old ******/



/*
 * Add HTML5 search box
 */
add_action( 'after_setup_theme', 'hrs_html_support' );

function hrs_html_support() {
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
