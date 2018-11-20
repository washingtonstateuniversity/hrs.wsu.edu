<?php
/**
 * WSU Human Resources Services functions and definitions
 *
 * Defines the primary HRS child theme variables and methods, these are all
 * loaded after the main Spine parent theme methods. The bulk of the child theme
 * setup happens in the required 'class-hrs-theme-setup.php' file. This class
 * also includes secondary methods such as shortcode and template tag files.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.1.0
 */

/**
 * Sets up basic theme configuration and WordPress API settings.
 *
 * @since 0.12.0
 */
require_once 'includes/class-hrs-theme-setup.php';

/**
 * Adds Microsoft SQL Server database connection class.
 */
require_once 'includes/class-msdb-connect.php';

add_action( 'wp_enqueue_scripts', 'hrs_enqueue_styles', 25 );
add_action( 'wp_print_styles', 'hrs_dequeue_styles' );
add_action( 'wp_head', 'hrs_noscript_styles' );
add_action( 'login_enqueue_scripts', 'hrs_login_styles' );
add_filter( 'script_loader_tag', 'hrs_add_attr_to_script_tag', 10, 3 );
add_filter( 'login_headerurl', 'hrs_login_logo_url' );
add_filter( 'login_headertitle', 'hrs_login_logo_url_title' );
add_filter( 'logout_redirect', 'hrs_logout_redirect_home', 10, 3 );
add_filter( 'excerpt_length', 'hrs_excerpt_length' );
add_filter( 'excerpt_more', 'hrs_excerpt_more_link' );

/**
 * Creates a script version.
 *
 * @since 0.17.3
 */
function hrs_get_theme_version() {
	$hrs_version = '1.0.0-20181114';

	return $hrs_version;
}

/**
 * Add HRS Child Theme stylesheet.
 * Add HRS Child Theme stylesheets and scripts.
 *
 * @since 0.7.0
 */
function hrs_enqueue_styles() {
	wp_enqueue_style( 'hrs-child-theme', get_stylesheet_directory_uri() . '/assets/css/style.css', array( 'wsu-spine' ), hrs_get_theme_version() );
	wp_enqueue_style( 'source_sans_pro', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,900,900i', array(), hrs_get_theme_version() );
	wp_enqueue_script( 'hrs-main', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), hrs_get_theme_version(), false );
	wp_enqueue_script( 'hrs-legacy', get_stylesheet_directory_uri() . '/assets/js/main.es5.js', array(), hrs_get_theme_version(), true );
}

/**
 * Adds a noscript element for HRS styles.
 *
 * @since 0.15.2
 */
function hrs_noscript_styles() {
	?>
	<noscript><style>.search-toggle, .js-search-form { display: none !important; } #search-menu { float: right !important; padding-top: 1.5rem !important; position: relative !important; top: 0; transform: none !important; }</style></noscript>
	<?php
}

/**
 * Removes child theme style call from parent theme.
 *
 * @since 0.7.0
 */
function hrs_dequeue_styles() {
	wp_dequeue_style( 'spine-theme-child' );
	wp_dequeue_style( 'spine-theme' );
	wp_dequeue_style( 'open-sans' );
	wp_dequeue_style( 'wp-block-library' );

	if ( is_page_template( 'template-builder.php' ) ) {
		if ( get_post_meta( get_the_ID(), '_has_builder_banner', true ) ) {
			wp_dequeue_style( 'genericons' );
		}
	}
}

/**
 * Adds attributes to selected script tags.
 *
 * @since 1.0.0
 */
function hrs_add_attr_to_script_tag( $tag, $handle, $src ) {
	// Load main script as module to serve ES6+ version to supporting browsers.
	if ( 'hrs-main' === $handle ) {
		$tag = str_replace( 'text/javascript', 'module', $tag );
	}

	// Module-supporting browsers know not to load `nomodule` scripts.
	if ( 'hrs-legacy' === $handle ) {
		$tag = str_replace( ' src=', ' defer nomodule src=', $tag );
	}

	// Add `async` attribute to the WSU Spine script tag.
	if ( 'wsu-spine' === $handle ) {
		$tag = str_replace( ' src=', ' async src=', $tag );
	}

	return $tag;
}

/**
 * Calls custom CSS on the login page for fancy styling.
 *
 * @since 0.12.0
 */
function hrs_login_styles() {
	wp_enqueue_style( 'hrs-login-style', get_stylesheet_directory_uri() . '/assets/css/login-style.css', false, hrs_get_theme_version() );
}

/**
 * Sets the default excerpt word count.
 *
 * @since 0.14.0
 *
 * @return int The number of words to trim the automatic excerpt to.
 */
function hrs_excerpt_length( $word_count ) {
	$word_count = 20;

	return $word_count;
}

/**
 * Removes the default Read More link from excerpts.
 *
 * @since 0.14.0
 *
 */
function hrs_excerpt_more_link( $excerpt_more ) {
	$excerpt_more = '<span class="more">&hellip;</span>';

	return $excerpt_more;
}

/**
 * Changes the login logo link from wordpress.org to hrs.wsu.edu.
 *
 * @since 0.12.0
 *
 * @return string
 */
function hrs_login_logo_url() {
	return home_url();
}

/**
 * Changes the login logo text to the site title.
 *
 * @since 0.12.0
 *
 * @return string
 */
function hrs_login_logo_url_title() {
	return get_bloginfo( 'name' );
}

/**
 * Redirects users to the home page on logout.
 *
 * @since 0.3.0
 *
 * @param string $redirect_to The redirect destination URL.
 * @param string $requested_redirect_to The requested redirect destination URL passed as a parameter.
 * @param WP_User $user The WP_User object for the user that's logging out.
 * @return string URL of page to redirect users to on logout.
 */
function hrs_logout_redirect_home( $redirect_to, $requested_redirect_to, $user ) {
	// Set requested redirect parameter to the home url.
	$requested_redirect_to = home_url( '/' );

	return $requested_redirect_to;
}
