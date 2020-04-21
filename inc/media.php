<?php
/**
 * Functions modifying default WordPress media settings
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\media;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Registers additional image sizes.
 *
 * @since 1.4.0
 */
function add_image_sizes() {
	add_image_size( 'small', 350, 9999, false );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\add_image_sizes' );

/**
 * Adds custom image sizes to the admin selector UI.
 *
 * @since 1.4.0
 *
 * @param array $sizes An array of the existing image sizes in string format.
 * @return array An array of image sizes in string format.
 */
function add_image_sizes_ui( $sizes ) {
	return array_merge(
		$sizes,
		array(
			'small' => __( 'Small', 'hrswp-theme' ),
		)
	);
}
add_filter( 'image_size_names_choose', __NAMESPACE__ . '\add_image_sizes_ui' );
