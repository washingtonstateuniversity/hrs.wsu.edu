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

		$awards = $msdb->get_results( $msdb->prepare(
			'
			SELECT BinaryFile as image, GroupDescription as description, GroupName as name, GroupYear as year
			FROM V_AwardViewer
			ORDER BY %s
			',
			array( 'GroupYear' )
		) );

		$msdb->clean();

		return $awards;
	}
endif;

if ( ! function_exists( 'get_awards_list' ) ) :
	/**
	 * Document.
	 *
	 * @since 0.11.0
	 */
	function get_awards_list( $awards = '', $year = '' ) {
		if ( ! $awards ) {
			$awards = get_erdb_awards();
		}

		$list = '';
		foreach ( $awards as $award ) {
			if ( ! $year ) {
				$list .= sprintf( '<div class="list-item"><figure class="article-image"><img src="%1$s" alt="%3$s"></figure><div class="list-content"><p class="article-title">%2$s</p><p>%3$s</p></div></div>',
					esc_url_raw( 'data:image/jpg;base64, ' . base64_encode( $award->image ), array( 'data' ) ), // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
					esc_html( wptexturize( $award->name ) ),
					esc_html( wptexturize( $award->description ) )
				);
			} else {
				if ( $year === $award->year ) {
					$list .= sprintf( '<div class="list-item"><figure class="article-image"><img src="%1$s" alt="%3$s"></figure><div class="list-content"><p class="article-title">%2$s</p><p>%3$s</p></div></div>',
						esc_url_raw( 'data:image/jpg;base64, ' . base64_encode( $award->image ), array( 'data' ) ), // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
						esc_html( wptexturize( $award->name ) ),
						esc_html( wptexturize( $award->description ) )
					);
				}
			}
		}

		return $list;
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

			printf( '<section class="articles-list"><h2>%s Year Awards</h2>%s</section>', // WPCS: XSS ok.
				esc_attr( $title ),
				get_awards_list( $awards, $year )
			);
		}
	}
endif;
