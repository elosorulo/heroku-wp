<?php
/**
* Register Go to pro button
*
* @since 1.0.3
*
* @package Dark Press WordPress Theme
*/
function dark_press_go_to_pro(){
	Dark_Press_Customizer::set(array(
		'section' => array(
			'id'       => 'go-to-pro', 
			'type'     => 'dark-press-anchor',
			'title'    => esc_html__( 'Dark Press Pro', 'dark-press' ),
			'url'      => esc_url( 'https://wpactivethemes.com/downloads/dark-press-pro/' ),
			'priority' => 0
		)
	));
}
add_action( 'init', 'dark_press_go_to_pro' );