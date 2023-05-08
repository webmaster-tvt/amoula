<?php
/**
 * Shortcode Map For Blockquote
 *
 * @package Pofo
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Blockquote */
/*-----------------------------------------------------------------------------------*/

    vc_map( array(
        'name' => esc_html__( 'Blockquote' , 'pofo-addons' ), //Name of your shortcode for human reading inside element list
        'base' => 'pofo_blockquote', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
        'class' => '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
        'icon' => 'fas fa-quote-left pofo-shortcode-icon', //URL or CSS class with icon image.
        'category' => 'Pofo',
        'params' => array( //List of shortcode attributes. Array which holds your shortcode params, these params will be editable in shortcode settings page
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Style', 'pofo-addons' ),
              'param_name' => 'pofo_blockquote_style',
              'admin_label' => true,
              'value' => array( esc_html__( 'Select style', 'pofo-addons') => '',
                                esc_html__( 'Style 1', 'pofo-addons') => 'blockquote-style-1',
                                esc_html__( 'Style 2', 'pofo-addons') => 'blockquote-style-2',
                                esc_html__( 'Style 3', 'pofo-addons') => 'blockquote-style-3',
                              ),
            ),
            array(
              'type' => 'pofo_preview_image',
              'heading' => esc_html__( 'Select pre-made style for blockquote', 'pofo-addons' ),
              'param_name' => 'pofo_blockquote_preview_image',
              'admin_label' => true,
              'value' => array( esc_html__( 'Select style', 'pofo-addons') => '',
                                esc_html__( 'Style 1', 'pofo-addons') => 'blockquote-style-1',
                                esc_html__( 'Style 2', 'pofo-addons') => 'blockquote-style-2',
                                esc_html__( 'Style 3', 'pofo-addons') => 'blockquote-style-3',
                              ),
            ),
            array(
              'type' => 'textarea_html',
              'heading' => esc_html__( 'Content', 'pofo-addons' ),
              'param_name' => 'content',
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Author', 'pofo-addons' ),
              'param_name' => 'pofo_author',
              'description' => esc_html__( 'Use || to break the word in new line.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Title', 'pofo-addons' ),
              'param_name' => 'pofo_title',
              'description' => esc_html__( 'Use || to break the word in new line.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2', 'blockquote-style-3' ) ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Enable icon', 'pofo-addons' ),
              'param_name' => 'pofo_enable_icon',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'std'  => '1',
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2', 'blockquote-style-3' ) ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Custom icon image', 'pofo-addons' ),
              'param_name' => 'custom_icon',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'std' =>'0',
              'dependency'  => array( 'element' => 'pofo_enable_icon', 'value' => array( '1' ) ),
            ),
            array(
              'type' => 'attach_image',
              'heading' => esc_html__( 'Custom image', 'pofo-addons' ),
              'param_name' => 'custom_icon_image',
              'dependency' => array( 'element' => 'custom_icon', 'value' => '1' ),
              'description' => esc_html__( 'Recommended size: Extra Large - 60px X 60px, Large - 50px X 50px, Extra Medium - 40px X 40px, Medium - 35px X 35px, Small - 24px X 24px, Extra Small - 16px X 16px', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Maximum width', 'pofo-addons' ),
              'param_name' => 'custom_icon_max_height',
              'dependency' => array( 'element' => 'custom_icon', 'value' => '1' ),
              'description' => esc_html__( 'In pixel like 40px.', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_icon',
              'heading' => esc_html__( 'Font icon', 'pofo-addons' ),
              'param_name' => 'pofo_icon_list',
              'admin_label' => true,
              'dependency' => array( 'element' => 'custom_icon', 'value' => '0' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Separator thickness', 'pofo-addons' ),
              'param_name' => 'pofo_separator_width',
              'description' => esc_html__( 'In pixel like 2px', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'group' => esc_html__( 'Style', 'pofo-addons' ),
            ),
            array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => esc_html__( 'Separator color', 'pofo-addons' ),
              'param_name' => 'pofo_separator_color',
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'group' => esc_html__( 'Style', 'pofo-addons' ),
            ),
            array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => esc_html__( 'Background color', 'pofo-addons' ),
              'param_name' => 'pofo_background_color',
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1', 'blockquote-style-3' ) ),
              'group' => esc_html__( 'Style', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Icon size', 'pofo-addons' ),
              'param_name' => 'pofo_icon_size',
              'admin_label' => true,
              'value' => array(esc_html__( 'Default', 'pofo-addons') => '',
                           esc_html__( 'Extra large', 'pofo-addons') => 'icon-extra-large', 
                           esc_html__( 'Large', 'pofo-addons') => 'icon-large',
                           esc_html__( 'Extra medium', 'pofo-addons') => 'icon-extra-medium',
                           esc_html__( 'Medium', 'pofo-addons') => 'icon-medium',
                           esc_html__( 'Small', 'pofo-addons') => 'icon-small',
                           esc_html__( 'Extra small', 'pofo-addons') => 'icon-extra-small',
                          ),
              'dependency'  => array( 'element' => 'pofo_enable_icon', 'value' => array( '1' ) ),
              'group' => esc_html__( 'Style', 'pofo-addons' ),
            ),
            array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => esc_html__( 'Icon color', 'pofo-addons' ),
              'param_name' => 'pofo_icon_color',
              'dependency'  => array( 'element' => 'pofo_enable_icon', 'value' => array( '1' ) ),
              'group' => esc_html__( 'Style', 'pofo-addons' ),
            ),
            array(
              'param_name' => 'pofo_custom_author_heading', // all params must have a unique name
              'type' => 'pofo_custom_title', // this param type
              'value' => esc_html__( 'Author typography', 'pofo-addons' ), // your custom markup
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'responsive_settings' => true,
              'hide_show_element' => 'pofo_author_responsive_settings',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),   
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Font size', 'pofo-addons' ),
              'param_name' => 'pofo_author_font_size',
              'description' => esc_html__( 'In pixel like 12px.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4 vc_column-with-padding',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Line height', 'pofo-addons' ),
              'param_name' => 'pofo_author_line_height',
              'description' => esc_html__( 'In pixel like 20px.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Letter spacing', 'pofo-addons' ),
              'param_name' => 'pofo_author_letter_spacing',
              'description' => esc_html__( 'Define letter spacing like 12px', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'param_name' => 'pofo_author_font_weight',
              'heading' => esc_html__( 'Font weight', 'pofo-addons' ),
              'value' => pofo_font_weight_style(),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Font italic', 'pofo-addons' ),
              'param_name' => 'pofo_author_italic',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Font underline', 'pofo-addons' ),
              'param_name' => 'pofo_author_underline',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Element tag', 'pofo-addons' ),
              'param_name' => 'pofo_author_element_tag',
              'value' => array(esc_html__( 'Element tag', 'pofo-addons') => '',
                               esc_html__( 'h1', 'pofo-addons') => 'h1',
                               esc_html__( 'h2', 'pofo-addons') => 'h2',
                               esc_html__( 'h3', 'pofo-addons') => 'h3',
                               esc_html__( 'h4', 'pofo-addons') => 'h4',
                               esc_html__( 'h5', 'pofo-addons') => 'h5',
                               esc_html__( 'h6', 'pofo-addons') => 'h6',
                              ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => esc_html__( 'Color', 'pofo-addons' ),
              'param_name' => 'pofo_author_color',
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Auto responsive font size', 'pofo-addons' ),
              'param_name' => 'pofo_author_enable_responsive_font',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'description' => esc_html__( 'If ON then it will display font size automatically as per device size instead of above mentioned fixed font size in all devices.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-1' ) ),
              'edit_field_class' => 'pofo_responsive_tab_author vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'responsive_font_settings',
              'heading' => esc_html__( 'Author responsive settings', 'pofo-addons' ),
              'param_name' => 'pofo_author_responsive_settings',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
              'hide_element_keys' => array( 'text-align', 'font-transform', ),
            ),
            array(
              'param_name' => 'pofo_custom_title_heading', // all params must have a unique name
              'type' => 'pofo_custom_title', // this param type
              'value' => esc_html__( 'Title typography', 'pofo-addons' ), // your custom markup
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2', 'blockquote-style-3' ) ),
              'responsive_settings' => true,
              'hide_show_element' => 'pofo_title_responsive_settings',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Font size', 'pofo-addons' ),
              'param_name' => 'pofo_title_font_size',
              'description' => esc_html__( 'In pixel like 12px.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2','blockquote-style-3' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4 vc_column-with-padding',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Line height', 'pofo-addons' ),
              'param_name' => 'pofo_title_line_height',
              'description' => esc_html__( 'In pixel like 20px.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2','blockquote-style-3' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Letter spacing', 'pofo-addons' ),
              'param_name' => 'pofo_title_letter_spacing',
              'description' => esc_html__( 'Define letter spacing like 12px', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2','blockquote-style-3' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'param_name' => 'pofo_title_font_weight',
              'heading' => esc_html__( 'Font weight', 'pofo-addons' ),
              'value' => pofo_font_weight_style(),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2','blockquote-style-3' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Font italic', 'pofo-addons' ),
              'param_name' => 'pofo_title_italic',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Font underline', 'pofo-addons' ),
              'param_name' => 'pofo_title_underline',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2','blockquote-style-3' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Element tag', 'pofo-addons' ),
              'param_name' => 'pofo_title_element_tag',
              'value' => array(esc_html__( 'Element tag', 'pofo-addons') => '',
                               esc_html__( 'h1', 'pofo-addons') => 'h1',
                               esc_html__( 'h2', 'pofo-addons') => 'h2',
                               esc_html__( 'h3', 'pofo-addons') => 'h3',
                               esc_html__( 'h4', 'pofo-addons') => 'h4',
                               esc_html__( 'h5', 'pofo-addons') => 'h5',
                               esc_html__( 'h6', 'pofo-addons') => 'h6',
                              ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2','blockquote-style-3' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'colorpicker',
              'class' => '',
              'heading' => esc_html__( 'Color', 'pofo-addons' ),
              'param_name' => 'pofo_title_color',
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2','blockquote-style-3' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'pofo_custom_switch_option',
              'heading' => esc_html__( 'Auto responsive font size', 'pofo-addons' ),
              'param_name' => 'pofo_title_enable_responsive_font',
              'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
                               esc_html__( 'On', 'pofo-addons') => '1'
                              ),
              'description' => esc_html__( 'If ON then it will display font size automatically as per device size instead of above mentioned fixed font size in all devices.', 'pofo-addons' ),
              'dependency' => array( 'element' => 'pofo_blockquote_style', 'value' => array( 'blockquote-style-2','blockquote-style-3' ) ),
              'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
            array(
              'type' => 'responsive_font_settings',
              'heading' => esc_html__( 'Title responsive settings', 'pofo-addons' ),
              'param_name' => 'pofo_title_responsive_settings',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
              'hide_element_keys' => array( 'text-align', 'font-transform', ),
            ),
            $pofo_vc_extra_id,
            $pofo_vc_extra_class,
        ),
      )
    );