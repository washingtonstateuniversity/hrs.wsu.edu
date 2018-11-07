<?php
/**
 * HRS Child Theme External Content: Shortcodes
 *
 * Shortcodes for fetching and displaying content from external sources.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.20.0
 */

namespace WSU\HRS\Shortcode_External_Content;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_shortcode( 'erdb_awards_list', __NAMESPACE__ . '\erdb_awards_list_shortcode' );
add_shortcode( 'salary_grid_table', __NAMESPACE__ . '\salary_grid_table_shortcode' );
add_shortcode( 'cs_salary_schedule', __NAMESPACE__ . '\cs_salary_schedule_shortcode' );

/**
 * Shortcode displays a list of Employee Recognition Awards.
 *
 * Sample usage: [erdb_awards_list]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the Employee Recognition awards.
 */
function erdb_awards_list_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\list_erdb_awards_by_year();

	return ob_get_clean();
}

/**
 * Shortcode displays a table of the CS salary grid.
 *
 * Sample usage: [salary_grid_table]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_table_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_salary_grid();

	return ob_get_clean();
}

/**
 * Shortcode displays a table of the CS salary schedule data.
 *
 * Sample usage: [cs_salary_schedule]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary schedule table.
 */
function cs_salary_schedule_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_cs_salary_schedule();

	return ob_get_clean();
}
