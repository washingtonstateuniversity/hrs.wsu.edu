const removeBlockStyles = () => {
	wp.domReady( function() {
		wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
	} );
};

const initRegistration = () => {
	removeBlockStyles();
};

export { initRegistration };
