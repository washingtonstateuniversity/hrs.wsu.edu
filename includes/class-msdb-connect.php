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
	var $show_errors = false;

	/**
	 * Results of the last query made.
	 *
	 * @since 0.11.0
	 * @var array|null
	 */
	var $last_result;

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
			"Database" => $this->dbname,
			"Uid"      => $this->dbuser,
			"PWD"      => $this->dbpassword
		);

		// Opens MS SQL connection using ODBC.
		$this->dbh = sqlsrv_connect( $this->dbhost, $params );

		if ( ! $this->dbh ) {
			// Connection failed, so print errors and end.
			$this->print_error();
			return false;
		} elseif ( $this->dbh ) {
			$this->has_connected = true;
			echo "<p>DEBUG: Connection successful! :)</p>"; // DEBUGGING
			return true;
		}
		return false;
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
			$this->dbh = null;
			$this->has_connected = false;
			echo "<br>DEBUG: Connection to {$this->dbname} closed."; // DEBUGGING
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
				echo "<br>DEBUG: Freed resources for {$statement} statement."; // DEBUGGING
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
					__( 'WP HRS_MSDB error:' ),
					$err['SQLSTATE'],
					$err['code'],
					htmlspecialchars( $err['message'] )
				);
			}
		} else {
			$str = htmlspecialchars( $str, ENT_QUOTES );
			printf(
				'<div id="error"><p class="wpdberror"><strong>%s</strong> <code>%s</code></p></div>',
				__( 'WP HRS_MSDB database error:' ),
				$str
			);
		}

 	}

}
