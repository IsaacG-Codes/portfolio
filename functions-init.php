<?php

add_action('xews_lite_top_top_header','gaming_news_header_ticker', 10);
function gaming_news_header_ticker(){
    ?>
    <div class="top-header xews-header-container">
        <div class="container">
            <div class="top-header-xews-wrapper top-header-elem-wrap header-elements-wrap cww-flex">
                <?php
                    do_action('gaming_news_top_left_header');
                 ?>
            </div>
        </div>
    </div>
    <?php 
}

function gaming_news_ticker_module(){ 
    wp_print_styles( array( 'slick' ) );
    wp_print_scripts( array( 'slick' ) );

    $defaults                              = gaming_news_customizer_defaults();
    $gaming_news_ticker_label              = get_theme_mod('gaming_news_ticker_label', $defaults['gaming_news_ticker_label']);
    $gaming_news_ticker_label_layout       = get_theme_mod('gaming_news_ticker_label_layout', $defaults['gaming_news_ticker_label_layout']);
    $gaming_news_ticker_label_icon_show    = get_theme_mod('gaming_news_ticker_label_icon_show', $defaults['gaming_news_ticker_label_icon_show']);
    
    ?>

    <div class="xews-ticker-wrapper">
        <div class="inner-wrapper cww-flex">
        <div class="ticker-label <?php echo esc_attr($gaming_news_ticker_label_layout)?>">
            <?php if($gaming_news_ticker_label_icon_show){ ?>
                <span class="label-icon"><i class="fas fa-bolt"></i></span>
            <?php } ?>
            <span><?php echo esc_html($gaming_news_ticker_label); ?></span>
        </div>
        <?php echo gaming_news_ticker_latest_posts(); ?>
        </div>
    </div>

<?php }

/**
 * Ticker content controller
 */
function gaming_news_ticker_content_controller($ticker_args){

    $ticker_query = new WP_Query( $ticker_args );
    if( $ticker_query->have_posts() ):
        echo '<ul class="xews-news-ticker-content" >';
        while( $ticker_query->have_posts() ) {
            $ticker_query->the_post();  
            ?>
            <li>
                <?php  gaming_news_ticker_date(); ?>
                <a href="<?php the_permalink(); ?>" >
                    <?php the_title(); ?>
                </a>
            </li>
            <?php 
        }
        wp_reset_postdata();
        echo '</ul>';
    endif;
}



/**
 * Display from latest posts
 */
function gaming_news_ticker_latest_posts(){

    $defaults                          = gaming_news_customizer_defaults();
    $gaming_news_ticker_post_no        = get_theme_mod('gaming_news_ticker_post_no',$defaults['gaming_news_ticker_post_no']);
    $gaming_news_ticker_post_offset    = get_theme_mod('gaming_news_ticker_post_offset', $defaults['gaming_news_ticker_post_offset']);
    

    $ticker_args = array(
        'post_type'             => 'post',
        'posts_per_page'        => absint($gaming_news_ticker_post_no),
        'offset'                => absint($gaming_news_ticker_post_offset),
        'ignore_sticky_posts'   => 1
    ); 
 
    echo gaming_news_ticker_content_controller($ticker_args);
}



function gaming_news_ticker_date(){

    $defaults                       = gaming_news_customizer_defaults();
    $gaming_news_ticker_date_show   = get_theme_mod('gaming_news_ticker_date_show', $defaults['gaming_news_ticker_date_show']);
    
    if( $gaming_news_ticker_date_show ){

        $news_month     = get_the_date('m');
        $news_day       = get_the_date('d');
        ?>

        <span class="xews-news-ticker-date" title="<?php esc_attr_e( 'Published on:', 'gaming-news' ); ?> <?php echo get_the_date(); ?>">
            <span class="xews-news-ticker-date-month"><?php echo esc_html( $news_month ); ?></span>
            <span class="xews-news-ticker-date-sep">/</span>
            <span class="xews-news-ticker-date-day"><?php echo esc_html( $news_day ); ?></span>
            <span>:</span>
        </span>
    <?php
    }
}



/**
 * Default customizer settings value
 */
function gaming_news_customizer_defaults(){
    $defaults = array();
    $defaults['gaming_news_ticker_label_layout']              = 'layout-two';
    $defaults['gaming_news_ticker_label']                     = esc_html__('Live Updates','gaming-news');
    $defaults['gaming_news_ticker_date_show']                 = 0;
    $defaults['gaming_news_ticker_label_icon_show']           = true;
    $defaults['gaming_news_ticker_post_no']                   = 5;
    $defaults['gaming_news_ticker_post_offset']               = 0;
    $defaults['gaming_news_button_text']                      = esc_html__('Newsletter','gaming-news');
    $defaults['gaming_news_button_url']                       = '#';

    return $defaults;
}

add_filter('xews_lite_theme_color_filter', 'gaming_news_theme_color_filter');
function gaming_news_theme_color_filter() {
    $colors = array(
        '#ff3d4f' => array(
            'image'=> get_template_directory_uri().'/assets/img/color3.png',
        ),
        '#00bbf0' => array(
            'image'=> get_template_directory_uri().'/assets/img/color1.png',
        ),
        '#f70776' => array(
            'image'=> get_template_directory_uri().'/assets/img/color2.png',
        ),
        '#42b883' => array(
            'image'=> get_template_directory_uri().'/assets/img/color4.png',
        ),
        '#fe31aa' => array(
            'image'=> get_template_directory_uri().'/assets/img/color5.png',
        ),
        '#5865F2' => array(
            'image'=> get_stylesheet_directory_uri().'/assets/color6.png',
        ),
    );

    return $colors;
}