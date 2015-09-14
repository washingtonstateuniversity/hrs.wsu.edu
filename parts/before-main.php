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
				<div class="search-label">Search</div>
			</div>
		</section>
	</div>
	<div class="header-drawer-wrapper">
	<!-- Search interface, hidden by default until interaction in header -->
		<div class="header-search-wrapper <?php if ( ! is_front_page() ) : ?>header-search-wrapper-hide<?php endif; ?>">
			<section class="single row" id="search-modal">
				<div class="column one">
					<div class="header-search-input-wrapper">
						<form method="get" action="https://search.wsu.edu/Default.aspx">
							<div class="radio-rapper">
								<input type="radio" name="searchRadio" class="radio"> <label>Search WSU HR Site</label></div><div class="radio-rapper"> <input type="radio" name="searchRadio" class="radio"> <label>Search WSU Forms</label> </div> <div class="radio-rapper"><input type="radio" name="searchRadio" class="radio"> <label>Search WSU Jobs</label> </div>
							<input name="cx" value="002970099942160159670:yqxxz06m1b0" type="hidden">
							<input name="cof" value="FORID:11" type="hidden">
							<input name="sa" value="Search" type="hidden">
							<label class="search-label" for="header-search">Search</label>
							<input type="text" value="" name="q" placeholder="Search" class="header-search-input" />
						</form>
					
					</div>
				</div>
				<div class="column one common-searches <?php if ( is_front_page() ) : ?>common-searches-hide<?php endif; ?>">
					<div class="quick-links-label">Common Searches</div>
					<?php wp_nav_menu( $hrs_common_search_args ); ?>
				</div>
			</section>
			<!-- Toggle and close -->
			<div class="si-dropdown">&#x25BE;</div>
			<div class="close-header-search">x</div>
		</div>
	</div>
</header>