<?php
/**
 * Invert functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 */
/**
 * Registers widget areas.
 *
 */
function invert_widgets_init() {
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<li id="%1$s" class="ske-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="ske-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<li id="%1$s" class="ske-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="ske-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Contact Sidebar',
		'before_widget' => '<li id="%1$s" class="ske-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="ske-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer Sidebar',
		'before_widget' => '<div id="%1$s" class="ske-footer-container span3 ske-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="ske-title ske-footer-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Project Sidebar',
		'before_widget' => '<li id="%1$s" class="ske-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="ske-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'WooCommerce Sidebar',
		'before_widget' => '<li id="%1$s" class="ske-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="ske-title">',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'invert_widgets_init' );

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Invert supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
*/
function invert_theme_setup() {
	/*
	 * Makes Invert available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'invert' to the name of your theme in all
	 * template files.
	 */
	 load_theme_textdomain( 'invert', get_template_directory() . '/languages' );
	 
	// This theme styles the visual editor with editor-style.css to match the theme style.
	 add_editor_style();

	 // Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support('post-thumbnails');
	add_theme_support( 'woocommerce' );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array('video', 'gallery', 'quote', 'audio' ) );
	set_post_thumbnail_size( 600, 220, true );
	add_image_size( 'homepage-slider',1024,520); //remove if slider is not needed
	add_image_size( 'invert_featuredbox_image',250,114); //remove if slider is not needed
	add_image_size( 'invert_portfolio_image',270,230,true); //remove if slider is not needed
	add_image_size( 'invert_portfolio_three_image',372,372,true); //remove if slider is not needed
	add_image_size( 'invert_portfolio_two_image',570,470,true); //remove if slider is not needed
	add_image_size( 'invert_standard_img',770,365,true); //standard size
	add_image_size( 'invert_fullblog_img',1170,556,true); //Full Blog size
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'Header' => __( 'Main Navigation', 'invert' ),
	));
}
add_action( 'after_setup_theme', 'invert_theme_setup' ); 

/**
* Funtion to add CSS class to body
*/
function invert_add_class( $classes ) {
	if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_front_page() ) {
		$classes[] = 'front-page';
	}
	
	return $classes;
}
add_filter( 'body_class','invert_add_class' );

/**
 * Filter content with empty post title
 *
 */

add_filter('the_title', 'invert_untitled');
function invert_untitled($title) {
	if ($title == '') {
		return __('Untitled','invert');
	} else {
		return $title;
	}
}

/*---------------------------------------------------------------------------*/
/* Theme Required Plugins
/*---------------------------------------------------------------------------*/
 if ( !defined( 'INVERT_REQUIRED_PLUGINS' ) ) {
	define( 'INVERT_REQUIRED_PLUGINS', trailingslashit(get_theme_root()) . 'invert/includes/plugins' );
}
include_once('includes/skt-required-plugins.php');

/*---------------------------------------------------------------------------*/
/* ADMIN SCRIPT: Enqueue scripts in back-end
/*---------------------------------------------------------------------------*/
if( !function_exists('skt_page_admin_enqueue_scripts') ){
    add_action('admin_enqueue_scripts','skt_page_admin_enqueue_scripts');
    /**
     * Register scripts for admin panel
     * @return void
     */
    function skt_page_admin_enqueue_scripts(){	
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', get_template_directory_uri() .'/SketchBoard/js/admin-jqery.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
		wp_enqueue_style('thickbox');
		wp_register_style( 'skt-admin-stylesheet', get_template_directory_uri().'/SketchBoard/css/sketch-admin.css', false);
		wp_enqueue_style( 'skt-admin-stylesheet' );
    }
}

/* Loads the Options Panel * * If you're loading from a child theme use stylesheet_directory * instead of template_directory */ 
if ( !function_exists( 'optionsframework_init' ) ) {	
	//Theme Shortname
	$invert_shortname = 'invert';	
	$invert_themename='Invert Theme';	
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/SketchBoard/includes/' );
	require_once get_template_directory() . '/SketchBoard/includes/options-framework.php';
	require_once get_template_directory() . '/SketchBoard/functions/admin-init.php';
}

/* POST FORMAT VIDEO */
function parse_vimeo($link){
					     
    $regexstr = '~
        # Match Vimeo link and embed code
        (?:<iframe [^>]*src=")?       # If iframe match up to first quote of src
        (?:                         # Group vimeo url
            https?:\/\/             # Either http or https
            (?:[\w]+\.)*            # Optional subdomains
            vimeo\.com              # Match vimeo.com
            (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
            \/                      # Slash before Id
            ([0-9]+)                # $1: VIDEO_ID is numeric
            [^\s]*                  # Not a space
        )                           # End group
        "?                          # Match end quote if part of src
        (?:[^>]*></iframe>)?        # Match the end of the iframe
        (?:<p>.*</p>)?              # Match any title information stuff
        ~ix';
     
    preg_match($regexstr, $link, $matches);
    return $matches[1];
     
}