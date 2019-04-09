/**
 * WordPress dependencies
 */
const { __, _x } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {	InnerBlocks } = wp.editor;

const name = 'hrs-wsu-edu/sidebar';

const TEMPLATE = [
	[ 'core/column', { placeholder: 'Content' } ],
	[ 'core/column', { placeholder: 'Sidebar.' } ],
];

const ALLOWED_BLOCKS = [ 'core/column' ];

export default function registerSidebarBlock() {
	registerBlockType( name, {
		title: __( 'Sidebar' ),

		description: __( 'Display content in a sidebar-style layout (two-thirds and one-third).' ),

		icon: <svg xmlns="http://www.w3.org/2000/svg" viewBox="468 268 24 24"><path fill="none" d="M468 268h24v24h-24v-24z" /><path d="M472 272h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-16a2 2 0 0 1-2-2v-12c0-1.1.9-2 2-2zm0 2v12h10v-12h-10zm12 0v12h4v-12h-4z" /></svg>,

		category: 'layout',

		keywords: [ __( 'sidebar' ), __( 'columns' ) ],

		supports: {
			align: [ 'wide', 'full' ],
		},

		styles: [
			{ name: 'sidebar-right', label: _x( 'Sidebar on right', 'block style' ), isDefault: true },
			{ name: 'sidebar-left', label: _x( 'Sidebar on left', 'block style' ) },
		],

		edit( props ) {
			const { className } = props;

			return (
				<div className={ `${ className } wp-block-columns` }>
					{ /* Ideally won't need this conditional check in the future, for https://github.com/WordPress/gutenberg/issues/9897 */ }
					{ 'undefined' !== typeof props.insertBlocksAfter &&
						<InnerBlocks
							template={ TEMPLATE }
							templateLock="all"
							templateInsertUpdatesSelection={ false }
							allowedBlocks={ ALLOWED_BLOCKS }
						/>
					}
				</div>
			);
		},

		save() {
			return (
				<div className={ `wp-block-columns` }>
					<InnerBlocks.Content />
				</div>
			);
		},

	} );
}
