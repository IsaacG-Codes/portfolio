<?php
/**
 * Header Button settings
 * 
 */
add_action( 'customize_register', 'gaming_news_customize_button' );
function gaming_news_customize_button( $wp_customize ) {

$defaults = gaming_news_customizer_defaults();

$wp_customize->get_setting( 'background_color' )->default = '1b2838';


$wp_customize->add_section( 'gaming_news_button_section', array(
	'title'         => esc_html__('Header Button', 'gaming-news' ),
	'capability'    => 'edit_theme_options',
	'panel'         => 'xews_lite_header_panel',
) );

/** Button Text */
$wp_customize->add_setting( 'gaming_news_button_text', array( 
  'default' 			    => $defaults['gaming_news_button_text'],
  'sanitize_callback' => 'sanitize_text_field' 
) );

$wp_customize->add_control( 'gaming_news_button_text', array(
  'label'    => esc_html__( 'Input Button Text','gaming-news'),
  'section'  => 'gaming_news_button_section',
  'type'      => 'text',
  
) );

/** Button Link */
$wp_customize->add_setting( 'gaming_news_button_url', array( 
  'default' 			    => $defaults['gaming_news_button_url'],
  'sanitize_callback' => 'esc_url_raw' 
) );

$wp_customize->add_control( 'gaming_news_button_url', array(
  'label'    => esc_html__( 'Input Button URL','gaming-news'),
  'section'  => 'gaming_news_button_section',
  'type'      => 'url',
  
) );

}