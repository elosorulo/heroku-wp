<?php
/**
* Template part for displaying a message that posts cannot be found.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<div class="no-results not-found">
    <div class="cutemag-page-header-outside">
    <header class="cutemag-page-header">
    <div class="cutemag-page-header-inside">
        <?php if ( cutemag_get_option('no_search_heading') ) : ?>
        <h1 class="page-title"><?php echo esc_html( cutemag_get_option('no_search_heading') ); ?></h1>
        <?php else : ?>
        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'cutemag' ); ?></h1>
        <?php endif; ?>
    </div>
    </header><!-- .cutemag-page-header -->
    </div>

    <div class="page-content">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                <p><?php
                    printf(
                        wp_kses(
                            /* translators: 1: link to WP admin new post page. */
                            __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cutemag' ),
                            array(
                                'a' => array(
                                    'href' => array(),
                                ),
                            )
                        ),
                        esc_url( admin_url( 'post-new.php' ) )
                    );
                ?></p>

        <?php elseif ( is_search() ) : ?>

                <?php if ( cutemag_get_option('no_search_results') ) : ?>
                <p><?php echo wp_kses_post( force_balance_tags( cutemag_get_option('no_search_results') ) ); ?></p>
                <?php else : ?>
                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cutemag' ); ?></p>
                <?php endif; ?>

                <?php get_search_form(); ?>

        <?php else : ?>

                <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cutemag' ); ?></p>
                <?php get_search_form(); ?>

        <?php endif; ?>
    </div><!-- .page-content -->
</div><!-- .no-results -->