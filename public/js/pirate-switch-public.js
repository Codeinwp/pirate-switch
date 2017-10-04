jQuery( document ).ready( function ( $ ) {

    if( window.location.hash.substr(1) === 'switcher-open' ) {
        toggleSwitcher();
    }
    $( '#ps-open-icon' ).on( "click", function () {
        toggleSwitcher();
    } );

    $( 'head' ).append( '<style class="pirate_switch_css_container"></style>' );

    var cssContainer = $( '.pirate_switch_css_container' );

    $( '.ps-color-box' ).on( "click", function () {
        $(this).addClass('ps-color-effect');
        setTimeout(
            function() {
                $('.ps-color-effect').removeClass('ps-color-effect');
            },
            250);

    $( cssContainer ).empty();

        var cssCode = jQuery( this ).next().val();

        if ( (cssCode != 'undefined') && (cssCode != '') )
            $( cssContainer ).append( cssCode );
    } );

    if( self!==top ) {
        $('.ps-button-cta').remove();
    }
} );

function toggleSwitcher() {
    var $switchMainBox = jQuery( '#ps-main-box, #ps-open-icon' ),
        hideClass = 'ps-opened';
    $switchMainBox.toggleClass( hideClass );
}
