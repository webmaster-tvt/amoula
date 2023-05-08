<?php
/**
 * Shortcode Map For Row
 *
 * @package Pofo
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Row */
/*-----------------------------------------------------------------------------------*/

  vc_map( 
    array(
        'name' => esc_html__( 'Row' , 'pofo-addons' ),
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'show_settings_on_create' => false,
        'class' => 'vc_main-sortable-element',
        'description' => esc_html__( 'Place content elements inside the section', 'pofo-addons' ),
        'base' => 'vc_row',
        'js_view' => 'VcRowView',
        'category' => 'Pofo',
        'params' => array(
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Row stretch', 'pofo-addons' ),
              'param_name' => 'full_width',
              'value' => array(
                esc_html__( 'Default', 'pofo-addons' ) => '',
                esc_html__( 'Container', 'pofo-addons' ) => 'container',
                esc_html__( 'Stretch row', 'pofo-addons' ) => 'stretch_row',
                esc_html__( 'Stretch row and content', 'pofo-addons' ) => 'stretch_row_content',
                esc_html__( 'Stretch row and content (no paddings)', 'pofo-addons' ) => 'stretch_row_content_no_spaces',
              ),
              'description' => esc_html__( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Columns gap', 'pofo-addons' ),
              'param_name' => 'gap',
              'value' => array(
                '0px' => '0',
                '1px' => '1',
                '2px' => '2',
                '3px' => '3',
                '4px' => '4',
                '5px' => '5',
                '10px' => '10',
                '15px' => '15',
                '20px' => '20',
                '25px' => '25',
                '30px' => '30',
                '35px' => '35',
              ),
              'std' => '0',
              'description' => esc_html__( 'Select gap between columns in row.', 'pofo-addons' ),
            ),
            array(
              'type' => 'checkbox',
              'heading' => esc_html__( 'Full height row?', 'pofo-addons' ),
              'param_name' => 'full_height',
              'description' => esc_html__( 'If checked row will be set to full height.', 'pofo-addons' ),
              'value' => array( esc_html__( 'Yes', 'pofo-addons' ) => 'yes' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Columns position', 'pofo-addons' ),
              'param_name' => 'columns_placement',
              'value' => array(
                esc_html__( 'Middle', 'pofo-addons' ) => 'middle',
                esc_html__( 'Top', 'pofo-addons' ) => 'top',
                esc_html__( 'Bottom', 'pofo-addons' ) => 'bottom',
                esc_html__( 'Stretch', 'pofo-addons' ) => 'stretch',
              ),
              'std' => 'middle',
              'description' => esc_html__( 'Select columns position within row.', 'pofo-addons' ),
              'dependency' => array(
                'element' => 'full_height',
                'not_empty' => true,
              ),
            ),
            array(
              'type' => 'checkbox',
              'heading' => esc_html__( 'Equal height', 'pofo-addons' ),
              'param_name' => 'equal_height',
              'description' => esc_html__( 'If checked columns will be set to equal height.', 'pofo-addons' ),
              'value' => array( esc_html__( 'Yes', 'pofo-addons' ) => 'yes' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Content position', 'pofo-addons' ),
              'param_name' => 'content_placement',
              'value' => array(
                esc_html__( 'Default', 'pofo-addons' ) => '',
                esc_html__( 'Top', 'pofo-addons' ) => 'top',
                esc_html__( 'Middle', 'pofo-addons' ) => 'middle',
                esc_html__( 'Bottom', 'pofo-addons' ) => 'bottom',
              ),
              'description' => esc_html__( 'Select content position within columns.', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Parallax', 'pofo-addons' ),
              'param_name' => 'parallax',
              'value' => array(
                esc_html__( 'None', 'pofo-addons' ) => '',
                esc_html__( 'Simple', 'pofo-addons' ) => 'content-moving',
              ),
              'description' => esc_html__( 'Add parallax type background for row (Note: Parallax will use background image from Design Options).', 'pofo-addons' ),
              'dependency' => array(
                'element' => 'video_bg',
                'is_empty' => true,
              ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Parallax background ratio', 'pofo-addons' ),
              'param_name' => 'parallax_ratio_bg',
              'value' => '0.5',
              'description' => esc_html__( 'Enter parallax background ratio', 'pofo-addons' ),
              'dependency' => array(
                'element' => 'parallax',
                'not_empty' => true,
              ),
            ),
            array(
              'type' => 'checkbox',
              'heading' => esc_html__( 'Disable row', 'pofo-addons' ),
              'param_name' => 'disable_element',
              // Inner param name.
              'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'pofo-addons' ),
              'value' => array( esc_html__( 'Yes', 'pofo-addons' ) => 'yes' ),
            ),
            array(
                'type' => 'pofo_custom_switch_option',
                'holder' => 'div',
                'class' => '',
                'heading' => esc_html__( 'Position relative', 'pofo-addons'),
                'param_name' => 'position_relative',
                'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
                                 esc_html__( 'On', 'pofo-addons') => '1'
                                ),
            ),
            array(
              'type' => 'dropdown',
              'param_name' => 'pofo_overflow_type', 
              'heading' => esc_html__( 'Overflow', 'pofo-addons' ),
              'value' => array(esc_html__('Select overflow', 'pofo-addons') => '',
                               esc_html__('Overflow visible', 'pofo-addons') => 'overflow-visible',
                               esc_html__('Overflow hidden', 'pofo-addons') => 'overflow-hidden',
                               esc_html__('Overflow auto', 'pofo-addons') => 'overflow-auto',
                              ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__( 'Add margin top of header height', 'pofo-addons'),
              'param_name' => 'pofo_enable_menu_top_space',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'description' => __( 'This can be switched on mainly for top row if page title is switched off and you want to move the row content down.', 'pofo-addons' ),
            ),
            array(
              'type' => 'animation_style',
              'heading' => esc_html__( 'CSS animation', 'pofo-addons' ),
              'param_name' => 'initial_loading_animation',
              'admin_label' => true,
              'value' => '',
              'settings' => array(
                'type' => array(
                  'in',
                  'other',
                ),
              ),
              'description' => __( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'pofo-addons' ),
            ),
            array(
              'type' => 'checkbox',
              'heading' => esc_html__( 'Use video background?', 'pofo-addons' ),
              'param_name' => 'video_bg',
              'description' => esc_html__( 'If checked, video will be used as row background.', 'pofo-addons' ),
              'value' => array( esc_html__( 'Yes', 'pofo-addons' ) => 'yes' ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__( 'Video type', 'pofo-addons'),
              'param_name' => 'pofo_video_type',
              'value' => array(esc_html__( 'Self', 'pofo-addons') => '',
                               esc_html__( 'YouTube', 'pofo-addons') => 'youtube',
                               esc_html__( 'Vimeo', 'pofo-addons') => 'vimeo'
                              ),
              'dependency' => array(
                'element' => 'video_bg',
                'not_empty' => true,
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'attach_image',
              'heading' => esc_html__( 'Image', 'pofo-addons' ),
              'param_name' => 'parallax_image',
              'value' => '',
              'description' => esc_html__( 'This image will be visible instead of autoplay backgound video in some mobile / tablet device due to their operating system restrictions.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_video_type', 'value' => array('') ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Vimeo', 'pofo-addons' ),
              'param_name' => 'vimeo_bg_url',
              'value' => 'https://player.vimeo.com/video/75976293',
              // default video url
              'description' => sprintf( __( '<a target="_blank" href="%s">Click here</a> for more information on video ID / embed URL and setting parameters.', 'pofo-addons' ), 'https://pofo.themezaa.com/documentation/knowledgebase/miscellaneous/how-to-manage-youtube-and-vimeo-video-parameters/' ),
              'dependency' => array(
                'element' => 'pofo_video_type',
                'value' => 'vimeo',
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'YouTube', 'pofo-addons' ),
              'param_name' => 'youtube_bg_url',
              'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
              // default video url
              'description' => sprintf( __( '<a target="_blank" href="%s">Click here</a> for more information on video ID / embed URL and setting parameters.', 'pofo-addons' ), 'https://pofo.themezaa.com/documentation/knowledgebase/miscellaneous/how-to-manage-youtube-and-vimeo-video-parameters/' ),
              'dependency' => array(
                'element' => 'pofo_video_type',
                'value' => 'youtube',
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Parallax', 'pofo-addons' ),
              'param_name' => 'video_bg_parallax',
              'value' => array(
                esc_html__( 'None', 'pofo-addons' ) => '',
                esc_html__( 'Simple', 'pofo-addons' ) => 'content-moving',
                esc_html__( 'With fade', 'pofo-addons' ) => 'content-moving-fade',
              ),
              'description' => esc_html__( 'Add parallax type background for row.', 'pofo-addons' ),
              'dependency' => array(
                'element' => 'pofo_video_type',
                'value' => 'youtube',
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Parallax video speed', 'pofo-addons' ),
              'param_name' => 'parallax_speed_video',
              'value' => '1.5',
              'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'pofo-addons' ),
              'dependency' => array(
                'element' => 'video_bg_parallax',
                'not_empty' => true,
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__('MP4', 'pofo-addons'),
              'param_name' => 'pofo_background_mp4_video',
              'dependency' => array(
                'element' => 'pofo_video_type', // parallax
                'is_empty' => true,
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__('WEBM', 'pofo-addons'),
              'param_name' => 'pofo_background_webm_video',
              'dependency' => array(
                'element' => 'pofo_video_type', // parallax
                'is_empty' => true,
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ), 
            array(
              'type' => 'textfield',
              'heading' => esc_html__('OGG', 'pofo-addons'),
              'param_name' => 'pofo_background_ogg_video',
              'dependency' => array(
                'element' => 'pofo_video_type', // parallax
                'is_empty' => true,
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ), 
            array(
              'type' => 'pofo_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__('Loop video', 'pofo-addons'),
              'param_name' => 'pofo_enable_loop',
              'value' => array(esc_html__('Off', 'pofo-addons') => '0', 
                               esc_html__('On', 'pofo-addons') => '1'
                              ),
              'std' => '1',
              'dependency' => array(
                'element' => 'pofo_video_type', // parallax
                'is_empty' => true,
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__('Mute', 'pofo-addons'),
              'param_name' => 'pofo_enable_mute',
              'value' => array(esc_html__('Off', 'pofo-addons') => '0', 
                               esc_html__('On', 'pofo-addons') => '1'
                              ),
              'dependency' => array(
                'element' => 'pofo_video_type', // parallax
                'is_empty' => true,
              ),
              'group' => esc_html__( 'Background Video', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__( 'Overlay', 'pofo-addons'),
              'param_name' => 'show_overlay',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'group' => esc_html__( 'Overlay', 'pofo-addons' ),
            ),
            array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => esc_html__( 'Overlay color', 'pofo-addons' ),
              'param_name' => 'pofo_row_overlay_color',
              'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
              'group' => esc_html__( 'Overlay', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Overlay opacity', 'pofo-addons'),
              'param_name' => 'pofo_overlay_opacity',
              'value' => array( esc_html__( 'No opacity','pofo-addons') => '',
                                '0.1'  => '0.1',
                                '0.2'  => '0.2',
                                '0.3'  => '0.3',
                                '0.4'  => '0.4',
                                '0.5'  => '0.5',
                                '0.6'  => '0.6',
                                '0.7'  => '0.7',
                                '0.8'  => '0.8',
                                '0.9'  => '0.9',
                                '1.0'  => '1.0',
                              ),
              'std' => '0.7',
              'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
              'group' => esc_html__( 'Overlay', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Z-index', 'pofo-addons'),
              'param_name' => 'pofo_z_index',
              'dependency' => array( 'element' => 'show_overlay', 'value' => array('1') ),
              'group' => esc_html__( 'Overlay', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__( 'Scroll to down icon', 'pofo-addons'),
              'param_name' => 'show_down_section',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Style', 'pofo-addons'),
              'param_name' => 'pofo_down_section_style',
              'value' => array( esc_html__( 'Select Style','pofo-addons') => '',
                                esc_html__( 'Style 1','pofo-addons') => 'down-section-style-1',
                                esc_html__( 'Style 2','pofo-addons') => 'down-section-style-2',
                                esc_html__( 'Style 3','pofo-addons') => 'down-section-style-3',
                              ),
              'std' => 'down-section-style-1',
              'dependency' => array( 'element' => 'show_down_section', 'value' => array('1') ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_preview_image',
              'heading' => esc_html__( 'Select pre-made style', 'pofo-addons'),
              'param_name' => 'pofo_down_section_preview_image',
              'value' => array( esc_html__( 'Select style','pofo-addons') => '',
                                esc_html__( 'Style 1','pofo-addons') => 'down-section-style-1',
                                esc_html__( 'Style 2','pofo-addons') => 'down-section-style-2',
                                esc_html__( 'Style 3','pofo-addons') => 'down-section-style-3',
                              ),
              'dependency' => array( 'element' => 'show_down_section', 'value' => array('1') ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Target section id', 'pofo-addons'),
              'param_name' => 'pofo_down_section_target_id',
              'dependency' => array( 'element' => 'show_down_section', 'value' => array('1') ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Scroll Text', 'pofo-addons'),
              'param_name' => 'pofo_down_scroll_text',
              'std' => esc_html__( 'SCROLL DOWN', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_down_section_style', 'value' => 'down-section-style-3' ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Verticle Separator Line', 'pofo-addons'),
              'param_name' => 'pofo_down_scroll_vertical_separator',
              'std' => '1',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                            ),
              'dependency' => array( 'element' => 'pofo_down_section_style', 'value' => 'down-section-style-3' ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
            array(
              'type' => 'colorpicker',
              'heading' => esc_html__( 'Verticle Separator Line Color', 'pofo-addons' ),
              'param_name' => 'pofo_down_scroll_vertical_separator_color',
              'std' => '#ff214f',
              'dependency' => array( 'element' => 'pofo_down_scroll_vertical_separator', 'value' => array('1') ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
      			array(
      			  'type' => 'pofo_custom_switch_option',
      			  'heading' => esc_html__( 'Animation', 'pofo-addons'),
      			  'param_name' => 'pofo_down_section_animation',
      			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
      			                   esc_html__( 'On', 'pofo-addons') => '1'
      			                ),
      			  'dependency' => array( 'element' => 'pofo_down_section_style', 'value' => array( 'down-section-style-1', 'down-section-style-2' ) ),
                    'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
      			),
      			array(
      			  'type' => 'pofo_custom_switch_option',
      			  'heading' => esc_html__( 'Custom icon image', 'pofo-addons'),
      			  'param_name' => 'pofo_down_section_custom_icon',
      			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
      			                   esc_html__( 'On', 'pofo-addons') => '1'
      			                ),
      			  'dependency' => array( 'element' => 'pofo_down_section_style', 'value' => array( 'down-section-style-1', 'down-section-style-2' ) ),
                    'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
      			),
      			array(
      			  'type' => 'attach_image',
      			  'heading' => esc_html__( 'Custom image', 'pofo-addons'),
      			  'param_name' => 'pofo_down_section_custom_icon_image',
      			  'dependency' => array( 'element' => 'pofo_down_section_custom_icon', 'value' => '1' ),
      			  'description' => esc_html__( 'Recommended size: Extra Large - 60px X 60px, Large - 50px X 50px, Extra Medium - 40px X 40px, Medium - 35px X 35px, Small - 24px X 24px, Extra Small - 16px X 16px', 'pofo-addons' ),
                    'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
      			),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Maximum width', 'pofo-addons' ),
              'param_name' => 'custom_icon_max_height',
              'dependency' => array( 'element' => 'pofo_down_section_custom_icon', 'value' => '1' ),
              'description' => esc_html__( 'In pixel like 40px.', 'pofo-addons' ),
            ),
      			array(
      			  'type' => 'pofo_icon',
      			  'heading' => esc_html__( 'Font icon', 'pofo-addons'),
      			  'param_name' => 'pofo_down_section_icon_list',
      			  'admin_label' => true,
      			  'dependency' => array( 'element' => 'pofo_down_section_custom_icon', 'value' => '0' ),
                    'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
      			),
      			array(
      			  'type' => 'dropdown',
      			  'heading' => esc_html__( 'Icon size', 'pofo-addons'),
      			  'param_name' => 'pofo_down_section_icon_size',
      			  'admin_label' => true,
      			  'value' => array(esc_html__( 'Default', 'pofo-addons') => '',
      			                 esc_html__( 'Extra large', 'pofo-addons') => 'icon-extra-large', 
      			                 esc_html__( 'Large', 'pofo-addons') => 'icon-large',
      			                 esc_html__( 'Extra medium', 'pofo-addons') => 'icon-extra-medium',
      			                 esc_html__( 'Medium', 'pofo-addons') => 'icon-medium',
      			                 esc_html__( 'Small', 'pofo-addons') => 'icon-small',
      			                 esc_html__( 'Extra small', 'pofo-addons') => 'icon-extra-small',
      			                ),
      			  'dependency' => array( 'element' => 'pofo_down_section_custom_icon', 'value' => '0' ),
      			  'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
      			),
      			array(
      			  'type' => 'colorpicker',
      			  'class' => '',
      			  'heading' => esc_html__( 'Icon color', 'pofo-addons' ),
      			  'param_name' => 'pofo_down_section_icon_color',
      			  'dependency' => array( 'element' => 'pofo_down_section_custom_icon', 'value' => '0' ),
      			  'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
      			),      
      			array(
      			  'type' => 'colorpicker',
      			  'class' => '',
      			  'heading' => esc_html__( 'Icon background color', 'pofo-addons' ),
      			  'param_name' => 'pofo_down_section_icon_bg_color',
      			  'dependency' => array( 'element' => 'pofo_down_section_style', 'value' => 'down-section-style-2'),
      			  'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
      			),
            array(
              'type' => 'pofo_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__( 'Change body color on scroll over this section', 'pofo-addons'),
              'param_name' => 'show_change_body_color',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
            array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => esc_html__( 'On scroll body color', 'pofo-addons' ),
              'param_name' => 'pofo_row_body_color',
              'std' => '#ff214f',
              'dependency' => array( 'element' => 'show_change_body_color', 'value' => array('1') ),
              'group' => esc_html__( 'Scroll Down', 'pofo-addons' ),
            ),
            array(
              'type' => 'css_editor',
              'heading' => esc_html__( 'CSS box', 'pofo-addons' ),
              'param_name' => 'css',
              'group' => esc_html__( 'Design Options', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'param_name' => 'pofo_bg_image_type', 
              'heading' => esc_html__( 'Background type', 'pofo-addons' ),
              'value' => array(esc_html__('Select background type', 'pofo-addons') => '',
                               esc_html__('Fix background', 'pofo-addons') => 'fix-background',
                               esc_html__('Cover background', 'pofo-addons') => 'cover-background',
                              ),
              'edit_field_class' => 'vc_col-sm-3 vc_column-with-padding',
              'group' => esc_html__( 'Design Options', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Background position', 'pofo-addons' ),
              'param_name' => 'desktop_bg_image_position',
              'value' => $pofo_desktop_bg_image_position,
              'edit_field_class' => 'vc_col-sm-3',
              'group' => esc_html__( 'Design Options', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Minimum height', 'pofo-addons' ),
              'param_name' => 'desktop_height',
              'value' => '',
              'edit_field_class' => 'vc_col-sm-3',
              'group' => esc_html__( 'Design Options', 'pofo-addons' ),
            ),
            array(
              'param_name' => 'pofo_custom_separator_heading', // all params must have a unique name
              'type' => 'pofo_custom_title', // this param type
              'value' => '', // your custom markup
              'group' => esc_html__( 'Design Options', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__( 'Enable responsive css box', 'pofo-addons'),
              'param_name' => 'pofo_enable_responsive_css',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'description' => esc_html__( 'This will enable mini dekstop, tablet and mobile css options.', 'pofo-addons' ),
              'group' => esc_html__( 'Design Options', 'pofo-addons' ),
            ),
            array(
              'type' => 'responsive_css_editor',
              'heading' => esc_html__( 'Responsive css box', 'pofo-addons' ),
              'param_name' => 'responsive_css',
              'width' => 'no',
              'dependency' => array( 'element' => 'pofo_enable_responsive_css', 'value' => array('1') ),
              'group' => esc_html__( 'Design Options', 'pofo-addons' ),
            ),
            $pofo_vc_extra_id,
            $pofo_vc_extra_class,
        ),
    )
  );