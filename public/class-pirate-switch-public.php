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
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pirate-switch-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), '4.5.0', 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pirate-switch-public.js', array( 'jquery' ), $this->version, false );
	}

	public function render() { ?>


        <div id="ps-main-box" class="ps-container">

            <div id="ps-open-icon" class="ps-open"></div>

            <div class="ps-content-wrapper">

                <div id="ps-content" class="ps-content">

					<?php
					// Render the download button at the top.
					$top_button = $this->render_download_button( 'pirate_switch_buy_button_title', 'pirate_switch_buy_button_link', 'pirate_switch_buy_button_new_tab', 'pirate_switch_buy_button_text_ribbon' );
					echo $top_button;

					// Render the layouts section.
					$this->render_buttons_section( 'layouts' );

					// Render the styles section.
					$this->render_buttons_section( 'style' );

					// Render the colors section.
					$this->render_colors_section();

					// Render Child Theme Section.
					$this->render_child_themes_section();

					?>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Render function for the download button.
	 *
	 * @param $button_text
	 * @param $link
	 * @param $target
	 * @param string $ribbon_text
	 */
	protected final function render_download_button( $button_text, $link, $target, $ribbon_text = '', $has_container = true ) {
		$pirate_switch_buy_button_target      = get_theme_mod( $target );
		$pirate_switch_buy_button_text        = get_theme_mod( $button_text );
		$pirate_switch_buy_button_link        = get_theme_mod( $link );
		$pirate_switch_buy_button_text_ribbon = get_theme_mod( $ribbon_text );
		$output                               = '';

		if ( ! empty( $pirate_switch_buy_button_link ) && ! empty( $pirate_switch_buy_button_text ) ) {

			$target = '';

			if ( isset( $pirate_switch_buy_button_target ) && $pirate_switch_buy_button_target == 1 ) {
				$target = 'target="_blank"';
			}

			if ( $has_container === true ) {
				$output .= '<div class="ps-large-box ps-button-cta">';
			} else {
				$output .= '<div class="ps-button-cta">';
			}

			$output .= '<a href="' . esc_url( $pirate_switch_buy_button_link ) . '" class="ps-buy-button"' . $target . '>' . esc_html( $pirate_switch_buy_button_text ) . '</a>';

			if ( ! empty ( $pirate_switch_buy_button_text_ribbon ) ) {
				$output .= '<div class="ps-ribbon">';

				$output .= wp_kses_post( $pirate_switch_buy_button_text_ribbon );

				$output .= '</div>';
			}
			$output .= '</div><!-- /.ps-button-cta -->';
		}
		return $output;
	}

/**
 * Renders buttons sections.
 *
 * @param $section_type layouts or style
 *
 * @return bool
 */
private final function render_buttons_section( $section_type ) {

	if ( empty ( $section_type ) ) {
		return false;
	}

	if ( $section_type == 'layouts' ) {
		$mod          = 'pirate_switch_layouts_demos_box';
		$box_class    = 'ps-layouts-demos';
		$btn_class    = 'ps-layout-button';
		$title_mod    = 'pirate_switch_layouts_demos_title';
		$subtitle_mod = 'pirate_switch_layouts_demos_text';
		$target_mod   = 'pirate_switch_layouts_demos_new_tab';
	} elseif ( $section_type == 'style' ) {
		$mod          = 'pirate_switch_styles_box';
		$box_class    = 'ps-styles';
		$btn_class    = 'ps-style-button';
		$title_mod    = 'pirate_switch_styles_title';
		$subtitle_mod = 'pirate_switch_styles_text';
		$target_mod   = 'pirate_switch_styles_new_tab';
	}


	$items = get_theme_mod( $mod );

	$output = '';

	if ( ! $this->check_repeater( $items ) ) {
		$output .= '<div class="ps-large-box ' . $box_class . '">';

		$section_header = $this->render_section_title( $title_mod, $subtitle_mod );

		if ( ! empty( $section_header ) ) {
			$output .= $section_header;
		}

		if ( ! empty( $items ) ) {
			$items_decoded = json_decode( $items );
			if ( ! empty( $items_decoded ) ) {
				foreach ( $items_decoded as $item ) {
					if ( ! empty( $item->text ) && ! empty( $item->link ) ) {

						$pirate_switch_new_tab = $this->check_target( $target_mod, 1 );

						$output .= '<a class="' . $btn_class . '" href="' . $item->link . '#switcher-open" target="' . $pirate_switch_new_tab . '">' . $item->text . '</a>';

					}
				}
			}
			$output .= '<div class="ps-clearfix"></div>';
		}

		$output .= '</div><!-- END .ps-layouts-demos -->';
	}
	echo wp_kses_post( $output );
}

	/**
	 * Check if Repeater is empty
	 *
	 * @param string $repeater Repeater json array.
	 *
	 * @return bool
	 */
	public function check_repeater( $repeater ) {
	if ( empty( $repeater ) ) {
		return true;
	}

	$repeater_decoded = json_decode( $repeater, true );
	$not_check_keys   = array( 'choice', 'id' );

	foreach ( $repeater_decoded as $item ) {
		foreach ( $item as $key => $value ) {
			if ( $key === 'icon_value' && ( ! empty( $value ) && $value !== 'No icon' ) ) {
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

	/**
	 * Utility to render the section title and subtitle.
	 *
	 * @param $title_theme_mod
	 * @param $subtitle_theme_mod
	 *
	 * @return string
	 */
	protected final function render_section_title( $title_theme_mod, $subtitle_theme_mod ) {
	$title    = get_theme_mod( $title_theme_mod );
	$subtitle = get_theme_mod( $subtitle_theme_mod );
	$output   = '';

	if( ! empty( $title ) || ! empty( $subtitle ) ) {
		$output .= '<div class="ps-ribbon ps-no-background">';
		if ( ! empty( $title ) ) {
			$output .= '<p class="ps-title">' . $title . '</p>';
		}

		if ( ! empty( $subtitle ) ) {
			$output .= '<h5 class="ps-text">' . $subtitle . '</h5>';
		}
		$output .= '</div>';
	}
	return $output;
}

	/**
	 * Checks a given theme mod for a link target.
	 *
	 * @param $new_tab_theme_mod
	 * @param $default
	 *
	 * @return string _blank or _self
	 */
	protected final function check_target( $new_tab_theme_mod, $default ) {

	$new_tab_value   = '_self';
	$new_tab_setting = get_theme_mod( $new_tab_theme_mod, $default );

	if ( isset( $new_tab_setting ) && $new_tab_setting == 1 ) {
		$new_tab_value = '_blank';
	}

	return $new_tab_value;
}

	private final function render_colors_section() {

	$items = get_theme_mod( 'pirate_switch_colors_box' );

	$output = '';

	if ( ! $this->check_repeater( $items ) ) {

		$output .= '<div class="ps-large-box ps-colors">';

		$output .= $this->render_section_title( 'pirate_switch_colors_title', 'pirate_switch_colors_text' );

		if ( ! $this->check_repeater( $items ) ) {

			$items_decoded = json_decode( $items );


			$output .= '<ul class="ps-color-boxes">';

			foreach ( $items_decoded as $item ) {
				if ( ! empty( $item->color ) && ! empty( $item->text ) ) {
					$output .= '<li><div class="ps-color-box" color-attr="' . $item->color . '" style="background-color:' . $item->color . '"></div><input type="hidden" value="' . $item->text . '" class="pirate_switch_css_style"></li>';

				}
			}

			$output .= '</ul><div class="ps-clearfix"></div>';
		}

		$output .= '</div><!-- END .ps-colors -->';
	}
	echo wp_kses_post( $output );
}

	private final function render_child_themes_section() {
	$items = get_theme_mod( 'pirate_switch_child_themes_box' );
	//TODO: ADD THEME MODS FOR BOTTOM BUTTONS. SUGGEST MOVING TO RIGHT SIDE.
	$bottom_button = $this->render_download_button( 'pirate_switch_bottom_button_title', 'pirate_switch_bottom_button_link', 'pirate_switch_bottom_button_new_tab', 'pirate_switch_bottom_button_text_ribbon', false );

	$output = '';

	if ( ! $this->check_repeater( $items ) ) {
		$output .= '<div class="ps-large-box ps-child-themes">';

		$output .= $this->render_section_title( 'pirate_switch_child_themes_title', 'pirate_switch_child_themes_text' );

		if ( ! empty( $items ) ) {
			$items_decoded = json_decode( $items );
			if ( ! empty( $items_decoded ) ) {
				foreach ( $items_decoded as $item ) {
					if ( ! empty( $item->image_url ) && ! empty( $item->link ) ) {

						$pirate_switch_new_tab = '_self';

						$pirate_switch_child_themes_new_tab = get_theme_mod( 'pirate_switch_child_themes_new_tab', 1 );

						if ( isset( $pirate_switch_child_themes_new_tab ) && $pirate_switch_child_themes_new_tab == 1 ) {
							$pirate_switch_new_tab = '_blank';
						}

						$output .= '<a class="ps-child-theme-button" href="' . $item->link . '" target="' . $pirate_switch_new_tab . '"><div class="ps-child-themes-overlay"></div><img src=" ' . $item->image_url . ' "/></a>';
					}
				}
				$output .= $bottom_button;
				$output .= '<div class="ps-clearfix"></div>';
			}
		}
		$output .= '</div><!-- END .ps-child-themes -->';
	}
	echo $output ;
}
}