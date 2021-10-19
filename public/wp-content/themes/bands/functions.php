<?php
add_action( 'after_setup_theme', 'bands_setup' );
function bands_setup() {
load_theme_textdomain( 'bands' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );
$defaults = array( 'header-text' => false );
add_theme_support( 'custom-header', $defaults );
$defaults = array( 'default-color' => 'ffffff' );
add_theme_support( 'custom-background', $defaults );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( !isset( $content_width ) ) $content_width = 1920;
register_nav_menus(
array( 'main-menu' => esc_html__( 'Main Menu', 'bands' ), 'footer-menu' => esc_html__( 'Footer Menu', 'bands' ) )
);
}
add_action( 'after_setup_theme', 'bands_woocommerce_support' );
function bands_woocommerce_support() {
add_theme_support( 'woocommerce' );
}
require_once ( get_template_directory() . '/about.php' );
add_action( 'admin_notices', 'bands_admin_notice' );
function bands_admin_notice() {
$user_id = get_current_user_id();
if ( !get_user_meta( $user_id, 'bands_notice_dismissed_3' ) && current_user_can( 'manage_options' ) )
echo '<div class="notice notice-info"><p>' . __( '<big><strong>🎸 Bands</strong></big> — Page Builder + Speed Optimization + Unlimited Use + Support & Updates for Life for One-time Fee: <a href="?notice-dismiss" class="alignright">Dismiss</a> <a href="https://bandswp.com/" class="button-primary" style="width:100%;font-size:20px;font-weight:bold;text-align:center;margin-top:10px" target="_blank">Upgrade to Pro</a>', 'bands' ) . '</p></div>';
}
add_action( 'admin_init', 'bands_notice_dismissed' );
function bands_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['notice-dismiss'] ) )
add_user_meta( $user_id, 'bands_notice_dismissed_3', 'true', true );
}
add_action( 'wp_enqueue_scripts', 'bands_load_scripts' );
function bands_load_scripts() {
wp_enqueue_style( 'bands-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
wp_register_script( 'bands-videos', get_template_directory_uri() . '/js/videos.js' );
wp_enqueue_script( 'bands-videos' );
wp_add_inline_script( 'bands-videos', 'jQuery(document).ready(function($){$("#wrapper").vids();});' );
}
add_action( 'wp_footer', 'bands_footer_scripts' );
function bands_footer_scripts() {
?>
<script>
jQuery(document).ready(function($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
$(".menu-toggle").on("keypress click", function(e) {
if (e.which == 13 || e.type === "click") {
e.preventDefault();
$("#menu").toggleClass("toggled");
}
});
});
</script>
<?php
}
add_action( 'wp_footer', 'bands_bbpress_inline_script' );
function bands_bbpress_inline_script() {
if ( class_exists( 'bbPress' ) && bbp_is_single_forum() ) {
?>
<script>
jQuery(document).ready(function($) {
if (!$("#new-post").length > 0) {
$("#new-topic").hide();
}
});
</script>
<?php
}
}
if ( !function_exists( 'wp_body_open' ) ) {
function wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'bands_skip_link', 5 );
function bands_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'bands' ) . '</a>';
}
add_filter( 'the_content_more_link', 'bands_read_more_link' );
function bands_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
}
}
add_filter( 'excerpt_more', 'bands_excerpt_read_more_link' );
function bands_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_action( 'widgets_init', 'bands_widgets_init' );
function bands_widgets_init() {
register_sidebar( array (
'name' => esc_html__( 'Header Widget Area', 'bands' ),
'id' => 'header-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => esc_html__( 'Footer Widget Area', 'bands' ),
'id' => 'footer-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => esc_html__( 'Sidebar Widget Area', 'bands' ),
'description' => esc_html__( 'Does not display for single posts.', 'bands' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'bands_pingback_header' );
function bands_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'bands_enqueue_comment_reply_script' );
function bands_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
function bands_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'bands_comment_count', 0 );
function bands_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}
function bands_customizer( $wp_customize ) {
$wp_customize->add_setting(
'bands_accent_color',
array(
'default' => '#00b4ff',
'sanitize_callback' => 'sanitize_hex_color',
'transport' => 'postMessage'
)
);
$wp_customize->add_control(
new WP_Customize_Color_Control(
$wp_customize,
'accent_color',
array(
'label' => esc_html__( 'Theme Accent Color', 'bands' ),
'section' => 'colors',
'settings' => 'bands_accent_color'
)
)
);
$wp_customize->add_setting(
'bands_link_color',
array(
'default' => '#00b4ff',
'sanitize_callback' => 'sanitize_hex_color',
'transport' => 'postMessage'
)
);
$wp_customize->add_control(
new WP_Customize_Color_Control(
$wp_customize,
'link_color',
array(
'label' => esc_html__( 'Link Color', 'bands' ),
'section' => 'colors',
'settings' => 'bands_link_color'
)
)
);
$wp_customize->add_setting(
'bands_header_color',
array(
'default' => '#00b4ff',
'sanitize_callback' => 'sanitize_hex_color',
'transport' => 'postMessage'
)
);
$wp_customize->add_control(
new WP_Customize_Color_Control(
$wp_customize,
'header_color',
array(
'label' => esc_html__( 'Content Headers Color', 'bands' ),
'section' => 'colors',
'settings' => 'bands_header_color'
)
)
);
$wp_customize->add_section(
'bands_fonts',
array(
'title' => 'Fonts',
'priority' => 25
)
);
$wp_customize->add_setting(
'bands_header_font',
array(
'default' => 'Roboto',
'sanitize_callback' => 'sanitize_text_field',
'transport' => 'postMessage'
)
);
$wp_customize->add_control(
new WP_Customize_Control(
$wp_customize,
'header_font',
array(
'label' => esc_html__( 'Content Headers Font', 'bands' ),
'description' => esc_html__( 'If adding a Google font, make sure to capitalize all words, save, and then refresh to preview.', 'bands' ),
'section' => 'bands_fonts',
'settings' => 'bands_header_font'
)
)
);
}
add_action( 'customize_register', 'bands_customizer', 20 );
function bands_customizer_css() {
?>
<style>
a, h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, pre, code{color:<?php echo esc_html( get_theme_mod( 'bands_accent_color' ) ); ?>}
hr, .button, button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{background-color:<?php echo esc_html( get_theme_mod( 'bands_accent_color' ) ); ?>}
blockquote, #content .gallery img, .box, .box-2, .box-3, .box-4, .box-5, .box-6, .box-1-3, .box-2-3{border-color:<?php echo esc_html( get_theme_mod( 'bands_accent_color' ) ); ?>}
@media(min-width:769px){#menu .current-menu-item a, #menu .current_page_parent a{border-color:<?php echo esc_html( get_theme_mod( 'bands_accent_color' ) ); ?>}}
a{color:<?php echo esc_html( get_theme_mod( 'bands_link_color' ) ); ?>}
h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{font-family:"<?php echo esc_html( ucwords( str_replace( '+', ' ', get_theme_mod( 'bands_header_font' ) ) ) ); ?>";color:<?php echo esc_html( get_theme_mod( 'bands_header_color' ) ); ?>}
</style>
<?php
}
add_action( 'wp_head', 'bands_customizer_css' );
function bands_customizer_preview() {
wp_enqueue_script(
'bands-theme-customizer',
get_template_directory_uri() . '/js/customizer.js',
array( 'jquery', 'customize-preview' ),
'0.3.0',
true
);
}
add_action( 'customize_preview_init', 'bands_customizer_preview' );
function bands_customizer_fonts_preview() {
if ( !empty( get_theme_mod( 'bands_header_font' ) ) ) {
wp_enqueue_style( 'bands-google-fonts', 'https://fonts.googleapis.com/css?family=' . esc_html( ucwords( str_replace( ' ', '+', get_theme_mod( 'bands_header_font' ) ) ) ) . '' );
}
}
add_action( 'customize_preview_init', 'bands_customizer_fonts_preview' );
add_action( 'wp_enqueue_scripts', 'bands_customizer_fonts_preview' );
require_once( get_stylesheet_directory() . '/plugins/plugin-activation.php' );