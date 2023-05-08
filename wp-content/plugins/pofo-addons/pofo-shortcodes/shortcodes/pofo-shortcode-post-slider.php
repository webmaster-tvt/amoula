<?php
/**
 * Shortcode For post Slider
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
function pofo_post_slider_shortcode( $atts, $content = null ) {
    
    global $pofo_slider_parent_type, $pofo_slider_unique_id, $pofo_slider_script, $pofo_featured_array, $pofo_postslider1, $pofo_postslider2, $pofo_postslider3;

    extract( shortcode_atts( array(
                'pofo_slider_style' => '',
                'show_pagination' => '',
                'show_pagination_style' => '',
                'show_pagination_color_style' => '1',
                'show_cursor_color_style' => '',
                'autoloop' => '1',
                'autoplay' => '',
                'slidedelay' => '3000',
                'slidespeed' => '',
                'pofo_post_per_page' => '5',
                'pofo_orderby' => '',
                'pofo_order' => '',
                'pofo_post_type' => 'post',

                'pofo_categories_list' => '',
                'pofo_show_title' => '1',
                'pofo_show_category' => '1',
                'pofo_show_button' => '1',
                'pofo_button_text' => '',
                
                'pofo_category_text_transform' => 'text-uppercase',
                'pofo_box_bg_color' => '',
                'pofo_button_color' => '',
                'pofo_button_hover_color' => '',
                'pofo_button_text_color' => '',
                'pofo_button_hover_text_color' => '',
                'pofo_button_border_color' => '',
                'pofo_button_border_hover_color' => '',
                
                'pofo_title_font_size' => '',
                'pofo_title_line_height' => '',
                'pofo_title_letter_spacing' => '',
                'pofo_title_font_weight' => '',
                'pofo_title_italic' => '',
                'pofo_title_underline' => '',
                'pofo_title_element_tag' => '',
                'pofo_title_color' => '',
                'pofo_title_hover_color' => '',
                'pofo_title_enable_responsive_font' => '',
                'pofo_title_responsive_settings' => '',
                
                'pofo_category_font_size' => '',
                'pofo_category_line_height' => '',
                'pofo_category_letter_spacing' => '',
                'pofo_category_font_weight' => '',
                'pofo_category_italic' => '',
                'pofo_category_underline' => '',
                'pofo_category_color' => '',
                'pofo_category_hover_color' => '',
                'pofo_category_bg_color' => '',
                'pofo_category_enable_responsive_font' => '',
                'pofo_category_responsive_settings' => '',

                'show_overlay' => '1',
                'pofo_overlay_opacity' => '0.7',
                'pofo_row_overlay_color' => '',
                'pofo_z_index' => '',

                'pofo_slider_id' => '',
                'pofo_slider_class' => '',
            ), $atts ) );

    $output = $slider_class = $pofo_title_style_attr = $pofo_category_style_attr = $overlay_style = '';
    $pofo_title_style_array = $pofo_category_style_array = array();
    
    $pofo_slider_class      = ( $pofo_slider_class ) ? ' '.$pofo_slider_class . ' ' . $pofo_slider_style : ' '.$pofo_slider_style;
    $pofo_slider_style      = ( $pofo_slider_style ) ? $pofo_slider_style : '';
    $show_pagination_color_style= ( $show_pagination_color_style ) ? ' swiper-pagination-white' : ' swiper-pagination-black';

   
    // Check if slider id and class
    $pofo_slider_unique_id  = ! empty( $pofo_slider_unique_id ) ? $pofo_slider_unique_id : 1;
    $navigation_unique_id   = $pofo_slider_unique_id;
    $pofo_slider_id         = ( $pofo_slider_id ) ? $pofo_slider_id : 'post-slider';
    $pofo_slider_id         .= '-' . $pofo_slider_unique_id;
    $pofo_slider_unique_id++;

    $pofo_post_per_page     = ($pofo_post_per_page) ? $pofo_post_per_page : '5';
    $pofo_orderby           = ($pofo_orderby) ? $pofo_orderby : 'date';
    $pofo_order             = ($pofo_order) ? $pofo_order : 'ASC';

    $pofo_show_title    = ( $pofo_show_title ) ? $pofo_show_title : '';
    $pofo_show_button   = ( $pofo_show_button ) ? $pofo_show_button : '';
    $pofo_show_category = ( $pofo_show_category ) ? $pofo_show_category : '';
    $button_text        = ! empty( $pofo_button_text ) ? $pofo_button_text : esc_html__( 'Continue Reading', 'pofo-addons' );

    //For Button Style
    $pofo_button_color              = ($pofo_button_color) ? ' background-color: '.$pofo_button_color.' !important; ' : '';
    $pofo_button_hover_color        = ($pofo_button_hover_color) ? ' background-color: '.$pofo_button_hover_color.' !important; ' : '';
    $pofo_button_text_color         = ($pofo_button_text_color) ? ' color: '.$pofo_button_text_color.' !important; ' : '';
    $pofo_button_hover_text_color   = ($pofo_button_hover_text_color) ? ' color: '.$pofo_button_hover_text_color.' !important; ' : '';
    $pofo_button_border_color       = ($pofo_button_border_color) ? ' border-color: '.$pofo_button_border_color.' !important; ' : '';
    $pofo_button_border_hover_color = ($pofo_button_border_hover_color) ? ' border-color: '.$pofo_button_border_hover_color.' !important; ' : '';

    // For Title Style
    ! empty( $pofo_title_font_size ) ? $pofo_title_style_array[] = 'font-size: ' . $pofo_title_font_size . ';' : '';
    ! empty( $pofo_title_line_height ) ? $pofo_title_style_array[] = 'line-height: ' . $pofo_title_line_height . ';' : '';
    ! empty( $pofo_title_letter_spacing ) ? $pofo_title_style_array[] = 'letter-spacing: ' . $pofo_title_letter_spacing . ';' : '';
    ! empty( $pofo_title_font_weight ) ? $pofo_title_style_array[] = 'font-weight: ' . $pofo_title_font_weight . ';' : '';
    ( $pofo_title_italic == 1 ) ? $pofo_title_style_array[] = 'font-style: italic;' : '';
    ( $pofo_title_underline == 1 ) ? $pofo_title_style_array[] = 'text-decoration: underline;' : '';
    $pofo_title_color = ! empty( $pofo_title_color ) ? 'color: '.$pofo_title_color.';' : '';
    $pofo_title_hover_color = ! empty( $pofo_title_hover_color ) ? 'color: '.$pofo_title_hover_color.';' : '';

    $pofo_title_dynamic_font_size = $pofo_title_enable_responsive_font == 1 ? ' dynamic-font-size' : '';
    $pofo_title_dynamic_font_size .= ! empty( $pofo_title_responsive_settings ) ? pofo_shortcode_custom_css_class( $pofo_title_responsive_settings ) : '';
    $pofo_title_style_attr   = pofo_get_style_attribute( $pofo_title_style_array, $pofo_title_font_size, $pofo_title_line_height );

    // For Category Style
    ! empty( $pofo_category_font_size ) ? $pofo_category_style_array[] = 'font-size: ' . $pofo_category_font_size . ';' : '';
    ! empty( $pofo_category_line_height ) ? $pofo_category_style_array[] = 'line-height: ' . $pofo_category_line_height . ';' : '';
    ! empty( $pofo_category_letter_spacing ) ? $pofo_category_style_array[] = 'letter-spacing: ' . $pofo_category_letter_spacing . ';' : '';
    ! empty( $pofo_category_font_weight ) ? $pofo_category_style_array[] = 'font-weight: ' . $pofo_category_font_weight . ';' : '';
    ( $pofo_category_italic == 1 ) ? $pofo_category_style_array[] = 'font-style: italic;' : '';
    ( $pofo_category_underline == 1 ) ? $pofo_category_style_array[] = 'text-decoration: underline;' : '';
    ! empty( $pofo_category_bg_color ) ? $pofo_category_style_array[] = 'background-color: '.$pofo_category_bg_color.';' : '';

    $pofo_category_color = ! empty( $pofo_category_color ) ? 'color: '.$pofo_category_color.';' : '';
    $pofo_category_hover_color = ! empty( $pofo_category_hover_color ) ? 'color: '.$pofo_category_hover_color.';' : '';

    $pofo_category_dynamic_font_size = $pofo_category_enable_responsive_font == 1 ? ' dynamic-font-size' : '';
    $pofo_category_style_attr   = pofo_get_style_attribute( $pofo_category_style_array, $pofo_category_font_size, $pofo_category_line_height );

    $pofo_category_text_transform = ! empty( $pofo_category_text_transform ) ? ' ' . $pofo_category_text_transform : '';
    $pofo_category_dynamic_font_size .= ! empty( $pofo_category_responsive_settings ) ? pofo_shortcode_custom_css_class( $pofo_category_responsive_settings ) : '';

    // For Box Background Color
    $pofo_box_bg_color= ! empty( $pofo_box_bg_color ) ? ' style="background-color: '.$pofo_box_bg_color.';"' : '';

    $show_cursor_color_style    = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' white-move';

    // Overlay Style
    $pofo_overlay_opacity = ! empty($pofo_overlay_opacity) ? 'opacity:'.$pofo_overlay_opacity.'; ' : 'opacity:0;';
    $pofo_row_overlay_color_att = ($pofo_row_overlay_color) ? 'background-color:'.$pofo_row_overlay_color.'; ' : '';
    $pofo_z_index = ( $pofo_z_index || $pofo_z_index == '0') ? 'z-index:'.$pofo_z_index.'; ' : '';

    if( $pofo_overlay_opacity || $pofo_row_overlay_color_att || $pofo_z_index ){
        $overlay_style = ' style="'.$pofo_overlay_opacity.$pofo_row_overlay_color_att.$pofo_z_index.'"';
    }


    /* Add custom script Start*/
    $slidedelay = ( $slidedelay ) ? $slidedelay : '3000';
    $slidespeed = ( $slidespeed ) ? $slidespeed : '';

    $swiper_config['keyboard'] = true;

    if( $autoloop == 1 ) {
        $swiper_config['loop'] = true;
    }
    if( $autoplay == 1 ) {
        $swiper_config['autoplay'] = array( 'delay' => intval( $slidedelay ) );
    } else { 
        $swiper_config['autoplay'] = false;
    }
    if( $slidespeed ) {
        $swiper_config['speed'] = $slidespeed;
    }

    if( $pofo_slider_style == 'post-slider-style-2' ){
        $swiper_config ['slidesPerView'] = 'auto';
        $swiper_config ['centeredSlides'] = true;
        $swiper_config ['spaceBetween'] = 15;
        $swiper_config ['snapOnRelease'] = true;
        $swiper_config ['disableOnInteraction'] = true;
        $swiper_config ['preventClicks'] = false;
        $swiper_config ['loopedSlides'] =  3;
    }else{
        $swiper_config ['preventClicks'] = false;
        $swiper_config ['slidesPerView'] =  1;
    }

    $swiper_config['navigation'] = array( 'nextEl' => '.swiper-next-'. $navigation_unique_id, 'prevEl' => '.swiper-prev-'. $navigation_unique_id );

    if( $show_pagination == 1 ) {
        $class_name = 'swiper-pagination-' . $navigation_unique_id;
        $swiper_config['pagination'] = array( 'el' => '.' . $class_name, 'type' => 'bullets', 'clickable' => true );
    }

    $slider_options = ! empty( $swiper_config ) ? json_encode( $swiper_config ) : '';


    $args = array(
        'posts_per_page' => $pofo_post_per_page,
                'orderby' => $pofo_orderby,
                'order' => $pofo_order,
            );
        if ( $pofo_post_type == 'post' && isset( $atts['pofo_categories_taxonmoy_' . $pofo_post_type] ) && $atts['pofo_categories_taxonmoy_' . $pofo_post_type] == 'category') {
            $args['post_type'] = 'post';
            $args['category_name'] = $pofo_categories_list;
        } else {
            $args['post_type'] = $pofo_post_type;
           
            if( ! empty( $pofo_post_type ) ) {
                $custom_taxonomy = $selected_category = $pofo_custom_taxonomies = '';
                $custom_taxonomies = get_object_taxonomies( $pofo_post_type );
                $pofo_custom_taxonomies = isset( $atts['pofo_categories_taxonmoy_' . $pofo_post_type] ) ? $atts['pofo_categories_taxonmoy_' . $pofo_post_type] : '' ;
                $pofo_selected_category = isset( $atts['pofo_taxonomies_list_' . $pofo_custom_taxonomies] ) ? $atts['pofo_taxonomies_list_' . $pofo_custom_taxonomies] : 0 ;
                if( ! empty( $custom_taxonomies ) && ! is_wp_error( $custom_taxonomies ) ) {
                    if ( $pofo_selected_category == 0 ) {
                        $selected_category = array(); 
                        foreach ( $custom_taxonomies as $key => $custom_taxonomy ) {
                                if($custom_taxonomy != 'category' ){
                                $category_param = 'pofo_taxonomies_list_'.$custom_taxonomy;
                                if( ! empty( $atts[$category_param] ) ) {
                                    $selected_category = $atts[$category_param];
                                    if( ! empty( $selected_category ) ) {
                                      $selected_category = explode( ',', $selected_category );  
                                    } 
                                    $args['tax_query'] = array(
                                                            array(
                                                                'taxonomy' => $custom_taxonomy,
                                                                'field' => 'slug',
                                                                'terms' => $selected_category,
                                                            ),
                                                        );
                                }
                            }
                        }
                    } else {

                        if( $pofo_selected_category == 0 ) {
                            $pofo_category = get_terms( array( 'taxonomy' => $pofo_custom_taxonomies, 'orderby' => 'count', 'hide_empty'=> false, ) );
                            $pofo_selected_category = array_values( array_column( $pofo_category, 'slug' ) );
                        } else {
                            $pofo_selected_category = explode( ',', $pofo_selected_category );
                        }
                        $args['tax_query'] = array(
                                                array(
                                                    'taxonomy' => $pofo_custom_taxonomies,
                                                    'field' => 'slug',
                                                    'terms' => $pofo_selected_category,
                                                ),
                                            );
                    }
                   
                }
            } 
        } 
    
    $post_posts = new WP_Query( $args );
    switch ( $pofo_slider_style ) {

        case 'post-slider-style-1':
                
                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'h4';

                $pofo_postslider1 = ! empty( $pofo_postslider1 ) ? $pofo_postslider1 : 0;
                $pofo_postslider1 = $pofo_postslider1 + 1;

                // Title Color
                if( ! empty( $pofo_title_color ) ) {
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.title-link { '.$pofo_title_color.' }';
                }
                if( ! empty( $pofo_title_hover_color ) ) {
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.title-link:hover, .postslider1-'.$pofo_postslider1.' a.title-link:hover { '.$pofo_title_hover_color.' }';
                }

                // Category Color
                if( ! empty( $pofo_category_color ) ) {
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.category-link { '.$pofo_category_color.' }';
                }
                if( ! empty( $pofo_category_hover_color ) ) {
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.category-link:hover, .postslider1-'.$pofo_postslider1.' a.category-link:hover { '.$pofo_category_hover_color.' }';
                }

                // Button Color
                if( ! empty( $pofo_button_color ) ){
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.btn { '.$pofo_button_color.' }';   
                }
                if( ! empty( $pofo_button_hover_color ) ){
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.btn:hover, .postslider1-'.$pofo_postslider1.' a.btn:focus { '.$pofo_button_hover_color.' }';   
                }
                if( ! empty( $pofo_button_text_color ) ){
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.btn { '.$pofo_button_text_color.' }';   
                }
                if( ! empty( $pofo_button_hover_text_color ) ){
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.btn:hover, .postslider1-'.$pofo_postslider1.' a.btn:focus { '.$pofo_button_hover_text_color.' }';   
                }
                if( ! empty( $pofo_button_border_color ) ){
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.btn { '.$pofo_button_border_color.' }';   
                }
                if( ! empty( $pofo_button_border_hover_color ) ){
                    $pofo_featured_array[] = '.postslider1-'.$pofo_postslider1.' a.btn:hover { '.$pofo_button_border_hover_color.' }';
                }

                $output .= '<div id="'.$pofo_slider_id.'" class="swiper-container width-100 postslider1-'.$pofo_postslider1.' '.$pofo_slider_id.' '.$pofo_slider_class.$show_cursor_color_style.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                <div class="swiper-wrapper">';

                    while ( $post_posts->have_posts() ) : $post_posts->the_post();

                        /* Image Alt, Title, Caption */
                        $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                        $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                        $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                        $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                        $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                        
                        $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, 'full' ) : '';
                        $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                        $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                        $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                        $srcset = $srcset_data = $srcset_classes = '';
                        $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, 'full' ) : '';
                        if( $srcset ){
                            $srcset_data = ' data-bg-srcset="'.esc_attr( $srcset ).'"';
                            $srcset_classes = ' bg-image-srcset';
                        }

                        $post_cat = array();
                        $categories = get_the_category();

                        if( ! empty( $categories ) && !is_wp_error( $categories ) ) {
                            foreach ($categories as $k => $cat) {
                                $cat_link = get_category_link($cat->cat_ID);
                                $post_cat[]='<a href="'.$cat_link.'" class="text-medium-gray text-extra-small alt-font font-weight-600 margin-10px-bottom display-inline-block category-link'.esc_attr( $pofo_category_text_transform.$pofo_category_dynamic_font_size ).'"'.$pofo_category_style_attr.'>'.$cat->name.'</a>';
                            }
                        }
                        $post_category = ! empty( $post_cat ) ? implode(", ",$post_cat) : '';

                        if( ! empty( $image_url ) ){
                            $img_style = ' style="background-image:url('.$image_url.');"';
                        } else {
                            $img_style = '';
                        }

                        $pofo_portfolio_classes = '';
                        ob_start();
                            post_class('pofo-rich-snippet display-none');
                            $pofo_portfolio_classes .= ob_get_contents();
                        ob_end_clean();

                        $output .= '<div class="swiper-slide cover-background'.$srcset_classes.'"'.$img_style.$srcset_data.'>';
                            if($show_overlay=='1'){
                                $output .= '<div class="opacity-extra-medium bg-extra-dark-gray"'.$overlay_style.'></div>';
                            }
                            $output .= '<div '.$pofo_portfolio_classes.'>';
                                $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                
                                $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                            $output .= '</div>';
                            $output .= '<div class="container position-relative one-fourth-screen xs-height-400px">';
                                $output .= '<div class="slider-typography text-center">';
                                    $output .= '<div class="slider-text-middle-main">';
                                        $output .= '<div class="slider-text-middle">';
                                            $output .= '<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 center-col slide-content">';
                                                $output .= '<div class="padding-50px-all xs-padding-30px-all bg-black-opacity"'.$pofo_box_bg_color.'>';
                                                    if($pofo_show_category == 1 && ! empty( $post_category )){
                                                        $output .= $post_category;
                                                    }
                                                    if($pofo_show_title == 1){
                                                        $output .= '<'.$pofo_title_element_tag.'><a href="'.get_permalink().'" class="font-weight-600 text-white alt-font title-link'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.get_the_title().'</a></'.$pofo_title_element_tag.'>';
                                                    }
                                                    if($pofo_show_button == 1){
                                                        $output .= '<a class="btn btn-very-small btn-transparent-white" href="'.get_permalink().'">'.$button_text.'</a>';
                                                    }
                                                $output .= '</div>';
                                            $output .= '</div>';
                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';

                    endwhile;
                    wp_reset_postdata();

                $output .= '</div>';

            break;

            case 'post-slider-style-2':

                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'h4';

                $pofo_postslider2 = ! empty( $pofo_postslider2 ) ? $pofo_postslider2 : 0;
                $pofo_postslider2 = $pofo_postslider2 + 1;

                // Title Color
                if( ! empty( $pofo_title_color ) ) {
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.title-link { '.$pofo_title_color.' }';
                }
                if( ! empty( $pofo_title_hover_color ) ) {
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.title-link:hover, .postslider2-'.$pofo_postslider2.' a.title-link:hover { '.$pofo_title_hover_color.' }';
                }

                // Category Color
                if( ! empty( $pofo_category_color ) ) {
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.category-link { '.$pofo_category_color.' }';
                }
                if( ! empty( $pofo_category_hover_color ) ) {
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.category-link:hover, .postslider2-'.$pofo_postslider2.' a.category-link:hover { '.$pofo_category_hover_color.' }';
                }

                // Button Color
                if( ! empty( $pofo_button_color ) ){
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.btn { '.$pofo_button_color.' }';   
                }
                if( ! empty( $pofo_button_hover_color ) ){
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.btn:hover, .postslider2-'.$pofo_postslider2.' a.btn:focus { '.$pofo_button_hover_color.' }';   
                }
                if( ! empty( $pofo_button_text_color ) ){
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.btn { '.$pofo_button_text_color.' }';   
                }
                if( ! empty( $pofo_button_hover_text_color ) ){
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.btn:hover, .postslider2-'.$pofo_postslider2.' a.btn:focus { '.$pofo_button_hover_text_color.' }';   
                }
                if( ! empty( $pofo_button_border_color ) ){
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.btn { '.$pofo_button_border_color.' }';   
                }
                if( ! empty( $pofo_button_border_hover_color ) ){
                    $pofo_featured_array[] = '.postslider2-'.$pofo_postslider2.' a.btn:hover { '.$pofo_button_border_hover_color.' }';
                }

                $output .= '<div id="'.$pofo_slider_id.'" class="swiper-container swiper-blog white-move postslider2-'.$pofo_postslider2.' '.$pofo_slider_id.' '.$pofo_slider_class.$show_cursor_color_style.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                <div class="swiper-wrapper">';

                    while ( $post_posts->have_posts() ) : $post_posts->the_post();

                        /* Image Alt, Title, Caption */
                        $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                        $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                        $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                        $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                        $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                        
                        $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, 'full' ) : '';
                        $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                        $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                        $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                        $srcset = $srcset_data = $srcset_classes = '';
                        $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, 'full' ) : '';
                        if( $srcset ){
                            $srcset_data = ' data-bg-srcset="'.esc_attr( $srcset ).'"';
                            $srcset_classes = ' bg-image-srcset';
                        }

                        $post_cat = array();
                        $categories = get_the_category();

                        if( ! empty( $categories ) && !is_wp_error( $categories ) ) {
                            foreach ($categories as $k => $cat) {
                                $cat_link = get_category_link($cat->cat_ID);
                                $post_cat[]='<a href="'.$cat_link.'" class="text-white text-extra-small alt-font font-weight-600 highlight-bg-text letter-spacing-1 bg-black category-link'.esc_attr( $pofo_category_text_transform.$pofo_category_dynamic_font_size ).'"'.$pofo_category_style_attr.'>'.$cat->name.'</a>';
                            }
                        }
                        $post_category = ! empty( $post_cat ) ? implode(", ",$post_cat) : '';

                        if( ! empty( $image_url ) ){
                            $img_style = ' style="background-image:url('.$image_url.');"';
                        } else {
                            $img_style = '';
                        }

                        $pofo_portfolio_classes = '';
                        ob_start();
                            post_class('pofo-rich-snippet display-none');
                            $pofo_portfolio_classes .= ob_get_contents();
                        ob_end_clean();

                        $output .= '<div class="swiper-slide width-50 md-width-60 sm-width-80 xs-width-100">';
                            $output .= '<div '.$pofo_portfolio_classes.'>';
                                $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                
                                $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                            $output .= '</div>';
                            $output .= '<div class="cover-background one-second-screen'.$srcset_classes.'"'.$img_style.$srcset_data.'>';
                                if($show_overlay=='1'){
                                    $output .= '<div class="opacity-medium bg-extra-dark-gray"'.$overlay_style.'></div>';
                                }
                                $output .= '<div class="display-table width-100 height-100 position-relative">';
                                    $output .= '<div class="display-table-cell vertical-align-middle text-center">';
                                        $output .= '<div class="col-lg-8 col-md-10 col-sm-10 col-xs-12 center-col slide-content">';
                                            if($pofo_show_category == 1 && ! empty( $post_category )){
                                                $output .= $post_category;
                                            }
                                            if($pofo_show_title == 1){
                                                $output .= '<'.$pofo_title_element_tag.' class="margin-lr-auto width-80 md-width-100"><a href="'.get_permalink().'" class="font-weight-600 text-white alt-font title-link'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.get_the_title().'</a></'.$pofo_title_element_tag.'>';
                                            }
                                            if($pofo_show_button == 1){
                                                $output .= '<a class="btn btn-small btn-transparent-white btn-rounded font-weight-700" href="'.get_permalink().'">'.$button_text.'<i class="ti-arrow-right"></i></a>';
                                            }
                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';

                    endwhile;
                    wp_reset_postdata();

                $output .= '</div>';

            break;

            case 'post-slider-style-3':

                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'span';

                $pofo_postslider3 = ! empty( $pofo_postslider3 ) ? $pofo_postslider3 : 0;
                $pofo_postslider3 = $pofo_postslider3 + 1;

                // Title Color
                if( ! empty( $pofo_title_color ) ) {
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.title-link { '.$pofo_title_color.' }';
                }
                if( ! empty( $pofo_title_hover_color ) ) {
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.title-link:hover, .postslider3-'.$pofo_postslider3.' a.title-link:hover { '.$pofo_title_hover_color.' }';
                }

                // Category Color
                if( ! empty( $pofo_category_color ) ) {
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.category-link { '.$pofo_category_color.' }';
                }
                if( ! empty( $pofo_category_hover_color ) ) {
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.category-link:hover, .postslider3-'.$pofo_postslider3.' a.category-link:hover { '.$pofo_category_hover_color.' }';
                }

                // Button Color
                if( ! empty( $pofo_button_color ) ){
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.btn { '.$pofo_button_color.' }';   
                }
                if( ! empty( $pofo_button_hover_color ) ){
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.btn:hover, .postslider3-'.$pofo_postslider3.' a.btn:focus { '.$pofo_button_hover_color.' }';   
                }
                if( ! empty( $pofo_button_text_color ) ){
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.btn { '.$pofo_button_text_color.' }';   
                }
                if( ! empty( $pofo_button_hover_text_color ) ){
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.btn:hover, .postslider3-'.$pofo_postslider3.' a.btn:focus { '.$pofo_button_hover_text_color.' }';   
                }
                if( ! empty( $pofo_button_border_color ) ){
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.btn { '.$pofo_button_border_color.' }';   
                }
                if( ! empty( $pofo_button_border_hover_color ) ){
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' a.btn:hover { '.$pofo_button_border_hover_color.' }';
                }

                if( ! empty( $post_posts->post_count ) && $post_posts->post_count > 0 ) {
                    
                    $slide_width = 100 / ( $post_posts->post_count + 1 );
                    $active_slide_width = $slide_width * 2;

                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' li { width: ' . $slide_width . '%; }';
                    $pofo_featured_array[] = '.postslider3-'.$pofo_postslider3.' li.blog-column-active { width: ' . $active_slide_width . '%; }';
                }

                $cnt = 0;
                $output .= ' <ul id="'.$pofo_slider_id.'" class="blog-header-style1 equalize sm-equalize-auto postslider3-'.$pofo_postslider3.' '.$pofo_slider_id.' '.$pofo_slider_class.'">';

                    while ( $post_posts->have_posts() ) : $post_posts->the_post();

                        /* Image Alt, Title, Caption */
                        $thumbnail_id   = get_post_thumbnail_id(get_the_ID());
                        $img_alt        = ! empty( $thumbnail_id ) ? pofo_option_image_alt( $thumbnail_id ) : array();
                        $img_title      = ! empty( $thumbnail_id ) ? pofo_option_image_title( $thumbnail_id ) : array();
                        $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                        $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                        
                        $thumb          = ! empty( $thumbnail_id ) ? wp_get_attachment_image_src( $thumbnail_id, 'full' ) : '';
                        $image_url      = ! empty( $thumb['0'] ) ? $thumb['0'] : '';
                        $image_width    = ! empty( $thumb['1'] ) ? $thumb['1'] : '';
                        $image_height   = ! empty( $thumb['2'] ) ? $thumb['2'] : '';

                        $srcset = $srcset_data = $srcset_classes = '';
                        $srcset = ! empty( $thumbnail_id ) ? wp_get_attachment_image_srcset( $thumbnail_id, 'full' ) : '';
                        if( $srcset ){
                            $srcset_data = ' data-bg-srcset="'.esc_attr( $srcset ).'"';
                            $srcset_classes = ' bg-image-srcset';
                        }

                        $post_cat = array();
                        $categories = get_the_category();

                        if( ! empty( $categories ) && !is_wp_error( $categories ) ) {
                            foreach ($categories as $k => $cat) {
                                $cat_link = get_category_link($cat->cat_ID);
                                $post_cat[]='<a href="'.$cat_link.'" class="text-white text-extra-small alt-font font-weight-600 margin-10px-bottom display-inline-block category-link'.esc_attr( $pofo_category_text_transform.$pofo_category_dynamic_font_size ).'"'.$pofo_category_style_attr.'>'.$cat->name.'</a>';
                            }
                        }
                        $post_category = ! empty( $post_cat ) ? implode(", ",$post_cat) : '';

                        if( ! empty( $image_url ) ){
                            $img_style = ' style="background-image:url('.$image_url.');"';
                        } else {
                            $img_style = '';
                        }

                        $column_active = ( $cnt == '1') ? ' blog-column-active' : '';

                        $pofo_portfolio_classes = '';
                        ob_start();
                            post_class('pofo-rich-snippet display-none');
                            $pofo_portfolio_classes .= ob_get_contents();
                        ob_end_clean();
                        
                        $output .= '<li class="sm-padding-15px-bottom one-third-screen sm-height-450px'.$column_active.'">';
                            $output .= '<div '.$pofo_portfolio_classes.'>';
                                $output .= '<span class="entry-title">'.get_the_title().'</span>';
                                
                                $output .= '<span class="author vcard"><a class="url fn n" href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author().'</a></span>';
                                $output .= '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date().'</time>';
                            $output .= '</div>';
                            $output .= '<div class="blog-banner cover-background'.$srcset_classes.'"'.$img_style.$srcset_data.'>';
                                if($show_overlay=='1'){
                                    $output .= '<div class="opacity-medium bg-extra-dark-gray"'.$overlay_style.'></div>';
                                }
                                $output .= '<figure>';
                                    $output .= '<figcaption>';
                                        if($pofo_show_category == 1 && ! empty( $post_category )){
                                            $output .= $post_category;
                                        }
                                        if($pofo_show_title == 1){
                                            $output .= '<'.$pofo_title_element_tag.'><a href="'.get_permalink().'" class="text-extra-large display-block text-white alt-font margin-25px-bottom width-200px md-width-180px sm-width-100 sm-margin-seven-bottom xs-width-100 title-link'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.get_the_title().'</a></'.$pofo_title_element_tag.'>';
                                        }
                                        if($pofo_show_button == 1){
                                            $output .= '<a class="btn btn-very-small btn-white font-weight-300" href="'.get_permalink().'">'.$button_text.'</a>';
                                        }
                                    $output .= '</figcaption>';
                                $output .= '</figure>';
                            $output .= '</div>';
                        $output .= '</li>';
                        $cnt++;
                    endwhile;
                    wp_reset_postdata();

                $output .= '</ul>';

            break;
    }
    
    if( $show_pagination == 1 ) {
        $pagination_style_class = $show_pagination_style == 1 ? ' swiper-pagination-square' : '';
        $pagination_style_class .= $show_pagination_color_style;
        $class_name = 'swiper-pagination-' . $navigation_unique_id;
        $output .= '<div class="swiper-pagination text-center ' . $class_name . $pagination_style_class . '"></div>';

    }

    if( $pofo_slider_style == 'post-slider-style-1' || $pofo_slider_style == 'post-slider-style-2' ){
        $output .= '</div><!-- .swiper-container -->';
    }

    /* Add custom script End*/
    return $output;
}
add_shortcode( 'pofo_post_slider', 'pofo_post_slider_shortcode' );
