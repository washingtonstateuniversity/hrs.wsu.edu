<?php
/**
 * HRS SQL Server Connector: HRS_MSDB Class
 *
 * The HRS SQL Server connector is comprised of the HRS_MSDB class, which when
 * instantiated with valid credentials, opens a connection from WordPress to
 * a SQL Server database. The class provides a variety of methods for
 * interacting with the SQL Server database (currently using the `sqlsvr` PHP
 * extension).
 *
 * @package WSU_Human_Resources_Services
 * @since 0.11.0
 */

/**
 * HRS SQL Server Database Access Object.
 *
 * @link https://codex.wordpress.org/Function_Reference/wpdb_Class
 *
 * @since 0.11.0
 */
class HRS_MSDB {

	/**
	 * Whether to show SQL/DB errors.
	 *
	 * Default behavior is to show errors if both WP_DEBUG and WP_DEBUG_DISPLAY
	 * evaluated to true.
	 *
	 * @since 0.11.0
	 * @var bool
	 */
	private $show_errors = false;

	/**
	 * Results of the last query made.
	 *
	 * @since 0.11.0
	 * @var array|null
	 */
	private $last_result;

	/**
	 * SQL server result, either a resource or a booleen.
	 *
	 * @since 0.11.0
	 * @var mixed
	 */
	protected $result;

	/**
	 * Database Username.
	 *
	 * @since 0.11.0
	 * @var string
	 */
	protected $dbuser;

	/**
	 * Database Password.
	 *
	 * @since 0.11.0
	 * @var string
	 */
	protected $dbpassword;

	/**
	 * Database Name.
	 *
	 * @since 0.11.0
	 * @var string
	 */
	protected $dbname;

	/**
	 * Database Host.
	 *
	 * @since 0.11.0
	 * @var string
	 */
	protected $dbhost;

	/**
	 * Database Handle.
	 *
	 * @since 0.11.0
	 * @var string
	 */
	protected $dbh;

	/**
	 * Whether a connection has been made.
	 *
	 * @since 0.11.0
	 * @var bool
	 */
	private $has_connected = false;

	/**
	 * ... constructor ...
	 *
	 * tell my story
	 *
	 * @since 0.11.0
	 */
	public function __construct( $dbuser, $dbpassword, $dbname, $dbhost ) {
		if ( WP_DEBUG && WP_DEBUG_DISPLAY ) {
			$this->show_errors = true;
		}

		$this->dbuser     = $dbuser;
		$this->dbpassword = $dbpassword;
		$this->dbname     = $dbname;
		$this->dbhost     = $dbhost;

		$this->msdb_connect();
	}

	/**
	 * Opens a connection.
	 *
	 * Explain yourself.
	 *
	 * @since 0.11.0
	 *
	 * @return bool True with a successful connection, false on failure.
	 */
	public function msdb_connect() {

		$params = array(
			'Database' => $this->dbname,
			'Uid'      => $this->dbuser,
			'PWD'      => $this->dbpassword,
		);

		// Opens MS SQL connection using ODBC.
		$this->dbh = sqlsrv_connect( $this->dbhost, $params );

		if ( ! $this->dbh ) {
			// Connection failed, so print errors and end.
			$this->print_error();
			return false;
		} elseif ( $this->dbh ) {
			$this->has_connected = true;
			echo '<p>DEBUG: Connection successful! :)</p>'; // DEBUGGING
			return true;
		}
		return false;
	}

	/**
	 * Real escape using ???
	 *
	 * @since 0.11.0
	 *
	 * @param string $string String to escape.
	 * @return string Escaped string.
	 */
	private function mssql_escape( $string ) {
		$escaped = str_replace( "'", "''", $string );

		return $this->add_placeholder_escape( $escaped );
	}

	/**
	 * Escapes content by reference for insertion into the database.
	 *
	 * @since 0.11.0
	 *
	 * @param string $string String to escape.
	 */
	public function escape_by_ref( &$string ) {
		if ( ! is_float( $string ) ) {
			$string = $this->mssql_escape( $string );
		}
	}

