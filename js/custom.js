(function($,window){
	$('.search-label').on('click',function(){
		var $wrapper = $('.header-search-wrapper');
		if ( $wrapper.hasClass('header-search-wrapper-hide') ) {
			$wrapper.removeClass('header-search-wrapper-hide');
		} else {
			$wrapper.addClass('header-search-wrapper-hide');
		}
	});

	$('.close-header-search').on('click',function() {
		var $wrapper = $('.header-search-wrapper');
		if ( ! $wrapper.hasClass('header-search-wrapper-hide' ) ) {
			$wrapper.addClass('header-search-wrapper-hide');
		}
	});

	$('.si-dropdown').on('click',function() {
		var $wrapper = $('.common-searches');
		if ( $wrapper.hasClass('common-searches-hide') ) {
			$wrapper.removeClass('common-searches-hide');
		} else {
			$wrapper.addClass('common-searches-hide');
		}
	});
}(jQuery,window));

jQuery(document).ready(function($){
    $( "#tabs" ).tabs();
  });