/**
 * Internal dependencies
 */
import initComponents from './components';
import initLazyLoading from './lib/lazy-loading';

/**
 * Initializes all of the site submodules.
 *
 * This is the main script entry point for the site.
 *
 * @since 1.0.0
 */
function main() {
	initComponents();
	initLazyLoading();
}

main();
