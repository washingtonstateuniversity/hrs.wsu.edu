<footer class="parent-foot">
	<?php
	$spine_site_args = array(
		'theme_location'  => 'site',
		'menu'            => 'footer',
		'container'       => false,
		'container_class' => false,
		'container_id'    => false,
		'menu_class'      => null,
		'menu_id'         => null,
		'items_wrap'      => '<ul class="footer-utility">%3$s</ul>',
		'depth'           => 9,
	);
	wp_nav_menu( $spine_site_args ); ?>
	<div class="site-ref">
		<?php
	$spine_site_args = array(
		'theme_location'  => 'site',
		'menu'            => 'hrsites',
		'container'       => false,
		'container_class' => false,
		'container_id'    => false,
		'menu_class'      => null,
		'menu_id'         => null,
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 5,
	);
	wp_nav_menu( $spine_site_args ); ?>
	</div>
</footer>