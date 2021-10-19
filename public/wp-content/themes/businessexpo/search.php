<?php 
/**
 * Search page template
 */
get_header(); ?>

	<?php get_template_part('breadcrumb'); ?>
		
	<!-- Blog & Sidebar Section -->
	<section id="site-content" class="section theme-light menu-overlap">
		<div class="container">
			<div class="row">
				<?php
				// Page Layout Settings
				$businessexpo_page_layout = get_theme_mod('businessexpo_archive_blog_pages_layout','businessexpo_right_sidebar');
				// Initialize Variable
				$businessexpo_column_class = "col-md-12 col-sm-12 col-xs-12";
				
				// Check Sidebar Column Condition
				if( $businessexpo_page_layout == "businessexpo_right_sidebar" || $businessexpo_page_layout == "businessexpo_left_sidebar" && is_active_sidebar( 'sidebar-widget' )  ) {
					$businessexpo_column_class = "col-md-8 col-sm-6 col-xs-12";
				}
				?>			
				<!-- Left Sidebar -->
				<?php if($businessexpo_page_layout == "businessexpo_left_sidebar") { ?>
					<?php if ( is_active_sidebar( 'sidebar-widget' ) ) { ?>
						<!--Sidebar-->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="sidebar space-left">
								<?php dynamic_sidebar('sidebar-widget') ?>
							</div>
						</div>
						<!--/Sidebar-->
						<?php 
					} 
				} ?>
				<!-- Left Sidebar -->		

				<!--Blog Section-->
				<div class="<?php echo esc_attr($businessexpo_column_class); ?>">
					<div class="blog">
						<?php 
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', get_post_type() );
							endwhile;
							
							the_posts_pagination( array(
								'prev_text'          => '<i class="fa fa-angle-left"></i>',
								'next_text'          => '<i class="fa fa-angle-right"></i>'
							) );
							
						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div>	
				</div>
				
				<!-- Right Sidebar -->
				<?php if($businessexpo_page_layout == "businessexpo_right_sidebar") { ?>
					<?php if ( is_active_sidebar( 'sidebar-widget' ) ) { ?>
						<!--Sidebar-->
						<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="sidebar space-left">
								<?php dynamic_sidebar('sidebar-widget') ?>
							</div>
						</div>
						<!--/Sidebar-->
						<?php 
					} 
				} ?>
				<!-- Right Sidebar -->
			</div>
		</div>
	</section>
	<!-- /Blog & Sidebar Section -->

	<div class="clearfix"></div>

<?php get_footer(); ?>