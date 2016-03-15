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

					<br>Content:
					<br><br><br>

			</div>

		</div>

		<?php
	}
	
}