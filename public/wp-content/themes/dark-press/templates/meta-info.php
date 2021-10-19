<?php
/**
 * Displays the meta information
 *
 * @since 1.0.0
 *
 * @package Guternbiz WordPress Theme
 */?>

<?php if ( 'post' === get_post_type() ) : ?>
	<?php 
		$category = dark_press_get( 'post-category' );
		$author   = dark_press_get( 'post-author' );
		$date     = dark_press_get( 'post-date' );
	if( $category || $author || $date ) : ?>
		<div class="entry-meta 
			<?php 
				if( is_single() ){
					echo esc_attr( 'single' );
				} 
			?>"
		>
			<?php Dark_Press_Helper::get_author_image(); ?>
			<?php if( $author || $date ) : ?>
				<div class="author-info">
					<?php
						Dark_Press_Helper::the_date();			
						Dark_Press_Helper::posted_by();
					?>
				</div>
			<?php endif; ?>
		</div>
		<?php Dark_Press_Helper::the_category(); ?>	
	<?php endif; ?>
<?php endif; ?>