
jQuery( document ).ready( function($) {

    $( '#pirate-switch-open-icon' ).on( "click", function() {

		var $switchMainBox 	= $( '#pirate-switch-main-box' ),
			openClass 		= 'pirate-switch-opened',
			$switchOpen 	= $( 'pirate-switch-open' );
		

		setTimeout( function(){ 
			$switchOpen.toggleClass( 'pirate-switch-processing' );
			$switchMainBox.toggleClass( openClass );
		}, 300, function() {
			$switchOpen.toggleClass( 'pirate-switch-processing' );
		} );

	});



/*
    $( '#pirate-switch-open-icon' ).on( "click", function() {

		var $switchMainBox = $( '#pirate-switch-main-box' ),
			hideClass = 'pirate-switch-hide';

		if( $switchMainBox.hasClass( hideClass ) ) {
			$switchMainBox.removeClass( hideClass );
		}
		else {
			$switchMainBox.addClass( hideClass );
		}	
	});*/

});