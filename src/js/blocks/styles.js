const { __ } = wp.i18n;
const { registerBlockStyle, unregisterBlockStyle } = wp.blocks;

const addBlockStyles = () => {
	registerBlockStyle( 'core/button', {
		name: 'text',
		label: __( 'Text' ),
	} );

	registerBlockStyle( 'core/button', {
		name: 'small',
		label: __( 'Small' ),
	} );

	registerBlockStyle( 'core/list', {
		name: 'alpha',
		label: __( 'Alphabetical' ),
	} );
};

const removeBlockStyles = () => {
	wp.domReady( () => {
		unregisterBlockStyle( 'core/button', 'squared' );
	} );
};

const init = () => {
	addBlockStyles();
	removeBlockStyles();
};

export { init };
