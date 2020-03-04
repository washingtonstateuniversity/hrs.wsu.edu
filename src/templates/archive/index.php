<?php
/**
 * Archive Post Layout Template
 *
 * The template for layout out the content of individual posts in archive views.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

use WSU\HRS\Template_Tags as Tags;
global $is_feature;
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-content' ); ?>>

		<header class="article-header">
			<p class="article-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</p>
			<?php if ( is_search() ) : ?>
				<span class="meta"><?php the_permalink(); ?></span>
			<?php else : ?>
				<time class="article-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
			<?php endif; ?>
		</header>

		<?php
		if ( spine_has_featured_image() ) :
			$image_size = ( $is_feature ) ? 'spine-large_size' : 'spine-small_size';
			?>
			<figure class="article-image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $image_size ); ?></a>
			</figure>
			<?php
		endif;
		?>

		<div class="article-summary">
			<?php the_excerpt(); ?>
		</div><!-- .article-summary -->

		<?php if ( ! is_tax( 'hrs_unit' ) && has_term( '', 'hrs_unit' ) ) : ?>
			<footer class="article-footer article-taxonomy--primary">
				<?php
				WSU\HRS\Template_Tags\the_terms(
					array(
						'taxonomy'      => 'hrs_unit',
						'show_title'    => false,
						'container_tag' => 'ul',
						'item_tag'      => 'li',
					)
				);
				?>
			</footer><!-- .entry-meta -->
		<?php endif; ?>

	</article>
