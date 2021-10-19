<?php
if( !function_exists( 'dark_press_acb_enable_footer_featured' ) ):
	/**
	* Active callback function of top stories post
	*
	* @static
	* @access public
	* @return boolen
	* @since 1.0.0
	*
	* @package Dark Press WordPress Theme
	*/
	function dark_press_acb_enable_footer_featured( $control ){
		$value = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'enable-footer-featured-news' ) )->value();
		return $value;
	}
endif;

if( !function_exists( 'dark_press_acb_enable_footer_featured_cat' ) ):
	/**
	* Active callback function of top stories type
	*
	* @static
	* @access public
	* @return boolen
	* @since 1.0.0
	*
	* @package Dark Press WordPress Theme
	*/
	function dark_press_acb_enable_footer_featured_cat( $control ){
		$top_story = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'enable-footer-featured-news' ) )->value();
		$type = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'footer-featured-type' ) )->value();
		return $top_story && 'category' == $type;
	}
endif;


/**
* Blog page Footer Features options
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_footer_featured_options(){
	Dark_Press_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Top Bar
		'section' => array(
		    'id'    => 'footer-featured-news',
		    'title' => esc_html__( 'Footer Featured News', 'dark-press' ),
		    'priority'    => 120,
		),
		'fields' => array(
			array(
				'id'	=> 'enable-footer-featured-news',
				'label' => esc_html__( 'Enable', 'dark-press' ),
				'default' => true,
 				'type'  => 'dark-press-toggle'
			),
			array(
				'id'	=> 'footer-featured-title',
				'label' => esc_html__( 'Title', 'dark-press' ),
				'default' => esc_html__( 'You May Missed', 'dark-press' ),
				'active_callback' => array( 'fn_name' => 'dark_press_acb_enable_footer_featured' ),
 				'type'  => 'text',
 				'partial' =>array(
 					'selector' => '.darkpress-you-missed h2'
 				)
			),
			array(
			    'id'      => 'footer-featured-excerpt-length',
			    'label'   => esc_html__( 'Excerpt Length', 'dark-press' ),
			    'default' => 20,
			    'active_callback' => array( 'fn_name' => 'dark_press_acb_enable_footer_featured' ),
			    'type'    => 'number',
			),
			array(
				'id'	=> 'footer-featured-type',
				'label' => esc_html__( 'Featured News Type', 'dark-press' ),
				'active_callback' => array( 'fn_name' => 'dark_press_acb_enable_footer_featured' ),
				'type'    => 'dark-press-buttonset',
				'default' => 'category',
				'choices' => array(
				    'latest' 	=> esc_html__( 'Latest Post', 'dark-press' ),
				    'category'	=> esc_html__( 'From Category', 'dark-press' ),
				)
			),
			array(
				'id' => 'footer-featured-cat',
				'label' => esc_html__( 'Select Category', 'dark-press' ),
				'default' => 0,
				'active_callback' => array( 'fn_name' => 'dark_press_acb_enable_footer_featured_cat' ),
				'type' => 'dark-press-category-dropdown'
			)
		)
	));
}
add_action( 'init', 'dark_press_footer_featured_options' );