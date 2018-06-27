<?php
/**
 * Default Archive Template
 *
 * The template for displaying lists of posts by category, tag, or taxonomy.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

if ( is_category() ) {
	$index_type = 'category';
	/* translators: the category archive page title: 1: the category name. */
	$archive_title = sprintf( __( '%s News' ), single_cat_title( '', false ) );
} elseif ( is_tag() ) {
	$index_type = 'tag';
	/* translators: the tag archive page title: 1: the tag name. */
	$archive_title = sprintf( __( '%s News' ), single_tag_title( '', false ) );
} elseif ( is_tax() ) {
	$index_type = 'tax';
	/* translators: the taxonomy archive page title: 1: the taxonomy name. */
	$archive_title = sprintf( __( '%s News' ), single_term_title( '', false ) );
} elseif ( is_author() ) {
	$index_type = 'author';
	/* translators: the author archive page title: 1: the author name. */
	$archive_title = sprintf( __( 'News from %s' ), get_the_author() );
} else {
	$index_type    = 'default';
	$archive_title = __( 'HRS News' );
}

$page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

get_header();
?>

<main id="wsuwp-main" class="spine-<?php echo esc_attr( $index_type ); ?>-index">

	<header class="page-header">
		<h1><?php echo esc_html( $archive_title ); ?></h1>
	</header>

	<?php
	if ( have_posts() ) :
		$output_post_count = 0;

		while ( have_posts() ) : the_post();

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

			get_template_part( 'articles/archive-content' );

			$output_post_count++;

		endwhile;
		?>
						</div>
					</div><!--/column-->
				</section>

		<?php
	endif;

	//wp_reset_postdata();
	?>

	<?php get_template_part( 'parts/footers' ); ?>

</main><!--/#page-->

<?php get_footer();
