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

get_header();
?>

<main id="wsuwp-main" class="spine-hrs_unit-index">

	<header class="page-header">
		<h1><?php esc_html_e( 'News from Human Resource Services', 'hrs-wsu-edu' ); ?></h1>
	</header>

	<?php
	if ( have_posts() ) :
		$result_count = 0;
		while ( have_posts() ) :
			the_post();
			if ( ! is_paged() ) {

				if ( 0 === $result_count ) {
					$is_feature = true;
					?>
					<section class="row single gutter pad-ends features">
						<div class="column one">
							<div class="articles-list">
					<?php
				}

				if ( 1 === $result_count ) {
					$is_feature = false;

					?>
							</div><!-- .articles-list -->

							<?php
							$reminders = WSU\HRS\Queries\get_reminder_posts( 'objects' );

							if ( false !== $reminders && $reminders->have_posts() ) {
								?>
								<div class="reminders">
									<h2><?php esc_html_e( 'Reminders', 'hrs-wsu-edu' ); ?></h2>
									<ul>
										<?php
										while ( $reminders->have_posts() ) :
											$reminders->the_post();
											?>
											<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
											<?php
										endwhile;
										?>
									</ul>
								</div>
								<?php
							}

							wp_reset_postdata();
							?>
						</div>
					</section><!-- .features -->

					<section class="row single gutter pad-ends latest">
						<div class="column one">
							<div class="cards">
					<?php
				}

				if ( 5 === $result_count ) {
					?>
							</div>
						</div>
					</section><!-- .latest -->

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
								<h2><?php esc_html_e( 'More News from HRS', 'hrs-wsu-edu' ); ?></h2>
							</header>
							<div class="articles-list">
					<?php
				}
			} else {
				if ( 0 === $result_count ) {
					?>
					<section class="row single gutter pad-ends article-archive">
						<div class="column one">
							<div class="articles-list">
					<?php
				}
			}

			get_template_part( 'articles/archive-content' );

			$result_count++;

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

<?php
get_footer();
