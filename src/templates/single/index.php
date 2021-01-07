<?php
/**
 * Single Post Layout Template
 *
 * The template for layout out the content of individual post views.
 *
 * @package HrswpTheme
 * @since 0.14.0
 */

namespace HrswpTheme\templates\single;
use HrswpTheme\components\terms_lists;
use HrswpTheme\components\post_date;

while ( have_posts() ) :
	the_post();

	if ( has_term( '', 'hrs_unit' ) ) {
		?>
		<section class="row single gutter pad-top article-taxonomy--primary">

			<div class="column one">

				<?php
				terms_lists\the_terms(
					array(
						'taxonomy'      => 'hrs_unit',
						'show_title'    => false,
						'container_tag' => 'ul',
						'item_tag'      => 'li',
					)
				);
				?>

			</div><!--/column-->

		</section>
		<?php
	}

	?>
	<section class="row single gutter pad-top article-container">
		<div class="column one">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-content' ); ?>>

				<header class="article-header">
					<?php if ( ! is_single() ) : ?>
						<h2 class="article-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h2>
					<?php else : ?>
						<?php if ( true === spine_get_option( 'articletitle_show' ) ) : ?>
							<h1 class="article-title"><?php the_title(); ?></h1>
						<?php endif; ?>
					<?php endif; ?>
					<?php post_date\render(); ?>
				</header>

				<?php
				if ( spine_has_thumbnail_image() ) {
					$article_image_type = 'thumbnail-image';
				} elseif ( spine_has_featured_image() ) {
					$article_image_type = 'feature-image';
					$image_caption      = get_post( get_post_thumbnail_id() )->post_excerpt;
				}
				?>

				<?php if ( ! empty( $article_image_type ) ) : ?>
					<figure class="article-image article-feature <?php echo esc_attr( $article_image_type ); ?>">
						<?php
						if ( ! is_singular() ) {
							if ( 'thumbnail' === $article_image_type ) {
								?>
								<a href="<?php the_permalink(); ?>"><?php spine_the_thumbnail_image(); ?></a>
								<?php
							} else {
								?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'spine-thumbnail_size' ); ?></a>
								<?php
							}
						} else {
							$hide_article_image = get_post_meta( get_the_ID(), 'hrswp_hide_feature_image', true );

							if ( empty( $hide_article_image ) ) {
								?>
								<a href="<?php echo esc_url( spine_get_featured_image_src() ); ?>">
									<?php spine_the_featured_image(); ?>
								</a>
								<?php
								if ( ! empty( $image_caption ) ) {
									?>
									<figcaption class="wp-caption-text"><?php echo esc_html( $image_caption ); ?></figcaption>
									<?php
								}
							}
						}
						?>
					</figure>
				<?php endif; ?>

				<?php if ( ! is_singular() ) : ?>
					<div class="article-summary">
						<?php
						global $post;

						/*
						* If a manual excerpt is available, default to that. If `<!--more-->` exists in content,
						* default to that. If an option is set specifically to display excerpts, default to that.
						* Otherwise show full content.
						*/
						if ( $post->post_excerpt ) {
							echo wp_kses_post( get_the_excerpt() ) . ' <a href="' . esc_url( get_permalink() ) . '"><span class="excerpt-more-default">&rarr; More ...</span></a>';
						} elseif ( strstr( $post->post_content, '<!--more-->' ) ) {
							the_content( '<span class="content-more-default">&rarr; More ...</span>' );
						} elseif ( 'excerpt' === spine_get_option( 'archive_content_display' ) ) {
							the_excerpt();
						} else {
							the_content();
						}
						?>
					</div><!-- .article-summary -->
				<?php else : ?>
					<div class="article-body">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>

				<footer class="article-footer">
					<?php terms_lists\all_terms_by_post_type(); ?>
				</footer><!-- .entry-meta -->

			</article>
		</div><!--/column-->
	</section>
	<?php
endwhile;
