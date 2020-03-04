/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;

export const metadata = { name: 'core/button' };

export const settings = {
	registerStyles: [
		{ name: 'text', label: __( 'Text' ) },
		{ name: 'small', label: __( 'Small' ) },
	],
	unregisterStyles: [ 'squared' ],
};
