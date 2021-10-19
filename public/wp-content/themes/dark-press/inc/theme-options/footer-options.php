<?php
if( !function_exists( 'dark_press_acb_footer' ) ):
    /**
    * Active callback function of footer
    *
    * @static
    * @access public
    * @return boolen
    * @since 1.0.0
    *
    * @package Dark Press WordPress Theme
    */
    function dark_press_acb_footer( $control ){
        $value = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'enable-footer' ) )->value();
        return $value;
    }
endif;
/**
 * Creates option for footer
 *
 * Register footer Options
 *
 * @return void
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

function dark_press_footer_options(){
	Dark_Press_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > Footer Options
		'section' => array(
		    'id'    => 'footer',
		    'title' => esc_html__( 'Footer Options','dark-press' ),
		    'priority' => 130
		),
		# Theme Option > Header > settings
		'fields' => array(
			array(
				'id'      => 'footer-bg-image',
				'label'   => esc_html__( 'Background Image', 'dark-press' ),
				'type'    => 'image',
			),
			array(
				'id'      => 'enable-footer',
				'label'   => esc_html__( 'Enable Footer', 'dark-press' ),
				'default' => true,
				'description' => esc_html__( 'If this option is disabled, footer will disabled on entire site. Or you can enable this and manage via pages setting for respective page', 'dark-press' ),
				'type'    => 'dark-press-toggle'
			),
			array(
			    'id'      	  => 'layout-footer',
			    'label'   	  => esc_html__( 'Footer Layout', 'dark-press' ),
			    'description' => esc_html__( 'Add widget to display in footer. If you have not added widget, then default widget may display.', 'dark-press' ),
			    'type'    	  => 'dark-press-radio-image',
			    'active_callback' => array( 'fn_name' => 'dark_press_acb_footer' ),
			    'default' 	  => '4',
			    'choices' 	  => array(
			        '1' => array(
			            'label' => esc_html__( 'One widget', 'dark-press' ),
						'url'   => Dark_Press_Helper::get_theme_uri( '/classes/customizer/assets/images/footer-1.png' ),
						'svg'   => '<svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D5DADF" viewBox="0 0 100 50"><path d="M100,0V50H0V0Z"></path></svg>'
			        ),
			        '2' => array(
			            'label' => esc_html__( 'Two widget', 'dark-press' ),
						'url'   => Dark_Press_Helper::get_theme_uri( '/classes/customizer/assets/images/footer-2.png' ),
						'svg'   => '<svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D5DADF" viewBox="0 0 100 50"><path d="M49,0V50H0V0Z M100,0V50H51V0Z"></path></svg>'
			        ),
			        '3' => array(
			            'label' => esc_html__( 'Thee widget', 'dark-press' ),
						'url'   => Dark_Press_Helper::get_theme_uri( '/classes/customizer/assets/images/footer-3.png' ),
						'svg'   => '<svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D5DADF" viewBox="0 0 100 50"><path d="M32,0V50H0V0Z M66,0V50H34V0Z M100,0V50H68V0Z"></path></svg>'
			        ),
			        '4' => array(
			            'label' => esc_html__( 'Four widget', 'dark-press' ),
						'url'   => Dark_Press_Helper::get_theme_uri( '/classes/customizer/assets/images/footer-4.png' ),
						'svg'   => '<svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#D5DADF" viewBox="0 0 100 50"><path d="M23.5,0V50H0V0Z M49,0V50H25.5V0Z M74.5,0V50H51V0Z M100,0V50H76.5V0Z"></path></svg>'
			        ) 
			    )
			),
			array(
				'id'      => 'footer-social-menu',
				'label'   => esc_html__( 'Show Social Menu', 'dark-press' ),
				'description' => esc_html__( 'Please add Social menus for enabling Social menus. Go to Menus for setting up', 'dark-press' ),
				'default' => true,
				'type'    => 'dark-press-toggle',
			),
			array(
				'id'   => 'line-4',
				'type' => 'dark-press-hz-line',
			),
			array(
				'id'      => 'footer-top-background-color',
				'label'   => esc_html__( 'Footer Background Color', 'dark-press' ),
				'default' => '#000',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'footer-copyright-background-color',
				'label'   => esc_html__( 'Footer Copyright Background Color', 'dark-press' ),
				'default' => '#090818',
				'type'    => 'dark-press-color-picker',
			),
			array(
				'id'      => 'footer-copyright-text-color',
				'label'   => esc_html__( 'Footer Copyright Text Color', 'dark-press' ),
				'default' => '#ffffff',
				'type'    => 'dark-press-color-picker',
			),
		)
	));
}
# use widgets_init hook as we need default value of layout-footer while registering sidebar.
# init hook is too late
add_action( 'widgets_init', 'dark_press_footer_options' );