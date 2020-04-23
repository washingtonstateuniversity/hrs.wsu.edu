<?php
/**
 * Single Page Layout Template
 *
 * The template for layout out the content of page content in single page views.
 *
 * @package HrswpTheme
 * @since 0.17.6
 */

namespace HrswpTheme\templates\single;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-content' ); ?>>

	<?php if ( true === spine_get_option( 'articletitle_show' ) ) : ?>
		<header class="article-header">
			<h1 class="article-title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>

	<?php
	if ( spine_has_featured_image() ) :
		$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
		?>
		<figure class="article-image article-feature">
			<a href="<?php echo esc_url( spine_get_featured_image_src() ); ?>">
				<?php spine_the_featured_image(); ?>
			</a>
			<?php if ( ! empty( $image_caption ) ) : ?>
				<figcaption class="wp-caption-text"><?php echo wp_kses_post( $image_caption ); ?></figcaption>
			<?php endif; ?>
		</figure>
		<?php
	endif;
	?>

	<div class="article-body">
		<?php the_content(); ?>
	</div>

</article>
