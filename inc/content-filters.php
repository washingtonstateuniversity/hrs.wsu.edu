<?php
/**
 * Functions modifying default WordPress content handling
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\content_filters;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Modifies the WordPress body classes.
 *
 * @since 2.0.0
 *
 * @param string[] $classes An array of body class names.
 * @return string[] An array of body class names.
 */
function update_body_class( $classes ) {
	if ( is_singular() ) {
		$hide_title = get_post_meta( get_the_ID(), 'hrswp_hide_page_title', true );

		if ( '' !== $hide_title ) {
			$classes[] = 'hide-title';
		}
	}

	$environment = wp_get_environment_type();
	if (
		'local' === $environment ||
		'development' === $environment ||
		'staging' === $environment
	) {
		$classes[] = 'environment-' . esc_attr( $environment );
	}

	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\update_body_class' );

/**
 * Sets the default excerpt word count.
 *
 * @since 0.14.0
 *
 * @param int $word_count The maximum number of words. Default 55.
 * @return int The number of words to trim the automatic excerpt to.
 */
function excerpt_length( $word_count ) {
	global $is_feature;

	$word_count = ( $is_feature ) ? 80 : 20;

	return $word_count;
}
add_filter( 'excerpt_length', __NAMESPACE__ . '\excerpt_length' );

/**
 * Removes the default Read More link from excerpts.
 *
 * @since 0.14.0
 *
 * @param string $more_string The string shown within the more link.
 * @return string The string shown within the more link.
 */
function excerpt_more_link_content( $more_string ) {
	$more_string = '<span class="more">&hellip;</span>';

	return $more_string;
}
add_filter( 'excerpt_more', __NAMESPACE__ . '\excerpt_more_link_content' );

/**
 * Removes the "Protected" prefix from protected page titles.
 *
 * @since 2.1.0
 */
function filter_protected_title_format() {
	return '%s';
}
add_filter( 'protected_title_format', __NAMESPACE__ . '\filter_protected_title_format' );

/**
 * Adds a text node to the admin bar with the environment type.
 *
 * @since 3.5.0
 *
 * @param \WP_Admin_Bar $wp_admin_bar The WP_Admin_Bar instance, passed by reference.
 * @return void
 */
add_action(
	'admin_bar_menu',
	function ( \WP_Admin_Bar $wp_admin_bar ): void {
		$environment = wp_get_environment_type();
		switch ( $environment ) {
			case 'local':
				$icon = '🧪';
				break;
			case 'development':
				$icon = '⚗️';
				break;
			case 'staging':
				$icon = '🚀';
				break;
			case 'production':
			default:
				$icon = '🌲';
				break;
		}

		$wp_admin_bar->add_menu(
			array(
				'id'    => 'environment-label',
				'title' => sprintf(
					'<span class="environment-icon" aria-hidden="true">%2$s</span> %1$s',
					/* translators: the name of the WordPress environment */
					esc_html( sprintf( __( '%s Environment', 'hrswp-theme' ), ucfirst( $environment ) ) ),
					esc_html( $icon )
				),
				'href'  => false,
			)
		);
	},
	15
);
