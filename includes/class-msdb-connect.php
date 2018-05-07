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

}
