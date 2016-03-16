function pirate_switch_uniqid(prefix, more_entropy) {

	if (typeof prefix === 'undefined') {
		prefix = '';
	}

	var retId;
	var formatSeed = function(seed, reqWidth) {
		seed = parseInt(seed, 10).toString(16); // to hex str
		if (reqWidth < seed.length) { // so long we split
			return seed.slice(seed.length - reqWidth);
		}
		if (reqWidth > seed.length) { // so short we pad
			return Array(1 + (reqWidth - seed.length)).join('0') + seed;
		}
		return seed;
	};

	if (!this.php_js) {
		this.php_js = {};
	}
  
	if (!this.php_js.uniqidSeed) { // init seed with big random int
		this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
	}
	this.php_js.uniqidSeed++;

	retId = prefix; // start with prefix, add current milliseconds hex string
	retId += formatSeed(parseInt(new Date().getTime() / 1000, 10), 8);
	retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
	if (more_entropy) {
		// for more entropy we add a float lower to 10
		retId += (Math.random() * 10).toFixed(8).toString();
	}

	return retId;
}

function media_upload(button_class) {

	jQuery('body').on('click', button_class, function(e) {
		var button_id ='#'+jQuery(this).attr('id');
		var display_field = jQuery(this).parent().children('input:text');
		var _custom_media = true;

		wp.media.editor.send.attachment = function(props, attachment){

			if ( _custom_media  ) {
				if(typeof display_field != 'undefined'){
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
							console.log('aa');
							display_field.val(attachment.sizes.pirate_switch_layout.url);
                            display_field.trigger('change');	
						default:
							display_field.val(attachment.url);
                            display_field.trigger('change');
					}
				}
				_custom_media = false;
			} else {
				return wp.media.editor.send.attachment( button_id, [props, attachment] );
			}
		}
		wp.media.editor.open(button_class);
		window.send_to_editor = function(html) {

		}
		return false;
	});
}

function pirate_switch_refresh_general_control_values(){
	jQuery(".pirate_switch_general_control_repeater").each(function(){
		var values = [];
		var th = jQuery(this);
		th.find(".pirate_switch_general_control_repeater_container").each(function(){
			var icon_value = jQuery(this).find('.pirate_switch_icon_control').val();
			var text = jQuery(this).find(".pirate_switch_text_control").val();
			var link = jQuery(this).find(".pirate_switch_link_control").val();
			var image_url = jQuery(this).find(".custom_media_url").val();
			var choice = jQuery(this).find(".pirate_switch_image_choice").val();
			var title = jQuery(this).find(".pirate_switch_title_control").val();
			var subtitle = jQuery(this).find(".pirate_switch_subtitle_control").val();
			var id = jQuery(this).find(".pirate_switch_box_id").val();
            var shortcode = jQuery(this).find(".pirate_switch_shortcode_control").val();
            if( text !='' || image_url!='' || title!='' || subtitle!='' ){
                values.push({
                    "icon_value" : (choice === 'pirate_switch_none' ? "" : icon_value) ,
                    "text" :  escapeHtml(text),
                    "link" : link,
                    "image_url" : (choice === 'pirate_switch_none' ? "" : image_url),
                    "choice" : choice,
                    "title" : escapeHtml(title),
                    "subtitle" : escapeHtml(subtitle),
					"id" : id,
                    "shortcode" : escapeHtml(shortcode)
                });
            }

        });
        th.find('.pirate_switch_repeater_colector').val(JSON.stringify(values));
        th.find('.pirate_switch_repeater_colector').trigger('change');
    });
}
jQuery(document).ready(function(){

    jQuery('#customize-theme-controls').on('click','.pirate-switch-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible'))
                jQuery(this).css('display','block');
        });
    });
    
    jQuery('#customize-theme-controls').on('change','.pirate_switch_image_choice',function() {
        if(jQuery(this).val() == 'pirate_switch_image'){
            jQuery(this).parent().parent().find('.pirate_switch_general_control_icon').hide();
            jQuery(this).parent().parent().find('.pirate_switch_image_control').show();
        }
        if(jQuery(this).val() == 'pirate_switch_icon'){
            jQuery(this).parent().parent().find('.pirate_switch_general_control_icon').show();
            jQuery(this).parent().parent().find('.pirate_switch_image_control').hide();
        }
        if(jQuery(this).val() == 'pirate_switch_none'){
            jQuery(this).parent().parent().find('.pirate_switch_general_control_icon').hide();
            jQuery(this).parent().parent().find('.pirate_switch_image_control').hide();
        }
        
        pirate_switch_refresh_general_control_values();
        return false;        
    });
    media_upload('.custom_media_button_pirate_switch');
    jQuery(".custom_media_url").live('change',function(){
        pirate_switch_refresh_general_control_values();
        return false;
    });
    
	jQuery("#customize-theme-controls").on('change', '.pirate_switch_icon_control',function(){
		pirate_switch_refresh_general_control_values();
		return false; 
	});

	jQuery("#customize-theme-controls").on("click", ".pirate_switch_general_control_new_field",function(){

		var th = jQuery(this).parent();
		var id = 'pirate_switch_' + pirate_switch_uniqid();
		if(typeof th != 'undefined') {
			
            var field = th.find(".pirate_switch_general_control_repeater_container:first").clone();
            if(typeof field != 'undefined'){
                field.find(".pirate_switch_image_choice").val('pirate_switch_icon');
                field.find('.pirate_switch_general_control_icon').show();
				if(field.find('.pirate_switch_general_control_icon').length > 0){
                	field.find('.pirate_switch_image_control').hide();
				}
                field.find(".pirate_switch_general_control_remove_field").show();
                field.find(".pirate_switch_icon_control").val('');
                field.find(".pirate_switch_text_control").val('');
                field.find(".pirate_switch_link_control").val('');
				field.find(".pirate_switch_box_id").val(id);
                field.find(".custom_media_url").val('');
                field.find(".pirate_switch_title_control").val('');
                field.find(".pirate_switch_subtitle_control").val('');
                field.find(".pirate_switch_shortcode_control").val('');
                th.find(".pirate_switch_general_control_repeater_container:first").parent().append(field);
                pirate_switch_refresh_general_control_values();
            }
			
		}
		return false;
	});
	
	jQuery("#customize-theme-controls").on("click", ".pirate_switch_general_control_remove_field",function(){
		if( typeof	jQuery(this).parent() != 'undefined'){
			jQuery(this).parent().parent().remove();
			pirate_switch_refresh_general_control_values();
		}
		return false;
	});


	jQuery("#customize-theme-controls").on('keyup', '.pirate_switch_title_control',function(){
		 pirate_switch_refresh_general_control_values();
	});

	jQuery("#customize-theme-controls").on('keyup', '.pirate_switch_subtitle_control',function(){
		 pirate_switch_refresh_general_control_values();
	});
    
    jQuery("#customize-theme-controls").on('keyup', '.pirate_switch_shortcode_control',function(){
		 pirate_switch_refresh_general_control_values();
	});
    
	jQuery("#customize-theme-controls").on('keyup', '.pirate_switch_text_control',function(){
		 pirate_switch_refresh_general_control_values();
	});
	
	jQuery("#customize-theme-controls").on('keyup', '.pirate_switch_link_control',function(){
		pirate_switch_refresh_general_control_values();
	});
	
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