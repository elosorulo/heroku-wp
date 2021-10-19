<?php
/**
* The main template file.
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

get_header(); ?>

<div class="cutemag-main-wrapper cutemag-clearfix" id="cutemag-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="cutemag-main-wrapper-inside cutemag-clearfix">

<?php cutemag_before_main_content(); ?>

<div class="cutemag-posts-wrapper" id="cutemag-posts-wrapper">
<div class="cutemag-posts">

<?php if ( !(cutemag_get_option('hide_posts_heading')) ) { ?>
<?php if(is_home() && !is_paged()) { ?>
<?php if ( cutemag_get_option('posts_heading') ) : ?>
<div class="cutemag-posts-header"><h2 class="cutemag-posts-heading"><span><?php echo esc_html( cutemag_get_option('posts_heading') ); ?></span></h2></div>
<?php else : ?>
<div class="cutemag-posts-header"><h2 class="cutemag-posts-heading"><span><?php esc_html_e( 'Recent Posts', 'cutemag' ); ?></span></h2></div>
<?php endif; ?>
<?php } ?>
<?php } ?>

<div class="cutemag-posts-content">

<?php if (have_posts()) : ?>

    <div class="cutemag-posts-container <?php echo esc_attr(cutemag_posts_container_class()); ?>">
    <?php $cutemag_total_posts = $wp_query->post_count; ?>
    <?php $cutemag_post_counter=1; while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', cutemag_post_style() ); ?>

    <?php $cutemag_post_counter++; endwhile; ?>
    </div>
    <div class="clear"></div>

    <?php cutemag_posts_navigation(); ?>

<?php else : ?>

  <?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

</div>

</div>
</div><!--/#cutemag-posts-wrapper -->

<?php cutemag_after_main_content(); ?>

</div>
</div>
</div><!-- /#cutemag-main-wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>