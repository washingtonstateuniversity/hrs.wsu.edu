<?php
/**
 * Template tags for the HRS child theme.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.14.0
 */

namespace WSU\HRS\Template_Tags;

/**
 * Retrieves a post's terms in a custom format.
 *
 * Format and display the HRS News unit terms as an HTML string, if the post
 * has terms assigned.
 *
 * @since 0.14.0
 *
 * @param int $id Post ID
 * @param string $taxonomy The taxonomy name.
 * @param bool $show_title Optional. Whether to display the taxonomy title. Default true.
 * @param string $container_tag Optional. The HTML element used to contain the list of terms. Default is a data list (`dl` tag).
 * @param string $item_tag Optional. The HTML element used to contain each item in the list of terms. Default is a data list definition (`dd` tag).
 * @return string|false|WP_Error List of terms on success, false if no taxonomy or terms exist, WP_Error on failure.
 */
function get_terms( $id, $taxonomy, $show_title = true, $container_tag = 'dl', $item_tag = 'dd' ) {

	if ( ! isset( $taxonomy ) || ! taxonomy_exists( $taxonomy ) ) {
		return false;
	}

	$taxonomy_obj = get_taxonomy( $taxonomy );

	if ( 'category' === $taxonomy ) {
		$terms      = get_the_category();
		$term_title = __( 'Categorized' );
	} elseif ( 'post_tag' === $taxonomy ) {
		$terms      = get_the_tags();
		$term_title = __( 'Tagged' );
	} else {
		$terms      = get_the_terms( $id, $taxonomy );
		$term_title = $taxonomy_obj->labels->singular_name;
	}

	if ( is_wp_error( $terms ) ) {
		return $terms;
	}

	if ( empty( $terms ) ) {
		return false;
	}

	$container_start = '<' . $container_tag . ' class="article-taxonomy ' . esc_attr( $taxonomy ) . '">';
	$container_end   = '</' . $container_tag . '>';
	$term_title      = ( true === $show_title ) ? '<dt>' . esc_html( $term_title ) . '</dt>' : '';
	$terms_list      = array();

	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term->term_id, $taxonomy );
		if ( ! is_wp_error( $term_link ) ) {
				$terms_list[] = '<' . $item_tag . '><a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a></' . $item_tag . '>';
		}
	}

	return $container_start . $term_title . join( '', $terms_list ) . $container_end;
}

/**
 * Displays a post's terms in a custom format.
 *
 * @since 0.14.0
 *
 * @param int $id Post ID
 * @param string $taxonomy The taxonomy name.
 * @param bool $show_title Optional. Whether to display the taxonomy title. Default true.
 * @param string $container_tag Optional. The HTML element used to contain the list of terms. Default is a data list (`dl` tag).
 * @param string $item_tag Optional. The HTML element used to contain each item in the list of terms. Default is a data list definition (`dd` tag).
 * @return false|void False on WordPress error.
 */
function the_terms( $id, $taxonomy, $show_title = true, $container_tag = 'dl', $item_tag = 'dd' ) {
	$terms_list = \WSU\HRS\Template_Tags\get_terms( $id, $taxonomy, $show_title, $container_tag, $item_tag );

	if ( is_wp_error( $terms_list ) ) {
		return false;
	}

	echo wp_kses_post( $terms_list );
}

/**
 * Displays a gallery of all terms in a given taxonomy.
 *
 * @since 0.15.0
 *
 * @param string $taxonomy The taxonomy name.
 * @return string The taxonomy output formatted as an unordered gallery list.
 */
function the_terms_gallery( $taxonomy ) {
	$list = wp_list_categories( array(
		'echo'       => false,
		'hide_empty' => 0,
		'taxonomy'   => $taxonomy,
		'title_li'   => '',
	) );

	$list = str_replace( 'cat-item', 'gallery-item cat-item', $list );

	echo wp_kses_post( $list );
}

/**
 * Displays the latest HRS posts.
 *
 * @since 0.16.0
 *
 * @param array  $args {
 *     Optional. Arguments to filter retrieval of HRS posts.
 *
 *     @type int $posts_per_page   Total number of posts to display. Default 5. Accepts -1 for all.
 *     @type int $offset           Number of posts to offset return by. Default 0.
 *     @type int|string $category  Category ID or comma-separated list of IDs to include. Detault 0.
 *     @type string $hrs_unit      Slug of the hrs_unit taxonomy term to filter results by. Accepts
 *                                 multiple slugs separated by either commas (to include multiple
 *                                 categories), or plus signs (to require multiple categories).
 *     @type string $style         The style used to display the posts list. If 'cards' posts will
 *                                 display as individual cards in a grid. If 'list' posts will display
 *                                 as a grid row list of flex items. Enter any other value for a custom
 *                                 class or leave empty for no container. Default 'cards'.
 * }
 * @return string HTML formatted list of retrieved HRS News posts
 */
