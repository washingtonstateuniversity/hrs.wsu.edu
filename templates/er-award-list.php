<?php
/**
 * Template Name: ER Award List
 *
 * Provides a template that can be used to display a list of all awards in the
 * Employee Recognition database, organized by year, after the primary page
 * content.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.20.0
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
					WSU\HRS\Template_Tags\list_erdb_awards_by_year();
				endwhile;
			endif;
			?>

		</div><!--/column-->
	</section>

	<?php get_template_part( 'parts/footers' ); ?>

</main>

<?php
get_footer();
