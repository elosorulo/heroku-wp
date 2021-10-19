<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

if ( is_active_sidebar( 'darkpress_sidebar' ) ) { ?>
	
	<aside id="secondary" class="widget-area">
		<?php 
			$sidebar = apply_filters( Dark_Press_Theme::fn_prefix( 'sidebar' ), 'darkpress_sidebar' );
			dynamic_sidebar( $sidebar ); ?>
	</aside><!-- #secondary -->
<?php }else{ ?>
	    <aside id="secondary" class="widget-area">	    	
	       <?php 
		       Dark_Press_Theme::the_default_search();
		       Dark_Press_Theme::the_default_recent_post();
		       Dark_Press_Theme::the_default_archive();
	       ?>
	    </aside>
<?php }?>
