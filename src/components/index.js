/**
 * Internal dependencies
 */
import * as searchMenu from './search-menu';

export default function initComponents() {
	[ searchMenu ].forEach( ( component ) => {
		if ( ! component ) {
			return;
		}

		const { metadata, settings } = component;
		const { type } = metadata;

		if ( 'module' === type ) {
			const { init } = settings;
			init();
		}
	} );
}
