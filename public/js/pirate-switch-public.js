
jQuery( document ).ready( function($) {

    $( '#pirate-switch-open-icon' ).on( "click", function() {

		var $switchMainBox = $( '#pirate-switch-main-box, #pirate-switch-open-icon' ),
			hideClass = 'pirate-switch-opened';
		$switchMainBox.toggleClass( hideClass );

	});


	setSidebarHeight();


	$( '.pirate-switch-color-box' ).on( "click", function() {
		
		var pirate_switch_colors_elements_color_values = jQuery('#pirate_switch_colors_elements_color_values').val();

		if( ( typeof pirate_switch_colors_elements_color_values != 'undefined' ) && ( pirate_switch_colors_elements_color_values != '' ) ) {
			jQuery(pirate_switch_colors_elements_color_values).not( "#pirate-switch-main-box *" ).css('color',jQuery(this).attr('color-attr'));
		}
		
		var pirate_switch_colors_elements_background_values = jQuery('#pirate_switch_colors_elements_background_values').val();
		
		if( ( typeof pirate_switch_colors_elements_background_values != 'undefined' ) && ( pirate_switch_colors_elements_background_values != '' ) ) {
			jQuery(pirate_switch_colors_elements_background_values).not( "#pirate-switch-main-box *" ).css('background',jQuery(this).attr('color-attr'));
		}	
	});

});

function setSidebarHeight() {
	windowHeight = jQuery(window).innerHeight();
	jQuery('#pirate-switch-content').css('max-height', windowHeight);
}

jQuery( window ).resize(function() {
	setSidebarHeight();
});