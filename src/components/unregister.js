/**
 * @constant unregisterBlocksList Blocks to unregister.
 * @type {string[]}
 */
const unregisterBlocksList = [
	'core/archives',
	'core/avatar',
	'core/calendar',
	'core/comments',
	'core/comments-query-loop',
	'core/details',
	'core/html',
	'core/latest-comments',
	'core/latest-posts',
	'core/loginout',
	'core/more',
	'core/navigation',
	'core/nextpage',
	'core/post-author',
	'core/post-author-biography',
	'core/post-author-name',
	'core/post-comments',
	'core/post-comments-form',
	'core/post-content',
	'core/post-date',
	'core/post-excerpt',
	'core/post-featured-image',
	'core/post-navigation-link',
	'core/post-terms',
	'core/page-list',
	'core/post-title',
	'core/query',
	'core/query-title',
	'core/read-more',
	'core/site-logo',
	'core/site-tagline',
	'core/site-title',
	'core/term-description',
];

/**
 * @constant unregisterBlockVariationsList Block variations to unregister.
 * @type {Object[]}
 */
const unregisterBlockVariationsList = [
	{
		blockName: 'core/embed',
		variationNames: [
			'spotify',
			'flickr',
			'animoto',
			'cloudup',
			'crowdsignal',
			'dailymotion',
			'imgur',
			'issuu',
			'kickstarter',
			'mixcloud',
			'pocketcasts',
			'reddit',
			'reverbnation',
			'screencast',
			'scribd',
			'slideshare',
			'smugmug',
			'speaker-deck',
			'tiktok',
			'ted',
			'tumblr',
			'videopress',
			'wordpress-tv',
			'amazon-kindle',
			'pinterest',
			'wolfram-cloud',
		],
	},
];

export { unregisterBlocksList, unregisterBlockVariationsList };
