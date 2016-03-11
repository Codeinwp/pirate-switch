jQuery( document ).ready(function() {
    jQuery( '#pirate-switch-open-icon' ).on( "click", function() {
		if( jQuery( '#pirate-switch-main-box' ).hasClass('pirate-switch-hide') ) {
			jQuery( '#pirate-switch-main-box' ).removeClass('pirate-switch-hide');
		}
		else {
			jQuery( '#pirate-switch-main-box' ).addClass('pirate-switch-hide');
		}	
	});
});