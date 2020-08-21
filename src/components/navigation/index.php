<?php
/**
 * Rendering of the HRSWP Theme post navigation
 *
 * @package HrswpTheme
 * @since 0.17.0
 * @since 2.0.0 Consolidated into the components directory
 */

namespace HrswpTheme\components\navigation;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Displays the post archive page navigation.
 *
 * Retrieves and displays the pagination navigation section on archive type
 * pages such as Home or a category archives page.
 *
 * @since 0.17.0
 *
 * @param int $total_pages The total number of pages to show in the pagination navigation.
 */
function render( $total_pages = '' ) {
	$args = array(
		'base'               => str_replace( 99164, '%#%', esc_url( get_pagenum_link( 99164 ) ) ),
		'format'             => 'page/%#%',
		'type'               => 'list',
		'current'            => max( 1, get_query_var( 'paged' ) ),
		'prev_text'          => 'Previous <span class="screen-reader-text">page</span>',
		'next_text'          => 'Next <span class="screen-reader-text">page</span>',
		'before_page_number' => '<span class="screen-reader-text">Page </span>',
	);

	if ( '' !== $total_pages ) {
		$args['total'] = $total_pages;
	}

	$pagination = paginate_links( $args );

	if ( ! empty( $pagination ) ) {
		?>
		<footer class="article-footer">
			<section class="row single pager prevnext gutter pad-ends">
				<div class="column one">
					<nav class="navigation pagination" role="navigation" aria-label="Pagination navigation">
						<?php echo wp_kses_post( $pagination ); ?>
					</nav>
				</div>
			</section>
		</footer>
		<?php
	}
}
