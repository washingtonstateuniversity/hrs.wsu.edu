
/* global Backbone, jQuery, _ */
var wsuNavigation = wsuNavigation || {};

(function (window, Backbone, $, _, wsuNavigation) {
	'use strict';

	wsuNavigation.appView = Backbone.View.extend({
		el: '.wsu-home-navigation',

		// Setup the events used in the overall application view.
		events: {
			'click .close-header-drawer': 'toggleNav',
			'click .search-label': 'toggleSearch',
			'click .close-header-search': 'toggleSearch'
		},

		toggleNav: function(evt){
			evt.preventDefault();
			var $nav_wrapper = $('.header-drawer-wrapper');

			if ( $nav_wrapper.hasClass('header-drawer-wrapper-open') ) {
				 $nav_wrapper.slideUp(400);
				 $nav_wrapper.removeClass('header-drawer-wrapper-open');
			} else {
				 $nav_wrapper.slideDown(400);
				 $nav_wrapper.addClass('header-drawer-wrapper-open');
			}
		},

		toggleSearch: function(evt){
			evt.preventDefault();

			var $search_wrapper = $('.header-search-wrapper');

			if ( $search_wrapper.hasClass('header-search-wrapper-open') ) {
				 $search_wrapper.removeClass('header-search-wrapper-open');
			} else {
				 $search_wrapper.addClass('header-search-wrapper-open');
				 $('.header-search-input').focus();
			}
		}
	});
})(window, Backbone, jQuery, _, wsuNavigation);