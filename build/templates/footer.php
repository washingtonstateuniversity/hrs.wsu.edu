<?php
/**
 * HRS Child Theme Site Footer
 *
 * This file is called in the Spine parent theme's primary content templates
 * (like `single.php`, `page.php`, and `index.php`), just at the end of the
 * `main` element. It displays the global site footer for the HRS child theme,
 * including two WP nav menus.
 *
 * @package HrswpTheme
 * @since 0.2.8
 */

namespace HrswpTheme\templates\footer;

// Arguments for the WP nav menus in the site footer.
$footer_nav_args = array(
	'theme_location'       => 'hrs-site-footer',
	'menu'                 => 'hrs-site-footer',
	'container'            => 'nav',
	'container_class'      => false,
	'container_id'         => false,
	'container_aria_label' => 'About HRS',
	'menu_class'           => null,
	'menu_id'              => null,
	'items_wrap'           => '<span class="footer-nav-title">' . __( 'About', 'hrswp-theme' ) . '</span><ul>%3$s</ul>',
	'depth'                => 4,
);

$site_reference_args = array(
	'theme_location'       => 'site-reference',
	'menu'                 => 'site-reference',
	'container'            => 'nav',
	'container_class'      => 'site-reference',
	'container_id'         => false,
	'container_aria_label' => 'Policies and contact',
	'menu_class'           => null,
	'menu_id'              => null,
	'items_wrap'           => '<ul>%3$s</ul>',
	'depth'                => 1,
);
?>

<footer class="site-footer row single">

	<div class="footer-nav">
		<?php wp_nav_menu( $footer_nav_args ); ?>
		<div class="wsu-brand">
			<svg class="wsu-cougar-head" xmlns="http://www.w3.org/2000/svg" width="50.428" height="50" viewBox="7.481 7.416 50.428 50"><g fill="#981e32"><path d="M38.202 57.372s2.547-1.089 3.948-5.315a10.398 10.398 0 0 1 .903 5.211 33.15 33.15 0 0 1-4.851.104zm10.665-8.489c-7.457 1.088-8.742-14.603-8.742-14.603s2.5 8.002 7.827 7.712c5.511-.277 3.948-8.766 3.948-8.766s5.361 14.499-3.033 15.657zm-34.218-3.544a64.527 64.527 0 0 1-7.168 1.69s4.261-3.22 7.435-13.179l3.068 2.769-.579 1.899a14.269 14.269 0 0 1 1.83 3.474 9.15 9.15 0 0 0-.198-8.025l-.393 1.16-1.159-1.09-2.061-1.887a25.87 25.87 0 0 1 3.844-7.238l.278.302 2.316 2.744-.707 1.159a30.013 30.013 0 0 1 2.999 3.809 17.36 17.36 0 0 0-.289-7.249l-1.065.997-2.628-3.046a29.047 29.047 0 0 1 11.649-7.411c-.27.294-.518.608-.742.938-1.471 2.061-2.952 5.789-1.749 11.799.175.949.499 2.317.823 3.683.635 2.744 1.354 5.858 1.609 7.815.509 4.088.092 6.764-1.263 8.187a5.886 5.886 0 0 1-4.632 1.343v-.972a20.997 20.997 0 0 0-.614-5.165l-.566-1.98-.892 1.842c-1.401 2.919-6.172 10.168-12.379 11.58a20.909 20.909 0 0 0 3.233-9.948z"/><path d="M50.429 18.394l-.068-.405 7.179-1.436-.128-.8-7.398.926c0-.139-.093-.29-.151-.429l6.764-2.628-.29-.706-7.075 2.188a3.327 3.327 0 0 0-1.331-1.402c-2.699.209-5.143.429-7.377.719l1.413-6.624h-.684l-2.166 6.832-1.157.197 1.688-7.411h-.798l-2.49 7.712h-.093a7.88 7.88 0 0 0-3.925 2.988c-1.286 1.83-2.594 5.154-1.505 10.642.196.915.498 2.224.822 3.625.647 2.779 1.376 5.94 1.631 7.979.592 4.632 0 7.632-1.679 9.427-1.4 1.459-3.567 2.039-6.601 1.771l-.764-.069.07-.754c.051-.538.074-1.079.069-1.62 0-.919-.063-1.835-.185-2.746a26.863 26.863 0 0 1-8.616 8.987c5.319.24 10.619.813 15.865 1.712l.845.081h.29c.631.017 1.262-.014 1.887-.092h.302c3.682-.636 6.866-3.357 6.01-9.67-1.007-7.492-2.316-12.261-2.652-15.864-.404-4.376 3.394-11.162 10.145-8.105a10.75 10.75 0 0 1 2.165 3.66 10.114 10.114 0 0 0-.207-4.631 7.793 7.793 0 0 0 .311-2.699l7.365-.312v-.811l-7.481-.232zm-7.48 2.686a10.608 10.608 0 0 0-6.38 1.668 8.502 8.502 0 0 0-2.408 2.767 4.633 4.633 0 0 1 1.887-4.493 9.672 9.672 0 0 1 7.364-.383c.648.383.185.487-.463.441z"/></g></svg>
		</div>
	</div>

	<?php wp_nav_menu( $site_reference_args ); ?>

</footer>
