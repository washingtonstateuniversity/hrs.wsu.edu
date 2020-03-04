/**
 * WordPress dependencies
 */
const { registerBlockStyle, unregisterBlockStyle } = wp.blocks;

/**
 * Internal dependencies
 */
import * as button from './button/editor';
import * as list from './list/editor';

export default function initEditorComponents() {
	[ button, list ].forEach( ( component ) => {
		if ( ! component ) {
			return;
		}
		const { metadata, settings } = component;
		const { name } = metadata;
		const { registerStyles, unregisterStyles } = settings;

		wp.domReady( () => {
			if ( registerStyles ) {
				registerBlockStyle( name, registerStyles );
			}

			if ( unregisterStyles ) {
				unregisterBlockStyle( name, unregisterStyles );
			}
		} );
	} );
}
