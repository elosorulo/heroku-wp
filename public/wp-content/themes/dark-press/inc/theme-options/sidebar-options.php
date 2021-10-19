<?php
/**
* Register sidebar Options
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_sidebar_options(){
	Dark_Press_Customizer::set(array(
		# Theme Options
		'panel'   => 'panel',
		# Theme Options >Sidebar Layout > Settings
		'section' => array(
			'id'     => 'sidebar-options',
			'title'  => esc_html__( 'Sidebar Options','dark-press' ),
			'priority' => 100
		),
		'fields' => array(
			# sb - Sidebar
			array(
			    'id'      => 'sidebar-position',
			    'label'   => esc_html__( 'Sidebar Position' , 'dark-press' ),
			    'type'    => 'dark-press-buttonset',
			    'default' => 'right-sidebar',
			    'choices' => array(
			        'left-sidebar'  => esc_html__( 'Left' , 'dark-press' ),
			        'right-sidebar' => esc_html__( 'Right' , 'dark-press' ),
			        'no-sidebar'    => esc_html__( 'None', 'dark-press' ),
			     )
			),
		),
	) );
}
add_action( 'init', 'dark_press_sidebar_options' );