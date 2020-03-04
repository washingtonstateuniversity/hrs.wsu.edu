<?php
/**
 * WSU Human Resources Services functions and definitions
 *
 * Defines the primary HRS child theme variables and methods, these are all
 * loaded after the main Spine parent theme methods. The bulk of the child theme
 * setup happens in the required 'class-hrs-theme-setup.php' file. This class
 * also includes secondary methods such as shortcode and template tag files.
 *
 * @package WSU_Human_Resources_Services
 * @since 0.1.0
 */

/**
 * Sets up basic theme configuration and WordPress API settings.
 *
 * @since 0.12.0
 */
require_once 'includes/class-hrs-theme-setup.php';

add_action( 'wp_enqueue_scripts', 'hrs_enqueue_styles', 25 );
add_action( 'wp_print_styles', 'hrs_dequeue_styles' );
add_action( 'wp_head', 'hrs_noscript_styles' );
add_action( 'login_enqueue_scripts', 'hrs_login_styles' );
add_filter( 'script_loader_tag', 'hrs_add_attr_to_script_tag', 10, 2 );
add_filter( 'login_headerurl', 'hrs_login_logo_url' );
add_filter( 'login_headertitle', 'hrs_login_logo_url_title' );
add_filter( 'logout_redirect', 'hrs_logout_redirect_home', 10, 2 );
add_filter( 'excerpt_length', 'hrs_excerpt_length' );
add_filter( 'excerpt_more', 'hrs_excerpt_more_link' );

// Plugin adjustments.
add_filter( 'tablepress_table_render_data', 'hrs_add_hrs_filter_tablepress_atts', 10, 3 );
add_action( 'after_setup_theme', 'hrs_gform_setup' );

/**
 * Retrieves the version number from the main stylesheet headers.
 *
 * Gets the headers values from the WP_Theme object {@uses wp_get_theme()}.
 *
 * @since 0.17.3
 *
 * @return string The HRS Child Theme version.
 */
function hrs_get_theme_version() {
	$hrs_version = wp_get_theme()->get( 'Version' );

	return $hrs_version;
}

/**
 * Add HRS Child Theme stylesheets and scripts.
 *
 * @since 0.7.0
 */
function hrs_enqueue_styles() {
	wp_enqueue_style(
		'hrs-child-theme',
		get_stylesheet_directory_uri() . '/build/style.css',
		array(),
		hrs_get_theme_version()
	);

	wp_enqueue_style(
		'source_sans_pro',
		'//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,900,900i',
		array(),
		hrs_get_theme_version()
	);

	wp_enqueue_script(
		'hrs-main',
		get_stylesheet_directory_uri() . '/build/index.js',
		array(),
		hrs_get_theme_version(),
		false
	);
}

/**
 * Adds a noscript element for HRS styles.
 *
 * @since 0.15.2
 */
function hrs_noscript_styles() {
	?>
	<noscript><style>#search-menu { float: right !important; padding-top: 1.5rem !important; position: relative !important; top: 0; transform: none !important; }</style></noscript>
	<?php
}

/**
 * Removes child theme style call from parent theme.
 *
 * @since 0.7.0
 */
function hrs_dequeue_styles() {
	wp_dequeue_style( 'spine-theme-child' );
	wp_dequeue_style( 'spine-theme' );
	wp_dequeue_style( 'open-sans' );
	wp_dequeue_style( 'wp-block-library' );

	if ( is_page_template( 'template-builder.php' ) ) {
		if ( get_post_meta( get_the_ID(), '_has_builder_banner', true ) ) {
			wp_dequeue_style( 'genericons' );
		}
	}
}

/**
 * Adds attributes to selected script tags.
 *
 * @since 1.0.0
 *
 * @param string $tag    The `<script>` tag for the enqueued script to filter.
 * @param string $handle The script's registered handle.
 * @return string The `<script>` tag.
 */
