<?php
/**
 * HRS Posts Home Template
 *
 * The template for displaying the posts page showing the latest of all posts.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */
global $is_feature;

$page            = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$is_feature      = false;
$exclude_post_id = array();

get_header();
?>

<main id="wsuwp-main" class="spine-hrs_unit-index">

	<header class="page-header">
		<h1><?php esc_html_e( 'News from Human Resource Services', 'hrs-wsu-edu' ) ?></h1>
	</header>

	<?php
	// Display the feature layout and reminders section only on the first page.
	if ( have_posts() && ! is_paged() ) :
		?>

		<section class="row single gutter pad-ends features">
			<div class="column one">
				<div class="articles-list">

					<?php
					while ( have_posts() ) : the_post();

						$exclude_post_id[] = get_the_ID();

						$is_feature = true;

						get_template_part( 'articles/archive-content' );

						break;

					endwhile;
					?>

				</div>

				<?php
				$reminders = WSU\HRS\Queries\get_reminder_posts( 'objects' );

				if ( $reminders->have_posts() ) :
					?>
					<div class="reminders">
						<h2><?php esc_html_e( 'Reminders', 'hrs-wsu-edu' ); ?></h2>
						<ul>
							<?php
							while ( $reminders->have_posts() ) : $reminders->the_post();
								$exclude_post_id[] = get_the_ID();
								?>
								<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
								<?php
							endwhile;
							?>
						</ul>
					</div>
						<?php
				endif;
				?>

			</div>
		</section>

		<?php
	endif; // End of the feature and reminders sections.

	$is_feature = false;

	$archive_query = new WP_Query( array(
		'posts_per_page' => 10,
		'post__not_in'   => $exclude_post_id,
		'paged'          => absint( $page ),
	) );

	if ( $archive_query->have_posts() ) :
		$output_post_count = 0;

		while ( $archive_query->have_posts() ) : $archive_query->the_post();

			// Display special layout and content on the first page only.
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

					<section class="row single gutter pad-ends hrs-units-browse">
						<div class="column one">
							<header>
								<h2><?php esc_html_e( 'Latest From ...', 'hrs-wsu-edu' ); ?></h2>
							</header>
							<ul class="gallery gallery-columns-3">
								<?php \WSU\HRS\Template_Tags\the_terms_gallery( 'hrs_unit' ); ?>
							</ul>
						</div>
					</section>

					<section class="row single gutter pad-ends article-archive">
						<div class="column one">
							<header>
								<h2>More News from HRS</h2>
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

	\WSU\HRS\Template_Tags\hrs_pagination();

	get_template_part( 'parts/footers' );
	?>

</main><!--/#page-->

<?php get_footer();
