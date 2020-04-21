<?php
/**
 * Manages HRSWP Theme meta data and fields.
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\meta;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Registers post meta fields.
 *
 * @since 2.0.0
 */
function register_meta() {
	register_post_meta(
		'',
		'hrswp_hide_page_title',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'boolean',
		)
	);

	register_post_meta(
		'',
		'hrswp_hide_feature_image',
		array(
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'boolean',
		)
	);
}
add_action( 'init', __NAMESPACE__ . '\register_meta' );
