<?php
/**
 * Template part for displaying page content in index.php and archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @since 1.0.0
 * @package Dark Press WordPress Theme
 */
?>
<article <?php Dark_Press_Helper::schema_body( 'article' ); ?> id="post-<?php the_ID(); ?>" <?php post_class( Dark_Press_Helper::with_prefix( 'post' ) ); ?> >
	<div class="image-full post-image" style="<?php Dark_Press_Theme::the_default_image( get_the_ID() ); ?>" >
		<a class="darkpress-post-link" href="<?php echo esc_url( get_permalink() ); ?>"></a>
		<?php Dark_Press_Helper::post_format_icon() ?>
	</div>	
	
	<div class="post-content-wrap <?php echo esc_attr( Dark_Press_Theme::read_more_btn_classes() ); ?>">		
		<?php 
			Dark_Press_Helper::get_title();
			get_template_part( 'templates/meta', 'info' );
			the_excerpt();	
			Dark_Press_Helper::get_comment_number();
		?>
	</div>
</article>