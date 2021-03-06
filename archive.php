<?php
/**
 * Default Archive Template
 *
 * The template for displaying lists of posts by category, tag, or taxonomy.
 *
 * @package HrswpTheme
 * @since 0.14.0
 */

use HrswpTheme\components\navigation;

global $is_feature;

if ( is_category() ) {
	$index_type = 'category';
	/* translators: the category archive page title: 1: the category name. */
	$archive_title = sprintf( __( '%s News', 'hrswp-theme' ), single_cat_title( '', false ) );
} elseif ( is_tag() ) {
	$index_type = 'tag';
	/* translators: the tag archive page title: 1: the tag name. */
	$archive_title = sprintf( __( '%s News', 'hrswp-theme' ), single_tag_title( '', false ) );
} elseif ( is_tax() ) {
	$index_type = 'tax';
	/* translators: the taxonomy archive page title: 1: the taxonomy name. */
	$archive_title = sprintf( __( '%s News', 'hrswp-theme' ), single_term_title( '', false ) );
} elseif ( is_author() ) {
	$index_type = 'author';
	/* translators: the author archive page title: 1: the author name. */
	$archive_title = sprintf( __( 'News from %s', 'hrswp-theme' ), get_the_author() );
} else {
	$index_type    = 'default';
	$archive_title = __( 'HRS News', 'hrswp-theme' );
}

$is_feature = false;

get_header();
?>

<main id="wsuwp-main" class="spine-<?php echo esc_attr( $index_type ); ?>-index">

	<header class="page-header">
		<h1><?php echo esc_html( $archive_title ); ?></h1>
	</header>

	<?php
	if ( have_posts() ) :
		$output_post_count = 0;

		while ( have_posts() ) :
			the_post();

			if ( ! is_paged() ) {

				if ( 0 === $output_post_count ) {
					?>
					<section class="row single gutter pad-ends latest">
						<div class="column one">
							<div class="cards">
					<?php
				}

				if ( 4 === $output_post_count ) {
					?>
							</div>
						</div>
					</section>
					<section class="row single gutter pad-ends article-archive">
						<div class="column one">
							<header>
								<h2>More <?php echo esc_html( $archive_title ); ?></h2>
							</header>
							<div class="articles-list">
					<?php
				}
			} else {
				if ( 0 === $output_post_count ) {
					?>
					<section class="row single gutter pad-ends article-archive">
						<div class="column one">
							<div class="articles-list">
					<?php
				}
			}

			get_template_part( 'build/templates/archive' );

			$output_post_count++;

		endwhile;
		?>
						</div>
					</div><!--/column-->
				</section>

		<?php
	endif;

	navigation\render();

	get_template_part( 'build/templates/footer' );
	?>

</main><!--/#page-->

<?php
get_footer();
