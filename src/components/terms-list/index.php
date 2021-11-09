<?php
/**
 * HRSWP Theme Terms List
 *
 * @package HrswpTheme
 * @since 0.14.0
 * @since 2.0.0 Consolidated into the components directory
 */

namespace HrswpTheme\components\terms_lists;
use HrswpTheme\inc\queries;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Displays a post's terms in a custom format.
 *
 * @since 0.14.0
 *
 * @param array $args {
 *     Optional. Arguments to filter retrieval of HRS posts.
 *
 *     @type int    $id            Post ID
 *     @type string $taxonomy      The taxonomy name.
 *     @type bool   $show_title    Whether to display the taxonomy title. Default true.
 *     @type string $container_tag The HTML element used to contain the list of terms. Default is a data list (`dl` tag).
 *     @type string $item_tag      The HTML element used to contain each item in the list of terms. Default is a data list definition (`dd` tag).
 * }
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

	$terms = queries\get_terms( intval( $atts['id'] ), $atts['taxonomy'] );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return false;
	}

	if ( true === $atts['show_title'] ) {
		if ( 'category' === $atts['taxonomy'] ) {
			$term_title = '<dt>' . __( 'Categorized', 'hrswp-theme' ) . '</dt>';
		} elseif ( 'post_tag' === $atts['taxonomy'] ) {
			$term_title = '<dt>' . __( 'Tagged', 'hrswp-theme' ) . '</dt>';
		} else {
			$taxonomy_obj = get_taxonomy( $atts['taxonomy'] );
			/* translators: The taxonomy name in singular tense */
			$term_title = sprintf( '<dt>%s</dt>', esc_html( $taxonomy_obj->labels->singular_name ) );
		}
	} else {
		$term_title = '';
	}

	$terms_list = array();

	foreach ( $terms as $term ) {
		$term_link = get_term_link( $term->term_id, $atts['taxonomy'] );
		if ( ! is_wp_error( $term_link ) ) {
			$terms_list[] = sprintf(
				/* translators: 1: the list item element tag, 2: the term URL, 3: the term name */
				__( '<%1$s><a class="is-style-secondary" href="%2$s">%3$s</a></%1$s>', 'hrswp-theme' ),
				esc_html( $atts['item_tag'] ),
				esc_url( $term_link ),
				esc_html( $term->name )
			);
		}
	}

	$html = sprintf(
		/* translators: 1: the container element tag name, 2: the containing element class name(s), 3: one or more list items containing term links and names, 4: the taxonomy name */
		__( '<%1$s class="article-taxonomy %2$s">%4$s%3$s</%1$s>', 'hrswp-theme' ),
		esc_html( $atts['container_tag'] ),
		esc_attr( $atts['taxonomy'] ),
		join( '', $terms_list ),
		$term_title
	);

	echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Displays all of the existing terms for a given page.
 *
 * @since 1.6.0
 *
 * @param string $post_type Optional. The name of the post type to display taxonomy term lists form.
 */
function all_terms_by_post_type( $post_type = null ) {
	if ( null === $post_type ) {
		$post_type = get_post_type( get_the_ID() );
	}

	$post_taxonomy_names = get_object_taxonomies( $post_type );

	// Print the post taxonomy lists, if they exist.
	foreach ( $post_taxonomy_names as $taxonomy_name ) {
		the_terms( array( 'taxonomy' => $taxonomy_name ) );
	}
}
