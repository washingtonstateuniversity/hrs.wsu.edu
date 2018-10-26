const searchToggle = /** @type {!Element} */ (
	document.querySelector( '.search-toggle' ) );

const searchMenu = /** @type {!Element} */ (
	document.getElementById( 'search-menu' ) );

const searchCloser = /** @type {!Element} */ (
	document.querySelector( '.close-search-menu' ) );

let isOpen = false;

/**
 * Opens a closed search menu.
 */
const open = function openSearchMenu() {
	const searchField = /** @type {!Element} */ (
		document.getElementById( 's' ) );
	isOpen = true;
	searchMenu.classList.add( 'is-visible' );
	searchToggle.setAttribute( 'aria-expanded', true );
	searchField.focus();
};

/**
 * Closes an open search menu.
 */
const close = function hideSearchMenu() {
	isOpen = false;
	searchMenu.classList.remove( 'is-visible' );
	searchToggle.setAttribute( 'aria-expanded', false );
};

/**
 * A callback that handles selection of the search menu button.
 *
 * @param {!Event} event The event associated with the selection.
 */
const toggle = function handleSearchToggleSelect( event ) {
	event.preventDefault();
	isOpen ? close() : open();
};

/**
 * Closes an open menu if the user selected outside the menu.
 *
 * @param {!Event} event The event associated with the selection.
 */
const maybeClose = function handleClickOutsideSearchMenu( event ) {
	const target = /** @type {!Element} */ ( event.target );
	if ( isOpen && ! searchToggle.contains( target ) && ! searchMenu.contains( target ) ) {
		close();
	}
};

/**
 * Adds event handlers for the search menu.
 */
const init = function addSearchMenuEventListeners() {
	searchToggle.addEventListener( 'click', toggle );
	searchToggle.addEventListener( 'touchend', toggle );
	searchCloser.addEventListener( 'click', toggle );
	searchCloser.addEventListener( 'touchend', toggle );

	document.addEventListener( 'click', maybeClose );
	document.addEventListener( 'keyup', ( event ) => {
		if ( isOpen ) {
			if ( 'Escape' === event.key || 'Esc' === event.key ) {
				close();
			}
		}
	} );
};

export { init };
