<?php
/**
 * This file use for define custom function
 * Also include required files.
 *
 * @package Pofo
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

update_option( 'pofo_theme_active', 'yes' );

/*
 *	Pofo Theme namespace.
 */
define( 'POFO_THEME_VERSION', '1.3.4' );
define( 'POFO_ADDONS_VERSION', '1.3.4' );
define( 'POFO_WPBAKERY_VERSION', '6.6.0' );
define( 'POFO_REVOLUTION_VERSION', '6.4.3' );

/*
 *	Pofo Theme Folders
 */
define( 'POFO_THEME_DIR',         				get_template_directory());
define( 'POFO_THEME_TEMPLATE',         			POFO_THEME_DIR . '/templates' );	
define( 'POFO_THEME_LANGUAGES',   				POFO_THEME_DIR . '/languages' );
define( 'POFO_THEME_ASSETS',      				POFO_THEME_DIR . '/assets' );
define( 'POFO_THEME_JS',         				POFO_THEME_ASSETS . '/js' );
define( 'POFO_THEME_CSS',        				POFO_THEME_ASSETS . '/css' );
define( 'POFO_THEME_IMAGES',      				POFO_THEME_ASSETS . '/images' );
define( 'POFO_THEME_ADMIN_JS',    				POFO_THEME_JS . '/admin' );
define( 'POFO_THEME_ADMIN_CSS',    				POFO_THEME_CSS . '/admin' );
define( 'POFO_THEME_LIB',         				POFO_THEME_DIR . '/lib' );
define( 'POFO_THEME_CUSTOMIZER',     			POFO_THEME_LIB . '/customizer' );
define( 'POFO_THEME_CUSTOMIZER_MAPS',     		POFO_THEME_CUSTOMIZER . '/customizer-maps' );
define( 'POFO_THEME_CUSTOMIZER_CONTROLS',     	POFO_THEME_CUSTOMIZER . '/customizer-control' );
define( 'POFO_THEME_MEGA_MENU',      			POFO_THEME_LIB . '/mega-menu' );
define( 'POFO_THEME_TGM',         				POFO_THEME_LIB . '/tgm' );

/*
 *  Pofo Theme Folder URI
 */
define( 'POFO_THEME_URI',             			get_template_directory_uri());
define( 'POFO_THEME_TEMPLATE_URI',         		POFO_THEME_URI . '/templates' );
define( 'POFO_THEME_LANGUAGES_URI',   			POFO_THEME_URI . '/languages' );
define( 'POFO_THEME_ASSETS_URI',      			POFO_THEME_URI     . '/assets' );
define( 'POFO_THEME_JS_URI',          			POFO_THEME_ASSETS_URI . '/js' );
define( 'POFO_THEME_CSS_URI',         			POFO_THEME_ASSETS_URI . '/css' );
define( 'POFO_THEME_IMAGES_URI',      			POFO_THEME_ASSETS_URI . '/images' );
define( 'POFO_THEME_ADMIN_JS_URI',    			POFO_THEME_JS_URI . '/admin' );
define( 'POFO_THEME_ADMIN_CSS_URI',    			POFO_THEME_CSS_URI . '/admin' );
define( 'POFO_THEME_LIB_URI',         			POFO_THEME_URI . '/lib' );
define( 'POFO_THEME_CUSTOMIZER_URI',     		POFO_THEME_LIB_URI . '/customizer' );
define( 'POFO_THEME_CUSTOMIZER_MAPS_URI',    	POFO_THEME_CUSTOMIZER_URI . '/customizer-maps' );
define( 'POFO_THEME_MEGA_MENU_URI',  			POFO_THEME_LIB_URI . '/mega-menu' );
define( 'POFO_THEME_TGM_URI',        			POFO_THEME_LIB_URI . '/tgm' );

