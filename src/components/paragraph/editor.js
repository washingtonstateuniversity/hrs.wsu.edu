/**
 * WP dependencies
 */
const { __ } = wp.i18n;

export const metadata = {
	name: 'core/paragraph',
};

export const settings = {
	registerStyles: [ { name: 'accent', label: __( 'Accent' ) } ],
};
