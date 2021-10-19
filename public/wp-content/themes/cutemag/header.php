<?php
/**
* The header for CuteMag theme.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="cutemag-site-body" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#cutemag-posts-wrapper"><?php esc_html_e( 'Skip to content', 'cutemag' ); ?></a>

<div class="cutemag-site-wrapper">

<?php cutemag_header_image(); ?>

<?php cutemag_secondary_menu_area(); ?>

<?php cutemag_before_header(); ?>

<div class="cutemag-site-header cutemag-container" id="cutemag-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
<div class="cutemag-head-content cutemag-clearfix" id="cutemag-head-content">

<?php if ( cutemag_is_header_content_active() ) { ?>
<div class="cutemag-outer-wrapper">
<div class="cutemag-header-inside cutemag-clearfix">
<div class="cutemag-header-inside-content cutemag-clearfix">
<div class="cutemag-header-inside-container">

<div class="cutemag-logo">
<?php if ( has_custom_logo() ) : ?>
    <div class="site-branding site-branding-full">
    <div class="cutemag-custom-logo-image">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="cutemag-logo-img-link">
        <img src="<?php echo esc_url( cutemag_custom_logo() ); ?>" alt="" class="cutemag-logo-img"/>
    </a>
    </div>
    <div class="cutemag-custom-logo-info"><?php cutemag_site_title(); ?></div>
    </div>
<?php else: ?>
    <div class="site-branding">
      <?php cutemag_site_title(); ?>
    </div>
<?php endif; ?>
</div>

<div class="cutemag-header-banner">
<?php dynamic_sidebar( 'cutemag-header-ad' ); ?>
</div>

</div>
</div>
</div>
</div>
<?php } else { ?>
<div class="cutemag-no-header-content">
  <?php cutemag_site_title(); ?>
</div>
<?php } ?>

</div><!--/#cutemag-head-content -->
</div><!--/#cutemag-header -->

<?php cutemag_after_header(); ?>

<?php cutemag_primary_menu_area(); ?>

<div class="cutemag-outer-wrapper" id="cutemag-wrapper-outside">
<div class="cutemag-container cutemag-clearfix" id="cutemag-wrapper">

<?php cutemag_top_wide_widgets(); ?>

<div class="cutemag-content-wrapper cutemag-clearfix" id="cutemag-content-wrapper">