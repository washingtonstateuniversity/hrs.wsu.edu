/**
 * WP dependencies
 */
const { __ } = wp.i18n;

export const metadata = {
	name: 'core/heading',
};

export const settings = {
	registerStyles: [ { name: 'callout', label: __( 'Callout' ) } ],
};
