<?php
/**
 * HRS Child Theme Site Header
 *
 * This file is called in the Spine parent theme's main `header.php` file, just
 * before the `<main>` section. It displays the site header for the HRS child
 * theme, including the site title, search button, and expandable search menu.
 * The search menu also contains a WP nav menu.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

// Arguments for the WP nav menu in the header search menu.
$hrs_common_search_args = array(
	'theme_location' => 'hrs-search-menu',
	'menu'           => 'hrs-search-menu',
	'container'      => 'nav',
	'items_wrap'     => '<ul>%3$s</ul>',
	'depth'          => 2,
);
?>

<header class="site-header" aria-label="hrs-website">
	<section class="row single">
		<div class="site-banner column one">
			<a class="site-title" href="<?php echo esc_url( home_url() ); ?>">Human Resource Services</a>
			<button class="search-toggle" aria-expanded="false" aria-controls="search-menu">Search</button>
		</div>
		<div id="search-menu" class="expandable">
			<?php get_search_form(); ?>
			<div class="search-links">
				<p class="search-links-title">Common Searches</p>
				<?php wp_nav_menu( $hrs_common_search_args ); ?>
				<button class="screen-reader-text close-search-menu">Close menu</button>
			</div>
		</div>
	</section>
</header>
