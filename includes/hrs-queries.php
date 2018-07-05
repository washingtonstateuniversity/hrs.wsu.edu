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
 * Filters the main tax query for the HRS Units tax.
 *
 * Adjust the main taxonomy query for the HRS Units taxonomy to display only the
 * first result. For use in the featured article layout template.
 *
 * @param \WP_Query $query
 */
function hrs_filter_query( $query ) {

	/* Exclude posts in the reminder category from the posts home query. */
	if ( ! is_admin() && is_home() && $query->is_main_query() ) {
		$reminders = get_category_by_slug( 'reminders' );
		$query->set( 'category__not_in', intval( $reminders->term_id ) );
		return;
	}

	if ( is_admin() || ! $query->is_main_query() || ! is_tax( 'hrs_unit' ) ) {
		return;
	}

	$query->set( 'posts_per_page', 1 );
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

	$args = array(
		'post_type' => 'post',
		'cat' => intval( $reminders->term_id ),
		'post_status' => array(
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
