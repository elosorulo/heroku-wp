<?php
/**
* Template part for displaying single posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<?php cutemag_before_single_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cutemag-post-singular cutemag-box'); ?>>
<div class="cutemag-box-inside">

    <?php if ( !(cutemag_get_option('hide_post_title')) ) { ?>
    <header class="entry-header">
    <div class="entry-header-inside">
        <?php if ( !(cutemag_get_option('hide_post_categories')) && has_category() ) { ?><?php cutemag_single_cats(); ?><?php } ?>

        <?php if ( cutemag_get_option('remove_post_title_link') ) { ?>
            <?php the_title( '<h1 class="post-title entry-title">', '</h1>' ); ?>
        <?php } else { ?>
            <?php the_title( sprintf( '<h1 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
        <?php } ?>

        <?php cutemag_single_postmeta(); ?>
    </div>
    </header><!-- .entry-header -->
    <?php } ?>

    <?php cutemag_after_single_post_title(); ?>

    <div class="entry-content cutemag-clearfix">
        <?php
        if ( has_post_thumbnail() ) {
            if ( !(cutemag_get_option('hide_thumbnail_single')) ) {
                if ( cutemag_get_option('thumbnail_link') == 'no' ) { ?>
                    <div class="cutemag-post-thumbnail-single">
                    <?php
                    if ( is_page_template( array( 'template-full-width-post.php', 'template-full-width-post-sidebar.php' ) ) ) {
                        the_post_thumbnail('cutemag-1200w-autoh-image', array('class' => 'cutemag-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                    } else {
                        the_post_thumbnail('cutemag-900w-autoh-image', array('class' => 'cutemag-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0')));
                    }
                    ?>
                    </div>
                <?php } else { ?>
                    <div class="cutemag-post-thumbnail-single">
                    <?php if ( is_page_template( array( 'template-full-width-post.php', 'template-full-width-post-sidebar.php' ) ) ) { ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'cutemag' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="cutemag-post-thumbnail-single-link"><?php the_post_thumbnail('cutemag-1200w-autoh-image', array('class' => 'cutemag-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                    <?php } else { ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'cutemag' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="cutemag-post-thumbnail-single-link"><?php the_post_thumbnail('cutemag-900w-autoh-image', array('class' => 'cutemag-post-thumbnail-single-img', 'title' => the_title_attribute('echo=0'))); ?></a>
                    <?php } ?>
                    </div>
        <?php   }
            }
        }

        the_content( sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Continue reading<span class="cutemag-sr-only"> "%s"</span> <span class="meta-nav">&rarr;</span>', 'cutemag' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post( get_the_title() )
        ) );

        wp_link_pages( array(
         'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'cutemag' ) . '</span>',
         'after'       => '</div>',
         'link_before' => '<span>',
         'link_after'  => '</span>',
         ) );
         ?>
    </div><!-- .entry-content -->

    <?php cutemag_after_single_post_content(); ?>

    <?php if ( !(cutemag_get_option('hide_post_tags')) && has_tag() ) { ?>
    <footer class="entry-footer">
        <?php cutemag_post_tags(); ?>
    </footer><!-- .entry-footer -->
    <?php } ?>

    <?php if ( !(cutemag_get_option('hide_author_bio_box')) ) { echo wp_kses_post( force_balance_tags( cutemag_add_author_bio_box() ) ); } ?>
</div>
</article>

<?php cutemag_after_single_post(); ?>