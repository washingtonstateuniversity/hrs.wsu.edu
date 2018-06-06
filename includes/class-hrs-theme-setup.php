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
		// add theme support
		// register nav menu

		// Set Spine options.
		add_action( 'after_setup_theme', array( $this, 'get_hrs_spine_schema' ), 5 );
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
