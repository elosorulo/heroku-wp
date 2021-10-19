<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dark Press WordPress Theme
 */
get_header();  

?>
<div class="container" id="content">
	<?php do_action( Dark_Press_Theme::fn_prefix( 'blog_before_main_content' ) ); ?>
	<div class="row">
		<div class="<?php echo esc_attr( Dark_Press_Theme::is_sidebar_active() ? 'col-md-8 col-lg-8' : 'col-md-12' ); ?> content-order">
			<div id="primary" class="content-area">
				<main id="main" class="site-main ">
				<?php if ( have_posts() ): ?>
					<div class="row" id="load-more">
						<?php
						$total_post = $wp_query->found_posts;
						$displayed_post = $wp_query->post_count;
						# Load posts loop.
						while ( have_posts() ) : 
							the_post(); 
						?>
							<div class="<?php Dark_Press_Theme::the_post_per_row_class(); ?>">
								<?php get_template_part( 'templates/content/content', '' ); ?>
							</div>
						<?php endwhile; ?>
					</div>

					<?php Dark_Press_Helper::posts_navigation( $total_post, $displayed_post ); ?>
					
				<?php else: ?>
					<?php
						# If no content, include the "No posts found" template.
						get_template_part( 'templates/content/content', 'none' );
					?>
				<?php endif; ?>				
				</main><!-- .site-main -->
			</div><!-- .content-area -->
		</div>
		<?php Dark_Press_Theme::the_sidebar(); ?>
	</div>
	<?php do_action( Dark_Press_Theme::fn_prefix( 'blog_after_main_content' ) ); ?>
</div>		
<?php get_footer() ?>