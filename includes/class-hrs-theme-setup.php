<?php
/**
 * HRS Child Theme Setup: HRS_Theme_Setup Class.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.12.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The WSUWP HRS Child Theme setup class.
 *
 * @since 0.12.0
 */
class HRS_Theme_Setup {
	/**
	 * Instantiates HRS Theme Setup singleton.
	 *
	 * @since 0.12.0
	 *
	 * @return object The HRS Theme Setup object
	 */
	public static function get_instance() {
		static $instance = null;

		// Only setup and activate if it hasn't already been done.
		if ( null === $instance ) {
			$instance = new HRS_Theme_Setup();
			$instance->setup_hooks();
			$instance->includes();
		}

		return $instance;
	}

	/**
	 * An empty constructor to prevent HRS Theme Setup loading more than once.
	 *
	 * @since 0.12.0
	 */
	public function __construct() {
		/* Nothing doing :) */
	}

	/**
	 * Loads the WP API and Spine actions and hooks.
	 *
	 * @since 0.12.0
	 *
	 * @access private
	 */
	private function setup_hooks() {
		add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
		add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );
		add_action( 'after_setup_theme', array( $this, 'remove_spine_filters' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ), 0 );

		// Set Spine options.
		add_action( 'after_setup_theme', array( $this, 'get_hrs_spine_schema' ), 5 );
		add_filter( 'spine_get_title', array( $this, 'hrs_get_page_title' ) );
		add_filter( 'spine_enable_builder_module', '__return_true' );
		add_filter( 'spine_option_defaults', array( $this, 'hrs_spine_option_defaults' ) );
		add_filter( 'theme_page_templates', array( $this, 'remove_spine_templates' ) );
	}

	/**
	 * Includes files required by the HRS theme.
	 *
	 * @since 0.13.0
	 *
	 * @access private
	 */
	private function includes() {
		// The HRS documents gallery shortcode.
		require __DIR__ . '/shortcode-document-gallery.php';
		// The HRS last updated label shortcode.
		require __DIR__ . '/shortcode-last-updated.php';
		// The HRS post lists shortcodes.
		require __DIR__ . '/shortcode-post-lists.php';
		// The HRS external content shortcodes.
		require __DIR__ . '/shortcode-external-content.php';
		// The HRS template tags.
		require __DIR__ . '/hrs-template-tags.php';
		// WP database queries.
		require __DIR__ . '/hrs-queries.php';
	}

	/**
	 * Returns the Spine version for this site.
	 *
	 * Retrieves the Spine version if it exists, and calls the setter if it
	 * doesn't. The Spine schema version is used by the Spine parent theme to
	 * provide the most current set of default options for the Spine config.
	 *
	 * @since 0.12.0
	 *
	 * @return string The schema version number
	 */
	public function get_hrs_spine_schema() {
		$hrs_schema = get_option( 'spine_schema', '' );

		if ( '' === $hrs_schema ) {
			$hrs_schema = self::set_hrs_spine_schema();
		}

		return $hrs_schema;
	}

	/**
	 * Sets the Spine schema version for this site.
	 *
	 * @since 0.12.0
	 *
	 * @return string The schema version number
	 */
	public function set_hrs_spine_schema() {
		$hrs_schema = '2.x';

		update_option( 'spine_schema', $hrs_schema );

		return $hrs_schema;
	}

	/**
	 * Updates the Spine options list with HRS's default options.
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
	public function hrs_spine_option_defaults( $spine_options ) {

		// Defaults for the spine options to merge with HRS defaults.
		$spine_defaults = spine_get_option_defaults();

		$hrs_defaults = array(
			'grid_style'              => 'fluid',
			'spine_color'             => 'white',
			'theme_style'             => 'skeletal',
			'large_format'            => ' folio max-1386',
			'crop'                    => true,
			'spineless'               => true,
			'bleed'                   => true,
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

		$spine_options = wp_parse_args( $hrs_defaults, $spine_defaults );

		return $spine_options;
	}

	/**
	 *
	 * @since 1.0.0
	 *
	 * @return array Nested arrays defining font sizes.
	 */
	public function get_default_font_sizes() {
		$font_sizes = array(
			array(
				'name'      => __( 'Small', 'hrs-wsu-edu' ),
				'shortName' => __( 'S', 'hrs-wsu-edu' ),
				'size'      => 16, // SCSS var $font-size-1
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'Normal', 'hrs-wsu-edu' ),
				'shortName' => __( 'N', 'hrs-wsu-edu' ),
				'size'      => 18, // SCSS var $font-size-base
				'slug'      => 'normal',
			),
			array(
				'name'      => __( 'Large', 'hrs-wsu-edu' ),
				'shortName' => __( 'L', 'hrs-wsu-edu' ),
				'size'      => 28.836, // SCSS var $font-size-5
				'slug'      => 'large',
			)
		);

		return $font_sizes;
	}

	/**
	 * Adds theme support for features provided by WordPress.
	 *
	 * Gallery and caption HTML5 support is already added in the Spine parent
	 * theme, so all we need to do is add the search form support to the array.
	 * For Block editor settings see https://wordpress.org/gutenberg/handbook/extensibility/theme-support/.
	 *
	 * @since 0.12.0
	 */
	public function add_theme_support() {
		add_theme_support( 'html5', array( 'search-form' ) );
		add_theme_support( 'gutenberg', array( 'wide-images' => true ) );

		// Disables some custom Gutenberg block options.
		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'disable-custom-font-sizes' );

		// By calling an empty array, we disable the Gutenberg custom color selector entirely.
		add_theme_support( 'editor-color-palette', array() );

		// Adjust the block editor default font sizes.
		add_theme_support( 'editor-font-sizes', array( $this, 'get_default_font-sizes' ) );
	}

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
	 */
	public function register_nav_menus() {
		register_nav_menus(
			array(
				'hrs-search-menu' => __( 'Search Menu', 'hrs-wsu-edu' ),
				'hrs-site-footer' => __( 'Site Footer', 'hrs-wsu-edu' ),
			)
		);
	}

	/**
	 * Removes select Spine parent theme filters.
	 *
	 * This must be hooked into `after_setup_theme` because the child theme
	 * functions.php runs before the parent theme functions.php, and therefore
	 * before the parent theme defines these filters.
	 *
	 * @since 0.17.0
	 */
	public function remove_spine_filters() {
		remove_filter( 'get_the_excerpt', 'spine_trim_excerpt', 5 );
	}

	/**
	 * Creates the HRS taxonomies.
	 *
	 * Uses the WP taxonomy API to create custom taxonomy for the HRS site,
	 * {@see register_taxonomy}.
	 *
	 * @since 0.14.0
	 */
	public function register_taxonomies() {

		// Create the HRS Unit taxonomy.
		$labels = array(
			'name'              => _x( 'HRS Units', 'taxonomy general name', 'hrs-wsu-edu' ),
			'singular_name'     => _x( 'HRS Unit', 'taxonomy singular name', 'hrs-wsu-edu' ),
			'all_items'         => __( 'All Units', 'hrs-wsu-edu' ),
			'edit_item'         => __( 'Edit Unit', 'hrs-wsu-edu' ),
			'view_item'         => __( 'View Unit', 'hrs-wsu-edu' ),
			'update_item'       => __( 'Update Unit', 'hrs-wsu-edu' ),
			'add_new_item'      => __( 'Add New Unit', 'hrs-wsu-edu' ),
			'new_item_name'     => __( 'New Unit Name', 'hrs-wsu-edu' ),
			'parent_item'       => __( 'Parent Unit', 'hrs-wsu-edu' ),
			'parent_item_colon' => __( 'HRS Unit: ', 'hrs-wsu-edu' ),
			'search_items'      => __( 'Search Units', 'hrs-wsu-edu' ),
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
	public function hrs_get_page_title( $title ) {
		$page_title   = wp_title( '-', false, 'right' );
		$site_title   = get_bloginfo( 'name' );
		$global_title = ', Washington State University';

		$title = $page_title . $site_title . $global_title;

		return $title;
	}

	/**
	 * Removes selected Spine parent theme templates.
	 *
	 * @since 0.17.7
	 */
	public function remove_spine_templates( $templates ) {
		unset( $templates['templates/single.php'] );
		unset( $templates['templates/blank.php'] );
		unset( $templates['templates/section-label.php'] );

		return $templates;
	}

}

/**
 * Creates an instance of the HRS Theme Setup class.
 *
 * Use this function like you might use a global variable or a direct call to
 * `HRS_Theme_Setup::get_instance()`. This is a variation of the singleton
 * design pattern to make sure setup only runs once.
 *
 * @since 0.12.0
 *
 * @return object A single HRS Theme Setup instance.
 */
function setup_hrs_theme() {
	return HRS_Theme_Setup::get_instance();
}

setup_hrs_theme();
