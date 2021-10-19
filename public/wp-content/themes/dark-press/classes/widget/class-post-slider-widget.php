<?php
/**
 * Class to register post slider widget
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

class Dark_Press_Post_Slider_Widget extends Dark_Press_Base_Widget{

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
			'post_slider_widget',
			esc_html__( 'ST: Post Slider Widget', 'dark-press' )
		);

		$this->fields = array(
			'darkpress_slider_description'=>array(
				'description' => esc_html__( 'NOTE: Only five lastes post will be displayed. Leave title empty to disable.', 'dark-press' ),
				'type'    => 'description',
			),
			'darkpress_slider_title'=>array(
				'label'   => esc_html__( 'Title', 'dark-press' ),
				'type'    => 'text',
				'default' => ''
			),
			'darkpress_slider_select_cat'=>array(
				'label'   => esc_html__( 'Select Category', 'dark-press' ),
				'type'    => 'dropdown-categories',
				'default' => 1
			),
			'darkpress_slider_date'=>array(
				'label'   => esc_html__( 'Enable Date', 'dark-press' ),
				'type'    => 'checkbox',
				'default' => 1
			),
			'darkpress_slider_cat'=>array(
				'label'   => esc_html__( 'Enable Category', 'dark-press' ),
				'type'    => 'checkbox',
				'default' => 1
			),
			'darkpress_slider_excerpt'=>array(
				'label'   => esc_html__( 'Enable Excerpt', 'dark-press' ),
				'type'    => 'checkbox',
				'default' => 1
			),
			'darkpress_slider_excerpt_length'=>array(
				'label'   => esc_html__( 'Excerpt Length', 'dark-press' ),
				'type'    => 'number',
				'default' => 20
			),
			'darkpress_slider_arrow'=>array(
				'label'   => esc_html__( 'Enable Arrow', 'dark-press' ),
				'type'    => 'checkbox',
				'default' => 1
			),
			'darkpress_slider_dots'=>array(
				'label'   => esc_html__( 'Enable Dots', 'dark-press' ),
				'type'    => 'checkbox',
				'default' => 1
			),
			'darkpress_slider_auto_play'=>array(
				'label'   => esc_html__( 'Enable Auto Play', 'dark-press' ),
				'type'    => 'checkbox',
				'default' => 0
			),
			'darkpress_slider_slide_to_show'=>array(
				'label'   => esc_html__( 'Slide To Show', 'dark-press' ),
				'type'    => 'number',
				'default' => 2
			),
			'darkpress_slider_slide_to_scroll'=>array(
				'label'   => esc_html__( 'Slide To Scroll', 'dark-press' ),
				'type'    => 'number',
				'default' => 1
			)
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
		$active_post = Dark_Press_Theme::get_posts_by_type( 'category', $instance[ 'darkpress_slider_select_cat' ], 5 );
		$data_slider = json_encode( array(
			'arrows' => $instance[ 'darkpress_slider_arrow' ],
			'dots' => $instance[ 'darkpress_slider_dots' ],
			'side_to_show' => $instance[ 'darkpress_slider_slide_to_show' ],
			'side_to_scroll' => $instance[ 'darkpress_slider_slide_to_scroll' ],
			'auto_play' => $instance[ 'darkpress_slider_auto_play' ]
		) );

		if( !empty( $active_post ) ){
			if( '' != $instance[ 'darkpress_slider_title' ] ){ ?>
				<h2 class="widget-title darkpress-widget-title"><?php echo esc_html( $instance[ 'darkpress_slider_title' ] ); ?></h2>
			<?php } ?>
			<div class="darkpress-post-slider-widget-wrapper" data-slider-val=<?php echo $data_slider; ?>>
				<?php foreach ( $active_post as $p ) { ?>
					<div class="darkpress-post-slider-widget-inner">
						<article style="background-image: url( '<?php echo esc_url( get_the_post_thumbnail_url( $p ) ); ?>') , url('<?php echo esc_url( Dark_Press_Helper::get_theme_uri( 'assets/img/default-image.jpg' ) ); ?>' )">
								<div class="dark-press-featured-link">
									<a href="<?php echo esc_url( get_the_permalink( $p ) ); ?>"></a>
								</div>
								<div class="darkpress-feature-news-content">
									<div class="date-n-cat-wrapper">
										<?php
										if( $instance[ 'darkpress_slider_date' ] ){
											Dark_Press_Helper::the_date( $p );			
										}
										if( $instance[ 'darkpress_slider_cat' ] ){
											Dark_Press_Helper::the_category( $p );
										}
										?>
									</div>

									<h2 class="darkpress-news-title">
										<a href="<?php the_permalink( $p ); ?>"><?php echo esc_html( get_the_title( $p ) );?></a>
									</h2>
									<?php if( $instance[ 'darkpress_slider_excerpt' ] ){ ?>
										<p class="feature-news-content darkpress-content"><?php echo dark_press_excerpt( $instance[ 'darkpress_slider_excerpt_length' ], false, '...', $p ); ?></p>
									<?php } ?>
								</div>
						</article>
					</div>
				<?php } ?>
			</div>
		<?php }
		echo $args[ 'after_widget' ];
	}
}