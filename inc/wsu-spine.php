<?php
/**
 * Functions modifying default WSU Spine parent theme
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\wsu_spine;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Modifies the WSU Spine parent theme after it has been set up.
 *
 * @since 2.0.0
 */
function spine_setup() {
	// Removes select Spine parent theme filters.
	remove_spine_filters();

	// Sets the Spine version for this site.
	set_spine_schema();

	// Enable the Builder module. Set to false when not needed.
	add_filter( 'spine_enable_builder_module', '__return_true' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\remove_spine_filters', 5 );

/**
 * Updates the Spine options list with the HRS theme's default options.
 *
 * Overrides some of the default Spine options (typically set in the
 * Customizer) to align with the HRS child theme. The full HRS defaults are:
 *
 *   'spine_version'             => '2',
 *   'grid_style'                => 'fluid',
 *   'campus_location'           => '',
 *   'spine_color'               => 'white',
 *   'large_format'              => ' folio max-1386', // Max Width 1386px
 *   'theme_style'               => 'skeletal',
 *   'secondary_colors'          => 'default', // Crimson
 *   'theme_spacing'             => 'default', // 2em
 *   'global_main_header_sup'    => '',
 *   'global_main_header_sub'    => '',
 *   'main_header_show'          => true,
 *   'articletitle_show'         => true,
 *   'articletitle_header'       => false,
 *   'broken_binding'            => false,
 *   'bleed'                     => true,
 *   'search_state'              => 'closed',
 *   'crop'                      => true, // Cropped Spine (homepage)
 *   'spineless'                 => true, // Spineless (homepage) checked
 *   'open_sans'                 => '0', // Off
 *   'contact_name'              => 'Washington State University',
 *   'contact_department'        => 'Human Resource Services',
 *   'contact_url'               => 'https://hrs.wsu.edu/',
 *   'contact_streetAddress'     => 'PO Box 641014',
 *   'contact_addressLocality'   => 'Pullman, WA',
 *   'contact_postalCode'        => '99164',
 *   'contact_telephone'         => '509-335-4521',
 *   'contact_email'             => 'hrs@wsu.edu',
 *   'contact_ContactPoint'      => 'http://hrs.wsu.edu/hrs-contacts/',
 *   'contact_ContactPointTitle' => 'Contact Page...',
 *   'archive_content_display'   => 'full',
 *   'social_spot_one_type'      => 'facebook',
 *   'social_spot_one'           => 'https://www.facebook.com/wsuhrs',
 *   'social_spot_two_type'      => 'twitter',
 *   'social_spot_two'           => 'https://twitter.com/wsupullman',
 *   'social_spot_three_type'    => 'linkedin',
 *   'social_spot_three'         => 'https://www.linkedin.com/company/washington-state-university',
 *   'social_spot_four_type'     => 'directory',
 *   'social_spot_four'          => 'https://socialmedia.wsu.edu/',
 *   'post_social_placement'     => 'none',
 *   'show_author_page'          => '0',
 *   'show_breadcrumbs'          => 'top', // Only valid with Breadcrumb NavXT plugin installed.
 *   'front_page_title'          => false,
 *   'page_for_posts_title'      => false,
 *
 * @since 0.14.0
 *
 * @param array $spine_options The list of default Spine options.
 * @return array The updated list of default options.
 */
function hrs_spine_option_defaults( $spine_options ) {
	// Defaults for the spine options to merge with HRS defaults.
	$spine_defaults = spine_get_option_defaults();

	$hrswp_defaults = array(
		'grid_style'              => 'fluid',
		'spine_color'             => 'white',
		'theme_style'             => 'skeletal',
		'large_format'            => ' folio max-1386',
		'crop'                    => true,
		'spineless'               => true,
		'bleed'                   => false,
		'open_sans'               => '0',
		'contact_name'            => 'Washington State University',
		'contact_department'      => 'Human Resource Services',
		'contact_url'             => 'https://hrs.wsu.edu/',
		'contact_streetAddress'   => 'PO Box 641014',
		'contact_addressLocality' => 'Pullman, WA',
		'contact_postalCode'      => '99164',
		'contact_telephone'       => '509-335-4521',
		'contact_email'           => 'hrs@wsu.edu',
		'contact_ContactPoint'    => 'http://hrs.wsu.edu/hrs-contacts/',
		'show_author_page'        => '0',
		'social_spot_one_type'    => 'facebook',
		'social_spot_one'         => 'https://www.facebook.com/wsuhrs',
		'social_spot_two_type'    => 'twitter',
		'social_spot_two'         => 'https://twitter.com/wsupullman',
		'social_spot_three_type'  => 'linkedin',
		'social_spot_three'       => 'https://www.linkedin.com/company/washington-state-university',
		'social_spot_four_type'   => 'directory',
		'social_spot_four'        => 'https://socialmedia.wsu.edu/',
	);

	$spine_options = wp_parse_args( $hrswp_defaults, $spine_defaults );

	return $spine_options;
}
add_filter( 'spine_option_defaults', __NAMESPACE__ . '\hrs_spine_option_defaults' );

/**
 * Filters the Spine page title contents.
 *
 * Adjusts the formatting and punctuation of the default Spine parent theme
 * title, which itself replaces the default `wp_title()`,
 * {@see https://github.com/washingtonstateuniversity/WSUWP-spine-parent-theme/functions.php}
 *
 * @since 0.12.0
 *
 * @param string $title The built title to filter.
 * @return string The contents of the `title` element.
 */
function filter_spine_get_title( $title ) {
	$page_title   = wp_title( '-', false, 'right' );
	$site_title   = get_bloginfo( 'name' );
	$global_title = ', Washington State University';

	$title = $page_title . $site_title . $global_title;

	return $title;
}
add_filter( 'spine_get_title', __NAMESPACE__ . '\filter_spine_get_title' );

/**
 * Removes selected Spine parent theme templates.
 *
 * @since 0.17.7
 *
 * @param array $templates Array of page templates. Keys are filenames, values are translated names.
 * @return array Array of page templates.
 */
function remove_spine_templates( $templates ) {
	unset( $templates['templates/blank.php'] );
	unset( $templates['templates/gutenberg-beta.php'] );
	unset( $templates['templates/halves.php'] );
	unset( $templates['templates/margin-left.php'] );
	unset( $templates['templates/margin-right.php'] );
	unset( $templates['templates/section-label.php'] );
	unset( $templates['templates/side-left.php'] );
	unset( $templates['templates/side-right.php'] );
	unset( $templates['templates/single.php'] );

	return $templates;
}
add_filter( 'theme_page_templates', __NAMESPACE__ . '\remove_spine_templates' );

/**
 * Removes select Spine parent theme filters.
 *
 * This is hooked into `after_setup_theme` to guarantee the parent theme has
 * defined the filters but WP has not yet executed them.
 *
 * @since 0.17.0
 */
function remove_spine_filters() {
	global $spine_theme_setup;
	global $wsu_analytics;

	remove_filter( 'get_the_excerpt', 'spine_trim_excerpt', 5 );

	if ( isset( $spine_theme_setup ) ) {
		remove_action( 'admin_init', array( $spine_theme_setup, 'add_editor_style' ) );
	}

	if ( isset( $wsu_analytics ) ) {
		remove_action( 'admin_head', array( $wsu_analytics, 'display_tag_manager' ), 100 );
	}
}

/**
 * Removes select Spine meta boxes.
 *
 * @since 2.0.0
 */
function remove_spine_meta_boxes() {
	remove_meta_box( 'spine-main-header', 'page', 'advanced' );
}
add_action( 'do_meta_boxes', __NAMESPACE__ . '\remove_spine_meta_boxes' );

/**
 * Includes the HRSWP footer template in the Builder template.
 *
 * @since 2.0.0
 */
function include_hrswp_footer_in_builder() {
	get_template_part( 'build/templates/footer' );
}
add_action( 'spine_theme_template_after_footer', __NAMESPACE__ . '\include_hrswp_footer_in_builder' );

/**
 * Sets the Spine version for this site.
 *
 * Retrieves the Spine version if it exists, and calls the setter if it
 * doesn't. The Spine schema version is used by the Spine parent theme to
 * provide the most current set of default options for the Spine config.
 *
 * @since 0.12.0
 *
 * @return string The schema version number
 */
function set_spine_schema() {
	$hrswp_schema = get_option( 'spine_schema', '' );

	if ( '' === $hrswp_schema ) {
		update_option( 'spine_schema', '2.x' );
	}

	return $hrswp_schema;
}
