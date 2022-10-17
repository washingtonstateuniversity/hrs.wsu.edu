/**
 * WordPress dependencies
 */
const {
	registerBlockStyle,
	unregisterBlockStyle,
	unregisterBlockType,
	unregisterBlockVariation,
	store: blocksStore,
} = wp.blocks;
const { select } = wp.data;

/**
 * Internal dependencies
 */
import * as list from './list/editor';
import * as heading from './heading/editor';
import * as paragraph from './paragraph/editor';
import {
	unregisterBlocksList,
	unregisterBlockVariationsList,
} from './unregister';

/**
 * Blocks to modify styles for.
 */
const blockStylesList = [ list, heading, paragraph ];

/**
 * Adds or removes styles from the given blocks.
 *
 * @return {void}
 */
function modifyBlockStyles() {
	blockStylesList.forEach( ( component ) => {
		if ( ! component ) {
			return;
		}
		const { metadata, settings } = component;
		const { name } = metadata;
		const { registerStyles, unregisterStyles } = settings;

		if ( registerStyles ) {
			registerBlockStyle( name, registerStyles );
		}
		if ( unregisterStyles ) {
			unregisterBlockStyle( name, unregisterStyles );
		}
	} );
}

/**
 * Unregisters the given blocks.
 *
 * @return {void}
 */
function useUnregisterBlockTypes() {
	const { getBlockTypes } = select( blocksStore );
	const blockTypes = getBlockTypes().map( ( blockType ) => blockType.name );

	unregisterBlocksList.forEach( ( name ) => {
		if ( ! name || false === blockTypes.includes( name ) ) {
			return;
		}

		unregisterBlockType( name );
	} );
}

/**
 * Unregisters given block variations.
 *
 * @return {void}
 */
function useUnregisterBlockVariation() {
	const { getBlockVariations } = select( blocksStore );

	unregisterBlockVariationsList.forEach(
		( { blockName, variationNames } ) => {
			const blockVariations = getBlockVariations( blockName ).map(
				( variationType ) => variationType.name
			);

			variationNames.forEach( ( variation ) => {
				if ( false === blockVariations.includes( variation ) ) {
					return;
				}
				unregisterBlockVariation( blockName, variation );
			} );
		}
	);
}

export {
	modifyBlockStyles,
	useUnregisterBlockTypes,
	useUnregisterBlockVariation,
};
