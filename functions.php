<?php 

	add_action( 'wp_enqueue_scripts', 'enqueue_scripts');
	/*
 	 * Enqueue custom scripting in child theme.
 	 */
	function enqueue_scripts() {
		wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), spine_get_script_version(), true );

	}
	/* 
	 * Add HTML5 search box
	 */
	add_theme_support( 'html5', array( 'header-search-input' ) );