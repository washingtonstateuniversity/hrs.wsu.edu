<?php
/**
 * Search Template
 *
 * The template for displaying search results.
 *
 * @package HrswpTheme
 * @since 1.0.0
 */

use HrswpTheme\components\navigation;

get_header();
?>

<main id="wsuwp-main" class="spine-search-index">
	<?php
	if ( have_posts() ) {
		global $wp_query;
		?>
		<header class="page-header">
			<h1>
				<?php esc_html_e( 'Search results for: ', 'hrswp-theme' ); ?>
				<span class="search-query"><?php echo get_search_query(); ?></span>
			</h1>
			<span class="meta">Found about <?php echo esc_html( absint( $wp_query->found_posts ) ); ?> results.</span>
		</header>

		<section class="row single gutter pad-bottom">
			<div class="column one">
				<div class="notification--light">
					<p>Didn't find what you were looking for? <a target="_blank" rel="noopener noreferrer" class="button--flat" href="https://search.wsu.edu/">Try the WSU site search &rarr; <span class="screen-reader-text">(Link opens in a new window.)</span></a></p>
				</div>
				<div class="articles-list">

					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'build/templates/archive' );
					endwhile;
					?>

				</div>
			</div><!--/column-->
		</section>

		<?php
		navigation\render();
	} else {
		?>
		<header class="page-header">
			<h1>
				<?php esc_html_e( 'No search results for:', 'hrswp-theme' ); ?>
				<span class="search-query"><?php echo get_search_query(); ?></span>
			</h1>
		</header>

		<section class="row single gutter pad-ends article-archive">
			<div class="column one">
				<div class="notification--light">
					<p>Didn't find what you were looking for? <a target="_blank" rel="noopener noreferrer" class="button--flat" href="https://search.wsu.edu/">Try the WSU site search &rarr; <span class="screen-reader-text">(Link opens in a new window.)</span></a></p>
				</div>
			</div><!--/column-->
		</section>
		<?php
	}

	get_template_part( 'build/templates/footer' );
	?>

</main><!--/#page-->

<?php
get_footer();
