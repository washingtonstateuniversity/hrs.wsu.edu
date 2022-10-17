/**
 * WordPress dependencies
 */
const { dispatch } = wp.data;

/**
 * Internal dependencies
 */
import {
	modifyBlockStyles,
	useUnregisterBlockTypes,
	useUnregisterBlockVariation,
} from './components/editor';
import registerDisplayOptions from './lib/block-filters';

function removeEditorPanels() {
	const { removeEditorPanel } = dispatch( 'core/edit-post' );

	removeEditorPanel( 'discussion-panel' );
	removeEditorPanel( 'template' );
}

/**
 * Initializes all of the site submodules.
 *
 * @since 2.0.0
 */
registerDisplayOptions();
removeEditorPanels();
wp.domReady( () => {
	modifyBlockStyles();
	useUnregisterBlockTypes();
	useUnregisterBlockVariation();
} );
