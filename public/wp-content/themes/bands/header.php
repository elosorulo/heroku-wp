<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
<header id="header" style="background-image:url(<?php if ( get_header_image() ) { echo esc_url( get_header_image() ); } else { echo esc_url( get_template_directory_uri() ) . '/images/bg.jpg'; } ?>)" role="banner">
<div id="header-nav">
<div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
<?php
if ( is_front_page() || is_home() || is_front_page() && is_home() ) {
echo '<h1>';
}
if ( has_custom_logo() ) {
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
} elseif ( has_site_icon() ) {
$logo = get_site_icon_url();
} else {
$logo = '';
}
echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" itemprop="url"><span class="screen-reader-text" itemprop="name">' . esc_html( get_bloginfo( 'name' ) ) . '</span><span id="logo-container" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><img src="';
if ( has_custom_logo() ) {
echo esc_url( $logo[0] );
} else {
echo esc_url( $logo );
}
echo '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" id="logo" itemprop="url" /></span></a>';
if ( is_front_page() || is_home() || is_front_page() && is_home() ) {
echo '</h1>';
}
?>
</div>
<nav id="menu" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
<button type="button" class="menu-toggle"><span class="menu-icon">&#9776;</span><span class="menu-text screen-reader-text"><?php esc_html_e( ' Menu', 'bands' ); ?></span></button>
<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
<div id="search"><?php get_search_form(); ?></div>
</nav>
</div>
<div id="site-description"<?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>><?php bloginfo( 'description' ); ?></div>
<?php if ( is_active_sidebar( 'header-widget-area' ) ) : ?>
<aside id="header-sidebar" role="complementary">
<div id="hsidebar" class="widget-area">
<ul class="xoxo">
<?php dynamic_sidebar( 'header-widget-area' ); ?>
</ul>
<div class="clear"></div>
</div>
</aside>
<?php endif; ?>
</header>
<div id="container">