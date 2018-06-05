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
	 * Loads the WP API actions and hooks.
	 *
	 * @since 0.12.0
	 *
	 * @access private
	 */
	private function setup_hooks() {
		// add theme support
		// register nav menu
		// maybe set Spine defaults using its hook?
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
