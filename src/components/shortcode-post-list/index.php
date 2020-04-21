<?php
/**
 * HRSWP Theme Posts List: Shortcodes
 *
 * @package HrswpTheme
 * @since 0.13.0
 * @since 2.0.0 Consolidated into the components directory
 */

namespace HrswpTheme\components\shortcode_post_list;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

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

	hrs_recent_posts( $query );

	return ob_get_clean();
}
add_shortcode( 'hrs_recent_posts', __NAMESPACE__ . '\hrs_recent_posts_shortcode' );

/**
 * Displays the latest HRS posts.
 *
 * @since 0.16.0
 *
 * @param array $args {
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
 */
function hrs_recent_posts( $args ) {
	global $post;

	$defaults = array(
		'posts_per_page' => 5,
		'offset'         => 0,
		'category'       => 0,
		'hrs_unit'       => '',
		'style'          => 'cards',
	);

	$query = wp_parse_args( $args, $defaults );
	$posts = hrs_get_recent_posts( $query );

	if ( ! empty( $posts ) ) :

		if ( ! empty( $query['style'] ) ) {
			if ( 'cards' === $query['style'] ) {
				echo '<div class="recent-articles">';
			} elseif ( 'list' === $query['style'] ) {
				echo '<div class="articles-list">';
			} else {
				printf( '<div class="%s">', esc_attr( $query['style'] ) );
			}
		}

		foreach ( $posts as $post ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
			setup_postdata( $post );
			get_template_part( 'articles/archive-content' );
		}

		if ( ! empty( $query['style'] ) ) {
			echo '</div>';
		}

	endif;

	wp_reset_postdata();
}

/**
 * Retrieve recent posts from a given taxonomy.
 *
 * @since 0.16.0
 *
 * @see WP_Query::parse_query()
 *
 * @param array $args {
 *     Optional. Arguments to filter retrieval of news posts.
 *               See WP_Query::parse_query() for explanation of parameters.
 *
 *     @type int $posts_per_page   Total number of posts to display. Default 5. Accepts -1 for all.
 *     @type int $offset           Number of posts to offset return by. Default 0.
 *     @type int|string $category  Category ID or comma-separated list of IDs to include. Detault 0.
 *     @type string $hrs_unit      Slug of the hrs_unit taxonomy term to filter results by. Accepts
 *                                 multiple slugs separated by either commas (to include multiple
 *                                 categories), or plus signs (to require multiple categories).
 * }
 * @return array|false List of post objects or false if no posts match request.
 */
function hrs_get_recent_posts( $args = null ) {
	$defaults = array(
		'posts_per_page' => 5,
		'offset'         => 0,
		'category'       => 0,
		'hrs_unit'       => '',
	);

	$query = wp_parse_args( $args, $defaults );

	if ( ! empty( $query['hrs_unit'] ) ) {
		/*
		 * Check for multiple terms in request:
		 *  - comma-separated for inclusive (this OR that)
		 *  - plus-separated for exclusive (this AND that)
		 */
		if ( strpos( $query['hrs_unit'], ',' ) !== false ) {
			// Set up array with 'OR' comparison.
			$tax_query = array(
				'relation' => 'OR',
			);

			// Split terms into an array.
			$units = preg_split( '/[,\s]+/', $query['hrs_unit'] );

			// Build WP_Query formatted tax_query array.
			foreach ( $units as $unit ) {
				$or_tax = array(
					'taxonomy' => 'hrs_unit',
					'field'    => 'slug',
					'terms'    => $unit,
				);

				$tax_query[] = $or_tax;
			}
		} elseif ( strpos( $query['hrs_unit'], '+' ) !== false ) {
			// Set up array with 'AND' comparison.
			$tax_query = array(
				'relation' => 'AND',
			);

			// Split terms into an array.
			$units = preg_split( '/[+]+/', $query['hrs_unit'] );

			// Build WP_Query formatted tax_query array.
			foreach ( $units as $unit ) {
				$and_tax = array(
					'taxonomy' => 'hrs_unit',
					'field'    => 'slug',
					'terms'    => $unit,
				);

				$tax_query[] = $and_tax;
			}
		} else {
			$tax_query = array(
				array(
					'taxonomy' => 'hrs_unit',
					'field'    => 'slug',
					'terms'    => $query['hrs_unit'],
				),
			);
		}

		$query['tax_query'] = $tax_query;
	}

	$results = get_posts( $query );

	if ( ! empty( $results ) ) {
		return $results;
	}

	return false;
}
