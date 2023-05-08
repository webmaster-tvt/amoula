<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

    $pofo_disable_single_post_title = pofo_option('pofo_disable_single_post_title', '1');

    if($pofo_disable_single_post_title != 1 || is_404()) {
        return;
    }
    
    $pofo_single_post_title = get_the_title();
    
    $pofo_breadcrumb_position  = pofo_option('pofo_post_single_title_breadcrumb_position','');
    $pofo_breadcrumb_alignment = pofo_option('pofo_post_single_title_breadcrumb_alignment','text-left');
    $parallax_effect = $pofo_single_post_title_parallax_effect = $pofo_single_post_title_parallax = $pofo_single_post_title_bg_image = $poster_image = '';
    $pofo_single_post_title_style = pofo_option('pofo_single_post_title_style', 'page-title-style-9');
    $pofo_single_post_title_opacity = pofo_option('pofo_single_post_title_opacity', '0.7');
    $pofo_single_post_title_opacity_style = ( $pofo_single_post_title_opacity != '' ) ? ' style="opacity:'.$pofo_single_post_title_opacity.'"' : '';
    $pofo_single_post_title_bg_color = pofo_option('pofo_single_post_title_bg_color', '');

    $pofo_single_post_title_bg_image = pofo_option( 'pofo_single_post_title_bg_image','' );
    $pofo_image = pofo_get_image_id_by_url( $pofo_single_post_title_bg_image );
    $pofo_title_image_srcset = pofo_option('pofo_single_post_title_image_srcset', 'full');
    $srcset = $srcset_data = $srcset_classes = '';
    $srcset = wp_get_attachment_image_srcset( $pofo_image, $pofo_title_image_srcset );
    if( $srcset ){
        $srcset_data = ' data-bg-srcset="'.esc_attr( $srcset ).'"';
        $srcset_classes = ' bg-image-srcset';
    }

    $pofo_enable_single_post_title_heading = pofo_option( 'pofo_enable_single_post_title_heading', '1' );
    $pofo_disable_single_post_subtitle = pofo_option('pofo_disable_single_post_subtitle', '');
    $pofo_single_post_title_subtitle = pofo_option('pofo_single_post_title_subtitle','');
    $pofo_single_post_title_subtitle = ! empty( $pofo_single_post_title_subtitle ) ? str_replace( '||', '<br>', $pofo_single_post_title_subtitle ) : '';
    $pofo_disable_single_post_title_image = pofo_option('pofo_disable_single_post_title_image','');
    $pofo_image_url = wp_get_attachment_image_src($pofo_image, $pofo_title_image_srcset);

    // Animation
    $pofo_disable_single_post_title_animation = pofo_option( 'pofo_disable_single_post_title_animation', '1' );
    $pofo_single_post_title_animation = pofo_option( 'pofo_single_post_title_animation', 'fadeIn' );
    $pofo_single_post_title_animation_class = ( $pofo_disable_single_post_title_animation == '1' ) ? ' wow '.$pofo_single_post_title_animation : '';

    if( $pofo_disable_single_post_title_image == 1 || $pofo_disable_single_post_title_image == '' ){

        $pofo_bg_image_url = ! empty( $pofo_image_url[0] ) ? $pofo_image_url[0] : $pofo_single_post_title_bg_image;
        $pofo_single_post_title_bg_image = ( $pofo_bg_image_url ) ? ' style="background-image: url('.esc_url( $pofo_bg_image_url ).'); background-repeat: no-repeat; "': '';
        $parallax_effect = pofo_option('pofo_single_post_title_parallax_effect', '0.5');
        $pofo_single_post_title_parallax_effect = ( ! empty( $parallax_effect ) && $parallax_effect != 'no-parallax' ) ? ' data-parallax-background-ratio="'.$parallax_effect.'"': '';
        if( $pofo_single_post_title_style == 'page-title-style-6' ){
            $pofo_single_post_title_parallax = ( $pofo_single_post_title_parallax_effect ) ? ' parallax': ' cover-background background-position-top';
        }else{
            $pofo_single_post_title_parallax = ( $pofo_single_post_title_parallax_effect ) ? ' parallax': ' cover-background';
        }
    }else{
        $parallax_effect = pofo_option('pofo_single_post_title_parallax_effect', '0.5');
        if( $pofo_single_post_title_style == 'page-title-style-6' ){
            $pofo_single_post_title_parallax = ( ! empty( $parallax_effect ) && $parallax_effect != 'no-parallax' && $pofo_single_post_title_bg_color ) ? ' parallax': ' cover-background background-position-top';
        }else{
            $pofo_single_post_title_parallax = ( ! empty( $parallax_effect ) && $parallax_effect != 'no-parallax' && $pofo_single_post_title_bg_color ) ? ' parallax': ' cover-background';
        }
    }
    
    // Animation Breadcrumb
    $pofo_disable_breadcrumb = pofo_option('pofo_single_post_disable_breadcrumb', '0');
    $pofo_disable_single_post_breadcrumb_animation = pofo_option( 'pofo_disable_single_post_breadcrumb_animation', '1' );
    $pofo_single_post_breadcrumb_animation = pofo_option( 'pofo_single_post_breadcrumb_animation', 'fadeIn' );
    $pofo_single_post_breadcrumb_animation_class = ( $pofo_disable_single_post_breadcrumb_animation == '1' ) ? ' wow '.$pofo_single_post_breadcrumb_animation : '';
    
    $pofo_single_post_title_bg_multiple_image = pofo_option('pofo_single_post_title_bg_multiple_image', '');
    $pofo_single_post_title_video_type = pofo_option('pofo_single_post_title_video_type', 'self');
    $pofo_single_post_title_video_mp4 = pofo_option('pofo_single_post_title_video_mp4', '');
    $pofo_single_post_title_video_ogg = pofo_option('pofo_single_post_title_video_ogg', '');
    $pofo_single_post_title_video_webm = pofo_option('pofo_single_post_title_video_webm', '');
    $pofo_single_post_loop_video = ( pofo_option('pofo_single_post_loop_video', '1') == 1 ) ? ' loop': '';
    $pofo_single_post_mute_video = ( pofo_option('pofo_single_post_mute_video', '1') == 1 ) ? ' muted': '';

    $pofo_single_post_title_video_youtube = pofo_option('pofo_single_post_title_video_youtube', '');
    $pofo_single_post_title_scroll_to_down = pofo_option('pofo_single_post_title_scroll_to_down', '1');
    $pofo_single_post_title_callto_section_id = pofo_option('pofo_single_post_title_callto_section_id', '#about');
    $pofo_single_post_title_text_transform = pofo_option('pofo_single_post_title_text_transform', '');
    $pofo_single_post_title_bg_image_overlay = ( $pofo_single_post_title_opacity != '' ) ? '<div class="opacity-medium bg-extra-dark-gray bg-single-post-opacity-color"'.$pofo_single_post_title_opacity_style.'></div>' : '';

    $pofo_hide_category = pofo_option( 'pofo_hide_category', '1' );
    $pofo_hide_date = pofo_option( 'pofo_hide_date', '1' );
    $pofo_post_date_format = pofo_option( 'pofo_post_date_format', '' );
    $pofo_hide_author = pofo_option( 'pofo_hide_author', '1' );
    $pofo_single_post_meta_text_transform = pofo_option( 'pofo_single_post_meta_text_transform', 'text-uppercase' );
    $pofo_post_meta_array = array();
    if( $pofo_hide_date == 1 ) {
        $pofo_post_meta_array[] = '<li class="text-dark-gray">'.get_the_date( $pofo_post_date_format ).'</li>';
    }
    if( $pofo_hide_author == 1 ) {
        $pofo_post_meta_array[] = '<li><span class="text-dark-gray">'.esc_html__( 'By', 'pofo' ). ' <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" class="text-dark-gray">'.get_the_author().'</a></span></li>';
    }
    $post_category = pofo_post_category( get_the_ID(), '', '1' );
    if( $pofo_hide_category == 1 && !is_attachment() && ! empty( $post_category ) ) {
        $pofo_post_meta_array[] = '<li class="text-dark-gray">'.$post_category.'</li>';
    }
    $pofo_single_post_title_top_space = pofo_option('pofo_single_post_title_top_space', '');

    switch ( $pofo_single_post_title_style ) {
        case 'page-title-style-1':
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) || empty( $pofo_single_post_title_top_space ) ? ' top-space' : '';
            echo '<section class="bg-light-gray padding-50px-tb xs-padding-30px-tb page-title-small pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_animation_class.'">';
                echo '<div class="container">';
                    echo '<div class="row equalize sm-equalize-auto">';
                        if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left sm-text-center">';
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="alt-font text-extra-dark-gray font-weight-600 no-margin-bottom pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                    if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                        echo '<span class="display-block margin-5px-top alt-font pofo-single-post-subtitle">'.$pofo_single_post_title_subtitle.'</span>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                        if( $pofo_disable_breadcrumb == 1  && $pofo_breadcrumb_position == 'title-area' ){
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table text-right sm-text-center sm-margin-15px-top">';
                                echo '<div class="display-table-cell vertical-align-middle breadcrumb text-small alt-font">';
                                    echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }
                        elseif( ! empty( $pofo_post_meta_array ) && ( $pofo_breadcrumb_position == '' || $pofo_breadcrumb_position == 'after-title-area' ) ){
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table text-right sm-text-center sm-margin-15px-top">';
                                echo '<div class="display-table-cell vertical-align-middle breadcrumb text-small alt-font">';
                                    echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                        echo implode("", $pofo_post_meta_array );
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</section>';
             if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == '' || $pofo_breadcrumb_position == 'after-title-area' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
        break;
        case 'page-title-style-2':
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) || empty( $pofo_single_post_title_top_space ) ? ' top-space' : '';
            echo '<section class="bg-light-gray padding-50px-tb xs-padding-30px-tb small-single-post-title pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_animation_class.'">';
                echo '<div class="container">';
                    echo '<div class="row equalize sm-equalize-auto">';
                        if( $pofo_disable_breadcrumb == 1 && $pofo_breadcrumb_position == 'title-area' ) {
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table text-left sm-text-center">';
                                echo '<div class="display-table-cell vertical-align-middle breadcrumb text-small alt-font">';
                                    echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }
                        elseif( ! empty( $pofo_post_meta_array ) && ( $pofo_breadcrumb_position == '' || $pofo_breadcrumb_position == 'after-title-area' ) ){
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table text-left sm-text-center">';
                                echo '<div class="display-table-cell vertical-align-middle breadcrumb text-small alt-font">';
                                    echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                        echo implode("", $pofo_post_meta_array );
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }
                        if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table sm-margin-15px-top page-title-small pull-right">';
                                echo '<div class="display-table-cell vertical-align-middle text-right sm-text-center">';
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="alt-font text-extra-dark-gray font-weight-600 no-margin-bottom pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                    if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                        echo '<span class="display-block margin-5px-top alt-font pofo-single-post-subtitle">'.$pofo_single_post_title_subtitle.'</span>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == '' || $pofo_breadcrumb_position == 'after-title-area' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }

        break;
        case 'page-title-style-3':
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) || empty( $pofo_single_post_title_top_space ) ? ' top-space' : '';
            echo '<section class="bg-light-gray padding-100px-tb sm-padding-60px-tb xs-padding-30px-tb pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_animation_class.'">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || ! empty( $pofo_post_meta_array )  || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-medium">';
                                echo '<div class="display-table-cell vertical-align-middle text-center">';
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="alt-font text-extra-dark-gray font-weight-600 no-margin pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                    if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                        echo '<span class="display-block center-col margin-10px-top alt-font pofo-single-post-subtitle">'.$pofo_single_post_title_subtitle.'</span>';
                                    }
                                    if( $pofo_breadcrumb_position == 'title-area' && $pofo_disable_breadcrumb == 1 ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                                echo pofo_breadcrumb_display();
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                   elseif( ! empty( $pofo_post_meta_array ) && ($pofo_breadcrumb_position == 'title-area' || $pofo_disable_breadcrumb == 0 || $pofo_disable_breadcrumb == 1 ) ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == '' || $pofo_breadcrumb_position == 'after-title-area' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
        break;
        case 'page-title-style-4':
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) ? ' top-space' : '';
            echo '<section class="pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_parallax.$srcset_classes.$pofo_single_post_title_animation_class.'"'.$pofo_single_post_title_parallax_effect.$pofo_single_post_title_bg_image.$srcset_data.'>';
                echo wp_kses_post( $pofo_single_post_title_bg_image_overlay );
                echo '<div class="container">';
                    echo '<div class="row">';
                        if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || ! empty( $pofo_post_meta_array ) || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-md-12 col-sm-12 col-xs-12 one-second-screen display-table extra-small-screen page-title-medium center-col page-title-content-wrap">';
                                echo '<div class="display-table-cell vertical-align-middle text-center">';
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="alt-font text-white font-weight-600 no-margin letter-spacing-1 pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                    if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                        echo '<span class="display-block margin-10px-top text-extra-small alt-font pofo-single-post-subtitle">'.$pofo_single_post_title_subtitle.'</span>';
                                    }
                                    if( $pofo_breadcrumb_position == 'title-area' && $pofo_disable_breadcrumb == 1 ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                                echo pofo_breadcrumb_display();
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                    elseif( ! empty( $pofo_post_meta_array ) && ($pofo_breadcrumb_position == 'title-area' || $pofo_disable_breadcrumb == 0 || $pofo_disable_breadcrumb == 1 ) ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }    
        break;
        case 'page-title-style-5':
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) ? ' top-space' : '';
            echo '<section class="bg-extra-dark-gray pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_parallax.$srcset_classes.$pofo_single_post_title_animation_class.'"'.$pofo_single_post_title_parallax_effect.$pofo_single_post_title_bg_image.$srcset_data.'>';
                echo wp_kses_post( $pofo_single_post_title_bg_image_overlay );
                echo '<div class="container">';
                    echo '<div class="row">';
                        if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || ! empty( $pofo_post_meta_array ) || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-md-12 col-sm-12 col-xs-12 extra-small-screen display-table page-title-extra-small page-title-content-wrap">';
                                echo '<div class="display-table-cell vertical-align-middle text-center">';
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="alt-font text-white opacity7 margin-10px-bottom pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                    if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                        echo '<h2 class="text-white alt-font font-weight-600 width-55 sm-width-65 center-col xs-width-100 letter-spacing-minus-1 line-height-50 sm-line-height-45 xs-line-height-30 pofo-single-post-subtitle">'.$pofo_single_post_title_subtitle.'</h2>';
                                    }
                                    if( $pofo_breadcrumb_position == 'title-area' && $pofo_disable_breadcrumb == 1 ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                                echo pofo_breadcrumb_display();
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                    elseif( ! empty( $pofo_post_meta_array ) && ($pofo_breadcrumb_position == 'title-area' || $pofo_disable_breadcrumb == 0 || $pofo_disable_breadcrumb == 1 ) ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == 'after-title-area' || $pofo_breadcrumb_position == '' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
        break;
        case 'page-title-style-6':
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) || empty( $pofo_single_post_title_top_space ) ? ' top-space' : '';
            echo '<section class="pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_parallax.$srcset_classes.$pofo_single_post_title_animation_class.'"'.$pofo_single_post_title_parallax_effect.$pofo_single_post_title_bg_image.$srcset_data.'>';
                echo wp_kses_post( $pofo_single_post_title_bg_image_overlay );
                echo '<div class="container">';
                    echo '<div class="row">';
                    if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || ! empty( $pofo_post_meta_array ) || $pofo_enable_single_post_title_heading == '1' ){
                        echo '<div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large page-title-content-wrap">';
                            echo '<div class="display-table-cell vertical-align-middle text-center padding-30px-tb">';
                                if( $pofo_breadcrumb_position == 'title-area' && $pofo_disable_breadcrumb == 1 ){
                                    echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                }
                                elseif( ! empty( $pofo_post_meta_array ) && ($pofo_breadcrumb_position == 'title-area' || $pofo_disable_breadcrumb == 0 || $pofo_disable_breadcrumb == 1 ) ){
                                    echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                            echo implode("", $pofo_post_meta_array );
                                        echo '</ul>';
                                    echo '</div>';
                                }
                                if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                    echo '<span class="display-block text-white opacity6 alt-font margin-5px-bottom pofo-single-post-subtitle">'.$pofo_single_post_title_subtitle.'</span>';
                                }
                                if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                    echo '<h1 class="alt-font text-white font-weight-600 no-margin-bottom pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                }
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                echo '</div>';
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == 'after-title-area' || $pofo_breadcrumb_position == '' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
        break;
        case 'page-title-style-7':
            $pofo_single_post_title_bg_image_overlay = ( $pofo_single_post_title_opacity != '' ) ? '<div class="opacity-medium z-index-1 bg-extra-dark-gray bg-single-post-opacity-color"'.$pofo_single_post_title_opacity_style.'></div>' : '';
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) ? ' top-space' : '';
            echo '<section class="no-padding one-third-screen position-relative pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_animation_class.'">';
                echo wp_kses_post( $pofo_single_post_title_bg_image_overlay );
                echo '<div class="container">';
                    echo '<div class="row">';
                        if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || ! empty( $pofo_post_meta_array ) || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-md-12 col-sm-12 col-xs-12 display-table one-third-screen z-index-2 page-title-large page-title-content-wrap">';
                                echo '<div class="display-table-cell vertical-align-middle text-center">';
                                    if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                        echo '<span class="display-block text-white opacity6 margin-10px-bottom alt-font pofo-single-post-subtitle">'.$pofo_single_post_title_subtitle.'</span>';
                                    }
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="alt-font text-white font-weight-600 width-55 sm-width-80 xs-width-100 center-col no-margin-bottom pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                     if( $pofo_breadcrumb_position == 'title-area' && $pofo_disable_breadcrumb == 1 ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                                echo pofo_breadcrumb_display();
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                    elseif( ! empty( $pofo_post_meta_array ) && ($pofo_breadcrumb_position == 'title-area' || $pofo_disable_breadcrumb == 0 || $pofo_disable_breadcrumb == 1 ) ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                        if( $pofo_single_post_title_scroll_to_down == 1 ){
                            echo '<div class="down-section text-center"><a href="'.$pofo_single_post_title_callto_section_id.'" class="section-link"><i class="ti-arrow-down icon-extra-small text-white bg-deep-pink padding-15px-all xs-padding-10px-all border-radius-100"></i></a></div>';
                        }
                    echo '</div>';
                echo '</div>';
                if( $pofo_single_post_title_bg_multiple_image ){
                    echo '<div class="swiper-auto-fade swiper-container z-index-0 position-absolute top-0 width-100 height-100" data-slider-options=\'{ "pagination": ".swiper-pagination", "loop": true, "autoplay": { "delay": 5000 }, "slidesPerView": 1, "clickable": true, "keyboard": true, "effect": "fade", "nextButton": ".swiper-button-next", "prevButton": ".swiper-button-prev" }\'>';
                        echo '<div class="swiper-wrapper">';
                            $pofo_single_post_title_bg_multiple_image = explode( ',', $pofo_single_post_title_bg_multiple_image );
                            foreach ($pofo_single_post_title_bg_multiple_image as $key => $value) {
                                $pofo_image_url = wp_get_attachment_url( $value );
                                $pofo_bg_url = ( $pofo_image_url ) ? ' style="background-image:url('.esc_url( $pofo_image_url ).');"' : '';
                                echo '<div class="swiper-slide cover-background one-third-screen"'.$pofo_bg_url.'></div>';
                            }
                        echo '</div>';
                    echo '</div>';
                }
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == 'after-title-area' || $pofo_breadcrumb_position == '' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
        break;
        case 'page-title-style-8':
            $pofo_single_post_title_bg_image_overlay = ( $pofo_single_post_title_opacity != '' ) ? '<div class="opacity-medium z-index-2 bg-extra-dark-gray bg-single-post-opacity-color"'.$pofo_single_post_title_opacity_style.'></div>' : '';
            
            $pofo_bg_image_url = ! empty( $pofo_image_url[0] ) ? $pofo_image_url[0] : $pofo_single_post_title_bg_image;
            $pofo_poster_image = ( $pofo_bg_image_url ) ? ' poster="'.esc_url( $pofo_bg_image_url ).'"': '';
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) ? ' top-space' : '';
            echo '<section class="no-padding one-third-screen position-relative pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_parallax.$srcset_classes.$pofo_single_post_title_animation_class.'"'.$pofo_single_post_title_parallax_effect.$pofo_single_post_title_bg_image.$srcset_data.'>';
                echo wp_kses_post( $pofo_single_post_title_bg_image_overlay );
                echo '<div class="container">';
                    echo '<div class="row">';
                        if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-md-12 col-sm-12 col-xs-12 z-index-3 display-table one-third-screen page-title-medium page-title-content-wrap">';
                                echo '<div class="display-table-cell vertical-align-middle text-center">';
                                    if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                        echo '<span class="margin-5px-bottom display-block alt-font text-medium-gray pofo-single-post-subtitle">'.$pofo_single_post_title_subtitle.'</span>';
                                    }
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="text-white alt-font font-weight-600 letter-spacing-minus-1 pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                    if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == 'title-area' || $pofo_breadcrumb_position == '' ) ) {
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                                echo pofo_breadcrumb_display();
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                    elseif( ! empty( $pofo_post_meta_array ) && ($pofo_breadcrumb_position == 'title-area' || $pofo_disable_breadcrumb == 0 || $pofo_disable_breadcrumb == 1 ) ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
                if( $pofo_single_post_title_video_type == 'self' && ( $pofo_single_post_title_video_mp4 || $pofo_single_post_title_video_ogg || $pofo_single_post_title_video_webm )){
                    echo '<video autoplay playsinline'.$pofo_single_post_loop_video.$pofo_single_post_mute_video.' class="html-video z-index-1"'.$pofo_poster_image.'>';
                        if( $pofo_single_post_title_video_mp4 ){
                            echo '<source type="video/mp4" src="'.$pofo_single_post_title_video_mp4.'" />';
                        }
                        if( $pofo_single_post_title_video_ogg ){
                            echo '<source type="video/ogg" src="'.$pofo_single_post_title_video_ogg.'" />';
                        }
                        if( $pofo_single_post_title_video_webm ){
                            echo '<source type="video/webm" src="'.$pofo_single_post_title_video_webm.'" />';
                        }
                    echo '</video>';
                }elseif( $pofo_single_post_title_video_type == 'external' && ( $pofo_single_post_title_video_youtube )){
                    echo '<div class="external-fit-videos fit-videos width-100">';
                        echo '<iframe src="'.esc_url( $pofo_single_post_title_video_youtube ).'" width="560" height="315" frameborder="0" allowfullscreen allow="autoplay; fullscreen"></iframe>';
                    echo '</div>';
                }
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == 'after-title-area' || $pofo_breadcrumb_position == '' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
        break;
        case 'page-title-style-9':
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) || empty( $pofo_single_post_title_top_space ) ? ' top-space' : '';
            echo '<section class="bg-light-gray padding-35px-tb page-title-small pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_animation_class.'">';
                echo '<div class="container">';
                    echo '<div class="row equalize sm-equalize-auto">';
                        if( $pofo_single_post_title != '' || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left sm-text-center">';
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="alt-font text-extra-dark-gray font-weight-600 no-margin-bottom pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                       if( $pofo_disable_breadcrumb == 1 && $pofo_breadcrumb_position == 'title-area' ) {
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table text-right sm-text-center sm-margin-10px-top">';
                                echo '<div class="display-table-cell vertical-align-middle breadcrumb text-small alt-font">';
                                    echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }
                        elseif( ! empty( $pofo_post_meta_array ) && ( $pofo_breadcrumb_position == '' || $pofo_breadcrumb_position == 'after-title-area' ) ){
                            echo '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 display-table text-right sm-text-center sm-margin-10px-top">';
                                echo '<div class="display-table-cell vertical-align-middle breadcrumb text-small alt-font">';
                                    echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                        echo implode("", $pofo_post_meta_array );
                                    echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == 'after-title-area' || $pofo_breadcrumb_position == '' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
        break;

        case 'page-title-style-10':
        
            $pofo_single_post_title_top_space_class = ( ! empty( $pofo_single_post_title_top_space ) && $pofo_single_post_title_top_space == 'yes' ) ? ' top-space' : '';
            echo '<section class="pofo-single-post-title-bg '.$pofo_single_post_title_style.$pofo_single_post_title_top_space_class.$pofo_single_post_title_parallax.$srcset_classes.$pofo_single_post_title_animation_class.'"'.$pofo_single_post_title_parallax_effect.$pofo_single_post_title_bg_image.$srcset_data.'>';
                echo wp_kses_post( $pofo_single_post_title_bg_image_overlay );
                echo '<div class="container">';
                    echo '<div class="row">';
                        if( $pofo_single_post_title != '' || $pofo_single_post_title_subtitle != '' || ! empty( $pofo_post_meta_array ) || $pofo_enable_single_post_title_heading == '1' ){
                            echo '<div class="col-md-12 col-sm-12 col-xs-12 one-second-screen display-table extra-small-screen page-title-large center-col page-title-content-wrap">';
                                echo '<div class="display-table-cell vertical-align-middle text-center">';
                                    if( $pofo_single_post_title && $pofo_enable_single_post_title_heading == '1' ){
                                        echo '<h1 class="text-white alt-font font-weight-600 letter-spacing-minus-1 margin-10px-bottom pofo-single-post-title '.esc_attr( $pofo_single_post_title_text_transform ).'">'.$pofo_single_post_title.'</h1>';
                                    }
                                    if( $pofo_single_post_title_subtitle && ( $pofo_disable_single_post_subtitle == 1 || $pofo_disable_single_post_subtitle == '') ){
                                        echo '<span class="text-white alt-font margin-15px-bottom pofo-single-post-subtitle display-block opacity6">'.$pofo_single_post_title_subtitle.'</span>';
                                    }
                                    if( $pofo_breadcrumb_position == 'title-area' && $pofo_disable_breadcrumb == 1 ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block margin-15px-top">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                                echo pofo_breadcrumb_display();
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                    elseif( ! empty( $pofo_post_meta_array ) && ($pofo_breadcrumb_position == 'title-area' || $pofo_disable_breadcrumb == 0 || $pofo_disable_breadcrumb == 1 ) ){
                                        echo '<div class="breadcrumb text-small alt-font no-margin-bottom display-block">';
                                            echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                        echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</section>';
            if( $pofo_disable_breadcrumb == 1 && ( $pofo_breadcrumb_position == 'after-title-area' || $pofo_breadcrumb_position == '' ) ){
                echo '<section class="padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb'.$pofo_single_post_breadcrumb_animation_class.'">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle '.$pofo_breadcrumb_alignment.'">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                        echo '<ul class="pofo-single-post-title-breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">';
                                            echo pofo_breadcrumb_display();
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            elseif( ! empty( $pofo_post_meta_array ) && $pofo_breadcrumb_position == 'title-area' ){
                echo '<section class="wow fadeIn padding-20px-tb border-bottom border-color-extra-light-gray pofo-single-post-breadcrumb">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 display-table">';
                                echo '<div class="display-table-cell vertical-align-middle text-left">';
                                    echo '<div class="breadcrumb alt-font text-small no-margin-bottom">';
                                         echo '<ul class="pofo-single-post-title-breadcrumb-single '.$pofo_single_post_title_style.' '.$pofo_single_post_meta_text_transform.'">';
                                                echo implode("", $pofo_post_meta_array );
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }   
        break;
    }
