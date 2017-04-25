jQuery(document).ready(function ($) {

    $('#pirate-switch-open-icon').on("click", function () {

        var $switchMainBox = $('#pirate-switch-main-box, #pirate-switch-open-icon'),
            hideClass = 'pirate-switch-opened';
        $switchMainBox.toggleClass(hideClass);


    });

    $('head').append('<style class="pirate_switch_css_container">test</style>')


    setSidebarHeight();

    var cssContainer = $('.pirate_switch_css_container')

    $('.pirate-switch-color-box').on("click", function () {

        $(cssContainer).empty();

        var cssCode = jQuery(this).next().val();

        if ((cssCode != 'undefined') && (cssCode != ''))
            $(cssContainer).append(cssCode);
    });
});

function setSidebarHeight() {
    windowHeight = jQuery(window).innerHeight();
    jQuery('#pirate-switch-content').css('max-height', windowHeight);
}

jQuery(window).resize(function () {
    setSidebarHeight();
});