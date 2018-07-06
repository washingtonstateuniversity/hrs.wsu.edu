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
