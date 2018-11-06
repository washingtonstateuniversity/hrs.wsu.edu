<?php
/**
 * HRS Child Theme Last Updated Label: Shortcode
 *
 * @package WSU_Human_Resources_Services
 * @since 0.13.0
 */

namespace WSU\HRS\Shortcode_Last_Updated;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_shortcode( 'lastupdated', __NAMESPACE__ . '\hrs_last_update_shortcode' );

/**
 * Displays the date the post was last modified.
 *
 * Shortcode to return the date a post or page was last updated. Default
 * usage is: [lastupdated]
 *
 * @since 0.13.0
 * @param $atts {
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
		__( '<%1$s class="%2$s">%3$s</%1$s>' ),
		esc_attr( $args['tag'] ),
		esc_attr( $args['class'] ),
		esc_html( get_the_modified_date( $args['date_format'] ) )
	);
}
