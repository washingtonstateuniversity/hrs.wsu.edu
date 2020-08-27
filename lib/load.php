<?php
/**
 * Load required files.
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\lib\load;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Load lib files.
 */
require dirname( __FILE__ ) . '/asset-loader.php';
require dirname( __FILE__ ) . '/class-lazy-load-images.php';

/**
 * Load inc files.
 */
require dirname( __DIR__ ) . '/inc/content-filters.php';
require dirname( __DIR__ ) . '/inc/customizer.php';
require dirname( __DIR__ ) . '/inc/login.php';
require dirname( __DIR__ ) . '/inc/media.php';
require dirname( __DIR__ ) . '/inc/meta.php';
require dirname( __DIR__ ) . '/inc/queries.php';
require dirname( __DIR__ ) . '/inc/taxonomy.php';
require dirname( __DIR__ ) . '/inc/wsu-spine.php';

/**
 * Load component files.
 *
 * @todo Maybe replace these with direct calls in the
 * templates where needed, using components as classes
 * instead of procedural functions.
 */
require dirname( __DIR__ ) . '/build/components/navigation.php';
require dirname( __DIR__ ) . '/build/components/post-date.php';
require dirname( __DIR__ ) . '/build/components/shortcode-document-gallery.php';
require dirname( __DIR__ ) . '/build/components/shortcode-last-updated.php';
require dirname( __DIR__ ) . '/build/components/terms-list.php';

/**
 * Load Gravity Forms compatability file.
 */
if ( class_exists( 'GFForms' ) ) {
	require dirname( __DIR__ ) . '/inc/gravityforms.php';
}

/**
 * Load TablePress compatability file.
 */
if ( class_exists( 'TablePress' ) ) {
	require dirname( __DIR__ ) . '/inc/tablepress.php';
}
