<?php
/**
* Theme Functions
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

/**
 * This function return a value of given theme option name from database.
 *
 * @since 1.0.0
 *
 * @param string $option Theme option to return.
 * @return mixed The value of theme option.
 */
function cutemag_get_option($option) {
    $cutemag_options = get_option('cutemag_options');
    if ((is_array($cutemag_options)) && (array_key_exists($option, $cutemag_options))) {
        return $cutemag_options[$option];
    }
    else {
        return '';
    }
}

function cutemag_is_option_set($option) {
    $cutemag_options = get_option('cutemag_options');
    if ((is_array($cutemag_options)) && (array_key_exists($option, $cutemag_options))) {
        return true;
    } else {
        return false;
    }
}

if ( ! function_exists( 'cutemag_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cutemag_setup() {
    
    global $wp_version;

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on CuteMag, use a find and replace
     * to change 'cutemag' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'cutemag', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    if ( function_exists( 'add_image_size' ) ) {
        add_image_size( 'cutemag-1200w-autoh-image',  1200, 9999, false );
        add_image_size( 'cutemag-900w-autoh-image',  900, 9999, false );
        add_image_size( 'cutemag-100w-100h-image',  100, 100, true );
    }

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
    'primary' => esc_html__('Primary Menu', 'cutemag'),
    'secondary' => esc_html__('Secondary Menu', 'cutemag')
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    $markup = array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' );
    add_theme_support( 'html5', $markup );

    add_theme_support( 'custom-logo', array(
        'height'      => 70,
        'width'       => 350,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Support for Custom Header
    add_theme_support( 'custom-header', apply_filters( 'cutemag_custom_header_args', array(
    'default-image'          => '',
    'default-text-color'     => 'ffffff',
    'width'                  => 1920,
    'height'                 => 400,
    'flex-width'            => true,
    'flex-height'            => true,
    'wp-head-callback'       => 'cutemag_header_style',
    'uploads'                => true,
    ) ) );

    // Set up the WordPress core custom background feature.
    $background_args = array(
            'default-color'          => '353535',
            'default-image'          => '',
            'default-repeat'         => 'repeat',
            'default-position-x'     => 'left',
            'default-position-y'     => 'top',
            'default-size'     => 'auto',
            'default-attachment'     => 'fixed',
            'wp-head-callback'       => '_custom_background_cb',
            'admin-head-callback'    => 'admin_head_callback_func',
            'admin-preview-callback' => 'admin_preview_callback_func',
    );
    add_theme_support( 'custom-background', apply_filters( 'cutemag_custom_background_args', $background_args) );
    
    // Support for Custom Editor Style
    add_editor_style( 'css/editor-style.css' );

    if ( !(cutemag_get_option('enable_widgets_block_editor')) ) {
        remove_theme_support( 'widgets-block-editor' );
    }

}
endif;
add_action( 'after_setup_theme', 'cutemag_setup' );


/**
* Layout Functions
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function cutemag_post_style() {
   $post_style = 'compactview';
    if ( cutemag_get_option('post_style') ) {
        $post_style = cutemag_get_option('post_style');
    }
    return apply_filters( 'cutemag_post_style', $post_style );
}

function cutemag_hide_footer_widgets() {
    $hide_footer_widgets = FALSE;
    if ( cutemag_get_option('hide_footer_widgets') ) {
        $hide_footer_widgets = TRUE;
    }
    return apply_filters( 'cutemag_hide_footer_widgets', $hide_footer_widgets );
}

function cutemag_is_primary_menu_active() {
    $primary_menu_active = TRUE;
    if ( cutemag_get_option('disable_primary_menu') ) {
        $primary_menu_active = FALSE;
    }
    return apply_filters( 'cutemag_is_primary_menu_active', $primary_menu_active );
}

function cutemag_is_secondary_menu_active() {
    $secondary_menu_active = TRUE;
    if ( cutemag_get_option('disable_secondary_menu') ) {
        $secondary_menu_active = FALSE;
    }
    return apply_filters( 'cutemag_is_secondary_menu_active', $secondary_menu_active );
}

function cutemag_is_header_content_active() {
    $header_content_active = TRUE;
    if ( cutemag_get_option('hide_header_content') ) {
        $header_content_active = FALSE;
    }
    return apply_filters( 'cutemag_is_header_content_active', $header_content_active );
}

function cutemag_social_buttons_location() {
    $social_buttons_location = 'secondary-menu';
    if ( cutemag_get_option('social_buttons_location') ) {
        $social_buttons_location = cutemag_get_option('social_buttons_location');
    }
   return apply_filters( 'cutemag_social_buttons_location', $social_buttons_location );
}

function cutemag_is_social_buttons_active() {
    $social_buttons_active = TRUE;
    if ( cutemag_get_option('hide_social_buttons') ) {
        $social_buttons_active = FALSE;
    }
    return apply_filters( 'cutemag_is_social_buttons_active', $social_buttons_active );
}

function cutemag_is_fitvids_active() {
    $fitvids_active = TRUE;
    if ( cutemag_get_option('disable_fitvids') ) {
        $fitvids_active = FALSE;
    }
    return apply_filters( 'cutemag_is_fitvids_active', $fitvids_active );
}

function cutemag_is_backtotop_active() {
    $backtotop_active = TRUE;
    if ( cutemag_get_option('disable_backtotop') ) {
        $backtotop_active = FALSE;
    }
    return apply_filters( 'cutemag_is_backtotop_active', $backtotop_active );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cutemag_content_width() {
    $content_width = 897;

    if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
       $content_width = 1200;
    }

    if ( is_404() ) {
        $content_width = 1200;
    }

    $GLOBALS['content_width'] = apply_filters( 'cutemag_content_width', $content_width ); /* phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound */
}
add_action( 'template_redirect', 'cutemag_content_width', 0 );


/**
* Enqueue scripts and styles
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function cutemag_scripts() {
    wp_enqueue_style('cutemag-maincss', get_stylesheet_uri(), array(), NULL);
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), NULL );
    wp_enqueue_style('cutemag-webfont', '//fonts.googleapis.com/css?family=Domine:400,700|Oswald:400,700|Patua+One|Frank+Ruhl+Libre:400,700&amp;display=swap', array(), NULL);

    $cutemag_primary_menu_active = FALSE;
    if ( cutemag_is_primary_menu_active() ) {
        $cutemag_primary_menu_active = TRUE;
    }
    $cutemag_secondary_menu_active = FALSE;
    if ( cutemag_is_secondary_menu_active() ) {
        $cutemag_secondary_menu_active = TRUE;
    }

    $cutemag_sticky_sidebar_active = TRUE;
    if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
        $cutemag_sticky_sidebar_active = FALSE;
    }
    if ( is_404() ) {
        $cutemag_sticky_sidebar_active = FALSE;
    }
    if ( $cutemag_sticky_sidebar_active ) {
        wp_enqueue_script('ResizeSensor', get_template_directory_uri() .'/assets/js/ResizeSensor.min.js', array( 'jquery' ), NULL, true);
        wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() .'/assets/js/theia-sticky-sidebar.min.js', array( 'jquery' ), NULL, true);
    }

    $cutemag_fitvids_active = FALSE;
    if ( cutemag_is_fitvids_active() ) {
        $cutemag_fitvids_active = TRUE;
    }
    if ( $cutemag_fitvids_active ) {
        wp_enqueue_script('fitvids', get_template_directory_uri() .'/assets/js/jquery.fitvids.min.js', array( 'jquery' ), NULL, true);
    }

    $cutemag_backtotop_active = FALSE;
    if ( cutemag_is_backtotop_active() ) {
        $cutemag_backtotop_active = TRUE;
    }

    wp_enqueue_script('cutemag-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), NULL, true );
    wp_enqueue_script('cutemag-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), NULL, true );
    wp_enqueue_script('cutemag-customjs', get_template_directory_uri() .'/assets/js/custom.js', array( 'jquery', 'imagesloaded' ), NULL, true);
    wp_localize_script( 'cutemag-customjs', 'cutemag_ajax_object',
        array(
            'ajaxurl' => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
            'primary_menu_active' => $cutemag_primary_menu_active,
            'secondary_menu_active' => $cutemag_secondary_menu_active,
            'sticky_sidebar_active' => $cutemag_sticky_sidebar_active,
            'fitvids_active' => $cutemag_fitvids_active,
            'backtotop_active' => $cutemag_backtotop_active,
        )
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script('cutemag-html5shiv-js', get_template_directory_uri() .'/assets/js/html5shiv.js', array('jquery'), NULL, true);

    wp_localize_script('cutemag-html5shiv-js','cutemag_custom_script_vars',array(
        'elements_name' => esc_html__('abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video', 'cutemag'),
    ));
}
add_action( 'wp_enqueue_scripts', 'cutemag_scripts' );

/**
 * Enqueue IE compatible scripts and styles.
 */
function cutemag_ie_scripts() {
    wp_enqueue_script( 'respond', get_template_directory_uri(). '/assets/js/respond.min.js', array(), NULL, false );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'cutemag_ie_scripts' );

/**
 * Enqueue customizer styles.
 */
function cutemag_enqueue_customizer_styles() {
    wp_enqueue_style( 'cutemag-customizer-styles', get_template_directory_uri() . '/assets/css/customizer-style.css', array(), NULL );
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), NULL );
}
add_action( 'customize_controls_enqueue_scripts', 'cutemag_enqueue_customizer_styles' );


