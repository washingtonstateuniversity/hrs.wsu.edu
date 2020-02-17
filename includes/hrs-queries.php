<?php
/**
 * Custom database queries for the HRS child theme.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

namespace WSU\HRS\Queries;

add_action( 'pre_get_posts', 'WSU\HRS\Queries\hrs_filter_query', 10 );

/**
 * Filters the main WP_Query.
 *
 * Adjust the main query on the posts home page to filter out posts in the
 * "Reminder" category to prevent duplicate results.
 *
 * @param \WP_Query $query The standard WP_Query object.
 */
function hrs_filter_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	// Exclude posts in the reminder category from the posts home query.
	if ( ! is_admin() && is_home() && $query->is_main_query() ) {
		$reminders = get_category_by_slug( 'reminders' );
		if ( false !== $reminders ) {
			$query->set( 'category__not_in', intval( $reminders->term_id ) );
		}
		return;
	}
}

/**
 * Retrieves the five most recent reminder category posts
 *
 * @since 0.15.0
 *
 * @param string $output Optional. The desired output format. Defaults to an array of post IDs.
 * @return array|\WP_Query The posts as an array of IDs or array of post objects.
 */
function get_reminder_posts( $output = 'ids' ) {
	$reminders = get_category_by_slug( 'reminders' );
	if ( false === $reminders ) {
		return false;
	}

	$args = array(
		'post_type'      => 'post',
		'cat'            => intval( $reminders->term_id ),
		'post_status'    => array(
			'publish',
			'future',
		),
		'posts_per_page' => 6,
	);

	if ( 'ids' === $output ) {
		$args['fields'] = 'ids';
	}

	$reminders_query = new \WP_Query( $args );

	if ( 'ids' === $output ) {
		wp_reset_postdata();
		return $reminders_query;
	}

	return $reminders_query;
}

/**
 * Retrieves all posts with a given term from the HRS Unit tax.
 *
 * @uses \WP_Query()
 *
 * @since 0.17.0
 *
 * @param array $args {
 *     Optional. Set of arguments to modify the HRS unit posts query.
 *
 *     @type int    $posts_per_page  Number of posts to show per page. Default is the option set in WP Admin settings. Accepts -1 for all.
 *     @type array  $tax_query {
 *         The taxonomy to show associated posts from.
 *
 *         @type string           $taxonomy The taxonomy handle to retrieve posts from.
 *         @type string           $field    Select taxonomy term by. Possible values are ‘term_id’, ‘name’, ‘slug’ or ‘term_taxonomy_id’. Default value is ‘term_id’.
 *         @type int|string|array $terms    Taxonomy term(s).
 *     }
 *     @type int[]  $post__not_in    Post IDs to exclude from the query.
 *     @type int    $paged           Number of page. Show the posts that would normally show up just on page X when using the “Older Entries” link.
 *     @type string $fields          Which fields to return. There are three options, 'all', 'ids', and 'id=>parent'.
 * }
 * @return int[]|\WP_Query The posts as an array of IDs or array of post objects.
 */
function get_hrs_unit_posts( $args = array() ) {
	$defaults = array(
		'posts_per_page' => get_option( 'posts_per_page' ),
		'tax_query'      => array(
			array(
				'taxonomy' => 'hrs_unit',
				'field'    => 'slug',
				'terms'    => get_query_var( 'term' ),
			),
		),
		'post__not_in'   => '',
		'paged'          => get_query_var( 'paged' ),
		'fields'         => 'objects',
	);

	$args = wp_parse_args( $args, $defaults );

	$hrsunit_query = new \WP_Query( $args );

	if ( 'ids' === $args['fields'] ) {
		wp_reset_postdata();
		return $hrsunit_query;
	}

	return $hrsunit_query;
}