defined( 'POFO_ADDONS_ROOT_DIR' ) or define( 'POFO_ADDONS_ROOT_DIR', plugins_url( 'pofo-addons' ) );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'pofo_theme_setup' ) ) :
	function pofo_theme_setup() {
		
		/*
		 *   Text Domain
		 */
		load_theme_textdomain( 'pofo', get_template_directory() . '/languages' );

		/*
		 * To add default posts and comments RSS feed links to theme head.
		 */
		add_theme_support( 'automatic-feed-links' );
	    
	    /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Custom image sizes for posts, pages, gallery, slider.
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 771 );
		add_image_size( 'pofo-related-post-thumb', 360, 257, true );
		add_image_size( 'pofo-client-logo', 120, '', true );
		add_image_size( 'pofo-popular-posts-thumb', 81, '', true );

		// Set Custom Header
		add_theme_support( 'custom-header', apply_filters( 'pofo_custom_header_args', array(
			'width'                  => 1920,
			'height'                 => 100,
		) ) );

		// Set Custom Body Background
		add_theme_support( 'custom-background' );

		/**
		 * Gutenberg supports
		 */
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'align-wide' );

		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'		=> __( 'Small', 'pofo' ),
					'shortName'	=> __( 'S', 'pofo' ),
					'size'		=> 12,
					'slug'		=> 'small',
				),
				array(
					'name'		=> __( 'Normal', 'pofo' ),
					'shortName'	=> __( 'M', 'pofo' ),
					'size'		=> 16,
					'slug'		=> 'normal',
				),
				array(
					'name'		=> __( 'Large', 'pofo' ),
					'shortName'	=> __( 'L', 'pofo' ),
					'size'		=> 18,
					'slug'		=> 'large',
				),
				array(
					'name'		=> __( 'Extra Large', 'pofo' ),
					'shortName'	=> __( 'XL', 'pofo' ),
					'size'		=> 20,
					'slug'		=> 'huge',
				),
			)
		);

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'	=> __( 'Primary', 'pofo' ),
					'slug'	=> 'primary',
					'color'	=> '#6f6f6f',
				),
				array(
					'name'	=> __( 'Secondary', 'pofo' ),
					'slug'	=> 'secondary',
					'color'	=> '#ff214f',
				),
				array(
					'name'	=> __( 'Extra Dark Gray', 'pofo' ),
					'slug'	=> 'dark-gray',
					'color'	=> '#232323',
				),
				array(
					'name'	=> __( 'Light Gray', 'pofo' ),
					'slug'	=> 'light-gray',
					'color'	=> '#f1f1f1',
				),
				array(
					'name'	=> __( 'White', 'pofo' ),
					'slug'	=> 'white',
					'color'	=> '#ffffff',
				),
			)
		);

		/*
		 * Register menu for Pofo theme.
		 */
		register_nav_menus( array(
			'pofomegamenu' => esc_html__( 'Pofo Mega Menu', 'pofo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery'
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		 
		add_theme_support( 'post-formats', array(
			'image', 'gallery', 'video', 'audio', 'quote', 'link',
		) );

		/* This theme styles the visual editor with editor-style.css to match the theme style. */
		add_editor_style();

		/*
		 * woocommerce support
		 */
		add_theme_support( 'woocommerce' );

		/*
		 * product gallery features (zoom, swipe, lightbox) 
		 */
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		/* Page excerpt support */
		add_post_type_support( 'page', 'excerpt' );
	}
endif;
add_action( 'after_setup_theme', 'pofo_theme_setup' );

/*
 *  Content Width (Set the content width based on the theme's design and stylesheet.)
 */
if ( ! function_exists( 'pofo_content_width' ) ) :
	function pofo_content_width() {
		
		$GLOBALS['content_width'] = apply_filters( 'pofo_content_width', 1200 );
	}
endif;
add_action( 'after_setup_theme', 'pofo_content_width', 0 );

if( file_exists( POFO_THEME_LIB . '/pofo-require-files.php' ) ) :
	require_once( POFO_THEME_LIB . '/pofo-require-files.php');
endif;

// Blank data for WooCommerce Pages
if ( ! function_exists( 'pofo_woocommerce_create_pages' ) ) {
    function pofo_woocommerce_create_pages() {

        return array();
    }
}

if ( ! function_exists( 'pofo_high_priority_init' ) ) {
    function pofo_high_priority_init() {

        add_filter( 'woocommerce_create_pages', 'pofo_woocommerce_create_pages' );
    }
}
add_action( 'init', 'pofo_high_priority_init', 4 );