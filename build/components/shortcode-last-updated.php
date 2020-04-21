<?php
/**
 * HRSWP Theme Last Updated Label: Shortcode
 *
 * @package HrswpTheme
 * @since 0.13.0
 * @since 2.0.0 Consolidated into the components directory
 */

namespace HrswpTheme\components\shortcode_last_updated;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Displays the date the post was last modified.
 *
 * Shortcode to return the date a post or page was last updated. Default
 * usage is: [lastupdated]
 *
 * @since 0.13.0
 * @param array $atts {
 *     Optional. Attributes of the hrs last update shortcode.
 *
 *     @type string $tag         Name of HTML tag to wrap the date output in.
 *                               Default `time` for `<time>`.
 *     @type string $class       One or more space-separated class attribute values
 *                               to apply to the element.
 *     @type string $date_format PHP date format. Defaults to the date_format option
 *                               if not specified.
 * }
 * @return string HTML formatted date string.
 */
function hrs_last_update_shortcode( $atts ) {
	$defaults = array(
		'tag'         => 'time',
		'class'       => 'last-updated',
		'date_format' => '',
	);

	$args = shortcode_atts( $defaults, $atts, 'lastupdated' );

	return sprintf(
		/* translators: the last modified date: 1: HTML tag, 2: HTML class value, 3: the modified date */
		__( '<%1$s class="%2$s">%3$s</%1$s>', 'hrswp-theme' ),
		esc_attr( $args['tag'] ),
		esc_attr( $args['class'] ),
		esc_html( get_the_modified_date( $args['date_format'] ) )
	);
}
add_shortcode( 'lastupdated', __NAMESPACE__ . '\hrs_last_update_shortcode' );
