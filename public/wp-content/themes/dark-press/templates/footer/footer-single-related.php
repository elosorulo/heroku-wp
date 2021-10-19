<?php
/**
 * Templates to add related posts on single page
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */
$related = get_query_var('single_related_posts');
if( $related ): ?>
	<div class="darkpress-related-post">
		<div class="container">
			<h2><?php esc_html_e( 'You may also like', 'dark-press' );?></h2>
			<div class="row">
				<?php foreach ( $related as $r ):?>
					<div class="col-12 col-md-3">
						<div class="darkpress-related-post-content">
							<a href="<?php echo esc_url( get_permalink( $r->ID ) ); ?>">
								<?php if( has_post_thumbnail( $r->ID ) ): ?>
									<img src="<?php echo esc_attr( get_the_post_thumbnail_url( $r->ID, 'full' ) ); ?>">
								<?php endif; ?>			
								<div class="darkpress-related-post-text">
									<h3><?php echo esc_html( $r->post_title ); ?></h3>
									<p><?php echo dark_press_excerpt( dark_press_get( 'excerpt_length' ), false, '...', $r->ID ); ?></p>
								</div>
							</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>