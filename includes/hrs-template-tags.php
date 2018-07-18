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
 * @return string|false|WP_Error Array of WP_Term objects on success, false if no taxonomy or terms exist, WP_Error on failure.
 */
function get_terms( $id, $taxonomy ) {
	if ( ! isset( $taxonomy ) || ! taxonomy_exists( $taxonomy ) ) {
		return false;
	}

	if ( 'category' === $taxonomy ) {
		$terms = get_the_category();
	} elseif ( 'post_tag' === $taxonomy ) {
		$terms = get_the_tags();
	} else {
		$terms = get_the_terms( $id, $taxonomy );
	}

	if ( is_wp_error( $terms ) ) {
		return $terms;
	}

	if ( empty( $terms ) ) {
		return false;
	}

	return $terms;
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
 * @return string|false HTML formatted list of terms or false if no terms exist or on WordPress error.
 */
function the_terms( $args = array() ) {
	$defaults = array(
		'id'            => get_the_ID(),
		'taxonomy'      => '',
		'show_title'    => true,
		'container_tag' => 'dl',
		'item_tag'      => 'dd',
	);

	$atts = wp_parse_args( $args, $defaults );

	if ( ! isset( $atts['taxonomy'] ) || ! taxonomy_exists( $atts['taxonomy'] ) ) {
		return false;
	}

	$terms = \WSU\HRS\Template_Tags\get_terms( $atts['id'], $atts['taxonomy'] );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return false;
	}

	if ( true === $atts['show_title'] ) {
		if ( 'category' === $atts['taxonomy'] ) {
			$term_title = '<dt>' . __( 'Categorized', 'hrs-wsu-edu' ) . '</dt>';
		} elseif ( 'post_tag' === $atts['taxonomy'] ) {
			$term_title = '<dt>' . __( 'Tagged', 'hrs-wsu-edu' ) . '</dt>';
		} else {
			$taxonomy_obj = get_taxonomy( $atts['taxonomy'] );
			/* translators: The taxonomy name in singular tense */
			$term_title = sprintf( __( '<dt>%s</dt>', 'hrs-wsu-edu' ),
				esc_html( $taxonomy_obj->labels->singular_name )
			);
		}
	} else {
		$term_title = '';
	}

	$terms_list = array();

	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term->term_id, $atts['taxonomy'] );
		if ( ! is_wp_error( $term_link ) ) {
			/* translators: 1: the list item element tag, 2: the term URL, 3: the term name */
			$terms_list[] = sprintf( __( '<%1$s><a href="%2$s">%3$s</a></%1$s>', 'hrs-wsu-edu' ),
				$atts['item_tag'],
				esc_url( $term_link ),
				esc_html( $term->name )
			);
		}
	}

	/* translators: 1: the container element tag name, 2: the containing element class name(s), 3: one or more list items containing term links and names, 4: the taxonomy name */
	$html = sprintf( __( '<%1$s class="class="article-taxonomy %2$s">%4$s%3$s</%1$s>', 'hrs-wsu-edu' ),
		esc_html( $atts['container_tag'] ),
		esc_attr( $atts['taxonomy'] ),
		join( '', $terms_list ),
		$term_title
	);

	echo wp_kses_post( $html );
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
