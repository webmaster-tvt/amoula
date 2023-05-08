<?php
/**
 * Shortcode Map For Post Slider
 *
 * @package Pofo
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Post Slider */
/*-----------------------------------------------------------------------------------*/

	$args = array(
	   'public'   => true,
	);

	$output = 'objects'; // names or objects, note names is the default
	$operator = 'and';
	$all_post_type = get_post_types( $args, $output, $operator );

	$custom_post_types = array();

	if ( ! empty( $all_post_type ) ) {

		foreach ( $all_post_type as $post_type_key => $post_type_data ) {
			
			if ( ! in_array( $post_type_key, array( 'page', 'attachment' ) ) ) {

				$custom_post_types[ $post_type_key ] = ! empty( $post_type_data->labels ) && ! empty( $post_type_data->labels->menu_name ) ? $post_type_data->labels->menu_name : ( ! empty( $post_type_data->label ) ? ! empty( $post_type_data->label ) : ucfirst( $post_type_key ) );
			}
		}
		$custom_post_types = array_flip( $custom_post_types );
	}

$params = array( //List of shortcode attributes. Array which holds your shortcode params, these params will be editable in shortcode settings page
			array(
			  'type' => 'dropdown',
			  'heading' => esc_html__( 'Style', 'pofo-addons'),
			  'param_name' => 'pofo_slider_style',
			  'admin_label' => true,
			  'value' => array( esc_html__( 'Select style', 'pofo-addons') => '',
								esc_html__( 'Style 1', 'pofo-addons') => 'post-slider-style-1',
								esc_html__( 'Style 2', 'pofo-addons') => 'post-slider-style-2',
								esc_html__( 'Style 3', 'pofo-addons') => 'post-slider-style-3',
							  ),
			),
			array(
			  'type' => 'pofo_preview_image',
			  'heading' => esc_html__( 'Select pre-made style for post', 'pofo-addons'),
			  'param_name' => 'pofo_post_preview_image',
			  'admin_label' => true,
			  'value' => array( esc_html__( 'Select style', 'pofo-addons') => '',
								esc_html__( 'Style 1', 'pofo-addons') => 'post-slider-style-1',
								esc_html__( 'Style 2', 'pofo-addons') => 'post-slider-style-2',
								esc_html__( 'Style 3', 'pofo-addons') => 'post-slider-style-3',
							  ),
			),
		   array(
			  'type' => 'dropdown',
			  'heading' => esc_html__( 'Post type', 'pofo-addons' ),
			  'param_name' => 'pofo_post_type',
			  'value' => $custom_post_types,
			  'std' => 'post',
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2','post-slider-style-3')),
			),
			array(
			  'type' => 'pofo_multiple_select_option',
			  'heading' => esc_html__( 'Categories', 'pofo-addons'),
			  'param_name' => 'pofo_categories_list',
			  'dependency' => array( 'element' => 'pofo_categories_taxonmoy_post', 'value' => array('category') ),
			),
			array(
			  'type' => 'dropdown',
			  'heading' => esc_html__( 'Posts order by', 'pofo-addons' ),
			  'param_name' => 'pofo_orderby',
			  'value' => array(esc_html__( 'Select Order by', 'pofo-addons') => '',
							   esc_html__( 'Date', 'pofo-addons' ) => 'date',
							   esc_html__( 'ID', 'pofo-addons' ) => 'ID',
							   esc_html__( 'Author', 'pofo-addons' ) => 'author',
							   esc_html__( 'Title', 'pofo-addons' ) => 'title',
							   esc_html__( 'Modified', 'pofo-addons' ) => 'modified',
							   esc_html__( 'Random', 'pofo-addons' ) => 'rand',
							   esc_html__( 'Comment count', 'pofo-addons' ) => 'comment_count',
							   esc_html__( 'Menu order', 'pofo-addons' ) => 'menu_order',
							  ),
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2','post-slider-style-3') ),
			),
			array(
			  'type' => 'dropdown',
			  'heading' => esc_html__( 'Posts sort by', 'pofo-addons' ),
			  'param_name' => 'pofo_order',
			  'value' => array(esc_html__( 'Select Sort by', 'pofo-addons') => '',
							   esc_html__( 'Descending', 'pofo-addons' ) => 'DESC',
							   esc_html__( 'Ascending', 'pofo-addons' ) => 'ASC',
							  ),
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2','post-slider-style-3') ),
			),
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'No. of posts to display', 'pofo-addons'),
			  'param_name' => 'pofo_post_per_page',
			  'value' => '',
			  'std' => '5',
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2','post-slider-style-3') ),
			  'description' => esc_html__( 'You enter blank where default set is 5 and if you want to all please enter -1', 'pofo-addons' ),

			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'holder' => 'div',
			  'class' => '',
			  'heading' => esc_html__( 'Pagination', 'pofo-addons'),
			  'param_name' => 'show_pagination',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1') ),
			  'description' => esc_html__( 'Select ON to show pagination in slider', 'pofo-addons' ),
			),
			array(
			  'type' => 'dropdown',
			  'heading' => esc_html__( 'Pagination style', 'pofo-addons'),
			  'param_name' => 'show_pagination_style',
			  'admin_label' => true,
			  'value' => array(esc_html__( 'Select pagination style', 'pofo-addons') => '',
							 esc_html__( 'Dot style', 'pofo-addons') => '0',
							 esc_html__( 'Line style', 'pofo-addons') => '1',
							),
			  'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
			),
			array(
			  'type' => 'dropdown',
			  'heading' => esc_html__( 'Pagination color style', 'pofo-addons'),
			  'param_name' => 'show_pagination_color_style',
			  'admin_label' => true,
			  'value' => array(esc_html__( 'Select pagination color style', 'pofo-addons') => '',
							   esc_html__( 'Dark style', 'pofo-addons') => '0',
							   esc_html__( 'Light style', 'pofo-addons') => '1'
							  ),
			  'std' => '1',
			  'dependency' => array( 'element' => 'show_pagination', 'value' => array('1') ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Post title', 'pofo-addons'),
			  'param_name' => 'pofo_show_title',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'std' => '1',
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2','post-slider-style-3') ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Post categories', 'pofo-addons'),
			  'param_name' => 'pofo_show_category',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'std' => '1',
			  'dependency' => array( 'element' => 'pofo_post_type', 'value' => array( 'post' ) ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Read more button', 'pofo-addons'),
			  'param_name' => 'pofo_show_button',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'std' => '1',
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2','post-slider-style-3') ),
			),
			array(
			  'type'        => 'textfield',
			  'heading'     => esc_html__( 'Button text', 'pofo-addons' ),
			  'param_name'  => 'pofo_button_text',
			  'dependency'  => array( 'element' => 'pofo_show_button', 'value' => array('1') ),
			),
			array(
			  'type' => 'dropdown',
			  'heading' => esc_html__( 'Category text case', 'pofo-addons'),
			  'param_name' => 'pofo_category_text_transform',
			  'value' => array(  esc_html__('Select', 'pofo-addons') => '', 
								 esc_html__('Lowercase', 'pofo-addons') => 'text-lowercase',
								 esc_html__('Uppercase', 'pofo-addons') => 'text-uppercase',
								 esc_html__('Capitalize', 'pofo-addons') => 'text-capitalize',
								 esc_html__( 'None', 'pofo-addons' ) => 'text-none',
								),
			  'std' => 'text-uppercase',
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			),
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'Transition speed', 'pofo-addons'),
			  'param_name' => 'slidespeed',
			  'admin_label' => true,
			  'value' => '',
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2') ),
			  'description' => esc_html__( 'Enter slide speed time like 500, where 1000 = 1 second', 'pofo-addons'),
			  'group' => esc_html__( 'Slider Configuration', 'pofo-addons'),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'holder' => 'div',
			  'class' => '',
			  'heading' => esc_html__( 'Auto play', 'pofo-addons'),
			  'param_name' => 'autoplay',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2') ),
			  'description' => esc_html__( 'Select On to autoplay slider', 'pofo-addons' ),
			  'group' => esc_html__( 'Slider Configuration', 'pofo-addons'),
			),            
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'Delay time', 'pofo-addons'),
			  'param_name' => 'slidedelay',
			  'admin_label' => true,
			  'value' => '',
			  'std' => '3000',
			  'description' => esc_html__( 'Enter delay time (before switching to other slide) like 500, where 1000 = 1 second', 'pofo-addons'),
			  'dependency'  => array( 'element' => 'autoplay', 'value' => array('1') ),
			  'group' => esc_html__( 'Slider Configuration', 'pofo-addons'),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'holder' => 'div',
			  'class' => '',
			  'heading' => esc_html__( 'Loop', 'pofo-addons'),
			  'param_name' => 'autoloop',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0', 
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'std' => '1',
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2') ),
			  'description' => esc_html__( 'Select On to loop slider', 'pofo-addons' ),
			  'group' => esc_html__( 'Slider Configuration', 'pofo-addons'),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Box background color', 'pofo-addons' ),
			  'param_name' => 'pofo_box_bg_color',
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1') ),
			  'group' => esc_html__( 'Style', 'pofo-addons'),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Button color', 'pofo-addons' ),
			  'param_name' => 'pofo_button_color',
			  'dependency' => array( 'element' => 'pofo_show_button', 'value' => array('1') ),
			  'group' => esc_html__( 'Style', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Button hover color', 'pofo-addons' ),
			  'param_name' => 'pofo_button_hover_color',
			  'dependency' => array( 'element' => 'pofo_show_button', 'value' => array('1') ),
			  'group' => esc_html__( 'Style', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Button text color', 'pofo-addons' ),
			  'param_name' => 'pofo_button_text_color',
			  'dependency' => array( 'element' => 'pofo_show_button', 'value' => array('1') ),
			  'group' => esc_html__( 'Style', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Button hover text color', 'pofo-addons' ),
			  'param_name' => 'pofo_button_hover_text_color',
			  'dependency' => array( 'element' => 'pofo_show_button', 'value' => array('1') ),
			  'group' => esc_html__( 'Style', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Button border color', 'pofo-addons' ),
			  'param_name' => 'pofo_button_border_color',
			  'dependency' => array( 'element' => 'pofo_show_button', 'value' => array('1') ),
			  'group' => esc_html__( 'Style', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Button border hover color', 'pofo-addons' ),
			  'param_name' => 'pofo_button_border_hover_color',
			  'dependency' => array( 'element' => 'pofo_show_button', 'value' => array('1') ),
			  'group' => esc_html__( 'Style', 'pofo-addons' ),
			),
			array(
              'param_name' => 'pofo_custom_title_heading', // all params must have a unique name
              'type' => 'pofo_custom_title', // this param type
              'value' => esc_html__( 'Title typography', 'pofo-addons' ), // your custom markup
              'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
              'responsive_settings' => true,
              'hide_show_element' => 'pofo_title_responsive_settings',
              'group' => esc_html__( 'Typography', 'pofo-addons' ),
            ),
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'Font size', 'pofo-addons' ),
			  'param_name' => 'pofo_title_font_size',
			  'description' => esc_html__( 'In pixel like 12px.', 'pofo-addons' ),
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4 vc_column-with-padding',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'Line height', 'pofo-addons' ),
			  'param_name' => 'pofo_title_line_height',
			  'description' => esc_html__( 'In pixel like 20px.', 'pofo-addons' ),
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'Letter spacing', 'pofo-addons' ),
			  'param_name' => 'pofo_title_letter_spacing',
			  'description' => esc_html__( 'Define letter spacing like 12px', 'pofo-addons' ),
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'dropdown',
			  'param_name' => 'pofo_title_font_weight',
			  'heading' => esc_html__( 'Font weight', 'pofo-addons' ),
			  'value' => pofo_font_weight_style(),
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Font italic', 'pofo-addons'),
			  'param_name' => 'pofo_title_italic',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Font underline', 'pofo-addons'),
			  'param_name' => 'pofo_title_underline',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'dropdown',
			  'heading' => esc_html__( 'Element tag', 'pofo-addons'),
			  'param_name' => 'pofo_title_element_tag',
			  'value' => array(esc_html__( 'Element tag', 'pofo-addons') => '',
							   esc_html__( 'h1', 'pofo-addons') => 'h1',
							   esc_html__( 'h2', 'pofo-addons') => 'h2',
							   esc_html__( 'h3', 'pofo-addons') => 'h3',
							   esc_html__( 'h4', 'pofo-addons') => 'h4',
							   esc_html__( 'h5', 'pofo-addons') => 'h5',
							   esc_html__( 'h6', 'pofo-addons') => 'h6',
							  ),
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Color', 'pofo-addons' ),
			  'param_name' => 'pofo_title_color',
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Hover color', 'pofo-addons' ),
			  'param_name' => 'pofo_title_hover_color',
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Auto responsive font size', 'pofo-addons'),
			  'param_name' => 'pofo_title_enable_responsive_font',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'description' => esc_html__( 'If ON then it will display font size automatically as per device size instead of above mentioned fixed font size in all devices.', 'pofo-addons' ),
			  'dependency' => array( 'element' => 'pofo_show_title', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_title vc_col-sm-12',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
            'type' => 'responsive_font_settings',
            'param_name' => 'pofo_title_responsive_settings',
            'group' => esc_html__( 'Typography', 'pofo-addons' ),
            'hide_element_keys' => array( 'text-align', 'font-transform', ),
          ),
			array(
			  'param_name' => 'pofo_custom_category_heading', // all params must have a unique name
			  'type' => 'pofo_custom_title', // this param type
			  'value' => esc_html__( 'Category typography', 'pofo-addons' ), // your custom markup
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'responsive_settings' => true,
              'hide_show_element' => 'pofo_category_responsive_settings',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'Font size', 'pofo-addons' ),
			  'param_name' => 'pofo_category_font_size',
			  'description' => esc_html__( 'In pixel like 12px.', 'pofo-addons' ),
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4 vc_column-with-padding',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'Line height', 'pofo-addons' ),
			  'param_name' => 'pofo_category_line_height',
			  'description' => esc_html__( 'In pixel like 20px.', 'pofo-addons' ),
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'textfield',
			  'heading' => esc_html__( 'Letter spacing', 'pofo-addons' ),
			  'param_name' => 'pofo_category_letter_spacing',
			  'description' => esc_html__( 'Define letter spacing like 12px', 'pofo-addons' ),
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'dropdown',
			  'param_name' => 'pofo_category_font_weight',
			  'heading' => esc_html__( 'Font weight', 'pofo-addons' ),
			  'value' => pofo_font_weight_style(),
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Font italic', 'pofo-addons'),
			  'param_name' => 'pofo_category_italic',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Font underline', 'pofo-addons'),
			  'param_name' => 'pofo_category_underline',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Color', 'pofo-addons' ),
			  'param_name' => 'pofo_category_color',
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Hover color', 'pofo-addons' ),
			  'param_name' => 'pofo_category_hover_color',
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'colorpicker',
			  'class' => '',
			  'heading' => esc_html__( 'Background color', 'pofo-addons' ),
			  'param_name' => 'pofo_category_bg_color',
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
			  'type' => 'pofo_custom_switch_option',
			  'heading' => esc_html__( 'Auto responsive font size', 'pofo-addons'),
			  'param_name' => 'pofo_category_enable_responsive_font',
			  'value' => array(esc_html__( 'Off', 'pofo-addons') => '0',
							   esc_html__( 'On', 'pofo-addons') => '1'
							  ),
			  'description' => esc_html__( 'If ON then it will display font size automatically as per device size instead of above mentioned fixed font size in all devices.', 'pofo-addons' ),
			  'dependency' => array( 'element' => 'pofo_show_category', 'value' => array('1') ),
			  'edit_field_class' => 'pofo_responsive_tab_category vc_col-sm-4',
			  'group' => esc_html__( 'Typography', 'pofo-addons' ),
			),
			array(
		      'type' => 'responsive_font_settings',
		      'param_name' => 'pofo_category_responsive_settings',
		      'group' => esc_html__( 'Typography', 'pofo-addons' ),
		      'hide_element_keys' => array( 'text-align', 'font-transform', ),
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
			  'std' => '1',
			  'dependency' => array( 'element' => 'pofo_slider_style', 'value' => array('post-slider-style-1','post-slider-style-2','post-slider-style-3') ),
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
			  'admin_label' => true,
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
			   'type'        => 'textfield',
			   'heading'     => esc_html__( 'Element ID', 'pofo-addons' ),
			   'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to %s).', 'pofo-addons'), '<a target="_blank" href="https://www.w3schools.com/tags/att_global_id.asp">w3c specification</a>'),
			   'param_name'  => 'pofo_slider_id',
			   'group'       => esc_html__( 'Extras', 'pofo-addons' ),
			),
			array(
			   'type'        => 'textfield',
			   'heading'     => esc_html__( 'Extra class name', 'pofo-addons' ),
			   'description' => esc_html__( 'Add additional CSS class to this element, you can define multiple CSS class with use of space like "Class1 Class2". You can write css code using this class and add it in customizer or your child theme css file.', 'pofo-addons' ),
			   'param_name'  => 'pofo_slider_class',
			   'group'       => esc_html__( 'Extras', 'pofo-addons' ),
			),
		);
