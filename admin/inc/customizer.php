<?php

function pirate_switch_customize_register( $wp_customize ) {
	
	$wp_customize->add_panel( 'panel_pirate_switch', array(
		'priority' => 1,
		'title' => esc_html__( 'Pirate Switch', 'pirate-switch' )
	) );
	
	$wp_customize->add_section( 'pirate_switch_child_themes_section' , array(
		'title'		=> esc_html__( 'Child themes', 'pirate-switch' ),
		'priority'	=> 1,
		'panel' 	=> 'panel_pirate_switch'
	));
	
	$wp_customize->add_setting( 'pirate_switch_child_themes', array(
		'default' 			=> '',
		'sanitize_callback' => ''
	));
	$wp_customize->add_control( 'pirate_switch_child_themes', array(
		'label'    			=> esc_html__( 'Child', 'pirate-switch' ),
		'section'  			=> 'pirate_switch_child_themes_section',
		'priority'    		=> 2
	));
	
}
add_action( 'customize_register', 'pirate_switch_customize_register', 999 );
	
?>