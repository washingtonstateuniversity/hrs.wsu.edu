<?php
/**
 * Custom database queries for the HRS child theme.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

namespace WSU\HRS\Queries;

add_action( 'pre_get_posts', 'WSU\HRS\Queries\filter_hrs_units_tax_query', 10 );

/**
 * Filters the main tax query for the HRS Units tax.
 *
 * Adjust the main taxonomy query for the HRS Units taxonomy to display only the
 * first result. For use in the featured article layout template.
 *
 * @param \WP_Query $query
 */
function filter_hrs_units_tax_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! is_tax( 'hrs_unit' ) ) {
		return;
	}

	$query->set( 'posts_per_page', 1 );
}
