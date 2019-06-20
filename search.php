<?php
/**
 * Search Template
 *
 * The template for displaying search results.
 *
 * @package WSU_Human_Resources_Services
 * @since 1.0.0
 */

get_header();
?>

<main id="wsuwp-main" class="spine-search-index">
	<?php
	if ( have_posts() ) {
		?>
		<header class="page-header">
			<h1>
				<?php esc_html_e( 'Search results for: ', 'hrs-wsu-edu' ); ?>
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
						get_template_part( 'articles/archive-content' );
					endwhile;
					?>

				</div>
			</div><!--/column-->
		</section>

		<?php
		\WSU\HRS\Template_Tags\hrs_pagination();
	} else {
		?>
		<header class="page-header">
			<h1>
				<?php esc_html_e( 'No search results for:', 'hrs-wsu-edu' ); ?>
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

	get_template_part( 'parts/footers' );
	?>

</main><!--/#page-->

<?php
get_footer();
