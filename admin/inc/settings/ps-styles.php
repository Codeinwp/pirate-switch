<?php
/**
 * Styles Settings.
 */

$wp_customize->add_section( 'pirate_switch_styles_section', array(
	'title'    => esc_html__( 'Styles', 'pirate-switch' ),
	'panel'    => 'panel_pirate_switch',
	'priority' => 2
) );

$wp_customize->add_setting( 'pirate_switch_styles_title', array(
	'default'           => '',
	'sanitize_callback' => ''
) );

$wp_customize->add_control( 'pirate_switch_styles_title', array(
	'label'    => esc_html__( 'Title', 'pirate-switch' ),
	'section'  => 'pirate_switch_styles_section',
	'priority' => 1
) );

$wp_customize->add_setting( 'pirate_switch_styles_text', array(
	'default'           => '',
	'sanitize_callback' => ''
) );

$wp_customize->add_control( 'pirate_switch_styles_text', array(
	'label'    => esc_html__( 'Text', 'pirate-switch' ),
	'section'  => 'pirate_switch_styles_section',
	'priority' => 2
) );

$wp_customize->add_setting( 'pirate_switch_styles_new_tab', array(
	'sanitize_callback' => '',
	'default'           => 1
) );

$wp_customize->add_control( 'pirate_switch_styles_new_tab', array(
	'type'     => 'checkbox',
	'label'    => esc_html__( 'Open links in a new tab?', 'pirate-switch' ),
	'section'  => 'pirate_switch_styles_section',
	'priority' => 3
) );

$wp_customize->add_setting( 'pirate_switch_styles_box', array(
	'sanitize_callback' => ''
) );

$wp_customize->add_control( new Pirate_Switch_General_Repeater( $wp_customize, 'pirate_switch_styles_box', array(
	'label'                      => esc_html__( 'Add new style', 'pirate-switch' ),
	'section'                    => 'pirate_switch_styles_section',
	'pirate_switch_text_control' => true,
	'pirate_switch_link_control' => true,
	'priority'                   => 4
) ) );