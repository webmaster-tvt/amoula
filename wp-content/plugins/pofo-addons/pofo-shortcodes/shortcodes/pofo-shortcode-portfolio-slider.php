<?php
/**
 * Shortcode For Portfolio Slider
 *
 * @package Pofo
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Slider */
/*-----------------------------------------------------------------------------------*/

global $pofo_slider_parent_type;
$pofo_slider_unique_id = 1;
function pofo_portfolio_slider_shortcode( $atts, $content = null ) {
    
    global $pofo_slider_parent_type, $pofo_slider_unique_id, $pofo_featured_array, $pofo_slider_script, $pofo_portfolio_slider_style1, $pofo_portfolio_slider_style2, $pofo_portfolio_slider_style3, $pofo_portfolio_slider_style4, $pofo_portfolio_slider_style5;

    extract( shortcode_atts( array(
                'pofo_slider_style' => '',
                'mousewheel_control' => '',
                'show_pagination' => '1',
                'show_pagination_style' => '',
                'show_pagination_color_style' => '1',
                'show_navigation' => '',
                'show_navigation_style' => '',
                'show_scroll_navigation' => '1',
                'show_cursor_color_style' => '',
                'slides_per_view_desktop' => '4',
                'slides_per_view_mini_desktop' => '3',
                'slides_per_view_tablet' => '2',
                'slides_per_view_mobile' => '1',
                'autoloop' => '1',
                'slider_transition_style' => '',
                'autoplay' => '',
                'slidedelay' => '3000',
                'slidespeed' => '',                
                
                'pofo_categories_list' => '',
                'pofo_image_srcset' => 'full',
                'pofo_enable_link' => '1',
                'pofo_link_on' => '',
                'pofo_show_title' => '1',
                'pofo_show_excerpt' => '1',
                'pofo_show_content' => '1',
                'pofo_excerpt_length' => '15',
                'pofo_show_category' => '1',
                'pofo_show_button' => '1',
                'pofo_button_text' => '',
                'pofo_show_separator' => '1',
                
                'pofo_title_font_size' => '',
                'pofo_title_line_height' => '',
                'pofo_title_letter_spacing' => '',
                'pofo_title_font_weight' => '',
                'pofo_title_italic' => '',
                'pofo_title_underline' => '',
                'pofo_title_element_tag' => '',
                'pofo_title_color' => '',
                'pofo_title_enable_responsive_font' => '',
                'pofo_title_responsive_settings' => '',
                'pofo_subtitle_font_size' => '',
                'pofo_subtitle_line_height' => '',
                'pofo_subtitle_letter_spacing' => '',
                'pofo_subtitle_font_weight' => '',
                'pofo_subtitle_color' => '',
                'pofo_subtitle_enable_responsive_font' => '',
                'pofo_subtitle_hover_color' => '',
                'pofo_subtitle_responsive_settings' => '',
                'pofo_link_image' => '',

                'pofo_subtitle_strikethrough' => '1',
                'pofo_lg_min_height' => '',
                'pofo_md_min_height' => '',
                'pofo_sm_min_height' => '',
                'pofo_xs_min_height' => '',
                'pofo_button_color' => '',
                'pofo_button_hover_color' => '',
                'pofo_button_text_color' => '',
                'pofo_button_hover_text_color' => '',
                'pofo_button_border_color' => '',
                'pofo_scroll_progress_line_color' => '',
                'pofo_scroll_progress_point_color' => '',
                'pofo_scroll_navigation_color' => '',
                'pofo_scroll_navigation_icon_color' => '',
                'pofo_separator_color' => '',
                'pofo_separator_height' => '',
                'pofo_content_bg_color' => '',
                'pofo_post_per_page' => '5',
                'pofo_orderby' => '',
                'pofo_order' => '',
                'pofo_slider_id' => '',
                'pofo_slider_class' => '',
            ), $atts ) );

    $output  = $slider_class = $separator_style = $pofo_title_style_attr = $pofo_subtitle_style_attr = '';
    $pofo_title_style_array = $pofo_subtitle_style_array = array();
    
    $pofo_image_srcset  = ! empty( $pofo_image_srcset ) ? $pofo_image_srcset : 'full';

    $show_pagination_color_style= ( $show_pagination_color_style ) ? ' swiper-pagination-white' : ' swiper-pagination-black';
    $pofo_slider_class      = ( $pofo_slider_class ) ? ' '.$pofo_slider_class . ' ' . $pofo_slider_style : ' '.$pofo_slider_style;
    $pofo_slider_style      = ( $pofo_slider_style ) ? $pofo_slider_style : '';
    
    if( $pofo_slider_style == 'portfolio-slider-style-1' || $pofo_slider_style == 'portfolio-slider-style-3' ) {
        $show_cursor_color_style    = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' black-move';
    }

    $slides_per_view_desktop= ! empty( $slides_per_view_desktop ) ? $slides_per_view_desktop : '4';
    $slides_per_view_mini_desktop= ! empty( $slides_per_view_mini_desktop ) ? $slides_per_view_mini_desktop : '3';
    $slides_per_view_tablet = ! empty( $slides_per_view_tablet ) ? $slides_per_view_tablet : '2';
    $slides_per_view_mobile = ! empty( $slides_per_view_mobile ) ? $slides_per_view_mobile : '1';

    //For Button Style
    $pofo_button_color= ($pofo_button_color) ? ' background-color: '.$pofo_button_color.' !important; ' : '';
    $pofo_button_hover_color= ($pofo_button_hover_color) ? ' background-color: '.$pofo_button_hover_color.' !important; ' : '';
    $pofo_button_text_color= ($pofo_button_text_color) ? ' color: '.$pofo_button_text_color.' !important; ' : '';
    $pofo_button_hover_text_color= ($pofo_button_hover_text_color) ? ' color: '.$pofo_button_hover_text_color.' !important; ' : '';
    $pofo_button_border_color= ($pofo_button_border_color) ? ' border-color: '.$pofo_button_border_color.' !important; ' : '';
   
    // Check if slider id and class
    $pofo_slider_unique_id  = ! empty( $pofo_slider_unique_id ) ? $pofo_slider_unique_id : 1;
    $navigation_unique_id   = $pofo_slider_unique_id;
    $pofo_slider_id         = ( $pofo_slider_id ) ? $pofo_slider_id : 'portfolio-slider';
    $pofo_slider_id         .= '-' . $pofo_slider_unique_id;
    $pofo_slider_unique_id++;

    $pofo_post_per_page     = ($pofo_post_per_page) ? $pofo_post_per_page : '-1';
    $pofo_orderby           = ($pofo_orderby) ? $pofo_orderby : 'date';
    $pofo_order             = ($pofo_order) ? $pofo_order : 'ASC';
    
    $categories_to_display_ids = ! empty( $pofo_categories_list ) ? explode(",",$pofo_categories_list) : array();
    if ( is_array( $categories_to_display_ids ) && empty( $categories_to_display_ids[0] ) ) {
        unset( $categories_to_display_ids[0] );
        $categories_to_display_ids = array_values( $categories_to_display_ids );
    }
    
    // If no categories are chosen or "All categories", we need to load all available categories
    if ( ! is_array( $categories_to_display_ids ) || count( $categories_to_display_ids ) == 0 ) {
        $terms = get_terms( 'portfolio-category' );
        
        if ( ! is_array( $categories_to_display_ids ) ) {
            $categories_to_display_ids = array();
        }
        if( ! empty( $terms ) && !is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $categories_to_display_ids[] = $term->slug;
            }
        }
    }

    $pofo_enable_link   = ( $pofo_enable_link ) ? $pofo_enable_link : '';
    $pofo_link_on       = ( $pofo_link_on ) ? $pofo_link_on : '';

    $pofo_show_title    = ( $pofo_show_title ) ? $pofo_show_title : '';
    $pofo_show_button   = ( $pofo_show_button ) ? $pofo_show_button : '';
    $pofo_show_category = ( $pofo_show_category ) ? $pofo_show_category : '';

    // For Title Style
    ! empty( $pofo_title_font_size ) ? $pofo_title_style_array[] = 'font-size: ' . $pofo_title_font_size . ';' : '';
    ! empty( $pofo_title_line_height ) ? $pofo_title_style_array[] = 'line-height: ' . $pofo_title_line_height . ';' : '';
    ! empty( $pofo_title_letter_spacing ) ? $pofo_title_style_array[] = 'letter-spacing: ' . $pofo_title_letter_spacing . ';' : '';
    ! empty( $pofo_title_font_weight ) ? $pofo_title_style_array[] = 'font-weight: ' . $pofo_title_font_weight . ';' : '';
    ( $pofo_title_italic == 1 ) ? $pofo_title_style_array[] = 'font-style: italic;' : '';
    ( $pofo_title_underline == 1 ) ? $pofo_title_style_array[] = 'text-decoration: underline;' : '';
    ! empty( $pofo_title_color ) ? $pofo_title_style_array[] = 'color: '.$pofo_title_color.';' : '';

    $pofo_title_dynamic_font_size = $pofo_title_enable_responsive_font == 1 ? ' dynamic-font-size' : '';
    $pofo_title_dynamic_font_size .= ! empty( $pofo_title_responsive_settings ) ? ' '.pofo_shortcode_custom_css_class( $pofo_title_responsive_settings ) : '';
    $pofo_title_style_attr   = pofo_get_style_attribute( $pofo_title_style_array, $pofo_title_font_size, $pofo_title_line_height );

    // For Subtitle Style
    ! empty( $pofo_subtitle_font_size ) ? $pofo_subtitle_style_array[] = 'font-size: ' . $pofo_subtitle_font_size . ';' : '';
    ! empty( $pofo_subtitle_line_height ) ? $pofo_subtitle_style_array[] = 'line-height: ' . $pofo_subtitle_line_height . ';' : '';
    ! empty( $pofo_subtitle_letter_spacing ) ? $pofo_subtitle_style_array[] = 'letter-spacing: ' . $pofo_subtitle_letter_spacing . ';' : '';
    ! empty( $pofo_subtitle_font_weight ) ? $pofo_subtitle_style_array[] = 'font-weight: ' . $pofo_subtitle_font_weight . ';' : '';
    $pofo_subtitle_color = ! empty( $pofo_subtitle_color ) ? 'color: '.$pofo_subtitle_color.';' : '';
    ! empty( $pofo_subtitle_color ) ? $pofo_subtitle_style_array[] = $pofo_subtitle_color : '';
    $pofo_subtitle_hover_color = ! empty( $pofo_subtitle_hover_color ) ? 'color: '.$pofo_subtitle_hover_color.';' : '';

    $pofo_subtitle_dynamic_font_size = $pofo_subtitle_enable_responsive_font == 1 ? ' dynamic-font-size' : '';
    $pofo_subtitle_dynamic_font_size .= ! empty( $pofo_subtitle_responsive_settings ) ? ' '.pofo_shortcode_custom_css_class( $pofo_subtitle_responsive_settings ) : '';
    $pofo_subtitle_style_attr   = pofo_get_style_attribute( $pofo_subtitle_style_array, $pofo_subtitle_font_size, $pofo_subtitle_line_height );

    // For Separator Style
    $pofo_separator_color = ( $pofo_separator_color ) ? 'background-color:'.$pofo_separator_color.'; ': '';
    $pofo_separator_height = ( $pofo_separator_height ) ? 'height:'.$pofo_separator_height.'; ': '';
    if($pofo_separator_color || $pofo_separator_height){
        $separator_style = ' style="'.$pofo_separator_color.$pofo_separator_height.'"';
    }

    // For Content Background Color
    $pofo_content_bg_color = ( $pofo_content_bg_color ) ? ' style="background-color:'.$pofo_content_bg_color.';" ': '';

    // Progress navigation Color
    $pofo_scroll_progress_line_color = ( $pofo_scroll_progress_line_color ) ? ' background-color:'.$pofo_scroll_progress_line_color.'; ': '';
    $pofo_scroll_progress_point_color = ( $pofo_scroll_progress_point_color ) ? ' background-color:'.$pofo_scroll_progress_point_color.'; ': '';
    $pofo_scroll_navigation_color = ( $pofo_scroll_navigation_color ) ? ' color:'.$pofo_scroll_navigation_color.'; ': '';
    $pofo_scroll_navigation_icon_color = ( $pofo_scroll_navigation_icon_color ) ? ' color:'.$pofo_scroll_navigation_icon_color.'; ': '';

    $args = array(
        'post_type' => 'portfolio',
        'posts_per_page' => $pofo_post_per_page,
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolio-category',
                'field' => 'slug',
                'terms' => $categories_to_display_ids
           ),
        ),
        'orderby' => $pofo_orderby,
        'order' => $pofo_order,
    );
    $portfolio_posts = new WP_Query( $args );

    /* Add custom script Start*/

    if( $show_pagination == 1 && ( $pofo_slider_style == 'portfolio-slider-style-1' || $pofo_slider_style == 'portfolio-slider-style-5' )  ) {
        $class_name = 'swiper-pagination-' . $navigation_unique_id;
        $swiper_config['pagination'] = array( 'el' => '.' . $class_name, 'type' => 'bullets', 'clickable' => true );
    }

    if( $show_pagination == 1 && ( $pofo_slider_style == 'portfolio-slider-style-4' ) ) {
        $class_name = 'swiper-pagination-' . $navigation_unique_id;
        $swiper_config['pagination'] = array( 'el' => '.' . $class_name, 'type' => 'bullets', 'clickable' => true );
    }

    if( $show_navigation == 1 && ( $pofo_slider_style == 'portfolio-slider-style-6' ) ) {
        $swiper_config['navigation'] = array( 'nextEl' => '.swiper-next-'. $navigation_unique_id, 'prevEl' => '.swiper-prev-'. $navigation_unique_id );
    }

    if( $show_navigation == 1 && ( $pofo_slider_style == 'portfolio-slider-style-1' ) ) {
        $swiper_config['navigation'] = array( 'nextEl' => '.swiper-next-'. $navigation_unique_id, 'prevEl' => '.swiper-prev-'. $navigation_unique_id );
    }

    if( $show_scroll_navigation == 1 && ( $pofo_slider_style == 'portfolio-slider-style-2' || $pofo_slider_style == 'portfolio-slider-style-3' ) ) {
        $swiper_config['navigation'] = array( 'nextEl' => '.swiper-next-'. $navigation_unique_id, 'prevEl' => '.swiper-prev-'. $navigation_unique_id );
        $swiper_config['scrollbar'] = array( 'el' => '.swiper-scrollbar', 'draggable' => true, 'hide' =>false ); 
    }

    $slidedelay = ( $slidedelay ) ? $slidedelay : '3000';
    $slidespeed = ( $slidespeed ) ? $slidespeed : '';

    if( $pofo_slider_style != 'portfolio-slider-style-3' ) {
        if( $autoloop == 1 ) {
            $swiper_config['loop'] = true;
        }
    }

    if( $autoplay == 1 ) {
        $swiper_config['autoplay'] = array( 'delay' => intval( $slidedelay ) );
    } else { 
        $swiper_config['autoplay'] = false;
    } 

    if( $slidespeed ) {
        $swiper_config['speed'] = $slidespeed;
    }

    $swiper_config['keyboard'] = array( 'enabled' =>true, 'onlyInViewport' =>false );
    
    // Mousewheel Control
    $mousewheel_control = isset( $mousewheel_control ) ? $mousewheel_control : '';
    if( $mousewheel_control == 'on' || ( empty( $mousewheel_control ) && ( $pofo_slider_style == 'portfolio-slider-style-3' || $pofo_slider_style == 'portfolio-slider-style-4' ) ) ) {
        $swiper_config['mousewheel'] = true;
    } else {
        $swiper_config['mousewheel'] = false;
    }

     if( $slider_transition_style ) {
            $swiper_config['effect'] = $slider_transition_style;
        }

    if( $pofo_slider_style == 'portfolio-slider-style-2' ) {

        $swiper_config['slidesPerView'] = 1;
        $swiper_config['centeredSlides'] = true;
        $swiper_config['spaceBetween'] = 15;
        $swiper_config['preventClicks'] = false;
        $swiper_config['snapOnRelease'] = true;
        $swiper_config['speed'] = 1000;
        $swiper_config['breakpoints'] = array( '768' => array( 'slidesPerView' => 1, 'spaceBetween' => 30 ), '992' => array( 'slidesPerView' => 1.6, 'spaceBetween' => 60 ), '1200' => array( 'slidesPerView' => 1.6, 'spaceBetween' => 80 ) ); 

    } else if( $pofo_slider_style == 'portfolio-slider-style-3' ) {

        $swiper_config['slidesPerView'] = 'auto';
        $swiper_config['snapOnRelease'] = true;
        $swiper_config['grabCursor'] = true;
        $swiper_config['preventClicks'] = false;
        $swiper_config['spaceBetween'] = 30;

    } else if( $pofo_slider_style == 'portfolio-slider-style-4' ) {

        $swiper_config['direction'] = 'vertical';
        $swiper_config['slidesPerView'] = 1;
        $swiper_config['spaceBetween'] = 0;
        $swiper_config['releaseOnEdges'] = true;

    } else if( $pofo_slider_style == 'portfolio-slider-style-5' ) {

        $swiper_config['preventClicks'] = false;
        $swiper_config['slidesPerView'] = $slides_per_view_mobile;
        $swiper_config['breakpoints'] = array( '768' => array( 'slidesPerView' => $slides_per_view_tablet ), '992' => array( 'slidesPerView' => $slides_per_view_mini_desktop ), '1200' => array( 'slidesPerView' => $slides_per_view_desktop ) );              

    } else if( $pofo_slider_style == 'portfolio-slider-style-6' ) {

        $swiper_config['spaceBetween'] = 15;
        $swiper_config['snapOnRelease'] = true;
        $swiper_config['disableOnInteraction'] = true;
        $swiper_config['slidesPerView'] = $slides_per_view_mobile;
        $swiper_config['breakpoints'] = array( '768' => array( 'slidesPerView' => $slides_per_view_tablet ), '992' => array( 'slidesPerView' => $slides_per_view_mini_desktop ), '1200' => array( 'slidesPerView' => $slides_per_view_desktop ) );

    } else {

        $swiper_config['stopOnLastSlide'] = true;
        $swiper_config['disableOnInteraction'] = false;
        $swiper_config['slidesPerView'] = 1;

    }

    $slider_options = ! empty( $swiper_config ) ? json_encode( $swiper_config ) : '';


    switch ( $pofo_slider_style ) {

        case 'portfolio-slider-style-1':
                
                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'span';
                $subtitle_strikethrough = $pofo_subtitle_strikethrough == 1 ? ' text-middle-line sm-text-middle-line' : '';

                $output .= '<div id="'.$pofo_slider_id.'" class="swiper-container height-100 width-100 '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                <div class="swiper-wrapper">';

                    while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();

                        //Custom css start
                        $pofo_portfolio_slider_style1 = ! empty( $pofo_portfolio_slider_style1 ) ? $pofo_portfolio_slider_style1 : 0;
                        $pofo_portfolio_slider_style1 = $pofo_portfolio_slider_style1 + 1;

                        if( ! empty( $pofo_button_color ) ){
                            $pofo_featured_array[] = '.portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' a.btn { '.$pofo_button_color.' }';   
                        }
                        if( ! empty( $pofo_button_hover_color ) ){
                            $pofo_featured_array[] = '.portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' a.btn:hover { '.$pofo_button_hover_color.' }';   
                        }
                        if( ! empty( $pofo_button_text_color ) ){
                            $pofo_featured_array[] = '.portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' a.btn { '.$pofo_button_text_color.' }';   
                        }
                        if( ! empty( $pofo_button_hover_text_color ) ){
                            $pofo_featured_array[] = '.portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' a.btn:hover { '.$pofo_button_hover_text_color.' }';   
                        }
                        if( ! empty( $pofo_button_border_color ) ){
                            $pofo_featured_array[] = '.portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' a.btn { '.$pofo_button_border_color.' }';   
                        }

                        //Custom css for slider height
                        if( ! empty( $pofo_lg_min_height ) ) {
                            $pofo_featured_array[] = '.portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' .slider-half-screen { min-height: '.$pofo_lg_min_height.' !important; }';
                        }
                        if( ! empty( $pofo_md_min_height ) ) {
                            $pofo_featured_array[] = '@media (max-width: 1199px) { .portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' .slider-half-screen { min-height: '.$pofo_md_min_height.' !important; } }';
                        }
                        if( ! empty( $pofo_sm_min_height ) ) {
                            $pofo_featured_array[] = '@media (max-width: 991px) { .portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' .slider-half-screen { min-height: '.$pofo_sm_min_height.' !important; } }';
                        }
                        if( ! empty( $pofo_xs_min_height ) ) {
                            $pofo_featured_array[] = '@media (max-width: 767px) { .portfolio-slider-style1-'.$pofo_portfolio_slider_style1.' .slider-half-screen { min-height: '.$pofo_xs_min_height.' !important; } }';
                        }
                        //Custom css end

                        /* Image Alt, Title, Caption */
                        $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                        $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                        $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                        $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                        $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                        
                        $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, $pofo_image_srcset ) : '';
                        $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                        $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                        $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                        $srcset = $srcset_data = $sizes_data = $srcset_classes = '';
                        $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, $pofo_image_srcset ) : '';
                        if( $srcset ){
                            $srcset_data = ' data-bg-srcset="'.esc_attr( $srcset ).'"';
                            $srcset_classes = ' bg-image-srcset';
                        }

                        $sizes = ! empty( $thumbnail_id ) ? wp_get_attachment_image_sizes( $thumbnail_id, $pofo_image_srcset ) : '';
                        if( $sizes ){
                            $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                        }

                        $cat_slug = '';
                        $cat_name = array();
                        $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                        if( ! empty( $cat ) && !is_wp_error( $cat ) ) {
                            foreach ($cat as $key => $c) {
                                $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                $cat_name[] = $c->name;
                            }
                        }

                        if( ! empty( $image_url ) ){
                            $img_style = ' style="background-image:url('.$image_url.');"';
                        } else {
                            $img_style = '';
                        }

                        $pofo_portfolio_post_type       = pofo_post_meta( 'pofo_portfolio_post_type' );
                        $pofo_portfolio_external_link   = pofo_post_meta( 'pofo_portfolio_external_link' );
                        $pofo_portfolio_link_target     = pofo_post_meta( 'pofo_portfolio_link_target' );
                        $pofo_portfolio_external_link   = ( ! empty( $pofo_portfolio_external_link ) && $pofo_portfolio_post_type == 'link' ) ? $pofo_portfolio_external_link : get_permalink() ;
                        $pofo_portfolio_link_target     = ! empty( $pofo_portfolio_link_target ) ? ' target="'. $pofo_portfolio_link_target .'"' : ' target="_self"';

                        $button_text = ! empty( $pofo_button_text ) ? $pofo_button_text : esc_html__( 'Explore Work', 'pofo-addons' );

                        $pofo_portfolio_classes = '';
                        ob_start();
                            post_class('pofo-rich-snippet display-none');
                            $pofo_portfolio_classes .= ob_get_contents();
                        ob_end_clean();

                        $output .= '<div class="swiper-slide cover-background xs-background-image-center portfolio-slider-style1-'.$pofo_portfolio_slider_style1.$srcset_classes.'"'.$img_style.$srcset_data.'>';
                            $output .= '<div '.$pofo_portfolio_classes.'>';
                                $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                
                                $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                            $output .= '</div>';
                            $output .= '<div class="container-fluid slider-half-screen position-relative">';
                                $output .= '<div class="slider-typography text-left">';
                                    $output .= '<div class="slider-text-middle-main">';
                                        $output .= '<div class="slider-text-middle padding-ten-left xs-padding-five-left">';
                                            if($pofo_show_category == 1 && ! empty( $cat_name )):
                                                $output .='<span class="text-deep-pink display-block width-20 xs-width-50'.esc_attr( $subtitle_strikethrough.$pofo_subtitle_dynamic_font_size ) .'"'.$pofo_subtitle_style_attr.'>'.implode(' and ', $cat_name).'</span>';
                                            endif;
                                            if($pofo_show_title == 1):
                                                $output .= '<'.$pofo_title_element_tag.' class="title-large alt-font text-extra-dark-gray font-weight-700 width-30 margin-40px-tb xs-margin-20px-tb display-block letter-spacing-minus-2 sm-width-60'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.get_the_title().'</'.$pofo_title_element_tag.'>';
                                            endif;
                                            if($pofo_show_button == 1):
                                                $output .='<a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.' class="btn btn-small btn-dark-gray">'.$button_text.'</a>';
                                            endif;
                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';

                    endwhile;
                    wp_reset_postdata();

                $output .= '</div>';

            break;

        case 'portfolio-slider-style-2':
    
                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'h2';

                //Custom css start
                $pofo_portfolio_slider_style2 = ! empty( $pofo_portfolio_slider_style2 ) ? $pofo_portfolio_slider_style2 : 0;
                $pofo_portfolio_slider_style2 = $pofo_portfolio_slider_style2 + 1;

                if( ! empty( $pofo_scroll_progress_line_color ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style2-'.$pofo_portfolio_slider_style2.' .swiper-scrollbar { '.$pofo_scroll_progress_line_color.' }';   
                }
                if( ! empty( $pofo_scroll_progress_point_color ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style2-'.$pofo_portfolio_slider_style2.' .swiper-scrollbar-drag:before { '.$pofo_scroll_progress_point_color.' }';   
                }
                if( ! empty( $pofo_scroll_navigation_color ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style2-'.$pofo_portfolio_slider_style2.' .scroll-navigation { '.$pofo_scroll_navigation_color.' }';   
                }
                if( ! empty( $pofo_scroll_navigation_icon_color ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style2-'.$pofo_portfolio_slider_style2.' .scroll-navigation i { '.$pofo_scroll_navigation_icon_color.' }';   
                }

                //Custom css for slider height
                if( ! empty( $pofo_lg_min_height ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style2-'.$pofo_portfolio_slider_style2.' { min-height: '.$pofo_lg_min_height.' !important; }';
                }
                if( ! empty( $pofo_md_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 1199px) { .portfolio-slider-style2-'.$pofo_portfolio_slider_style2.' { min-height: '.$pofo_md_min_height.' !important; } }';
                }
                if( ! empty( $pofo_sm_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 991px) { .portfolio-slider-style2-'.$pofo_portfolio_slider_style2.' { min-height: '.$pofo_sm_min_height.' !important; } }';
                }
                if( ! empty( $pofo_xs_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 767px) { .portfolio-slider-style2-'.$pofo_portfolio_slider_style2.' { min-height: '.$pofo_xs_min_height.' !important; } }';
                }
                
                $output .= '<div class="full-screen position-relative portfolio-slider-style2-'.$pofo_portfolio_slider_style2.'">';
                    $output .= '<div id="'.$pofo_slider_id.'" class="swiper-auto-width swiper-container '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                    <div class="swiper-wrapper">';

                        while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();

                            /* Image Alt, Title, Caption */
                            $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                            $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                            $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                            $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                            $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                            
                            $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, $pofo_image_srcset ) : '';
                            $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                            $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                            $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                            $srcset = $srcset_data = $sizes_data = $srcset_classes = '';
                            $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, $pofo_image_srcset ) : '';
                            if( $srcset ){
                                $srcset_data = ' data-bg-srcset="'.esc_attr( $srcset ).'"';
                                $srcset_classes = ' bg-image-srcset';
                            }

                            $sizes = ! empty( $thumbnail_id ) ? wp_get_attachment_image_sizes( $thumbnail_id, $pofo_image_srcset ) : '';
                            if( $sizes ){
                                $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                            }

                            $cat_slug = '';
                            $cat_name = array();
                            $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                            if( ! empty( $cat ) && !is_wp_error( $cat ) ) {
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                    $cat_name[] = $c->name;
                                }
                            }

                            if( ! empty( $image_url ) ){
                                $img_style = ' style="background-image:url('.$image_url.');"';
                            } else {
                                $img_style = '';
                            }

                            $pofo_portfolio_post_type       = pofo_post_meta( 'pofo_portfolio_post_type' );
                            $pofo_portfolio_external_link   = pofo_post_meta( 'pofo_portfolio_external_link' );
                            $pofo_portfolio_link_target     = pofo_post_meta( 'pofo_portfolio_link_target' );
                            $pofo_portfolio_external_link   = ( ! empty( $pofo_portfolio_external_link ) && $pofo_portfolio_post_type == 'link' ) ? $pofo_portfolio_external_link : get_permalink() ;
                            $pofo_portfolio_link_target     = ! empty( $pofo_portfolio_link_target ) ? ' target="'. $pofo_portfolio_link_target .'"' : ' target="_self"';

                            $pofo_portfolio_classes = '';
                            ob_start();
                                post_class('pofo-rich-snippet display-none');
                                $pofo_portfolio_classes .= ob_get_contents();
                            ob_end_clean();

                            $output .= '<div class="swiper-slide cover-background'.$srcset_classes.'"'.$img_style.$srcset_data.'>';
                                $output .= '<div class="opacity-extra-medium bg-black"></div>';
                                $output .= '<div '.$pofo_portfolio_classes.'>';
                                    $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                    
                                    $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                    $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                                $output .= '</div>';
                                if( $pofo_enable_link == 1 && $pofo_link_on == 'box' ) {
                                    $output .= '<a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.'>';
                                }
                                    $output .= '<div class="position-relative height-100">';
                                            if($pofo_show_title == 1):
                                                $output .= '<div class="absolute-middle-center width-100 text-center">';
                                                    $output .= '<div class="parallax-text">';
                                                        $output .= '<'.$pofo_title_element_tag.' class="alt-font font-weight-600 parallax-text-shadow">';
                                                            if( $pofo_enable_link == 1 && empty( $pofo_link_on ) ) {
                                                                $output .= '<a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.'>';
                                                            }
                                                                $output .= '<span class="text-white text-white-hover'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>' . get_the_title() . '</span>';
                                                            if( $pofo_enable_link == 1 && empty( $pofo_link_on ) ) {
                                                                $output .= '</a>';
                                                            }
                                                        $output .= '</'.$pofo_title_element_tag.'>';
                                                    $output .= '</div>';
                                                $output .= '</div>';
                                            endif;
                                            if($pofo_show_category == 1 && ! empty( $cat_name )):
                                                $output .='<span class="text-medium position-absolute bottom-50 text-light-gray width-100 text-center'.esc_attr( $pofo_subtitle_dynamic_font_size ).'"'.$pofo_subtitle_style_attr.'>'.implode(' and ', $cat_name).'</span>';
                                            endif;
                                    $output .= '</div>';
                                if( $pofo_enable_link == 1 && $pofo_link_on == 'box' ) {
                                    $output .= '</a>';
                                }
                            $output .= '</div>';

                        endwhile;
                        wp_reset_postdata();

                    $output .= '</div><!-- .swiper-wrapper -->';

                    if( $show_scroll_navigation == 1 ) {

                        $output .= '<div class="swiper-scrollbar xs-display-none"></div>';

                        $output .= '<div class="swiper-next-style2 text-small scroll-navigation alt-font xs-display-none swiper-next-' . $navigation_unique_id . '">'.esc_html__( 'Next', 'pofo-addons' ).' <i class="fas fa-long-arrow-alt-right icon-very-small position-relative text-extra-dark-gray top-2 margin-5px-left" aria-hidden="true"></i></div>
                            <div class="swiper-prev-style2 text-small scroll-navigation alt-font xs-display-none swiper-prev-' . $navigation_unique_id . '"><i class="fas fa-long-arrow-alt-left icon-very-small position-relative text-extra-dark-gray top-2 margin-5px-right" aria-hidden="true"></i> '.esc_html__( 'Prev', 'pofo-addons' ).'</div>';
                    }
                    
                $output .= '</div>';

            break;

        case 'portfolio-slider-style-3':
                
                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'h3';

                //Custom css start
                $pofo_portfolio_slider_style3 = ! empty( $pofo_portfolio_slider_style3 ) ? $pofo_portfolio_slider_style3 : 0;
                $pofo_portfolio_slider_style3 = $pofo_portfolio_slider_style3 + 1;

                if( ! empty( $pofo_scroll_progress_line_color ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style3-'.$pofo_portfolio_slider_style3.' .swiper-scrollbar { '.$pofo_scroll_progress_line_color.' }';   
                }
                if( ! empty( $pofo_scroll_progress_point_color ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style3-'.$pofo_portfolio_slider_style3.' .swiper-scrollbar-drag { '.$pofo_scroll_progress_point_color.' }';   
                }

                //Custom css for slider height
                if( ! empty( $pofo_lg_min_height ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style3-'.$pofo_portfolio_slider_style3.' { min-height: '.$pofo_lg_min_height.' !important; }';
                }
                if( ! empty( $pofo_md_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 1199px) { .portfolio-slider-style3-'.$pofo_portfolio_slider_style3.' { min-height: '.$pofo_md_min_height.' !important; } }';
                }
                if( ! empty( $pofo_sm_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 991px) { .portfolio-slider-style3-'.$pofo_portfolio_slider_style3.' { min-height: '.$pofo_sm_min_height.' !important; } }';
                }
                
                $output .= '<div class="full-screen position-relative portfolio-slider-style3-'.$pofo_portfolio_slider_style3.'">';
                    $output .= '<div id="'.$pofo_slider_id.'" class="swiper-bottom-scrollbar-full swiper-container '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                    <div class="swiper-wrapper">';

                        if( ! empty( $content ) ) {
                            $output .= '<div class="swiper-slide width-550px xs-width-100 xs-height-auto">';
                                $output .= '<div class="position-relative width-90 height-100 display-table padding-ten-all xs-padding-fifteen-all xs-width-100">';
                                    $output .= '<div class="display-table-cell vertical-align-middle">';
                                        $output .= do_shortcode( pofo_remove_wpautop( $content ) );
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        }

                        while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();

                            /* Image Alt, Title, Caption */
                            $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                            $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                            $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                            $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                            $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                            
                            $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, $pofo_image_srcset ) : '';
                            $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                            $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                            $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                            $srcset = $srcset_data = $sizes_data = '';
                            $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, $pofo_image_srcset ) : '';
                            if( $srcset ){
                                $srcset_data = ' srcset="'.esc_attr( $srcset ).'"';
                            }

                            $sizes = ! empty( $thumbnail_id ) ? wp_get_attachment_image_sizes( $thumbnail_id, $pofo_image_srcset ) : '';
                            if( $sizes ){
                                $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                            }

                            $cat_slug = '';
                            $cat_name = array();
                            $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                            if( ! empty( $cat ) && !is_wp_error( $cat ) ) {
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                    $cat_name[] = $c->name;
                                }
                            }

                            $pofo_portfolio_post_type       = pofo_post_meta( 'pofo_portfolio_post_type' );
                            $pofo_portfolio_external_link   = pofo_post_meta( 'pofo_portfolio_external_link' );
                            $pofo_portfolio_link_target     = pofo_post_meta( 'pofo_portfolio_link_target' );
                            $pofo_portfolio_external_link   = ( ! empty( $pofo_portfolio_external_link ) && $pofo_portfolio_post_type == 'link' ) ? $pofo_portfolio_external_link : get_permalink() ;
                            $pofo_portfolio_link_target     = ! empty( $pofo_portfolio_link_target ) ? ' target="'. $pofo_portfolio_link_target .'"' : ' target="_self"';

                            $pofo_portfolio_classes = '';
                            ob_start();
                                post_class('pofo-rich-snippet display-none');
                                $pofo_portfolio_classes .= ob_get_contents();
                            ob_end_clean();

                            $output .= '<div class="swiper-slide width-auto xs-height-auto">';
                                $output .= '<div '.$pofo_portfolio_classes.'>';
                                    $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                    $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                    $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                                $output .= '</div>';
                                $output .= '<div class="height-100 display-table">';
                                    $output .= '<div class="display-table-cell vertical-align-middle">';
                                        if( $pofo_enable_link == 1 && $pofo_link_on == 'box' ) {
                                            $output .= '<a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.'>';
                                        }
                                            $output .= '<div class="display-block position-relative">';
                                                if( ! empty( $image_url ) ) {
                                                    $output .= '<img src="'.$image_url.'" width="'.$image_width.'" height="'.$image_height.'"'.$image_alt.$image_title.$srcset_data.$sizes_data.'>';
                                                }
                                                if($pofo_show_category == 1 && ! empty( $cat_name )):
                                                    $output .='<p class="bottom-text width-100 no-margin text-extra-small text-white text-uppercase text-center'.esc_attr( $pofo_subtitle_dynamic_font_size ).'"'.$pofo_subtitle_style_attr.'>'.implode(' and ', $cat_name).'</p>';
                                                endif;
                                            $output .= '</div>';
                                            if($pofo_show_separator == 1 || $pofo_show_title == 1):
                                                $output .= '<div class="hover-title-box padding-55px-lr width-300px sm-width-100 sm-padding-20px-lr">';
                                                    if($pofo_show_separator == 1):
                                                        $output .= '<div class="separator width-50px bg-white md-display-none xs-margin-lr-auto"'.$separator_style.'></div>';
                                                    endif;  
                                                    if($pofo_show_title == 1):
                                                        $output .= '<'.$pofo_title_element_tag.'>';
                                                            if( $pofo_enable_link == 1 && empty( $pofo_link_on ) ) {
                                                                $output .= '<a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.'>';
                                                            }
                                                                $output .= '<span class="text-white font-weight-600 alt-font text-white-hover'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>' . get_the_title() . '</span>';

                                                            if( $pofo_enable_link == 1 && empty( $pofo_link_on ) )  {
                                                                $output .= '</a>';
                                                            }
                                                        $output .= '</'.$pofo_title_element_tag.'>';
                                                    endif;
                                                $output .= '</div>';
                                            endif;
                                        if( $pofo_enable_link == 1 && $pofo_link_on == 'box' ) {
                                            $output .= '</a>';
                                        }
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';

                        endwhile;
                        wp_reset_postdata();

                            $output .= '<div class="swiper-slide width-150px xs-width-100 xs-height-auto"></div>';

                    $output .= '</div><!-- .swiper-wrapper -->';
                    
                    if( $show_scroll_navigation == 1 ) {

                        $output .= '<div class="swiper-scrollbar xs-display-none"></div>';

                        $output .= '<div class="swiper-next-style2 text-small scroll-navigation alt-font xs-display-none swiper-next-' . $navigation_unique_id . '">'.esc_html__( 'Next', 'pofo-addons' ).' <i class="fas fa-long-arrow-alt-right icon-very-small position-relative text-extra-dark-gray top-2 margin-5px-left" aria-hidden="true"></i></div>
                            <div class="swiper-prev-style2 text-small scroll-navigation alt-font xs-display-none swiper-prev-' . $navigation_unique_id . '"><i class="fas fa-long-arrow-alt-left icon-very-small position-relative text-extra-dark-gray top-2 margin-5px-right" aria-hidden="true"></i> '.esc_html__( 'Prev', 'pofo-addons' ).'</div>';
                    }
                     
                $output .= '</div>';

            break;

        case 'portfolio-slider-style-4':

                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'h4';

                //Custom css start
                $pofo_portfolio_slider_style4 = ! empty( $pofo_portfolio_slider_style4 ) ? $pofo_portfolio_slider_style4 : 0;
                $pofo_portfolio_slider_style4 = $pofo_portfolio_slider_style4 + 1;
                
                if( ! empty( $pofo_subtitle_color ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style4-'.$pofo_portfolio_slider_style4.' .subtitle-link { '.$pofo_subtitle_color.' }';
                }
                if( ! empty( $pofo_subtitle_hover_color ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style4-'.$pofo_portfolio_slider_style4.' a.subtitle-link:hover, .portfolio-slider-style4-'.$pofo_portfolio_slider_style4.' a.subtitle-link:focus { '.$pofo_subtitle_hover_color.' }';
                }

                //Custom css for slider height
                if( ! empty( $pofo_lg_min_height ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style4-'.$pofo_portfolio_slider_style4.' { min-height: '.$pofo_lg_min_height.' !important; }';
                }
                if( ! empty( $pofo_md_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 1199px) { .portfolio-slider-style4-'.$pofo_portfolio_slider_style4.' { min-height: '.$pofo_md_min_height.' !important; } }';
                }
                if( ! empty( $pofo_sm_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 991px) { .portfolio-slider-style4-'.$pofo_portfolio_slider_style4.' { min-height: '.$pofo_sm_min_height.' !important; } }';
                }
                if( ! empty( $pofo_xs_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 767px) { .portfolio-slider-style4-'.$pofo_portfolio_slider_style4.' { min-height: '.$pofo_xs_min_height.' !important; } }';
                }
                //Custom css end
                
                // Image Alt, Title, Caption
                $pofo_link_img_alt      = ! empty( $pofo_link_image ) ? pofo_option_image_alt($pofo_link_image) : '';
                $pofo_link_img_title    = ! empty( $pofo_link_image ) ? pofo_option_image_title($pofo_link_image) : '';
                $pofo_link_image_alt    = ! empty( $pofo_link_img_alt['alt'] ) ? ' alt="'.$pofo_link_img_alt['alt'].'"' : ' alt=""' ;
                $pofo_link_image_title  = ! empty( $pofo_link_img_title['title'] ) ? ' title="'.$pofo_link_img_title['title'].'"' : '';

                $pofo_link_image_url    = ! empty( $pofo_link_image ) ? wp_get_attachment_url( $pofo_link_image ) : POFO_ADDONS_ROOT_DIR . '/pofo-shortcodes/images/arrow-right.jpg';

                $output .= '<div class="full-screen position-relative portfolio-slider-style4-'.$pofo_portfolio_slider_style4.'">';
                    $output .= '<div id="'.$pofo_slider_id.'" class="swiper-vertical-pagination swiper-container-vertical swiper-container '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                    <div class="swiper-wrapper">';

                        while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();

                            /* Image Alt, Title, Caption */
                            $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                            $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                            $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                            $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                            $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                            
                            $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, $pofo_image_srcset ) : '';
                            $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                            $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                            $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                            $srcset = $srcset_data = $sizes_data = $srcset_classes = '';
                            $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, $pofo_image_srcset ) : '';
                            if( $srcset ){
                                $srcset_data = ' data-bg-srcset="'.esc_attr( $srcset ).'"';
                                $srcset_classes = ' bg-image-srcset';
                            }

                            $sizes = ! empty( $thumbnail_id ) ? wp_get_attachment_image_sizes( $thumbnail_id, $pofo_image_srcset ) : '';
                            if( $sizes ){
                                $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                            }

                            $cat_slug = '';
                            $cat_name = array();
                            $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                            if( ! empty( $cat ) && !is_wp_error( $cat ) ) {
                                foreach ($cat as $key => $c) {
                                    $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                    $cat_name[] = '<a href="'.get_term_link( $c ).'" class="subtitle-link text-white-hover text-extra-dark-gray">' . $c->name . '</a>';
                                }
                            }

                            if( ! empty( $image_url ) ){
                                $img_style = ' style="background-image:url('.$image_url.');"';
                            } else {
                                $img_style = '';
                            }

                            $pofo_portfolio_post_type       = pofo_post_meta( 'pofo_portfolio_post_type' );
                            $pofo_portfolio_external_link   = pofo_post_meta( 'pofo_portfolio_external_link' );
                            $pofo_portfolio_link_target     = pofo_post_meta( 'pofo_portfolio_link_target' );
                            $pofo_portfolio_external_link   = ( ! empty( $pofo_portfolio_external_link ) && $pofo_portfolio_post_type == 'link' ) ? $pofo_portfolio_external_link : get_permalink() ;
                            $pofo_portfolio_link_target     = ! empty( $pofo_portfolio_link_target ) ? ' target="'. $pofo_portfolio_link_target .'"' : ' target="_self"';

                            $pofo_portfolio_classes = '';
                            ob_start();
                                post_class('pofo-rich-snippet display-none');
                                $pofo_portfolio_classes .= ob_get_contents();
                            ob_end_clean();

                            $output .= '<div class="swiper-slide cover-background'.$srcset_classes.'"'.$img_style.$srcset_data.'>';
                                $output .= '<div '.$pofo_portfolio_classes.'>';
                                    $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                    
                                    $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                    $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                                $output .= '</div>';
                                $output .= '<div class="height-100 width-100 position-relative test-full-screen">';
                                    $output .= '<div class="slider-typography text-left">';
                                        $output .= '<div class="slider-text-middle-main">';
                                            $output .= '<div class="slider-text-bottom padding-100px-lr xs-padding-30px-lr">';
                                                $output .= '<div class="swiper-bottom-content bg-deep-pink width-500px padding-80px-all margin-50px-left sm-no-margin-left xs-padding-20px-all xs-width-90"'.$pofo_content_bg_color.'>';
                                                    if($pofo_show_title == 1):
                                                        $output .= '<'.$pofo_title_element_tag.' class="xs-margin-5px-bottom"><a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.' class="font-weight-600 text-white alt-font text-white-hover'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.get_the_title().'</a></'.$pofo_title_element_tag.'>';
                                                    endif;
                                                    if($pofo_show_category == 1 && ! empty( $cat_name )):
                                                        $output .= '<ul class="list-unstyled font-weight-600 alt-font text-uppercase text-small'.esc_attr( $pofo_subtitle_dynamic_font_size ).'"'.$pofo_subtitle_style_attr.'><li class="display-inline-block">'.implode(', ', $cat_name).'</li></ul>';
                                                    endif;
                                                    $output .= '<div class="box-arrow">
                                                                    <a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.'><img src="'. esc_url( $pofo_link_image_url ) .'"'.$image_alt.$image_title.'></a>
                                                                </div>';
                                                $output .= '</div>';
                                            $output .= '</div>';
                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';

                        endwhile;
                        wp_reset_postdata();

                    $output .= '</div>';

                    if( $show_pagination == 1 ) {
                        
                        $pagination_style_class = $show_pagination_style == 1 ? ' swiper-pagination-square' : '';
                        $output .= '<div class="swiper-pagination '.$class_name.$pagination_style_class.$show_pagination_color_style.'"></div>';
                        
                    }
                $output .= '</div>';
            break;

        case 'portfolio-slider-style-5':

                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'h6';

                //Custom css start
                $pofo_portfolio_slider_style5 = ! empty( $pofo_portfolio_slider_style5 ) ? $pofo_portfolio_slider_style5 : 0;
                $pofo_portfolio_slider_style5 = $pofo_portfolio_slider_style5 + 1;
                
                //Custom css for slider height
                if( ! empty( $pofo_lg_min_height ) ) {
                    $pofo_featured_array[] = '.portfolio-slider-style5-'.$pofo_portfolio_slider_style5.' .full-screen { min-height: '.$pofo_lg_min_height.' !important; }';
                }
                if( ! empty( $pofo_md_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 1199px) { .portfolio-slider-style5-'.$pofo_portfolio_slider_style5.' .full-screen { min-height: '.$pofo_md_min_height.' !important; } }';
                }
                if( ! empty( $pofo_sm_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 991px) { .portfolio-slider-style5-'.$pofo_portfolio_slider_style5.' .full-screen { min-height: '.$pofo_sm_min_height.' !important; } }';
                }
                if( ! empty( $pofo_xs_min_height ) ) {
                    $pofo_featured_array[] = '@media (max-width: 767px) { .portfolio-slider-style5-'.$pofo_portfolio_slider_style5.' .full-screen { min-height: '.$pofo_xs_min_height.' !important; } }';
                }
                //Custom css end
                
                $output .= '<div id="'.$pofo_slider_id.'" class="swiper-container height-100 width-100 hover-option3 portfolio-slider-style5-'.$pofo_portfolio_slider_style5.' '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                <div class="swiper-wrapper">';

                    while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();

                        /* Image Alt, Title, Caption */
                        $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                        $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                        $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                        $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                        $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                        
                        $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, $pofo_image_srcset ) : '';
                        $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                        $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                        $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                        $srcset = $srcset_data = $sizes_data = $srcset_classes = '';
                        $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, $pofo_image_srcset ) : '';
                        if( $srcset ){
                            $srcset_data = ' data-bg-srcset="'.esc_attr( $srcset ).'"';
                            $srcset_classes = ' bg-image-srcset';
                        }

                        $sizes = ! empty( $thumbnail_id ) ? wp_get_attachment_image_sizes( $thumbnail_id, $pofo_image_srcset ) : '';
                        if( $sizes ){
                            $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                        }

                        $cat_slug = '';
                        $cat_name = array();
                        $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
                        if( ! empty( $cat ) && !is_wp_error( $cat ) ) {
                            foreach ($cat as $key => $c) {
                                $cat_slug .= 'portfolio-filter-'.$c->term_id." ";
                                $cat_name[] = '<li class="display-inline-block"><a href="'.get_term_link( $c ).'" class="text-white-hover text-extra-dark-gray">' . $c->name . '</a></li>';
                            }
                        }

                        if( ! empty( $image_url ) ){
                            $img_style = ' style="background-image:url('.$image_url.');"';
                        } else {
                            $img_style = '';
                        }

                        $pofo_portfolio_post_type       = pofo_post_meta( 'pofo_portfolio_post_type' );
                        $pofo_portfolio_external_link   = pofo_post_meta( 'pofo_portfolio_external_link' );
                        $pofo_portfolio_link_target     = pofo_post_meta( 'pofo_portfolio_link_target' );
                        $pofo_portfolio_external_link   = ( ! empty( $pofo_portfolio_external_link ) && $pofo_portfolio_post_type == 'link' ) ? $pofo_portfolio_external_link : get_permalink() ;
                        $pofo_portfolio_link_target     = ! empty( $pofo_portfolio_link_target ) ? ' target="'. $pofo_portfolio_link_target .'"' : ' target="_self"';

                        $pofo_portfolio_classes = '';
                        ob_start();
                            post_class('pofo-rich-snippet display-none');
                            $pofo_portfolio_classes .= ob_get_contents();
                        ob_end_clean();

                        $output .= '<div class="swiper-slide cover-background full-screen grid-item text-left'.$srcset_classes.'"'.$img_style.$srcset_data.'>';
                            $output .= '<div '.$pofo_portfolio_classes.'>';
                                $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                
                                $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                            $output .= '</div>';
                            if( $pofo_enable_link == 1 && $pofo_link_on == 'box' ) {
                                $output .= '<a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.'>';
                            }
                                $output .= '<div class="slide-hover-box">';
                                    $output .= '<div class="opacity-medium bg-black"></div>';
                                    $output .= '<figure class="position-absolute">';
                                        $output .= '<figcaption>';
                                            if( $pofo_show_title == 1 ) {
                                                if( $pofo_enable_link == 1 && empty( $pofo_link_on ) ) {
                                                    $output .= '<a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.'>';
                                                }
                                                    $output .= '<'.$pofo_title_element_tag.' class="font-weight-300 text-white margin-20px-bottom'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.get_the_title().'</'.$pofo_title_element_tag.'>';
                                                if( $pofo_enable_link == 1 && empty( $pofo_link_on ) ) {
                                                    $output .= '</a>';
                                                }
                                            }
                                            if( $pofo_show_excerpt == 1 ) {
                                                $show_excerpt = ! empty( $pofo_excerpt_length ) ? pofo_get_the_excerpt_theme( $pofo_excerpt_length ) : pofo_get_the_excerpt_theme( 15 );
                                                $output .= '<p class="text-white width-85 sm-width-100 no-margin-bottom">'.$show_excerpt.'</p>';
                                            } elseif( $pofo_show_content == 1 ) {
                                                $output .='<div class="text-white width-85 sm-width-100 no-margin-bottom">'.pofo_get_the_post_content().'</div>';
                                            }
                                            if($pofo_show_separator == 1):
                                                $output .= '<div class="separator-line-horrizontal-medium-light2 opacity5 bg-white margin-35px-top sm-margin-25px-top"'.$separator_style.'></div>';
                                            endif;
                                        $output .= '</figcaption>';
                                    $output .= '</figure>';
                                $output .= '</div>';
                            if( $pofo_enable_link == 1 && $pofo_link_on == 'box' ) {
                                $output .= '</a>';
                            }
                        $output .= '</div>';

                    endwhile;
                    wp_reset_postdata();

                $output .= '</div>';
                
            break;

        case 'portfolio-slider-style-6':

                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'span';

                $output .= '<div id="'.$pofo_slider_id.'" class="swiper-multy-row-container overflow-hidden hover-option4 margin-5px-bottom '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                <div class="swiper-wrapper">';

                    while ( $portfolio_posts->have_posts() ) : $portfolio_posts->the_post();

                        /* Image Alt, Title, Caption */
                        $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                        $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                        $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                        $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                        $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                        
                        $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, $pofo_image_srcset ) : '';
                        $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                        $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                        $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                        $srcset = $srcset_data = $sizes_data = '';
                        $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, $pofo_image_srcset ) : '';
                        if( $srcset ){
                            $srcset_data = ' srcset="'.esc_attr( $srcset ).'"';
                        }

                        $sizes = ! empty( $thumbnail_id ) ? wp_get_attachment_image_sizes( $thumbnail_id, $pofo_image_srcset ) : '';
                        if( $sizes ){
                            $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                        }

                        $cat_name = pofo_post_meta( 'pofo_subtitle' );

                        $pofo_portfolio_post_type       = pofo_post_meta( 'pofo_portfolio_post_type' );
                        $pofo_portfolio_external_link   = pofo_post_meta( 'pofo_portfolio_external_link' );
                        $pofo_portfolio_link_target     = pofo_post_meta( 'pofo_portfolio_link_target' );
                        $pofo_portfolio_external_link   = ( ! empty( $pofo_portfolio_external_link ) && $pofo_portfolio_post_type == 'link' ) ? $pofo_portfolio_external_link : get_permalink() ;
                        $pofo_portfolio_link_target     = ! empty( $pofo_portfolio_link_target ) ? ' target="'. $pofo_portfolio_link_target .'"' : ' target="_self"';

                        $pofo_portfolio_classes = '';
                        ob_start();
                            post_class('pofo-rich-snippet display-none');
                            $pofo_portfolio_classes .= ob_get_contents();
                        ob_end_clean();

                        $output .= '<div class="swiper-slide grid-item">';
                            $output .= '<div '.$pofo_portfolio_classes.'>';
                                $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                
                                $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                            $output .= '</div>';
                            $output .= '<a href="'.esc_url( $pofo_portfolio_external_link ).'"'.$pofo_portfolio_link_target.'>';
                                $output .= '<figure>';
                                    if( ! empty( $image_url ) ){
                                        $output .= '<div class="portfolio-img bg-extra-dark-gray text-center"'.$pofo_content_bg_color.'>';
                                            $output .= '<img src="'.esc_url( $image_url ).'" width="'.$image_width.'" height="'.$image_height.'"'.$image_alt.$image_title.$srcset_data.$sizes_data.'>';
                                        $output .= '</div>';
                                    }
                                    $output .= '<figcaption>';
                                        $output .= '<div class="portfolio-hover-main text-center">';
                                            $output .= '<div class="portfolio-hover-box vertical-align-middle">';
                                                $output .= '<div class="portfolio-hover-content position-relative">';
                                                    if($pofo_show_title == 1):
                                                        $output .= '<'.$pofo_title_element_tag.' class="font-weight-600 line-height-normal alt-font text-white text-uppercase margin-5px-bottom display-block'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.get_the_title().'</'.$pofo_title_element_tag.'>';
                                                    endif;
                                                    if($pofo_show_category == 1 && ! empty( $cat_name )):
                                                        $output .='<p class="text-medium-gray text-uppercase text-extra-small last-paragraph-no-margin'.esc_attr( $pofo_subtitle_dynamic_font_size ).'"'.$pofo_subtitle_style_attr.'>'.esc_attr( $cat_name ).'</p>';
                                                    endif;
                                                $output .= '</div>';
                                            $output .= '</div>';
                                        $output .= '</div>';
                                    $output .= '</figcaption>';
                                $output .= '</figure>';
                            $output .= '</a>';
                        $output .= '</div>';

                    endwhile;
                    wp_reset_postdata();

                    $output .= '    </div>';

                    if( $show_navigation == 1 ) {
                    
                        if( $show_navigation_style == 1 ) {
                            $navigation_style_class = ' swiper-button-black-highlight';
                        } else if( $show_navigation_style == 2 ) {
                            $navigation_style_class = ' swiper-button-white-highlight';
                        } else {
                            $navigation_style_class = ' slider-long-arrow-white';
                        }

                        $output .= '<div class="swiper-portfolio-next swiper-next-' . $navigation_unique_id . $navigation_style_class . '"><i class="ti-arrow-right"></i></div>
                                    <div class="swiper-portfolio-prev swiper-prev-' . $navigation_unique_id . $navigation_style_class . '"><i class="ti-arrow-left"></i></div>';
                    }
                
            break;
    }

    if( $show_navigation == 1 && ( $pofo_slider_style == 'portfolio-slider-style-1' ) ) {
    
        if( $show_navigation_style == 1 ) {
            $navigation_style_class = ' swiper-button-black-highlight';
        } else if( $show_navigation_style == 2 ) {
            $navigation_style_class = ' swiper-button-white-highlight';
        } else {
            $navigation_style_class = ' slider-long-arrow-white';
        }

        $output .= '<div class="swiper-button-next swiper-next-' . $navigation_unique_id . $navigation_style_class . '"></div>
                    <div class="swiper-button-prev swiper-prev-' . $navigation_unique_id . $navigation_style_class . '"></div>';
    }
    if( $show_pagination == 1 && ( $pofo_slider_style == 'portfolio-slider-style-1' || $pofo_slider_style == 'portfolio-slider-style-5' ) ) {
        
        $pagination_style_class = $show_pagination_style == 1 ? ' swiper-pagination-square' : '';
        $output .= '<div class="swiper-pagination '.$class_name.$pagination_style_class.$show_pagination_color_style.'"></div>';

    }

    $output .= '</div><!-- .swiper-container -->';

    /* Add custom script End*/
    return $output;
}
add_shortcode( 'pofo_portfolio_slider', 'pofo_portfolio_slider_shortcode' );