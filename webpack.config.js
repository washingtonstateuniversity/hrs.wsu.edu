/**
 * External dependencies
 */
const { BundleAnalyzerPlugin } = require( 'webpack-bundle-analyzer' );
const CopyPlugin = require( 'copy-webpack-plugin' );
const { resolve, basename, dirname } = require( 'path' );

/**
 * WordPress dependencies
 */
const DependencyExtractionWebpackPlugin = require( '@wordpress/dependency-extraction-webpack-plugin' );

const isProduction = process.env.NODE_ENV === 'production';
const mode = isProduction ? 'production' : 'development';

const config = {
	mode,
	entry: {
		index: resolve( process.cwd(), 'src/', 'index.js' ),
		editor: resolve( process.cwd(), 'src/', 'editor.js' ),
	},
	output: {
		filename: '[name].js',
		path: resolve( process.cwd(), 'build' ),
	},
	resolve: {
		alias: {
			'lodash-es': 'lodash',
		},
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [
					require.resolve( 'thread-loader' ),
					{
						loader: require.resolve( 'babel-loader' ),
						options: {
							// Babel uses a directory within local node_modules
							// by default. Use the environment variable option
							// to enable more persistent caching.
							cacheDirectory:
								process.env.BABEL_CACHE_DIRECTORY || true,
							presets: [
								require.resolve(
									'@wordpress/babel-preset-default'
								),
							],
						},
					},
				],
			},
		],
	},
	plugins: [
		// WP_BUNDLE_ANALYZER global variable enables utility that represents
		// bundle content as a convenient interactive zoomable treemap.
		process.env.WP_BUNDLE_ANALYZER && new BundleAnalyzerPlugin(),
		new CopyPlugin( {
			patterns: [
				{
					from: './src/*/**/index.php',
					to( { absoluteFilename } ) {
						const dir = basename( dirname( absoluteFilename ) );
						const parent = basename(
							dirname( dirname( absoluteFilename ) )
						);
						return `${ parent }/${ dir }.[ext]`;
					},
				},
				{
					from: './src/images/**/*',
					to: 'images/[name].[ext]',
				},
			],
		} ),
		new DependencyExtractionWebpackPlugin( { injectPolyfill: true } ),
	].filter( Boolean ),
	stats: {
		children: false,
	},
};

if ( ! isProduction ) {
	// WP_DEVTOOL global variable controls how source maps are generated.
	// See: https://webpack.js.org/configuration/devtool/#devtool.
	config.devtool = process.env.WP_DEVTOOL || 'source-map';
	config.module.rules.unshift( {
		test: /\.js$/,
		use: require.resolve( 'source-map-loader' ),
		enforce: 'pre',
	} );
}

module.exports = config;
