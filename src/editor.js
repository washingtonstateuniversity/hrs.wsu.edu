/**
 * WordPress dependencies
 */
import { dispatch } from '@wordpress/data';
import { store as editorStore } from '@wordpress/editor';

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
	const { removeEditorPanel } =
		typeof dispatch( editorStore ).removeEditorPanel !== 'undefined'
			? dispatch( editorStore )
			: dispatch( 'core/edit-post' );

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
