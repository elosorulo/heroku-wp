<?php
/**
* The template for displaying 404 pages (not found).
*
* @link https://codex.wordpress.org/Creating_an_Error_404_Page
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

get_header(); ?>

<div class='cutemag-main-wrapper cutemag-clearfix' id='cutemag-main-wrapper' itemscope='itemscope' itemtype='http://schema.org/Blog' role='main'>
<div class='theiaStickySidebar'>
<div class="cutemag-main-wrapper-inside cutemag-clearfix">

<div class='cutemag-posts-wrapper' id='cutemag-posts-wrapper'>

<div class='cutemag-posts cutemag-box'>
<div class="cutemag-box-inside">

<div class="cutemag-page-header-outside">
<header class="cutemag-page-header">
<div class="cutemag-page-header-inside">
    <?php if ( cutemag_get_option('error_404_heading') ) : ?>
    <h1 class="page-title"><?php echo esc_html( cutemag_get_option('error_404_heading') ); ?></h1>
    <?php else : ?>
    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can not be found.', 'cutemag' ); ?></h1>
    <?php endif; ?>
</div>
</header><!-- .cutemag-page-header -->
</div>

<div class='cutemag-posts-content'>

    <?php if ( cutemag_get_option('error_404_message') ) : ?>
    <p><?php echo wp_kses_post( force_balance_tags( cutemag_get_option('error_404_message') ) ); ?></p>
    <?php else : ?>
    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cutemag' ); ?></p>
    <?php endif; ?>

    <?php if ( !(cutemag_get_option('hide_404_search')) ) { ?><?php get_search_form(); ?><?php } ?>

</div>

</div>
</div>

</div><!--/#cutemag-posts-wrapper -->

</div>
</div>
</div><!-- /#cutemag-main-wrapper -->

<?php get_footer(); ?>