'use strict';
( function() {
	const input = document.querySelector( 'input#search_table_input' );
	const reset = document.querySelector( '#js-search-form-reset' );

	// If browser supports `URLSearchParams`
	if ( 'URLSearchParams' in window ) {

		// Check the URL for a search parameter.
		const params = new URLSearchParams( window.location.search );
		const filterBy = params.get( 'filter' );

		if ( null !== filterBy ) {
			input.value = sanitize( filterBy );
			filterTable();
		}

	}

	function sanitize( str ) {
		return encodeURIComponent( str ).replace( /[!'()*]/g, function( c ) {
			return '%' + c.charCodeAt( 0 ).toString( 16 );
		} );
	}

	function resetFilter() {
		input.value = '';
		filterTable();
	}

	function filterTable() {
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
	}

	input.addEventListener( 'keyup', filterTable, false );
	reset.addEventListener( 'click', resetFilter, false );
}() );
