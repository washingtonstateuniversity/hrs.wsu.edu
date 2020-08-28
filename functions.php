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
 * Adds theme support for features provided by WordPress.
 *
 * Gallery and caption HTML5 support is already added in the Spine parent
 * theme, so all we need to do is add the search form support to the array.
 * For Block editor settings see https://wordpress.org/gutenberg/handbook/extensibility/theme-support/.
 *
 * @since 0.12.0
 */
function theme_supports() {
	add_theme_support( 'html5', array( 'search-form' ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );

	// Disables some custom Gutenberg block options.
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'editor-gradient-presets', array() );
	add_theme_support( 'disable-custom-font-sizes' );

	// Disable the WP Core block patterns.
	remove_theme_support( 'core-block-patterns' );

	// Only allow certain users to adjust colors.
	if ( ! current_user_can( 'publish_posts' ) ) {

		// Calling an empty array disables the block editor color selector.
		add_theme_support( 'editor-color-palette', array() );

	} else {
		// See Sass globals/_variables for colors.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Brand Crimson', 'hrswp-theme' ),
					'slug'  => 'brand-crimson',
					'color' => '#981e32',
				),
				array(
					'name'  => __( 'Brand Gray', 'hrswp-theme' ),
					'slug'  => 'brand-gray',
					'color' => '#5e6a71',
				),
				array(
					'name'  => __( 'Accent Crimson', 'hrswp-theme' ),
					'slug'  => 'accent-crimson',
					'color' => '#c60c30',
				),
				array(
					'name'  => __( 'Accent Green', 'hrswp-theme' ),
					'slug'  => 'accent-green',
					'color' => '#ada400',
				),
				array(
					'name'  => __( 'Accent Orange', 'hrswp-theme' ),
					'slug'  => 'accent-orange',
					'color' => '#f6861f',
				),
				array(
					'name'  => __( 'Accent Blue', 'hrswp-theme' ),
					'slug'  => 'accent-blue',
					'color' => '#00a5bd',
				),
				array(
					'name'  => __( 'Accent Yellow', 'hrswp-theme' ),
					'slug'  => 'accent-yellow',
					'color' => '#ffb81c',
				),
				array(
					'name'  => __( 'White', 'hrswp-theme' ),
					'slug'  => 'light',
					'color' => '#fdfdfd',
				),
				array(
					'name'  => __( 'Black', 'hrswp-theme' ),
					'slug'  => 'dark',
					'color' => '#191919',
				),
			)
		);
	}

	// Adjust the block editor default font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => __( 'Small', 'hrswp-theme' ),
				'size' => 14.22, // Sass var $font-size-0.
				'slug' => 'small',
			),
			array(
				'name' => __( 'Normal', 'hrswp-theme' ),
				'size' => 18, // Sass var $font-size-base.
				'slug' => 'normal',
			),
			array(
				'name' => __( 'Medium', 'hrswp-theme' ),
				'size' => 22.788, // Sass var $font-size-3.
				'slug' => 'medium',
			),
			array(
				'name' => __( 'Large', 'hrswp-theme' ),
				'size' => 28.836, // Sass var $font-size-5.
				'slug' => 'large',
			),
			array(
				'name' => __( 'Larger', 'hrswp-theme' ),
				'size' => 36.486, // Sass var $font-size-7.
				'slug' => 'larger',
			),
		)
	);
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
