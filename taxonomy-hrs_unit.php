<?php
/**
 * HRS Unit Taxonomy Archive Template
 *
 * The template for displaying lists of posts in the custom HRS Unit taxonomy.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

use HrswpTheme\components\navigation;

global $is_feature;

get_header();
?>

<main id="wsuwp-main" class="spine-hrs_unit-index">

	<header class="page-header">
		<?php /* translators: the HRS news archive title: 1: the taxonomy name */ ?>
		<h1><?php printf( esc_html__( 'HRS News from %s', 'hrswp-theme' ), single_term_title( '', false ) ); ?></h1>
	</header>

	<?php
	if ( have_posts() ) {
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
							</div>
						</div>
					</section><!-- .features -->
					<section class="row single gutter pad-ends latest">
						<div class="column one">
							<div class="cards">
					<?php
				}

				if ( 4 === $result_count ) {
					?>
							</div>
						</div>
					</section><!-- .latest -->
					<section class="row single gutter pad-ends article-archive">
						<div class="column one">
							<header>
								<h2>More from <?php single_term_title(); ?></h2>
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
	}

	navigation\render();

	get_template_part( 'parts/footers' );
	?>
</main><!--/#page-->
<?php
get_footer();
