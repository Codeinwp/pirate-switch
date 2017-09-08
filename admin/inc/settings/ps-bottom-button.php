<?php
/**
 * Buy Button Settings.
 */

$wp_customize->add_section('pirate_switch_bottom_button_section', array(
	'title' => esc_html__('Bottom button', 'pirate-switch'),
	'panel' => 'panel_pirate_switch',
	'priority' => 10
));

$wp_customize->add_setting('pirate_switch_bottom_button_title', array(
	'default' => '',
	'sanitize_callback' => ''
));

$wp_customize->add_control('pirate_switch_bottom_button_title', array(
	'label' => esc_html__('Label', 'pirate-switch'),
	'section' => 'pirate_switch_bottom_button_section',
	'priority' => 1
));

$wp_customize->add_setting('pirate_switch_bottom_button_link', array(
	'default' => '',
	'sanitize_callback' => ''
));

$wp_customize->add_control('pirate_switch_bottom_button_link', array(
	'label' => esc_html__('Link', 'pirate-switch'),
	'section' => 'pirate_switch_bottom_button_section',
	'priority' => 2
));

$wp_customize->add_setting( 'pirate_switch_bottom_button_new_tab', array(
	'sanitize_callback' => '',
	'default'           => 1
) );

$wp_customize->add_control( 'pirate_switch_bottom_button_new_tab', array(
	'type'     => 'checkbox',
	'label'    => esc_html__( 'Open link in a new tab?', 'pirate-switch' ),
	'section'  => 'pirate_switch_bottom_button_section',
	'priority' => 3
) );

$wp_customize->add_setting( 'pirate_switch_bottom_button_text_ribbon', array(
	'sanitize_callback' => '',
	'default'           => ''
) );

$wp_customize->add_control( 'pirate_switch_bottom_button_text_ribbon', array(
	'type'     => 'textarea',
	'label'    => esc_html__( 'Message Ribbon Text (can include HTML tags)', 'pirate-switch' ),
	'section'  => 'pirate_switch_bottom_button_section',
	'priority' => 4
) );
