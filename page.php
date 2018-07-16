<?php
/**
 * Default Page Template
 *
 * The default template for displaying individual page views.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.17.0
 */
?>

<?php get_header(); ?>

<main id="wsuwp-main" class="spine-page-default">

<?php get_template_part( 'parts/headers' ); ?>
<?php get_template_part( 'parts/featured-images' ); ?>

<section class="row single gutter pad-ends article-container">

	<div class="column one">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'articles/article' ); ?>

		<?php endwhile; ?>

	</div><!--/column-->

</section>

	<?php get_template_part( 'parts/footers' ); ?>

</main>

<?php get_footer();
