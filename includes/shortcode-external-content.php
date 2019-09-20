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
add_shortcode( 'salary_grid_it_table', __NAMESPACE__ . '\salary_grid_it_table_shortcode' );
add_shortcode( 'cs_salary_it_schedule', __NAMESPACE__ . '\cs_salary_it_schedule_shortcode' );
add_shortcode( 'salary_grid_n_grpa_am_table', __NAMESPACE__ . '\salary_grid_n_grpa_am_table_shortcode' );
add_shortcode( 'salary_grid_n_grpa_nu_table', __NAMESPACE__ . '\salary_grid_n_grpa_nu_table_shortcode' );
add_shortcode( 'salary_grid_n_grpb_am_table', __NAMESPACE__ . '\salary_grid_n_grpb_am_table_shortcode' );
add_shortcode( 'salary_grid_n_grpab_am_table', __NAMESPACE__ . '\salary_grid_n_grpab_am_table_shortcode' );
add_shortcode( 'salary_grid_n_grpb_nu_table', __NAMESPACE__ . '\salary_grid_n_grpb_nu_table_shortcode' );
add_shortcode( 'salary_grid_n_grpab_nu_table', __NAMESPACE__ . '\salary_grid_n_grpab_nu_table_shortcode' );
add_shortcode( 'cs_salary_n_schedule', __NAMESPACE__ . '\cs_salary_n_schedule_shortcode' );

/**
 * Shortcode displays a list of Employee Recognition Awards.
 *
 * Sample usage: [erdb_awards_list]
 *
 * @since 0.20.0
 * @deprecated 1.8.0
 *
 * @return string HTML content to display the Employee Recognition awards.
 */
function erdb_awards_list_shortcode() {
	do_action(
		'deprecated_function_run',
		__FUNCTION__,
		__( 'HRSWP Sqlsrv DB plugin "HRS Awards" block', 'hrs-wsu-edu' ),
		'1.8.0'
	);

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
 * @deprecated 1.8.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_table_shortcode() {
	do_action(
		'deprecated_function_run',
		__FUNCTION__,
		__( 'HRSWP Sqlsrv DB plugin "HRS Salary Data" block', 'hrs-wsu-edu' ),
		'1.8.0'
	);

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
 * @deprecated 1.8.0
 *
 * @return string HTML content to display the salary schedule table.
 */
function cs_salary_schedule_shortcode() {
	do_action(
		'deprecated_function_run',
		__FUNCTION__,
		__( 'HRSWP Sqlsrv DB plugin "HRS Job Classifications" block', 'hrs-wsu-edu' ),
		'1.8.0'
	);

	ob_start();

	\WSU\HRS\Template_Tags\hrs_cs_salary_schedule();

	return ob_get_clean();
}


/**
 * Shortcode displays a table of the CS salary grid for IT Professionals.
 *
 * Sample usage: [salary_grid_it_table]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_it_table_shortcode() {
	ob_start();

	// TODO: Might be able to use the existing hrs_salary_grid() function and
	//       pass it the 'it' data set instead of creating a whole new function.
	\WSU\HRS\Template_Tags\hrs_salary_grid_it();

	return ob_get_clean();
}

/**
 * Shortcode displays a table of the CS salary schedule data for IT Professionals.
 *
 * Sample usage: [cs_salary_it_schedule]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary schedule table.
 */
function cs_salary_it_schedule_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_cs_salary_it_schedule();

	return ob_get_clean();
}


/**
 * Shortcode displays a table of the CS salary grid for nurses (group A A-M).
 *
 * Sample usage: [salary_grid_table]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_n_grpa_am_table_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_salary_grid_n_grpa_am();

	return ob_get_clean();
}

/**
 * Shortcode displays a table of the CS salary grid for nurses (group A N-U).
 *
 * Sample usage: [salary_grid_table]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_n_grpa_nu_table_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_salary_grid_n_grpa_nu();

	return ob_get_clean();
}


/**
 * Shortcode displays a table of the CS salary grid for nurses (group B A-M).
 *
 * Sample usage: [salary_grid_table]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_n_grpb_am_table_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_salary_grid_n_grpb_am();

	return ob_get_clean();
}


/**
 * Shortcode displays a table of the CS salary grid for nurses (group B A-M).
 *
 * Sample usage: [salary_grid_table]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_n_grpab_am_table_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_salary_grid_n_grpab_am();

	return ob_get_clean();
}


/**
 * Shortcode displays a table of the CS salary grid for nurses (group B N-U).
 *
 * Sample usage: [salary_grid_table]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_n_grpb_nu_table_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_salary_grid_n_grpb_nu();

	return ob_get_clean();
}


/**
 * Shortcode displays a table of the CS salary grid for nurses (group B A-M).
 *
 * Sample usage: [salary_grid_table]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary grid table.
 */
function salary_grid_n_grpab_nu_table_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_salary_grid_n_grpab_nu();

	return ob_get_clean();
}


/**
 * Shortcode displays a table of the CS salary schedule data for nurses.
 *
 * Sample usage: [cs_salary_schedule]
 *
 * @since 0.20.0
 *
 * @return string HTML content to display the salary schedule table.
 */
function cs_salary_n_schedule_shortcode() {
	ob_start();

	\WSU\HRS\Template_Tags\hrs_cs_salary_n_schedule();

	return ob_get_clean();
}
