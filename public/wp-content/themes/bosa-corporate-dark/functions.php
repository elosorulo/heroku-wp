<?php
/**
 * Theme functions and definitions
 *
 * @package Bosa Corporate Dark
 */

require get_stylesheet_directory() . '/inc/customizer/customizer.php';
require get_stylesheet_directory() . '/inc/customizer/loader.php';

if ( ! function_exists( 'bosa_corporate_dark_enqueue_styles' ) ) :
	/**
	 * @since Bosa Corporate Dark 1.0.0
	 */
	function bosa_corporate_dark_enqueue_styles() {
		wp_enqueue_style( 'bosa-corporate-dark-style-parent', get_template_directory_uri() . '/style.css',
			array(
				'bootstrap',
				'slick',
				'slicknav',
				'slick-theme',
				'fontawesome',
				'bosa-blocks',
				'bosa-google-font'
				)
		);
		wp_enqueue_style( 'bosa-corporate-dark-google-fonts', "https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap", false );
		wp_enqueue_style( 'bosa-corporate-dark-google-fonts-two', "https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap", false );
	}

endif;
add_action( 'wp_enqueue_scripts', 'bosa_corporate_dark_enqueue_styles', 1 );

if ( ! function_exists( 'bosa_corporate_dark_modify_locale' ) ) :
	/**
	 * Modifies the localized array
	 *
	 * @since Bosa Corporate Dark 1.0.3
	 * @return array
	 */
	function bosa_corporate_dark_modify_locale( $locale ) {

		if( isset( $locale['is_header_two'] ) ){
			$locale['is_header_two'] =  get_theme_mod( 'header_layout', 'header_two' ) == 'header_two' ? true : false;
		}
		return $locale;	
	}
	add_filter( 'bosa_localize_var', 'bosa_corporate_dark_modify_locale' );
endif;

if( !function_exists( 'bosa_transparent_body_class' ) ){
	/**
	* Add trasparent-header class in body
	*
	* @since Bosa Corporate Dark 1.0.6
	* @param array $class
	* @return array $class
	*/
	function bosa_transparent_body_class( $class ){
		if( get_theme_mod( 'header_layout', 'header_two' ) == 'header_two' ){
			if( ( !get_theme_mod( 'disable_transparent_header_page', true ) && is_page() ) || ( !get_theme_mod( 'disable_transparent_header_post', true ) && is_single() ) || is_front_page() ){
				$class[] = 'transparent-header';
			}
		}
		return $class;
	}
	add_filter( 'body_class', 'bosa_transparent_body_class' );
}

add_theme_support( "title-tag" );
add_theme_support( 'automatic-feed-links' );