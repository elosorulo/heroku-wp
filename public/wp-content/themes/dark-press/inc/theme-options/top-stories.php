<?php
if( !function_exists( 'dark_press_acb_top_stories' ) ):
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
	function dark_press_acb_top_stories( $control ){
		$value = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'top-stories-status' ) )->value();
		return $value;
	}
endif;

if( !function_exists( 'dark_press_acb_top_stories_type' ) ):
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
	function dark_press_acb_top_stories_type( $control ){
		$top_story = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'top-stories-status' ) )->value();
		$type = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'top-stories-type' ) )->value();
		return $top_story && 'category' == $type;
	}
endif;

/**
* Header top stories
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_top_stories_options(){
	Dark_Press_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Top Bar
		'section' => array(
		    'id'    => 'top-stories',
		    'title' => esc_html__( 'Top Stories', 'dark-press' ),
		    'priority'    => 30,
		),
		'fields' => array(
			array(
				'id'	=> 'top-stories-status',
				'label' => esc_html__( 'Enable', 'dark-press' ),
				'default' => true,
 				'type'  => 'dark-press-toggle'
			),
			array(
				'id'	=> 'top-stories-title',
				'label' => esc_html__( 'Title', 'dark-press' ),
				'default' => esc_html__( 'Top Stories', 'dark-press' ),
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_stories' ),
 				'type'  => 'text',
			    'partial' =>	array(
			    	'selector'	=>	'span.top-stories'
				)
			),
			array(
				'id'	=> 'top-stories-no-post',
				'label' => esc_html__( 'Number Of Posts To Display', 'dark-press' ),
				'default' => 4,
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_stories' ),
 				'type'  => 'number'
			),
			array(
				'id'	=> 'top-stories-type',
				'label' => esc_html__( 'Stories Type', 'dark-press' ),
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_stories' ),
				'type'    => 'dark-press-buttonset',
				'default' => 'latest',
				'choices' => array(
				    'latest' 	=> esc_html__( 'Latest Post', 'dark-press' ),
				    'category'	=> esc_html__( 'From Category', 'dark-press' ),
				)
			),
			array(
				'id' => 'top-stories-cat',
				'label' => esc_html__( 'Select Category', 'dark-press' ),
				'default' => 0,
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_stories_type' ),
				'type' => 'dark-press-category-dropdown'
			),
			array(
				'id'      => 'ts-bg-color',
				'label'   => esc_html__( 'Background color', 'dark-press' ),
				'default' => '#1e1e1e',
				'type'    => 'dark-press-color-picker',
			),
		)
	));
}
add_action( 'init', 'dark_press_top_stories_options' );