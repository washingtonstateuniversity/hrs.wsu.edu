const path = require( 'path' );

module.exports = (env = {}) => {
	return [{
		name: 'modern',
		mode: env.production ? 'production' : 'development',
		devtool: env.production ? 'source-map' : 'inline-source-map',
		entry: {
			main: './src/assets/js/main.js'
		},
		output: {
			filename: '[name].js',
			path: path.resolve( __dirname, 'assets/js' ),
			publicPath: '/wp-content/themes/hrs.wsu.edu/assets/js/'
		},
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
			main: './src/assets/js/main-legacy.js'
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
