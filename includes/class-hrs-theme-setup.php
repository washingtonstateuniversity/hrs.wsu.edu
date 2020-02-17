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
	public function setup_hooks() {
		add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
		add_action( 'after_setup_theme', array( $this, 'add_image_sizes' ) );
		add_filter( 'image_size_names_choose', array( $this, 'add_image_sizes_ui' ) );
		add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );
		add_action( 'after_setup_theme', array( $this, 'remove_spine_filters' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ), 0 );
		add_action( 'init', array( $this, 'register_blocks' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_scripts' ) );
		add_action( 'customize_register', array( $this, 'remove_custom_css_control' ) );

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
	public function includes() {
		// The HRS documents gallery shortcode.
		require __DIR__ . '/shortcode-document-gallery.php';

		// The HRS last updated label shortcode.
		require __DIR__ . '/shortcode-last-updated.php';

		// The HRS post lists shortcodes.
		require __DIR__ . '/shortcode-post-lists.php';

		// The HRS template tags.
		require __DIR__ . '/hrs-template-tags.php';

		// WP database queries.
		require __DIR__ . '/hrs-queries.php';

		// HRS Lazy Load Images.
		require __DIR__ . '/class-lazy-load-images.php';
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

		$spine_options = wp_parse_args( $hrs_defaults, $spine_defaults );

		return $spine_options;
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
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_editor_style( '/assets/css/editor-style.css' );

		// Disables some custom Gutenberg block options.
		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'disable-custom-font-sizes' );

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
						'name'  => __( 'Brand Crimson', 'hrs-wsu-edu' ),
						'slug'  => 'brand-crimson',
						'color' => '#981e32',
					),
					array(
						'name'  => __( 'Brand Gray', 'hrs-wsu-edu' ),
						'slug'  => 'brand-gray',
						'color' => '#5e6a71',
					),
					array(
						'name'  => __( 'Accent Crimson', 'hrs-wsu-edu' ),
						'slug'  => 'accent-crimson',
						'color' => '#c60c30',
					),
					array(
						'name'  => __( 'Accent Green', 'hrs-wsu-edu' ),
						'slug'  => 'accent-green',
						'color' => '#ada400',
					),
					array(
						'name'  => __( 'Accent Orange', 'hrs-wsu-edu' ),
						'slug'  => 'accent-orange',
						'color' => '#f6861f',
					),
					array(
						'name'  => __( 'Accent Blue', 'hrs-wsu-edu' ),
						'slug'  => 'accent-blue',
						'color' => '#00a5bd',
					),
					array(
						'name'  => __( 'Accent Yellow', 'hrs-wsu-edu' ),
						'slug'  => 'accent-yellow',
						'color' => '#ffb81c',
					),
					array(
						'name'  => __( 'White', 'hrs-wsu-edu' ),
						'slug'  => 'light',
						'color' => '#fdfdfd',
					),
					array(
						'name'  => __( 'Black', 'hrs-wsu-edu' ),
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
					'name' => __( 'Small', 'hrs-wsu-edu' ),
					'size' => 14.22, // Sass var $font-size-0.
					'slug' => 'small',
				),
				array(
					'name' => __( 'Normal', 'hrs-wsu-edu' ),
					'size' => 18, // Sass var $font-size-base.
					'slug' => 'normal',
				),
				array(
					'name' => __( 'Medium', 'hrs-wsu-edu' ),
					'size' => 22.788, // Sass var $font-size-3.
					'slug' => 'medium',
				),
				array(
					'name' => __( 'Large', 'hrs-wsu-edu' ),
					'size' => 28.836, // Sass var $font-size-5.
					'slug' => 'large',
				),
				array(
					'name' => __( 'Larger', 'hrs-wsu-edu' ),
					'size' => 36.486, // Sass var $font-size-7.
					'slug' => 'larger',
				),
			)
		);
	}

	/**
	 * Registers additional image sizes.
	 *
	 * @since 1.4.0
	 */
	public function add_image_sizes() {
		add_image_size( 'small', 350, 9999, false );
	}

	/**
	 * Adds custom image sizes to the admin selector UI.
	 *
	 * @since 1.4.0
	 *
	 * @param array $sizes An array of the existing image sizes in string format.
	 * @return array An array of image sizes in string format.
	 */
	public function add_image_sizes_ui( $sizes ) {
		return array_merge(
			$sizes,
			array(
				'small' => __( 'Small', 'hrs-wsu-edu' ),
			)
		);
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
				'site-reference'  => __( 'Site Reference (Footer)', 'hrs-wsu-edu' ),
			)
		);
	}

	/**
	 * Removes select Spine parent theme filters.
	 *
	 * This is hooked into `after_setup_theme` to guarantee the parent theme has
	 * defined the filters but WP has not yet executed them.
	 *
	 * @since 0.17.0
	 */
	public function remove_spine_filters() {
		global $spine_theme_setup;

		remove_action( 'admin_init', array( $spine_theme_setup, 'add_editor_style' ) );
		remove_filter( 'get_the_excerpt', 'spine_trim_excerpt', 5 );
	}

	/**
	 * Removes the Customizer Custom CSS section.
	 *
	 * All CSS should go through GitHub for the HRS theme.
	 *
	 * @since 1.1.0
	 *
	 * @param WP_Customize_Manager $wp_customize WP_Customize_Manager instance.
	 */
	public function remove_custom_css_control( $wp_customize ) {
		$wp_customize->remove_control( 'custom_css' );
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
	 * Registers the HRS blocks.
	 *
	 * @since 1.3.0
	 */
	public function register_blocks() {
		// Register the HRS Notification block.
		register_block_type(
			'hrs-wsu-edu/notifications',
			array(
				'editor_script' => 'hrs-block-editor',
			)
		);

		// Register the HRS Callout block.
		register_block_type(
			'hrs-wsu-edu/callouts',
			array(
				'editor_script' => 'hrs-block-editor',
			)
		);

		// Register the HRS Sidebar block.
		register_block_type(
			'hrs-wsu-edu/sidebar',
			array(
				'editor_script' => 'hrs-block-editor',
			)
		);
	}

	/**
	 * Adds HRS blocks' block editor scripts.
	 *
	 * @since 1.3.0
	 */
	public function enqueue_block_editor_scripts() {
		wp_enqueue_script(
			'hrs-block-editor',
			get_stylesheet_directory_uri() . '/assets/js/blocks.js',
			array(
				'wp-blocks',
				'wp-components',
				'wp-element',
				'wp-editor',
				'wp-dom-ready',
				'wp-edit-post',
				'wp-i18n',
			),
			hrs_get_theme_version(),
			false
		);
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
	 *
	 * @param array $templates Array of page templates. Keys are filenames, values are translated names.
	 * @return array Array of page templates.
	 */
	public function remove_spine_templates( $templates ) {
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
	$hrs_theme_setup = HRS_Theme_Setup::get_instance();
	$hrs_theme_setup->setup_hooks();
	$hrs_theme_setup->includes();

	return $hrs_theme_setup;
}

setup_hrs_theme();
