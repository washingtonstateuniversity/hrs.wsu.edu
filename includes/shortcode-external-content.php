<?php
/**
 * HRS Child Theme External Content: Shortcodes
 *
 * Shortcodes for fetching and displaying content from external sources.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.20.1
 */

namespace WSU\HRS\Shortcode_External_Content;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_shortcode( 'erdb_awards_list', __NAMESPACE__ . '\erdb_awards_list_shortcode' );
add_shortcode( 'salary_grid_table', __NAMESPACE__ . '\salary_grid_table_shortcode' );

/**
 * Shortcode displays a list of ERDB Awards.
 *
 * Sample usage: [erdb_awards_list]
 *
 * @since 0.20.1
 *
 * @return string HTML content to display the latest HRS posts.
 */
function erdb_awards_list_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\list_erdb_awards_by_year();

	return ob_get_clean();
}

/**
 * Explain.
 *
 * @since 0.20.1
 *
 * @return string
 */
function salary_grid_table_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_salary_grid();

	return ob_get_clean();
}
