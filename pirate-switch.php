<?php
/**
 * @link              - 
 * @since             1.0.0
 * @package           pirate-switch
 *
 * @wordpress-plugin
 * Plugin Name:       Pirate Switch
 * Plugin URI:        -
 * Description:       A simple, intuitive, and powerful plugin that allows you to add a style switcher on your site.
 * Version:           1.0.7
 * Author:            Themeisle
 * Author URI:        themeisle.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pirate-switch
 * Domain Path:       /languages
 */

/* If this file is called directly, abort. */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/* Path */
if ( ! defined( 'PIRATE_SWITCH_PATH' ) ) {
	define("PIRATE_SWITCH_PATH",plugin_dir_path( __FILE__ ));
}

/* Version */
if ( ! defined( 'PIRATE_SWITCH_VERSION' ) ) {
define("PIRATE_SWITCH_VERSION","1.0.8");
}

/* URL */
if ( ! defined( 'PIRATE_SWITCH_URL' ) ) {
define("PIRATE_SWITCH_URL",plugin_dir_url( __FILE__ ));
}

/**
 * The code that runs during plugin activation.
 */
function pirate_switch_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/pirate-switch-activator.php';
	Pirate_Switch_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function pirate_switch_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/pirate-switch-deactivator.php';
	Pirate_Switch_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'pirate_switch_activate' );
register_deactivation_hook( __FILE__, 'pirate_switch_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'inc/class-pirate-switch.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function pirate_switch_run() {

	$plugin = new Pirate_Switch();
	$plugin->run();

}
pirate_switch_run();
