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
add_shortcode( 'filter_form', __NAMESPACE__ . '\js_search_form_shortchode' );

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
 * @param $atts {
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

/**
 * Shortcode displays the search form for filtering table contents.
 *
 * Sample default usage: [filter_form]
 *
 * Sample usage to search the third column with a custom label:
 * [filter_form column="3" label="Filter column"]
 *
 * Supported attributes for the shortcode are: 'column', to designate by number
 * which column to search within; and 'label', to customize the text of the
 * input field label.
 *
 * @see \WSU\HRS\Template_Tags\js_search_form()
 *
 * @since 0.20.0
 *
 * @param $atts {
 *     Optional. Arguments to customize the display and behavior of the search form.
 *
 *     @type int    $column The column to search within. Defaults to column 1.
 *     @type string $label  Label text to display. Defaults to "Search table".
 * }
 * @return string HTML formatted search input element.
 */
function js_search_form_shortchode( $atts ) {
	$args = shortcode_atts(
		array(
			'column' => 1,
			'label'  => 'Search',
		),
		$atts
	);

	ob_start();

	printf(
		/* translators: 1: the search field label, 2: the number of the column to search within. */
		__( '<div class="js-search-form"><label for="search_table_input">%1$s: <input type="search" name="search_table_input" id="search_table_input" data-search-column="%2$d"></label><button id="js-search-form-reset" type="button" class="button--small">Reset</button></div>', 'hrs-wsu-edu' ), // phpcs:ignore WordPress.Security.EscapeOutput
		esc_html( $args['label'] ),
		esc_html( absint( $args['column'] ) )
	);

	return ob_get_clean();
}
