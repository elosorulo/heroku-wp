<?php
/**
 * Content for header
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */ 
?>
<div class="<?php echo esc_attr( Dark_Press_Helper::with_prefix( 'bottom-header-wrapper' ) ); ?>" <?php Dark_Press_Theme::the_header_bg_img(); ?> >
	<div class="container"> 		
		<section class="<?php echo esc_attr( Dark_Press_Helper::with_prefix( 'bottom-header' ) ); ?>">			
			<div class="site-branding">
				<div>
					<?php the_custom_logo(); ?>
					<div>
						<?php if ( is_front_page() ) :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
						else :
							?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php
						endif;
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php if( '' != dark_press_get( 'header-advertisement-image' ) ): ?>
				<div>
					<a href=" <?php echo esc_url( dark_press_get( 'header-advertisement-url' ) ); ?>">					
						<img src="<?php echo esc_url( dark_press_get( 'header-advertisement-image' ) ); ?>">
					</a>
				</div>				
			<?php endif; ?>	 
		</section>		
	</div>
</div>
<div class="darkpress-main-menu-wrapper">
	<div class="container">				
		<div class="<?php echo Dark_Press_Helper::with_prefix( 'navigation-n-options' ); ?>">

			<?php Dark_Press_Helper::get_menu( 'primary', true ); ?>
			
			<?php do_action( Dark_Press_Helper::fn_prefix( 'after_primary_menu' ) ); ?>
			<div class="darkpress-menu-search">
				<?php get_search_form(); ?>
			</div>	
		</div>	
	</div>		
</div>
<!-- nav bar section end -->