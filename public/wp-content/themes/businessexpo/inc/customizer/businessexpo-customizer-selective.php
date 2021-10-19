<?php
/**
 * Override default customizer options.
 *
 * @package businessexpo
 */

// Settings.
$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

if ( isset( $wp_customize->selective_refresh ) ) {
	
	
	// site title
	$wp_customize->selective_refresh->add_partial('blogname',array(
		'selector'        => '.site-branding-text .site-title',
		'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_customize_partial_blogname' ),
	));

    // site tagline
	$wp_customize->selective_refresh->add_partial('blogdescription',array(
		'selector'        => '.site-branding-text .site-description',
		'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_customize_partial_blogdescription' ),
	));
	
	// main slider
	$wp_customize->selective_refresh->add_partial(
		'businessexpo_main_slider_content',array(
		'selector'	=> '.theme-main-slider .theme-slider-content',)
	);
	
	/** 
	 *  Topbar 
	**/
	
		// Phone Text
		$wp_customize->selective_refresh->add_partial('businessexpo_tbar_phone_text',array(
			'selector'        => '.header-top .header-contact-info .info-phone',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_topbar_text_render_callback' ),
		));
	
		// Email Text
		$wp_customize->selective_refresh->add_partial('businessexpo_tbar_email_text',array(
			'selector'        => '.header-top .header-contact-info .info-email',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_topbar_num_render_callback' ),
		));			
		
		// Button Text
		$wp_customize->selective_refresh->add_partial('businessexpo_tbar_btn_text',array(
			'selector'        => '.header-top .buy-button',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_topbar_num_render_callback' ),
		));	

	/** 
	 *  Menu Settings
	**/

		// Menubar
		$wp_customize->selective_refresh->add_partial('businessexpo_menu_overlap',array(
			'selector'        => '.site-header .site-menu-content .navigation-wrap .main-navigation .primary-menu-container .menu',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_topbar_num_render_callback' ),
		));
		
	/** 
	 *  Slider 
	**/	

		// Feature Text 1
		$wp_customize->selective_refresh->add_partial('businessexpo_slider_feature_text1',array(
			'selector'	=> '.main-slider .features-section .fi_1',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text1_render_callback' ),
		));		
		
		// Feature Text 2
		$wp_customize->selective_refresh->add_partial('businessexpo_slider_feature_text2',array(
			'selector'	=> '.main-slider .features-section .fi_2',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text2_render_callback' ),
		));
		
		// Feature Text 3
		$wp_customize->selective_refresh->add_partial('businessexpo_slider_feature_text3',array(
			'selector'	=> '.main-slider .features-section .fi_3',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text3_render_callback' ),
		));

	/** 
	 *  Service 
	**/	

		// Title 
		$wp_customize->selective_refresh->add_partial('businessexpo_service_section_title',array(
			'selector'	=> '.service .section-header h1',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text1_render_callback' ),
		));		
		
		// Subtitle
		$wp_customize->selective_refresh->add_partial('businessexpo_service_section_subtitle',array(
			'selector'	=> '.service .section-header p',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text2_render_callback' ),
		));

	/** 
	 *  WooCommerce 
	**/	

		// Title 
		$wp_customize->selective_refresh->add_partial('businessexpo_woocommerce_area_title',array(
			'selector'	=> '.shop .section-header h1',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text1_render_callback' ),
		));		
		
		// Subtitle
		$wp_customize->selective_refresh->add_partial('businessexpo_woocommerce_area_desc',array(
			'selector'	=> '.shop .section-header p',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text2_render_callback' ),
		));	
		
	/** 
	 *  Testimonials 
	**/	

		// Title 
		$wp_customize->selective_refresh->add_partial('businessexpo_testimonial_section_title',array(
			'selector'	=> '.testimonial .section-header h1',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text1_render_callback' ),
		));		
		
		// Subtitle
		$wp_customize->selective_refresh->add_partial('businessexpo_testimonial_section_subtitle',array(
			'selector'	=> '.testimonial .section-header p',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text2_render_callback' ),
		));	
		
	/** 
	 *  Blog 
	**/	

		// Title 
		$wp_customize->selective_refresh->add_partial('businessexpo_blog_section_title',array(
			'selector'	=> '.home-blog .section-header h1',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text1_render_callback' ),
		));		
		
		// Subtitle
		$wp_customize->selective_refresh->add_partial('businessexpo_blog_section_subtitle',array(
			'selector'	=> '.home-blog .section-header p',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text2_render_callback' ),
		));

	/** 
	 *  Callout 
	**/	

		// Title 
		$wp_customize->selective_refresh->add_partial('businessexpo_cta_section_title',array(
			'selector'	=> '.callout .section-header h1',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text1_render_callback' ),
		));		
		
		// Subtitle
		$wp_customize->selective_refresh->add_partial('businessexpo_cta_section_subtitle',array(
			'selector'	=> '.callout .section-header p',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text2_render_callback' ),
		));			
		
		// Button
		$wp_customize->selective_refresh->add_partial('businessexpo_cta_button_text',array(
			'selector'	=> '.callout a',
			//'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_slider_feature_text2_render_callback' ),
		));		

	/** 
	 *  Footer Settings 
	**/
	
		// footer copyright text
		$wp_customize->selective_refresh->add_partial('businessexpo_footer_copyright_text',array(
			'selector'        => '.footer-copyrights .site-info',
			'render_callback' => array( 'businessexpo_Customizer_Partials', 'businessexpo_footer_copyright_text_render_callback' ),
		));
}