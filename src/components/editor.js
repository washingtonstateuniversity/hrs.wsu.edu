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
import * as heading from './heading/editor';
import * as paragraph from './paragraph/editor';

/**
 * Blocks to modify styles for.
 */
const blockStylesList = [ list, heading, paragraph ];

/**
 * Blocks to unregister.
 */
const unregisterList = [
	'core/archives',
	'core/calendar',
	'core/html',
	'core/latest-comments',
	'core/latest-posts',
	'core/loginout',
	'core/more',
	'core/navigation',
	'core/nextpage',
	'core/post-author',
	'core/post-comments',
	'core/post-content',
	'core/post-date',
	'core/post-excerpt',
	'core/post-featured-image',
	'core/post-navigation-link',
	'core/post-terms',
	'core/page-list',
	'core/post-title',
	'core/query',
	'core/site-logo',
	'core/site-tagline',
	'core/site-title',
	'core/term-description',
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
