<?php
/**
* Template part for displaying posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<div id="post-<?php the_ID(); ?>" class="cutemag-post-singular cutemag-box">
<div class="cutemag-box-inside">

    <header class="entry-header">
    <div class="entry-header-inside">
        <?php if ( !(cutemag_get_option('hide_post_categories_home')) && has_category() ) { ?>
            <?php if ( 'post' == get_post_type() ) {
                /* translators: used between list items, there is a space */
                $categories_list = get_the_category_list( esc_html__( ', ', 'cutemag' ) );
                if ( $categories_list ) {
                    /* translators: 1: list of categories. */
                    printf( '<div class="cutemag-entry-meta-single cutemag-entry-meta-single-top"><span class="cutemag-entry-meta-single-cats"><i class="far fa-folder-open" aria-hidden="true"></i>&nbsp;' . __( '<span class="cutemag-sr-only">Posted in </span>%1$s', 'cutemag' ) . '</span></div>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
            } ?>
        <?php } ?>

        <?php if ( !(cutemag_get_option('hide_post_title_home')) ) { ?>
        <?php the_title( sprintf( '<h2 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <?php } ?>

        <?php if ( !(cutemag_get_option('hide_post_author_home')) || !(cutemag_get_option('hide_posted_date_home')) || !(cutemag_get_option('hide_comments_link_home')) ) { ?>
        <div class="cutemag-entry-meta-single cutemag-entry-meta-single-home">
        <?php if ( !(cutemag_get_option('hide_post_author_home')) ) { ?><span class="cutemag-entry-meta-single-author cutemag-entry-meta-single-item"><i class="far fa-user-circle" aria-hidden="true"></i>&nbsp;<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a></span><?php } ?>
        <?php if ( !(cutemag_get_option('hide_posted_date_home')) ) { ?><span class="cutemag-entry-meta-single-date cutemag-entry-meta-single-item"><i class="far fa-clock" aria-hidden="true"></i>&nbsp;<?php echo esc_html(get_the_date()); ?></span><?php } ?>
        <?php if ( !(cutemag_get_option('hide_comments_link_home')) ) { ?><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?><span class="cutemag-entry-meta-single-comments cutemag-entry-meta-single-item"><i class="far fa-comments" aria-hidden="true"></i>&nbsp;<?php comments_popup_link( sprintf( wp_kses( /* translators: %s: post title */ __( 'Leave a Comment<span class="cutemag-sr-only"> on %s</span>', 'cutemag' ), array( 'span' => array( 'class' => array(), ), ) ), wp_kses_post( get_the_title() ) ) ); ?></span>
        <?php } ?><?php } ?>
        </div>
        <?php } ?>
    </div>
    </header><!-- .entry-header -->

    <div class="entry-content cutemag-clearfix">
    <?php if ( !(cutemag_get_option('hide_thumbnail_home')) ) { ?>
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="cutemag-fullview-post-thumbnail cutemag-fp-post-thumbnail">
            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'cutemag' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="cutemag-fullview-post-thumbnail-link cutemag-fp-post-thumbnail-link"><?php the_post_thumbnail('cutemag-900w-autoh-image', array('class' => 'cutemag-fullview-post-thumbnail-img cutemag-fp-post-thumbnail-img', 'title' => the_title_attribute('echo=0'))); ?></a>
        </div>
    <?php } ?>
    <?php } ?>

    <?php
    if ( !(cutemag_get_option('display_full_post_content')) ) { ?>
        <div class="cutemag-fullview-post-snippet cutemag-fp-post-snippet cutemag-fullview-post-excerpt cutemag-fp-post-excerpt"><?php the_excerpt(); ?></div>
    <?php } else {
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
    }
    ?>
    </div><!-- .entry-content -->

    <?php if ( !(cutemag_get_option('hide_post_tags_home')) && has_tag() ) { ?>
    <footer class="entry-footer">
    <?php cutemag_post_tags(); ?>
    </footer><!-- .entry-footer -->
    <?php } ?>

    <?php if ( !(cutemag_get_option('display_full_post_content')) ) { ?><?php if ( cutemag_get_option('show_read_more_button') ) { ?><div class="cutemag-fullview-post-read-more cutemag-fp-post-read-more"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( cutemag_read_more_text() ); ?><span class="cutemag-sr-only"> <?php echo wp_kses_post( get_the_title() ); ?></span></a></div><?php } ?><?php } ?>

    <?php if ( !(cutemag_get_option('hide_share_buttons_home')) ) { echo wp_kses_post( force_balance_tags( cutemag_small_share_buttons() ) ); } ?>

</div>
</div>