<?php
/**
* Blog page Features content
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/?>
<section class="darkpress-you-missed">
	<?php $ftr_featured_news = Dark_Press_Theme::get_posts_by_type( dark_press_get( 'footer-featured-type' ), dark_press_get( 'footer-featured-cat' ), 6 );
	if( $ftr_featured_news ){ ?>
		<h2><?php echo esc_html( dark_press_get( 'footer-featured-title' ) ); ?></h2>
		<div class="you-may-miss-slider-init">
		<?php foreach ( $ftr_featured_news as $p ) {?>
			<div class="darkpress-feature-news-inner">
				<article >
					<div class="darkpress-missed-image-wrap" style="background-image: url( '<?php echo esc_url( get_the_post_thumbnail_url( $p ) ); ?>') , url('<?php echo esc_url( Dark_Press_Helper::get_theme_uri( 'assets/img/default-image.jpg' ) ); ?>' )">
						<div class="dark-press-footer-featured-link">
							<a href="<?php echo esc_url( get_the_permalink( $p ) ); ?>"></a>
						</div>
						<?php Dark_Press_Helper::the_category( $p ); ?>
					</div>
					<div class="darkpress-feature-news-content">
						<div class="date-n-cat-wrapper">
							<?php Dark_Press_Helper::the_date( $p ); ?>							
						</div>
						<h3 class="darkpress-news-title">
							<a href="<?php the_permalink( $p ); ?>"><?php echo esc_html( get_the_title( $p ) );?></a>
						</h3>
						<p class="feature-news-content"><?php echo dark_press_excerpt( dark_press_get( 'footer-featured-excerpt-length' ), false, '...', $p ); ?></p>
					</div>
				</article>
			</div>
		<?php } ?>
		</div>
	<?php }
	?>
</section>