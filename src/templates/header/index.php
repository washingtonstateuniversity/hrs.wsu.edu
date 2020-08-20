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
<header class="site-header" aria-label="HRS Site Header">
	<section class="row single">
		<div class="site-banner column one">
			<?php
			$tag = ( is_front_page() ) ? 'h1' : 'p';
			printf(
				'<%1$s class="site-title"><a href="%2$s">%3$s</a></%1$s>',
				esc_attr( $tag ),
				esc_url( get_home_url() ),
				get_bloginfo( 'title' )
			);
			?>
			<div class="site-search">
				<?php get_template_part( '/build/components/search-menu' ); ?>
			</div>
		</div>
	</section>
</header>