$settings = array();
$args = array(
	   'public'   => true,
	);

$all_post_type_array = get_post_types( $args, 'objects' );

// Get all post types 
foreach ( $all_post_type_array as $post_type_key => $post_type ) {
	$custom_choices = array();
	if ( ! in_array( $post_type_key, array( 'page', 'attachment' ) ) ) {

	  	// Get all taxonomy from post types
		$custom_taxonomies = get_object_taxonomies( $post_type_key, 'objects' );
		foreach( $custom_taxonomies as $taxonomy_key => $custom_taxonomy ) {
			if ( isset( $custom_taxonomy->public ) && $custom_taxonomy->public == 1 && $taxonomy_key != 'product_shipping_class' && $taxonomy_key != 'post_format' ) {
				$taxonomy_label = isset( $custom_taxonomy->label ) ? $custom_taxonomy->label : $taxonomy_key;
				$custom_choices[$taxonomy_label] = $taxonomy_key;
			}
		}

		// Add setting for all post types
		if ( ! empty( $custom_choices ) ) {	
			$settings[] = array(
					'type'			=> 'dropdown',
					'heading'		=> isset( $post_type->label ) ? $post_type->label : $post_type_key,
					'param_name'	=> isset( $post_type_key ) ? 'pofo_categories_taxonmoy_' . $post_type_key : '',
					'dependency'	=> array( 'element' => 'pofo_post_type', 'value' => $post_type_key ),
					'multiple'		=> false,
					'value'			=> $custom_choices,
				);
		} 

		// Add setting for all custom taxonomy 
		if ( ! empty( $custom_taxonomies ) ) {
			foreach ( $custom_taxonomies as $key => $taxonomy ) {
				if( ! is_wp_error( $taxonomy ) && $taxonomy->name != 'category' ) {
				  $categories = get_terms( array( 'taxonomy' => $taxonomy->name, 'orderby' => 'count', 'hide_empty'=> false, ) );
				  $settings[] = array(
						  'type'        => 'pofo_multiple_select_custom_option',
						  'heading'     => isset( $taxonomy->label ) ? $taxonomy->label : '',
						  'param_name'  => isset( $taxonomy->name ) ? 'pofo_taxonomies_list_' . $taxonomy->name : '',
						  'dependency'  => array( 'element' => 'pofo_categories_taxonmoy_'.$post_type_key, 'value' => $taxonomy->name ),
						  'multiple'    => true,
						  'choices'     => $categories,
						);
				}
			}
		}
	}
}

array_splice( $params, 3, 0, $settings );
	vc_map( array(
		'name'			=> esc_html__( 'Post Slider' , 'pofo-addons' ), //Name of your shortcode for human reading inside element list
		'base'			=> 'pofo_post_slider', //Shortcode tag. For [my_shortcode] shortcode base is my_shortcode
		'description'	=> esc_html__( 'Place post items list', 'pofo-addons' ), //Short description of your element, it will be visible in 'Add element' window
		'class'			=> '', //CSS class which will be added to the shortcode's content element in the page edit screen in Visual Composer backend edit mode
		'icon' 			=> 'fas fa-arrows-alt-h pofo-shortcode-icon', //URL or CSS class with icon image.
		'category' 		=> 'Pofo',
		'params' 		=> $params,
	)
);