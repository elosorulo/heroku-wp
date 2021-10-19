<?php
/**
 * Template part for displaying inner banner in pages
 *
 * @since 1.0.0
 * 
 * @package Dark Press WordPress Theme
 */
?>
<div class="<?php echo esc_attr( Dark_Press_Helper::get_inner_banner_class() ); ?>" <?php Dark_Press_Helper::the_header_image(); ?>> 
	<div class="container">
		<?php
			Dark_Press_Helper::the_inner_banner();
			Dark_Press_Helper::the_breadcrumb();
		?>
	</div>
</div>
