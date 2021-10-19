<?php
/**
* The template for displaying category archive pages.
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

<?php if ( !(cutemag_get_option('hide_cats_title')) ) { ?>
<div class="cutemag-page-header-outside">
<header class="cutemag-page-header">
<div class="cutemag-page-header-inside">
<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
<?php if ( !(cutemag_get_option('hide_cats_description')) ) { ?><?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?><?php } ?>
</div>
</header>
</div>
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