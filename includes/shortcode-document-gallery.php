<?php
/**
 * HRS Child Theme Documents Gallery: Shortcode
 *
 * @package WSU_Human_Resources_Services
 * @since 0.13.0
 */

namespace WSU\HRS\Shortcode_Documents_Gallery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_shortcode( 'hrsgallery', __NAMESPACE__ . '\hrs_gallery' );

/**
 * Builds the HRS Documents Gallery shortcode output.
 *
 * Mostly just a slimmed-down and adjusted duplicate of the WP Gallery
 * shortcode {@see gallery_shortcode}. This version includes PDF docs
 * in its output, allowing users to create a "gallery" of PDF documents
 * and/or images represented either by thumbnails (if capable) or icons.
 *
 * @since 0.13.0
 *
 * @param array $attr {
 *     Attributes of the HRS gallery shortcode
 *
 *     @type string $order      Order of the images in the gallery. Default 'ASC'. Accepts 'ASC', 'DESC'.
 *     @type string $orderby    The field to use when ordering images. Default 'menu_order ID'.
 *                              Accepts any valid SQL ORDERBY statement.
 *     @type int $id            A Post ID used to get default attachments.
 *     @type string $itemtag    HTML tag to use for each image in the gallery. Default 'dl',
 *                              or 'figure' if the theme registered support for HTML5.
 *     @type string $icontag    HTML tag to use for each image's icon. Default 'dt', of 'div'
 *                              if the theme registered support for HTML5.
 *     @type string $captiontag HTML tag to use for each image's caption. Default 'dd', or 'figcaption'
 *                              if the theme registered support for HTML5.
 *     @type int $columns       Number of columns of images to display. Default 3.
 *     @type string|array $size Size of the images to display. Accepts any valid size, or an array of
 *                              width and height values (in that order) in pixels. Default 'thumbnail'.
 *     @type string $ids        A comma-separated list of IDs of attachments to display. Default empty.
 *     @type string $urls       A comma-separated list of URLs of attachments to display. Default empty.
 *     @type string $include    A comma-separated list of IDs of attachments to include. Default empty.
 *     @type string $exclude    A comma-separated list of IDs of attachments to exclude. Default empty.
 *     @type string $link       What to link each image to. Default empty (links to the attachment page.)
 *                              Accepts 'file' or 'none'.
 * }
 * @return string HTML content to display a gallery.
 */
function hrs_gallery( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	// Build the includes array if the user specified IDs.
	if ( ! empty( $attr['ids'] ) || ! empty( $attr['urls'] ) ) {
		$attr['include'] = '';
		// Order 'ids' by `post__in` unless otherwise specified.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		// If given comma-separated URLs, try to get the attachment IDs.
		if ( ! empty( $attr['urls'] ) ) {
			$_urls = explode( ',', $attr['urls'] );
			foreach ( $_urls as $url ) {
				$att_id           = attachment_url_to_postid( esc_url( $url ) );
				$attr['include'] .= $att_id ? $att_id . ',' : '';
			}
		}
		$attr['include'] .= $attr['ids'];
	}

	// Check for <figure> element support.
	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts  = shortcode_atts(
		array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'itemtag'    => $html5 ? 'figure' : 'dl',
			'icontag'    => $html5 ? 'div' : 'dt',
			'captiontag' => $html5 ? 'figcaption' : 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'useicon'    => false,
			'include'    => '',
			'exclude'    => '',
			'link'       => 'file',
		),
		$attr,
		'hrsthumb'
	);

	$id = intval( $atts['id'] );

	// Retrieve the attachments.
	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts(
			array(
				'include'        => $atts['include'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image,application/pdf',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		// Uses get_children to use linked attachments as the includes.
		$attachments = get_children(
			array(
				'post_parent'    => $id,
				'exclude'        => $atts['exclude'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image,application/pdf',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);
	} else {
		// If no attachments are specified, default to those attached to the current post.
		$attachments = get_children(
			array(
				'post_parent'    => $id,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image,application/pdf',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	// Build elements.
	$itemtag    = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag    = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );

	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dd';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}

	$columns    = intval( $atts['columns'] );
	$selector   = "hrs-gallery-{$instance}";
	$size_class = sanitize_html_class( $atts['size'] );

	$output = "<div id='{$selector}' class='gallery hrs-gallery gallery-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$attr = ( trim( $attachment->post_excerpt ) ) ? array(
			'aria-describedby' => "selector-$id",
		) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, $atts['useicon'], false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, $atts['useicon'], false, $attr );
		}
		$image_meta = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
				<{$icontag} class='gallery-icon {$orientation}'>
					{$image_output}
				</{$icontag}>";
		if ( $captiontag && trim( $attachment->post_excerpt ) ) {
			$output .= "
					<{$captiontag} class='wp-caption-text gallery-caption' id='{$selector}-{$id}'>
					" . wptexturize( $attachment->post_excerpt ) . "
					</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( ! $html5 && $columns > 0 && 0 === ( $i + 1 ) % $columns ) {
			$output .= '<br style="clear: both" />';
		}
	}

	$output .= "
			</div>\n";

	return $output;
}
