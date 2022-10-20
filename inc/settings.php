<?php
/**
 * Manages HRS WP settings.
 *
 * @package HrswpTheme
 */

namespace HrswpTheme\inc\settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Displays the HRS required login settings field.
 *
 * @since 3.5.0
 *
 * @return void
 */
function settings_field_require_login(): void {
	$option = 'hrswp_theme_require_login';
	printf(
		'<fieldset>
			<legend class="screen-reader-text"><span>%4$s</span></legend>
			<label for="%1$s">
				<input id="%1$s" type="checkbox" name="%1$s" value="1" %2$s/>
				%3$s
			</label>
		</fieldset>',
		$option,
		checked( '1', get_option( $option ), false ),
		__( 'Require login for frontend access', 'hrswp-theme' ),
		__( 'HRS login requirement settings', 'hrswp-theme' )
	);
}

/**
 * Displays the HRS environment indicator settings field.
 *
 * @since 3.5.0
 *
 * @return void
 */
function settings_field_environment_indicator(): void {
	$option = 'hrswp_theme_env_indicator';
	printf(
		'<fieldset>
			<legend class="screen-reader-text"><span>%4$s</span></legend>
			<label for="%1$s">
				<input id="%1$s" type="checkbox" name="%1$s" value="1" %2$s/>
				%3$s
			</label>
		</fieldset>',
		$option,
		checked( '1', get_option( $option ), false ),
		__( 'Display environment indicator', 'hrswp-theme' ),
		__( 'HRS environment indicator settings', 'hrswp-theme' )
	);
}

/**
 * Displays the HRS settings page.
 *
 * @since 3.5.0
 *
 * @see settings_fields
 * @see do_settings_sections
 * @see submit_button
 * @return void
 */
function settings_page_content(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	ob_start();
	settings_fields( 'hrswp-theme' );
	do_settings_sections( 'hrswp-theme' );
	submit_button();
	$fields = ob_get_contents();
	ob_end_clean();

	printf(
		'<div class="wrap"><h1>%1$s</h1><form action="options.php" method="post">%2$s</form></div>',
		esc_html( get_admin_page_title() ),
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		$fields
	);
}

/**
 * Registers HRS settings and settings form fields.
 *
 * @since 3.5.0
 *
 * @see register_setting
 * @see add_settings_section
 * @see add_settings_field
 */
add_action(
	'admin_init',
	function(): void {
		$slug                 = 'hrswp-theme';
		$login_option         = 'hrswp_theme_require_login';
		$env_indicator_option = 'hrswp_theme_env_indicator';

		register_setting(
			$slug,
			$login_option,
			array(
				'sanitize_callback' => function ( ?string $value ): string {
					return ( '1' === $value ) ? '1' : '0';
				},
			)
		);

		register_setting(
			$slug,
			$env_indicator_option,
			array(
				'sanitize_callback' => function ( ?string $value ): string {
					return ( '1' === $value ) ? '1' : '0';
				},
			)
		);

		add_settings_section(
			$slug . '_section_env_options',
			esc_html__( 'Environment Options', 'hrswp-theme' ),
			'__return_true',
			$slug
		);

		add_settings_field(
			$login_option,
			esc_html__( 'Frontend access', 'hrswp-theme' ),
			__NAMESPACE__ . '\settings_field_require_login',
			$slug,
			$slug . '_section_env_options'
		);

		add_settings_field(
			$env_indicator_option,
			esc_html__( 'Environment indicator', 'hrswp-theme' ),
			__NAMESPACE__ . '\settings_field_environment_indicator',
			$slug,
			$slug . '_section_env_options'
		);
	}
);

/**
 * Registers the general HRS settings page.
 *
 * @since 3.5.0
 *
 * @see add_options_page
 */
add_action(
	'admin_menu',
	function(): void {
		add_options_page(
			esc_html__( 'HRS Theme and Plugin Settings', 'hrswp-theme' ),
			esc_html__( 'HRS Settings', 'hrswp-theme' ),
			'manage_options',
			'hrswp-theme',
			__NAMESPACE__ . '\settings_page_content'
		);
	}
);
