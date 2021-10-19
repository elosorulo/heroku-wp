<?php
/**
* Register Header Options
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_header_options(){
	Dark_Press_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Top Bar
		'section' => array(
		    'id'    => 'header',
		    'title' => esc_html__( 'Header Options', 'dark-press' ),
		    'priority'    => 20,
		),
		'fields' => array(
			array(
				'id'	=> 'header-bg-image',
				'label' => esc_html__( 'Background Image', 'dark-press' ),
 				'type'  => 'image'
			),
			array(
				'id'	=> 'header-bg-overlay',
				'label' => esc_html__( 'Background Overlay', 'dark-press' ),
				'default' => 'rgba(10,10,10,0.7)',
 				'type'  => 'dark-press-color-picker'
			),
			array(
				'id'	=> 'header-advertisement-image',
				'label' => esc_html__( 'Advertisement Image', 'dark-press' ),
				'description' => esc_html__( 'Recommended image size 1400*150', 'dark-press' ),
 				'type'  => 'image'
			),
			array(
				'id' => 'header-advertisement-url',
				'label' => esc_html__( 'Advertisement Image Link', 'dark-press' ),
				'type' => 'url'
			),
			array(
				'id'      => 'primary-menu-bg-color',
				'label'   => esc_html__( 'Primary Menu Background color', 'dark-press' ),
				'default' => '#1e1e1e',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'primary-menu-item-color',
				'label'   => esc_html__( 'Primary Menu Item color', 'dark-press' ),
				'default' => '#ffffff',
				'type'    => 'dark-press-color-picker',
			),
			array(
			    'id'          => 'primary-menu-font-size',
			    'label'       => esc_html__( 'Primary Menu Font Size', 'dark-press' ),
			    'description' => esc_html( 'The value is in px. Defaults to 15px.', 'dark-press' ),
			    'type'        => 'dark-press-slider',
			    'default' => array(
			        'desktop' => 15,
			        'tablet'  => 15,
			        'mobile'  => 15,
			    ),
			    'input_attrs' =>  array(
			        'min'   => 1,
			        'max'   => 40,
			        'step'  => 1,
			    ),
			),
		)
	));
}
add_action( 'init', 'dark_press_header_options' );