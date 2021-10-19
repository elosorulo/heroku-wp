<?php
/**
 * Resets all the value of customizer
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

if( !function_exists( 'dark_press_get_setting_id' ) ):
	add_action( 
		Dark_Press_Helper::fn_prefix( 'customize_register_start' ), 
		'dark_press_get_setting_id', 30, 2 );
	/**
	* Get all the setting id to reset the data.
	*
	* @return array
	* @since 1.0.0
	*
	* @package Dark Press WordPress Theme
	*/
	function dark_press_get_setting_id( $instance, $wp_customize ) {
		
		Dark_Press_Customizer::set(array(
			# Theme option
			'panel' => 'panel',
			# Theme Option > Reset options
			'section' => array(
			    'id'    => 'reset-section',
			    'title' => esc_html__( 'Reset Options' ,'dark-press' ),
			    'priority' => 140
			),
			'fields' => array(
				array(
				    'id' 	      => 'reset-options',
				    'type'        => 'dark-press-reset',
				    'settings'    => array_keys( $instance::$settings ),
				    'label'       => esc_html__( 'Reset', 'dark-press' ),
				    'description' => esc_html__( 'Reseting will delete all the data. Once reset, you will not be able to get back those data.', 'dark-press' ),
				),
			),
		) );
	}
endif;
