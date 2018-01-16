/* global jQuery, self */
jQuery( document ).ready( function ( $ ) {
    "use strict";
    $( 'head' ).append( '<style class="pirate_switch_css_container"></style>' );

    if ( $( window ).innerWidth() > '1024' && getCookie( 'tiSwitcherState' ) === 'open' ) {
        toggleSwitcher();
    }

    if ( window.location.hash.substr( 1 ) === 'switcher-open' && getCookie( 'tiSwitcherState' ) === 'open' ) {
        toggleSwitcher();
    }
    $( '#ps-open-icon' ).on( "click", function () {
        toggleSwitcher();
        if ( $( '#ps-main-box' ).hasClass( 'ps-opened' ) ) {
            setCookie( 'tiSwitcherState', 'open', '10' );
        } else {
            setCookie( 'tiSwitcherState', 'closed', '10' );
        }
    } );

    var cssContainer = $( '.pirate_switch_css_container' );

    $( '.ps-color-box' ).on( "click", function () {
        $( this ).addClass( 'ps-color-effect' );
        setTimeout(
            function () {
                $( '.ps-color-effect' ).removeClass( 'ps-color-effect' );
            },
            250 );

        $( cssContainer ).empty();

        var cssCode = jQuery( this ).next().val();

        if ( (cssCode != 'undefined') && (cssCode != '') )
            $( cssContainer ).append( cssCode );
    } );

    if ( self !== top ) {
        $( '.ps-button-cta' ).remove();
    }
} );

function toggleSwitcher() {
    "use strict";
    var switchMainBox = jQuery( '#ps-main-box, #ps-open-icon' ),
        hideClass = 'ps-opened';
    switchMainBox.toggleClass( hideClass );
}

function setCookie( cname, cvalue, exdays ) {
    "use strict";
    var d = new Date();
    d.setTime( d.getTime() + (exdays * 24 * 60 * 60 * 1000) );
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie( cname ) {
    "use strict";
    var name = cname + "=";
    var decodedCookie = decodeURIComponent( document.cookie );
    var ca = decodedCookie.split( ';' );
    for ( var i = 0; i < ca.length; i++ ) {
        var c = ca[ i ];
        while ( c.charAt( 0 ) == ' ' ) {
            c = c.substring( 1 );
        }
        if ( c.indexOf( name ) == 0 ) {
            return c.substring( name.length, c.length );
        }
    }
    return "";
}