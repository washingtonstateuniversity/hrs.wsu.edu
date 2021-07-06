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
	'core/loginout',
	'core/more',
	'core/nextpage',
	'core/post-content',
	'core/post-date',
	'core/post-excerpt',
	'core/post-featured-image',
	'core/post-title',
	'core/query',
	'core/site-logo',
	'core/site-tagline',
	'core/site-title',
	'core/query-title',
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
