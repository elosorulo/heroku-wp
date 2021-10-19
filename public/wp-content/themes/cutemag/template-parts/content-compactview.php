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

<div class="cutemag-compact-post-wrapper">
<div id="post-<?php the_ID(); ?>" class="cutemag-compact-post cutemag-item-post cutemag-box">
<div class="cutemag-box-inside">

    <div class='cutemag-compact-post-top cutemag-clearfix'>
    <?php if ( !(cutemag_get_option('hide_thumbnail_home')) ) { ?>
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="cutemag-compact-post-thumbnail cutemag-fp-post-thumbnail cutemag-compact-post-thumbnail-float">
            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'cutemag' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="cutemag-compact-post-thumbnail-link cutemag-fp-post-thumbnail-link"><?php the_post_thumbnail('cutemag-100w-100h-image', array('class' => 'cutemag-compact-post-thumbnail-img cutemag-fp-post-thumbnail-img', 'title' => the_title_attribute('echo=0'))); ?></a>
        </div>
    <?php } else { ?>
        <?php if ( !(cutemag_get_option('hide_default_thumbnail_home')) ) { ?>
        <div class="cutemag-compact-post-thumbnail cutemag-fp-post-thumbnail cutemag-compact-post-thumbnail-float">
            <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'cutemag' ), the_title_attribute( 'echo=0' ) ) ); ?>" class="cutemag-compact-post-thumbnail-link cutemag-fp-post-thumbnail-link"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-100-100.jpg' ); ?>" class="cutemag-compact-post-thumbnail-img cutemag-fp-post-thumbnail-img"/></a>
        </div>
        <?php } ?>
    <?php } ?>
    <?php } ?>

    <?php if ( !(cutemag_get_option('hide_post_title_home')) ) { ?>
    <?php the_title( sprintf( '<h2 class="cutemag-compact-post-title cutemag-fp-post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    <?php } ?>

    <?php cutemag_compactview_postmeta(); ?>

    <?php if ( !(cutemag_get_option('hide_post_snippet')) ) { ?><div class="cutemag-compact-post-snippet cutemag-fp-post-snippet cutemag-compact-post-excerpt cutemag-fp-post-excerpt"><?php the_excerpt(); ?></div><?php } ?>

    <?php if ( cutemag_get_option('show_read_more_button') ) { ?><div class='cutemag-compact-post-read-more cutemag-fp-post-read-more'><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( cutemag_read_more_text() ); ?><span class="cutemag-sr-only"> <?php echo wp_kses_post( get_the_title() ); ?></span></a></div><?php } ?>
    </div>

    <?php if ( !(cutemag_get_option('hide_share_buttons_home')) ) { echo wp_kses_post( force_balance_tags( cutemag_small_share_buttons() ) ); } ?>

</div>
</div>
</div>