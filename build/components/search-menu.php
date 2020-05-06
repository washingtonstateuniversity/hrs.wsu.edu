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
<h2 class="search-heading">Search</h2>
<div id="site-search-menu" class="search-menu">
	<?php get_search_form(); ?>
	<div class="search-links">
		<h3>Common Searches</h3>
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
	</div>
</div>
