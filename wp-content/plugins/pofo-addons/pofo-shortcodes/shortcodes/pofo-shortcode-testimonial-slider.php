<?php
/**
 * Shortcode For Testimonial Slider
 *
 * @package Pofo
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Slider */
/*-----------------------------------------------------------------------------------*/

$pofo_slider_unique_id = 1;
function pofo_testimonial_slider_shortcode( $atts, $content = null ) {
    
    global $pofo_slider_unique_id, $pofo_slider_script;

    extract( shortcode_atts( array(
            'pofo_slider_style' => '',
            'pofo_testimonial_slides' => '',
            'pofo_box_bg_color' => '',
            'show_pagination' => '1',
            'show_pagination_style' => '',
            'show_pagination_color_style' => '',
            'show_navigation' => '1',
            'show_navigation_style' => '',
            'show_cursor_color_style' => '',
            'show_round_image' => '1',
            'transition_style' => '',

            'slides_per_view_desktop' => '3',
            'slides_per_view_mini_desktop' => '3',
            'slides_per_view_tablet' => '2',
            'slides_per_view_mobile' => '1',
            'autoloop' => '',
            'autoplay' => '',
            'slidedelay' => '',
            'slidespeed' => '',
            'pofo_slider_id' => '',
            'pofo_slider_class' => '',

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
            'pofo_designation_font_size' => '',
            'pofo_designation_line_height' => '',
            'pofo_designation_letter_spacing' => '',
            'pofo_designation_font_weight' => '',
            'pofo_designation_italic' => '',
            'pofo_designation_underline' => '',
            'pofo_designation_element_tag' => '',
            'pofo_designation_color' => '',
            'pofo_designation_enable_responsive_font' => '',
            'pofo_designation_responsive_settings' => '',
            'pofo_content_font_size' => '',
            'pofo_content_line_height' => '',
            'pofo_content_letter_spacing' => '',
            'pofo_content_font_weight' => '',
            'pofo_content_color' => '',
            'pofo_content_enable_responsive_font' => '',
            'pofo_content_responsive_settings' => '',
        ), $atts ) );

    $output = $slider_class = $pofo_title_style_attr = $pofo_designation_style_attr = $pofo_content_style_attr = $stars = '';
    $pofo_title_style_array = $pofo_designation_style_array = $pofo_content_style_array = $swiper_config = array();

    if( ! empty( $pofo_testimonial_slides ) ) {

        $pofo_box_bg_color = ! empty( $pofo_box_bg_color ) ? ' style="background-color: '. $pofo_box_bg_color .';"' : '';
        $pofo_testimonial_slides = json_decode( urldecode( $pofo_testimonial_slides ) );
        $transition_style = ( $transition_style ) ? $transition_style : '';
        $show_pagination_color_style= ( $show_pagination_color_style ) ? ' swiper-pagination-white' : ' swiper-pagination-black';
        $show_cursor_color_style = ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style.' ' : ' white-move ';
        $slides_per_view_desktop= ! empty( $slides_per_view_desktop ) ? $slides_per_view_desktop : '3';
        $slides_per_view_mini_desktop= ! empty( $slides_per_view_mini_desktop ) ? $slides_per_view_mini_desktop : '3';
        $slides_per_view_tablet = ! empty( $slides_per_view_tablet ) ? $slides_per_view_tablet : '2';
        $slides_per_view_mobile = ! empty( $slides_per_view_mobile ) ? $slides_per_view_mobile : '1';

        // Check if slider id and class
        $pofo_slider_unique_id  = ! empty( $pofo_slider_unique_id ) ? $pofo_slider_unique_id : 1;
        $navigation_unique_id   = $pofo_slider_unique_id;
        $pofo_slider_id         = ( $pofo_slider_id ) ? $pofo_slider_id : 'testimonial-slider';
        $pofo_slider_id         .= '-' . $pofo_slider_unique_id;
        $pofo_slider_unique_id++;

        $pofo_slider_style      = ( $pofo_slider_style ) ? $pofo_slider_style : '';
        $pofo_slider_class      = ( $pofo_slider_class ) ? ' ' . $pofo_slider_class . ' ' . $pofo_slider_style : ' ' . $pofo_slider_style;
        
        // For Title Style
        ! empty( $pofo_title_font_size ) ? $pofo_title_style_array[] = 'font-size: ' . $pofo_title_font_size . ';' : '';
        ! empty( $pofo_title_line_height ) ? $pofo_title_style_array[] = 'line-height: ' . $pofo_title_line_height . ';' : '';
        ! empty( $pofo_title_letter_spacing ) ? $pofo_title_style_array[] = 'letter-spacing: ' . $pofo_title_letter_spacing . ';' : '';
        ! empty( $pofo_title_font_weight ) ? $pofo_title_style_array[] = 'font-weight: ' . $pofo_title_font_weight . ';' : '';
        ( $pofo_title_italic == 1 ) ? $pofo_title_style_array[] = 'font-style: italic;' : '';
        ( $pofo_title_underline == 1 ) ? $pofo_title_style_array[] = 'text-decoration: underline;' : '';
        ! empty( $pofo_title_color ) ? $pofo_title_style_array[] = 'color: '.$pofo_title_color.';' : '';

        $pofo_title_dynamic_font_size = $pofo_title_enable_responsive_font == 1 ? ' dynamic-font-size' : '';
        $pofo_title_dynamic_font_size .= ! empty( $pofo_title_responsive_settings ) ? pofo_shortcode_custom_css_class( $pofo_title_responsive_settings ) : '';
        $pofo_title_style_attr   = pofo_get_style_attribute( $pofo_title_style_array, $pofo_title_font_size, $pofo_title_line_height );

        // For Designation Style
        ! empty( $pofo_designation_font_size ) ? $pofo_designation_style_array[] = 'font-size: ' . $pofo_designation_font_size . ';' : '';
        ! empty( $pofo_designation_line_height ) ? $pofo_designation_style_array[] = 'line-height: ' . $pofo_designation_line_height . ';' : '';
        ! empty( $pofo_designation_letter_spacing ) ? $pofo_designation_style_array[] = 'letter-spacing: ' . $pofo_designation_letter_spacing . ';' : '';
        ! empty( $pofo_designation_font_weight ) ? $pofo_designation_style_array[] = 'font-weight: ' . $pofo_designation_font_weight . ';' : '';
        ( $pofo_designation_italic == 1 ) ? $pofo_designation_style_array[] = 'font-style: italic;' : '';
        ( $pofo_designation_underline == 1 ) ? $pofo_designation_style_array[] = 'text-decoration: underline;' : '';
        ! empty( $pofo_designation_color ) ? $pofo_designation_style_array[] = 'color: '.$pofo_designation_color.';' : '';

        $pofo_designation_dynamic_font_size = $pofo_designation_enable_responsive_font == 1 ? ' dynamic-font-size' : '';
        $pofo_designation_dynamic_font_size .= ! empty( $pofo_designation_responsive_settings ) ? pofo_shortcode_custom_css_class( $pofo_designation_responsive_settings ) : '';
        $pofo_designation_style_attr   = pofo_get_style_attribute( $pofo_designation_style_array, $pofo_designation_font_size, $pofo_designation_line_height );

        // For Content Style
        ! empty( $pofo_content_font_size ) ? $pofo_content_style_array[] = 'font-size: ' . $pofo_content_font_size . ';' : '';
        ! empty( $pofo_content_line_height ) ? $pofo_content_style_array[] = 'line-height: ' . $pofo_content_line_height . ';' : '';
        ! empty( $pofo_content_letter_spacing ) ? $pofo_content_style_array[] = 'letter-spacing: ' . $pofo_content_letter_spacing . ';' : '';
        ! empty( $pofo_content_font_weight ) ? $pofo_content_style_array[] = 'font-weight: ' . $pofo_content_font_weight . ';' : '';
        ! empty( $pofo_content_color ) ? $pofo_content_style_array[] = 'color: '.$pofo_content_color.';' : '';

        $pofo_content_dynamic_font_size = $pofo_content_enable_responsive_font == 1 ? ' dynamic-font-size' : '';
        $pofo_content_dynamic_font_size .= ! empty( $pofo_content_responsive_settings ) ? pofo_shortcode_custom_css_class( $pofo_content_responsive_settings ) : '';
        $pofo_content_style_attr   = pofo_get_style_attribute( $pofo_content_style_array, $pofo_content_font_size, $pofo_content_line_height );

        $round_image_class = $show_round_image == 1 ? ' border-radius-100' : '';

        /* Add custom script Start*/
        $slidedelay = ( $slidedelay ) ? $slidedelay : '300';
        $slidespeed = ( $slidespeed ) ? $slidespeed : '';

        $swiper_config['autoplayStop'] = true;
        $swiper_config['disableOnInteraction'] = false;
        $swiper_config['keyboard'] = true;
        $swiper_config['mousewheel'] = false;

        if( $transition_style == 'fade' ) {
            $swiper_config['fadeEffect'] = array( 'crossFade' => true );
        }
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
        if( $transition_style && $transition_style != 'slide') {
            $swiper_config['effect'] = $transition_style;
        }
        
        if( $pofo_slider_style == 'style-3' ) {
            $swiper_config['slidesPerView'] = $slides_per_view_mobile;
            $swiper_config['breakpoints'] = array( '768' => array( 'slidesPerView' => $slides_per_view_tablet ), '992' => array( 'slidesPerView' => $slides_per_view_mini_desktop ), '1200' => array( 'slidesPerView' => $slides_per_view_desktop ) );
        } else {
            $swiper_config['slidesPerView'] = 1;
        }

        if( $show_pagination == 1 ) {
            $class_name = 'swiper-pagination-' . $navigation_unique_id;
            $swiper_config['pagination'] = array( 'el' => '.' . $class_name, 'type' => 'bullets', 'clickable' => true );
        }
        if( $show_navigation == 1 && ( $pofo_slider_style == 'style-1' || $pofo_slider_style == 'style-2' ) ) {
            $swiper_config['navigation'] = array( 'nextEl' => '.swiper-next-'. $navigation_unique_id, 'prevEl' => '.swiper-prev-'. $navigation_unique_id );
        }

        $slider_options = ! empty( $swiper_config ) ? json_encode( $swiper_config ) : '';

        switch ( $pofo_slider_style ) {

            case 'style-1':

                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'p';
                $pofo_designation_element_tag = ( $pofo_designation_element_tag ) ? $pofo_designation_element_tag : 'p';
                $pagination_class = $show_pagination == 1 ? ' pagination-bottom-space' : '';

                $output .= '<div id="'.$pofo_slider_id.'" class="swiper-container xs-text-center testimonial-style1 '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.$show_pagination_color_style.$pagination_class.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                <div class="swiper-wrapper equalize">';
                            
                        foreach ($pofo_testimonial_slides as $slide) {
                        
                            /* Image Alt, Title, Caption */
                            $img_alt        = ! empty( $slide->pofo_image ) ? pofo_option_image_alt( $slide->pofo_image ) : array();
                            $img_title      = ! empty( $slide->pofo_image ) ? pofo_option_image_title( $slide->pofo_image ) : array();
                            $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                            $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                            
                            // Replace || to <br /> in title
                            $slide_title    = ! empty( $slide->pofo_title ) ? str_replace('||', '<br />',$slide->pofo_title) : '';

                            $pofo_image_srcset  = ! empty( $slide->pofo_image_srcset ) ? $slide->pofo_image_srcset : 'full';
                            $thumb          = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_src( $slide->pofo_image, $pofo_image_srcset ) : array();

                            $srcset = $srcset_data = $sizes_data = '';
                            $srcset = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_srcset( $slide->pofo_image, $pofo_image_srcset ) : '';
                            if( $srcset ){
                                $srcset_data = ' srcset="'.esc_attr( $srcset ).'"';
                            }

                            $sizes = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_sizes( $slide->pofo_image, $pofo_image_srcset ) : '';
                            if( $sizes ){
                                $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                            }

                            $output .= '<div class="swiper-slide">';
                                $output .= '<div class="col-md-7 col-sm-10 col-xs-12 center-col">';
                                    $output .= '<div class="col-md-3 col-sm-3 col-xs-12 display-table inner-match-height">';
                                        $output .= '<div class="display-table-cell vertical-align-middle">';
                                            if( ! empty( $thumb[0] ) ){
                                                $output .= '<img src="'.esc_url( $thumb[0] ).'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.$srcset_data.$sizes_data.' class="width-150px xs-width-100px xs-margin-15px-bottom'.esc_attr($round_image_class).'"/>';
                                            }
                                        $output .= '</div>';
                                    $output .= '</div>';
                                    $output .= '<div class="col-md-8 col-sm-8 col-xs-12 text-left xs-text-center margin-20px-left xs-no-margin-left display-table inner-match-height">';
                                        $output .= '<div class="display-table-cell vertical-align-middle">';
                                            if( ! empty( $slide->pofo_content ) ){
                                                $output .= '<div class="margin-15px-bottom last-paragraph-no-margin'.esc_attr( $pofo_content_dynamic_font_size ).'"'.$pofo_content_style_attr.'>' . do_shortcode( pofo_remove_wpautop( $slide->pofo_content ) ) . '</div>';
                                            }
                                            if( ! empty( $slide_title ) ){
                                                $output .= '<'.$pofo_title_element_tag.' class="text-dark-gray alt-font text-small no-margin-bottom'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.$slide_title.'</'.$pofo_title_element_tag.'>';
                                            }
                                            if( ! empty( $slide->pofo_designation ) ){
                                                $output .= '<'.$pofo_designation_element_tag.' class="no-margin text-extra-small text-medium-gray'.esc_attr( $pofo_designation_dynamic_font_size ).'"'.$pofo_designation_style_attr.'>'.$slide->pofo_designation.'</'.$pofo_designation_element_tag.'>';
                                            }
                                        $output .= '</div>';
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        }

                $output .= '    </div>';
            
                break;

            case 'style-2':

                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'p';
                $pofo_designation_element_tag = ( $pofo_designation_element_tag ) ? $pofo_designation_element_tag : 'p';

                $output .= '<div id="'.esc_attr( $pofo_slider_id ) .'" class="swiper-container black-move swiper-pagination-bottom testimonial-style2 '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.$show_pagination_color_style.'" data-slider-options="' . esc_attr( $slider_options ) . '">
                                <div class="swiper-wrapper equalize">';

                    foreach ($pofo_testimonial_slides as $slide) {
                    
                        /* Image Alt, Title, Caption */
                        $img_alt        = ! empty( $slide->pofo_image ) ? pofo_option_image_alt( $slide->pofo_image ) : array();
                        $img_title      = ! empty( $slide->pofo_image ) ? pofo_option_image_title( $slide->pofo_image ) : array();
                        $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                        $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                        // Replace || to <br /> in title
                        $slide_title    = ! empty( $slide->pofo_title ) ? str_replace('||', '<br />',$slide->pofo_title) : '';

                        $pofo_image_srcset  = ! empty( $slide->pofo_image_srcset ) ? $slide->pofo_image_srcset : 'full';
                        $thumb          = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_src( $slide->pofo_image, $pofo_image_srcset ) : array();

                        $srcset = $srcset_data = $sizes_data = '';
                        $srcset = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_srcset( $slide->pofo_image, $pofo_image_srcset ) : '';
                        if( $srcset ){
                            $srcset_data = ' srcset="'.esc_attr( $srcset ).'"';
                        }

                        $sizes = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_sizes( $slide->pofo_image, $pofo_image_srcset ) : '';
                        if( $sizes ){
                            $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                        }

                        $output .= '<div class="swiper-slide">';
                        
                            $output .= '<div class="col-lg-7 col-md-8 col-sm-10 col-xs-12 center-col">';
                                $output .= '<div class="testimonia-block width-90 xs-width-100 center-col text-center">';
                                    $output .= '<div class="display-table width-100 bg-light-gray text-center padding-60px-all border-radius-6 xs-padding-20px-all xs-padding-25px-bottom inner-match-height"' . $pofo_box_bg_color . '>';
                                        if( ! empty( $slide->pofo_content ) ) {
                                            $output .= '<div class="display-table-cell vertical-align-middle'.esc_attr( $pofo_content_dynamic_font_size ).'"'.$pofo_content_style_attr.'>' . do_shortcode( pofo_remove_wpautop($slide->pofo_content) ) . '</div>';
                                        }
                                    $output .= '</div>';
                                    $output .= '<div class="profile-box">';
                                        if( ! empty( $thumb[0] ) ){
                                            $output .= '<img src="'.esc_url( $thumb[0] ).'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.$srcset_data.$sizes_data.' class="width-20 xs-center-col border-color-white border-width-4 border-solid margin-15px-bottom'.esc_attr($round_image_class).'"/>';
                                        }
                                        if( ! empty( $slide_title ) ){
                                            $output .= '<'.$pofo_title_element_tag.' class="alt-font text-small font-weight-600 text-black margin-5px-bottom'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.$slide_title.'</'.$pofo_title_element_tag.'>';
                                        }
                                        if( ! empty( $slide->pofo_designation ) ){
                                            $output .= '<'.$pofo_designation_element_tag.' class="no-margin text-extra-small text-medium-gray'.esc_attr( $pofo_designation_dynamic_font_size ).'"'.$pofo_designation_style_attr.'>'.$slide->pofo_designation.'</'.$pofo_designation_element_tag.'>';
                                        }
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
                    }
                $output .= '    </div>';
            
                break;

            case 'style-3':

                $pofo_title_element_tag = ( $pofo_title_element_tag ) ? $pofo_title_element_tag : 'span';
                $pofo_designation_element_tag = ( $pofo_designation_element_tag ) ? $pofo_designation_element_tag : 'span';

                $output .= '<div id="'.esc_attr( $pofo_slider_id ) .'" class="swiper-container swiper-pagination-bottom testimonial-style3 '.$pofo_slider_id.' '.$show_cursor_color_style.' '.$pofo_slider_class.$show_pagination_color_style.'" data-slider-options="' . esc_attr( $slider_options ) . '">';
                    $output .= '<div class="swiper-wrapper equalize">';
                        
                        foreach ($pofo_testimonial_slides as $slide) {

                            /* Image Alt, Title, Caption */
                            $img_alt        = ! empty( $slide->pofo_image ) ? pofo_option_image_alt( $slide->pofo_image ) : array();
                            $img_title      = ! empty( $slide->pofo_image ) ? pofo_option_image_title( $slide->pofo_image ) : array();
                            $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                            $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';

                            $pofo_image_srcset  = ! empty( $slide->pofo_image_srcset ) ? $slide->pofo_image_srcset : 'full';
                            $thumb          = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_src($slide->pofo_image, $pofo_image_srcset) : array();

                            $srcset = $srcset_data = $sizes_data = '';
                            $srcset = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_srcset( $slide->pofo_image, $pofo_image_srcset ) : '';
                            if( $srcset ){
                                $srcset_data = ' srcset="'.esc_attr( $srcset ).'"';
                            }

                            $sizes = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_sizes( $slide->pofo_image, $pofo_image_srcset ) : '';
                            if( $sizes ){
                                $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                            }

                            $pofo_member_name   = ! empty( $slide->pofo_member_name ) ? $slide->pofo_member_name : '';
                            $pofo_member_des    = ! empty( $slide->pofo_member_des ) ? $slide->pofo_member_des : '';

                            // Replace || to <br /> in title
                            $slide_title    = ! empty( $slide->pofo_title ) ? str_replace('||', '<br />',$slide->pofo_title) : '';

                            $output .= '<div class="swiper-slide sm-margin-four-bottom padding-15px-lr">';
                                $output .= '<div class="height-100 margin-half-all bg-white box-shadow-light text-center padding-fourteen-all xs-padding-30px-all"' . $pofo_box_bg_color . '>';
                                    if( ! empty( $thumb[0] ) ){
                                        $output .= '<img src="'.esc_attr( $thumb[0] ).'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.$srcset_data.$sizes_data.' class="width-40 margin-25px-bottom sm-margin-15px-bottom'.esc_attr($round_image_class).'"/>';
                                    }
                                    if( ! empty( $slide->pofo_content ) ){
                                        $output .= '<div class="sm-margin-15px-bottom xs-margin-20px-bottom'.esc_attr( $pofo_content_dynamic_font_size ).'"'.$pofo_content_style_attr.'>' . do_shortcode( pofo_remove_wpautop($slide->pofo_content) ) . '</div>';
                                    }
                                    if( ! empty( $slide_title ) ){
                                        $output .= '<'.$pofo_title_element_tag.' class="text-extra-dark-gray text-small display-block line-height-10 alt-font font-weight-600'.esc_attr( $pofo_title_dynamic_font_size ).'"'.$pofo_title_style_attr.'>'.$slide_title.'</'.$pofo_title_element_tag.'>';
                                    }
                                    if( ! empty( $slide->pofo_designation ) ){
                                        $output .= '<'.$pofo_designation_element_tag.' class="text-light-gray2 text-extra-small text-medium-gray'.esc_attr( $pofo_designation_dynamic_font_size ).'"'.$pofo_designation_style_attr.'>'.$slide->pofo_designation.'</'.$pofo_designation_element_tag.'>';
                                    }
                                $output .= '</div>';
                            $output .= '</div>';
                        }

                    $output .= '</div>';

                break;

            default:

                break; 
        }

        if( $show_pagination == 1 ) {
            $pagination_style_class = $show_pagination_style == 1 ? ' swiper-pagination-square' : '';
            $class_name = 'swiper-pagination-' . $navigation_unique_id;
            $output .= '<div class="swiper-pagination text-center ' . $class_name . $pagination_style_class . '"></div>';
        }
        if( $show_navigation == 1 && ( $pofo_slider_style == 'style-1' || $pofo_slider_style == 'style-2' ) ) {
            
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

        $output .= '</div>';

    }
    return $output;
}
add_shortcode( 'pofo_testimonial_slider', 'pofo_testimonial_slider_shortcode' );