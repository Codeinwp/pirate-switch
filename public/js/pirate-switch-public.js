
jQuery( document ).ready( function($) {

    $( '#pirate-switch-open-icon' ).on( "click", function() {

		var $switchMainBox = $( '#pirate-switch-main-box' ),
			hideClass = 'pirate-switch-opened';
		$switchMainBox.toggleClass( hideClass );

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