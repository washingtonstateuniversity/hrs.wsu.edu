/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { registerPlugin } = wp.plugins;
const { createElement } = wp.element;
const { PluginDocumentSettingPanel } = wp.editPost;
const { ToggleControl } = wp.components;
const { compose } = wp.compose;
const { withSelect, withDispatch } = wp.data;

/**
 * Module Constants
 */
const PANEL_NAME = 'display-options';

const DisplayOptionsPanelContent = ( props ) => {
	const { displayTitle, updateMetaFieldValue } = props;

	return( 
		<PluginDocumentSettingPanel
			name={ PANEL_NAME }
			title={ __( 'Display Options' ) }
			className="display-options"
		>
			<ToggleControl
				label={ __( 'Hide Page Title' ) }
				checked={ !! displayTitle }
				onChange={ ( value ) => { updateMetaFieldValue( value ) } }
				help={
					displayTitle
						? __( 'Toggle to show the page title.' )
						: __( 'Toggle to hide the page title.' )
				}
			/>
		</PluginDocumentSettingPanel>
	);
}

const DisplayOptionsPanel = compose(
	withDispatch( ( dispatch, props ) => {
		const { metaFieldName } = props;

		return {
			updateMetaFieldValue: ( value ) => {
				dispatch( 'core/editor' ).editPost(
					{ meta: { [ metaFieldName ]: value } }
				);
			}
		}
	} ),
	withSelect( ( select, props ) => {
		const { metaFieldName } = props;

		return {
			displayTitle: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ metaFieldName ]
		}
	} )
)( DisplayOptionsPanelContent );

export default function registerDisplayOptions() {
	registerPlugin( 'plugin-document-setting-panel-demo', {
		render: () => {
			return createElement( DisplayOptionsPanel, { metaFieldName: 'hrswp_hide_page_title' } )
		},
		icon: '',
	});
}
