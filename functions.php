<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
if ( !function_exists( 'gaming_news_locale_css' ) ):
    function gaming_news_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'gaming_news_locale_css' );


if ( !function_exists( 'gaming_news_add_scripts' ) ):
    function gaming_news_add_scripts() {
        wp_enqueue_style( 'gaming-news-parent', trailingslashit( get_template_directory_uri() ) . 'style.css' ) ;
        wp_enqueue_style( 'gaming-news-parent-dark-mode', trailingslashit( get_template_directory_uri() ) . '/assets/css/dark-mode.css' );
        wp_enqueue_style( 'slick', trailingslashit( get_stylesheet_directory_uri() ) . '/assets/slick/slick.css', array() );

        wp_enqueue_script( 'slick', trailingslashit( get_stylesheet_directory_uri() ) . '/assets/slick/slick.min.js', array('jquery'), XEWS_LITE_VERSION, true );
        wp_enqueue_script( 'gaming-news', trailingslashit( get_stylesheet_directory_uri() ) . '/assets/js/scripts.js', array('jquery'), XEWS_LITE_VERSION, true );
    }
endif;
add_action( 'wp_enqueue_scripts', 'gaming_news_add_scripts', 10 );


require get_stylesheet_directory() . '/customizer-ticker.php';
require get_stylesheet_directory() . '/functions-init.php';
require get_stylesheet_directory() . '/header-button.php';



add_action( 'init', 'gaming_news_init');
function gaming_news_init(){
    remove_action('xews_lite_top_header','xews_lite_site_branding', 10 );
    remove_action('xews_lite_top_header','xews_lite_top_left_header', 20 );
    remove_action('xews_lite_bottom_header','xews_lite_header_nav', 10 );
    remove_action('xews_lite_bottom_header','xews_lite_header_search', 20 );
    remove_action('xews_lite_main_header','xews_lite_header_structure_controller', 10 );

    add_action('gaming_news_top_left_header','xews_lite_header_search', 20 );
    add_action('xews_lite_bottom_header','gaming_news_ticker_module', 5 );
    add_action('gaming_news_top_left_header','xews_lite_site_branding', 10 );
    add_action('gaming_news_top_left_header','xews_lite_header_social_icons', 5);
    add_action('xews_lite_main_header','gaming_news_headers_structure_controller', 10 );
    add_action('xews_lite_main_header_content','xews_lite_header_date', 10 );
    add_action('xews_lite_main_header_content','xews_lite_header_nav', 20 );
}

/**
 * Override parent default setting values
 */
add_filter('xews_lite_default_theme_options','gaming_news_parent_defaults');
function gaming_news_parent_defaults(){

    $defaults = array();
        $theme_color = '#f70776';

        $defaults['xews_lite_theme_color']                   = $theme_color;
      
    
        $defaults['xews_lite_search_icon_color']             = '#fff';
        $defaults['xews_lite_date_display_enable']           = true;
        $defaults['xews_lite_darkmode_enable']               = true;
        $defaults['xews_lite_search_display_enable']         = true;
        $defaults['xews_lite_date_display_type']             = 'date-only';
        $defaults['xews_lite_date_text_color']               = '#fff';
        $defaults['xews_lite_nav_font_size']                 = 16;
        $defaults['xews_lite_nav_text_transform']            = 'none';
        $defaults['xews_lite_nav_hover_effect']              = 'none';
        $defaults['xews_lite_nav_bg_color']                  = '#333';
        $defaults['xews_lite_nav_underline_color']           = $theme_color;


        $defaults['xews_lite_title_tagline_color']           = '#333';

        
        $defaults['xews_lite_container_width']               = 1200;
        $defaults['xews_lite_related_posts_title']           = esc_html__('Related Posts','gaming-news');
        $defaults['xews_lite_related_post_type']             = 'cat';
        $defaults['xews_lite_related_post_count']            = 3;
        $defaults['xews_lite_related_post_offset']           = 0;
        $defaults['xews_lite_related_post_excerpts']         = 200;


        $defaults['xews_lite_inner_single_sidebar']          = 'sidebar-right';
        $defaults['xews_lite_inner_blog_sidebar']            = 'sidebar-right';
        $defaults['xews_lite_post_sidebar_area']             = 'sidebar-1';
        $defaults['xews_lite_post_sidebar_sticky_enable']    = true;
        $defaults['xews_lite_blog_sidebar_sticky_enable']    = true;
        $defaults['xews_lite_inner_blog_excerpt']            = 350;
        $defaults['xews_lite_post_readmore_enable']          = false;
        
        $defaults['xews_lite_blog_sidebar_area']             = 'sidebar-1';
        

        $defaults['xews_lite_nav_color']                     = '#333';

        
        return $defaults;

}

//Header controller

function gaming_news_headers_structure_controller(){
    $defaults                   = gaming_news_customizer_defaults();
    $headerImage                =  get_header_image() ?  get_header_image() : '';
    $headerClass                = $headerImage ? 'has-img': '';
    $gaming_news_button_text    = get_theme_mod( 'gaming_news_button_text', $defaults['gaming_news_button_text'] );
    $gaming_news_button_url     = get_theme_mod( 'gaming_news_button_url', $defaults['gaming_news_button_url'] );

    do_action('xews_lite_top_top_header');
    ?>
    <div class="main-headers xews-header-container <?php echo esc_attr($headerClass)?>">
        <div class="container">
            <div class="main-header-xews-wrapper main-header-elem-wrap header-elements-wrap cww-flex">
                <?php do_action('xews_lite_main_header_content'); ?>
                <div class="site-button">
		            <a href="<?php echo esc_url( $gaming_news_button_url ) ?>" target="_self">
			        <span><?php echo esc_html( $gaming_news_button_text ); ?></span>
		            </a>
	            </div>
            </div>
        </div>
    </div>

    <div class="bottom-header xews-header-container">
        <div class="container">
            <div class="bottom-header-xews-wrapper bottom-header-elem-wrap header-elements-wrap cww-flex">
                <?php  do_action('xews_lite_bottom_header'); ?>
            </div>
        </div>
    </div>

    <?php 
    
}