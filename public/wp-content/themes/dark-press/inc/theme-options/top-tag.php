<?php
if( !function_exists( 'dark_press_acb_top_tag' ) ):
	/**
	* Active callback function of top tag post
	*
	* @static
	* @access public
	* @return boolen
	* @since 1.0.0
	*
	* @package Dark Press WordPress Theme
	*/
	function dark_press_acb_top_tag( $control ){
		$value = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'top-tag-status' ) )->value();
		return $value;
	}
endif;

/**
* Header top tag
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_top_tag_options(){
	Dark_Press_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Top Bar
		'section' => array(
		    'id'    => 'top-tag-status',
		    'title' => esc_html__( 'Top Tag', 'dark-press' ),
		    'priority'    => 30,
		),
		'fields' => array(
			array(
				'id'	=> 'top-tag-status',
				'label' => esc_html__( 'Enable', 'dark-press' ),
				'default' => true,
 				'type'  => 'dark-press-toggle'
			),
			array(
				'id'	=> 'top-tag-title',
				'label' => esc_html__( 'Title', 'dark-press' ),
				'default' => esc_html__( 'Top Tag', 'dark-press' ),
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_tag' ),
 				'type'  => 'text',
			    'partial' =>	array(
			    	'selector'	=>	'span.top-tag'
				)
			),
			array(
				'id'      => 'tt-bg-color',
				'label'   => esc_html__( 'Background color', 'dark-press' ),
				'default' => '#000',
				'type'    => 'dark-press-color-picker',
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_tag' )
			),
			array(
				'id'      => 'tt-text-color',
				'label'   => esc_html__( 'Text color', 'dark-press' ),
				'default' => '#ffffff',
				'type'    => 'dark-press-color-picker',
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_tag' )
			),
			array(
				'id'   => 'line-tag-saperator',
				'type' => 'dark-press-hz-line',
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_tag' )
			),
			array(
				'id' => 'top-tag-list',
				'label' => esc_html__( 'Select Tags', 'dark-press' ),
				'default' => 0,
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_tag' ),
				'type' => 'multiple-select',
				'description' => esc_html__( 'Hold down the Ctrl (windows) or Command (Mac) button to select multiple options. If not selected default tag will be displayed.' ,'dark-press' ),
				'choices' => Dark_Press_Theme::get_tags_list()
			),
			array(
				'id'      => 'tt-tag-bg-color',
				'label'   => esc_html__( 'Tag Background color', 'dark-press' ),
				'default' => '#6b6b6b',
				'type'    => 'dark-press-color-picker',
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_tag' )
			),
			array(
				'id'      => 'tt-tag-text-color',
				'label'   => esc_html__( 'Tag Text color', 'dark-press' ),
				'default' => '#ffffff',
				'type'    => 'dark-press-color-picker',
				'active_callback' => array( 'fn_name' => 'dark_press_acb_top_tag' )
			),
		)
	));
}
add_action( 'init', 'dark_press_top_tag_options' );