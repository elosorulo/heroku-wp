<?php
/**
 * Register font size and choice to display logo or title.
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

/**
* Register Site Identity Options
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_site_identity(){
	Dark_Press_Customizer::set(array(
		# Site Identity > title size || title or logo
		'section' => array(
			'id' => 'title_tagline',
			'prefix' => false,
		),
		'fields'  => array(
			array(
			    'id'          => 'site-info-font',
			    'label'       => esc_html__( 'Site Identity Font Family', 'dark-press' ),
			    'description' => esc_html__( 'Font family for site title and tagline. Defaults to Muli', 'dark-press' ),
			    'default'     => 'font-12',
			    'type'        => 'select',
			    'choices'     => Dark_Press_Theme::get_font_family(),
			),
		    array(
		        'id'	  	  => 'title-size',
		        'label'   	  => esc_html__( 'Title Size', 'dark-press' ),
		        'description' => esc_html__( 'The value is in px.' , 'dark-press' ),
		        'default' => array(
		    		'desktop' => 42,
		    		'tablet'  => 42,
		    		'mobile'  => 42,
		    	),
				'input_attrs' =>  array(
		            'min'   => 1,
		            'max'   => 60,
		            'step'  => 1,
		        ),
		        'type'    => 'dark-press-slider',
		    ),
	        array(
	            'id'	  	  => 'tagline-size',
	            'label'   	  => esc_html__( 'Tagline Size', 'dark-press' ),
	            'description' => esc_html__( 'The value is in px.' , 'dark-press' ),
	            'default' => array(
	        		'desktop' => 14,
	        		'tablet'  => 14,
	        		'mobile'  => 14,
	        	),
	    		'input_attrs' =>  array(
	                'min'   => 1,
	                'max'   => 35,
	                'step'  => 1,
	            ),
	            'type'    => 'dark-press-slider',
	        ),
            array(
    	        'id'	  	  => 'sp-logo-size',
    	        'label'   	  => esc_html__( 'Logo Size', 'dark-press' ),
    	        'description' => esc_html__( 'The value is in px.' , 'dark-press' ),
    	        'default' => array(
    	    		'desktop' => 200,
    	    		'tablet'  => 200,
    	    		'mobile'  => 200,
    	    	),
    			'input_attrs' =>  array(
    	            'min'   => 1,
    	            'max'   => 500,
    	            'step'  => 1,
    	        ),
    	        'type'    => 'dark-press-slider',
    	    ),
    	    array(
    	        'id'      => 'site-identity-position',
    	        'label'   => esc_html__( 'Site Identity Position', 'dark-press' ),
    	        'type'    => 'dark-press-buttonset',
    	        'default' => 'site-identity-left',
    	        'choices' => array(
    	            'site-identity-left' => esc_html__( 'Left', 'dark-press' ),
    	            'site-identity-center'  => esc_html__( 'Center', 'dark-press' ),
    	            'site-identity-right'  => esc_html__( 'Right', 'dark-press' )
    	        )
    	    ),
		)	
	));
}
add_action( 'init', 'dark_press_site_identity' );