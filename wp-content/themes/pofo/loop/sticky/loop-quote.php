<?php
/**
 * displaying quote for sticky post
 *
 * @package Pofo
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

$pofo_blog_quote = pofo_post_meta('pofo_quote');
echo '<div class="blog-image">';
    if($pofo_blog_quote){
        echo '<blockquote class="bg-extra-dark-gray">';
            echo '<h6 class="text-white font-weight-300 line-height-35 alt-font margin-15px-bottom">'.$pofo_blog_quote.'</h6>';
        echo '</blockquote>';
    }
echo '</div>';