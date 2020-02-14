module.exports = {
	plugins: [
		require( 'postcss-import' )( {
			path: 'src/',
		} ),
		require( 'postcss-preset-env' )( {
			stage: 2,
			features: {
				'nesting-rules': true
			}
		} ),
		require( 'cssnano' )( {
			preset: 'default',
		} ),
	],
};
