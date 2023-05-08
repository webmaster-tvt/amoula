<?php

if ( ! function_exists( 'pofo_lists_shortcode' ) ) {
    function pofo_lists_shortcode( $atts, $content = null ) {
        global $pofo_featured_array, $pofo_list_style1, $pofo_list_style2, $pofo_list_style3, $pofo_list_style4, $pofo_list_style5, $pofo_list_style6, $pofo_list_style7, $pofo_list_style8;
        extract( 
            shortcode_atts( 
                array(
                    'id' => '',
                    'class' => '',
                    'pofo_list_style' => '',
                    'pofo_list_values' => '',
                    'pofo_text_transform' => '',
                    'pofo_text_color' => '',
                    'pofo_link_color' => '',
                    'pofo_link_hover_color' => '',
                    'pofo_subtitle_color' => '',
                    'pofo_bulleting_color' => '#ff214f',
                    'pofo_border_color' => '',
                ), $atts
            )
        );

        $output = '';   

        if( ! empty( $pofo_list_values ) ) {

            $classes = $style_array = array();

            $pofo_list_values = ! empty( $pofo_list_values ) ? json_decode( urldecode( $pofo_list_values ) ) : array();
            $pofo_text_color = ! empty( $pofo_text_color ) ? $style_array[] = 'color: ' . $pofo_text_color . ';' : '';
            $pofo_subtitle_color = ! empty( $pofo_subtitle_color ) ? ' style="color: ' . $pofo_subtitle_color . ';"' : '';
            $pofo_bulleting_color_style_3 = ! empty( $pofo_bulleting_color ) ? 'background-color: ' . $pofo_bulleting_color . ';' : '';
            $pofo_bulleting_color = ! empty( $pofo_bulleting_color ) ? 'color: ' . $pofo_bulleting_color . ';' : '';
            $pofo_border_color = ! empty( $pofo_border_color ) ? ' style="border-color: ' . $pofo_border_color . ';"' : '';

            $pofo_link_color = ! empty( $pofo_link_color ) ? 'color: ' . $pofo_link_color . ';' : '';
            $pofo_link_hover_color = ! empty( $pofo_link_hover_color ) ? 'color: ' . $pofo_link_hover_color . ';' : '';

            $id = ( $id ) ? ' id="'.esc_attr( $id ).'"' : '';
            $class = ( $class ) ? $classes[] = $class : '';

            ( $pofo_text_transform ) ? $classes[] = $pofo_text_transform : '';

            $class_list = ! empty( $classes ) ? ' ' . implode(" ", $classes) : '';
            $style_list = ! empty( $style_array ) ? ' style="' . implode(" ", $style_array) . '"' : '';

            switch ( $pofo_list_style ) {

                case 'list-style-1':

                        $pofo_list_style1 = ! empty( $pofo_list_style1 ) ? $pofo_list_style1 : 0;
                        $pofo_list_style1 = $pofo_list_style1 + 1;

                        if( ! empty( $pofo_link_color ) ) {
                            $pofo_featured_array[] = '.list-style1-'.$pofo_list_style1.' li a { '.$pofo_link_color.' }';
                        }

                        if( ! empty( $pofo_link_hover_color ) ) {
                            $pofo_featured_array[] = '.list-style1-'.$pofo_list_style1.' li a:hover { '.$pofo_link_hover_color.' }';
                        }

                        $output .= '<ul'.$id.' class="list-style-1 list-style1-'.$pofo_list_style1.' '.esc_attr( $class_list ).'"'.$style_list.'>';
                            foreach ($pofo_list_values as $values) {
                                if( ! empty( $values->pofo_list_value ) ){
                                    $output .= '<li class="margin-10px-bottom">'.$values->pofo_list_value.'</li>';
                                }
                            }
                        $output .= '</ul>';
                break;

                case 'list-style-2':

                        $pofo_list_style2 = ! empty( $pofo_list_style2 ) ? $pofo_list_style2 : 0;
                        $pofo_list_style2 = $pofo_list_style2 + 1;

                        if( ! empty( $pofo_text_color ) ) {
                            $pofo_featured_array[] = '.list-style2-'.$pofo_list_style2.' li i { '.$pofo_text_color.' }';
                        }

                        if( ! empty( $pofo_link_color ) ) {
                            $pofo_featured_array[] = '.list-style2-'.$pofo_list_style2.' li a { '.$pofo_link_color.' }';
                        }

                        if( ! empty( $pofo_link_hover_color ) ) {
                            $pofo_featured_array[] = '.list-style2-'.$pofo_list_style2.' li a:hover { '.$pofo_link_hover_color.' }';
                        }

                        $output .= '<ul'.$id.' class="no-padding list-style-10 list-style2-'.$pofo_list_style2.' '.esc_attr( $class_list ).'"'.$style_list.'>';
                            foreach ($pofo_list_values as $values) {
                                if( ! empty( $values->pofo_list_value ) ){
                                    $output .= '<li'.$pofo_border_color.'><i class="fas fa-arrow-right text-extra-dark-gray" aria-hidden="true"></i><span>'.$values->pofo_list_value.'</span></li>';
                                }
                            }
                        $output .= '</ul>';
                break;
                
                case 'list-style-3':

                        $pofo_list_style3 = ! empty( $pofo_list_style3 ) ? $pofo_list_style3 : 0;
                        $pofo_list_style3 = $pofo_list_style3 + 1;

                        if( ! empty( $pofo_text_color ) ) {
                            $pofo_featured_array[] = '.list-style3-'.$pofo_list_style3.' li::before { background-'.$pofo_text_color.' }';
                        }

                        if( ! empty( $pofo_link_color ) ) {
                            $pofo_featured_array[] = '.list-style3-'.$pofo_list_style3.' li a { '.$pofo_link_color.' }';
                        }

                        if( ! empty( $pofo_link_hover_color ) ) {
                            $pofo_featured_array[] = '.list-style3-'.$pofo_list_style3.' li a:hover { '.$pofo_link_hover_color.' }';
                        }

                        if( ! empty( $pofo_bulleting_color_style_3 ) ) {
                            $pofo_featured_array[] = '.list-style3-'.$pofo_list_style3.' li::before { '.$pofo_bulleting_color_style_3.' }';
                        }

                        $output .= '<ul'.$id.' class="text-medium list-style-3 list-style3-'.$pofo_list_style3.' '.esc_attr( $class_list ).'"'.$style_list.'>';
                            foreach ($pofo_list_values as $values) {
                                if( ! empty( $values->pofo_list_value ) ){
                                    $output .= '<li>'.$values->pofo_list_value.'</li>';
                                }
                            }
                        $output .= '</ul>';
                break;
                
                case 'list-style-4':

                        $pofo_list_style4 = ! empty( $pofo_list_style4 ) ? $pofo_list_style4 : 0;
                        $pofo_list_style4 = $pofo_list_style4 + 1;

                        if( ! empty( $pofo_link_color ) ) {
                            $pofo_featured_array[] = '.list-style4-'.$pofo_list_style4.' li a { '.$pofo_link_color.' }';
                        }

                        if( ! empty( $pofo_link_hover_color ) ) {
                            $pofo_featured_array[] = '.list-style4-'.$pofo_list_style4.' li a:hover { '.$pofo_link_hover_color.' }';
                        }

                        if( ! empty( $pofo_bulleting_color ) ) {
                            $pofo_featured_array[] = '.list-style4-'.$pofo_list_style4.' li::before { '.$pofo_bulleting_color.' }';
                        }

                        $output .= '<ul'.$id.' class="no-padding list-style-4 list-style4-'.$pofo_list_style4.' '.esc_attr( $class_list ).'"'.$style_list.'>';
                            foreach ($pofo_list_values as $values) {
                                if( ! empty( $values->pofo_list_value ) ){
                                    $output .= '<li'.$pofo_border_color.'>'.$values->pofo_list_value.'</li>';
                                }
                            }
                        $output .= '</ul>';
                break;
                
                case 'list-style-5':

                        $pofo_list_style5 = ! empty( $pofo_list_style5 ) ? $pofo_list_style5 : 0;
                        $pofo_list_style5 = $pofo_list_style5 + 1;

                        if( ! empty( $pofo_text_color ) ) {
                            $pofo_featured_array[] = '.list-style5-'.$pofo_list_style5.' li::before { '.$pofo_text_color.' }';
                        }

                        if( ! empty( $pofo_link_color ) ) {
                            $pofo_featured_array[] = '.list-style5-'.$pofo_list_style5.' li a { '.$pofo_link_color.' }';
                        }

                        if( ! empty( $pofo_link_hover_color ) ) {
                            $pofo_featured_array[] = '.list-style5-'.$pofo_list_style5.' li a:hover { '.$pofo_link_hover_color.' }';
                        }

                        if( ! empty( $pofo_bulleting_color ) ) {
                            $pofo_featured_array[] = '.list-style5-'.$pofo_list_style5.' li::before { '.$pofo_bulleting_color.' }';
                        }

                        $output .= '<ul'.$id.' class="no-padding list-style-5 list-style5-'.$pofo_list_style5.' '.esc_attr( $class_list ).'"'.$style_list.'>';
                            foreach ($pofo_list_values as $values) {
                                if( ! empty( $values->pofo_list_value ) ){
                                    $output .= '<li'.$pofo_border_color.'>'.$values->pofo_list_value.'</li>';
                                }
                            }
                        $output .= '</ul>';
                break;
                
                case 'list-style-6':

                        $pofo_list_style6 = ! empty( $pofo_list_style6 ) ? $pofo_list_style6 : 0;
                        $pofo_list_style6 = $pofo_list_style6 + 1;

                        if( ! empty( $pofo_link_color ) ) {
                            $pofo_featured_array[] = '.list-style6-'.$pofo_list_style6.' li a { '.$pofo_link_color.' }';
                        }

                        if( ! empty( $pofo_link_hover_color ) ) {
                            $pofo_featured_array[] = '.list-style6-'.$pofo_list_style6.' li a:hover { '.$pofo_link_hover_color.' }';
                        }

                        $output .= '<ul'.$id.' class="list-style-6 list-style6-'.$pofo_list_style6.' '.esc_attr( $class_list ).'"'.$style_list.'>';
                            foreach ($pofo_list_values as $values) {
                                if( ! empty( $values->pofo_list_value ) ){
                                    $output .= '<li'.$pofo_border_color.'>'.$values->pofo_list_value.'</li>';
                                }
                            }
                        $output .= '</ul>';
                break;

                case 'list-style-7':

                        $pofo_list_style7 = ! empty( $pofo_list_style7 ) ? $pofo_list_style7 : 0;
                        $pofo_list_style7 = $pofo_list_style7 + 1;

                        if( ! empty( $pofo_link_color ) ) {
                            $pofo_featured_array[] = '.list-style7-'.$pofo_list_style7.' li a { '.$pofo_link_color.' }';
                        }

                        if( ! empty( $pofo_link_hover_color ) ) {
                            $pofo_featured_array[] = '.list-style7-'.$pofo_list_style7.' li a:hover { '.$pofo_link_hover_color.' }';
                        }

                        $output .= '<ul'.$id.' class="list-style-9 margin-twelve-left text-extra-dark-gray list-style7-'.$pofo_list_style7.' '.esc_attr( $class_list ).'"'.$style_list.'>';
                            foreach ($pofo_list_values as $values) {
                                if( ! empty( $values->pofo_list_value ) || ! empty( $values->pofo_list_subtitle ) ){
                                    $output .= '<li'.$pofo_border_color.'>';
                                        if( ! empty( $values->pofo_list_subtitle ) ) {
                                            $output .= '<span class="display-block text-extra-small text-medium-gray"'.$pofo_subtitle_color.'>'.$values->pofo_list_subtitle.'</span>';
                                        }
                                        if( ! empty( $values->pofo_list_value ) ) {
                                            $output .= $values->pofo_list_value;
                                        }
                                    $output .= '</li>';
                                }
                            }
                        $output .= '</ul>';
                break;

                case 'list-style-8':

                        $pofo_list_style8 = ! empty( $pofo_list_style8 ) ? $pofo_list_style8 : 0;
                        $pofo_list_style8 = $pofo_list_style8 + 1;

                        if( ! empty( $pofo_link_color ) ) {
                            $pofo_featured_array[] = '.list-style8-'.$pofo_list_style8.' li a { '.$pofo_link_color.' }';
                        }

                        if( ! empty( $pofo_link_hover_color ) ) {
                            $pofo_featured_array[] = '.list-style8-'.$pofo_list_style8.' li a:hover { '.$pofo_link_hover_color.' }';
                        }

                        $output .= '<ul'.$id.' class="list-style-12 list-style8-'.$pofo_list_style8.' '.esc_attr( $class_list ).'"'.$style_list.'>';
                            foreach ($pofo_list_values as $values) {
                                if( ! empty( $values->pofo_list_value ) ){
                                    $output .= '<li>'.$values->pofo_list_value.'</li>';
                                }
                            }
                        $output .= '</ul>';
                break;
                
                default:
                break;
            }

                

        }
        return $output;
    }
}
add_shortcode( 'pofo_lists', 'pofo_lists_shortcode' );