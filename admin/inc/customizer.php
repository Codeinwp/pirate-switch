<?php
require_once( plugin_dir_path( __FILE__ ) . 'customizer-repeater/inc/customizer.php' );

function pirate_switch_customize_register( $wp_customize ) {

    /* Add Pirate Switch panel */
    $wp_customize->add_panel( 'panel_pirate_switch', array(
        'title'    => esc_html__( 'Pirate Switch', 'pirate-switch' ),
        'priority' => 1
    ) );

    // Dynamically load all the customizer settings files.
    foreach (glob( PIRATE_SWITCH_PATH . 'admin/inc/settings/ps-*.php') as $filename) {
        include_once ( $filename );
    }
}

add_action( 'customize_register', 'pirate_switch_customize_register', 999 );
