const isProduction = process.env.NODE_ENV === 'production';
const plugins = [
	require( 'postcss-import' )( {
		path: 'src/',
	} ),
	require( 'postcss-preset-env' )( {
		stage: 2,
		autoprefixer: {
			grid: true,
		},
		features: {
			'nesting-rules': true,
		},
	} ),
];

module.exports = {
	ident: 'postcss',
	sourceMap: ! isProduction,
	plugins: isProduction
		? [
				...plugins,
				require( 'cssnano' )( {
					preset: [
						'default',
						{
							discardComments: {
								removeAll: true,
							},
						},
					],
				} ),
		  ]
		: plugins,
};
