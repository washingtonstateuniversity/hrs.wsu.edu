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
 * @return string|false|WP_Error List of terms on success, false if no taxonomy or terms exist, WP_Error on failure.
 */
function get_terms( $id, $taxonomy ) {

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

	$container_start = '<dl class="article-taxonomy ' . esc_attr( $taxonomy ) . '">';
	$container_end   = '</dl>';
	$terms_list      = array();

	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term->term_id, $taxonomy );
		if ( ! is_wp_error( $term_link ) ) {
				$terms_list[] = '<dd><a href="' . esc_url( $term_link ) . '">' . esc_html( $term->name ) . '</a></dd>';
		}
	}

	return $container_start . '<dt>' . esc_html( $term_title ) . '</dt>' . join( '', $terms_list ) . $container_end;
}

/**
 * Displays a post's terms in a custom format.
 *
 * @since 0.14.0
 *
 *
 * @return false|void False on WordPress error.
 */
function the_terms( $id, $taxonomy ) {
	$terms_list = \WSU\HRS\Template_Tags\get_terms( $id, $taxonomy );

	if ( is_wp_error( $terms_list ) ) {
		return false;
	}

	echo wp_kses_post( $terms_list );
}