	/**
	 * esCape
	 */
	public function placeholder_escape() {
		static $placeholder;

		if ( ! $placeholder ) {
			// If ext/hash is not present, compat.php's hash_hmac() does not support sha256.
			$algo = function_exists( 'hash' ) ? 'sha256' : 'sha1';
			// Old WP installs may not have AUTH_SALT defined.
			$salt        = defined( 'AUTH_SALT' ) && AUTH_SALT ? AUTH_SALT : (string) rand();
			$placeholder = '{' . hash_hmac( $algo, uniqid( $salt, true ), $salt ) . '}';
		}

		/*
		 * Add the filter to remove the placeholder escaper. Uses priority 0, so that anything
		 * else attached to this filter will recieve the query with the placeholder string removed.
		 */
		if ( ! has_filter( 'query', array( $this, 'remove_placeholder_escape' ) ) ) {
			add_filter( 'query', array( $this, 'remove_placeholder_escape' ), 0 );
		}

		return $placeholder;
	}

	/**
	 * escapee
	 */
	public function add_placeholder_escape( $query ) {
		/*
		 * To prevent returning anything that even vaguely resembles a placeholder,
		 * we clobber every % we can find.
		 */
		return str_replace( '%', $this->placeholder_escape(), $query );
	}

	/**
	 * unescapee
	 *
	 */
	public function remove_placeholder_escape( $query ) {
		return str_replace( $this->placeholder_escape(), '%', $query );
	}

	/**
	 * Prepares a SQL Server query for safe execution.
	 *
	 * Essentially duplicates the $wpdb::prepare() method. Uses sprintf()-like
	 * syntax and allows the following placeholders in the query string:
	 *   %d (integer)
	 *   %f (float)
	 *   %s (string)
	 *
	 * @since 0.11.0
	 *
	 * @param string      $query Query statement with sprintf()-like placeholders.
	 * @param array|mixed $args  The array of variables to substitute into the query's placeholders
	 *                           if being called with an array of arguments, or the first variable
	 *                           to substitute into the query's placeholders if being called with
	 *                           individual arguments.
	 * @return string|void Sanitized query string, or void if there is no query to prepare.
	 */
	public function prepare( $query, $args ) {
		if ( is_null( $query ) ) {
			return;
		}

		// This is not meant to be foolproof, but it will catch obviously incorrect usage.
		if ( strpos( $query, '%' ) === false ) {
			$this->print_error( 'The query argument of %s must have a placeholder.' );
		}

		$args = func_get_args();
		array_shift( $args );

		// If $args was passed as an array (as in vsprintf), move them up.
		$passed_as_array = false;
		if ( is_array( $args[0] ) && count( $args ) === 1 ) {
			$passed_as_array = true;
			$args            = $args[0];
		}

		foreach ( $args as $arg ) {
			if ( ! is_scalar( $arg ) && ! is_null( $arg ) ) {
				$this->print_error( sprintf(
					'Unsupported value type (%s)',
					gettype( $arg )
				) );
			}
		}

		$allowed_format = '(?:[1-9][0-9]*[$])?[-+0-9]*(?: |0|\'.)?[-+0-9]*(?:\.[0-9]+)?';

		$query = str_replace( "'%s'", '%s', $query ); // Strip any existing single quotes.
		$query = str_replace( '"%s"', '%s', $query ); // Strip any existing double quotes.
		$query = preg_replace( "/(?<!%)(%($allowed_format)?f)/", '%\\2F', $query ); // Force floats to be locale unaware.
		$query = preg_replace( "/%(?:%|$|(?!($allowed_format)?[sdF]))/", '%%\\1', $query ); // Escape any unescaped percents.

		$placeholders = preg_match_all( "/(^|[^%]|(%%)+)%($allowed_format)?[sdF]/", $query, $matches );

		if ( count( $args ) !== $placeholders ) {
			if ( 1 === $placeholders && $passed_as_array ) {
				// If the passed query only expected one argument, but the wrong number of arguments were sent as an array, bail.
				$this->print_error( 'The query only expected one placeholder, but an array of multiple placeholders was sent.' );
				return;
			} else {
				/*
				 * If we don't have the right number of placeholders, but they were passed as individual arguments,
				 * or we were expecting multiple arguments in an array, throw a warning.
				 */
				$this->print_error(
					sprintf(
						/* translators: 1: number of placeholders, 2: number of arguments passed */
						__( 'The query does not contain the correct number of placeholders (%1$d) for the number of arguments passed (%2$d).' ),
						$placeholders,
						count( $args )
					)
				);
			}
		}

		array_walk( $args, array( $this, 'escape_by_ref' ) );
		$query = @vsprintf( $query, $args ); // phpcs:ignore Generic.PHP.NoSilencedErrors.Discouraged

		return $this->add_placeholder_escape( $query );
	}

