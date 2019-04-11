/**
 * Internal dependencies
 */
import { init as modifyBlockStyles } from './blocks/styles';
import registerNotificationBlock from './blocks/notifications';
import registerCalloutBlock from './blocks/callouts';
import registerSidebarBlock from './blocks/sidebar';

/**
 * Initializes all of the site submodules.
 *
 * This is the main script entry point for the custom blocks.
 *
 * @since 1.3.0
 */
const init = () => {
	modifyBlockStyles();
	registerNotificationBlock();
	registerCalloutBlock();
	registerSidebarBlock();
};

init();
