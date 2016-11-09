function pirate_switch_uniqid(prefix, more_entropy) {
    'use strict';
    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var php_js;
    var formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10)
            .toString(16); // to hex str
        if (reqWidth < seed.length) { // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) { // so short we pad
            return new Array(1 + (reqWidth - seed.length))
                    .join('0') + seed;
        }
        return seed;
    };

    // BEGIN REDUNDANT
    if (!php_js) {
        php_js = {};
    }
    // END REDUNDANT
    if (!php_js.uniqidSeed) { // init seed with big random int
        php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    php_js.uniqidSeed++;

    retId = prefix; // start with prefix, add current milliseconds hex string
    retId += formatSeed(parseInt(new Date()
            .getTime() / 1000, 10), 8);
    retId += formatSeed(php_js.uniqidSeed, 5); // add seed hex string
    if (more_entropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10)
            .toFixed(8)
            .toString();
    }

    return retId;
}

function media_upload(button_class) {
    'use strict';
    jQuery('body').on('click', button_class, function(e) {
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

function pirate_switch_refresh_general_control_values(){
    jQuery(".pirate_switch_general_control_repeater").each(function(){
        var values = [];
        var th = jQuery(this);
        th.find(".pirate_switch_general_control_repeater_container").each(function(){
            var text = jQuery(this).find(".pirate_switch_text_control").val();
            var link = jQuery(this).find(".pirate_switch_link_control").val();
            var image_url = jQuery(this).find(".custom_media_url").val();
            var id = jQuery(this).find(".pirate_switch_box_id").val();
            if (!id) {
                id = 'pirate_switch_' + pirate_switch_uniqid();
                jQuery(this).find('.pirate_switch_box_id').val(id);
            }
            var color = jQuery(this).find(".pirate_switch_color_control").val();

            if( text !=='' || image_url!=='' || color !=='' || link !=='' ){
                values.push({
                    "text" :  escapeHtml(text),
                    "link" : link,
                    "image_url" : image_url,
                    "color" : escapeHtml(color),
                    "id" : id
                });
            }

        });

        th.find('.pirate_switch_repeater_colector').val(JSON.stringify(values));
        th.find('.pirate_switch_repeater_colector').trigger('change');
    });
}
jQuery(document).ready(function(){
    'use strict';
    var theme_conrols = jQuery('#customize-theme-controls');


    theme_conrols.on('click','.pirate-switch-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible')){
                jQuery(this).css('display','block');
            }
        });
    });


    media_upload('.custom_media_button_pirate_switch');
    jQuery('.custom_media_url').live('change',function(){
        pirate_switch_refresh_general_control_values();
        return false;
    });

    var color_options = {
        change: function(event, ui){
            pirate_switch_refresh_general_control_values();
        }
    };


    theme_conrols.on("click", ".pirate_switch_general_control_new_field",function(){
        var th = jQuery(this).parent();
        var id = 'pirate_switch_' + pirate_switch_uniqid();
        if(typeof th !== 'undefined') {
            var field = th.find(".pirate_switch_general_control_repeater_container:first").clone();
            if(typeof field !== 'undefined'){

                field.find(".pirate_switch_general_control_remove_field").show();
                field.find(".pirate_switch_text_control").val('');
                field.find(".pirate_switch_link_control").val('');
                field.find(".pirate_switch_box_id").val(id);
                field.find(".custom_media_url").val('');
                field.find(".pirate_switch_color_control").val('');

                field.find('.wp-picker-container').replaceWith('<input type="text" class="pirate_switch_color_control ' + id + '">');
                field.find('.customize-control-notifications-container').remove();
                field.find('.pirate_switch_color_control').wpColorPicker(color_options);

                th.find(".pirate_switch_general_control_repeater_container:first").parent().append(field);
                pirate_switch_refresh_general_control_values();
            }

        }
        return false;
    });

    theme_conrols.on("click", ".pirate_switch_general_control_remove_field",function(){
        if( typeof	jQuery(this).parent() !== 'undefined'){
            jQuery(this).parent().parent().remove();
            pirate_switch_refresh_general_control_values();
        }
        return false;
    });

    theme_conrols.on('keyup', '.pirate_switch_text_control',function(){
        pirate_switch_refresh_general_control_values();
    });

    theme_conrols.on('keyup', '.pirate_switch_link_control',function(){
        pirate_switch_refresh_general_control_values();
    });

    jQuery('.pirate_switch_color_control').wpColorPicker(color_options);

    /*Drag and drop to change icons order*/
    jQuery(".pirate_switch_general_control_droppable").sortable({
        update: function( event, ui ) {
            pirate_switch_refresh_general_control_values();
        }
    });


});

var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;',
};

function escapeHtml(string) {
    string = String(string).replace(/\\/g,'&#92;');
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });
}