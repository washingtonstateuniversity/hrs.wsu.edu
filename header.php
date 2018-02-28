<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js no-svg lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js no-svg lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js no-svg lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
	<meta charset="UTF-8" />
	<title><?php echo esc_html( spine_get_title() ); ?></title>

	<!-- FAVICON -->
	<link rel="shortcut icon" href="//repo.wsu.edu/spine/1/favicon.ico" />

	<!-- RESPOND -->
	<meta name="viewport" content="width=device-width, user-scalable=yes">

	<!-- DOCS -->
	<link type="text/plain" rel="author" href="//repo.wsu.edu/spine/1/authors.txt" />
	<link type="text/html" rel="help" href="http://brand.wsu.edu/media/web" />

	<!-- SCRIPTS and STYLES -->
	<!-- Custom scripts and styles should be added with wp_enqueue_script() and wp_enqueue_style() -->

	<?php wp_head(); ?>

	<!-- COMPATIBILITY -->
	<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if lt IE 10]><script src="http://hrs.wsu.edu/wp-content/themes/hrs.wsu.edu/assets/js/custom.min.js"></script>
	[endif]-->

	<noscript><style>#spine #spine-sitenav ul ul li { display: block !important; }</style></noscript>
</head>

<body <?php body_class(); ?>>

<?php
	if ( ( spine_get_option( 'spineless' ) == 'true' ) && is_front_page() ) {
		$spineless = " spineless";
	} else {
		$spineless = "";
	}
?>

<?php get_template_part('parts/before-jacket'); ?>
<div id="jacket" class="style-<?php echo esc_attr( spine_get_option( 'theme_style' ) ); ?> colors-<?php echo esc_attr( spine_get_option( 'secondary_colors' ) ); ?> spacing-<?php echo esc_attr( spine_get_option( 'theme_spacing' ) ); ?>">
<?php get_template_part('parts/before-binder'); ?>
<div id="binder" class="<?php echo esc_attr( spine_get_option( 'grid_style' ) ); echo $spineless; echo esc_attr( spine_get_option( 'large_format' ) ); echo esc_attr( spine_get_option( 'broken_binding' ) ); ?>">
<?php get_template_part('parts/before-main'); ?>
