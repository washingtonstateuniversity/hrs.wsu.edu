<?php
/**
 * Template Name: ER Award List
 *
 * Provides a template that can be used to display a list of all awards in the
 * Employee Recognition database, organized by year, after the primary page
 * content.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.11.0
 */
?>

<?php get_header(); ?>

<main class="spine-page-default">

	<?php get_template_part('parts/headers'); ?>

	<?php get_template_part('parts/featured-images'); ?>

	<section class="row side-right gutter pad-ends">

		<div class="column one">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part('articles/article'); ?>

				<?php list_erdb_awards_by_year(); ?>

			<?php endwhile; ?>

		</div><!--/column-->

	</section>

	<?php get_template_part( 'parts/footers' ); ?>

</main>

<?php get_footer();
