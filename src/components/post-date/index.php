<?php
/**
 * Rendering of the HRSWP Theme post date
 *
 * @package HrswpTheme
 * @since 1.7.0
 * @since 2.0.0 Consolidated into the components directory
 */

namespace HrswpTheme\components\post_date;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Displays the post publication date.
 *
 * Must be used in the Loop.
 *
 * @since 1.7.0
 */
function render() {
	if ( ! in_the_loop() ) {
		return '';
	}

	printf( // phpcs:ignore WordPress.Security.EscapeOutput
		'<time class="article-date" datetime="%1$s">%2$s</time>',
		get_the_date( 'c' ),
		get_the_date()
	);
}
