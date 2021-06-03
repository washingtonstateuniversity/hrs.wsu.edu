/**
 * Internal dependencies
 */
import { modifyBlockStyles, unregisterBlocks } from './components/editor';
import registerDisplayOptions from './lib/block-filters';

/**
 * Initializes all of the site submodules.
 *
 * @since 2.0.0
 */
registerDisplayOptions();
wp.domReady( () => {
	modifyBlockStyles();
	unregisterBlocks();
} );
