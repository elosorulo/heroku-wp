<?php
if( !function_exists( 'dark_press_acb_pagination' ) ):
    /**
    * Active callback function of top stories post
    *
    * @static
    * @access public
    * @return boolen
    * @since 1.0.0
    *
    * @package Dark Press WordPress Theme
    */
    function dark_press_acb_pagination( $control ){
        $value = $control->manager->get_setting( Dark_Press_Helper::with_prefix( 'pagination-option' ) )->value();
        return 'custom' == $value ? true : false;
    }
endif;

/**
 * Create options for posts.
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */
function dark_press_post_options(){  
    Dark_Press_Customizer::set(array(
    	# Theme Options
    	'panel'   => 'panel',
    	# Theme Options > Page Options > Settings
    	'section' => array(
    		'id'    => 'post-options',
    		'title' => esc_html__( 'Post Options','dark-press' ),
            'priority' => 90
    	),
    	'fields' => array(
            array(
                'id'      => 'post-category',
                'label'   =>  esc_html__( 'Show Categories', 'dark-press' ),
                'default' => 1,
                'type'    => 'dark-press-toggle',
            ),
            array(
                'id'      => 'post-date',
                'label'   => esc_html__( 'Show Date', 'dark-press' ),
                'default' => 1,
                'type'    => 'dark-press-toggle',
            ),
            array(
                'id'      => 'post-author',
                'label'   =>  esc_html__( 'Show Author', 'dark-press' ),
                'default' => 1,
                'type'    => 'dark-press-toggle',
            ),
            array(
                'id'      => 'post-comments',
                'label'   =>  esc_html__( 'Show Comments', 'dark-press' ),
                'default' => 1,
                'type'    => 'dark-press-toggle',
            ),
            array(
                'id'      => 'post-readmore',
                'label'   =>  esc_html__( 'Show Read More Button', 'dark-press' ),
                'default' => 1,
                'type'    => 'dark-press-toggle',
            ),
            array(
                'id'      => 'excerpt_length',
                'label'   => esc_html__( 'Excerpt Length', 'dark-press' ),
                'description' => esc_html__( 'Defaults to 20. The respective section has there own excerpt length.', 'dark-press' ),
                'type'    => 'number',
                'default' => 20
            ),
            array(
                'id'      => 'pagination-option',
                'label'   => esc_html__( 'Pagination Display', 'dark-press' ),
                'type'    => 'dark-press-buttonset',
                'default' => 'custom',
                'choices' => array(
                    'default' => esc_html__( 'Default', 'dark-press' ),
                    'custom'  => esc_html__( 'Load More', 'dark-press' ),
                )
            ),
            array(
                'id'      => 'pagination-text',
                'label'   => esc_html__( 'Pagination Text', 'dark-press' ),
                'default' => esc_html__( 'View More', 'dark-press' ),
                'type'    => 'text',
                'active_callback' => array( 'fn_name' => 'dark_press_acb_pagination' )
            ),
            array(
                'id' => 'post-per-row',
                'label' => esc_html__( 'Post Per Row', 'dark-press' ),
                'type' => 'dark-press-buttonset',
                'default' => '1',
                'choices' => array(
                    '1' => esc_html__( '1', 'dark-press' ),
                    '2' => esc_html__( '2', 'dark-press' ),
                    '3' => esc_html__( '3', 'dark-press' ),
                    '4' => esc_html__( '4', 'dark-press' )
                )
            ),
            array(
                'id'      => 'read-more-text',
                'label'   => esc_html__( 'Read More Text', 'dark-press' ),
                'default' => esc_html__( 'Read More', 'dark-press' ),
                'type'    => 'text'
            )
     	),
    ) );
}
add_action( 'init', 'dark_press_post_options' );