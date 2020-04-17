/**
 * Internal dependencies
 */
import initEditorComponents from './components/editor';
import registerDisplayOptions from './lib/block-filters';


/**
 * Initializes all of the site submodules.
 *
 * @since 2.0.0
 */
function editor() {
	initEditorComponents();
	registerDisplayOptions();
}

editor();
