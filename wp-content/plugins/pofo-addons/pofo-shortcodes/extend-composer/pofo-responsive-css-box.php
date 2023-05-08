<?php
/**
 * Pofo Responsive CSS Box For VC.
 *
 * @package Pofo
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

function pofo_addons_get_responsive_style( $responsive_css, $responsive_id ) {

    return Pofo_Responsive_CSS_Style::get_css_style( $responsive_css, $responsive_id );
}

if( ! class_exists( 'Pofo_Responsive_CSS_Style' ) ) {

    class Pofo_Responsive_CSS_Style  {
        
        /**
         * @var array
         */
        protected $layers = array( 'margin', 'border', 'padding', 'content' );
        /**
         * @var array
         */
        protected $positions = array( 'top', 'right', 'bottom', 'left' );
        /**
         * @var array
         */
        protected $devices = array( 'desktop', 'tablet', 'mobile' );
        
        
        function __construct() {

            if ( function_exists( 'vc_add_shortcode_param' ) ) {
                vc_add_shortcode_param('responsive_css_editor', array( $this, 'custom_responsive_css_settings_field' ), POFO_ADDONS_ROOT_DIR . '/pofo-shortcodes/js/responsive-css-script.js' );
            }
        }

        function custom_responsive_css_settings_field( $settings, $value ) {
            
            $output = $inner_output = '';

            $label  = isset( $settings['label'] ) ? $settings['label'] : esc_html__( 'Responsive Options', 'pofo-addons' );
            $height = isset( $settings['height'] ) ? $settings['height'] : '';
            $width  = isset( $settings['width'] ) ? $settings['width'] : '';

            $values = $this->get_responsive_css_values( $value, $height, $width );

            $output .= '<div class="pofo-responsive-css-container vc_css-editor vc_row vc_ui-flex-row">';
            $devices_icons = array( '<i class="fas fa-laptop" aria-hidden="true"></i>', '<i class="fas fa-tablet-alt rotate-tablet" aria-hidden="true"></i>', '<i class="fas fa-mobile-alt" aria-hidden="true"></i>' );    
            $devices = $this->devices;
            $i = 0;

                $output .= '<div class="pofo-responsive-title-wrapper">';
                    foreach( $devices as $device ) {
                        $title = ( $device == 'desktop' ) ? esc_html__( 'Mini Desktop', 'pofo-addons' ) : esc_html__( ucfirst( $device ), 'pofo-addons' );
                        $active = ( $i == 0 ) ? ' active' : '';
                        $output .= '<h3 class="pofo-responsive-css-heading '.$device.$active.'" data-device="'.$device.'-device">' . $devices_icons[$i]  . $title .'</h3>';
                        $i++;

                        $inner_output .= '<div class="pofo-main-responsive-wrapper '.$device.'-device'.$active.'">';
                            $inner_output .= '<div class="pofo-inner-wrap">';
                                $inner_output .=  $this->onionLayout( $device, $values ); 
                            $inner_output .= '</div>';
                        $inner_output .= '</div>';
                    };
                $output .= '</div>';

            $output .= $inner_output;
            
            $output .= '</div>';
            $output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value  ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" />';
            
            return $output;
        }
        
        public static function get_responsive_css_values( $value, $height = '', $width = '' ) {

            $responsive_settings = array( 'margin_top_desktop' => '', 'margin_right_desktop' => '', 'margin_bottom_desktop' => '', 'margin_left_desktop' => '', 'border_top_desktop' => '', 'border_right_desktop' => '', 'border_bottom_desktop' => '', 'border_left_desktop' => '', 'padding_top_desktop' => '', 'padding_right_desktop' => '', 'padding_bottom_desktop' => '', 'padding_left_desktop' => '', 'margin_top_tablet' => '', 'margin_right_tablet' => '', 'margin_bottom_tablet' => '', 'margin_left_tablet' => '', 'border_top_tablet' => '', 'border_right_tablet' => '', 'border_bottom_tablet' => '', 'border_left_tablet' => '', 'padding_top_tablet' => '', 'padding_right_tablet' => '', 'padding_bottom_tablet' => '', 'padding_left_tablet' => '', 'margin_top_mobile' => '', 'margin_right_mobile' => '', 'margin_bottom_mobile' => '', 'margin_left_mobile' => '', 'border_top_mobile' => '', 'border_right_mobile' => '', 'border_bottom_mobile' => '', 'border_left_mobile' => '', 'padding_top_mobile' => '', 'padding_right_mobile' => '', 'padding_bottom_mobile' => '', 'padding_left_mobile' => '', 'background_position_desktop' => '', 'background_position_tablet' => '', 'background_position_mobile' => '', 'hide_image_desktop' => '', 'hide_image_tablet' => '', 'hide_image_mobile' => '' );

            if( $height != 'no' ) {
                $responsive_settings['height_desktop'] = '';
                $responsive_settings['height_tablet'] = '';
                $responsive_settings['height_mobile'] = '';
            }
            if( $width != 'no' ) {
                $responsive_settings['width_desktop'] = '';
                $responsive_settings['width_tablet'] = '';
                $responsive_settings['width_mobile'] = '';
            }

            return vc_parse_multi_attribute( $value, $responsive_settings );
        }

        /**
         * @return string
         */
        function onionLayout( $prefix = '', $values = array() ) {

            $output = '';

            $bg_position_value = ! empty( $values['background_position' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] ) ? $values['background_position' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] : '';
            $hide_image_value = ! empty( $values['hide_image' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] ) ? $values['hide_image' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] : '';
            $height_value = ! empty( $values['height' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] ) ? $values['height' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] : '';
            $width_value = ! empty( $values['width' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] ) ? $values['width' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] : '';

            $output .= '<div class="vc_layout-onion vc_col-xs-7">';
                $output .= '<div class="vc_margin">' . $this->layerControls( 'margin', $prefix, $values );
                    $output .= '<div class="vc_border">' . $this->layerControls( 'border', $prefix, $values );
                        $output .= '<div class="vc_padding">' . $this->layerControls( 'padding', $prefix, $values );
                            $output .= '<div class="vc_content"><i></i></div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            
            $output .= '<div class="vc_col-xs-5 vc_settings">';
                $output .= '   <label>'.esc_html__( 'Background position', 'pofo-addons' ).'</label>'
                        . '  <div class="vc_background-position">'
                        . '    <select name="background_position' . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="background-position' . ( '' !== $prefix ? '-' . $prefix : '' ) . '">'
                        . '      <option value="" '.selected( '', $bg_position_value, false ).'>'.esc_html__( 'Default', 'pofo-addons' ).'</option>'
                        . '          <option value="left-top" '.selected( 'left-top', $bg_position_value, false ).'>'.esc_html__( 'Left Top', 'pofo-addons' ).'</option>'
                        . '          <option value="left-center" '.selected( 'left-center', $bg_position_value, false ).'>'.esc_html__( 'Left Middle', 'pofo-addons' ).'</option>'
                        . '          <option value="left-bottom" '.selected( 'left-bottom', $bg_position_value, false ).'>'.esc_html__( 'Left Bottom', 'pofo-addons' ).'</option>'
                        . '          <option value="center-top" '.selected( 'center-top', $bg_position_value, false ).'>'.esc_html__( 'Center Top', 'pofo-addons' ).'</option>'
                        . '          <option value="center-center" '.selected( 'center-center', $bg_position_value, false ).'>'.esc_html__( 'Center Middle', 'pofo-addons' ).'</option>'
                        . '          <option value="center-bottom" '.selected( 'center-bottom', $bg_position_value, false ).'>'.esc_html__( 'Center Bottom', 'pofo-addons' ).'</option>'
                        . '          <option value="right-top" '.selected( 'right-top', $bg_position_value, false ).'>'.esc_html__( 'Right Top', 'pofo-addons' ).'</option>'
                        . '          <option value="right-center" '.selected( 'right-center', $bg_position_value, false ).'>'.esc_html__( 'Right Middle', 'pofo-addons' ).'</option>'
                        . '          <option value="right-bottom" '.selected( 'right-bottom', $bg_position_value, false ).'>'.esc_html__( 'Right Bottom', 'pofo-addons' ).'</option>'
                        . '    </select>'
                        . '  </div>';
                $output .= '   <label>'.esc_html__( 'Hide image', 'pofo-addons' ).'</label>'
                        . '  <div class="vc_hide-image">'
                        . '    <select name="hide_image' . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="hide-image' . ( '' !== $prefix ? '-' . $prefix : '' ) . '">'
                        . '      <option value="" '.selected( '', $hide_image_value, false ).'>'.esc_html__( 'No', 'pofo-addons' ).'</option>'
                        . '      <option value="1" '.selected( '1', $hide_image_value, false ).'>'.esc_html__( 'Yes', 'pofo-addons' ).'</option>'
                        . '    </select>'
                        . '  </div>';
            if( isset( $values['height' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] ) ) {
                $output .= '   <label>'.esc_html__( 'Minimum height', 'pofo-addons' ).'</label>'
                        . '  <div class="vc_height">'
                        . '    <input type="text" name="height' . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="height' . ( '' !== $prefix ? '-' . $prefix : '' ) . '" value="'.$height_value.'" />'
                        . '  </div>';
            }
            if( isset( $values['width' . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] ) ) {
                $output .= '   <label>'.esc_html__( 'Width', 'pofo-addons' ).'</label>'
                        . '  <div class="vc_width">'
                        . '    <input type="text" name="width' . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="width' . ( '' !== $prefix ? '-' . $prefix : '' ) . '" value="'.$width_value.'" />'
                        . '  </div>';
            }
            $output .= '</div>';
            

            return $output;
        }
        
        /**
         * @param $name
         * @param string $prefix
         *
         * @return string
         */
        protected function layerControls( $name, $prefix = '', $values = array() ) {

            $output = '<label>' . $name . '</label>';

            foreach ( $this->positions as $pos ) {
                $output .= '<input type="text" name="' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="' . $name . '-' . $pos . ( '' !== $prefix ? '-' . $prefix : '' ) . '" class="vc_' . $pos . '" placeholder="-" value="' .  $values['' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . ''] . '">';
            }

            return $output;
        
        }
        
        public static function get_css_style( $value, $id = '' ) {
            
            if( empty( $value ) ){
                return;
            }
            
            $values = Pofo_Responsive_CSS_Style::get_responsive_css_values( $value );
            $resolutions = array( 'desktop', 'tablet', 'mobile' );
            $positions = array( 'top', 'right', 'bottom', 'left' );
            $atts = array( 'margin', 'padding', 'border' );
            $media_query = array(
                'desktop' => '@media (max-width: 1199px)',
                'tablet'  => '@media (max-width: 991px)',
                'mobile'  => '@media (max-width: 767px)',
            );
            
            $res_css = '';
            $res_style = array( 'desktop' => '', 'tablet' => '', 'mobile' => '' );

            foreach ( $atts as $attr ) {
                foreach( $positions as $pos ) {

                    if(  isset( $values['' . $attr . '_' . $pos .'_desktop'] ) && $values['' . $attr . '_' . $pos .'_desktop'] != '' ) {
                        if( 'border' === $attr ){
                            $res_style['desktop'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_desktop'] . ' !important; '; 
                        }
                        else {
                            $res_style['desktop'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_desktop'] . ' !important; ';
                        }
                    } 
                    if(  isset( $values['' . $attr . '_' . $pos .'_tablet'] ) && $values['' . $attr . '_' . $pos .'_tablet'] != '' ) {
                        if( 'border' === $attr ){
                            $res_style['tablet'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_tablet'] . ' !important; ';   
                        }
                        else {
                            $res_style['tablet'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_tablet'] . ' !important; ';
                        }
                    } 
                    if(  isset( $values['' . $attr . '_' . $pos .'_mobile'] ) && $values['' . $attr . '_' . $pos .'_mobile'] != '' ) {
                        if( 'border' === $attr ){
                            $res_style['mobile'] .= $attr . '-' . $pos . '-width:' . $values['' . $attr . '_' . $pos .'_mobile'] . ' !important; ';                           
                        }
                        else {
                            $res_style['mobile'] .= $attr . '-' . $pos . ':' . $values['' . $attr . '_' . $pos .'_mobile'] . ' !important; '; 
                        }
                    }
                }
            }     

            // Background Position
            if(  isset( $values['background_position_desktop'] ) && $values['background_position_desktop'] != '' ) {
                $res_style['desktop'] .= 'background-position:' . ( str_replace('-', ' ', $values['background_position_desktop']) ) . ' !important; ';
            }
            if(  isset( $values['background_position_tablet'] ) && $values['background_position_tablet'] != '' ) {
                $res_style['tablet'] .= 'background-position:' . ( str_replace('-', ' ', $values['background_position_tablet']) ) . ' !important; ';
            }
            if(  isset( $values['background_position_mobile'] ) && $values['background_position_mobile'] != '' ) {
                $res_style['mobile'] .= 'background-position:' . ( str_replace('-', ' ', $values['background_position_mobile']) ) . ' !important; ';
            }

            // Hide Background Image
            if(  isset( $values['hide_image_desktop'] ) && $values['hide_image_desktop'] == '1' ) {
                $res_style['desktop'] .= 'background-image: none !important; ';
            }
            if(  isset( $values['hide_image_tablet'] ) && $values['hide_image_tablet'] == '1' ) {
                $res_style['tablet'] .= 'background-image: none !important; ';
            }
            if(  isset( $values['hide_image_mobile'] ) && $values['hide_image_mobile'] == '1' ) {
                $res_style['mobile'] .= 'background-image: none !important; ';
            }

            // Height
            if(  isset( $values['height_desktop'] ) && $values['height_desktop'] != '' ) {
                $res_style['desktop'] .= 'min-height: '.$values['height_desktop'].' !important; ';
            }
            if(  isset( $values['height_tablet'] ) && $values['height_tablet'] != '' ) {
                $res_style['tablet'] .= 'min-height: '.$values['height_tablet'].' !important; ';
            }
            if(  isset( $values['height_mobile'] ) && $values['height_mobile'] != '' ) {
                $res_style['mobile'] .= 'min-height: '.$values['height_mobile'].' !important; ';
            }

            // Width
            if(  isset( $values['width_desktop'] ) && $values['width_desktop'] != '' ) {
                $res_style['desktop'] .= 'width: '.$values['width_desktop'].' !important; ';
            }
            if(  isset( $values['width_tablet'] ) && $values['width_tablet'] != '' ) {
                $res_style['tablet'] .= 'width: '.$values['width_tablet'].' !important; ';
            }
            if(  isset( $values['width_mobile'] ) && $values['width_mobile'] != '' ) {
                $res_style['mobile'] .= 'width: '.$values['width_mobile'].' !important; ';
            }

            // Dynamic Media Query
            if( isset( $res_style['desktop'] ) && $res_style['desktop'] !== '' ) {
                $res_css .= $media_query['desktop'] . ' { '. '.' . $id . ' {' . $res_style['desktop'] . ' }  } ';
            }
            if( isset( $res_style['tablet'] ) && $res_style['tablet'] !== '' ) {
                $res_css .= $media_query['tablet'] . ' { '. '.' . $id . ' {' . $res_style['tablet'] . ' }  } ';
            }
            if( isset( $res_style['mobile'] ) && $res_style['mobile'] !== '' ) {
                $res_css .= $media_query['mobile'] . ' { '. '.' . $id . ' {' . $res_style['mobile'] . ' }  } ';
            }

            return $res_css;        
        }
    }
}

new Pofo_Responsive_CSS_Style;