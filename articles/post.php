<?php
/**
 * Article Content Template
 *
 * The template for displaying the contents of an individual article on either a
 * single post page view or as part of an archive view showing a list of
 * articles.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

use WSU\HRS\Template_Tags as Tags;
?>

<?php $post_share_placement = spine_get_option( 'post_social_placement' ); ?>

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
		<?php Tags\the_post_time_html(); ?>
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
			?>
		</figure>
	<?php endif; ?>

	<?php if ( ! is_singular() ) : ?>
		<div class="article-summary">
			<?php

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
		<?php Tags\all_terms_by_post_type(); ?>
	</footer><!-- .entry-meta -->

</article>
