<?php
/**
 * Custom template tags for the WSU HRS theme.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.11.0
 */

 if ( ! function_exists( 'get_erdb_awards' ) ) :
 	/**
 	 * Returns an object of awards from the ER Database.
 	 *
 	 * Loads a Microsoft SQL database connection with ODBC using default
 	 * credentials and the HRS_MSDB class. Then selects desired columns from
 	 * the database, frees the SQL statement resources, closes the connection,
 	 * and returns the results.
 	 *
 	 * @uses HRS_MSDB
 	 *
 	 * @since 0.11.0
 	 * @return
 	 */
 	function get_erdb_awards() {
 		$dbuser     = defined( 'ERDB_USER' ) ? ERDB_USER : '';
 		$dbpassword = defined( 'ERDB_PASSWORD' ) ? ERDB_PASSWORD : '';
 		$dbname     = defined( 'ERDB_NAME' ) ? ERDB_NAME : '';
 		$dbhost     = defined( 'ERDB_HOST' ) ? ERDB_HOST : '';

 		$msdb = new HRS_MSDB( $dbuser, $dbpassword, $dbname, $dbhost );

 		$awards = $msdb->get_results(
 			"
 			SELECT BinaryFile as image, GroupDescription as description, GroupName as name, GroupYear as year
 			FROM V_AwardViewer
 			ORDER BY GroupYear
 			"
 		);

 		$msdb->clean();

 		return $awards;
 	}
 endif;
