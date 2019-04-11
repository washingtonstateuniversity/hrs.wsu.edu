/**
 * WordPress dependencies
 */
const { __, _x } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {
	Dashicon,
	IconButton,
	PanelBody,
	ToggleControl,
} = wp.components;
const {
	InspectorControls,
	URLInput,
	RichText,
} = wp.editor;
const { Fragment } = wp.element;

const name = 'hrs-wsu-edu/notifications';

const blockAttributes = {
	message: {
		type: 'string',
		source: 'html',
		selector: 'p',
	},
	showActionButton: {
		type: 'boolean',
		default: true,
	},
	actionButtonUrl: {
		type: 'string',
		source: 'attribute',
		selector: 'a',
		attribute: 'href',
	},
	actionButtonTitle: {
		type: 'string',
		source: 'attribute',
		selector: 'a',
		attribute: 'title',
	},
	actionButtonText: {
		type: 'string',
		source: 'html',
		selector: 'a',
	},
};

export default function registerNotificationBlock() {
	registerBlockType( name, {
		title: __( 'Notification' ),

		description: __( 'Show a brief notification message with optional action button.' ),

		icon: 'block-default',

		category: 'layout',

		keywords: [ __( 'callout' ), __( 'message' ), __( 'link' ) ],

		attributes: blockAttributes,

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
			const {
				className,
				attributes,
				setAttributes,
				isSelected,
			} = props;

			const {
				message,
				showActionButton,
				actionButtonUrl,
				actionButtonText,
				actionButtonTitle,
			} = attributes;

			return (
				<Fragment>
					<InspectorControls>
						<PanelBody title={ __( 'Action Button Settings' ) }>
							<ToggleControl
								label={ __( 'Show Action Button' ) }
								checked={ showActionButton }
								onChange={ ( checked ) => setAttributes( { showActionButton: checked } ) }
							/>
						</PanelBody>
					</InspectorControls>
					<div className={ className } title={ actionButtonTitle }>
						<RichText
							placeholder={ __( 'Write message…' ) }
							value={ message }
							onChange={ ( value ) => setAttributes( { message: value } ) }
							formattingControls={ [ 'bold', 'italic' ] }
							className="hrs-wsu-edu-block-notifications__message"
							keepPlaceholderOnFocus
						/>
						{ showActionButton &&
							<RichText
								placeholder={ __( 'Add text… ' ) }
								value={ actionButtonText }
								onChange={ ( value ) => setAttributes( { actionButtonText: value } ) }
								formattingControls={ [] } // disable controls
								className="wp-block-button__link"
								keepPlaceholderOnFocus
							/>
						}
					</div>
					{ isSelected && showActionButton && (
						<form
							className="block-library-button__inline-link"
							onSubmit={ ( event ) => event.preventDefault() }
						>
							<Dashicon icon="admin-links" />
							<URLInput
								value={ actionButtonUrl }
								onChange={ ( value ) => setAttributes( { actionButtonUrl: value } ) }
							/>
							<IconButton icon="editor-break" label={ __( 'Apply' ) } type="submit" />
						</form>
					) }
				</Fragment>
			);
		},

		save( { attributes } ) {
			const {
				message,
				showActionButton,
				actionButtonUrl,
				actionButtonText,
				actionButtonTitle,
			} = attributes;

			return (
				<div>
					<RichText.Content
						tagName="p"
						value={ message }
					/>
					{ showActionButton &&
						<RichText.Content
							tagName="a"
							className="wp-block-button__link"
							href={ actionButtonUrl }
							title={ actionButtonTitle }
							value={ actionButtonText }
						/>
					}
				</div>
			);
		},

	} );
}
