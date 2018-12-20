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
 * @param \WP_Query $query
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
 * @return array|\WP_Query The posts as an array of IDs or array of post objects.
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

/**
 * Returns an object of awards from the ER Database.
 *
 * Loads a Microsoft SQL database connection with ODBC using default
 * credentials and the HRS_MSDB class. Then selects desired columns from
 * the database, frees the SQL statement resources, closes the connection,
 * and returns the results.
 *
 * @uses \HRS_MSDB()
 *
 * @since 0.20.0
 *
 * @return array An array of objects matching the specified query.
 */
function get_erdb_awards() {
	$dbuser     = defined( 'MSDB_USER' ) ? MSDB_USER : '';
	$dbpassword = defined( 'MSDB_PASSWORD' ) ? MSDB_PASSWORD : '';
	$dbname     = defined( 'RECOG_DB_NAME' ) ? RECOG_DB_NAME : '';
	$dbhost     = defined( 'MSDB_HOST' ) ? MSDB_HOST : '';

	// Open a new MS database connection.
	$msdb = new \HRS_MSDB( $dbuser, $dbpassword, $dbname, $dbhost );

	$awards = $msdb->get_results(
		$msdb->prepare(
			'
			SELECT BinaryFile as image, GroupDescription as description, GroupName as name, GroupYear as year
			FROM V_AwardViewer
			ORDER BY %s
			',
			array( 'GroupYear' )
		)
	);

	$msdb->clean();

	return $awards;
}

/**
 * Returns an object of salary data from the EDB.
 *
 * Loads a Microsoft SQL database connection with ODBC using the saved
 * credentials and the HRS_MSDB class. Then selects desired columns from
 * the database, frees the SQL statement resources, closes the connection,
 * and returns the results.
 *
 * @since 0.20.0
 *
 * @return array An array of objects matching the specified query.
 */
function get_salary_grid() {
	$dbuser     = defined( 'MSDB_USER' ) ? MSDB_USER : '';
	$dbpassword = defined( 'MSDB_PASSWORD' ) ? MSDB_PASSWORD : '';
	$dbname     = defined( 'EMPLOY_DB_NAME' ) ? EMPLOY_DB_NAME : '';
	$dbhost     = defined( 'MSDB_HOST' ) ? MSDB_HOST : '';

	// Open a new MS database connection.
	$msdb = new \HRS_MSDB( $dbuser, $dbpassword, $dbname, $dbhost );

	$salary = $msdb->get_results(
		'
		SELECT *
		FROM SalGrid
		'
	);

	$msdb->clean();

	return $salary;
}

/**
 * Returns an object of salary data and job titles from the EDB.
 *
 * Loads a Microsoft SQL database connection with ODBC using the saved
 * credentials and the HRS_MSDB class. Then selects desired columns from
 * the database, frees the SQL statement resources, closes the connection,
 * and returns the results.
 *
 * @since 0.20.0
 *
 * @return array An array of objects matching the specified query.
 */
function get_cs_salary_schedule() {
	$dbuser     = defined( 'MSDB_USER' ) ? MSDB_USER : '';
	$dbpassword = defined( 'MSDB_PASSWORD' ) ? MSDB_PASSWORD : '';
	$dbname     = defined( 'EMPLOY_DB_NAME' ) ? EMPLOY_DB_NAME : '';
	$dbhost     = defined( 'MSDB_HOST' ) ? MSDB_HOST : '';

	// Open a new MS database connection.
	$msdb = new \HRS_MSDB( $dbuser, $dbpassword, $dbname, $dbhost );

	$data = $msdb->get_results(
		$msdb->prepare(
			'
			SELECT ClassCode, JobGroupCode, JobTitle, SalRangeNum, SalrangeWExceptions, Salary_Min, Salary_Max
			FROM V_JobClassCS
			ORDER BY %s
			',
			array( 'JobTitle' )
		)
	);

	$msdb->clean();

	return $data;
}