	/**
	 * Perform a MS SQL Server database query, using current DB connection.
	 *
	 * For the time being only handles SELECT queries.
	 * More complex than it needs to be for now, in order to allow for easily
	 * adapting this to allow for INSERT and DELETE queries in the future.
	 *
	 * @todo Check on the type of query, {@see /wp-includes/wp-db.php}.
	 * @todo Include some filtering and checking first.
	 *
	 * @since 0.11.0
	 *
	 * @param string $query A database query.
	 * @return int|bool Number of rows selected for select queries. Booleen
	 *                  false on error.
	 */
	public function query( $query, $param = null ) {
		// Run the query.
		if ( ! $param ) {
			$this->do_query( $query );
		} else {
			$this->do_query( $query, $param );
		}

		// Catch errors.
		if ( false === $this->result ) {
			$this->print_error();
		} else {
			echo '<p>DEBUG: Query request successful! :)</p>';
		}

		$num_rows = 0;
		if ( is_resource( $this->result ) ) {
			// phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition
			while ( $row = sqlsrv_fetch_object( $this->result ) ) {
				$this->last_result[ $num_rows ] = $row;
				$num_rows++;
			}

			// Log the number of rows returned and return them.
			// $this->num_rows = $num_rows;
			$return_val = $num_rows;

		}

		return $return_val;
	}

	/**
	 * Internal function performs an sqlsrv_query() call.
	 *
	 * @see HRS_MSDB::query()
	 *
	 * @param string $query The query to run.
	 */
	private function do_query( $query, $param = null ) {
		if ( ! empty( $this->dbh ) ) {
			if ( ! $param ) {
				$this->result = sqlsrv_query( $this->dbh, $query );
			} else {
				$this->result = sqlsrv_query( $this->dbh, $query, $param );
			}
		}
	}

	/**
	 * Get results.
	 *
	 * Explain yourself.
	 *
	 * @todo Consider adding additional output formats, such as array.
	 *
	 * @since 0.11.0
	 */
	public function get_results( $query = null, $param = null, $output = OBJECT ) {
		if ( $query && $param ) {
			$this->query( $query, $param );
		} elseif ( $query && ! $param ) {
			$this->query( $query );
		} else {
			return null;
		}

		if ( OBJECT === $output ) {
			// Return an integer-keyed array of row objects.
			return $this->last_result;
		} elseif ( OBJECT === strtoupper( $output ) ) {
			// Return an integer-keyed array of row objects.
			return $this->last_result;
		}
		return null;
	}

	/**
	 * Closes.
	 *
	 * Explain yourself.
	 *
	 * @since 0.11.0
	 */
	public function close() {
		if ( ! $this->dbh ) {
			return false;
		}

		$closed = sqlsrv_close( $this->dbh );

		if ( $closed ) {
			$this->dbh           = null;
			$this->has_connected = false;
			echo '<br>DEBUG: Connection to' . esc_html( $this->dbname ) . 'closed.'; // DEBUGGING
		}

		return $closed;
	}

	/**
	 * Cleans up request resources and close.
	 *
	 * Explain yourself.
	 *
	 * @todo Break this out into two pieces: flush() and close().
	 *
	 * @since 0.11.0
	 */
	public function clean( $statements = array() ) {

		// First free all resources for the specified statement(s).
		if ( $statements ) {
			foreach ( $statements as $statement ) {
				sqlsrv_free_stmt( $statement );
				echo '<br>DEBUG: Freed resources for' . esc_html( $statement ) . 'statement.'; // DEBUGGING
			}
		} else {
			sqlsrv_free_stmt( $this->result );
		}

		// Then close the connection.
		$this->close();

	}

	/**
	 * Print SQL/DB error.
	 *
	 * @since 0.11.0
	 *
	 * @param string $str The error to display.
	 * @return false|void False if showing of errors is disabled.
	 */
	public function print_error( $str = '' ) {

		if ( ! $str ) {
			$str = sqlsrv_errors();
		}

		if ( ! $this->show_errors ) {
			return false;
		}

		// Display errors.
		if ( is_array( $str ) ) {
			foreach ( $str as $err ) {
				printf(
					'<div id="error"><p class="wpdberror"><strong>%s</strong> [SQLSTATE %s]<br /><code>Code %s %s</code></p></div>',
					esc_html__( 'WP HRS_MSDB error:' ),
					esc_html( $err['SQLSTATE'] ),
					esc_html( $err['code'] ),
					esc_html( $err['message'] )
				);
			}
		} else {
			printf(
				'<div id="error"><p class="wpdberror"><strong>%s</strong> <code>%s</code></p></div>',
				esc_html__( 'WP HRS_MSDB error:' ),
				esc_html( $str )
			);
		}

	}

}
