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
 * @since 3.1.0
 */
function add_roles() {
	add_role(
		'content_manager',
		'Content Manager',
		array(
			'delete_others_pages'              => false,
			'delete_others_posts'              => false,
			'delete_pages'                     => false,
			'delete_posts'                     => false,
			'delete_private_pages'             => false,
			'delete_private_posts'             => false,
			'delete_published_pages'           => false,
			'delete_published_posts'           => false,
			'edit_others_pages'                => true,
			'edit_others_posts'                => true,
			'edit_pages'                       => true,
			'edit_posts'                       => true,
			'edit_private_pages'               => true,
			'edit_private_posts'               => true,
			'edit_published_pages'             => true,
			'edit_published_posts'             => true,
			'manage_categories'                => true,
			'manage_links'                     => true,
			'moderate_comments'                => true,
			'publish_pages'                    => true,
			'publish_posts'                    => true,
			'read_private_pages'               => true,
			'read_private_posts'               => true,
			'read'                             => true,
			'unfiltered_html'                  => true,
			'upload_files'                     => true,
			'gravityforms_create_form'         => true,
			'gravityforms_delete_forms'        => false,
			'gravityforms_edit_forms'          => true,
			'gravityforms_preview_forms'       => true,
			'gravityforms_view_entries'        => true,
			'gravityforms_edit_entries'        => true,
			'gravityforms_delete_entries'      => false,
			'gravityforms_view_entry_notes'    => true,
			'gravityforms_edit_entry_notes'    => true,
			'tablepress_edit_tables'           => true,
			'tablepress_delete_tables'         => false,
			'tablepress_list_tables'           => true,
			'tablepress_add_tables'            => true,
			'tablepress_copy_tables'           => true,
			'tablepress_import_tables'         => true,
			'tablepress_export_tables'         => true,
			'tablepress_access_options_screen' => false,
			'tablepress_access_about_screen'   => false,
		)
	);
}

add_action( 'after_switch_theme', __NAMESPACE__ . '\add_roles' );
