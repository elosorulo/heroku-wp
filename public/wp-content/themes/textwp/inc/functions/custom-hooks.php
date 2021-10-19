<?php
/**
* Custom Hooks
*
* @package TextWP WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

function textwp_before_header() {
    do_action('textwp_before_header');
}

function textwp_after_header() {
    do_action('textwp_after_header');
}

function textwp_before_main_content() {
    do_action('textwp_before_main_content');
}
add_action('textwp_before_main_content', 'textwp_top_widgets', 20 );

function textwp_after_main_content() {
    do_action('textwp_after_main_content');
}
add_action('textwp_after_main_content', 'textwp_bottom_widgets', 10 );

function textwp_sidebar_one() {
    do_action('textwp_sidebar_one');
}
add_action('textwp_sidebar_one', 'textwp_sidebar_one_widgets', 10 );

function textwp_before_single_post() {
    do_action('textwp_before_single_post');
}

function textwp_before_single_post_title() {
    do_action('textwp_before_single_post_title');
}

function textwp_after_single_post_title() {
    do_action('textwp_after_single_post_title');
}

function textwp_after_single_post_content() {
    do_action('textwp_after_single_post_content');
}

function textwp_after_single_post() {
    do_action('textwp_after_single_post');
}

function textwp_before_single_page() {
    do_action('textwp_before_single_page');
}

function textwp_before_single_page_title() {
    do_action('textwp_before_single_page_title');
}

function textwp_after_single_page_title() {
    do_action('textwp_after_single_page_title');
}

function textwp_after_single_page_content() {
    do_action('textwp_after_single_page_content');
}

function textwp_after_single_page() {
    do_action('textwp_after_single_page');
}

function textwp_before_comments() {
    do_action('textwp_before_comments');
}

function textwp_after_comments() {
    do_action('textwp_after_comments');
}

function textwp_before_footer() {
    do_action('textwp_before_footer');
}

function textwp_after_footer() {
    do_action('textwp_after_footer');
}

if ( !(textwp_get_option('enable_widgets_block_editor')) ) {
    // Disables the block editor from managing widgets in the Gutenberg plugin.
    add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

    // Disables the block editor from managing widgets.
    add_filter( 'wp_use_widgets_block_editor', '__return_false' );
}