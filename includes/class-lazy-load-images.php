<?php
/**
 * HRS Lazy Load Images: HRS_Lazy_Load_Images Class.
 *
 * Under normal circumstances this would be in its own plugin, but the HRS theme
 * isn't a standard setup. This class modifies WP-created image elements by
 * changing the `src`, `srcset`, and `sizes` attributes into data-* attributes
 * and replacing the actual source with a placeholder image. A JavaScript module
 * {@see /src/assets/js/lazy-images.js} then sets up Intersection Oberver
 * methods to swap the data-* attribute values into the "real" attributes to
 * lazy-load the images. This class is mostly a clone of Automattic's own Lazy
 * Load plugin {@see https://github.com/Automattic/lazy-load}, but with some
 * unneeded options dropped and using vanilla JavaScript instead of jQuery to
 * handle the image replacement.
 *
 * @package WSU_Human_Resources_Services
 * @since 1.0.0
 */

namespace WSU\HRS\Class_Lazy_Load_Images;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The HRS Lazy Load Images class.
 *
 * @since 1.0.0
 */
class HRS_Lazy_Load_Images {
	/**
	 * Whether to lazy load images.
	 *
	 * @since 1.0.0
	 * @var bool
	 */
	protected static $enabled = true;

	/**
	 * Instantiates HRS Lazy Load Images singleton.
	 *
	 * @since 1.0.0
	 *
	 * @return object|false The HRS Lazy Load Images object or false in admin or disabled.
	 */
	public static function get_instance() {
		static $instance = null;

		/*
		 * Only set up and activate if not we're not in the admin area, lazy
		 * loading is enabled, and the class hasn't already been loaded.
		 */
		if ( is_admin() ) {
			return false;
		}

		if ( ! apply_filters( 'hrs_lazy_load_is_enabled', true ) ) {
			self::$enabled = false;
			return false;
		}

		if ( null === $instance ) {
			$instance = new HRS_Lazy_Load_Images();

			// Launch only after `<head>` finishes.
			add_action( 'wp_head', array( __CLASS__, 'setup_hooks' ), 9999 );
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
	 * @since 1.0.0
	 */
	public static function setup_hooks() {
		// Run the content filter callback late so other filters run first.
		add_filter( 'the_content', array( __CLASS__, 'add_image_placeholders' ), 99 );
		add_filter( 'post_thumbnail_html', array( __CLASS__, 'add_image_placeholders' ), 11 );
	}

	/**
	 * Filters image tags for lazy loading.
	 *
	 * Callback function for the `post_thumbnail_html` and `the_content` WP
	 * filter hooks.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content The post thumbnail or content HTML.
	 * @return string The post thumbnail or content HTML with filtered img elements if enabled.
	 */
	public static function add_image_placeholders( $content ) {
		if ( ! self::$enabled ) {
			return $content;
		}

		// Disable lazy loading for feeds and previews.
		if ( is_feed() || is_preview() ) {
			return $content;
		}

		// Don't process content more than once.
		if ( false !== strpos( $content, 'data-src' ) ) {
			return $content;
		}

		// The regex to match images and do the replacement callback.
		$content = preg_replace_callback( '#<(img)([^>]+?)(>(.*?)</\\1>|[\/]?>)#si', array( __CLASS__, 'process_image' ), $content );

		return $content;
	}

	/**
	 * Replaces image tag source attributes with data-* attributes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $matches Image tag components matched by the `add_image_placeholders()` `preg_replace_callback` function.
	 * @return string Image tag HTML with source attributes replaced with data-* attributes and placeholder image.
	 */
	public static function process_image( $matches ) {
		$old_attributes_str = $matches[2];

		// Parse the img tag attributes string into an array while cleaning bad values.
		$old_attributes_kses_hair = wp_kses_hair( $old_attributes_str, wp_allowed_protocols() );

		if ( empty( $old_attributes_kses_hair['src'] ) ) {
			return $matches[0];
		}

		$old_attributes = self::flatten_kses_hair_data( $old_attributes_kses_hair );
		$new_attributes = $old_attributes;

		// Set placeholder and data-src
		$new_attributes['src']      = self::get_placeholder_image_path();
		$new_attributes['data-src'] = $old_attributes['src'];

		// Handle `srcset`
		if ( ! empty( $new_attributes['srcset'] ) ) {
			$new_attributes['data-srcset'] = $old_attributes['srcset'];
			unset( $new_attributes['srcset'] );
		}

		// Handle `sizes`
		if ( ! empty( $new_attributes['sizes'] ) ) {
			$new_attributes['data-sizes'] = $old_attributes['sizes'];
			unset( $new_attributes['sizes'] );
		}

		$new_attributes_str = self::build_attributes_string( $new_attributes );

		return sprintf( '<img %1$s><noscript>%2$s</noscript>', $new_attributes_str, $matches[0] );
	}

	/**
	 * Flattens a multidimensional array of attributes and values into an associative array.
	 *
	 * @since 1.0.0
	 *
	 * @param array $attributes Multidimensional array of image tag attributes and values.
	 * @return array Associative array of image tag attributes and values.
	 */
	private static function flatten_kses_hair_data( $attributes ) {
		$flattened_attributes = array();

		foreach ( $attributes as $name => $attribute ) {
			$flattened_attributes[ $name ] = $attribute['value'];
		}

		return $flattened_attributes;
	}

	/**
	 * Converts an associative array of image attribute-values into a string.
	 *
	 * @since 1.0.0
	 *
	 * @param array $attributes Image tag attributes and values.
	 * @return string HTML-ready string of image attributes.
	 */
	private static function build_attributes_string( $attributes ) {
		$string = array();

		foreach ( $attributes as $name => $value ) {
			if ( '' === $value ) {
				$string[] = sprintf( '%s', $name );
			} else {
				$string[] = sprintf( '%s="%s"', $name, esc_attr( $value ) );
			}
		}

		return implode( ' ', $string );
	}

	/**
	 * Retrieves the path to the placeholder image.
	 *
	 * @since 1.0.0
	 *
	 * @return string The placeholder image URI.
	 */
	private static function get_placeholder_image_path() {
		$placeholder_path = get_stylesheet_directory_uri() . '/assets/images/1x1.trans.gif';

		/**
		 * Filters the HRS Lazy Load Images placeholder image path.
		 *
		 * @since 1.0.0
		 *
		 * @param string $placeholder_path The placeholder image URI.
		 */
		return apply_filters( 'hrs_lazy_load_placeholder_path', $placeholder_path );
	}
}

/**
 * Creates an instance of the HRS Lazy Load Images class.
 *
 * @since 1.0.0
 *
 * @return object A single HRS Lazy Load Images instance.
 */
function hrs_lazy_load_images_init() {
	return HRS_Lazy_Load_Images::get_instance();
}

add_action( 'init', __NAMESPACE__ . '\hrs_lazy_load_images_init' );
