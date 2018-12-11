const input = /** @type {!Element} */ (
	document.getElementById( 'search_table_input' ) );

const reset = /** @type {!Element} */ (
	document.getElementById( 'js-search-form-reset' ) );

/*
 * Sanitizes a given string as an encoded URI component.
 *
 * @type {!string} str A string to be encoded.
 */
const sanitize = function encodeParamString( str ) {
	return encodeURIComponent( str ).replace( /[!'()*]/g, ( c ) => {
		return '%' + c.charCodeAt( 0 ).toString( 16 );
	} );
};

/*
 * Hides all table elements not matching the search parameter.
 */
const handleInputChange = function updateTableDisplay() {
	let td, i;
	let filter = sanitize( input.value.toUpperCase() );
	let table = document.querySelector( 'table.searchable' );
	let tr = table.getElementsByTagName( 'tr' );
	let searchColumn = ( input.dataset.searchColumn ? input.dataset.searchColumn : 1 );

	// Loop through all table rows and hide those that don't match the search.
	for ( i = 0; i < tr.length; i++ ) {
		td = tr[i].getElementsByTagName( 'td' )[searchColumn - 1];
		if ( td ) {
			if ( -1 < td.innerHTML.toUpperCase().indexOf( filter ) ) {
				tr[i].style.display = '';
			} else {
				tr[i].style.display = 'none';
			}
		}
	}
};

/*
 * Clears the input field and resets the filtered output.
 */
const handleResetSelect = function resetFilter() {
	input.value = '';
	handleInputChange();
};

/*
 * Updates filter results based on a URL parameter.
 */
async function handleURLSearchParams() {
	if ( 'URLSearchParams' in window ) {
		const params = new URLSearchParams( window.location.search );
		const filterValue = params.get( 'filter' );

		if ( null !== filterValue ) {
			input.value = sanitize( filterValue );
			await handleInputChange();
		}
	}
}

/**
 * Adds event handlers and URL parameter check.
 */
export default function initializeFilter() {
	input.addEventListener( 'keyup', handleInputChange );
	reset.addEventListener( 'click', handleResetSelect );
	handleURLSearchParams();
};
