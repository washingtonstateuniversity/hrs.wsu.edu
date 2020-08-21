<?php
/**
 * Manages HRSWP Theme taxonomy.
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\taxonomy;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Creates the HRS taxonomies.
 *
 * Uses the WP taxonomy API to create custom taxonomy for the HRS site,
 * {@see register_taxonomy}.
 *
 * @since 0.14.0
 */
function register_taxonomies() {
	// Create the HRS Unit taxonomy.
	$labels = array(
		'name'              => _x( 'HRS Units', 'taxonomy general name', 'hrswp-theme' ),
		'singular_name'     => _x( 'HRS Unit', 'taxonomy singular name', 'hrswp-theme' ),
		'all_items'         => __( 'All Units', 'hrswp-theme' ),
		'edit_item'         => __( 'Edit Unit', 'hrswp-theme' ),
		'view_item'         => __( 'View Unit', 'hrswp-theme' ),
		'update_item'       => __( 'Update Unit', 'hrswp-theme' ),
		'add_new_item'      => __( 'Add New Unit', 'hrswp-theme' ),
		'new_item_name'     => __( 'New Unit Name', 'hrswp-theme' ),
		'parent_item'       => __( 'Parent Unit', 'hrswp-theme' ),
		'parent_item_colon' => __( 'HRS Unit: ', 'hrswp-theme' ),
		'search_items'      => __( 'Search Units', 'hrswp-theme' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true, // Required for Gutenberg < 3.2.0 to show tax on edit post screen.
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'hrs-units',
		),
	);

	register_taxonomy( 'hrs_unit', array( 'post', 'document' ), $args );
}
add_action( 'init', __NAMESPACE__ . '\register_taxonomies', 0 );
