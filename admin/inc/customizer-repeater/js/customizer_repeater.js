function media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function() {
        var button_id ='#' + jQuery(this).attr('id');
        var display_field = jQuery(this).parent().children('input:text');
        var _custom_media = true;

        wp.media.editor.send.attachment = function(props, attachment){

            if ( _custom_media  ) {
                if(typeof display_field !== 'undefined'){
                    switch(props.size){
                        case 'full':
                            display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
                            break;
                        case 'medium':
                            display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
                            break;
                        case 'thumbnail':
                            display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
                            break;
                        case 'pirate_switch_layout':
                            display_field.val(attachment.sizes.pirate_switch_layout.url);
                            display_field.trigger('change');
                            break;
                        default:
                            display_field.val(attachment.url);
                            display_field.trigger('change');
                    }
                }
                _custom_media = false;
            } else {
                return wp.media.editor.send.attachment( button_id, [props, attachment] );
            }
        };
        wp.media.editor.open(button_class);
        window.send_to_editor = function(html) {

        };
        return false;
    });
}

function customizer_repeater_item_is_empty( $value ){
    return typeof $value === 'undefined' || $value === '';
}

function customizer_repeater_get_html_val( $input ){
    if ($input.length !== 0) {
        return $input.val();
    }
    return '';
}

function ps_refresh_general_control_values(){
    jQuery(".ps-general-control-repeater").each(function(){
        var values = [];
        var th = jQuery(this);
        th.find(".ps-general-control-repeater-container").each(function(){
            var text = customizer_repeater_get_html_val( jQuery(this).find(".pirate_switch_text_control") );
            var link = customizer_repeater_get_html_val( jQuery(this).find(".pirate_switch_link_control") );
            var image_url = customizer_repeater_get_html_val( jQuery(this).find(".ps-custom-media-url") );
            var color = customizer_repeater_get_html_val( jQuery(this).find(".pirate_switch_color_control") );

            var response = {};
            if( !customizer_repeater_item_is_empty( text ) ){
                response.text = escapeHtml(text);
            }
            if( !customizer_repeater_item_is_empty( link ) ){
                response.link = link;
            }
            if( !customizer_repeater_item_is_empty( image_url ) ){
                response.image_url = image_url;
            }
            if( !customizer_repeater_item_is_empty( color ) ){
                response.color = color;
            }

            if(!jQuery.isEmptyObject(response)){
                values.push(response);
            }

        });

        th.find('.ps-colector').val(JSON.stringify(values));
        th.find('.ps-colector').trigger('change');
    });
}
jQuery(document).ready(function(){
    'use strict';
    var theme_conrols = jQuery('#customize-theme-controls');


    theme_conrols.on('click', '.ps-customize-control-title', function () {
        jQuery(this).next().slideToggle('medium', function () {
            if (jQuery(this).is(':visible')){
                jQuery(this).prev().addClass('repeater-expanded');
                jQuery(this).css('display', 'block');
            } else {
                jQuery(this).prev().removeClass('repeater-expanded');
            }
        });
    });


    media_upload('.ps-custom-media-button');
    jQuery('.ps-custom-media-url').live('change', function () {
        ps_refresh_general_control_values();
        return false;
    });

    var color_options = {
        change: function(event, ui){
            ps_refresh_general_control_values();
        }
    };


    theme_conrols.on("click", ".ps-new-field",function(){
        var th = jQuery(this).parent();
        if(typeof th !== 'undefined') {
            var field = th.find(".ps-general-control-repeater-container:first").clone();
            if(typeof field !== 'undefined'){

                field.find(".ps-general-control-remove-field").show();
                field.find(".pirate_switch_text_control").val('');
                field.find(".pirate_switch_link_control").val('');
                field.find(".ps-custom-media-url").val('');


                field.find('.wp-picker-container').replaceWith('<input type="text" class="pirate_switch_color_control">');
                field.find('.customize-control-notifications-container').remove();
                field.find('.pirate_switch_color_control').wpColorPicker(color_options);

                th.find(".ps-general-control-repeater-container:first").parent().append(field);
                ps_refresh_general_control_values();
            }

        }
        return false;
    });

    theme_conrols.on("click", ".ps-general-control-remove-field",function(){
        if( typeof	jQuery(this).parent() !== 'undefined'){
            jQuery(this).parent().parent().remove();
            ps_refresh_general_control_values();
        }
        return false;
    });

    theme_conrols.on('keyup', '.pirate_switch_text_control',function(){
        ps_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.pirate_switch_link_control',function(){
        ps_refresh_general_control_values();
    });

    jQuery('.pirate_switch_color_control').wpColorPicker(color_options);

    /*Drag and drop to change icons order*/
    jQuery(".ps-general-control-droppable").sortable({
        update: function() {
            ps_refresh_general_control_values();
        }
    });


});

var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
};

function escapeHtml(string) {
    string = String(string).replace(/\\/g,'&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });
}