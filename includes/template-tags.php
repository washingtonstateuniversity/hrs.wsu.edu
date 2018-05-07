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

 if ( ! function_exists( 'list_awards' ) ) :
 	/**
 	 * Document.
 	 *
 	 * @since 0.11.0
 	 */
 	function list_awards( $awards = '', $year = '' ) {
 		if ( ! $awards ) {
 			$awards = get_erdb_awards();
 		}

 		$item = '';
 		foreach ( $awards as $award ) {

 			if ( ! $year ) {
 				$item .= sprintf( '<div class="list-item"><figure class="article-image"><img src="%1$s" alt="%3$s"></figure><div class="list-content"><p class="article-title">%2$s</p><p>%3$s</p></div></div>',
 					'data:image/jpg;base64, ' . base64_encode( $award->image ),
 					$award->name,
 					$award->description
 				);
 			} else {
 				if ( $year === $award->year ) {
 					$item .= sprintf( '<div class="list-item"><figure class="article-image"><img src="%1$s" alt="%3$s"></figure><div class="list-content"><p class="article-title">%2$s</p><p>%3$s</p></div></div>',
 						'data:image/jpg;base64, ' . base64_encode( $award->image ),
 						$award->name,
 						$award->description
 					);
 				}
 			}
 		}

 		echo '<section class="articles-list">' . $item . '</section>';
 	}
 endif;

 if ( ! function_exists( 'list_erdb_awards_by_year' ) ) :
 	/**
 	 * Document me.
 	 *
 	 * @since 0.11.0
 	 * @return
 	 */
 	function list_erdb_awards_by_year() {
 		$awards = get_erdb_awards();

 		$group_years = array();
 		foreach ( $awards as $award ) {
 			if ( ! in_array( $award->year, $group_years, true ) ) {
 				$group_years[] = $award->year;
 			}
 		}

 		foreach ( $group_years as $year ) {
 			$title = ( -1 === $year ) ? 'All' : $year;

 			echo '<h2>' . esc_attr__( $title ) . ' Year Awards</h2>';
 			list_awards( $awards, $year );
 		}
 	}
 endif;