/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function cutemag_widgets_init() {

register_sidebar(array(
    'id' => 'cutemag-header-ad',
    'name' => esc_html__( 'Header Right Widgets', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located on the right side of the header of your web page. You can drag and drop a "Custom HTML" widget into this widget area and add your banner ad code into that widget.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-header-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'cutemag-sidebar',
    'name' => esc_html__( 'Sidebar Widgets (Everywhere)', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located on the sidebar of your website. Widgets of this widget area are displayed on every page of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-side-widget widget cutemag-box %2$s"><div class="cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'cutemag-home-sidebar',
    'name' => esc_html__( 'Sidebar Widgets (Default HomePage)', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located on the sidebar of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-side-widget widget cutemag-box %2$s"><div class="cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));


register_sidebar(array(
    'id' => 'cutemag-top-widgets',
    'name' => esc_html__( 'Above Content Widgets (Everywhere)', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located at the top of the main content of your website. Widgets of this widget area are displayed on every page of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget widget cutemag-box %2$s"><div class="cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'cutemag-home-top-widgets',
    'name' => esc_html__( 'Above Content Widgets (Default HomePage)', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located at the top of the main content of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget widget cutemag-box %2$s"><div class="cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));


register_sidebar(array(
    'id' => 'cutemag-bottom-widgets',
    'name' => esc_html__( 'Below Content Widgets (Everywhere)', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located at the bottom of the main content of your website. Widgets of this widget area are displayed on every page of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget widget cutemag-box %2$s"><div class="cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'cutemag-home-bottom-widgets',
    'name' => esc_html__( 'Below Content Widgets (Default HomePage)', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located at the bottom of the main content of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget widget cutemag-box %2$s"><div class="cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));


register_sidebar(array(
    'id' => 'cutemag-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Everywhere)', 'cutemag' ),
    'description' => esc_html__( 'This full-width widget area is located after the primary menu of your website. Widgets of this widget area are displayed on every page of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget cutemag-top-fullwidth-widget cutemag-box widget %2$s"><div class="cutemag-top-fullwidth-widget-inside cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'cutemag-home-fullwidth-widgets',
    'name' => esc_html__( 'Top Full Width Widgets (Default HomePage)', 'cutemag' ),
    'description' => esc_html__( 'This full-width widget area is located after the primary menu of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget cutemag-top-fullwidth-widget cutemag-box widget %2$s"><div class="cutemag-top-fullwidth-widget-inside cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));


register_sidebar(array(
    'id' => 'cutemag-fullwidth-bottom-widgets',
    'name' => esc_html__( 'Bottom Full Width Widgets (Everywhere)', 'cutemag' ),
    'description' => esc_html__( 'This full-width widget area is located before the footer of your website. Widgets of this widget area are displayed on every page of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget cutemag-bottom-fullwidth-widget cutemag-box widget %2$s"><div class="cutemag-bottom-fullwidth-widget-inside cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'cutemag-home-fullwidth-bottom-widgets',
    'name' => esc_html__( 'Bottom Full Width Widgets (Default HomePage)', 'cutemag' ),
    'description' => esc_html__( 'This full-width widget area is located before the footer of your website. Widgets of this widget area are displayed on the default homepage of your website (when you are showing your latest posts on homepage).', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget cutemag-bottom-fullwidth-widget cutemag-box widget %2$s"><div class="cutemag-bottom-fullwidth-widget-inside cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));


register_sidebar(array(
    'id' => 'cutemag-single-post-bottom-widgets',
    'name' => esc_html__( 'Single Post Bottom Widgets', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located at the bottom of single post of any post type (except attachments and pages).', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-main-widget widget cutemag-box %2$s"><div class="cutemag-box-inside">',
    'after_widget' => '</div></div>',
    'before_title' => '<div class="cutemag-widget-header"><h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2></div>'));

register_sidebar(array(
    'id' => 'cutemag-top-footer',
    'name' => esc_html__( 'Footer Top', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located on the top of the footer of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'cutemag-footer-1',
    'name' => esc_html__( 'Footer 1', 'cutemag' ),
    'description' => esc_html__( 'This widget area is the column 1 of the footer of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'cutemag-footer-2',
    'name' => esc_html__( 'Footer 2', 'cutemag' ),
    'description' => esc_html__( 'This widget area is the column 2 of the footer of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'cutemag-footer-3',
    'name' => esc_html__( 'Footer 3', 'cutemag' ),
    'description' => esc_html__( 'This widget area is the column 3 of the footer of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'cutemag-footer-4',
    'name' => esc_html__( 'Footer 4', 'cutemag' ),
    'description' => esc_html__( 'This widget area is the column 4 of the footer of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'cutemag-footer-5',
    'name' => esc_html__( 'Footer 5', 'cutemag' ),
    'description' => esc_html__( 'This widget area is the column 5 of the footer of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'cutemag-footer-6',
    'name' => esc_html__( 'Footer 6', 'cutemag' ),
    'description' => esc_html__( 'This widget area is the column 6 of the footer of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2>'));

register_sidebar(array(
    'id' => 'cutemag-bottom-footer',
    'name' => esc_html__( 'Footer Bottom', 'cutemag' ),
    'description' => esc_html__( 'This widget area is located on the bottom of the footer of your website.', 'cutemag' ),
    'before_widget' => '<div id="%1$s" class="cutemag-footer-widget widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="cutemag-widget-title"><span class="cutemag-widget-title-inside">',
    'after_title' => '</span></h2>'));

}
add_action( 'widgets_init', 'cutemag_widgets_init' );


function cutemag_sidebar_one_widgets() {
    if ( is_front_page() && is_home() && !is_paged() ) {
    dynamic_sidebar( 'cutemag-home-sidebar' );
    }

    dynamic_sidebar( 'cutemag-sidebar' );
}


function cutemag_top_wide_widgets() { ?>

<?php if ( is_active_sidebar( 'cutemag-home-fullwidth-widgets' ) || is_active_sidebar( 'cutemag-fullwidth-widgets' ) ) : ?>
<div class="cutemag-top-wrapper-outer cutemag-clearfix">
<div class="cutemag-featured-posts-area cutemag-top-wrapper cutemag-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'cutemag-home-fullwidth-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'cutemag-fullwidth-widgets' ); ?>
</div>
</div>
<?php endif; ?>

<?php }


function cutemag_top_widgets() { ?>

<?php if ( is_active_sidebar( 'cutemag-home-top-widgets' ) || is_active_sidebar( 'cutemag-top-widgets' ) ) : ?>
<div class="cutemag-featured-posts-area cutemag-featured-posts-area-top cutemag-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'cutemag-home-top-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'cutemag-top-widgets' ); ?>
</div>
<?php endif; ?>

<?php }


function cutemag_bottom_widgets() { ?>

<?php if ( is_active_sidebar( 'cutemag-home-bottom-widgets' ) || is_active_sidebar( 'cutemag-bottom-widgets' ) ) : ?>
<div class='cutemag-featured-posts-area cutemag-featured-posts-area-bottom cutemag-clearfix'>
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'cutemag-home-bottom-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'cutemag-bottom-widgets' ); ?>
</div>
<?php endif; ?>

<?php }


function cutemag_bottom_wide_widgets() { ?>

<?php if ( is_active_sidebar( 'cutemag-home-fullwidth-bottom-widgets' ) || is_active_sidebar( 'cutemag-fullwidth-bottom-widgets' ) ) : ?>
<div class="cutemag-bottom-wrapper-outer cutemag-clearfix">
<div class="cutemag-featured-posts-area cutemag-bottom-wrapper cutemag-clearfix">
<?php if ( is_front_page() && is_home() && !is_paged() ) { ?>
<?php dynamic_sidebar( 'cutemag-home-fullwidth-bottom-widgets' ); ?>
<?php } ?>

<?php dynamic_sidebar( 'cutemag-fullwidth-bottom-widgets' ); ?>
</div>
</div>
<?php endif; ?>

<?php }


function cutemag_post_bottom_widgets() {
    if ( is_active_sidebar( 'cutemag-single-post-bottom-widgets' ) ) : ?>
        <div class="cutemag-featured-posts-area cutemag-clearfix">
        <?php dynamic_sidebar( 'cutemag-single-post-bottom-widgets' ); ?>
        </div>
    <?php endif;
}


/**
* Post share buttons
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function cutemag_share_text_home() {
    $sharetext = esc_html__( 'Share:', 'cutemag' );
    if ( cutemag_get_option('hide_share_text_home') ) {return;}
    if ( cutemag_get_option('share_text_home') ) {
        $sharetext = cutemag_get_option('share_text_home');
    }
    return apply_filters( 'cutemag_share_text_home', $sharetext );
}

function cutemag_small_share_buttons() {

        global $post;

        // Get current page URL 
        $posturl = rawurlencode(get_permalink($post->ID));

        // Get current page title
        $posttitle = rawurlencode(the_title_attribute('echo=0'));

        // Construct sharing URL without using any script
        $twitter_url = 'https://twitter.com/intent/tweet?text='.$posttitle.'&amp;url='.$posturl;
        $facebook_url = 'https://www.facebook.com/sharer.php?u='.$posturl;
        $linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&amp;title='.$posttitle.'&amp;url='.$posturl;

        $image_url_regex = '/(http(s?):)([\/|.|\w|\s|-])*\.(?:jpg|jpeg|gif|png)/i';
        $postthumb = '';
        $postthumb_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false );
        $postthumb = isset($postthumb_attributes[0]) ? $postthumb_attributes[0] : '';

        if(!empty($postthumb)) {
            $pinterest_url = 'https://pinterest.com/pin/create/button/?url='.$posturl.'&amp;media='.$postthumb.'&amp;description='.$posttitle;
        }

        // Add sharing button at the end of page/page content
        $socialcontent = '<div class="cutemag-small-share-buttons cutemag-grid-post-block cutemag-clearfix"><div class="cutemag-small-share-buttons-inside cutemag-clearfix"><span class="cutemag-small-share-text">'.wp_kses_post(cutemag_share_text_home()).' </span>';
        if ( !(cutemag_get_option('hide_share_twitter_home')) ) {
            $socialcontent .= '<a class="cutemag-small-share-buttons-twitter" href="'.esc_url($twitter_url).'" target="_blank" rel="nofollow" title="'.esc_attr__('Tweet This!', 'cutemag').' : '.the_title_attribute('echo=0').'"><i class="fab fa-twitter" aria-hidden="true"></i>'.esc_html__('Twitter', 'cutemag').'<span class="cutemag-sr-only"> : '.esc_html( get_the_title() ).'</span></a>';
        }
        if ( !(cutemag_get_option('hide_share_facebook_home')) ) {
            $socialcontent .= '<a class="cutemag-small-share-buttons-facebook" href="'.esc_url($facebook_url).'" target="_blank" rel="nofollow" title="'.esc_attr__('Share this on Facebook', 'cutemag').' : '.the_title_attribute('echo=0').'"><i class="fab fa-facebook-f" aria-hidden="true"></i>'.esc_html__('Facebook', 'cutemag').'<span class="cutemag-sr-only"> : '.esc_html( get_the_title() ).'</span></a>';
        }
        if ( !(cutemag_get_option('hide_share_pinterest_home')) && !(empty($postthumb)) ) {
            $socialcontent .= '<a class="cutemag-small-share-buttons-pinterest" href="'.esc_url($pinterest_url).'" target="_blank" rel="nofollow" title="'.esc_attr__('Share this on Pinterest', 'cutemag').' : '.the_title_attribute('echo=0').'"><i class="fab fa-pinterest" aria-hidden="true"></i>'.esc_html__('Pinterest', 'cutemag').'<span class="cutemag-sr-only"> : '.esc_html( get_the_title() ).'</span></a>';
        }
        if ( !(cutemag_get_option('hide_share_linkedin_home')) ) {
            $socialcontent .= '<a class="cutemag-small-share-buttons-linkedin" href="'.esc_url($linkedin_url).'" target="_blank" rel="nofollow" title="'.esc_attr__('Share this on Linkedin', 'cutemag').' : '.the_title_attribute('echo=0').'"><i class="fab fa-linkedin-in" aria-hidden="true"></i>'.esc_html__('Linkedin', 'cutemag').'<span class="cutemag-sr-only"> : '.esc_html( get_the_title() ).'</span></a>';
        }
        $socialcontent .= '</div></div>';

        return apply_filters( 'cutemag_small_share_buttons', $socialcontent );

}


/**
* Social buttons
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function cutemag_header_social_buttons() { ?>

<div class='cutemag-social-icons'>
    <?php if ( cutemag_get_option('twitterlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('twitterlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-twitter" aria-label="<?php esc_attr_e('Twitter Button','cutemag'); ?>"><i class="fab fa-twitter" aria-hidden="true" title="<?php esc_attr_e('Twitter','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('facebooklink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('facebooklink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-facebook" aria-label="<?php esc_attr_e('Facebook Button','cutemag'); ?>"><i class="fab fa-facebook-f" aria-hidden="true" title="<?php esc_attr_e('Facebook','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('googlelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('googlelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-google-plus" aria-label="<?php esc_attr_e('Google Plus Button','cutemag'); ?>"><i class="fab fa-google-plus-g" aria-hidden="true" title="<?php esc_attr_e('Google Plus','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('pinterestlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('pinterestlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-pinterest" aria-label="<?php esc_attr_e('Pinterest Button','cutemag'); ?>"><i class="fab fa-pinterest" aria-hidden="true" title="<?php esc_attr_e('Pinterest','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('linkedinlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('linkedinlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-linkedin" aria-label="<?php esc_attr_e('Linkedin Button','cutemag'); ?>"><i class="fab fa-linkedin-in" aria-hidden="true" title="<?php esc_attr_e('Linkedin','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('instagramlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('instagramlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-instagram" aria-label="<?php esc_attr_e('Instagram Button','cutemag'); ?>"><i class="fab fa-instagram" aria-hidden="true" title="<?php esc_attr_e('Instagram','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('flickrlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('flickrlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-flickr" aria-label="<?php esc_attr_e('Flickr Button','cutemag'); ?>"><i class="fab fa-flickr" aria-hidden="true" title="<?php esc_attr_e('Flickr','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('youtubelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('youtubelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-youtube" aria-label="<?php esc_attr_e('Youtube Button','cutemag'); ?>"><i class="fab fa-youtube" aria-hidden="true" title="<?php esc_attr_e('Youtube','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('vimeolink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('vimeolink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-vimeo" aria-label="<?php esc_attr_e('Vimeo Button','cutemag'); ?>"><i class="fab fa-vimeo-v" aria-hidden="true" title="<?php esc_attr_e('Vimeo','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('soundcloudlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('soundcloudlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-soundcloud" aria-label="<?php esc_attr_e('SoundCloud Button','cutemag'); ?>"><i class="fab fa-soundcloud" aria-hidden="true" title="<?php esc_attr_e('SoundCloud','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('messengerlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('messengerlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-messenger" aria-label="<?php esc_attr_e('Messenger Button','cutemag'); ?>"><i class="fab fa-facebook-messenger" aria-hidden="true" title="<?php esc_attr_e('Messenger','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('whatsapplink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('whatsapplink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-whatsapp" aria-label="<?php esc_attr_e('WhatsApp Button','cutemag'); ?>"><i class="fab fa-whatsapp" aria-hidden="true" title="<?php esc_attr_e('WhatsApp','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('lastfmlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('lastfmlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-lastfm" aria-label="<?php esc_attr_e('Lastfm Button','cutemag'); ?>"><i class="fab fa-lastfm" aria-hidden="true" title="<?php esc_attr_e('Lastfm','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('mediumlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('mediumlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-medium" aria-label="<?php esc_attr_e('Medium Button','cutemag'); ?>"><i class="fab fa-medium-m" aria-hidden="true" title="<?php esc_attr_e('Medium','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('githublink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('githublink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-github" aria-label="<?php esc_attr_e('Github Button','cutemag'); ?>"><i class="fab fa-github" aria-hidden="true" title="<?php esc_attr_e('Github','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('bitbucketlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('bitbucketlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-bitbucket" aria-label="<?php esc_attr_e('Bitbucket Button','cutemag'); ?>"><i class="fab fa-bitbucket" aria-hidden="true" title="<?php esc_attr_e('Bitbucket','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('tumblrlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('tumblrlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-tumblr" aria-label="<?php esc_attr_e('Tumblr Button','cutemag'); ?>"><i class="fab fa-tumblr" aria-hidden="true" title="<?php esc_attr_e('Tumblr','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('digglink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('digglink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-digg" aria-label="<?php esc_attr_e('Digg Button','cutemag'); ?>"><i class="fab fa-digg" aria-hidden="true" title="<?php esc_attr_e('Digg','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('deliciouslink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('deliciouslink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-delicious" aria-label="<?php esc_attr_e('Delicious Button','cutemag'); ?>"><i class="fab fa-delicious" aria-hidden="true" title="<?php esc_attr_e('Delicious','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('stumblelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('stumblelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-stumbleupon" aria-label="<?php esc_attr_e('Stumbleupon Button','cutemag'); ?>"><i class="fab fa-stumbleupon" aria-hidden="true" title="<?php esc_attr_e('Stumbleupon','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('mixlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('mixlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-mix" aria-label="<?php esc_attr_e('Mix Button','cutemag'); ?>"><i class="fab fa-mix" aria-hidden="true" title="<?php esc_attr_e('Mix','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('redditlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('redditlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-reddit" aria-label="<?php esc_attr_e('Reddit Button','cutemag'); ?>"><i class="fab fa-reddit" aria-hidden="true" title="<?php esc_attr_e('Reddit','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('dribbblelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('dribbblelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-dribbble" aria-label="<?php esc_attr_e('Dribbble Button','cutemag'); ?>"><i class="fab fa-dribbble" aria-hidden="true" title="<?php esc_attr_e('Dribbble','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('flipboardlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('flipboardlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-flipboard" aria-label="<?php esc_attr_e('Flipboard Button','cutemag'); ?>"><i class="fab fa-flipboard" aria-hidden="true" title="<?php esc_attr_e('Flipboard','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('bloggerlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('bloggerlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-blogger" aria-label="<?php esc_attr_e('Blogger Button','cutemag'); ?>"><i class="fab fa-blogger" aria-hidden="true" title="<?php esc_attr_e('Blogger','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('etsylink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('etsylink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-etsy" aria-label="<?php esc_attr_e('Etsy Button','cutemag'); ?>"><i class="fab fa-etsy" aria-hidden="true" title="<?php esc_attr_e('Etsy','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('behancelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('behancelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-behance" aria-label="<?php esc_attr_e('Behance Button','cutemag'); ?>"><i class="fab fa-behance" aria-hidden="true" title="<?php esc_attr_e('Behance','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('amazonlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('amazonlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-amazon" aria-label="<?php esc_attr_e('Amazon Button','cutemag'); ?>"><i class="fab fa-amazon" aria-hidden="true" title="<?php esc_attr_e('Amazon','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('meetuplink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('meetuplink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-meetup" aria-label="<?php esc_attr_e('Meetup Button','cutemag'); ?>"><i class="fab fa-meetup" aria-hidden="true" title="<?php esc_attr_e('Meetup','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('mixcloudlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('mixcloudlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-mixcloud" aria-label="<?php esc_attr_e('Mixcloud Button','cutemag'); ?>"><i class="fab fa-mixcloud" aria-hidden="true" title="<?php esc_attr_e('Mixcloud','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('slacklink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('slacklink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-slack" aria-label="<?php esc_attr_e('Slack Button','cutemag'); ?>"><i class="fab fa-slack" aria-hidden="true" title="<?php esc_attr_e('Slack','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('snapchatlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('snapchatlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-snapchat" aria-label="<?php esc_attr_e('Snapchat Button','cutemag'); ?>"><i class="fab fa-snapchat" aria-hidden="true" title="<?php esc_attr_e('Snapchat','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('spotifylink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('spotifylink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-spotify" aria-label="<?php esc_attr_e('Spotify Button','cutemag'); ?>"><i class="fab fa-spotify" aria-hidden="true" title="<?php esc_attr_e('Spotify','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('yelplink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('yelplink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-yelp" aria-label="<?php esc_attr_e('Yelp Button','cutemag'); ?>"><i class="fab fa-yelp" aria-hidden="true" title="<?php esc_attr_e('Yelp','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('wordpresslink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('wordpresslink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-wordpress" aria-label="<?php esc_attr_e('WordPress Button','cutemag'); ?>"><i class="fab fa-wordpress" aria-hidden="true" title="<?php esc_attr_e('WordPress','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('twitchlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('twitchlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-twitch" aria-label="<?php esc_attr_e('Twitch Button','cutemag'); ?>"><i class="fab fa-twitch" aria-hidden="true" title="<?php esc_attr_e('Twitch','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('telegramlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('telegramlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-telegram" aria-label="<?php esc_attr_e('Telegram Button','cutemag'); ?>"><i class="fab fa-telegram" aria-hidden="true" title="<?php esc_attr_e('Telegram','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('bandcamplink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('bandcamplink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-bandcamp" aria-label="<?php esc_attr_e('Bandcamp Button','cutemag'); ?>"><i class="fab fa-bandcamp" aria-hidden="true" title="<?php esc_attr_e('Bandcamp','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('quoralink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('quoralink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-quora" aria-label="<?php esc_attr_e('Quora Button','cutemag'); ?>"><i class="fab fa-quora" aria-hidden="true" title="<?php esc_attr_e('Quora','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('foursquarelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('foursquarelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-foursquare" aria-label="<?php esc_attr_e('Foursquare Button','cutemag'); ?>"><i class="fab fa-foursquare" aria-hidden="true" title="<?php esc_attr_e('Foursquare','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('deviantartlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('deviantartlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-deviantart" aria-label="<?php esc_attr_e('DeviantArt Button','cutemag'); ?>"><i class="fab fa-deviantart" aria-hidden="true" title="<?php esc_attr_e('DeviantArt','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('imdblink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('imdblink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-imdb" aria-label="<?php esc_attr_e('IMDB Button','cutemag'); ?>"><i class="fab fa-imdb" aria-hidden="true" title="<?php esc_attr_e('IMDB','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('vklink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('vklink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-vk" aria-label="<?php esc_attr_e('VK Button','cutemag'); ?>"><i class="fab fa-vk" aria-hidden="true" title="<?php esc_attr_e('VK','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('codepenlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('codepenlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-codepen" aria-label="<?php esc_attr_e('Codepen Button','cutemag'); ?>"><i class="fab fa-codepen" aria-hidden="true" title="<?php esc_attr_e('Codepen','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('jsfiddlelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('jsfiddlelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-jsfiddle" aria-label="<?php esc_attr_e('JSFiddle Button','cutemag'); ?>"><i class="fab fa-jsfiddle" aria-hidden="true" title="<?php esc_attr_e('JSFiddle','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('stackoverflowlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('stackoverflowlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-stackoverflow" aria-label="<?php esc_attr_e('Stack Overflow Button','cutemag'); ?>"><i class="fab fa-stack-overflow" aria-hidden="true" title="<?php esc_attr_e('Stack Overflow','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('stackexchangelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('stackexchangelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-stackexchange" aria-label="<?php esc_attr_e('Stack Exchange Button','cutemag'); ?>"><i class="fab fa-stack-exchange" aria-hidden="true" title="<?php esc_attr_e('Stack Exchange','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('bsalink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('bsalink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-buysellads" aria-label="<?php esc_attr_e('BuySellAds Button','cutemag'); ?>"><i class="fab fa-buysellads" aria-hidden="true" title="<?php esc_attr_e('BuySellAds','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('web500pxlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('web500pxlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-web500px" aria-label="<?php esc_attr_e('500px Button','cutemag'); ?>"><i class="fab fa-500px" aria-hidden="true" title="<?php esc_attr_e('500px','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('ellolink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('ellolink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-ello" aria-label="<?php esc_attr_e('Ello Button','cutemag'); ?>"><i class="fab fa-ello" aria-hidden="true" title="<?php esc_attr_e('Ello','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('goodreadslink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('goodreadslink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-goodreads" aria-label="<?php esc_attr_e('Goodreads Button','cutemag'); ?>"><i class="fab fa-goodreads" aria-hidden="true" title="<?php esc_attr_e('Goodreads','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('odnoklassnikilink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('odnoklassnikilink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-odnoklassniki" aria-label="<?php esc_attr_e('Odnoklassniki Button','cutemag'); ?>"><i class="fab fa-odnoklassniki" aria-hidden="true" title="<?php esc_attr_e('Odnoklassniki','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('houzzlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('houzzlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-houzz" aria-label="<?php esc_attr_e('Houzz Button','cutemag'); ?>"><i class="fab fa-houzz" aria-hidden="true" title="<?php esc_attr_e('Houzz','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('pocketlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('pocketlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-pocket" aria-label="<?php esc_attr_e('Pocket Button','cutemag'); ?>"><i class="fab fa-get-pocket" aria-hidden="true" title="<?php esc_attr_e('Pocket','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('xinglink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('xinglink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-xing" aria-label="<?php esc_attr_e('XING Button','cutemag'); ?>"><i class="fab fa-xing" aria-hidden="true" title="<?php esc_attr_e('XING','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('googleplaylink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('googleplaylink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-googleplay" aria-label="<?php esc_attr_e('Google Play Button','cutemag'); ?>"><i class="fab fa-google-play" aria-hidden="true" title="<?php esc_attr_e('Google Play','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('slidesharelink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('slidesharelink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-slideshare" aria-label="<?php esc_attr_e('SlideShare Button','cutemag'); ?>"><i class="fab fa-slideshare" aria-hidden="true" title="<?php esc_attr_e('SlideShare','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('dropboxlink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('dropboxlink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-dropbox" aria-label="<?php esc_attr_e('Dropbox Button','cutemag'); ?>"><i class="fab fa-dropbox" aria-hidden="true" title="<?php esc_attr_e('Dropbox','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('paypallink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('paypallink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-paypal" aria-label="<?php esc_attr_e('PayPal Button','cutemag'); ?>"><i class="fab fa-paypal" aria-hidden="true" title="<?php esc_attr_e('PayPal','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('viadeolink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('viadeolink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-viadeo" aria-label="<?php esc_attr_e('Viadeo Button','cutemag'); ?>"><i class="fab fa-viadeo" aria-hidden="true" title="<?php esc_attr_e('Viadeo','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('wikipedialink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('wikipedialink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-wikipedia" aria-label="<?php esc_attr_e('Wikipedia Button','cutemag'); ?>"><i class="fab fa-wikipedia-w" aria-hidden="true" title="<?php esc_attr_e('Wikipedia','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('skypeusername') ) : ?>
            <a href="skype:<?php echo esc_html( cutemag_get_option('skypeusername') ); ?>?chat" class="cutemag-social-icon-skype" aria-label="<?php esc_attr_e('Skype Button','cutemag'); ?>"><i class="fab fa-skype" aria-hidden="true" title="<?php esc_attr_e('Skype','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('emailaddress') ) : ?>
            <a href="mailto:<?php echo esc_html( cutemag_get_option('emailaddress') ); ?>" class="cutemag-social-icon-email" aria-label="<?php esc_attr_e('Email Us Button','cutemag'); ?>"><i class="far fa-envelope" aria-hidden="true" title="<?php esc_attr_e('Email Us','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('rsslink') ) : ?>
            <a href="<?php echo esc_url( cutemag_get_option('rsslink') ); ?>" target="_blank" rel="nofollow" class="cutemag-social-icon-rss" aria-label="<?php esc_attr_e('RSS Button','cutemag'); ?>"><i class="fas fa-rss" aria-hidden="true" title="<?php esc_attr_e('RSS','cutemag'); ?>"></i></a><?php endif; ?>
    <?php if ( cutemag_get_option('show_login_button') ) { ?><?php if (is_user_logged_in()) : ?><a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" class="cutemag-social-icon-login" aria-label="<?php esc_attr_e( 'Logout Button', 'cutemag' ); ?>"><i class="fas fa-sign-out-alt" aria-hidden="true" title="<?php esc_attr_e( 'Logout Button', 'cutemag' ); ?>"></i></a><?php else : ?><a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>" class="cutemag-social-icon-login" aria-label="<?php esc_attr_e( 'Login / Register', 'cutemag' ); ?>"><i class="fas fa-sign-in-alt" aria-hidden="true" title="<?php esc_attr_e( 'Login / Register Button', 'cutemag' ); ?>"></i></a><?php endif;?><?php } ?>
    <?php if ( !(cutemag_get_option('hide_search_button')) ) { ?><a href="<?php echo esc_url( '#' ); ?>" class="cutemag-social-icon-search" aria-label="<?php esc_attr_e('Search Button','cutemag'); ?>"><i class="fas fa-search" aria-hidden="true" title="<?php esc_attr_e('Search','cutemag'); ?>"></i></a><?php } ?>
</div>

<?php }


/**
* Author bio box
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

// Author bio box
function cutemag_add_author_bio_box() {
    $content='';
    if (is_single()) {
        $content .= '
            <div class="cutemag-author-bio">
            <div class="cutemag-author-bio-inside">
            <div class="cutemag-author-bio-top">
            <span class="cutemag-author-bio-gravatar">
                '. get_avatar( get_the_author_meta('email') , 80 ) .'
            </span>
            <div class="cutemag-author-bio-text">
                <div class="cutemag-author-bio-name">'.esc_html__( 'Author: ', 'cutemag' ).'<span>'. get_the_author_link() .'</span></div><div class="cutemag-author-bio-text-description">'. wp_kses_post( get_the_author_meta('description',get_query_var('author') ) ) .'</div>
            </div>
            </div>
            </div>
            </div>
        ';
    }
    return apply_filters( 'cutemag_add_author_bio_box', $content );
}


/**
* Post meta functions
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! function_exists( 'cutemag_post_tags' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
function cutemag_post_tags() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'cutemag' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<span class="cutemag-tags-links"><i class="fas fa-tags" aria-hidden="true"></i> ' . esc_html__( 'Tagged %1$s', 'cutemag' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}
endif;

if ( ! function_exists( 'cutemag_compactview_postmeta' ) ) :
function cutemag_compactview_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( !(cutemag_get_option('hide_post_author_home')) || !(cutemag_get_option('hide_posted_date_home')) || !(cutemag_get_option('hide_comments_link_home')) ) { ?>
    <div class="cutemag-compact-post-footer cutemag-fp-post-footer">
    <?php if ( !(cutemag_get_option('hide_post_author_home')) ) { ?><span class="cutemag-compact-post-author cutemag-fp-post-author cutemag-compact-post-meta cutemag-fp-post-meta"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
    <?php if ( !(cutemag_get_option('hide_posted_date_home')) ) { ?><span class="cutemag-compact-post-date cutemag-fp-post-date cutemag-compact-post-meta cutemag-fp-post-meta"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html(get_the_date()); ?></span><?php } ?>
    <?php if ( !(cutemag_get_option('hide_comments_link_home')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="cutemag-compact-post-comment cutemag-fp-post-comment cutemag-compact-post-meta cutemag-fp-post-meta"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( '0 Comments<span class="cutemag-sr-only"> on %s</span>', 'cutemag' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;

if ( ! function_exists( 'cutemag_single_cats' ) ) :
function cutemag_single_cats() {
    if ( 'post' == get_post_type() ) {
        /* translators: used between list items, there is a space */
        $categories_list = get_the_category_list( esc_html__( ', ', 'cutemag' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<div class="cutemag-entry-meta-single cutemag-entry-meta-single-top"><span class="cutemag-entry-meta-single-cats"><i class="far fa-folder-open" aria-hidden="true"></i>&nbsp;' . __( '<span class="cutemag-sr-only">Posted in </span>%1$s', 'cutemag' ) . '</span></div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}
endif;

if ( ! function_exists( 'cutemag_single_postmeta' ) ) :
function cutemag_single_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( !(cutemag_get_option('hide_post_author')) || !(cutemag_get_option('hide_posted_date')) || !(cutemag_get_option('hide_comments_link')) || !(cutemag_get_option('hide_post_edit')) ) { ?>
    <div class="cutemag-entry-meta-single">
    <?php if ( !(cutemag_get_option('hide_post_author')) ) { ?><span class="cutemag-entry-meta-single-author"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(cutemag_get_option('hide_posted_date')) ) { ?><span class="cutemag-entry-meta-single-date"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html( get_the_date() ); ?></span><?php } ?>
    <?php if ( !(cutemag_get_option('hide_comments_link')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="cutemag-entry-meta-single-comments"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="cutemag-sr-only"> on %s</span>', 'cutemag' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    <?php if ( !(cutemag_get_option('hide_post_edit')) ) { ?><?php edit_post_link( sprintf( wp_kses( /* translators: %s: Name of current post. Only visible to screen readers */ __( 'Edit<span class="cutemag-sr-only"> %s</span>', 'cutemag' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ), '<span class="edit-link">&nbsp;&nbsp;<i class="far fa-edit" aria-hidden="true"></i> ', '</span>' ); ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;

if ( ! function_exists( 'cutemag_page_postmeta' ) ) :
function cutemag_page_postmeta() { ?>
    <?php global $post; ?>
    <?php if ( !(cutemag_get_option('hide_page_author')) || !(cutemag_get_option('hide_page_date')) || !(cutemag_get_option('hide_page_comments')) ) { ?>
    <div class="cutemag-entry-meta-single cutemag-entry-meta-page">
    <?php if ( !(cutemag_get_option('hide_page_author')) ) { ?><span class="cutemag-entry-meta-single-author"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<span class="author vcard" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span></span><?php } ?>
    <?php if ( !(cutemag_get_option('hide_page_date')) ) { ?><span class="cutemag-entry-meta-single-date"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html(get_the_date()); ?></span><?php } ?>
    <?php if ( !(cutemag_get_option('hide_page_comments')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
    <span class="cutemag-entry-meta-single-comments"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="cutemag-sr-only"> on %s</span>', 'cutemag' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
    <?php } ?><?php } ?>
    </div>
    <?php } ?>
<?php }
endif;


/**
* Posts navigation functions
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! function_exists( 'cutemag_wp_pagenavi' ) ) :
function cutemag_wp_pagenavi() {
    ?>
    <nav class="navigation posts-navigation cutemag-clearfix" role="navigation">
        <?php wp_pagenavi(); ?>
    </nav><!-- .navigation -->
    <?php
}
endif;

if ( ! function_exists( 'cutemag_posts_navigation' ) ) :
function cutemag_posts_navigation() {
    if ( !(cutemag_get_option('hide_posts_navigation')) ) {
        if ( function_exists( 'wp_pagenavi' ) ) {
            cutemag_wp_pagenavi();
        } else {
            if ( cutemag_get_option('posts_navigation_type') === 'normalnavi' ) {
                the_posts_navigation(array('prev_text' => esc_html__( 'Older posts', 'cutemag' ), 'next_text' => esc_html__( 'Newer posts', 'cutemag' )));
            } else {
                the_posts_pagination(array('mid_size' => 2, 'prev_text' => esc_html__( '&larr; Newer posts', 'cutemag' ), 'next_text' => esc_html__( 'Older posts &rarr;', 'cutemag' )));
            }
        }
    }
}
endif;

if ( ! function_exists( 'cutemag_post_navigation' ) ) :
function cutemag_post_navigation() {
global $post;
if ( !(cutemag_get_option('hide_post_navigation')) ) {
    the_post_navigation(array('prev_text' => esc_html__( '%title &rarr;', 'cutemag' ), 'next_text' => esc_html__( '&larr; %title', 'cutemag' )));
}
}
endif;


/**
* Menu Functions
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a "Home" link as the first item
function cutemag_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'cutemag_page_menu_args' );

function cutemag_primary_menu_text() {
   $menu_text = esc_html__( 'Menu', 'cutemag' );
    if ( cutemag_get_option('primary_menu_text') ) {
        $menu_text = cutemag_get_option('primary_menu_text');
    }
   return apply_filters( 'cutemag_primary_menu_text', $menu_text );
}

function cutemag_secondary_menu_text() {
   $menu_text = esc_html__( 'Menu', 'cutemag' );
    if ( cutemag_get_option('secondary_menu_text') ) {
        $menu_text = cutemag_get_option('secondary_menu_text');
    }
   return apply_filters( 'cutemag_secondary_menu_text', $menu_text );
}

function cutemag_primary_fallback_menu() {
    wp_page_menu( array(
        'sort_column'  => 'menu_order, post_title',
        'menu_id'      => 'cutemag-menu-primary-navigation',
        'menu_class'   => 'cutemag-primary-nav-menu cutemag-menu-primary',
        'container'    => 'ul',
        'echo'         => true,
        'link_before'  => '',
        'link_after'   => '',
        'before'       => '',
        'after'        => '',
        'item_spacing' => 'discard',
        'walker'       => '',
    ) );
}

function cutemag_secondary_fallback_menu() {
   wp_page_menu( array(
        'sort_column'  => 'menu_order, post_title',
        'menu_id'      => 'cutemag-menu-secondary-navigation',
        'menu_class'   => 'cutemag-secondary-nav-menu cutemag-menu-secondary',
        'container'    => 'ul',
        'echo'         => true,
        'link_before'  => '',
        'link_after'   => '',
        'before'       => '',
        'after'        => '',
        'item_spacing' => 'discard',
        'walker'       => '',
    ) );
}

function cutemag_primary_menu_area() {
if ( (cutemag_is_primary_menu_active()) || (('primary-menu' === cutemag_social_buttons_location()) && cutemag_is_social_buttons_active()) ) { ?>
<div class="cutemag-container cutemag-primary-menu-container cutemag-clearfix">
<div class="cutemag-outer-wrapper">
<div class="cutemag-primary-menu-container-inside cutemag-clearfix">
<nav class="cutemag-nav-primary" id="cutemag-primary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'cutemag' ); ?>">

<?php if ( cutemag_is_primary_menu_active() ) { ?>
<button class="cutemag-primary-responsive-menu-icon" aria-controls="cutemag-menu-primary-navigation" aria-expanded="false"><?php echo esc_html( cutemag_primary_menu_text() ); ?></button>
<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'cutemag-menu-primary-navigation', 'menu_class' => 'cutemag-primary-nav-menu cutemag-menu-primary', 'fallback_cb' => 'cutemag_primary_fallback_menu', 'container' => '', ) ); ?>
<?php } ?>

<?php if ( 'primary-menu' === cutemag_social_buttons_location() ) { ?>
    <?php if ( cutemag_is_social_buttons_active() ) { ?>
        <?php cutemag_header_social_buttons(); ?>
        <div id="cutemag-search-overlay-wrap" class="cutemag-search-overlay">
          <div class="cutemag-search-overlay-content">
            <?php get_search_form(); ?>
          </div>
          <button class="cutemag-search-closebtn" aria-label="<?php esc_attr_e( 'Close Search', 'cutemag' ); ?>" title="<?php esc_attr_e('Close Search','cutemag'); ?>">&#xD7;</button>
        </div>
    <?php } ?>
<?php } ?>

</nav>
</div>
</div>
</div>
<?php }
}

function cutemag_secondary_menu_area() {
if ( (cutemag_is_secondary_menu_active()) || (('secondary-menu' === cutemag_social_buttons_location()) && cutemag_is_social_buttons_active()) ) { ?>
<div class="cutemag-container cutemag-secondary-menu-container cutemag-clearfix">
<div class="cutemag-outer-wrapper">
<div class="cutemag-secondary-menu-container-inside cutemag-clearfix">
<nav class="cutemag-nav-secondary" id="cutemag-secondary-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation" aria-label="<?php esc_attr_e( 'Secondary Menu', 'cutemag' ); ?>">

<?php if ( cutemag_is_secondary_menu_active() ) { ?>
<button class="cutemag-secondary-responsive-menu-icon" aria-controls="cutemag-menu-secondary-navigation" aria-expanded="false"><?php echo esc_html( cutemag_secondary_menu_text() ); ?></button>
<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'cutemag-menu-secondary-navigation', 'menu_class' => 'cutemag-secondary-nav-menu cutemag-menu-secondary', 'fallback_cb' => 'cutemag_secondary_fallback_menu', 'container' => '', ) ); ?>
<?php } ?>

<?php if ( 'secondary-menu' === cutemag_social_buttons_location() ) { ?>
    <?php if ( cutemag_is_social_buttons_active() ) { ?>
        <?php cutemag_header_social_buttons(); ?>
        <div id="cutemag-search-overlay-wrap" class="cutemag-search-overlay">
          <div class="cutemag-search-overlay-content">
            <?php get_search_form(); ?>
          </div>
          <button class="cutemag-search-closebtn" aria-label="<?php esc_attr_e( 'Close Search', 'cutemag' ); ?>" title="<?php esc_attr_e('Close Search','cutemag'); ?>">&#xD7;</button>
        </div>
    <?php } ?>
<?php } ?>

</nav>
</div>
</div>
</div>
<?php }
}


/**
* Header Functions
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cutemag_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'cutemag_pingback_header' );

// Get custom-logo URL
function cutemag_custom_logo() {
    if ( ! has_custom_logo() ) {return;}
    $cutemag_custom_logo_id = get_theme_mod( 'custom_logo' );
    $cutemag_logo = wp_get_attachment_image_src( $cutemag_custom_logo_id , 'full' );
    $cutemag_logo_src = $cutemag_logo[0];
    return apply_filters( 'cutemag_custom_logo', $cutemag_logo_src );
}

// Site Title
function cutemag_site_title() {
    if ( is_front_page() && is_home() ) { ?>
            <h1 class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_home() ) { ?>
            <h1 class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_singular() ) { ?>
            <p class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_category() ) { ?>
            <p class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_tag() ) { ?>
            <p class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_author() ) { ?>
            <p class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_archive() && !is_category() && !is_tag() && !is_author() ) { ?>
            <p class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_search() ) { ?>
            <p class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } elseif ( is_404() ) { ?>
            <p class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } else { ?>
            <h1 class="cutemag-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php if ( !(cutemag_get_option('hide_tagline')) ) { ?><p class="cutemag-site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php }
}

function cutemag_header_image_destination() {
    $url = home_url( '/' );

    if ( cutemag_get_option('header_image_destination') ) {
        $url = cutemag_get_option('header_image_destination');
    }

    return apply_filters( 'cutemag_header_image_destination', $url );
}

function cutemag_header_image_markup() {
    if ( get_header_image() ) {
        if ( cutemag_get_option('remove_header_image_link') ) {
            the_header_image_tag( array( 'class' => 'cutemag-header-img', 'alt' => '' ) );
        } else { ?>
            <a href="<?php echo esc_url( cutemag_header_image_destination() ); ?>" rel="home" class="cutemag-header-img-link"><?php the_header_image_tag( array( 'class' => 'cutemag-header-img', 'alt' => '' ) ); ?></a>
        <?php }
    }
}

function cutemag_header_image_details() {
    $header_image_custom_title = '';
    if ( cutemag_get_option('header_image_custom_title') ) {
        $header_image_custom_title = cutemag_get_option('header_image_custom_title');
    }

    $header_image_custom_description = '';
    if ( cutemag_get_option('header_image_custom_description') ) {
        $header_image_custom_description = cutemag_get_option('header_image_custom_description');
    }

    if ( !(cutemag_get_option('hide_header_image_details')) ) { ?>
    <div class="cutemag-header-image-info">
    <div class="cutemag-header-image-info-inside">
    <?php if ( $header_image_custom_title ) { ?>
        <p class="cutemag-header-image-site-title cutemag-header-image-block"><?php echo wp_kses_post( force_balance_tags( do_shortcode($header_image_custom_title) ) ); ?></p>
    <?php } else { ?>
        <p class="cutemag-header-image-site-title cutemag-header-image-block"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
    <?php } ?>

    <?php if ( $header_image_custom_description ) { ?>
        <?php if ( !(cutemag_get_option('hide_header_image_description')) ) { ?><?php if ( $header_image_custom_description ) { ?><p class="cutemag-header-image-site-description cutemag-header-image-block"><?php echo wp_kses_post( force_balance_tags( do_shortcode($header_image_custom_description) ) ); ?></p><?php } ?><?php } ?>
    <?php } else { ?>
        <?php if ( !(cutemag_get_option('hide_header_image_description')) ) { ?><p class="cutemag-header-image-site-description cutemag-header-image-block"><?php bloginfo( 'description' ); ?></p><?php } ?>
    <?php } ?>
    </div>
    </div>
    <?php }
}

function cutemag_header_image_wrapper() {
    ?><div class="cutemag-outer-wrapper">
    <div class="cutemag-header-image cutemag-clearfix">
    <?php cutemag_header_image_markup(); ?>
    <?php cutemag_header_image_details(); ?>
    </div>
    </div><?php
}

function cutemag_header_image() {
    if ( cutemag_get_option('hide_header_image') ) { return; }
    if ( get_header_image() ) {
        cutemag_header_image_wrapper();
    }
}


/**
* Css Classes Functions
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

// Category ids in post class
function cutemag_category_id_class($classes) {
    global $post;
    foreach((get_the_category($post->ID)) as $category) {
        $classes [] = 'wpcat-' . $category->cat_ID . '-id';
    }
    return $classes;
}
add_filter('post_class', 'cutemag_category_id_class');


// Adds custom classes to the array of body classes.
function cutemag_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'cutemag-group-blog';
    }

    if ( !(cutemag_get_option('disable_loading_animation')) ) {
        $classes[] = 'cutemag-animated cutemag-fadein';
    }

    $classes[] = 'cutemag-theme-is-active';

    if ( get_header_image() ) {
        $classes[] = 'cutemag-header-image-active';
    }

    if ( has_custom_logo() ) {
        $classes[] = 'cutemag-custom-logo-active';
    }

    $classes[] = 'cutemag-layout-type-boxed';

    if ( is_page_template( array( 'template-full-width-page.php', 'template-full-width-post.php' ) ) ) {
       $classes[] = 'cutemag-layout-full-width';
    }

    if ( is_404() ) {
        $classes[] = 'cutemag-layout-full-width';
    }

    $classes[] = 'cutemag-header-banner-active';

    if ( cutemag_get_option('hide_tagline') ) {
        $classes[] = 'cutemag-tagline-inactive';
    }

    if ( 'beside-title' === cutemag_get_option('logo_location') ) {
        $classes[] = 'cutemag-logo-beside-title';
    } elseif ( 'above-title' === cutemag_get_option('logo_location') ) {
        $classes[] = 'cutemag-logo-above-title';
    } else {
        $classes[] = 'cutemag-logo-above-title';
    }

    if ( cutemag_is_primary_menu_active() ) {
        $classes[] = 'cutemag-primary-menu-active';
    } else {
        $classes[] = 'cutemag-primary-menu-inactive';
    }
    $classes[] = 'cutemag-primary-mobile-menu-active';


    if ( cutemag_is_secondary_menu_active() ) {
        $classes[] = 'cutemag-secondary-menu-active';
    } else {
        $classes[] = 'cutemag-secondary-menu-inactive';
    }
    $classes[] = 'cutemag-secondary-mobile-menu-active';

    $classes[] = 'cutemag-secondary-menu-before-header';

    if ( 'primary-menu' === cutemag_social_buttons_location() ) {
        $classes[] = 'cutemag-primary-social-icons';
    } else {
        $classes[] = 'cutemag-secondary-social-icons';
    }

    $classes[] = 'cutemag-table-css-active';

    return $classes;
}
add_filter( 'body_class', 'cutemag_body_classes' );


/* Posts container class */
function cutemag_posts_container_class() {
    if ( 'compactview' == cutemag_post_style() ) {
        $posts_container_class = 'cutemag-compact-posts-container cutemag-fpw-2-columns';
    } else {
        $posts_container_class = 'cutemag-default-posts-container';
    }
    return apply_filters( 'cutemag_posts_container_class', $posts_container_class );
}


/**
* More Custom Functions
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function cutemag_read_more_text() {
   $readmoretext = esc_html__( 'Continue Reading', 'cutemag' );
    if ( cutemag_get_option('read_more_text') ) {
            $readmoretext = cutemag_get_option('read_more_text');
    }
   return $readmoretext;
}

// Change excerpt length
function cutemag_excerpt_length($length) {
    if ( is_admin() ) {
        return $length;
    }
    $read_more_length = 20;
    if ( cutemag_get_option('read_more_length') ) {
        $read_more_length = cutemag_get_option('read_more_length');
    }
    return $read_more_length;
}
add_filter('excerpt_length', 'cutemag_excerpt_length');

// Change excerpt more word
function cutemag_excerpt_more($more) {
    if ( is_admin() ) {
        return $more;
    }
    return '...';
}
add_filter('excerpt_more', 'cutemag_excerpt_more');

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     */
    function wp_body_open() { // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
        /**
         * Triggered after the opening <body> tag.
         */
        do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
    }
endif;


/**
* Custom Hooks
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function cutemag_before_header() {
    do_action('cutemag_before_header');
}

function cutemag_after_header() {
    do_action('cutemag_after_header');
}

function cutemag_before_main_content() {
    do_action('cutemag_before_main_content');
}
add_action('cutemag_before_main_content', 'cutemag_top_widgets', 20 );

function cutemag_after_main_content() {
    do_action('cutemag_after_main_content');
}
add_action('cutemag_after_main_content', 'cutemag_bottom_widgets', 10 );

function cutemag_sidebar_one() {
    do_action('cutemag_sidebar_one');
}
add_action('cutemag_sidebar_one', 'cutemag_sidebar_one_widgets', 10 );

function cutemag_before_single_post() {
    do_action('cutemag_before_single_post');
}

function cutemag_before_single_post_title() {
    do_action('cutemag_before_single_post_title');
}

function cutemag_after_single_post_title() {
    do_action('cutemag_after_single_post_title');
}

function cutemag_after_single_post_content() {
    do_action('cutemag_after_single_post_content');
}

function cutemag_after_single_post() {
    do_action('cutemag_after_single_post');
}

function cutemag_before_single_page() {
    do_action('cutemag_before_single_page');
}

function cutemag_before_single_page_title() {
    do_action('cutemag_before_single_page_title');
}

function cutemag_after_single_page_title() {
    do_action('cutemag_after_single_page_title');
}

function cutemag_after_single_page_content() {
    do_action('cutemag_after_single_page_content');
}

function cutemag_after_single_page() {
    do_action('cutemag_after_single_page');
}

function cutemag_before_comments() {
    do_action('cutemag_before_comments');
}

function cutemag_after_comments() {
    do_action('cutemag_after_comments');
}

function cutemag_before_footer() {
    do_action('cutemag_before_footer');
}

function cutemag_after_footer() {
    do_action('cutemag_after_footer');
}

// Header styles
if ( ! function_exists( 'cutemag_header_style' ) ) :
function cutemag_header_style() {
    $header_text_color = get_header_textcolor();
    //if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) { return; }
    ?>
    <style type="text/css">
    <?php if ( ! display_header_text() ) : ?>
        .cutemag-site-title, .cutemag-site-description {position: absolute;clip: rect(1px, 1px, 1px, 1px);}
    <?php else : ?>
        .cutemag-site-title, .cutemag-site-title a, .cutemag-site-description {color: #<?php echo esc_attr( $header_text_color ); ?>;}
    <?php endif; ?>
    </style>
    <?php
}
endif;