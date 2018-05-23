<?php
$hrs_common_search_args = array(
	'theme_location'  => 'hrs-common-search',
	'menu'            => 'hrs-common-search',
	'container'       => 'nav',
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

					<div class="search">
						<button class="search-toggle" aria-expanded="false" aria-controls="search-menu">Search</button>
						<div id="search-menu" class="expandable">
							<form class="search-form" method="get" action="https://search.wsu.edu/Default.aspx">
								<input name="cx" value="002970099942160159670:yqxxz06m1b0" type="hidden">
								<input name="cof" value="FORID:11" type="hidden">
								<input name="sa" value="Search" type="hidden">
								<label class="screen-reader-text" for="s"><?php _e( 'Search', 'hrs-wsu-edu' ); ?></label>
								<input class="search-input" id="s" type="search" name="q" placeholder="<?php _e( 'Search', 'hrs-wsu-edu' ); ?>" spellcheck="true" autocomplete="false" value="" />
							</form>
							<div class="search-links">
								<span class="search-links-title">Common Searches</span>
								<?php wp_nav_menu( $hrs_common_search_args ); ?>
							</div>

							<button class="screen-reader-text close-search-menu">Close menu</button>

						</div>
					</div>

				</header>
			</div>
		</section>
	</div>


</header>
