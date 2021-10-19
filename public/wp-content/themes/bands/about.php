<?php
add_action( 'admin_menu', 'bands_add_page' );
function bands_add_page() {
global $bands_theme_page;
$bands_theme_page = add_theme_page( esc_html__( 'Bands', 'bands' ), esc_html__( 'Bands', 'bands' ), 'edit_theme_options', 'bands', 'bands_options_do_page' );
}
function bands_options_do_page() {
?>
<div class="wrap">
<?php global $bands_theme_page; ?>
<?php $current_theme = wp_get_theme(); ?>
<h1><?php printf( esc_html__( 'Bands', 'bands' ) ); ?></h1>
<p><?php printf( esc_html__( 'Thank you for choosing Bands. %1$sUpgrade to Pro%2$s', 'bands' ), '<a href="https://bandswp.com/" target="_blank" class="button-primary">', '</a>' ); ?></p>
<p><?php printf( esc_html__( 'You can customize Bands under %1$sAppearance%2$s > %1$sCustomize%2$s.', 'bands' ), '<em>', '</em>' ); ?></p>
</div>
<?php
}