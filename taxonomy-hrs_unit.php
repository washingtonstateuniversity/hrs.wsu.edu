<?php
/**
 * HRS Unit Taxonomy Archive Template
 *
 * The template for displaying lists of posts in the custom HRS Unit taxonomy.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */
global $is_feature;

$page            = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$exclude_post_id = array();
$is_feature      = false;

get_header();
?>

<main id="wsuwp-main" class="spine-hrs_unit-index">

	<header class="page-header">
		<?php /* translators: the HRS news archive title: 1: the taxonomy name */ ?>
		<h1><?php printf( esc_html__( 'HRS News from %s', 'hrs-wsu-edu' ), single_term_title( '', false ) ); ?></h1>
	</header>

	<?php
	if ( have_posts() && 1 === $page ) :
		?>

		<section class="row single gutter pad-ends features">
			<div class="column one">
				<div class="articles-list">

					<?php
					while ( have_posts() ) : the_post();

						$exclude_post_id[] = get_the_ID();

						$is_feature = true;

						get_template_part( 'articles/archive-content' );

					endwhile;
					?>

				</div>
			</div>
		</section>

		<?php
	endif;

	$is_feature = false;

	$archive_query = new WP_Query( array(
		'posts_per_page' => 10,
		'tax_query'      => array(
			array(
				'taxonomy' => 'hrs_unit',
				'field'    => 'slug',
				'terms'    => get_query_var( 'term' ),
			),
		),
		'post__not_in'   => $exclude_post_id,
		'paged'          => absint( $page ),
	) );

	if ( $archive_query->have_posts() ) :
		$output_post_count = 0;

		while ( $archive_query->have_posts() ) : $archive_query->the_post();

			if ( ! is_paged() ) {
				if ( 0 === $output_post_count ) {
					?>
					<section class="row single gutter pad-ends latest">
						<div class="column one">
							<div class="cards">
					<?php
				}

				if ( 3 === $output_post_count ) {
					?>
							</div>
						</div>
					</section>
					<section class="row single gutter pad-ends article-archive">
						<div class="column one">
							<header>
								<h2>More from <?php single_term_title(); ?></h2>
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

			get_template_part( 'articles/archive-content' );

			$output_post_count++;

		endwhile;
		?>
						</div>
					</div><!--/column-->
				</section>

		<?php
	endif;

	\WSU\HRS\Template_Tags\hrs_pagination( $archive_query->max_num_pages );

	get_template_part( 'parts/footers' );
	?>

</main><!--/#page-->

<?php get_footer();
