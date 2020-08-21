<?php
/**
 * Default Page Template
 *
 * The default template for displaying individual page views.
 *
 * @package HrswpTheme
 * @since 0.17.0
 */

get_header();
?>

<main id="wsuwp-main" class="spine-page-default">

	<section class="row single gutter pad-ends article-container">
		<div class="column one">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'build/templates/page' );
				endwhile;
			endif;
			?>

		</div><!--/column-->
	</section>

	<?php get_template_part( 'build/templates/footer' ); ?>

</main>

<?php
get_footer();
