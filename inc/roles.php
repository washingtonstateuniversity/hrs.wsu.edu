<?php
/**
 * Manages HRSWP Theme user roles.
 *
 * @package HrswpTheme
 * @since 3.1.0
 */

namespace HrswpTheme\inc\roles;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Adds the Content Manager user role.
 *
 * Callback for the `after_switch_theme` action hook, which assures this
 * only fires on theme activation because it only needs to happen once.
 *
 * @uses add_role()
 *
 * @since 3.1.0
 */
function add_roles() {
	$content_manager_capabilities =

	add_role(
		'content_manager',
		'Content Manager',
		array(
			'delete_others_pages'    => false,
			'delete_others_posts'    => false,
			'delete_pages'           => false,
			'delete_posts'           => false,
			'delete_private_pages'   => false,
			'delete_private_posts'   => false,
			'delete_published_pages' => false,
			'delete_published_posts' => false,
			'edit_others_pages'      => true,
			'edit_others_posts'      => true,
			'edit_pages'             => true,
			'edit_posts'             => true,
			'edit_private_pages'     => true,
			'edit_private_posts'     => true,
			'edit_published_pages'   => true,
			'edit_published_posts'   => true,
			'manage_categories'      => true,
			'manage_links'           => true,
			'moderate_comments'      => true,
			'publish_pages'          => true,
			'publish_posts'          => true,
			'read_private_pages'     => true,
			'read_private_posts'     => true,
			'read'                   => true,
			'unfiltered_html'        => true,
			'upload_files'           => true,
		)
	);
}

add_action( 'after_switch_theme', __NAMESPACE__ . '\add_roles' );
