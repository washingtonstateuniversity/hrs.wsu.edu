<?php
/**
* Single Post Layout Template
*
* The template for layout out the content of individual post views.
*
* @since 0.14.0
*/
?>

<section class="row side-right gutter pad-ends">

	<div class="column one">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'articles/post', get_post_type() ) ?>

		<?php endwhile; ?>

	</div><!--/column-->

	<div class="column two">

		<?php get_sidebar(); ?>

	</div><!--/column two-->

</section>
