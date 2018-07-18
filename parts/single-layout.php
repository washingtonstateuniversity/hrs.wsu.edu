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

	<?php if ( has_term( '', 'hrs_unit' ) ) : ?>

		<section class="row single gutter pad-top article-taxonomy--primary">

			<div class="column one">

				<?php
				WSU\HRS\Template_Tags\the_terms( array(
					'taxonomy'      => 'hrs_unit',
					'show_title'    => false,
					'container_tag' => 'ul',
					'item_tag'      => 'li',
				) );
				?>

			</div><!--/column-->

		</section>

	<?php endif; ?>

	<section class="row single gutter pad-top article-container">

		<div class="column one">

			<?php get_template_part( 'articles/post', get_post_type() ) ?>

		</div><!--/column-->

	</section>

<?php endwhile; ?>
