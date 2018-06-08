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

		// Only setup and activate the plugin if it hasn't already been done.
		if ( null === $instance ) {
			$instance = new HRS_Theme_Setup();
			$instance->setup_hooks();
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

		// Set Spine options.
		add_action( 'after_setup_theme', array( $this, 'get_hrs_spine_schema' ), 5 );
		add_filter( 'spine_get_title', array( $this, 'hrs_get_page_title' ) );
		add_filter( 'spine_enable_builder_module', '__return_true' );
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
	 * Adds theme support for features provided by WordPress.
	 *
	 * Gallery and caption HTML5 support is already added in the Spine parent
	 * theme, so all we need to do is add the search form support to the array.
	 *
	 * @since 0.12.0
	 */
	public function add_theme_support() {
		add_theme_support( 'html5', array( 'search-form' ) );
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
		register_nav_menus( array(
			'hrs-search-menu' => __( 'Search Menu', 'hrs-wsu-edu' ),
			'hrs-site-footer' => __( 'Site Footer', 'hrs-wsu-edu' ),
		) );
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
