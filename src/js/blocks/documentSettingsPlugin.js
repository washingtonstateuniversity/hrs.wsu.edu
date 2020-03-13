/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { registerPlugin } = wp.plugins;
const { PluginDocumentSettingPanel } = wp.editPost;
const { PanelBody, ToggleControl } = wp.components;
const { compose } = wp.compose;
const { withSelect, withDispatch } = wp.data;

/**
 * Module Constants
 */
const PANEL_NAME = 'display-options';

function DisplayOptionsPanel( displayTitle = true, ...props ) {
	const onToggleTitleDisplay = () =>
		props.editPost( {
			hrswp_display_page_title: displayTitle === true ? true : false,
		} );
	
	return( 
		<PluginDocumentSettingPanel
			name={ PANEL_NAME }
			title={ __( 'Display Options' ) }
			className="display-options"
		>
			<PanelBody title={ __( 'Page Display Options' ) }>
				<ToggleControl
					label={ __( 'Page Title Visibility' ) }
					checked={ !! displayTitle }
					onChange={ onToggleTitleDisplay }
					help={
						displayTitle
							? __( 'Toggle to hide the page title.' )
							: __( 'Toggle to show the page title.' )
					}
				/>
			</PanelBody>
		</PluginDocumentSettingPanel>
	);
}

const renderDisplaySettings = compose( [
	withSelect( ( select ) => {
		return {
			displayTitle: select( 'core/editor').getEditedPostAttribute(
				'hrswp_display_page_title'
			),
		};
	} ),
	withDispatch( ( dispatch ) => ( {
		editPost: dispatch( 'core/editor' ).editPost,
	} ) ),
] )( DisplayOptionsPanel );

export default function registerDisplayOptions() {
	registerPlugin( 'plugin-document-setting-panel-demo', {
		render: ,
		icon: 'palmtree',
	});
}
