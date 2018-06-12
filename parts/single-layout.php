<?php
/**
 * Single Post Layout Template
 *
 * The template for layout out the content of individual post views.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */
?>

<?php while ( have_posts() ) : the_post(); ?>

	<section class="row single gutter pad-top article-containter">

		<div class="column one">

			<?php get_template_part( 'articles/post', get_post_type() ) ?>

		</div><!--/column-->

	</section>

<?php endwhile; ?>
