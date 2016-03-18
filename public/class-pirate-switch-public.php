<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       -
 * @since      1.0.0
 *
 * @package    pirate-switch
 * @subpackage pirate-switch/public
 */

class Pirate_Switch_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pirate_Switch_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pirate_Switch_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pirate-switch-public.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name . '-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), '4.5.0', 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pirate_Switch_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pirate_Switch_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pirate-switch-public.js', array( 'jquery' ), $this->version, false );


	}
	
	public function pirate_switch_display_block() {
		
		?>

		
		<div id="pirate-switch-main-box" class="pirate-switch-container">

			<div id="pirate-switch-open-icon" class="pirate-switch-open"></div>

			<div id="pirate-switch-content" class="pirate-switch-content">

				<?php
					/* Layouts/Demos */
					$pirate_switch_layouts_demos_title = get_theme_mod( 'pirate_switch_layouts_demos_title' );
					$pirate_switch_layouts_demos_text = get_theme_mod( 'pirate_switch_layouts_demos_text' );
					$pirate_switch_layouts_demos_box = get_theme_mod( 'pirate_switch_layouts_demos_box' );
					
					if( !empty($pirate_switch_layouts_demos_title) || !empty($pirate_switch_layouts_demos_text) || !empty($pirate_switch_layouts_demos_box) ) {
						echo '<div class="pirate-switch-large-box pirate-switch-layouts-demos">';
					
							if( !empty($pirate_switch_layouts_demos_title) ) {
								echo '<p class="pirate-switch-title">'.$pirate_switch_layouts_demos_title.'</p>';
							}
							
							if( !empty($pirate_switch_layouts_demos_text) ) {
								echo '<p class="pirate-switch-text">'.$pirate_switch_layouts_demos_text.'</p>';
							}
							
							if( !empty($pirate_switch_layouts_demos_box) ) {
								$pirate_switch_layouts_demos_box_decoded = json_decode($pirate_switch_layouts_demos_box);
								if( !empty($pirate_switch_layouts_demos_box_decoded) ) {
									
										foreach( $pirate_switch_layouts_demos_box_decoded as $pirate_switch_layouts_demos_box_item ) {
											if( !empty($pirate_switch_layouts_demos_box_item->image_url) ) {
												if( !empty($pirate_switch_layouts_demos_box_item->link) ) {
													
													$pirate_switch_new_tab = '_self';
													
													$pirate_switch_layouts_demos_new_tab = get_theme_mod( 'pirate_switch_layouts_demos_new_tab',1 );
													
													if( isset($pirate_switch_layouts_demos_new_tab) && $pirate_switch_layouts_demos_new_tab == 1 ) {
														$pirate_switch_new_tab = '_blank';
													}
													
													echo '<div class="pirate-switch-layouts-demos-box"><a href="'.$pirate_switch_layouts_demos_box_item->link.'" target="'.$pirate_switch_new_tab.'"><img src="'.$pirate_switch_layouts_demos_box_item->image_url.'" /></a></div>';
												}
												else {
													echo '<div class="pirate-switch-layouts-demos-box"><img src="'.$pirate_switch_layouts_demos_box_item->image_url.'" /></div>';
												}
											}
										}
										echo '<div class="pirate-switch-clearfix"></div>';
								}
								
							}
						
						echo '</div><!-- END .pirate-switch-layouts-demos -->';
					}	

					/* Styles */
					
					$pirate_switch_styles_title = get_theme_mod( 'pirate_switch_styles_title' );
					$pirate_switch_styles_text = get_theme_mod( 'pirate_switch_styles_text' );
					$pirate_switch_styles_box = get_theme_mod( 'pirate_switch_styles_box' );
					
					if( !empty($pirate_switch_styles_title) || !empty($pirate_switch_styles_text) || !empty($pirate_switch_styles_box) ) {
						echo '<div class="pirate-switch-large-box pirate-switch-styles">';
							if( !empty($pirate_switch_styles_title) ) {
								echo '<p class="pirate-switch-title">'.$pirate_switch_styles_title.'</p>';
							}
							
							if( !empty($pirate_switch_styles_text) ) {
								echo '<p class="pirate-switch-text">'.$pirate_switch_styles_text.'</p>';
							}

							if( !empty($pirate_switch_styles_box) ) {
								$pirate_switch_styles_box_decoded = json_decode($pirate_switch_styles_box);
								if( !empty($pirate_switch_styles_box_decoded) ) {
									echo '<ul class="pirate-switch-styles-ul">';
										foreach( $pirate_switch_styles_box_decoded as $pirate_switch_styles_box_item ) {
											if( !empty($pirate_switch_styles_box_item->text) ) {
												if( !empty($pirate_switch_styles_box_item->link) ) {
													
													$pirate_switch_new_tab = '_self';
													
													$pirate_switch_styles_new_tab = get_theme_mod( 'pirate_switch_styles_new_tab',1 );
													
													if( isset($pirate_switch_styles_new_tab) && $pirate_switch_styles_new_tab == 1 ) {
														$pirate_switch_new_tab = '_blank';
													}
													
													echo '<li class=""><a href="'.$pirate_switch_styles_box_item->link.'" target="'.$pirate_switch_new_tab.'">'.$pirate_switch_styles_box_item->text.'</a></li>';
												}
												else {
													echo '<li class="">'.$pirate_switch_styles_box_item->text.'</li>';
												}
											}
										}
										echo '<div class="pirate-switch-clearfix"></div>';
									echo '</ul>';
								}
								
							}
						echo '</div><!-- END .pirate-switch-styles -->';		
					}

					/* Styles */
					
					$pirate_switch_colors_title = get_theme_mod( 'pirate_switch_colors_title' );
					$pirate_switch_colors_text = get_theme_mod( 'pirate_switch_colors_text' );
					$pirate_switch_colors_box = get_theme_mod( 'pirate_switch_colors_box' );
					$pirate_switch_colors_elements_color = get_theme_mod( 'pirate_switch_colors_elements_color' );
					$pirate_switch_colors_elements_background = get_theme_mod( 'pirate_switch_colors_elements_background' );

					if( !empty($pirate_switch_colors_title) || !empty($pirate_switch_colors_text) || ( !empty($pirate_switch_colors_box) && (!empty($pirate_switch_colors_elements_color) || !empty($pirate_switch_colors_elements_background)) ) ) {
						
						echo '<div class="pirate-switch-large-box pirate-switch-colors">';
					
							if( !empty($pirate_switch_colors_title) ) {
								echo '<p class="pirate-switch-title">'.$pirate_switch_colors_title.'</p>';
							}
							
							if( !empty($pirate_switch_colors_text) ) {
								echo '<p class="pirate-switch-text">'.$pirate_switch_colors_text.'</p>';
							}
							if( !empty($pirate_switch_colors_box) && (!empty($pirate_switch_colors_elements_color) || !empty($pirate_switch_colors_elements_background)) ) {
								$pirate_switch_colors_box_decoded = json_decode($pirate_switch_colors_box);
								if( !empty($pirate_switch_colors_box_decoded) ) {
									echo '<input type="hidden" value="'.$pirate_switch_colors_elements_color.'" id="pirate_switch_colors_elements_color_values">';
									echo '<input type="hidden" value="'.$pirate_switch_colors_elements_background.'" id="pirate_switch_colors_elements_background_values">';
									echo '<ul class="pirate-switch-color-boxes">';
									foreach( $pirate_switch_colors_box_decoded as $pirate_switch_colors_box_item ) {
										if( !empty($pirate_switch_colors_box_item->color) ) {
											
											echo '<li><div class="pirate-switch-color-box" color-attr="'.$pirate_switch_colors_box_item->color.'" style="background-color:'.$pirate_switch_colors_box_item->color.'"></div></li>';
											
										}
									}
									echo '</ul>';
									echo '<div class="pirate-switch-clearfix"></div>';
								}
								
							}
						
						echo '</div><!-- END .pirate-switch-colors -->';
							
						
					}		
					
				?>

			</div>

		</div>

		<?php
	}
	
}