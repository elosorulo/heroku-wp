<?php
if( !function_exists( 'dark_press_acb_custom_header_one' ) ):
	/**
	* Active callback function of header top bar
	*
	* @static
	* @access public
	* @return boolen
	* @since 1.0.0
	*
	* @package Dark Press WordPress Theme
	*/
	function dark_press_acb_custom_header_one( $control ){
		$value = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'container-width' ) )->value();
		return 'default' == $value;
	}
endif;

/**
* Register Advanced Options
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_advanced_options(){

	Dark_Press_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Header
		'section' => array(
		    'id'    => 'advance-options',
		    'title' => esc_html__( 'Advanced Options', 'dark-press' ),
		    'priority' => 130
		),
		# Theme Option > Header > settings
		'fields' => array(
			array(
				'id'	=> 'pre-loader',
				'label' => esc_html__( 'Show Preloader', 'dark-press' ),
				'default' => true,
				'type'  => 'dark-press-toggle',
			),
			array(
			    'id'      => 'assets-version',
			    'label'   => esc_html__( 'Assets Version', 'dark-press' ),
			    'type'    => 'dark-press-buttonset',
			    'default' => 'development',
			    'choices' => array(
			        'development' => esc_html__( 'Development', 'dark-press' ),
			        'production'  => esc_html__( 'Production', 'dark-press' ),
			    )
			),
			array(
			    'id'      =>  'container-width',
			    'label'   => esc_html__( 'Site Layout', 'dark-press' ),
			    'type'    => 'dark-press-buttonset',
			    'default' => 'default',
			    'choices' => array(
			        'default' => esc_html__( 'Default', 'dark-press' ),
			        'box'	  => esc_html__( 'Boxed', 'dark-press' ),
			    )
			),
		    array(
		        'id'          	  => 'container-custom-width',
		        'label'   	  	  => esc_html__( 'Container Width', 'dark-press' ),
		        'active_callback' => array(
		        	'fn_name' => 'dark_press_acb_custom_header_one'
		        ),
		        'type'        	  => 'dark-press-range',
		        'default'     	  => 1400,
	    		'input_attrs' 	  =>  array(
	                'min'   => 400,
	                'max'   => 2000,
	                'step'  => 5,
	            ), 
		    ),
		)
	));
}
add_action( 'init', 'dark_press_advanced_options' );