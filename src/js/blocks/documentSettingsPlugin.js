/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { registerPlugin } = wp.plugins;
const { createElement } = wp.element;
const { PluginDocumentSettingPanel } = wp.editPost;
const { ToggleControl } = wp.components;
// const { compose } = wp.compose;
const { withSelect, withDispatch } = wp.data;

/**
 * Module Constants
 */
const PANEL_NAME = 'display-options';

const DisplayOptionsPanelWrapper = ( select ) => {
	return {
		displayTitle: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ 'hrswp_hide_page_title' ] // eslint-disable-line
	}
};

const mapDispatchToProps = ( dispatch ) => {
	return {
		setMetaFieldValue: ( value ) => {
			dispatch( 'core/editor' ).editPost(
				{ meta: { hrswp_hide_page_title: value } }
			);
		}
	}
};

const DisplayOptionsPanel = ( props ) => {
	return( 
		<PluginDocumentSettingPanel
			name={ PANEL_NAME }
			title={ __( 'Display Options' ) }
			className="display-options"
		>
			<ToggleControl
				label={ __( 'Hide Page Title' ) }
				checked={ !! props.displayTitle }
				onChange={ ( value ) => { props.setMetaFieldValue( value ) } }
				help={
					props.displayTitle
						? __( 'Toggle to show the page title.' )
						: __( 'Toggle to hide the page title.' )
				}
			/>
		</PluginDocumentSettingPanel>
	);
}

const WithData = withSelect( DisplayOptionsPanelWrapper )( DisplayOptionsPanel );
const WithDataAndActions = withDispatch( mapDispatchToProps )( WithData );

export default function registerDisplayOptions() {
	registerPlugin( 'plugin-document-setting-panel-demo', {
		render: () => {
			return createElement( WithDataAndActions )
		},
		icon: 'palmtree',
	});
}
