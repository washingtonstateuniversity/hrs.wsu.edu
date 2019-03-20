const path = require( 'path' );

const camelCaseDash = ( string ) => {
	return string.replace(
		/-([a-z])/g,
		( match, letter ) => letter.toUpperCase()
	);
};

/**
 * Converts @wordpress/* string request into request object.
 *
 * Note this isn't the same as camel case because of the
 * way that numbers don't trigger the capitalized next letter.
 *
 * @example
 * formatRequest( '@wordpress/api-fetch' );
 * // { this: [ 'wp', 'apiFetch' ] }
 * formatRequest( '@wordpress/i18n' );
 * // { this: [ 'wp', 'i18n' ] }
 *
 * @param {string} request Request name from import statement.
 * @return {Object} Request object formatted for further processing.
 */
const formatRequest = ( request ) => {
	// '@wordpress/api-fetch' -> [ '@wordpress', 'api-fetch' ]
	const [ , name ] = request.split( '/' );

	// { this: [ 'wp', 'apiFetch' ] }
	return {
		this: [ 'wp', camelCaseDash( name ) ],
	};
};

const wordpressExternals = ( context, request, callback ) => {
	if ( /^@wordpress\//.test( request ) ) {
		callback( null, formatRequest( request ), 'this' );
	} else {
		callback();
	}
};

const externals = [
	{
		react: 'React',
		'react-dom': 'ReactDOM',
		moment: 'moment',
		jquery: 'jQuery',
		lodash: 'lodash',
		'lodash-es': 'lodash',

		// Distributed NPM packages may depend on Babel's runtime regenerator.
		// In a WordPress context, the regenerator is assigned to the global
		// scope via the `wp-polyfill` script. It is reassigned here as an
		// externals to reduce the size of generated bundles.
		//
		// See: https://github.com/WordPress/gutenberg/issues/13890
		'@babel/runtime/regenerator': 'regeneratorRuntime',
	},
	wordpressExternals,
];

module.exports = (env = {}) => {
	return [{
		name: 'modern',
		mode: env.production ? 'production' : 'development',
		devtool: env.production ? 'source-map' : 'inline-source-map',
		entry: {
			main: './src/js/main.js',
			blocks: './src/js/blocks.js'
		},
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, 'assets/js' ),
			publicPath: '/wp-content/themes/hrs.wsu.edu/assets/js/'
		},
		externals,
		module: {
			rules: [
				{
					enforce: 'pre',
					test: /\.m?js$/,
					exclude: /node_modules/,
					loader: 'eslint-loader',
				},
				{
					test: /\.m?js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader',
						options: {
							presets: [
								['@babel/preset-env', {
									useBuiltIns: 'entry',
									modules: false,
									targets: {
										browsers: [
											'last 2 Chrome versions', 'not Chrome < 60',
											'last 2 Safari versions', 'not Safari < 10.1',
											'last 2 iOS versions', 'not iOS < 10.3',
											'last 2 Firefox versions', 'not Firefox < 54',
											'last 2 Edge versions', 'not Edge < 15',
										]
									}
								}]
							],
							plugins: ['@babel/syntax-dynamic-import']
						}
					}
				}
			]
		}
	}, {
		name: 'legacy',
		mode: env.production ? 'production' : 'development',
		devtool: env.production ? 'source-map' : 'inline-source-map',
		entry: {
			main: './src/js/main-legacy.js'
		},
		output: {
			filename: '[name].es5.js',
			path: path.resolve( __dirname, 'assets/js' ),
			publicPath: '/wp-content/themes/hrs.wsu.edu/assets/js/'
		},
		module: {
			rules: [{
				test: /\.m?js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: [
							['@babel/preset-env', {
								useBuiltIns: 'entry',
								modules: false
							}]

						],
						plugins: ['@babel/syntax-dynamic-import']
					}
				}
			}]
		}
	}];
};
