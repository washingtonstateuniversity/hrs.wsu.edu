<?php
/**
 * Single Post Template
 *
 * The template for displaying individual post views.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

?>

<?php get_header(); ?>

<main id="wsuwp-main">

	<?php
	if ( function_exists( 'wsuwp_uc_get_object_type_slugs' ) && in_array( get_post_type(), wsuwp_uc_get_object_type_slugs(), true ) ) {
		if ( 'wsuwp_uc_person' === get_post_type() ) {
			get_template_part( 'parts/single-layout', 'wsuwp_uc_person' );
		} else {
			get_template_part( 'parts/single-layout', 'university-center' );
		}
	} else {
		get_template_part( 'build/templates/single', get_post_type() );
	}

	get_template_part( 'build/templates/footer' );

	?>

</main><!--/#page-->

<?php
get_footer();
