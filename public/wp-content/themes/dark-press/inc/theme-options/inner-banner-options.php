<?php
/**
 * Inner banner options in customizer
 *
 * @return void
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

function dark_press_inner_banner_options(){ 
	Dark_Press_Customizer::set(array(
		# Theme Option > color options
		'section' => array(
		    'id'       => 'header_image',
		    'priority' => 80,
		    'prefix' => false,
		),
		'fields'  => array(
			array(
				'id'	=> 'disable-common-banner',
				'label' => esc_html__( 'Disable Banner', 'dark-press' ),
				'description' => esc_html__( 'This is common option which control banner in entire site.' , 'dark-press' ),
				'default' => false,
 				'type'  => 'dark-press-toggle',
 				'priority'    => 0,
			),
			array(
				'id'      	  => 'ib-blog-title',
				'label'   	  => esc_html__( 'Title' , 'dark-press' ),
				'description' => esc_html__( 'It is displayed when home page is latest posts.' , 'dark-press' ),
				'default' 	  => esc_html__( 'Latest Blog' , 'dark-press' ),
				'type'	  	  => 'text',
				'priority'    => 10,
			),
		    array(
		        'id'	  	  => 'ib-title-size',
		        'label'   	  => esc_html__( 'Font Size', 'dark-press' ),
		        'description' => esc_html__( 'The value is in px. Defaults to 40px.' , 'dark-press' ),
		        'default' => array(
		    		'desktop' => 40,
		    		'tablet'  => 32,
		    		'mobile'  => 32,
		    	),
				'input_attrs' =>  array(
		            'min'   => 1,
		            'max'   => 60,
		            'step'  => 1,
		        ),
		        'type' => 'dark-press-slider',
		        'priority' => 20
		    ),
		    array(
		        'id'      => 'ib-title-color',
		        'label'   => esc_html__( 'Text Color' , 'dark-press' ),
		        'type'    => 'dark-press-color-picker',
		        'default' => '#ffffff',
		        'priority' => 30
		    ),
		    array(
		    	'id' 	   => 'ib-background-color',
		    	'label'    => esc_html__( 'Overlay Color', 'dark-press' ),
		    	'default'  => 'rgba(10,10,10,0.68)',
		    	'type' 	   => 'dark-press-color-picker',
		    	'priority' => 40,
		    ),
		    array(
		        'id'      => 'ib-text-align',
		        'label'   => esc_html__( 'Alignment' , 'dark-press' ),
		        'type'    => 'dark-press-buttonset',
		        'default' => 'banner-content-center',
		        'choices' => array(
		        	'banner-content-left'   => esc_html__( 'Left' , 'dark-press'   ),
		        	'banner-content-center' => esc_html__( 'Center' , 'dark-press' ),
		        	'banner-content-right'  => esc_html__( 'Right' , 'dark-press'  ),
		         ),
		        'priority' => 50
		    ),
			array(
			    'id'      => 'ib-image-attachment', 
			    'label'   => esc_html__( 'Image Attachment' , 'dark-press' ),
			    'type'    => 'dark-press-buttonset',
			    'default' => 'banner-background-scroll',
			    'choices' => array(
			    	'banner-background-scroll'           => esc_html__( 'Scroll' , 'dark-press' ),
			    	'banner-background-attachment-fixed' => esc_html__( 'Fixed' , 'dark-press' ),
			    ),
		        'priority' => 60
			),
			array(
			    'id'      	=> 'ib-height',
			    'label'   	=> esc_html__( 'Height (px)', 'dark-press' ),
			    'type'    	=> 'dark-press-slider',
	            'description' => esc_html__( 'The value is in px. Defaults to 420px.' , 'dark-press' ),
	            'default' => array(
	        		'desktop' => 300,
	        		'tablet'  => 300,
	        		'mobile'  => 300,
	        	),
	    		'input_attrs' =>  array(
	                'min'   => 1,
	                'max'   => 1000,
	                'step'  => 1,
	            ),
			),
		    'priority' => 70
		),
	) );
}
add_action( 'init', 'dark_press_inner_banner_options' );