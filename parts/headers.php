<?php
$hrs_common_search_args = array(
	'theme_location'  => 'hrs-common-search',
	'menu'            => 'hrs-common-search',
	'container'       => 'div',
	'container_class' => false,
	'container_id'    => 'hrs-common-search',
	'menu_class'      => null,
	'menu_id'         => null,
	'items_wrap'      => '<ul>%3$s</ul>',
	'depth'           => 2,
);

?>
<header>
	<div class="parent-stretch">
		<section class="single row">
			<div class="column one">
				<header>
					<div id="hr-header"><a href="http://hrs.wsu.edu">Human Resource Services</a></div>
					<form class="search-form" method="get" action="https://search.wsu.edu/Default.aspx" aria-expanded="false" aria-controls="search-menu">
						<input name="cx" value="002970099942160159670:yqxxz06m1b0" type="hidden">
						<input name="cof" value="FORID:11" type="hidden">
						<input name="sa" value="Search" type="hidden">
						<label class="screen-reader-text" for="s"><?php _e( 'Search', 'hrs-wsu-edu' ); ?></label>
						<input class="header-search-input" id="s" type="search" name="q" placeholder="<?php _e( 'Search', 'hrs-wsu-edu' ); ?>" spellcheck="true" autocomplete="false" value="" />
					</form>
					<div class="search-menu" id="search-menu">
						<span class="close-header-search close-search-menu">x</span>
						<span class="search-a-z"><a href="http://index.wsu.edu/">WSU A-Z Index</a></span>
						<div class="column one common-searches">
							<span class="quick-links-label">Common Searches</span>
							<?php wp_nav_menu( $hrs_common_search_args ); ?>
						</div>
					</div>
				</header>
			</div>
		</section>
	</div>


</header>
