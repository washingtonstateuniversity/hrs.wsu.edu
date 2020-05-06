<?php
/**
 * HRS Child Theme Site Header
 *
 * This file is called in the Spine parent theme's main `header.php` file, just
 * before the `<main>` section. It displays the site header for the HRS child
 * theme, including the site title, search button, and expandable search menu.
 * The search menu also contains a WP nav menu.
 *
 * @package HrswpTheme
 * @since 0.14.0
 */

namespace HrswpTheme\templates\header;

?>
<header class="site-header" aria-label="hrs-website">
	<section class="row single">
		<div class="site-banner column one">
			<a class="site-title" href="<?php echo esc_url( home_url() ); ?>">Human Resource Services</a>
			<div class="site-search">
				<?php get_template_part( '/build/components/search-menu' ); ?>
			</div>
		</div>
	</section>
</header>
