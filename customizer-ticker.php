<?php
/**
 * News ticker settings
 * 
 */
add_action( 'customize_register', 'gaming_news_customize_register' );
function gaming_news_customize_register( $wp_customize ) {

$defaults = gaming_news_customizer_defaults();

$wp_customize->add_section( 'gaming_news_headerticker_section', array(
	'title'         => esc_html__('News Ticker', 'gaming-news' ),
	'capability'    => 'edit_theme_options',
	'panel'         => 'xews_lite_header_panel',
) );

/**
 * Ticker Layout
 */
$wp_customize->add_setting( 'gaming_news_ticker_label_layout', array( 
    'default' 			=> $defaults['gaming_news_ticker_label_layout'],
    'sanitize_callback' => 'esc_html' 
) );

$wp_customize->add_control( 'gaming_news_ticker_label_layout', array(
    'label'         => esc_html__( 'Ticker Label Layout','gaming-news'),
    'section'       => 'gaming_news_headerticker_section',
    'type'          => 'select',
    'choices'       => array(
        'layout-one'   => esc_html__( 'Layout One', 'gaming-news' ),
        'layout-two'   => esc_html__( 'Layout Two', 'gaming-news' ),
    ),
) );





$wp_customize->add_setting( 'gaming_news_ticker_label', array(
    'default' 			=> $defaults['gaming_news_ticker_label'],
    'sanitize_callback' => 'sanitize_text_field' 
) );

$wp_customize->add_control( 'gaming_news_ticker_label', array(
    'label'     => esc_html__( 'Label','gaming-news'),
    'section'   => 'gaming_news_headerticker_section',
    'type'      => 'text',
) );


$wp_customize->add_setting( 'gaming_news_ticker_date_show',
	array(
		'default' 			=> $defaults['gaming_news_ticker_date_show'],
		'sanitize_callback' => 'xews_lite_sanitize_checkbox'
	)
);
$wp_customize->add_control( 'gaming_news_ticker_date_show',
	array(
		'label' 		=> esc_html__( 'Display Date?','gaming-news' ),
		'section' 		=> 'gaming_news_headerticker_section',
        'type'          => 'checkbox',
	)
);


$wp_customize->add_setting( 'gaming_news_ticker_label_icon_show',
	array(
		'default' 			=> $defaults['gaming_news_ticker_label_icon_show'],
		'sanitize_callback' => 'xews_lite_sanitize_checkbox'
	)
);
$wp_customize->add_control( 'gaming_news_ticker_label_icon_show',
	array(
		'label' 		=> esc_html__( 'Display Icon On Label?','gaming-news' ),
		'section' 		=> 'gaming_news_headerticker_section',
        'type'          => 'checkbox',
	)
);



/** Posts per page */
$wp_customize->add_setting( 'gaming_news_ticker_post_no', array( 
    'default' 			=> $defaults['gaming_news_ticker_post_no'],
    'sanitize_callback' => 'sanitize_text_field' 
) );

$wp_customize->add_control( 'gaming_news_ticker_post_no', array(
    'label'    => esc_html__( 'Posts Per Page','gaming-news'),
    'section'  => 'gaming_news_headerticker_section',
    'type'    => 'number',
    
) );

/** offset */
$wp_customize->add_setting( 'gaming_news_ticker_post_offset', array( 
    'default' 			=> $defaults['gaming_news_ticker_post_offset'],
    'sanitize_callback' => 'sanitize_text_field' 
) );

$wp_customize->add_control( 'gaming_news_ticker_post_offset', array(
    'label'     => esc_html__( 'Offset','gaming-news'),
    'section'   => 'gaming_news_headerticker_section',
    'type'      => 'number',
    
) );



}