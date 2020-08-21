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
	$word_count = 20;

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