function hrs_add_attr_to_script_tag( $tag, $handle ) {
	// Load main script as module to serve ES6+ version to supporting browsers.
	if ( 'hrs-main' === $handle ) {
		$tag = str_replace( 'text/javascript', 'module', $tag );
	}

	// Module-supporting browsers know not to load `nomodule` scripts.
	if ( 'hrs-legacy' === $handle ) {
		$tag = str_replace( ' src=', ' defer nomodule src=', $tag );
	}

	// Add `async` attribute to the WSU Spine script tag.
	if ( 'wsu-spine' === $handle ) {
		$tag = str_replace( ' src=', ' async src=', $tag );
	}

	return $tag;
}

/**
 * Calls custom CSS on the login page for fancy styling.
 *
 * @since 0.12.0
 */
function hrs_login_styles() {
	wp_enqueue_style(
		'hrs-login-style',
		get_stylesheet_directory_uri() . '/build/login.css',
		false,
		hrs_get_theme_version()
	);
}

/**
 * Sets the default excerpt word count.
 *
 * @since 0.14.0
 *
 * @param int $word_count The maximum number of words. Default 55.
 * @return int The number of words to trim the automatic excerpt to.
 */
function hrs_excerpt_length( $word_count ) {
	$word_count = 20;

	return $word_count;
}

/**
 * Removes the default Read More link from excerpts.
 *
 * @since 0.14.0
 *
 * @param string $more_string The string shown within the more link.
 * @return string The string shown within the more link.
 */
function hrs_excerpt_more_link( $more_string ) {
	$more_string = '<span class="more">&hellip;</span>';

	return $more_string;
}

/**
 * Changes the login logo link from wordpress.org to hrs.wsu.edu.
 *
 * @since 0.12.0
 *
 * @return string
 */
function hrs_login_logo_url() {
	return home_url();
}

/**
 * Changes the login logo text to the site title.
 *
 * @since 0.12.0
 *
 * @return string
 */
function hrs_login_logo_url_title() {
	return get_bloginfo( 'name' );
}

/**
 * Redirects users to the home page on logout.
 *
 * @since 0.3.0
 *
 * @param string $redirect_to           The redirect destination URL.
 * @param string $requested_redirect_to The requested redirect destination URL passed as a parameter.
 * @return string URL of page to redirect users to on logout.
 */
function hrs_logout_redirect_home( $redirect_to, $requested_redirect_to ) {
	// Set requested redirect parameter to the home url.
	$requested_redirect_to = home_url( '/' );

	return $requested_redirect_to;
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
function hrs_add_hrs_filter_tablepress_atts( $table, $orig_table, $render_options ) {
	if ( true === $render_options['table_head'] ) {

		// Clear any leftover data to fetch the lastest table contents.
		delete_transient( 'hrs_tablepress_header_columns' );

		// Filter each table cell.
		add_filter( 'tablepress_cell_tag_attributes', 'hrs_filter_tablepress_atts', 10, 5 );

	}

	return $table;
}

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
function hrs_filter_tablepress_atts( $tag_attributes, $table_id, $cell_content, $row_idx, $col_idx ) {
	$table_props = get_transient( 'hrs_tablepress_header_columns' );

	if ( false === $table_props ) {
		$table       = TablePress::$model_table->load( $table_id );
		$table_props = array(
			'header_row' => $table['data'][0],
		);

		// Save the table properties to a WP transient if they exist.
		if ( $table_props ) {
			set_transient( 'hrs_tablepress_header_columns', $table_props, 3600 );
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

/**
 * Sets up custom Gravity Forms filters and actions.
 *
 * @since 1.1.0
 *
 * @return bool|void False if Gravity Forms is not active.
 */
function hrs_gform_setup() {
	// Check if Gravity Forms exists and is loaded.
	if ( ! class_exists( 'GFForms' ) ) {
		return false;
	}

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
 * @param int    $form_id    The ID of the current form.
 * @return string The HTML content of the List field column.
 */
function hrs_filter_evals_reason_column( $input, $input_info, $field, $text, $value, $form_id ) {
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
