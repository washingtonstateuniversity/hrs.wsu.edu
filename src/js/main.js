/**
 * Internal dependencies
 */
import { initSearchMenu } from './search-menu';
import { initLazyImages } from './lazy-images';

/**
 * Initializes all of the site submodules.
 *
 * This is the main script entry point for the site.
 *
 * @since 1.0.0
 */
const main = () => {
	initSearchMenu();
	initLazyImages();
};

main();
