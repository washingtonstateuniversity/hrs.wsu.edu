<?php
/**
 * Default Attachment Template
 *
 * This template handles the presentation of attachment pages for uploads.
 * We don't want to display individual pages for each attachment. Instead
 * we redirect automatically to the attachment's parent post if it exists and
 * the attachment file itself if it doesn't.
 *
 * @package WSU_Human_Resources_Services
 * @since 1.4.0
 */
global $post;

if ( $post && $post->post_parent ) {
	wp_safe_redirect( esc_url( get_permalink( $post->post_parent ) ), 301 );
	exit();
} else {
	wp_safe_redirect( esc_url( wp_get_attachment_url() ), 301 );
	exit();
}
