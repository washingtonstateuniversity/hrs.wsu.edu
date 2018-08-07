<?php
/**
 * Default Page Template
 *
 * The default template for displaying individual page views.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.17.0
 */

get_header();
?>

<main id="wsuwp-main" class="spine-page-default">

	<?php get_template_part( 'parts/headers' ); ?>

	<section class="row single gutter pad-ends article-container">
		<div class="column one">

			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'articles/article' );
				endwhile;
			endif;
			?>

		</div><!--/column-->
	</section>

	<?php get_template_part( 'parts/footers' ); ?>

</main>

<?php
get_footer();
