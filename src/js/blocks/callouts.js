/**
 * WordPress dependencies
 */
const { __, _x } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {	InnerBlocks } = wp.editor;

const name = 'hrs-wsu-edu/callouts';

const TEMPLATE = [
	[ 'core/heading', { placeholder: 'Callout Heading' } ],
	[ 'core/paragraph', { placeholder: 'Enter the callout message or replace.' } ],
];

export default function registerCalloutBlock() {
	registerBlockType( name, {
		title: __( 'Callout' ),

		description: __( 'Display content in a callout module.' ),

		icon: 'index-card',

		category: 'layout',

		keywords: [ __( 'callout' ), __( 'message' ) ],

		supports: {
			align: true,
		},

		styles: [
			{ name: 'default', label: _x( 'Default', 'block style' ), isDefault: true },
			{ name: 'positive', label: _x( 'Positive', 'block style' ) },
			{ name: 'caution', label: _x( 'Caution', 'block style' ) },
			{ name: 'warning', label: _x( 'Warning', 'block style' ) },
		],

		edit( props ) {
			const { className } = props;

			return (
				<div className={ className }>
					{ /* Ideally won't need this conditional check in the future, for https://github.com/WordPress/gutenberg/issues/9897 */ }
					{ 'undefined' !== typeof props.insertBlocksAfter &&
						<InnerBlocks
							template={ TEMPLATE }
							templateInsertUpdatesSelection={ false }
						/>
					}
				</div>
			);
		},

		save() {
			return (
				<div>
					<InnerBlocks.Content />
				</div>
			);
		},

	} );
}
