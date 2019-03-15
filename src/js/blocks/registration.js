const addBlockStyles = () => {
	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'text',
		label: 'Text'
	} );

	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'small',
		label: 'Small'
	} );
};

const removeBlockStyles = () => {
	wp.domReady( () => {
		wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
	} );
};

const initRegistration = () => {
	addBlockStyles();
	removeBlockStyles();
};

export { initRegistration };
