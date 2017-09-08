<?php
/**
 * Colors Settings.
 */

$wp_customize->add_section( 'pirate_switch_colors_section', array(
    'title'    => esc_html__( 'Colors', 'pirate-switch' ),
    'panel'    => 'panel_pirate_switch',
    'priority' => 3
) );

$wp_customize->add_setting( 'pirate_switch_colors_title', array(
    'default'           => '',
    'sanitize_callback' => ''
) );

$wp_customize->add_control( 'pirate_switch_colors_title', array(
    'label'    => esc_html__( 'Title', 'pirate-switch' ),
    'section'  => 'pirate_switch_colors_section',
    'priority' => 1
) );

$wp_customize->add_setting( 'pirate_switch_colors_text', array(
    'default'           => '',
    'sanitize_callback' => ''
) );

$wp_customize->add_control( 'pirate_switch_colors_text', array(
    'label'    => esc_html__( 'Text', 'pirate-switch' ),
    'section'  => 'pirate_switch_colors_section',
    'priority' => 2
) );

$wp_customize->add_control( 'pirate_switch_colors_elements_background', array(
    'label'       => esc_html__( 'Change the background-color property for this list of elements.', 'pirate-switch' ),
    'description' => esc_html__( 'Separated by a comma.' ),
    'section'     => 'pirate_switch_colors_section',
    'priority'    => 4
) );

$wp_customize->add_setting( 'pirate_switch_colors_box', array(
    'sanitize_callback' => ''
) );

$wp_customize->add_control( new Pirate_Switch_General_Repeater( $wp_customize, 'pirate_switch_colors_box', array(
    'label'                       => esc_html__( 'Add new color', 'pirate-switch' ),
    'section'                     => 'pirate_switch_colors_section',
    'pirate_switch_color_control' => true,
    'pirate_switch_text_control'  => true,
    'priority'                    => 5
) ) );