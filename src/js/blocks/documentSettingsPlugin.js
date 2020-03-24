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
	const {
		postType,
		displayTitle,
		displayFeature,
		updateDisplayTitleMeta,
		updateDisplayFeatureMeta,
	} = props;

	return( 
		<PluginDocumentSettingPanel
			name={ PANEL_NAME }
			title={ __( 'Display Options' ) }
			className="display-options"
		>
			<ToggleControl
				label={ __( 'Hide Page Title' ) }
				checked={ !! displayTitle }
				onChange={ ( value ) => { updateDisplayTitleMeta( value ) } }
				help={
					displayTitle
						? __( 'Toggle to show the page title.' )
						: __( 'Toggle to hide the page title.' )
				}
			/>
			{ 'post' === postType &&
				<ToggleControl
					label={ __( 'Hide Feature Image on Page' ) }
					checked={ !! displayFeature }
					onChange={ ( value ) => { updateDisplayFeatureMeta( value ) } }
					help={
						displayFeature
							? __( 'Toggle to show the feature image on the single post page.' )
							: __( 'Toggle to hide the feature image on the post page (images will still show in archive views).' )
					}
				/>
			}
		</PluginDocumentSettingPanel>
	);
}

const DisplayOptionsPanel = compose(
	withDispatch( ( dispatch, props ) => {
		const {
			displayTitleMetaName,
			displayFeatureMetaName,
		} = props;

		return {
			updateDisplayTitleMeta: ( value ) => {
				dispatch( 'core/editor' ).editPost(
					{ meta: { [ displayTitleMetaName ]: value } }
				);
			},
			updateDisplayFeatureMeta: ( value ) => {
				dispatch( 'core/editor' ).editPost(
					{ meta: { [ displayFeatureMetaName ]: value } }
				);
			}
		}
	} ),
	withSelect( ( select, props ) => {
		const {
			displayTitleMetaName,
			displayFeatureMetaName,
		} = props;

		return {
			postType: select( 'core/editor' ).getCurrentPostType(),
			displayTitle: select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ displayTitleMetaName ],
			displayFeature: select( 'core/editor').getEditedPostAttribute( 'meta' )[ displayFeatureMetaName ],
		}
	} )
)( DisplayOptionsPanelContent );

export default function registerDisplayOptions() {
	registerPlugin( 'plugin-document-setting-panel-demo', {
		render: () => {
			return createElement( DisplayOptionsPanel, {
				displayTitleMetaName: 'hrswp_hide_page_title',
				displayFeatureMetaName: 'hrswp_hide_feature_image',
			} )
		},
		icon: '',
	});
}
