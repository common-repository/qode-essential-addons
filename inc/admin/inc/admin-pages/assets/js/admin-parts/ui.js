(function ( $ ) {
	'use strict';
	
	if ( typeof qodefFramework !== 'object' ) {
		window.qodefFramework = {};
	}
	
	qodefFramework.scroll       = 0;
	qodefFramework.windowWidth  = $( window ).width();
	qodefFramework.windowHeight = $( window ).height();
	
	$( window ).scroll(
		function () {
			qodefFramework.scroll = $( window ).scrollTop();
		}
	);
	
})( jQuery );
