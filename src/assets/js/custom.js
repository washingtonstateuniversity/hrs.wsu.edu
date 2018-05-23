'use strict';
( function() {
	const searchToggle = document.querySelector( '.search-toggle' );
	const searchMenu = document.querySelector( '#search-menu' );
	const searchCloser = document.querySelector( '.close-search-menu' );

	function showSearchMenu() {
		searchMenu.classList.add( 'is-visible' );
		searchToggle.setAttribute( 'aria-expanded', true );
		document.querySelector( '#s' ).focus();
	}

	function hideSearchMenu() {
		searchMenu.classList.remove( 'is-visible' );
		searchToggle.setAttribute( 'aria-expanded', false );
	}

	function maybeHideSearchMenu( e ) {
		if ( ! searchToggle.contains( e.target ) && ! searchMenu.contains( e.target ) ) {
			hideSearchMenu();
		}
	}

	function toggleSearchMenu() {
		if ( searchMenu.classList.contains( 'is-visible' ) ) {
			hideSearchMenu();
		} else {
			showSearchMenu();
		}
	}

	searchToggle.addEventListener( 'click', toggleSearchMenu, false );
	searchCloser.addEventListener( 'click', toggleSearchMenu, false );
	searchCloser.addEventListener( 'blur', toggleSearchMenu, false );

	document.addEventListener( 'click', maybeHideSearchMenu, false );

	document.addEventListener( 'keyup', function( e ) {
		if ( 'Escape' === e.key || 'Esc' === e.key ) {
			hideSearchMenu();
		}
	}, false );

}() );
