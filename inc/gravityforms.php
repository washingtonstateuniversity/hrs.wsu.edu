<?php
/**
 * Functions modifying default Gravity Forms plugin
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\gravityforms;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Sets up custom Gravity Forms filters and actions.
 *
 * @since 1.1.0
 *
 * @return bool|void False if Gravity Forms is not active.
 */
function gravityforms_setup() {
	/*
	 * Add filters for the Evaluators Selection forms.
	 *
	 * The filter targets list field columns by form, field, column
	 * combinations in format: `FILTER_NAME_FORMID_FIELDID_COLUMN`.
	 *
	 * @uses RGFormsModel()
	 *
	 */
	$form_names = array(
		'360 Evaluators Selection',
		'WSUTC 360 Evaluators Selection',
		'EQ360 Evaluators Selection',
		'Progress Review Evaluators Selection',
	);

	$form_ids = array_map( 'absint', array_map( array( 'RGFormsModel', 'get_form_id' ), $form_names ) );

	foreach ( $form_ids as $form_id ) {
		if ( 0 !== $form_id ) {
			add_filter( 'gform_column_input_content_' . $form_id . '_8_5', 'hrs_filter_evals_reason_column', 10, 6 );
			add_filter( 'gform_column_input_' . $form_id . '_8_6', 'hrs_filter_evals_rel_column', 10, 5 );
		}
	}
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\gravityforms_setup' );

/**
 * Replaces a text field with a textarea field in the target Gravity Forms form.
 *
 * This is a callback for the Gravity Forms filter used to modify the HTML of a
 * targeted List field column input tag.
 *
 * @since 1.1.0
 *
 * @param string $input      The current HTML content of the List field column.
 * @param array  $input_info The input array to be filtered.
 * @param object $field      The current field.
 * @param string $text       The current column name.
 * @param string $value      The currently entered/selected value for the column's input.
 * @return string The HTML content of the List field column.
 */
function hrs_filter_evals_reason_column( $input, $input_info, $field, $text, $value ) {
	$input_field_name = 'input_' . $field->id . '[]';
	$tabindex         = GFCommon::get_tabindex();

	$input = sprintf(
		'<textarea name="%1$s" %2$s class="textarea medium" cols="40" rows="10">%3$s</textarea>',
		$input_field_name,
		$tabindex,
		$value
	);

	return $input;
}

/**
 * Replaces a text field with a select field in the target Gravity Forms form.
 *
 * This is a callback for the Gravity Forms filter used to specify a different
 * input type for a list field column. Currently supported field types are
 * “select” (Drop Down) and “text” (Text Field).
 *
 * @since 1.1.0
 *
 * @param array  $input_info The input info array to be filtered.
 * @param object $field      The current field.
 * @param string $column     The current column name.
 * @param string $value      The currently entered/selected value for the column's input.
 * @param int    $form_id    The ID of the current form.
 * @return array The filtered input info array.
 */
function hrs_filter_evals_rel_column( $input_info, $field, $column, $value, $form_id ) {
	$eq_threesixty_form_id = absint( RGFormsModel::get_form_id( 'EQ360 Evaluators Selection' ) );

	// If this is the 'EQ360 Evaluators Selection' form.
	if ( $eq_threesixty_form_id === $form_id ) {
		$input_info = array(
			'type'    => 'select',
			'choices' => array(
				'',
				'Peers',
				'Manager',
				'Direct Reports',
				'Community Liasons',
				'Others',
			),
		);
	} else {
		// Otherwise it is the standard '360 Evaluators Selection' form.
		$input_info = array(
			'type'    => 'select',
			'choices' => array(
				'',
				'Peer',
				'Direct Report',
				'Student',
				'Faculty',
				'Staff',
				'Regent',
				'Community Liaison',
				'Other',
			),
		);
	}

	return $input_info;
}
