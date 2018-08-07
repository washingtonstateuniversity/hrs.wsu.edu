<?php
/**
 * Template Name: Gutenberg (Beta)
 *
 * Provides a template that can be used to enable the Gutenberg editor
 * on pages without interrupting existing page builder templates.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.19.0
 */

get_header();
?>

<main id="wsuwp-main" class="spine-gutenberg-beta-template">

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

		</div>
	</section>

	<?php get_template_part( 'parts/footers' ); ?>

</main>

<?php
get_footer();
