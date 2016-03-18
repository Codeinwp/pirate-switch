
jQuery( document ).ready( function($) {

    $( '#pirate-switch-open-icon' ).on( "click", function() {

		var $switchMainBox = $( '#pirate-switch-main-box' ),
			hideClass = 'pirate-switch-opened';
		$switchMainBox.toggleClass( hideClass );

	});

	$( '.pirate-switch-color-box' ).on( "click", function() {
		
		var pirate_switch_colors_elements_color_values = jQuery('#pirate_switch_colors_elements_color_values').val();
		
		if( ( typeof pirate_switch_colors_elements_color_values != 'undefined' ) && ( pirate_switch_colors_elements_color_values != '' ) ) {
			jQuery(pirate_switch_colors_elements_color_values).css('color',jQuery(this).attr('color-attr'));
		}
		
		var pirate_switch_colors_elements_background_values = jQuery('#pirate_switch_colors_elements_background_values').val();
		
		if( ( typeof pirate_switch_colors_elements_background_values != 'undefined' ) && ( pirate_switch_colors_elements_background_values != '' ) ) {
			jQuery(pirate_switch_colors_elements_background_values).css('background',jQuery(this).attr('color-attr'));
		}	
	});

});