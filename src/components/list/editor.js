/**
 * WP dependencies
 */
const { __ } = wp.i18n;

export const metadata = {
	name: 'core/list',
};

export const settings = {
	registerStyles: [ { name: 'alpha', label: __( 'Alphabetical' ) } ],
};
