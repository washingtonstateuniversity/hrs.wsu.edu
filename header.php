<?php
/**
 * HRS Head Section Template
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js no-svg lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]><html class="no-js no-svg lt-ie9 <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]><html class="no-js no-svg lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" prefix="og:http://ogp.me/ns#" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo esc_html( spine_get_title() ); ?></title>

	<!-- FAVICON -->
	<link rel="shortcut icon" href="https://repo.wsu.edu/spine/1/favicon.ico" />

	<!-- RESPOND -->
	<meta name="viewport" content="width=device-width, user-scalable=yes">

	<!-- DOCS -->
	<link type="text/plain" rel="author" href="https://repo.wsu.edu/spine/1/authors.txt" />
	<link type="text/html" rel="help" href="https://brand.wsu.edu/media/web" />

	<!-- SCRIPTS and STYLES -->
	<!-- Custom scripts and styles should be added with wp_enqueue_script() and wp_enqueue_style() -->

	<?php wp_head(); ?>

	<!-- COMPATIBILITY -->
	<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<noscript><style>#spine #spine-sitenav ul ul li { display: block !important; }</style></noscript>
</head>

<body <?php body_class(); ?>>

<?php
$binder = array(
	spine_get_option( 'grid_style' ),
	spine_get_option( 'large_format' ),
	spine_get_option( 'broken_binding' ),
);

if ( true === ( spine_get_option( 'spineless' ) ) && is_front_page() ) {
	$binder[] = 'spineless';
}

$binder_classes = implode( ' ', $binder );
?>

<a href="#wsuwp-main" class="screen-reader-shortcut"><?php _e( 'Skip to main content', 'hrswp-theme' ); ?></a>
<a href="#<?php echo esc_attr( apply_filters( 'wsu_spine_navigation_id', 'spine-sitenav' ) ); ?>" class="screen-reader-shortcut"><?php _e( 'Skip to navigation', 'hrswp-theme' ); ?></a>

<?php get_template_part( 'parts/before-jacket' ); ?>
<div id="jacket" class="style-<?php echo esc_attr( spine_get_option( 'theme_style' ) ); ?> colors-<?php echo esc_attr( spine_get_option( 'secondary_colors' ) ); ?> spacing-<?php echo esc_attr( spine_get_option( 'theme_spacing' ) ); ?>">
	<?php get_template_part( 'parts/before-binder' ); ?>
	<div id="binder" class="<?php echo esc_attr( $binder_classes ); ?>">
		<?php
		get_template_part( 'build/templates/header' );
