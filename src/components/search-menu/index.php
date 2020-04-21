<?php
/**
 * Search Menu component
 *
 * This component outputes the HRS search menu.
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\components\search_menu;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

?>
<div id="search-menu" class="expandable">
	<?php get_search_form(); ?>
	<div class="search-links">
		<p class="search-links-title">Common Searches</p>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'hrs-search-menu',
				'menu'           => 'hrs-search-menu',
				'container'      => 'nav',
				'items_wrap'     => '<ul>%3$s</ul>',
				'depth'          => 2,
			)
		);
		?>
		<button class="screen-reader-text close-search-menu">Close menu</button>
	</div>
</div>
