<?php
/**
 * Class to register post with thumbnai widget
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

class Dark_Press_Post_With_Thumb_Widget extends Dark_Press_Base_Widget{

	/**
	 * make needed options for widget
	 *
	 * @static
	 * @access public
	 * @since 1.0.0
	 *
	 * @package Dark Press WordPress Theme
	 */

	public function __construct(){

		parent::__construct( 
			'post_with_thumbnail',
			esc_html__( 'ST: Recent Post With Thumbnail', 'dark-press' )
		);

		$this->fields = array(
			'darkpress_pwt_title'=>array(
				'label'   => esc_html__( 'Title', 'dark-press' ),
				'type'    => 'text',
				'default' => ''
			),
			'darkpress_pwt_number_of_post' => array(
				'label'   => esc_html__( 'Number of post', 'dark-press' ),
				'type'    => 'number',
				'default' => 4
			),
			'darkpress_pwt_show_excerpt' => array(
				'label'   => esc_html__( 'Show Excerpt', 'dark-press' ),
				'type'    => 'checkbox',
				'default' => true
			),
			'darkpress_pwt_excerpt_length' => array(
				'label'   => esc_html__( 'Excerpt Length', 'dark-press' ),
				'type'    => 'number',
				'default' => 10
			),
		);
	}

	/**
	 * Markup for widget
	 *
	 * @static
	 * @access public
	 * @since 1.0.0
	 *
	 * @package Dark Press WordPress Theme
	 */
	public function widget( $args, $instance ){
		echo $args[ 'before_widget' ];
		
		$instance = $this->init_defaults( $instance );

		$recent_posts = wp_get_recent_posts(array(
		    'numberposts' => $instance[ 'darkpress_pwt_number_of_post' ],
		    'post_status' => 'publish',
		    'order' => 'DESC',
		    'orderby' => 'ID'
		));
		if( !empty( $recent_posts ) ){ ?>
			<div class="darkpress-recent-posts-wrapper">
				<?php if( '' != $instance[ 'darkpress_pwt_title' ] ){ ?>
					<h2 class="widget-title darkpress-widget-title"><?php echo esc_html( $instance[ 'darkpress_pwt_title' ] ); ?></h2>
				<?php } ?>
				<ul>
					<?php foreach ( $recent_posts as $p ) { ?>
						<li>
							<a href="<?php echo esc_url( get_the_permalink( $p[ 'ID' ] ) ); ?>">								
							
								<img src="<?php echo esc_url( get_the_post_thumbnail_url( $p[ 'ID' ], 'thumbnail' ) ); ?>" alt="" />
								<div class="darkpress-pwt-content-wrappet">
									<h3><?php echo esc_html( get_the_title( $p[ 'ID' ] ) ); ?></h3>
									<div class="post-date"><?php Dark_Press_Helper::the_date( $p[ 'ID' ] ); ?></div>
									<?php Dark_Press_Helper::the_category( $p[ 'ID' ] ); ?>
									<?php if( $instance[ 'darkpress_pwt_show_excerpt' ] ){ ?>
										<p class="darkpress-content"><?php echo dark_press_excerpt( $instance[ 'darkpress_pwt_excerpt_length' ], false, '...', $p[ 'ID' ] ); ?></p>
									<?php } ?>
								</div>
							</a>
						</li>

					<?php } ?>				
				</ul>
			</div>
		<?php }
		echo $args[ 'after_widget' ];
	}
}