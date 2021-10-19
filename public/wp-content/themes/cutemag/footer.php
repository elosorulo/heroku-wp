<?php
/**
* The template for displaying the footer
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

</div><!--/#cutemag-content-wrapper -->

<?php cutemag_bottom_wide_widgets(); ?>

</div><!--/#cutemag-wrapper -->
</div><!--/#cutemag-wrapper-outside -->

<?php cutemag_before_footer(); ?>

<?php if ( !(cutemag_hide_footer_widgets()) ) { ?>
<?php if ( is_active_sidebar( 'cutemag-footer-1' ) || is_active_sidebar( 'cutemag-footer-2' ) || is_active_sidebar( 'cutemag-footer-3' ) || is_active_sidebar( 'cutemag-footer-4' ) || is_active_sidebar( 'cutemag-footer-5' ) || is_active_sidebar( 'cutemag-footer-6' ) || is_active_sidebar( 'cutemag-top-footer' ) || is_active_sidebar( 'cutemag-bottom-footer' ) ) : ?>
<div class="cutemag-outer-wrapper">
<div class='cutemag-clearfix' id='cutemag-footer-blocks' itemscope='itemscope' itemtype='http://schema.org/WPFooter' role='contentinfo'>
<div class='cutemag-container cutemag-clearfix'>

<?php if ( is_active_sidebar( 'cutemag-top-footer' ) ) : ?>
<div class='cutemag-clearfix'>
<div class='cutemag-top-footer-block'>
<?php dynamic_sidebar( 'cutemag-top-footer' ); ?>
</div>
</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'cutemag-footer-1' ) || is_active_sidebar( 'cutemag-footer-2' ) || is_active_sidebar( 'cutemag-footer-3' ) || is_active_sidebar( 'cutemag-footer-4' ) || is_active_sidebar( 'cutemag-footer-5' ) || is_active_sidebar( 'cutemag-footer-6' ) ) : ?>
<div class='cutemag-footer-block-cols cutemag-clearfix'>

<div class="cutemag-footer-block-col cutemag-footer-6-col" id="cutemag-footer-block-1">
<?php dynamic_sidebar( 'cutemag-footer-1' ); ?>
</div>

<div class="cutemag-footer-block-col cutemag-footer-6-col" id="cutemag-footer-block-2">
<?php dynamic_sidebar( 'cutemag-footer-2' ); ?>
</div>

<div class="cutemag-footer-block-col cutemag-footer-6-col" id="cutemag-footer-block-3">
<?php dynamic_sidebar( 'cutemag-footer-3' ); ?>
</div>

<div class="cutemag-footer-block-col cutemag-footer-6-col" id="cutemag-footer-block-4">
<?php dynamic_sidebar( 'cutemag-footer-4' ); ?>
</div>

<div class="cutemag-footer-block-col cutemag-footer-6-col" id="cutemag-footer-block-5">
<?php dynamic_sidebar( 'cutemag-footer-5' ); ?>
</div>

<div class="cutemag-footer-block-col cutemag-footer-6-col" id="cutemag-footer-block-6">
<?php dynamic_sidebar( 'cutemag-footer-6' ); ?>
</div>

</div>
<?php endif; ?>

<?php if ( is_active_sidebar( 'cutemag-bottom-footer' ) ) : ?>
<div class='cutemag-clearfix'>
<div class='cutemag-bottom-footer-block'>
<?php dynamic_sidebar( 'cutemag-bottom-footer' ); ?>
</div>
</div>
<?php endif; ?>

</div>
</div><!--/#cutemag-footer-blocks-->
</div>
<?php endif; ?>
<?php } ?>

<div class="cutemag-outer-wrapper">
<div class='cutemag-clearfix' id='cutemag-footer'>
<div class='cutemag-foot-wrap cutemag-container'>

<?php if ( cutemag_get_option('footer_text') ) : ?>
  <p class='cutemag-copyright'><?php echo esc_html(cutemag_get_option('footer_text')); ?></p>
<?php else : ?>
  <p class='cutemag-copyright'><?php /* translators: %s: Year and site name. */ printf( esc_html__( 'Copyright &copy; %s', 'cutemag' ), esc_html(date_i18n(__('Y','cutemag'))) . ' ' . esc_html(get_bloginfo( 'name' ))  ); ?></p>
<?php endif; ?>
<p class='cutemag-credit'><a href="<?php echo esc_url( 'https://themesdna.com/' ); ?>"><?php /* translators: %s: Theme author. */ printf( esc_html__( 'Design by %s', 'cutemag' ), 'ThemesDNA.com' ); ?></a></p>

</div>
</div><!--/#cutemag-footer -->
</div>

<?php cutemag_after_footer(); ?>

</div>

<?php if ( cutemag_is_backtotop_active() ) { ?><button class="cutemag-scroll-top" title="<?php esc_attr_e('Scroll to Top','cutemag'); ?>"><i class="fas fa-arrow-up" aria-hidden="true"></i><span class="cutemag-sr-only"><?php esc_html_e('Scroll to Top', 'cutemag'); ?></span></button><?php } ?>

<?php wp_footer(); ?>
</body>
</html>