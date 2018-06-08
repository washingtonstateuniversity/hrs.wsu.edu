<?php
$hrs_common_search_args = array(
	'theme_location' => 'hrs-search-menu',
	'menu'           => 'hrs-search-menu',
	'container'      => 'nav',
	'items_wrap'     => '<ul>%3$s</ul>',
	'depth'          => 2,
);
?>

<header class="banner">
	<section class="row single">
		<div class="column one">
			<a class="site-title" href="http://hrs.wsu.edu">Human Resource Services</a>
			<button class="search-toggle" aria-expanded="false" aria-controls="search-menu">Search</button>
		</div>
		<div id="search-menu" class="expandable">
			<form class="search-form" method="get" action="https://search.wsu.edu/Default.aspx">
				<input name="cx" value="002970099942160159670:yqxxz06m1b0" type="hidden">
				<input name="cof" value="FORID:11" type="hidden">
				<input name="sa" value="Search" type="hidden">
				<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search', 'hrs-wsu-edu' ); ?></label>
				<input class="search-input" id="s" type="search" name="q" placeholder="<?php esc_attr_e( 'Search', 'hrs-wsu-edu' ); ?>" spellcheck="true" autocomplete="false" value="" />
			</form>
			<div class="search-links">
				<p class="search-links-title">Common Searches</p>
				<?php wp_nav_menu( $hrs_common_search_args ); ?>
				<button class="screen-reader-text close-search-menu">Close menu</button>
			</div>
		</div>
	</section>
</header>
