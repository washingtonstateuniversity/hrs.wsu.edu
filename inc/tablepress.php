<?php
/**
 * Functions modifying default TablePress plugin
 *
 * @package HrswpTheme
 * @since 2.0.0
 */

namespace HrswpTheme\inc\tablepress;

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Silence is golden.' );
}

/**
 * Adds TablePress attributes filter on tables with header rows.
 *
 * Callback function for the TablePress `tablepress_table_render_data`
 * filter hook, called from the `TablePress_Render->_prepare_render_data()`
 * method after processing the table visibility information and before
 * rendering the table. This function simply checks whether the table has
 * a designated header row and add a `tablepress_cell_tag_attributes` hook
 * if it does. This prevents filtering the table cell attributes on tables
 * without header rows.
 *
 * @since 1.0.0
 *
 * @param array $table          The processed table.
 * @param array $orig_table     The unprocessed table.
 * @param array $render_options The render options for the table.
 * @return array The processed table to be rendered.
 */
function register_tablepress_attributes_filter( $table, $orig_table, $render_options ) {
	if ( true === $render_options['table_head'] ) {
		// Clear any leftover data to fetch the lastest table contents.
		delete_transient( 'hrswp_tablepress_header_columns' );

		// Filter each table cell.
		add_filter( 'tablepress_cell_tag_attributes', __NAMESPACE__ . '\tablepress_attributes_filter', 10, 5 );
	}

	return $table;
}
add_filter( 'tablepress_table_render_data', __NAMESPACE__ . '\register_tablepress_attributes_filter', 10, 3 );

/**
 * Filters the TablePress cells to add `data-column` attributes.
 *
 * Adds a `data-column` attribute to every TablePress table cell with the
 * value of the column header for that cell. This is used along with CSS to
 * create a more responsive table layout. This method fires on every
 * TablePress cell, so we save only the table properties we need (the
 * contents of the header row and the numbers of the last row and column)
 * in a WordPress transient and then delete it after the last cell is built.
 * Called by the `tablepress_cell_tag_attributes` filter hook.
 *
 * @uses TablePress_Table_Model->load() to retrieve the table data.
 *
 * @since 1.0.0
 *
 * @param array  $tag_attributes The attributes for the `td` or `th` tag.
 * @param string $table_id       The current TablePress table ID.
 * @param string $cell_content   The cell content.
 * @param int    $row_idx        The row number of the cell.
 * @param int    $col_idx        The column number of the cell.
 * @return array The table cell attributes in 'title' => 'value' format.
 */
function tablepress_attributes_filter( $tag_attributes, $table_id, $cell_content, $row_idx, $col_idx ) {
	$table_props = get_transient( 'hrswp_tablepress_header_columns' );

	if ( false === $table_props ) {
		$table       = \TablePress::$model_table->load( $table_id );
		$table_props = array(
			'header_row' => $table['data'][0],
		);

		// Save the table properties to a WP transient if they exist.
		if ( $table_props ) {
			set_transient( 'hrswp_tablepress_header_columns', $table_props, 3600 );
		}
	}

	// Get the given cell's column header.
	$label = $table_props['header_row'][ $col_idx - 1 ];

	// Apply a `data-column` attribute to every cell with a column header.
	if ( '' !== $label ) {
		$tag_attributes['data-column'] = esc_attr( $label );
	}

	return $tag_attributes;
}
