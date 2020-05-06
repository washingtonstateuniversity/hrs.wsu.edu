/**
 * Site Search Menu
 */
class SearchMenu {
	/**
	 * Instantiates the site search menu.
	 *
	 * @param {Node} siteSearch The site search node.
	 */
	constructor( siteSearch ) {
		this._siteSearch = siteSearch;
		this._searchMenu = this._siteSearch.querySelector( '.search-menu' );
		this._searchHeading = this._siteSearch.querySelector(
			'.search-heading'
		);
		this._searchInput = this._siteSearch.querySelector(
			'input[type="search"]'
		);
		this._searchMenuTargets = this._searchMenu.querySelectorAll(
			'a, input'
		);
		this._trigger = '';

		this.expand = this.expand.bind( this );
		this.collapse = this.collapse.bind( this );
		this.toggle = this.toggle.bind( this );
		this.handleSelectOutside = this.handleSelectOutside.bind( this );

		this._setupHeadingButton();
		this._addEventListeners();

		this.activate();
	}

	expand( trigger, target ) {
		this._setAriaExpanded( trigger, 'true' );
		this._setAriaHidden( target, 'false' );
		this._setTabindex( 0 );
		this._searchInput.focus();
	}

	collapse( trigger, target ) {
		this._setAriaExpanded( trigger, 'false' );
		this._setAriaHidden( target, 'true' );
		this._setTabindex( -1 );
	}

	toggle( e ) {
		const trigger = e.target;
		const target = document.getElementById(
			trigger.getAttribute( 'aria-controls' )
		);

		e.preventDefault();

		if ( this._isExpanded( trigger ) ) {
			this.collapse( trigger, target );
			return;
		}

		this.expand( trigger, target );
	}

	handleSelectOutside( e ) {
		if (
			this._isExpanded( this._trigger ) &&
			! this._siteSearch.contains( e.target )
		) {
			this.collapse( this._trigger, this._searchMenu );
		}
	}

	_setupHeadingButton() {
		const targetId = this._searchHeading.nextElementSibling.id;
		const Button = document.createElement( 'button' );
		const ButtonText = this._searchHeading.textContent;

		this._searchHeading.innerHTML = '';

		Button.setAttribute( 'type', 'button' );
		Button.setAttribute( 'aria-controls', targetId );
		Button.setAttribute( 'id', `${ targetId }-trigger` );
		Button.classList.add( 'search-menu-trigger' );

		this._searchHeading.appendChild( Button );
		Button.appendChild( document.createTextNode( ButtonText ) );
		this._trigger = Button;
	}

	_addEventListeners() {
		this._trigger.addEventListener( 'click', this.toggle );
		document.addEventListener( 'click', this.handleSelectOutside );
		document.addEventListener( 'keyup', ( event ) => {
			if ( this._isExpanded( this._trigger ) ) {
				if ( 'Escape' === event.key || 'Esc' === event.key ) {
					this.collapse( this._trigger, this._searchMenu );
				}
			}
		} );
	}

	activate() {
		this._siteSearch.classList.add( 'active' );
		this._setAriaHidden( this._searchMenu, 'true' );
		this._setTabindex( -1 );
	}

	_isExpanded( trigger ) {
		return 'true' === trigger.getAttribute( 'aria-expanded' );
	}

	_setAriaHidden( element, state ) {
		return element.setAttribute( 'aria-hidden', state );
	}

	_setAriaExpanded( element, state ) {
		return element.setAttribute( 'aria-expanded', state );
	}

	_setTabindex( state ) {
		this._searchMenuTargets.forEach( ( target ) => {
			target.setAttribute( 'tabindex', state );
		} );
	}
}

export const metadata = {
	name: 'search-menu',
	type: 'module',
};

export const settings = {
	init: () => {
		const searchMenu = document.querySelector(
			'.site-header .site-search'
		);
		new SearchMenu( searchMenu );
	},
};