function hrs_recent_posts( $args = null ) {
	global $post;

	$defaults = array(
		'posts_per_page' => 5,
		'offset'         => 0,
		'category'       => 0,
		'hrs_unit'       => '',
		'style'          => 'cards',
	);

	$query = wp_parse_args( $args, $defaults );
	$posts = hrs_get_recent_posts( $query );

	if ( ! empty( $posts ) ) :

		if ( ! empty( $query['style'] ) ) {
			if ( 'cards' === $query['style'] ) {
				echo '<div class="recent-articles">';
			} elseif ( 'list' === $query['style'] ) {
				echo '<div class="articles-list">';
			} else {
				printf( '<div class="%s">', esc_attr( $query['style'] ) );
			}
		}

		foreach ( $posts as $post ) {
			setup_postdata( $post );
			get_template_part( 'articles/archive-content' );
		}

		if ( ! empty( $query['style'] ) ) {
			echo '</div>';
		}

	endif;

	wp_reset_postdata();
}

/**
 * Retrieve recent posts from a given taxonomy.
 *
 * @since 0.16.0
 *
 * @see WP_Query::parse_query()
 *
 * @param array  $args {
 *     Optional. Arguments to filter retrieval of news posts.
 *               See WP_Query::parse_query() for explanation of parameters.
 *
 *     @type int $posts_per_page   Total number of posts to display. Default 5. Accepts -1 for all.
 *     @type int $offset           Number of posts to offset return by. Default 0.
 *     @type int|string $category  Category ID or comma-separated list of IDs to include. Detault 0.
 *     @type string $hrs_unit      Slug of the hrs_unit taxonomy term to filter results by. Accepts
 *                                 multiple slugs separated by either commas (to include multiple
 *                                 categories), or plus signs (to require multiple categories).
 * }
 * @return array|false List of post objects or false if no posts match request.
 */
function hrs_get_recent_posts( $args = null ) {
	$defaults = array(
		'posts_per_page' => 5,
		'offset'         => 0,
		'category'       => 0,
		'hrs_unit'       => '',
	);

	$query = wp_parse_args( $args, $defaults );

	if ( ! empty( $query['hrs_unit'] ) ) {
		/*
		 * Check for multiple terms in request:
		 *  - comma-separated for inclusive (this OR that)
		 *  - plus-separated for exclusive (this AND that)
		 */
		if ( strpos( $query['hrs_unit'], ',' ) !== false ) {
			// Set up array with 'OR' comparison.
			$tax_query = array(
				'relation' => 'OR',
			);

			// Split terms into an array.
			$units = preg_split( '/[,\s]+/', $query['hrs_unit'] );

			// Build WP_Query formatted tax_query array.
			foreach ( $units as $unit ) {
				$or_tax = array(
					'taxonomy' => 'hrs_unit',
					'field'    => 'slug',
					'terms'    => $unit,
				);

				$tax_query[] = $or_tax;
			}
		} elseif ( strpos( $query['hrs_unit'], '+' ) !== false ) {
			// Set up array with 'AND' comparison.
			$tax_query = array(
				'relation' => 'AND',
			);

			// Split terms into an array.
			$units = preg_split( '/[+]+/', $query['hrs_unit'] );

			// Build WP_Query formatted tax_query array.
			foreach ( $units as $unit ) {
				$and_tax = array(
					'taxonomy' => 'hrs_unit',
					'field'    => 'slug',
					'terms'    => $unit,
				);

				$tax_query[] = $and_tax;
			}
		} else {
			$tax_query = array(
				array(
					'taxonomy' => 'hrs_unit',
					'field'    => 'slug',
					'terms'    => $query['hrs_unit'],
				),
			);
		}

		$query['tax_query'] = $tax_query;
	}

	$results = get_posts( $query );

	if ( ! empty( $results ) ) {
		return $results;
	}

	return false;
}

/**
 * Displays the post archive page navigation.
 *
 * Retrieves and displays the pagination navigation section on archive type
 * pages such as Home or a category archives page.
 *
 * @since 0.17.0
 */

function hrs_pagination( $total_pages = '' ) {
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
