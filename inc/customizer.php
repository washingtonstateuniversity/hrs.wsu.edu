<?php
/**
 * The HRSWP Theme Customizer controls
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\customizer;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Removes the Customizer Custom CSS section.
 *
 * All CSS should go through GitHub for the HRSWP Theme.
 *
 * @since 1.1.0
 *
 * @param WP_Customize_Manager $wp_customize WP_Customize_Manager instance.
 */
function remove_custom_css_control( $wp_customize ) {
	$wp_customize->remove_control( 'custom_css' );
}
add_action( 'customize_register', __NAMESPACE__ . '\remove_custom_css_control' );
