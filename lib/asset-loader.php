<?php
/**
 * Functions to register and manage frontend assets (scripts and styles).
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\lib\asset_loader;
use HrswpTheme;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Registers HRS Theme assets.
 *
 * @since 0.7.0
 */
function register_assets() {
	$version = HrswpTheme\get_version();

	wp_enqueue_style(
		'hrswp-theme',
		get_stylesheet_directory_uri() . '/build/style.css',
		array(),
		$version
	);

	wp_enqueue_style(
		'source_sans_pro',
		'//fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',
		array(),
		$version
	);

	wp_add_inline_style( 'hrswp-theme', inline_styles() );

	wp_enqueue_script(
		'hrswp-main',
		get_stylesheet_directory_uri() . '/build/index.js',
		array(),
		$version,
		false
	);
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\register_assets', 25 );

/**
 * Defines inline styles for the head section.
 *
 * @since 2.4.0
 *
 * 1.125
 */
function inline_styles() {
	$inline_styles = 'body {
		background-color: #fff;
		font-family: var(--wp--custom--typography--font);
		font-size: 16px;
		line-height: 1.5;
	}';

	$inline_styles = str_replace( '\n', '', $inline_styles );
	$inline_styles = preg_replace( '/\s*([:;{}])\s*/', '$1', $inline_styles );

	return $inline_styles;
}

/**
 * Registers HRS Theme block editor assets.
 *
 * @since 1.3.0
 */
function register_block_editor_assets() {
	$version = HrswpTheme\get_version();

	wp_enqueue_script(
		'hrswp-block-editor',
		get_stylesheet_directory_uri() . '/build/editor.js',
		array(
			'wp-blocks',
			'wp-components',
			'wp-element',
			'wp-editor',
			'wp-dom-ready',
			'wp-edit-post',
			'wp-i18n',
			'wp-plugins',
			'wp-edit-post',
			'wp-compose',
			'wp-data',
		),
		$version
	);

	wp_enqueue_style(
		'hrswp-editor-style',
		get_stylesheet_directory_uri() . '/build/editor.css',
		array(),
		$version
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\register_block_editor_assets' );

/**
 * Calls custom CSS on the login page for fancy styling.
 *
 * @since 0.12.0
 */
function register_login_assets() {
	wp_enqueue_style(
		'hrswp-login',
		get_stylesheet_directory_uri() . '/build/login.css',
		false,
		HrswpTheme\get_version()
	);
}
add_action( 'login_enqueue_scripts', __NAMESPACE__ . '\register_login_assets' );

/**
 * Adds a noscript element to the site header.
 *
 * @since 0.15.2
 */
function render_noscript_styles() {
	?>
	<noscript><style>.site-search .search-heading {display:none;}.site-header .column.site-banner {align-items:flex-end;flex-direction:column;}.site-search .search-menu {box-shadow:none;opacity:1;padding-top:1.5rem;position:relative;visibility:visible;width:100%;z-index:2;}</style></noscript>
	<?php
}
add_action( 'wp_head', __NAMESPACE__ . '\render_noscript_styles' );

/**
 * Removed unneeded default styles from other theme(s) and/or plugins.
 *
 * @since 0.7.0
 */
function dequeue_styles() {
	wp_dequeue_style( 'spine-theme-child' );
	wp_dequeue_style( 'spine-theme' );
	wp_dequeue_style( 'open-sans' );
	wp_dequeue_style( 'wp-block-library' );

	// Remove 'genericons' when the Builder template banner is active.
	if ( is_page_template( 'template-builder.php' ) ) {
		if ( get_post_meta( get_the_ID(), '_has_builder_banner', true ) ) {
			wp_dequeue_style( 'genericons' );
		}
	}
}
add_action( 'wp_print_styles', __NAMESPACE__ . '\dequeue_styles' );

/**
 * Adds attributes to selected script tags.
 *
 * @since 1.0.0
 *
 * @param string $tag    The `<script>` tag for the enqueued script to filter.
 * @param string $handle The script's registered handle.
 * @return string The `<script>` tag.
 */
function filter_script_loader_tag( $tag, $handle ) {
	// Load main script as module to serve ES6+ version to supporting browsers.
	if ( 'hrswp-main' === $handle ) {
		$tag = str_replace( 'text/javascript', 'module', $tag );
	}

	// Add `async` attribute to the WSU Spine script tag.
	if ( 'wsu-spine' === $handle ) {
		$tag = str_replace( ' src=', ' async src=', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', __NAMESPACE__ . '\filter_script_loader_tag', 10, 2 );
