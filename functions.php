<?php

/**
 * Tracks HRS Child Theme Version
 *
 * @since 0.7.0
 */
$hrs_child_theme_version = '0.7.0';

add_action( 'wp_enqueue_scripts', 'hrs_enqueue_scripts');
/*
 * Enqueue custom scripting in child theme.
 */
function hrs_enqueue_scripts() {
	wp_enqueue_script( 'hrs-custom', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), spine_get_script_version(), true );
	/*wp_enqueue_script( 'multi-column', get_stylesheet_directory_uri() . '/js/css3-multi-column.js', array( 'jquery' ), spine_get_script_version(), true );
*/
}
/*
 * Add HTML5 search box
 */
add_action( 'after_setup_theme', 'hrs_html_support' );

function hrs_html_support() {
	add_theme_support( 'html5', array( 'header-search-input' ) );
	register_nav_menu( 'hrs-common-search', 'Common Search' );
}
