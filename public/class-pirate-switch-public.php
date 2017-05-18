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

	/**
	 * Check if Repeater is empty
	 *
	 * @param string $ps_arr Repeater json array.
	 *
	 * @return bool
	 */
	public function pirate_switch_general_repeater_is_empty( $ps_arr ) {
		if ( empty( $ps_arr ) ) {
			return true;
		}
		$ps_arr_decoded = json_decode( $ps_arr, true );
		$not_check_keys = array( 'choice', 'id' );
		foreach ( $ps_arr_decoded as $item ) {
			foreach ( $item as $key => $value ) {
				if ( $key === 'icon_value' && ( ! empty( $value ) && $value !== 'No icon') ) {
					return false;
				}
				if ( ! in_array( $key, $not_check_keys ) ) {
					if ( ! empty( $value ) ) {
						return false;
					}
				}
			}
		}
		return true;
	}
	
	public function pirate_switch_display_block() {
		
		?>


		<div id="pirate-switch-main-box" class="pirate-switch-container">

			<div id="pirate-switch-open-icon" class="pirate-switch-open"></div>
			<div class="pirate-switch-content-wrapper">
				<div id="pirate-switch-content" class="pirate-switch-content">

					<?php
						/* Layouts/Demos */
						$pirate_switch_layouts_demos_title = get_theme_mod( 'pirate_switch_layouts_demos_title' );
						$pirate_switch_layouts_demos_text = get_theme_mod( 'pirate_switch_layouts_demos_text' );
						$pirate_switch_layouts_demos_box = get_theme_mod( 'pirate_switch_layouts_demos_box' );

						if( ! empty( $pirate_switch_layouts_demos_title ) || ! empty( $pirate_switch_layouts_demos_text ) || ! pirate_switch_general_repeater_is_empty( $pirate_switch_layouts_demos_box ) ) {
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
												if( !empty($pirate_switch_layouts_demos_box_item->text) && !empty($pirate_switch_layouts_demos_box_item->link) ) {

														$pirate_switch_new_tab = '_self';

														$pirate_switch_layouts_demos_new_tab = get_theme_mod( 'pirate_switch_layouts_demos_new_tab',1 );

														if( isset($pirate_switch_layouts_demos_new_tab) && $pirate_switch_layouts_demos_new_tab == 1 ) {
															$pirate_switch_new_tab = '_blank';
														}

														echo '<a class="pirate-switch-layout-button" href="'.$pirate_switch_layouts_demos_box_item->link.'" target="'.$pirate_switch_new_tab.'">' . $pirate_switch_layouts_demos_box_item->text . '</a>';
													}
												}
											}
											echo '<div class="pirate-switch-clearfix"></div>';
									}

							echo '</div><!-- END .pirate-switch-layouts-demos -->';
						}

						/* Styles */

						$pirate_switch_styles_title = get_theme_mod( 'pirate_switch_styles_title' );
						$pirate_switch_styles_text = get_theme_mod( 'pirate_switch_styles_text' );
						$pirate_switch_styles_box = get_theme_mod( 'pirate_switch_styles_box' );

						if( ! empty( $pirate_switch_styles_title ) || ! empty( $pirate_switch_styles_text ) || ! pirate_switch_general_repeater_is_empty( $pirate_switch_styles_box ) ) {
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
											foreach( $pirate_switch_styles_box_decoded as $pirate_switch_styles_box_item ) {
												if( !empty($pirate_switch_styles_box_item->text) ) {
													if( !empty($pirate_switch_styles_box_item->link) ) {

														$pirate_switch_new_tab = '_self';

														$pirate_switch_styles_new_tab = get_theme_mod( 'pirate_switch_styles_new_tab',1 );

														if( isset($pirate_switch_styles_new_tab) && $pirate_switch_styles_new_tab == 1 ) {
															$pirate_switch_new_tab = '_blank';
														}

														echo '<a class="pirate-switch-style-button" href="'.$pirate_switch_styles_box_item->link.'" target="'.$pirate_switch_new_tab.'">'.$pirate_switch_styles_box_item->text.'</a>';
													}
													else {
														echo '<a class="pirate-switch-style-button" href="">'.$pirate_switch_styles_box_item->text.'</a>';
													}
												}
											}
											echo '<div class="pirate-switch-clearfix"></div>';
										echo '</ul>';
									}

								}
							echo '</div><!-- END .pirate-switch-styles -->';
						}

						/* Colors */

						$pirate_switch_colors_title = get_theme_mod( 'pirate_switch_colors_title' );
						$pirate_switch_colors_text = get_theme_mod( 'pirate_switch_colors_text' );
						$pirate_switch_colors_box = get_theme_mod( 'pirate_switch_colors_box' );

						if( ! empty( $pirate_switch_colors_title ) || ! empty( $pirate_switch_colors_text ) || ( ! pirate_switch_general_repeater_is_empty( $pirate_switch_colors_box ) ) ) {

							echo '<div class="pirate-switch-large-box pirate-switch-colors">';

								if( !empty($pirate_switch_colors_title) ) {
									echo '<p class="pirate-switch-title">'.$pirate_switch_colors_title.'</p>';
								}

								if( !empty($pirate_switch_colors_text) ) {
									echo '<p class="pirate-switch-text">'.$pirate_switch_colors_text.'</p>';
								}
								if( ! pirate_switch_general_repeater_is_empty( $pirate_switch_colors_box ) ) {

									$pirate_switch_colors_box_decoded = json_decode( $pirate_switch_colors_box );


									echo '<ul class="pirate-switch-color-boxes">';
									foreach( $pirate_switch_colors_box_decoded as $pirate_switch_colors_box_item ) {
										if( !empty($pirate_switch_colors_box_item->color) && ! empty($pirate_switch_colors_box_item->text) ) {
											echo '<li><div class="pirate-switch-color-box" color-attr="'.$pirate_switch_colors_box_item->color.'" style="background-color:'.$pirate_switch_colors_box_item->color.'"></div><input type="hidden" value="' . $pirate_switch_colors_box_item->text .'" class="pirate_switch_css_style"></li>';

										}
									}
									echo '</ul>';
									echo '<div class="pirate-switch-clearfix"></div>';


								}

							echo '</div><!-- END .pirate-switch-colors -->';


						}

					/* Styles */

					$pirate_switch_child_themes_title = get_theme_mod( 'pirate_switch_child_themes_title' );
					$pirate_switch_child_themes_text = get_theme_mod( 'pirate_switch_child_themes_text' );
					$pirate_switch_child_themes_box = get_theme_mod( 'pirate_switch_child_themes_box' );

					if( ! empty( $pirate_switch_child_themes_title ) || ! empty( $pirate_switch_child_themes_text ) || ! pirate_switch_general_repeater_is_empty( $pirate_switch_child_themes_box ) ) {
						echo '<div class="pirate-switch-large-box pirate-switch-child-themes">';
						if( !empty($pirate_switch_child_themes_title) ) {
							echo '<p class="pirate-switch-title">'.$pirate_switch_child_themes_title.'</p>';
						}

						if( !empty($pirate_switch_child_themes_text) ) {
							echo '<p class="pirate-switch-text">'.$pirate_switch_child_themes_text.'</p>';
						}

						if( !empty($pirate_switch_child_themes_box) ) {
							$pirate_switch_child_themes_box_decoded = json_decode($pirate_switch_child_themes_box);
							if( !empty($pirate_switch_child_themes_box_decoded) ) {
								foreach( $pirate_switch_child_themes_box_decoded as $pirate_switch_child_themes_box_item ) {
									if( !empty($pirate_switch_child_themes_box_item->image_url) ) {
										if( !empty($pirate_switch_child_themes_box_item->link) ) {

											$pirate_switch_new_tab = '_self';

											$pirate_switch_child_themes_new_tab = get_theme_mod( 'pirate_switch_child_themes_new_tab',1 );

											if( isset($pirate_switch_child_themes_new_tab) && $pirate_switch_child_themes_new_tab == 1 ) {
												$pirate_switch_new_tab = '_blank';
											}

											echo '<a class="pirate-switch-child-theme-button" href="'.$pirate_switch_child_themes_box_item->link.'" target="'.$pirate_switch_new_tab.'"><div class="pirate-switch-child-themes-overlay"></div><img src=" '.$pirate_switch_child_themes_box_item->image_url.' "/></a>';
										}
									}
								}
								echo '<div class="pirate-switch-clearfix"></div>';
								echo '</ul>';
							}

						}
						echo '</div><!-- END .pirate-switch-styles -->';
					}
				?>
				</div>
			</div>
		</div>

		<?php


		}
	}