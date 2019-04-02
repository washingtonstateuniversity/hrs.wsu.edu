/**
 * Internal dependencies
 */
import { init as modifyBlockStyles } from './blocks/styles';
import registerNotificationBlock from './blocks/notifications';

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
};

init();
