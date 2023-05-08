<?php
/**
 * Shortcode For Client Image Slider
 *
 * @package Pofo
 */
?>
<?php 
/*-----------------------------------------------------------------------------------*/
/* Slider */
/*-----------------------------------------------------------------------------------*/

$pofo_slider_parent_type = '';
$pofo_slider_unique_id = 1;
function pofo_client_image_slider_shortcode( $atts, $content = null ) {
    
    global $pofo_slider_unique_id, $pofo_slider_script;

    extract( shortcode_atts( array(
                'pofo_image_slides' => '',
                'show_pagination' => '1',
                'show_pagination_style' => '',
                'show_pagination_color_style' => '',
                'show_navigation' => '1',
                'show_navigation_style' => '',
                'show_cursor_color_style' => '',
                'slides_per_view_desktop' => '4',
                'slides_per_view_mini_desktop' => '3',
                'slides_per_view_tablet' => '2',
                'slides_per_view_mobile' => '1',
                'autoloop' => '',
                'autoplay' => '',
                'slidedelay' => '',
                'slidespeed' => '',
                'pofo_slider_id' => '',
                'pofo_slider_class' => '',
            ), $atts ) );

    $output  = $slider_class ='';

    if( ! empty( $pofo_image_slides ) ) {

        $pofo_image_slides          = json_decode( urldecode( $pofo_image_slides ) );

        $show_pagination_color_style= ( $show_pagination_color_style ) ? ' swiper-pagination-white' : ' swiper-pagination-black';
        $show_cursor_color_style= ( $show_cursor_color_style ) ? ' '.$show_cursor_color_style : ' black-move';
        $slides_per_view_desktop= ! empty( $slides_per_view_desktop ) ? $slides_per_view_desktop : '4';
        $slides_per_view_mini_desktop= ! empty( $slides_per_view_mini_desktop ) ? $slides_per_view_mini_desktop : '3';
        $slides_per_view_tablet = ! empty( $slides_per_view_tablet ) ? $slides_per_view_tablet : '2';
        $slides_per_view_mobile = ! empty( $slides_per_view_mobile ) ? $slides_per_view_mobile : '1';

        // Check if slider id and class
        $pofo_slider_unique_id  = ! empty( $pofo_slider_unique_id ) ? $pofo_slider_unique_id : 1;
        $navigation_unique_id   = $pofo_slider_unique_id;
        $pofo_slider_id         = ( $pofo_slider_id ) ? $pofo_slider_id : 'pofo-client-image-slider';
        $pofo_slider_id         .= '-' . $pofo_slider_unique_id;
        $pofo_slider_unique_id++;

        $pofo_slider_class      = ( $pofo_slider_class ) ? ' ' . $pofo_slider_class : '';


        /* Add custom script Start*/
        $slidedelay = ( $slidedelay ) ? $slidedelay : '3000';
        $slidespeed = ( $slidespeed ) ? $slidespeed : '';

        $swiper_config['stopOnLastSlide'] = true;
        $swiper_config['disableOnInteraction'] = false;
        $swiper_config['keyboard'] = true;
        $swiper_config['mousewheel'] = false;

        $swiper_config['slidesPerView'] = $slides_per_view_mobile;
        $swiper_config['breakpoints'] = array( '768' => array( 'slidesPerView' => $slides_per_view_tablet ), '992' => array( 'slidesPerView' => $slides_per_view_mini_desktop ), '1200' => array( 'slidesPerView' => $slides_per_view_desktop ) );


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

        if( $show_navigation == 1 ) {
            $swiper_config['navigation'] = array( 'nextEl' => '.swiper-next-'. $navigation_unique_id, 'prevEl' => '.swiper-prev-'. $navigation_unique_id );
        } 

        if( $show_pagination == 1 ) {
            $class_name = 'swiper-pagination-' . $navigation_unique_id;
            $swiper_config['pagination'] = array( 'el' => '.' . $class_name, 'type' => 'bullets', 'clickable' => true );
        }

        $slider_options = ! empty( $swiper_config ) ? json_encode( $swiper_config ) : '';

        $output .= '<div id="'.esc_attr( $pofo_slider_id ).'" class="swiper-container '.$pofo_slider_id.' '.$show_cursor_color_style.$pofo_slider_class.'" data-slider-options="' . esc_attr( $slider_options ) . '">';
            $output .= '<div class="swiper-wrapper">';
                
            foreach( $pofo_image_slides as $slide ) {

                /* Image Alt, Title, Caption */
                $img_alt        = ! empty( $slide->pofo_image ) ? pofo_option_image_alt( $slide->pofo_image ) : array();
                $img_title      = ! empty( $slide->pofo_image ) ? pofo_option_image_title( $slide->pofo_image ) : array();
                $image_alt      = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? ' alt="'.$img_alt['alt'].'"' : ' alt=""' ; 
                $image_title    = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? ' title="'.$img_title['title'].'"' : '';
                
                $pofo_image_srcset  = ! empty( $slide->pofo_image_srcset ) ? $slide->pofo_image_srcset : 'full';
                $thumb          = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_src( $slide->pofo_image, $pofo_image_srcset ) : array();

                $srcset = $srcset_data = $sizes = $sizes_data = '';
                $srcset = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_srcset( $slide->pofo_image, $pofo_image_srcset ) : '';
                if( $srcset ){
                    $srcset_data = ' srcset="'.esc_attr( $srcset ).'"';
                }

                $sizes = ! empty( $slide->pofo_image ) ? wp_get_attachment_image_sizes( $slide->pofo_image, $pofo_image_srcset ) : '';
                if( $sizes ){
                    $sizes_data = ' sizes="'.esc_attr( $sizes ).'"';
                }

                // Link And Traget
                $pofo_link_url      = ! empty( $slide->pofo_link_url ) ? $slide->pofo_link_url : '';
                $pofo_link_target   = ! empty( $slide->pofo_link_target ) ? ' target="'.$slide->pofo_link_target.'"' : 'self';
                
                $output .= '<div class="swiper-slide slide-content-middle text-center">';
                    if( ! empty( $thumb[0] ) ) {

                        if( ! empty( $pofo_link_url ) ) {
                            $output .= '<a '.$pofo_link_target.' href="'.esc_url( $pofo_link_url ).'">';
                        }
                            $output .= '<img src="'.esc_url( $thumb[0] ).'" width="'.$thumb[1].'" height="'.$thumb[2].'"'.$image_alt.$image_title.$srcset_data.$sizes_data.'/>';
                        if( ! empty( $pofo_link_url ) ) {
                            $output .= '</a>';
                        }
                    }
                $output .= '</div>';
            }

            $output .= '</div>';

            if( $show_navigation == 1 ) {
                
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

        if( $show_pagination == 1 ) {
            $pagination_style_class = $show_pagination_style == 1 ? ' swiper-pagination-square' : '';
            $class_name = 'swiper-pagination-' . $navigation_unique_id;
            $output .= '<div class="swiper-pagination '.$show_pagination_color_style. ' ' . $class_name . $pagination_style_class . '"></div>';
           
        }

    }

	/* Add custom script End*/
    return $output;
}
add_shortcode( 'pofo_client_image_slider', 'pofo_client_image_slider_shortcode' );