<?php
/**
 * WSU Human Resources Services functions and definitions
 *
 * Defines the primary HRS child theme variables and methods, these are all
 * loaded after the main Spine parent theme methods. The bulk of the child theme
 * setup happens in the required 'class-hrs-theme-setup.php' file. This class
 * also includes secondary methods such as shortcode and template tag files.
 *
 * @package HrswpTheme
 * @since 0.1.0
 */

namespace HrswpTheme;

pre_init();

/**
 * Registers the HRS theme WordPress menus.
 *
 * Creates locations for two menus, one in the expandable search section in
 * the site headers, and the other in the site footer just above the site
 * reference section. HRS also uses a "Site" and "Offsite" menu, both of
 * which are registered in the Spine parent theme. "Offsite" displays in the
 * Spine by default, underneath the main BU navigation links.
 *
 * @since 0.12.0
 * @since 2.0.0 Moved out of setup class.
 */
function theme_nav_menus() {
	register_nav_menus(
		array(
			'hrs-search-menu' => __( 'Search Menu', 'hrswp-theme' ),
			'hrs-site-footer' => __( 'Site Footer', 'hrswp-theme' ),
			'site-reference'  => __( 'Site Reference (Footer)', 'hrswp-theme' ),
		)
	);
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\theme_nav_menus' );

/**
 * Modifies theme support for features provided by WordPress.
 *
 * Gallery and caption HTML5 support is already added in the Spine parent
 * theme, so all we need to do is add the search form support to the array.
 * For Block editor settings see https://wordpress.org/gutenberg/handbook/extensibility/theme-support/.
 *
 * @since 0.12.0
 */
function theme_supports() {
	add_theme_support( 'html5', array( 'search-form' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\theme_supports' );

/**
 * Retrieves the version number from the main stylesheet headers.
 *
 * Gets the headers values from the WP_Theme object {@uses wp_get_theme()}.
 *
 * @since 0.17.3
 *
 * @return string The HRS Theme version.
 */
function get_version() {
	$version = wp_get_theme()->get( 'Version' );

	return $version;
}

/**
 * Display a version notice.
 *
 * @since 2.0.0
 */
function wordpress_version_notice() {
	print_f(
		'<div class="error><p>%s</p></div>',
		__( 'The HRS theme requires WordPress 5.0.0 or later to function properly. Please upgrade WordPress before activating the HRS Theme', 'hrswp-theme' )
	);

	// @TODO deactivate theme.
}

/**
 * Verify the theme dependencies are present, then load it.
 *
 * @since 2.0.0
 */
function pre_init() {
	global $wp_version;

	// Get unmodified $wp_version.
	include ABSPATH . WPINC . '/version.php';

	// Remove '-src' from the version string for `version_compare()`.
	$version = preg_replace( '/-[A-Za-z-0-9]*$/', '', $wp_version );

	if ( version_compare( $version, '5.0.0', '<' ) ) {
		add_action( 'admin_notices', __NAMESPACE__ . '\wordpress_version_notice' );
		return;
	}

	require dirname( __FILE__ ) . '/lib/load.php';
}
