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
		<time class="article-date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
	</header>

	<?php
	if ( spine_has_thumbnail_image() ) {
		$article_image_type = 'thumbnail-image';
	} elseif ( spine_has_featured_image() ) {
		$article_image_type = 'feature-image';
		$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
	}
	?>

	<?php if ( ! empty( $article_image_type ) ) : ?>
		<figure class="article-image <?php echo esc_attr( $article_image_type ); ?>">
			<?php
			if ( ! is_singular() ) {
				if ( 'thumbnail' === $article_image_type ) {
					?><a href="<?php the_permalink(); ?>"><?php spine_the_thumbnail_image(); ?></a><?php
				} else {
					?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'spine-thumbnail_size' ); ?></a><?php
				}
			} else {
				?>
				<a href="<?php esc_url( spine_get_featured_image_src() ); ?>">
					<?php spine_the_featured_image(); ?>
				</a>
				<?php if ( ! empty( $image_caption ) ) { ?>
					<figcaption class="wp-caption-text"><?php echo esc_html( $image_caption ); ?></figcaption>
				<?php }
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
				echo get_the_excerpt() . ' <a href="' . get_permalink() . '"><span class="excerpt-more-default">&rarr; More ...</span></a>';
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
		<?php // get_template_part( 'parts/share-tools' ); ?>

		<?php the_terms( get_the_ID(), 'hrsunit', '<p class="hrs-unit">', ', ', '</p>' ); ?>

	<?php
	// Display site level categories attached to the post.
	if ( has_category() ) {
		echo '<dl class="categorized">';
		echo '<dt><span class="categorized-default">Categorized</span></dt>';
		foreach ( get_the_category() as $category ) {
			echo '<dd><a href="' . get_category_link( $category->cat_ID ) . '">' . $category->cat_name . '</a></dd>';
		}
		echo '</dl>';
	}

	// Display University categories attached to the post.
	if ( taxonomy_exists( 'wsuwp_university_category' ) && has_term( '', 'wsuwp_university_category' ) ) {
		$university_category_terms = get_the_terms( get_the_ID(), 'wsuwp_university_category' );
		if ( ! is_wp_error( $university_category_terms ) ) {
			echo '<dl class="university-categorized">';
			echo '<dt><span class="university-categorized-default">Categorized</span></dt>';

			foreach ( $university_category_terms as $term ) {
				$term_link = get_term_link( $term->term_id, 'wsuwp_university_category' );
				if ( ! is_wp_error( $term_link ) ) {
					echo '<dd><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></dd>';
				}
			}
			echo '</dl>';
		}
	}

	// Display University tags attached to the post.
	if ( has_tag() ) {
		echo '<dl class="tagged">';
		echo '<dt><span class="tagged-default">Tagged</span></dt>';
		foreach ( get_the_tags() as $tag ) {
			echo '<dd><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a></dd>';
		}
		echo '</dl>';
	}

	// Display University locations attached to the post.
	if ( taxonomy_exists( 'wsuwp_university_location' ) && has_term( '', 'wsuwp_university_location' ) ) {
		$university_location_terms = get_the_terms( get_the_ID(), 'wsuwp_university_location' );
		if ( ! is_wp_error( $university_location_terms ) ) {
			echo '<dl class="university-location">';
			echo '<dt><span class="university-location-default">Location</span></dt>';

			foreach ( $university_location_terms as $term ) {
				$term_link = get_term_link( $term->term_id, 'wsuwp_university_location' );
				if ( ! is_wp_error( $term_link ) ) {
					echo '<dd><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></dd>';
				}
			}
			echo '</dl>';
		}
	}

	// If a user has filled out their description and this is a multi-author blog, show a bio on their entries.
	if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
		<div class="author-info">
			<div class="author-avatar">
				<?php
				/** This filter is documented in author.php */
				$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
				echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
				?>
			</div><!-- .author-avatar -->
			<div class="author-description">
				<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
				<p><?php the_author_meta( 'description' ); ?></p>
				<?php if ( '1' === spine_get_option( 'show_author_page' ) ) : ?>
				<div class="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
					</a>
				</div><!-- .author-link	-->
				<?php endif; ?>
			</div><!-- .author-description -->
		</div><!-- .author-info -->
	<?php endif; ?>
	</footer><!-- .entry-meta -->

</article>
