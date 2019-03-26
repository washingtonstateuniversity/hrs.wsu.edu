/**
 * Internal dependencies
 */
import { init as initStyles } from './blocks/styles';

/**
 * Initializes all of the site submodules.
 *
 * This is the main script entry point for the site.
 *
 * @since 1.0.0
 */
const init = () => {
	initStyles();
};

init();
