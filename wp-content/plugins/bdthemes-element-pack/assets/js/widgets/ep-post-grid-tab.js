( function( $, elementor ) {

	'use strict';

	var widgetPostGridTab = function( $scope, $ ) {

		var $postGridTab = $scope.find( '.bdt-post-grid-tab' ),
		gridTab      = $postGridTab.find('> .gridtab');

		if ( ! $postGridTab.length ) {
			return;
		}

		$(gridTab).gridtab($postGridTab.data('settings'));

		// $('.bdt-post-grid-tab-thumbnail').on('click', function(){
		// 	// $(this).offset().top;

		// 	// console.log(this)

		// 	$('html, body').animate({
		// 		easing: 'slow',
		// 		scrollTop: $(this).offset().bottom  - 100 
		// 	}, 500, function() {
  //                       //#code
  //           }).promise().then(function() { 

  //           });

  //       });



	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-post-grid-tab.default', widgetPostGridTab );
	});

}( jQuery, window.elementorFrontend ) );