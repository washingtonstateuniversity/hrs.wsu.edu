/**
 * WordPress dependencies
 */
const {
	registerBlockStyle,
	unregisterBlockStyle,
	unregisterBlockType,
} = wp.blocks;

/**
 * Internal dependencies
 */
import * as list from './list/editor';

/**
 * Blocks to modify styles for.
 */
const blockStylesList = [ list ];

/**
 * Blocks to unregister.
 */
const unregisterList = [
	'core/latest-comments',
	'core/latest-posts',
	'core/more',
	'core/nextpage',
];

/**
 * Adds or removes styles from the given blocks.
 *
 * @return {void}
 */
function modifyBlockStyles() {
	blockStylesList.forEach( ( component ) => {
		if ( ! component ) {
			return;
		}
		const { metadata, settings } = component;
		const { name } = metadata;
		const { registerStyles, unregisterStyles } = settings;

		if ( registerStyles ) {
			registerBlockStyle( name, registerStyles );
		}
		if ( unregisterStyles ) {
			unregisterBlockStyle( name, unregisterStyles );
		}
	} );
}

/**
 * Unregisters the given blocks.
 *
 * @return {void}
 */
function unregisterBlocks() {
	unregisterList.forEach( ( name ) => {
		if ( ! name ) {
			return;
		}
		unregisterBlockType( name );
	} );
}

export { modifyBlockStyles, unregisterBlocks };
