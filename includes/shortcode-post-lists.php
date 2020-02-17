<?php
/**
 * HRS Child Theme Posts Lists: Shortcodes
 *
 * @package WSU_Human_Resources_Services
 * @since 0.13.0
 */

namespace WSU\HRS\Shortcode_Posts_Lists;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_shortcode( 'hrs_recent_posts', __NAMESPACE__ . '\hrs_recent_posts_shortcode' );

/**
 * Shortcode displays the latest HRS posts matching criteria.
 *
 * Sample usage: [hrs_recent_posts]
 *
 * Supported attributes for the shortcode are: 'hrs_unit', 'posts_per_page',
 * 'offset', and 'category'.
 *
 * @since 0.16.0
 *
 * @see \WSU\HRS\Template_Tags\hrs_recent_posts()
 *
 * @param array $atts {
 *     Optional. Arguments to filter retrieval of HRS posts.
 *
 *     @type int $posts_per_page   Total number of posts to display. Default 5. Accepts -1 for all.
 *     @type int $offset           Number of posts to offset return by. Default 0.
 *     @type int|string $category  Category ID or comma-separated list of IDs to include. Detault 0.
 *     @type string $hrs_unit      Slug of the hrs_unit taxonomy term to filter results by. Accepts
 *                                 multiple slugs separated by either commas (to include multiple
 *                                 categories), or plus signs (to require multiple categories).
 *     @type string $style         The style used to display the posts list. If 'cards' posts will
 *                                 display as individual cards in a grid. If 'list' posts will display
 *                                 as a grid row list of flex items. Enter any other value for a custom
 *                                 class or leave empty for no container. Default 'cards'.
 * }
 * @return string HTML content to display the latest HRS posts.
 */
function hrs_recent_posts_shortcode( $atts ) {
	$query = shortcode_atts(
		array(
			'posts_per_page' => 5,
			'offset'         => 0,
			'category'       => 0,
			'hrs_unit'       => '',
			'style'          => 'cards',
		),
		$atts
	);

	ob_start();

	\WSU\HRS\Template_Tags\hrs_recent_posts( $query );

	return ob_get_clean();
}
