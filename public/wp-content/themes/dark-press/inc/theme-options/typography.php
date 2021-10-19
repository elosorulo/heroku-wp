<?php
/**
* Register typography Options
*
* @return void
* @since 1.0.0
*
* @package Dark Press WordPress Theme
*/
function dark_press_typography_options(){ 

    $message = esc_html__( 'The value is in px.', 'dark-press' );
    Dark_Press_Customizer::set(array(
        # Theme option
        'panel' => array(
            'id'       => 'panel',
            'title'    => esc_html__( 'Dark Press Options', 'dark-press' ),
            'priority' => 10,
        ),
        # Theme Option > Header
        'section' => array(
            'id'    => 'typography',
            'title' => esc_html__( 'Typography','dark-press' ),
            'priority' => 50
        ),
        # Theme Option > Header > settings
        'fields' => array(
            array(
                'id'      => 'body-font',
                'label'   =>  esc_html__( 'Body Font Family.', 'dark-press' ),
                'default' => 'font-4',
                'type'    => 'select',
                'choices' => Dark_Press_Theme::get_font_family(),
            ),
            array(
                'id'          => 'heading-font',
                'label'       =>  esc_html__( 'Headings Font Family.', 'dark-press' ),
                'default'     => 'font-6',
                'type'        => 'select',
                'choices'     => Dark_Press_Theme::get_font_family(),
            ),
            array(
                'id'          => 'body-font-size',
                'label'       => esc_html__( 'Body Font Size.', 'dark-press' ),
                'description' => $message . ' ' . esc_html__( 'Defaults to 15px.', 'dark-press' ),
                'type'        => 'dark-press-slider',
                'default' => array(
                    'desktop' => 14,
                    'tablet'  => 14,
                    'mobile'  => 14,
                ),
                'input_attrs' =>  array(
                    'min'   => 1,
                    'max'   => 40,
                    'step'  => 1,
                ),
            ),
            array(
                'id'          => 'post-title-size',
                'label'       => esc_html__( 'Post Title Font Size', 'dark-press' ),
                'description' => $message . ' ' . esc_html__( 'Defaults to 21px.' , 'dark-press' ),
                'default' => array(
                    'desktop' => 18,
                    'tablet'  => 18,
                    'mobile'  => 18,
                ),
                'input_attrs' =>  array(
                    'min'   => 1,
                    'max'   => 60,
                    'step'  => 1,
                ),
                'type' => 'dark-press-slider',
            ),
            array(
                'id'          => 'widget-title-font-size',
                'label'       => esc_html__( 'Widget Title Font Size', 'dark-press' ),
                'description' => $message . ' ' . esc_html( 'Defaults to 18px.', 'dark-press' ),
                'type'        => 'dark-press-slider',
                'default' => array(
                    'desktop' => 28,
                    'tablet'  => 28,
                    'mobile'  => 28,
                ),
                'input_attrs' =>  array(
                    'min'   => 1,
                    'max'   => 60,
                    'step'  => 1,
                ),
            ),
            array(
                'id'          => 'widget-content-font-size',
                'label'       => esc_html__( 'Widget Content Font Size', 'dark-press' ),
                'description' => $message . ' ' . esc_html( 'Defaults to 16px.', 'dark-press' ),
                'type'        => 'dark-press-slider',
                'default' => array(
                    'desktop' => 14,
                    'tablet'  => 14,
                    'mobile'  => 14,
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
add_action( 'init', 'dark_press_typography_options' );