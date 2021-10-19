<?php
/**
 * Content for footer widget
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */
 if( !apply_filters( Dark_Press_Helper::fn_prefix( 'disable_footer_widget' ), false ) ): ?>
    <footer <?php Dark_Press_Helper::schema_body( 'footer' ); ?> class="footer-top-section" <?php Dark_press_Theme::the_footer_bg_img(); ?> >
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <?php if( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) ||
                               is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ){
                        $num_footer = dark_press_get( 'layout-footer' );
                 		for( $i = 1; $i <= $num_footer ; $i++ ){ ?>
                 			<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
		                 		<aside class="col footer-widget-wrapper py-5">
		                 	    	<?php dynamic_sidebar( 'footer-' . $i ); ?>
		                 		</aside>
	                 		<?php endif; ?>
                 	    <?php }
                    }else{ ?>
                        <aside class="col footer-widget-wrapper py-5">
                            <?php Dark_Press_Theme::the_default_search(); ?>
                        </aside>
                        <aside class="col footer-widget-wrapper py-5">
                            <?php Dark_Press_Theme::the_default_recent_post(); ?>
                        </aside>
                        <aside class="col footer-widget-wrapper py-5">
                            <?php Dark_Press_Theme::the_default_archive(); ?>
                        </aside>
                    <?php }?>
                </div>
            </div>
        </div>
    </footer>
<?php endif;
