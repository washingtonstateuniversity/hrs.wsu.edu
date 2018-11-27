import { initSearchMenu } from './search-menu';
import { initLazyImages } from './lazy-images';

async function loadFilterHandler() {
	const input = document.querySelector( 'input#search_table_input' );
	if ( null !== input ) {
		const { default: filterInit } = await import( /* webpackChunkName: "filter" */ './filter' );
		filterInit();
	}
}

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
	loadFilterHandler();
};

main();
