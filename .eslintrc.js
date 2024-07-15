module.exports = {
	root: true,
	extends: [ 'plugin:@wordpress/eslint-plugin/recommended' ],
	settings: {
		jsdoc: {
			mode: 'typescript',
		},
	},
	rules: {
		'@wordpress/no-unsafe-wp-apis': 'off',
	},
};
