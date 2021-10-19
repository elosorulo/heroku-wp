<?php
/**
* Register breadcrumb Options
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_color_options(){	
	Dark_Press_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > color options
		'section' => array(
		    'id'       => 'color-section',
		    'title'    => esc_html__( 'Color Options' ,'dark-press' ),
		    'priority' => 60
		),
		'fields'  =>array(
			array(
				'id'      => 'primary-color',
				'label'   => esc_html__( 'Primary Color', 'dark-press' ),
				'default' => '#000 ',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'body-paragraph-color',
				'label'   => esc_html__( 'Body Text Color', 'dark-press' ),
				'default' => '#8e8e8e',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'link-color',
				'label'   => esc_html__( 'Link Color', 'dark-press' ),
				'default' => '#145fa0',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'link-hover-color',
				'label'   => esc_html__( 'Link Hover Color', 'dark-press' ),
				'default' => '#737373',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'   => 'line-2',
				'type' => 'dark-press-hz-line',
			),
			array(
				'id'      => 'sb-widget-title-color',
				'label'   => esc_html__( 'Sidebar Widget Title Color', 'dark-press' ),
				'default' => '#fff',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'sb-widget-content-color',
				'label'   => esc_html__( 'Sidebar Widget Content Color', 'dark-press' ),
				'default' => '#8e8e8e',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'sb-widget-link-color',
				'label'   => esc_html__( 'Sidebar Widget Link Color', 'dark-press' ),
				'default' => '#8e8e8e',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'sb-widget-link-hover-color',
				'label'   => esc_html__( 'Sidebar Widget Link Hover Color', 'dark-press' ),
				'default' => '#d6d6d6',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'   => 'line-3',
				'type' => 'dark-press-hz-line',
			),
			array(
				'id'      => 'footer-title-color',
				'label'   => esc_html__( 'Footer Widget Title Color', 'dark-press' ),
				'default' => '#fff',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'footer-content-color',
				'label'   => esc_html__( 'Footer Widget Content Color', 'dark-press' ),
				'default' => '#a8a8a8',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'footer-link-color',
				'label'   => esc_html__( 'footer Link Color', 'dark-press' ),
				'default' => '#8e8e8e',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'footer-link-hover-color',
				'label'   => esc_html__( 'footer Link Hover Color', 'dark-press' ),
				'default' => '#d6d6d6',
				'type'    => 'dark-press-color-picker',
			),
		),			
	));
}
add_action( 'init', 'dark_press_color_options' );