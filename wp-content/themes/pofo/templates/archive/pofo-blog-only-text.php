<?php

    // Exit if accessed directly.
    if ( ! defined( 'ABSPATH' ) ) { exit; }
    
    /* Define null variables */    
    $archive_layout = $show_no_of_category = $pofo_general_archive_type_settings = '';
    $archive_count = 0;
    /* Check archive type */
    $pofo_blog_type_archive = ( get_theme_mod( 'pofo_blog_type_archive', '' ) ) ? get_theme_mod( 'pofo_blog_type_archive', '' ) : '' ;
    $pofo_general_archive_type_gutter = ( $pofo_blog_type_archive ) ? $pofo_blog_type_archive.' blog-post-gutter' : '' ;
    switch ( $pofo_blog_type_archive ) {
        case 'gutter-large':
            $pofo_general_archive_type_settings .= ' padding-10px-all';
            break;
        
        case 'gutter-medium':
            $pofo_general_archive_type_settings .= ' padding-7px-all';
            break;

        case 'gutter-small':
            $pofo_general_archive_type_settings .= ' padding-5px-all';
            break;

        case 'gutter-very-small':
            $pofo_general_archive_type_settings .= ' padding-3px-all';
            break;

        default:
            $pofo_general_archive_type_settings .= ' margin-30px-bottom xs-margin-15px-bottom';
            break;
    }
    while ( have_posts() ) : the_post();
        /* Check archive style */
        $pofo_blog_premade_style_archive = get_theme_mod( 'pofo_blog_premade_style_archive', 'blog-list' );
        /* Check archive column type */
        $pofo_blog_column_archive = get_theme_mod( 'pofo_blog_column_archive', '2' );
        /* Check if Post Format hide or show */
        $pofo_show_post_format_archive = get_theme_mod( 'pofo_show_post_format_archive', '0' );
       	/* Check if separator hide or show */
        $pofo_show_separator_archive = get_theme_mod( 'pofo_show_separator_archive', '1' );
        /* Check if title hide or show */
        $pofo_show_post_title_archive = get_theme_mod( 'pofo_show_post_title_archive', '1' );
        /* Check if post thumbnail hide or show */
        $pofo_show_post_thumbnail_archive = get_theme_mod( 'pofo_show_post_thumbnail_archive', '1' );
        /* Check if author hide or show */
        $pofo_show_post_author_archive = get_theme_mod( 'pofo_show_post_author_archive', '1' );
        /* Check if author image hide or show */
        $pofo_show_post_author_image_archive = get_theme_mod( 'pofo_show_post_author_image_archive', '0' );
        /* Check if date hide or show */
        $pofo_show_post_date_archive = get_theme_mod( 'pofo_show_post_date_archive', '1' );
        /* Check date format to show */
        $pofo_date_format_archive = get_theme_mod( 'pofo_date_format_archive', '' );
        /* Check if post excerpt hide or show */
        $pofo_show_excerpt_archive = get_theme_mod( 'pofo_show_excerpt_archive', '1' );
        /* Check post excerpt length to show */
        $pofo_excerpt_length_archive = get_theme_mod( 'pofo_excerpt_length_archive', '15' );
        /* Check if post content like hide or show */
        $pofo_show_content_archive = get_theme_mod( 'pofo_show_content_archive', '1' );
        /* Check if category like hide or show */
        $pofo_show_category_archive = get_theme_mod( 'pofo_show_category_archive', '1' );
        /* Check if pagination like hide or show */
        $pofo_show_pagination_archive = get_theme_mod( 'pofo_show_pagination_archive', '1' );
        /* Check if post like hide or show */
        $pofo_show_like_archive = get_theme_mod( 'pofo_show_like_archive', '0' );
        /* Check if post comment ike hide or show */
        $pofo_show_comment_archive = get_theme_mod( 'pofo_show_comment_archive', '0' );
        /* Check if button hide or show */
        $pofo_show_button_archive = get_theme_mod( 'pofo_show_button_archive', '1' );
        /* Check button text to show */
        $pofo_button_text_archive = get_theme_mod( 'pofo_button_text_archive', 'continue reading' );
        /* Check text transform for title to show */
        $pofo_blog_post_title_text_transform_archive = ' '.get_theme_mod( 'pofo_blog_post_title_text_transform_archive', '' );
        /* Check text transform for text to show */
        $pofo_blog_post_meta_text_transform_archive = ' '.get_theme_mod( 'pofo_blog_post_meta_text_transform_archive', 'text-uppercase' );
        /* Check font size for title */
        $pofo_title_font_size_archive = get_theme_mod( 'pofo_title_font_size_archive', '' );
        /* Check line height for title */
        $pofo_title_line_height_archive = get_theme_mod( 'pofo_title_line_height_archive', '' );
        /* Check letter spacing for title */
        $pofo_title_letter_spacing_archive = get_theme_mod( 'pofo_title_letter_spacing_archive', '' );
        /* Check font weight for title */
        $pofo_title_font_weight_archive = get_theme_mod( 'pofo_title_font_weight_archive', '' );
        /* Check italic for title */
        $pofo_title_italic_archive = get_theme_mod( 'pofo_title_italic_archive', '0' );
        /* Check underline for title */
        $pofo_title_underline_archive = get_theme_mod( 'pofo_title_underline_archive', '0' );
        /* Check if responsive font size for title */
        $pofo_title_enable_responsive_font_archive = get_theme_mod( 'pofo_title_enable_responsive_font_archive', '0' );
        /* Check animation to show */
        $pofo_animation_archive = get_theme_mod( 'pofo_animation_archive', '' );
        /* Check separator height to show */
        $pofo_seperator_height_archive = get_theme_mod( 'pofo_seperator_height_archive', '' );
        /* Check box border to show */
        $pofo_box_enable_border_archive = ( get_theme_mod( 'pofo_box_enable_border_archive', '' ) == '0' ) ? ' border-none': ' border-all' ;
        /* Check pagination style to show */
        $pofo_blog_pagination_style_archive = get_theme_mod( 'pofo_blog_pagination_style_archive', 'number-pagination' );
        $pofo_srcset_archive = get_theme_mod( 'pofo_image_srcset_archive', 'full' );
        
        $pofo_post_classes = $class_column = $author_image = $pofo_post_classes_masonry = $pofo_post_classes_infinite_scroll = '';
        if( $pofo_show_pagination_archive == 1 ) {
            if( $pofo_blog_pagination_style_archive == 'infinite-scroll-pagination' ) {
                $pofo_post_classes_infinite_scroll = ' blog-single-post';
            }
        }
        ob_start();
            post_class();
            $pofo_post_classes .= ob_get_contents();
        ob_end_clean();

        $pofo_animation_archive = ( $pofo_animation_archive ) ? $class_column .= ' wow '.$pofo_animation_archive : '';
        $pofo_general_archive_type_settings = ( $pofo_general_archive_type_settings ) ? $class_column .= $pofo_general_archive_type_settings : '';
        switch ($pofo_blog_column_archive) {
        	case '2':
        		$class_column .= ' col-md-6 col-sm-6 col-xs-12 ';
        	break;
        	case '3':
        		$class_column .= ' col-md-4 col-sm-6 col-xs-12 ';
        	break;
        	case '4':
        		$class_column .= ' col-md-3 col-sm-6 col-xs-12 ';
        	break;
            case '5':
                $class_column .= ' vc_col-md-1/5 col-sm-6 col-xs-12';
            break;
            case '6':
                $class_column .= ' col-lg-2 col-md-4 col-sm-6 col-xs-12 ';
            break;
        }
        $pofo_animation_delay_attr = ( $archive_count > 0 ) ? ' data-wow-delay="'.$archive_count.'ms"' : '';
        $post_format = get_post_format( get_the_ID() );
        $post_cat = $sep_style_attr = array();
        $categories = get_the_category();
        foreach ($categories as $k => $cat) {
            $cat_link = get_category_link($cat->cat_ID);
            $post_cat[]='<a href="'.$cat_link.'" class="text-medium-gray text-extra-small vertical-align-middle display-inline-block pofo-blog-post-meta" rel="category tag">'.$cat->name.'</a>';
        }
        $post_category = ! empty( $post_cat ) ? implode(", ",$post_cat) : '';
        $pofo_title_style_array = $pofo_content_style_array = array();
        // For Title Style
        ! empty( $pofo_title_font_size_archive ) ? $pofo_title_style_array[] = 'font-size: ' . $pofo_title_font_size_archive . ';' : '';
        ! empty( $pofo_title_line_height_archive ) ? $pofo_title_style_array[] = 'line-height: ' . $pofo_title_line_height_archive . ';' : '';
        ! empty( $pofo_title_letter_spacing_archive ) ? $pofo_title_style_array[] = 'letter-spacing: ' . $pofo_title_letter_spacing_archive . ';' : '';
        ! empty( $pofo_title_font_weight_archive ) ? $pofo_title_style_array[] = 'font-weight: ' . $pofo_title_font_weight_archive . ';' : '';
        ( $pofo_title_italic_archive == 1 ) ? $pofo_title_style_array[] = 'font-style: italic;' : '';
        ( $pofo_title_underline_archive == 1 ) ? $pofo_title_style_array[] = 'text-decoration: underline;' : '';

        $pofo_title_dynamic_font_size = $pofo_title_enable_responsive_font_archive == 1 ? ' dynamic-font-size' : '';
        $pofo_title_style_attr   = pofo_get_style_attribute( $pofo_title_style_array, $pofo_title_font_size_archive, $pofo_title_line_height_archive );

        $pofo_separator_height = ( $pofo_seperator_height_archive ) ? $sep_style_array[] = 'height:'.$pofo_seperator_height_archive.';' : '';

        $sep_style_attr = ! empty( $sep_style_array ) ? ' style="'.implode(" ", $sep_style_array).'"' : '';

        /* Image Alt, Title, Caption */
        $img_alt = pofo_option_image_alt(get_post_thumbnail_id());
        $img_title = pofo_option_image_title(get_post_thumbnail_id());
        $image_alt = ( isset($img_alt['alt']) && ! empty($img_alt['alt']) ) ? $img_alt['alt'] : '' ; 
        $image_title = ( isset($img_title['title']) && ! empty($img_title['title']) ) ? $img_title['title'] : '';

        $img_attr = array(
            'title' => $image_title,
            'alt' => $image_alt,
        );

        $cnt = 0;
        $author_box_column = '';
        if( $pofo_show_post_author_archive == 1 ) { $cnt++; }
        if( $pofo_show_like_archive == 1 && function_exists( 'pofo_get_simple_likes_button' ) ){ $cnt++; }
        if( $pofo_show_comment_archive == 1 && (comments_open() || get_comments_number())){ $cnt++; }
        switch ($cnt){
            case '1':
               $author_box_column .= 'col-md-12 col-sm-12';
                break;
            case '2':
                $author_box_column .= 'col-md-6 col-sm-6';
                break;
            case '3':
                $author_box_column .= 'col-md-4 col-sm-4';
                break;
        }

        $pofo_show_date = get_the_date( $pofo_date_format_archive, get_the_ID());

        if( $pofo_show_post_author_image_archive == 1 ) {
            $author_image_url = get_avatar_url( get_the_author_meta( 'ID' ) );
            $author_image .= '<img class="border-radius-100 width-30px margin-10px-right" src="'.esc_url($author_image_url).'" alt="'.get_the_author().'"> ';
        }
        $pofo_show_author   = $author_image.esc_html__('by','pofo').' <span class="author vcard"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="url fn n">'.get_the_author().'</a></span>';
        $post_cat = array();
        foreach ($categories as $k => $cat) {
            $cat_link = get_category_link($cat->cat_ID);
            $post_cat[]='<a href="'.$cat_link.'" class="pofo-blog-post-meta text-extra-small vertical-align-middle display-inline-block">'.$cat->name.'</a>';
        }
        $post_category = ! empty( $post_cat ) ? implode(", ",$post_cat) : '';
        $author_date_array = array();
        if( $pofo_show_post_date_archive == 1 ) {
            $author_date_array[] = '<span class="display-inline-block published vertical-align-middle">'.$pofo_show_date.'</span><time class="updated display-none" datetime="'.get_the_modified_date( 'c' ).'">'.get_the_modified_date( $pofo_date_format_archive ).'</time>';
        }
        if( $pofo_show_category_archive == 1 && $post_category ) {
            $author_date_array[] = $post_category;
        }
        
        echo '<div class="blog-post '.$class_column.$pofo_post_classes_infinite_scroll.'"'.$pofo_animation_delay_attr.'>';
            echo '<div '.$pofo_post_classes.'>';
                if ( !post_password_required() ) {
                    if( $pofo_show_post_thumbnail_archive == 1 ){
                        if( $post_format == 'image' && $pofo_show_post_format_archive != 1 ) {
                            echo '<div class="blog-post-images overflow-hidden no-margin-bottom">';
                                echo get_template_part( 'loop/archive/loop', 'image' );
                            echo '</div>';
                        }elseif( $post_format == 'gallery' && $pofo_show_post_format_archive != 1 ) {
                            echo '<div class="blog-post-images overflow-hidden no-margin-bottom">';
                                echo get_template_part( 'loop/archive/loop', 'gallery' );
                            echo '</div>';
                        }elseif( $post_format == 'video' && $pofo_show_post_format_archive != 1 ) {
                            echo '<div class="blog-post-images overflow-hidden no-margin-bottom">';
                                echo get_template_part( 'loop/archive/loop', 'video' );
                            echo '</div>';
                        }elseif( $post_format == 'quote' && $pofo_show_post_format_archive != 1 ) {
                            echo '<div class="blog-post-images overflow-hidden no-margin-bottom">';
                                echo get_template_part( 'loop/archive/loop', 'quote' );
                            echo '</div>';
                        }elseif( $post_format == 'audio' && $pofo_show_post_format_archive != 1 ) {
                            echo '<div class="blog-post-images overflow-hidden no-margin-bottom">';
                                echo get_template_part( 'loop/archive/loop', 'audio' );
                            echo '</div>';
                        }else{
                            if( has_post_thumbnail() ) {
                                echo '<div class="blog-post-images overflow-hidden no-margin-bottom">';
                                    $page_url = get_permalink();
                                    echo '<a href="'.esc_url( $page_url ).'">';
                                        echo get_the_post_thumbnail( get_the_ID(), $pofo_srcset_archive, $img_attr );
                                    echo '</a>';
                                echo '</div>';
                            }
                        }
                    }
                }
                echo '<div class="blog-post blog-post-style7 border-all border-color-light-gray padding-fourteen-all md-padding-ten-all bg-white position-relative pofo-post-description xs-no-margin-bottom pofo-box-background-color'.$pofo_box_enable_border_archive.'">';
                    echo '<div class="post-details">';
                        if( ! empty( $author_date_array ) ){
                            echo '<div class="pofo-blog-post-meta author text-extra-small display-block margin-10px-bottom xs-margin-5px-bottom'.$pofo_blog_post_meta_text_transform_archive.'">';
                                echo implode( '<span class="blog-separator display-inline-block vertical-align-middle">|</span>', $author_date_array );
                            echo '</div>';
                        }
                        if( $pofo_show_post_title_archive == 1 ){
                            echo '<span class="text-large alt-font margin-50px-bottom sm-margin-30px-bottom display-block"><a href="'.get_the_permalink().'" class="entry-title'.$pofo_title_dynamic_font_size.$pofo_blog_post_title_text_transform_archive.'"'.$pofo_title_style_attr.'>'.get_the_title().'</a></span>';
                        }
                        if( $pofo_show_excerpt_archive == 1 ){
                            $show_excerpt_grid = ! empty( $pofo_excerpt_length_archive ) ? pofo_get_the_excerpt_theme($pofo_excerpt_length_archive) : pofo_get_the_excerpt_theme(15);
                            echo '<div class="margin-ten-bottom display-block sm-margin-five-bottom entry-content">'.$show_excerpt_grid.'</div>';
                        }elseif($pofo_show_content_archive == 1){
                            echo '<div class="margin-ten-bottom display-block sm-margin-five-bottom entry-content blog-post-full-content">'.pofo_get_the_post_content().'</div>';
                        }
                        if( $pofo_show_separator_archive == 1 ){
                            echo '<div class="pofo-post-sepataror separator-line-horrizontal-full bg-medium-light-gray margin-10px-bottom width-40"'.$sep_style_attr.'></div>';
                        }
                        if( $pofo_show_post_author_archive == 1 ){
                            echo '<div class="author position-relative'.$pofo_blog_post_meta_text_transform_archive.'">';
                                if( $pofo_show_post_author_image_archive == 1 ) {
                                    $author_image_url = get_avatar_url( get_the_author_meta( 'ID' ) );
                                    $author_image .= '<img class="border-radius-100 width-30px" src="'.esc_url($author_image_url).'" alt="'.get_the_author().'"> ';
                                }
                                echo '<span class="pofo-blog-post-meta text-extra-small">'.$pofo_show_author.'</span>';
                            echo '</div>';
                        }
                        if( $pofo_show_like_archive == 1 || $pofo_show_comment_archive == 1 ){
                            echo '<div class="pofo-blog-post-meta blog-like-comment margin-15px-top'.$pofo_blog_post_meta_text_transform_archive.'">';
                                if( $pofo_show_like_archive == 1 && function_exists( 'pofo_get_simple_likes_button' ) ){
                                    echo pofo_get_simple_likes_button( get_the_ID() );
                                }
                                if( $pofo_show_comment_archive == 1 && (comments_open() || get_comments_number())){
                                    echo comments_popup_link( __( '<i class="far fa-comment"></i>Leave a comment', 'pofo' ), __( '<i class="far fa-comment"></i>1 Comment', 'pofo' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'pofo' ), 'comment' );
                                }
                            echo '</div>';
                        }
                        if( $pofo_show_button_archive == 1 ){
                            $page_url = get_permalink();
                            echo '<a href="'.esc_url( $page_url ).'" class="btn-black btn btn-very-small no-margin-bottom margin-15px-top white-space-normal">'.$pofo_button_text_archive.'</a>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    $archive_count++;
    endwhile;