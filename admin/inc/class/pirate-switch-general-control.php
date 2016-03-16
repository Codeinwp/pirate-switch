<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

class Pirate_Switch_General_Repeater extends WP_Customize_Control {

	private $options = array();

    public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
        $this->options = $args;
	}

    public function render_content() {
		
		$this_default = json_decode($this->setting->default);

        $values = $this->value();
		$json = json_decode($values);
		if(!is_array($json)) $json = array($values);
		$it = 0;
		$it2 = 0;

		$options = $this->options;
		if(!empty($options['pirate_switch_image_control'])){
			$pirate_switch_image_control = $options['pirate_switch_image_control'];
		} else {
			$pirate_switch_image_control = false;
		}
		if(!empty($options['pirate_switch_icon_control'])){
			$pirate_switch_icon_control = $options['pirate_switch_icon_control'];
			$icons_array = array( 'No Icon','fa-envelope','fa-map-marker','fa-500px','fa-amazon','fa-android','fa-behance','fa-behance-square','fa-bitbucket','fa-bitbucket-square','fa-cc-amex','fa-cc-diners-club','fa-cc-discover','fa-cc-jcb','fa-cc-mastercard','fa-paypal','fa-cc-stripe','fa-cc-visa','fa-codepen','fa-css3','fa-delicious','fa-deviantart','fa-digg','fa-dribbble','fa-dropbox','fa-drupal','fa-facebook','fa-facebook-official','fa-facebook-square','fa-flickr','fa-foursquare','fa-git','fa-git-square','fa-github','fa-github-alt','fa-github-square','fa-google','fa-google-plus','fa-google-plus-square','fa-html5','fa-instagram','fa-joomla','fa-jsfiddle','fa-linkedin','fa-linkedin-square','fa-opencart','fa-openid','fa-pinterest','fa-pinterest-p','fa-pinterest-square','fa-rebel','fa-reddit','fa-reddit-square','fa-share-alt','fa-share-alt-square','fa-skype','fa-slack','fa-soundcloud','fa-spotify','fa-stack-overflow','fa-steam','fa-steam-square','fa-tripadvisor','fa-tumblr','fa-tumblr-square','fa-twitch','fa-twitter','fa-twitter-square','fa-vimeo','fa-vimeo-square','fa-vine','fa-whatsapp','fa-wordpress','fa-yahoo','fa-youtube','fa-youtube-play','fa-youtube-square');
		} else {
			 $pirate_switch_icon_control = false;
		}
		if(!empty($options['pirate_switch_title_control'])){
			$pirate_switch_title_control = $options['pirate_switch_title_control'];
		} else {
			$pirate_switch_title_control = false;
		}
		if(!empty($options['pirate_switch_subtitle_control'])){
			$pirate_switch_subtitle_control = $options['pirate_switch_subtitle_control'];
		} else {
			$pirate_switch_subtitle_control = false;
		}                        
		if(!empty($options['pirate_switch_text_control'])){
			$pirate_switch_text_control = $options['pirate_switch_text_control'];
		} else {
			$pirate_switch_text_control = false;
		}
		if(!empty($options['pirate_switch_link_control'])){
			$pirate_switch_link_control = $options['pirate_switch_link_control'];
		} else {
			$pirate_switch_link_control = false;
		}
		if(!empty($options['pirate_switch_shortcode_control'])){
			$pirate_switch_shortcode_control = $options['pirate_switch_shortcode_control'];
		} else {
			$pirate_switch_shortcode_control = false;
		}
		if(!empty($options['pirate_switch_color_control'])){
			$pirate_switch_color_control = $options['pirate_switch_color_control'];
		} else {
			$pirate_switch_color_control = false;
		}
		
 ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="pirate_switch_general_control_repeater pirate_switch_general_control_droppable">
		<?php
			if(empty($json)) {
        ?>
				<div class="pirate_switch_general_control_repeater_container">
					<div class="pirate-switch-customize-control-title"><?php esc_html_e('Pirate Switch','pirate-switch')?></div>
					<div class="pirate-switch-box-content-hidden">
						<?php
							if($pirate_switch_image_control == true && $pirate_switch_icon_control == true){ 
						?>
								<span class="customize-control-title"><?php esc_html_e('Image type','pirate-switch');?></span>
								<select class="pirate_switch_image_choice">
									<option value="pirate_switch_icon" selected><?php esc_html_e('Icon','pirate-switch'); ?></option>
									<option value="pirate_switch_image"><?php esc_html_e('Image','pirate-switch'); ?></option>
									<option value="pirate_switch_none"><?php esc_html_e('None','pirate-switch'); ?></option>
								</select>

								<p class="pirate_switch_image_control" style="display:none">
									<span class="customize-control-title"><?php esc_html_e('Image','pirate-switch')?></span>
									<input type="text" class="widefat custom_media_url">
									<input type="button" class="button button-primary custom_media_button_pirate_switch" value="<?php esc_html_e('Upload Image','pirate-switch'); ?>" />
								</p>

								<div class="pirate_switch_general_control_icon">
									<span class="customize-control-title"><?php esc_html_e('Icon','pirate-switch');?></span>
									<select class="pirate_switch_icon_control">
									<?php
										foreach($icons_array as $contact_icon) {
											echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
										}
									?>
									</select>
								</div>
						<?php
							} else {
								if($pirate_switch_image_control ==true){
						?>
									<span class="customize-control-title"><?php esc_html_e('Image','pirate-switch')?></span>
									<p class="pirate_switch_image_control">
										<input type="text" class="widefat custom_media_url">
										<input type="button" class="button button-primary custom_media_button_pirate_switch" value="<?php esc_html_e('Upload Image','pirate-switch'); ?>" />
									</p>
						<?php
								}

								if($pirate_switch_icon_control ==true){
						?>
									<span class="customize-control-title"><?php esc_html_e('Icon','pirate-switch')?></span>
									<select name="<?php echo esc_attr($this->id); ?>" class="pirate_switch_icon_control">
										<?php
											foreach($icons_array as $contact_icon) {
												echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
											}
										?>
									</select>
						<?php   }
							}
				
							if($pirate_switch_title_control==true){
						?>
								<span class="customize-control-title"><?php esc_html_e('Title','pirate-switch')?></span>
								<input type="text" class="pirate_switch_title_control" placeholder="<?php esc_html_e('Title','pirate-switch'); ?>"/>
						<?php
							}
				
							if($pirate_switch_subtitle_control==true){
						?>
								<span class="customize-control-title"><?php esc_html_e('Subtitle','pirate-switch')?></span>
								<input type="text" class="pirate_switch_subtitle_control" placeholder="<?php esc_html_e('Subtitle','pirate-switch'); ?>"/>
						<?php
							}

							if($pirate_switch_text_control==true){
						?>
								<span class="customize-control-title"><?php esc_html_e('Text','pirate-switch')?></span>
								<textarea class="pirate_switch_text_control" placeholder="<?php esc_html_e('Text','pirate-switch'); ?>"></textarea>
						<?php 
							}

							if($pirate_switch_link_control==true){
						?>
								<span class="customize-control-title"><?php esc_html_e('Link','pirate-switch')?></span>
								<input type="text" class="pirate_switch_link_control" placeholder="<?php esc_html_e('Link','pirate-switch'); ?>"/>
						<?php 
							}
						
							if($pirate_switch_shortcode_control==true){
						?>
								<span class="customize-control-title"><?php esc_html_e('Shortcode','pirate-switch')?></span>
								<input type="text" class="pirate_switch_shortcode_control" placeholder="<?php esc_html_e('Shortcode','pirate-switch'); ?>"/>
						 <?php   
							}
							
							if($pirate_switch_color_control==true){
						?>
								<span class="customize-control-title"><?php esc_html_e('Color','pirate-switch')?></span>
								<input type="text" class="pirate_switch_color_control" placeholder="<?php esc_html_e('Color','pirate-switch'); ?>"/>
						 <?php   
							}
						?>
						<input type="hidden" class="pirate_switch_box_id">
						<button type="button" class="pirate_switch_general_control_remove_field button" style="display:none;"><?php esc_html_e('Delete field','pirate-switch'); ?></button>
					</div>
				</div>
                <?php
                    } else {
                        if ( !empty($this_default) && empty($json)) {
                            foreach($this_default as $icon){
                ?>
                                <div class="pirate_switch_general_control_repeater_container pirate_switch_draggable">
                                    <div class="pirate-switch-customize-control-title"><?php esc_html_e('Pirate Switch','pirate-switch')?></div>
                                    <div class="pirate-switch-box-content-hidden">
                                         <?php
                                            if($pirate_switch_image_control == true && $pirate_switch_icon_control == true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Image type','pirate-switch');?></span>
                                                <select class="pirate_switch_image_choice">
                                                    <option value="pirate_switch_icon" <?php selected($icon->choice,'pirate_switch_icon');?>><?php esc_html_e('Icon','pirate-switch');?></option>
                                                    <option value="pirate_switch_image" <?php selected($icon->choice,'pirate_switch_image');?>><?php esc_html_e('Image','pirate-switch');?></option>
                                                    <option value="pirate_switch_none" <?php selected($icon->choice,'pirate_switch_none');?>><?php esc_html_e('None','pirate-switch');?></option>
                                                </select>

                                                <p class="pirate_switch_image_control"  <?php if(!empty($icon->choice) && $icon->choice!='pirate_switch_image'){ echo 'style="display:none"';}?>>
                                                    <span class="customize-control-title"><?php esc_html_e('Image','pirate-switch');?></span>
                                                    <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                    <input type="button" class="button button-primary custom_media_button_pirate_switch" value="<?php esc_html_e('Upload Image','pirate-switch'); ?>" />
                                                </p>

                                                <div class="pirate_switch_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='pirate_switch_icon'){ echo 'style="display:none"';}?>>
                                                    <span class="customize-control-title"><?php esc_html_e('Icon','pirate-switch');?></span>
                                                    <select name="<?php echo esc_attr($this->id); ?>" class="pirate_switch_icon_control">
                                                        <?php
                                                            foreach($icons_array as $contact_icon) {
                                                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                        <?php
                                            } else {
                                        
												if($pirate_switch_image_control==true){ ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Image','pirate-switch')?></span>
                                                    <p class="pirate_switch_image_control">
                                                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                        <input type="button" class="button button-primary custom_media_button_pirate_switch" value="<?php esc_html_e('Upload Image','pirate-switch'); ?>" />
                                                    </p>
											<?php 
												}
                                                if($pirate_switch_icon_control==true){ 
											?>
                                                    <span class="customize-control-title"><?php esc_html_e('Icon','pirate-switch')?></span>
                                                    <select name="<?php echo esc_attr($this->id); ?>" class="pirate_switch_icon_control">
                                                        <?php
                                                            foreach($icons_array as $contact_icon) {
                                                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                        <?php
                                                }
                                            }
                                                if($pirate_switch_title_control==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Title','pirate-switch')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="pirate_switch_title_control" placeholder="<?php esc_html_e('Title','pirate-switch'); ?>"/>
                                        <?php
                                                }

                                                if($pirate_switch_subtitle_control==true){
                                        ?>
                                                    <span class="customize-control-title"><?php esc_html_e('Subtitle','pirate-switch')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="pirate_switch_subtitle_control" placeholder="<?php esc_html_e('Subtitle','pirate-switch'); ?>"/>
                                        <?php
                                                }
                                                if($pirate_switch_text_control==true){ 
										?>
                                                    <span class="customize-control-title"><?php esc_html_e('Text','pirate-switch')?></span>
                                                    <textarea placeholder="<?php esc_html_e('Text','pirate-switch'); ?>" class="pirate_switch_text_control"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                                        <?php	}
                                                if($pirate_switch_link_control){ 
										?>
                                                    <span class="customize-control-title"><?php esc_html_e('Link','pirate-switch')?></span>
                                                    <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="pirate_switch_link_control" placeholder="<?php esc_html_e('Link','pirate-switch'); ?>"/>
                                        <?php	}
                                                if($pirate_switch_shortcode_control==true){ 
										?>
													<span class="customize-control-title"><?php esc_html_e('Shortcode','pirate-switch')?></span>
													<input type="text" value='<?php if(!empty($icon->shortcode)) echo $icon->shortcode; ?>' class="pirate_switch_shortcode_control" placeholder="<?php esc_html_e('Shortcode','pirate-switch'); ?>"/>
										<?php  }
												if($pirate_switch_color_control==true) {
										?>
													<span class="customize-control-title"><?php esc_html_e('Color','pirate-switch')?></span>
													<input type="text" class="pirate_switch_color_control" placeholder="<?php esc_html_e('Color','pirate-switch'); ?>"/>
										<?php   
												}
                                        ?>
                                        <input type="hidden" class="pirate_switch_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
										<button type="button" class="pirate_switch_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','pirate-switch'); ?></button>
                                    </div>

                                </div>

                <?php
                                $it++;
                            }
                        } else {
                            foreach($json as $icon){
                    ?>
                                <div class="pirate_switch_general_control_repeater_container pirate_switch_draggable">
                                    <div class="pirate-switch-customize-control-title"><?php esc_html_e('Pirate Switch','pirate-switch')?></div>
                                    <div class="pirate-switch-box-content-hidden">
                                    <?php
                                    if($pirate_switch_image_control == true && $pirate_switch_icon_control == true){ ?>
                                        <span class="customize-control-title"><?php esc_html_e('Image type','pirate-switch');?></span>
                                        <select class="pirate_switch_image_choice">
                                            <option value="pirate_switch_icon" <?php selected($icon->choice,'pirate_switch_icon');?>><?php esc_html_e('Icon','pirate-switch');?></option>
                                            <option value="pirate_switch_image" <?php selected($icon->choice,'pirate_switch_image');?>><?php esc_html_e('Image','pirate-switch');?></option>
                                            <option value="pirate_switch_none" <?php selected($icon->choice,'pirate_switch_none');?>><?php esc_html_e('None','pirate-switch');?></option>
                                        </select>


                                        <p class="pirate_switch_image_control" <?php if(!empty($icon->choice) && $icon->choice!='pirate_switch_image'){ echo 'style="display:none"';}?>>
                                            <span class="customize-control-title"><?php esc_html_e('Image','pirate-switch');?></span>
                                            <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                            <input type="button" class="button button-primary custom_media_button_pirate_switch" value="<?php esc_html_e('Upload Image','pirate-switch'); ?>" />
                                        </p>

                                        <div class="pirate_switch_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='pirate_switch_icon'){ echo 'style="display:none"';}?>>
                                            <span class="customize-control-title"><?php esc_html_e('Icon','pirate-switch');?></span>
                                            <select name="<?php echo esc_attr($this->id); ?>" class="pirate_switch_icon_control">
                                            <?php
                                                foreach($icons_array as $contact_icon) {
                                                    echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    <?php

                                    } else {
                                    
                                            if($pirate_switch_image_control == true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Image','pirate-switch')?></span>
                                                <p class="pirate_switch_image_control">
                                                    <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                                                    <input type="button" class="button button-primary custom_media_button_pirate_switch" value="<?php esc_html_e('Upload Image','pirate-switch'); ?>" />
                                                </p>
                                        <?php }

                                            if($pirate_switch_icon_control==true){ ?>
                                                <span class="customize-control-title"><?php esc_html_e('Icon','pirate-switch')?></span>
                                                <select name="<?php echo esc_attr($this->id); ?>" class="pirate_switch_icon_control">
                                                <?php
                                                    foreach($icons_array as $contact_icon) {
                                                        echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                                    }
                                                ?>
                                                </select>
                                        <?php
                                            }
                                        }
                                        if($pirate_switch_title_control==true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Title','pirate-switch')?></span>
                                            <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="pirate_switch_title_control" placeholder="<?php esc_html_e('Title','pirate-switch'); ?>"/>
                                        <?php
                                        }

                                        if($pirate_switch_subtitle_control==true){
                                        ?>
                                            <span class="customize-control-title"><?php esc_html_e('Subtitle','pirate-switch')?></span>
                                            <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="pirate_switch_subtitle_control" placeholder="<?php esc_html_e('Subtitle','pirate-switch'); ?>"/>
                                        <?php
                                        }
                                        if($pirate_switch_text_control==true ){
										?>
                                            <span class="customize-control-title"><?php esc_html_e('Text','pirate-switch')?></span>
                                            <textarea class="pirate_switch_text_control" placeholder="<?php esc_html_e('Text','pirate-switch'); ?>"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                                        <?php 
										}

                                        if($pirate_switch_link_control){ 
										?>
                                            <span class="customize-control-title"><?php esc_html_e('Link','pirate-switch')?></span>
                                            <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="pirate_switch_link_control" placeholder="<?php esc_html_e('Link','pirate-switch'); ?>"/>
                                        <?php 
										}
                                        
                                        if($pirate_switch_shortcode_control==true){ 
										?>
                                            <span class="customize-control-title"><?php esc_html_e('Shortcode','pirate-switch')?></span>
                                            <input type="text" value='<?php if(!empty($icon->shortcode)) echo $icon->shortcode; ?>' class="pirate_switch_shortcode_control" placeholder="<?php esc_html_e('Shortcode','pirate-switch'); ?>"/>
										<?php  
										}
										if($pirate_switch_color_control==true){
										?>
											<span class="customize-control-title"><?php esc_html_e('Color','pirate-switch')?></span>
											<input type="text" class="pirate_switch_color_control" placeholder="<?php esc_html_e('Color','pirate-switch'); ?>"/>
										<?php   
										}
                                        ?>
                                        <input type="hidden" class="pirate_switch_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                                        <button type="button" class="pirate_switch_general_control_remove_field button" <?php
                                            if ($it == 0)
                                            echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','pirate-switch'); ?></button>
                                    </div>

                                </div>
                    <?php
                                $it++;
                                
                            }
                        }
                    }

                if ( !empty($this_default) && empty($json)) {
                     
                ?>
                    <input type="hidden" id="pirate_switch_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="pirate_switch_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
            <?php } else {	?>
                    <input type="hidden" id="pirate_switch_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="pirate_switch_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
            <?php } ?>
            </div>

            <button type="button"   class="button add_field pirate_switch_general_control_new_field"><?php esc_html_e('Add new field','pirate-switch'); ?></button>

            <?php

    }

}