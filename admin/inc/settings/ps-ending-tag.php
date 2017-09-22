<?php
/**
 * Ending tag Settings.
 */

$wp_customize->add_section( 'pirate_switch_end_section', array(
	'title'    => esc_html__( 'End section', 'pirate-switch' ),
	'panel'    => 'panel_pirate_switch',
	'priority' => 100
) );

$wp_customize->add_setting( 'pirate_switch_end_text', array(
	'default'           => '',
	'sanitize_callback' => ''
) );

$wp_customize->add_control( 'pirate_switch_end_text', array(
	'label'    => esc_html__( 'Text', 'pirate-switch' ),
	'section'  => 'pirate_switch_end_section',
	'priority' => 1
) );