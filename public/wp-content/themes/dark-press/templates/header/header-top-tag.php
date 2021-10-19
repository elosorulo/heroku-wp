<?php
/**
 * Content for header top tag
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */ 
?>
<section class="darkpress-top-tag-section">
	<div class="container">
		<div class="darkpress-top-tag-inner">
		<div class="top-tags-wrapper">
			<span class="top-tag-title">
				<i class="fa fa-tag"></i><?php echo esc_html( dark_press_get( 'top-tag-title' ) ); ?>				
			</span>
			<?php
				$tags = json_decode( dark_press_get( 'top-tag-list' ) );
				if( !empty( $tags ) ){?>
					<ul>
						<?php foreach( $tags as $t ){ ?>
							<li>
								<a href="<?php echo esc_url( get_term_link( get_term( $t ) ) ); ?>">							
									<?php echo esc_html( get_term( $t )->name ) ?>
								</a>							
							</li>
						<?php } ?>
					</ul>
				<?php }else{?>
					<ul>
						<li>
							<a href="#"><?php echo esc_html__( 'Fashion','dark-press' ) ?></a>						
						</li>
						<li>
							<a href="#"><?php echo esc_html__( 'Sports','dark-press' ) ?></a>							
						</li>
						<li>
							<a href="#"><?php echo esc_html__( 'News','dark-press' ) ?></a>							
						</li>
					</ul>
				<?php }
			?>
		</div>
		<div class="darkpress-top-tag-right">
			<div class="time-wrapper">
			 	<time datetime="<?php echo esc_attr( date( DATE_W3C ) ); ?>"> <i class="fa fa-calendar"></i> <?php echo esc_html( date( get_option( 'date_format' ) ) ); ?></time>
			 	<div class="darkpress-digital-clock-wrapper"><i class="fa fa-clock-o"></i><div id="darkpress-digital-clock"></div></div>			 	
			</div>
			<?php if( Dark_Press_Helper::get_menu( 'social-menu-header', false ) ){?>
				<div class="darkpress-social-menu darkpress-topbar-socialmenu">
				 	<?php Dark_Press_Helper::get_menu( 'social-menu-header', true ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>