<?php
/**
 * Class to register post tabbed widget
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

class Dark_Press_Post_Tabbed_Widget extends Dark_Press_Base_Widget{

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
			'post_tabbed_widget',
			esc_html__( 'ST: Post Tabbed Widget', 'dark-press' )
		);

		$this->fields = array(
			'darkpress_ptw_title'=>array(
				'label'   => esc_html__( 'Title', 'dark-press' ),
				'type'    => 'text',
				'default' => ''
			),
			'darkpress_number_of_post' => array(
				'label'   => esc_html__( 'Number of post to display', 'dark-press' ),
				'type'    => 'number',
				'default' => 3
			),
			'darkpress_cat_1'=>array(
				'label'   => esc_html__( 'Select First Category', 'dark-press' ),
				'type'    => 'dropdown-categories',
				'default' => 1
			),
			'darkpress_cat_2'=>array(
				'label'   => esc_html__( 'Select Second Category', 'dark-press' ),
				'type'    => 'dropdown-categories',
				'default' => 0
			),
			'darkpress_cat_3'=>array(
				'label'   => esc_html__( 'Select Third Category', 'dark-press' ),
				'type'    => 'dropdown-categories',
				'default' => 0
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
		$cat_arr = array();
		$post_array = array();
		if( $instance[ 'darkpress_cat_1' ] ){
			$cat_arr[] = $instance[ 'darkpress_cat_1' ];
			$posts_cat_1 = $this->get_post_by_category_id( $instance[ 'darkpress_cat_1' ], $instance[ 'darkpress_number_of_post' ] );
			if( $posts_cat_1 ){
				$post_array[ $instance[ 'darkpress_cat_1' ] ] = $posts_cat_1;
			}
		}
		if( $instance[ 'darkpress_cat_2' ] ){
			$cat_arr[] = $instance[ 'darkpress_cat_2' ];
			$posts_cat_2 = $this->get_post_by_category_id( $instance[ 'darkpress_cat_2' ], $instance[ 'darkpress_number_of_post' ] );
			if( $posts_cat_2 ){
				$post_array[ $instance[ 'darkpress_cat_2' ] ] = $posts_cat_2;
			}
		}
		if( $instance[ 'darkpress_cat_3' ] ){
			$cat_arr[] = $instance[ 'darkpress_cat_3' ];
			$posts_cat_3 = $this->get_post_by_category_id( $instance[ 'darkpress_cat_3' ], $instance[ 'darkpress_number_of_post' ] );
			if( $posts_cat_3 ){
				$post_array[ $instance[ 'darkpress_cat_3' ] ] = $posts_cat_3;
			}
		}

		$cat_arr = array_unique( $cat_arr );

		if( !empty( $cat_arr )  ):
			if( '' != $instance[ 'darkpress_ptw_title' ] ){ ?>
				<h2 class="widget-title darkpress-widget-title"><?php echo esc_html( $instance[ 'darkpress_ptw_title' ] ); ?></h2>
			<?php } ?>
			<div class="darkpress-tabbed-widget">
				<ul>
					<?php foreach( $cat_arr as $key => $c ):?>
						<li class="post-tabbed <?php echo esc_attr( $key == 0 ? 'active' : '' ); ?>" 
							data-cat-id ="<?php echo esc_attr( $c ); ?>">
								<?php echo esc_html( get_cat_name( $c ) );  ?>								
						</li>
					<?php endforeach; ?>
				</ul>
				<div classs="darkpress-tabbed-post-wrapper">
					<?php $counter = 1;
					foreach( $post_array as $id => $cat_post ):?>
						<div class="darkpress-tabbed-cat-wrapper darkpress-category-<?php echo esc_attr( $id ); ?>" 
							style="display: <?php  echo esc_attr( $counter == 1 ? 'block' : 'none' ); ?> ">
							<?php foreach( $cat_post as $p ): ?>
								<div class="darkpress-single-tabbed">
									<div>
										<a href="<?php echo esc_url( get_the_permalink( $p ) ); ?>"><img src="<?php echo esc_url( get_the_post_thumbnail_url( $p, 'thumbnail' ) ); ?>" alt=""></a>
										<div class="inner-content">
											<h3><a href="<?php echo esc_url( get_the_permalink( $p ) ); ?>"><?php echo esc_html( get_the_title( $p ) ); ?></a></h3>
											<?php Dark_Press_Helper::the_date( $p );?>

										</div>
 									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php $counter ++;
					endforeach; ?>					
				</div>
			</div>
		<?php endif;
		echo $args[ 'after_widget' ];
	}

	/**
	 * Get posts with category id
	 *
	 * @static
	 * @access public
	 * @since 1.0.0
	 *
	 * @package Dark Press WordPress Theme
	 */
	public function get_post_by_category_id( $cat_arr, $num_of_post = -1 ){
		$posts = array();
		$cat_args = array(
			'post_type' => 'post',
			'posts_per_page' => $num_of_post,
			'orderby' => 'post__in',
			'ignore_sticky_posts' => 1,
			'cat' => $cat_arr
		);
		$query = new WP_Query( $cat_args );
		while ( $query->have_posts() ) {
		    $query->the_post();
		    $posts[] = get_the_ID();
		}
		wp_reset_postdata();

		if( empty( $posts ) ){
			return false;
		}else{
			return $posts;
		}
	}
}