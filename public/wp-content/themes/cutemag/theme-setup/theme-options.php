<?php
/**
* CuteMag Theme Customizer.
*
* @package CuteMag WordPress Theme
* @copyright Copyright (C) 2021 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

if ( ! class_exists( 'WP_Customize_Control' ) ) {return NULL;}

class CuteMag_Customize_Static_Text_Control extends WP_Customize_Control {
    public $type = 'cutemag-static-text';

    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
    }

    protected function render_content() {
        if ( ! empty( $this->label ) ) :
            ?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
        endif;

        if ( ! empty( $this->description ) ) :
            ?><div class="description customize-control-description"><?php

        echo wp_kses_post( $this->description );

            ?></div><?php
        endif;

    }
}

class CuteMag_Customize_Button_Control extends WP_Customize_Control {
        public $type = 'cutemag-button';
        protected $button_tag = 'button';
        protected $button_class = 'button button-primary';
        protected $button_href = 'javascript:void(0)';
        protected $button_target = '';
        protected $button_onclick = '';
        protected $button_tag_id = '';

        public function render_content() {
        ?>
        <span class="center">
        <?php
        echo '<' . esc_html($this->button_tag);
        if (!empty($this->button_class)) {
            echo ' class="' . esc_attr($this->button_class) . '"';
        }
        if ('button' == $this->button_tag) {
            echo ' type="button"';
        }
        else {
            echo ' href="' . esc_url($this->button_href) . '"' . (empty($this->button_tag) ? '' : ' target="' . esc_attr($this->button_target) . '"');
        }
        if (!empty($this->button_onclick)) {
            echo ' onclick="' . esc_js($this->button_onclick) . '"';
        }
        if (!empty($this->button_tag_id)) {
            echo ' id="' . esc_attr($this->button_tag_id) . '"';
        }
        echo '>';
        echo esc_html($this->label);
        echo '</' . esc_html($this->button_tag) . '>';
        ?>
        </span>
        <?php
        }
}

class CuteMag_Customize_Submit_Control extends WP_Customize_Control {
        public $type = 'cutemag-submit-button';
        protected $button_class = '';
        protected $button_id = '';
        protected $button_value = '';
        protected $button_onclick = '';

        public function render_content() {
        ?>
        <form action="customize.php" method="get">
        <label>
        <span style="font-weight:normal;margin-bottom:10px;" class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php
        echo '<input type="submit"';
        if (!empty($this->button_class)) {
            echo ' class="' . esc_attr($this->button_class) . '"';
        }
        if (!empty($this->button_id)) {
            echo ' name="' . esc_attr($this->button_id) . '"';
        }
        if (!empty($this->button_id)) {
            echo ' id="' . esc_attr($this->button_id) . '"';
        }
        if (!empty($this->button_value)) {
            echo ' value="' . esc_attr($this->button_value) . '"';
        }
        if (!empty($this->button_onclick)) {
            echo ' onclick="return confirm(\'' . esc_js($this->button_onclick) . '\');"';
        }
        echo '/>';
        ?>
        </label>
        </form>
        <?php
        }
}

/**
* Sanitize callback functions
*/

function cutemag_sanitize_checkbox( $input ) {
    return ( ( isset( $input ) && ( true == $input ) ) ? true : false );
}

function cutemag_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function cutemag_sanitize_thumbnail_link( $input, $setting ) {
    $valid = array('yes','no');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function cutemag_sanitize_post_style( $input, $setting ) {
    $valid = array('compactview','fullview');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function cutemag_sanitize_posts_navigation_type( $input, $setting ) {
    $valid = array('normalnavi','numberednavi');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function cutemag_sanitize_email( $input, $setting ) {
    if ( '' != $input && is_email( $input ) ) {
        $input = sanitize_email( $input );
        return $input;
    } else {
        return $setting->default;
    }
}

function cutemag_sanitize_logo_location( $input, $setting ) {
    $valid = array('beside-title','above-title');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function cutemag_sanitize_social_buttons_location( $input, $setting ) {
    $valid = array('primary-menu','secondary-menu');
    if ( in_array( $input, $valid ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function cutemag_sanitize_read_more_length( $input, $setting ) {
    $input = absint( $input ); // Force the value into non-negative integer.
    return ( 0 < $input ) ? $input : $setting->default;
}

function cutemag_sanitize_positive_integer( $input, $setting ) {
    $input = absint( $input ); // Force the value into non-negative integer.
    return ( 0 < $input ) ? $input : $setting->default;
}

function cutemag_sanitize_positive_float( $input, $setting ) {
    $input = (float) $input;
    return ( 0 < $input ) ? $input : $setting->default;
}

function cutemag_sanitize_posts_id_list( $input, $setting ) {
    $posts_id_list_regex = '/^\d+(?:,\d+)*$/';
    if(isset($input)) {
        $input = ( preg_match($posts_id_list_regex, $input) ) ? sanitize_text_field( $input ) : $setting->default;
    } else {
        $input = $setting->default;
    }
    return $input;
}

function cutemag_register_theme_customizer( $wp_customize ) {

    if(method_exists('WP_Customize_Manager', 'add_panel')):
    $wp_customize->add_panel('cutemag_main_options_panel', array( 'title' => esc_html__('Theme Options', 'cutemag'), 'priority' => 10, ));
    endif;
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'cutemag_main_options_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = 20;
    $wp_customize->get_section( 'header_image' )->panel = 'cutemag_main_options_panel';
    $wp_customize->get_section( 'header_image' )->priority = 26;
    $wp_customize->get_section( 'background_image' )->panel = 'cutemag_main_options_panel';
    $wp_customize->get_section( 'background_image' )->priority = 27;
    $wp_customize->get_section( 'colors' )->panel = 'cutemag_main_options_panel';
    $wp_customize->get_section( 'colors' )->priority = 40;
      
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
    $wp_customize->get_control( 'background_color' )->description = esc_html__('To change Background Color, need to remove background image first:- go to Appearance : Customize : Theme Options : Background Image', 'cutemag');

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.cutemag-site-title a',
            'render_callback' => 'cutemag_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.cutemag-site-description',
            'render_callback' => 'cutemag_customize_partial_blogdescription',
        ) );
    }

    /* Getting started options */
    $wp_customize->add_section( 'cutemag_section_getting_started', array( 'title' => esc_html__( 'Getting Started', 'cutemag' ), 'description' => esc_html__( 'Thanks for your interest in CuteMag! If you have any questions or run into any trouble, please visit us the following links. We will get you fixed up!', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 5, ) );

    $wp_customize->add_setting( 'cutemag_options[documentation]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new CuteMag_Customize_Button_Control( $wp_customize, 'cutemag_documentation_control', array( 'label' => esc_html__( 'Documentation', 'cutemag' ), 'section' => 'cutemag_section_getting_started', 'settings' => 'cutemag_options[documentation]', 'type' => 'button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => esc_url( 'https://themesdna.com/cutemag-wordpress-theme/' ), 'button_target' => '_blank', ) ) );

    $wp_customize->add_setting( 'cutemag_options[contact]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );

    $wp_customize->add_control( new CuteMag_Customize_Button_Control( $wp_customize, 'cutemag_contact_control', array( 'label' => esc_html__( 'Contact Us', 'cutemag' ), 'section' => 'cutemag_section_getting_started', 'settings' => 'cutemag_options[contact]', 'type' => 'button', 'button_tag' => 'a', 'button_class' => 'button button-primary', 'button_href' => esc_url( 'https://themesdna.com/contact/' ), 'button_target' => '_blank', ) ) );


    /* Menu options */
    $wp_customize->add_section( 'cutemag_section_menu_options', array( 'title' => esc_html__( 'Menu Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 100 ) );

    $wp_customize->add_setting( 'cutemag_options[primary_menu_text]', array( 'default' => esc_html__( 'Menu', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'cutemag_primary_menu_text_control', array( 'label' => esc_html__( 'Primary Menu Mobile Text', 'cutemag' ), 'section' => 'cutemag_section_menu_options', 'settings' => 'cutemag_options[primary_menu_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'cutemag_options[disable_primary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_disable_primary_menu_control', array( 'label' => esc_html__( 'Disable Primary Menu', 'cutemag' ), 'section' => 'cutemag_section_menu_options', 'settings' => 'cutemag_options[disable_primary_menu]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[secondary_menu_text]', array( 'default' => esc_html__( 'Menu', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'cutemag_secondary_menu_text_control', array( 'label' => esc_html__( 'Secondary Menu Mobile Text', 'cutemag' ), 'section' => 'cutemag_section_menu_options', 'settings' => 'cutemag_options[secondary_menu_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'cutemag_options[disable_secondary_menu]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_disable_secondary_menu_control', array( 'label' => esc_html__( 'Disable Secondary Menu', 'cutemag' ), 'section' => 'cutemag_section_menu_options', 'settings' => 'cutemag_options[disable_secondary_menu]', 'type' => 'checkbox', ) );


    /* Header options */
    $wp_customize->add_section( 'cutemag_section_header', array( 'title' => esc_html__( 'Header Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 120 ) );

    $wp_customize->add_setting( 'cutemag_options[hide_tagline]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_tagline_control', array( 'label' => esc_html__( 'Hide Tagline', 'cutemag' ), 'section' => 'cutemag_section_header', 'settings' => 'cutemag_options[hide_tagline]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_header_content]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_header_content_control', array( 'label' => esc_html__( 'Hide Header Content', 'cutemag' ), 'section' => 'cutemag_section_header', 'settings' => 'cutemag_options[hide_header_content]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[logo_location]', array( 'default' => 'above-title', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_logo_location' ) );

    $wp_customize->add_control( 'cutemag_logo_location_control', array( 'label' => esc_html__( 'Logo Location', 'cutemag' ), 'description' => esc_html__('Select how you want to display the site logo with site title and tagline.', 'cutemag'), 'section' => 'title_tagline', 'settings' => 'cutemag_options[logo_location]', 'type' => 'select', 'choices' => array( 'beside-title' => esc_html__( 'Before Site Title and Tagline', 'cutemag' ), 'above-title' => esc_html__( 'Above Site Title and Tagline', 'cutemag' ) ), 'priority'   => 8 ) );

    $wp_customize->add_setting( 'cutemag_options[hide_header_image]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_header_image_control', array( 'label' => esc_html__( 'Hide Header Image from Everywhere', 'cutemag' ), 'section' => 'header_image', 'settings' => 'cutemag_options[hide_header_image]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[remove_header_image_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_remove_header_image_link_control', array( 'label' => esc_html__( 'Remove Link from Header Image', 'cutemag' ), 'section' => 'header_image', 'settings' => 'cutemag_options[remove_header_image_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_header_image_details]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_header_image_details_control', array( 'label' => esc_html__( 'Hide both Title and Description from Header Image', 'cutemag' ), 'section' => 'header_image', 'settings' => 'cutemag_options[hide_header_image_details]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_header_image_description]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_header_image_description_control', array( 'label' => esc_html__( 'Hide Description from Header Image', 'cutemag' ), 'section' => 'header_image', 'settings' => 'cutemag_options[hide_header_image_description]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[header_image_custom_text]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_header_image_custom_text_control', array( 'label' => esc_html__( 'Add Custom Title/Custom Description to Header Image', 'cutemag' ), 'section' => 'header_image', 'settings' => 'cutemag_options[header_image_custom_text]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[header_image_custom_title]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_header_image_custom_title_control', array( 'label' => esc_html__( 'Header Image Custom Title', 'cutemag' ), 'section' => 'header_image', 'settings' => 'cutemag_options[header_image_custom_title]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'cutemag_options[header_image_custom_description]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_header_image_custom_description_control', array( 'label' => esc_html__( 'Header Image Custom Description', 'cutemag' ), 'section' => 'header_image', 'settings' => 'cutemag_options[header_image_custom_description]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'cutemag_options[header_image_destination]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_header_image_destination_control', array( 'label' => esc_html__( 'Header Image Destination URL', 'cutemag' ), 'description' => esc_html__( 'Enter the URL a visitor should go when he/she click on the header image. If you did not enter a URL below, header image will be linked to the homepage of your website.', 'cutemag' ), 'section' => 'header_image', 'settings' => 'cutemag_options[header_image_destination]', 'type' => 'text' ) );


    /* Post Summaries options */
    $wp_customize->add_section( 'cutemag_section_posts_summaries', array( 'title' => esc_html__( 'Post Summaries Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 175 ) );

    $wp_customize->add_setting( 'cutemag_options[hide_posts_heading]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_posts_heading_control', array( 'label' => esc_html__( 'Hide HomePage Posts Heading', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_posts_heading]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[posts_heading]', array( 'default' => esc_html__( 'Recent Posts', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'cutemag_posts_heading_control', array( 'label' => esc_html__( 'HomePage Posts Heading', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[posts_heading]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'cutemag_options[post_style]', array( 'default' => 'compactview', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_post_style' ) );

    $wp_customize->add_control( 'cutemag_post_style_control', array( 'label' => esc_html__( 'Posts Style', 'cutemag' ), 'description' => esc_html__('Select the post style you want for home/categories/tags/archive/search-results pages.', 'cutemag'), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[post_style]', 'type' => 'select', 'choices' => array( 'compactview' => esc_html__('Compact', 'cutemag'), 'fullview' => esc_html__('Full', 'cutemag') ) ) );

    $wp_customize->add_setting( 'cutemag_options[read_more_length]', array( 'default' => 20, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_read_more_length' ) );

    $wp_customize->add_control( 'cutemag_read_more_length_control', array( 'label' => esc_html__( 'Auto Post Summary Length', 'cutemag' ), 'description' => esc_html__('Enter the number of words need to display in the post summary. Default is 20 words.', 'cutemag'), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[read_more_length]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[show_read_more_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_show_read_more_button_control', array( 'label' => esc_html__( 'Show Read More Buttons on Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[show_read_more_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[read_more_text]', array( 'default' => esc_html__( 'Continue Reading', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field', ) );

    $wp_customize->add_control( 'cutemag_read_more_text_control', array( 'label' => esc_html__( 'Read More Text', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[read_more_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_thumbnail_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_thumbnail_home_control', array( 'label' => esc_html__( 'Hide Featured Images from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_thumbnail_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_default_thumbnail_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_default_thumbnail_home_control', array( 'label' => esc_html__( 'Hide Default Images from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_default_thumbnail_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_title_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_title_home_control', array( 'label' => esc_html__( 'Hide Post Titles from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_post_title_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_author_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_author_home_control', array( 'label' => esc_html__( 'Hide Post Authors from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_post_author_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_posted_date_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_posted_date_home_control', array( 'label' => esc_html__( 'Hide Posted Dates from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_posted_date_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_comments_link_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_comments_link_home_control', array( 'label' => esc_html__( 'Hide Comment Links from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_comments_link_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_categories_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_categories_home_control', array( 'label' => esc_html__( 'Hide Post Categories from Posts Summaries', 'cutemag' ), 'description' => esc_html__('This option is only for this post style : Full', 'cutemag'), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_post_categories_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_tags_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_tags_home_control', array( 'label' => esc_html__( 'Hide Post Tags from Posts Summaries', 'cutemag' ), 'description' => esc_html__('This option is only for this post style : Full', 'cutemag'), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_post_tags_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_snippet]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_snippet_control', array( 'label' => esc_html__( 'Hide Post Snippets from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[hide_post_snippet]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[display_full_post_content]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_display_full_post_content_control', array( 'label' => esc_html__( 'Display Full Post Content with Fullview Posts Style', 'cutemag' ), 'section' => 'cutemag_section_posts_summaries', 'settings' => 'cutemag_options[display_full_post_content]', 'type' => 'checkbox', ) );


    /* Singular Post options */
    $wp_customize->add_section( 'cutemag_section_posts', array( 'title' => esc_html__( 'Singular Post Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 180 ) );

    $wp_customize->add_setting( 'cutemag_options[thumbnail_link]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_thumbnail_link' ) );

    $wp_customize->add_control( 'cutemag_thumbnail_link_control', array( 'label' => esc_html__( 'Featured Image Link', 'cutemag' ), 'description' => esc_html__('Do you want single post thumbnail to be linked to their post?', 'cutemag'), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[thumbnail_link]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'cutemag'), 'no' => esc_html__('No', 'cutemag') ) ) );

    $wp_customize->add_setting( 'cutemag_options[hide_thumbnail_single]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_thumbnail_single_control', array( 'label' => esc_html__( 'Hide Featured Image from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_thumbnail_single]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_title_control', array( 'label' => esc_html__( 'Hide Post Header from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_post_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[remove_post_title_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_remove_post_title_link_control', array( 'label' => esc_html__( 'Remove Link from Single Post Titles', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[remove_post_title_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_posted_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_posted_date_control', array( 'label' => esc_html__( 'Hide Posted Date from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_posted_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_author_control', array( 'label' => esc_html__( 'Hide Post Author from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_post_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_categories]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_categories_control', array( 'label' => esc_html__( 'Hide Post Categories from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_post_categories]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_tags]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_tags_control', array( 'label' => esc_html__( 'Hide Post Tags from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_post_tags]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_comments_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_comments_link_control', array( 'label' => esc_html__( 'Hide Comment Link from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_comments_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_comment_form]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_comment_form_control', array( 'label' => esc_html__( 'Hide Comments/Comment Form from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_comment_form]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_edit]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_edit_control', array( 'label' => esc_html__( 'Hide Post Edit Link from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_post_edit]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_author_bio_box]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_author_bio_box_control', array( 'label' => esc_html__( 'Hide Author Bio Box from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_posts', 'settings' => 'cutemag_options[hide_author_bio_box]', 'type' => 'checkbox', ) );


    /* Navigation options */
    $wp_customize->add_section( 'cutemag_section_navigation', array( 'title' => esc_html__( 'Post/Posts Navigation Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 185 ) );

    $wp_customize->add_setting( 'cutemag_options[hide_post_navigation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_post_navigation_control', array( 'label' => esc_html__( 'Hide Post Navigation from Single Posts', 'cutemag' ), 'section' => 'cutemag_section_navigation', 'settings' => 'cutemag_options[hide_post_navigation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_posts_navigation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_posts_navigation_control', array( 'label' => esc_html__( 'Hide Posts Navigation from Home/Archive/Search Pages', 'cutemag' ), 'section' => 'cutemag_section_navigation', 'settings' => 'cutemag_options[hide_posts_navigation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[posts_navigation_type]', array( 'default' => 'numberednavi', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_posts_navigation_type' ) );

    $wp_customize->add_control( 'cutemag_posts_navigation_type_control', array( 'label' => esc_html__( 'Posts Navigation Type', 'cutemag' ), 'description' => esc_html__('Select posts navigation type you need. If you activate WP-PageNavi plugin, this navigation will be replaced by WP-PageNavi navigation.', 'cutemag'), 'section' => 'cutemag_section_navigation', 'settings' => 'cutemag_options[posts_navigation_type]', 'type' => 'select', 'choices' => array( 'normalnavi' => esc_html__('Link Navigation', 'cutemag'), 'numberednavi' => esc_html__('Numbered Navigation', 'cutemag') ) ) );


    /* Page options */
    $wp_customize->add_section( 'cutemag_section_page', array( 'title' => esc_html__( 'Page Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 190 ) );

    $wp_customize->add_setting( 'cutemag_options[thumbnail_link_page]', array( 'default' => 'yes', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_thumbnail_link' ) );

    $wp_customize->add_control( 'cutemag_thumbnail_link_page_control', array( 'label' => esc_html__( 'Featured Image Link', 'cutemag' ), 'description' => esc_html__('Do you want the featured image in a page to be linked to its page?', 'cutemag'), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[thumbnail_link_page]', 'type' => 'select', 'choices' => array( 'yes' => esc_html__('Yes', 'cutemag'), 'no' => esc_html__('No', 'cutemag') ) ) );

    $wp_customize->add_setting( 'cutemag_options[hide_thumbnail_page]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_thumbnail_page_control', array( 'label' => esc_html__( 'Hide Featured Image from Single Pages', 'cutemag' ), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[hide_thumbnail_page]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_page_title]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_page_title_control', array( 'label' => esc_html__( 'Hide Page Header from Single Pages', 'cutemag' ), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[hide_page_title]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[remove_page_title_link]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_remove_page_title_link_control', array( 'label' => esc_html__( 'Remove Link from Single Page Titles', 'cutemag' ), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[remove_page_title_link]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_page_date]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_page_date_control', array( 'label' => esc_html__( 'Hide Posted Date from Single Pages', 'cutemag' ), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[hide_page_date]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_page_author]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_page_author_control', array( 'label' => esc_html__( 'Hide Page Author from Single Pages', 'cutemag' ), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[hide_page_author]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_page_comments]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_page_comments_control', array( 'label' => esc_html__( 'Hide Comment Link from Single Pages', 'cutemag' ), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[hide_page_comments]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_page_comment_form]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_page_comment_form_control', array( 'label' => esc_html__( 'Hide Comments/Comment Form from Single Pages', 'cutemag' ), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[hide_page_comment_form]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_page_edit]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_page_edit_control', array( 'label' => esc_html__( 'Hide Edit Link from Single Pages', 'cutemag' ), 'section' => 'cutemag_section_page', 'settings' => 'cutemag_options[hide_page_edit]', 'type' => 'checkbox', ) );


    /* Social profiles options */
    $wp_customize->add_section( 'cutemag_section_social', array( 'title' => esc_html__( 'Social Links Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 240, ));

    $wp_customize->add_setting( 'cutemag_options[social_buttons_location]', array( 'default' => 'secondary-menu', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_social_buttons_location' ) );

    $wp_customize->add_control( 'simple_social_buttons_location_control', array( 'label' => esc_html__( 'Social + Search + Random + Login/Logout Buttons Location', 'cutemag' ), 'description' => esc_html__('Select where you want to display social buttons.', 'cutemag'), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[social_buttons_location]', 'type' => 'select', 'choices' => array( 'primary-menu' => esc_html__( 'Primary Menu', 'cutemag' ), 'secondary-menu' => esc_html__( 'Secondary Menu', 'cutemag' ) ) ) );

    $wp_customize->add_setting( 'cutemag_options[hide_social_buttons]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_social_buttons_control', array( 'label' => esc_html__( 'Hide Social + Search + Login/Logout Buttons', 'cutemag' ), 'description' => esc_html__('If you checked this option, there is no any effect from these option: "Hide Search Button", "Show Login/Logout Button", "Show Random Post Button".', 'cutemag'), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[hide_social_buttons]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_search_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_search_button_control', array( 'label' => esc_html__( 'Hide Search Button', 'cutemag' ), 'description' => esc_html__('This option has no effect if you checked the option: "Hide Social + Search + Login/Logout Buttons"', 'cutemag'), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[hide_search_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[show_login_button]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_show_login_button_control', array( 'label' => esc_html__( 'Show Login/Logout Button', 'cutemag' ), 'description' => esc_html__('This option has no effect if you checked the option: "Hide Social + Search + Login/Logout Buttons"', 'cutemag'), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[show_login_button]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[twitterlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_twitterlink_control', array( 'label' => esc_html__( 'Twitter URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[twitterlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[facebooklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_facebooklink_control', array( 'label' => esc_html__( 'Facebook URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[facebooklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[googlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) ); 

    $wp_customize->add_control( 'cutemag_googlelink_control', array( 'label' => esc_html__( 'Google Plus URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[googlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[pinterestlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_pinterestlink_control', array( 'label' => esc_html__( 'Pinterest URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[pinterestlink]', 'type' => 'text' ) );
    
    $wp_customize->add_setting( 'cutemag_options[linkedinlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_linkedinlink_control', array( 'label' => esc_html__( 'Linkedin Link', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[linkedinlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[instagramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_instagramlink_control', array( 'label' => esc_html__( 'Instagram Link', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[instagramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[vklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_vklink_control', array( 'label' => esc_html__( 'VK Link', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[vklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[flickrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_flickrlink_control', array( 'label' => esc_html__( 'Flickr Link', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[flickrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[youtubelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_youtubelink_control', array( 'label' => esc_html__( 'Youtube URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[youtubelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[vimeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_vimeolink_control', array( 'label' => esc_html__( 'Vimeo URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[vimeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[soundcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_soundcloudlink_control', array( 'label' => esc_html__( 'Soundcloud URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[soundcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[messengerlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_messengerlink_control', array( 'label' => esc_html__( 'Messenger URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[messengerlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[whatsapplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_whatsapplink_control', array( 'label' => esc_html__( 'WhatsApp URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[whatsapplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[lastfmlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_lastfmlink_control', array( 'label' => esc_html__( 'Lastfm URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[lastfmlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[mediumlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_mediumlink_control', array( 'label' => esc_html__( 'Medium URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[mediumlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[githublink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_githublink_control', array( 'label' => esc_html__( 'Github URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[githublink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[bitbucketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_bitbucketlink_control', array( 'label' => esc_html__( 'Bitbucket URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[bitbucketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[tumblrlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_tumblrlink_control', array( 'label' => esc_html__( 'Tumblr URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[tumblrlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[digglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_digglink_control', array( 'label' => esc_html__( 'Digg URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[digglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[deliciouslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_deliciouslink_control', array( 'label' => esc_html__( 'Delicious URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[deliciouslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[stumblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_stumblelink_control', array( 'label' => esc_html__( 'Stumbleupon URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[stumblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[mixlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_mixlink_control', array( 'label' => esc_html__( 'Mix URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[mixlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[redditlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_redditlink_control', array( 'label' => esc_html__( 'Reddit URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[redditlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[dribbblelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_dribbblelink_control', array( 'label' => esc_html__( 'Dribbble URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[dribbblelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[flipboardlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_flipboardlink_control', array( 'label' => esc_html__( 'Flipboard URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[flipboardlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[bloggerlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_bloggerlink_control', array( 'label' => esc_html__( 'Blogger URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[bloggerlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[etsylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_etsylink_control', array( 'label' => esc_html__( 'Etsy URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[etsylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[behancelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_behancelink_control', array( 'label' => esc_html__( 'Behance URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[behancelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[amazonlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_amazonlink_control', array( 'label' => esc_html__( 'Amazon URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[amazonlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[meetuplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_meetuplink_control', array( 'label' => esc_html__( 'Meetup URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[meetuplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[mixcloudlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_mixcloudlink_control', array( 'label' => esc_html__( 'Mixcloud URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[mixcloudlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[slacklink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_slacklink_control', array( 'label' => esc_html__( 'Slack URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[slacklink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[snapchatlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_snapchatlink_control', array( 'label' => esc_html__( 'Snapchat URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[snapchatlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[spotifylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_spotifylink_control', array( 'label' => esc_html__( 'Spotify URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[spotifylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[yelplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_yelplink_control', array( 'label' => esc_html__( 'Yelp URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[yelplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[wordpresslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_wordpresslink_control', array( 'label' => esc_html__( 'WordPress URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[wordpresslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[twitchlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_twitchlink_control', array( 'label' => esc_html__( 'Twitch URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[twitchlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[telegramlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_telegramlink_control', array( 'label' => esc_html__( 'Telegram URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[telegramlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[bandcamplink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_bandcamplink_control', array( 'label' => esc_html__( 'Bandcamp URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[bandcamplink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[quoralink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_quoralink_control', array( 'label' => esc_html__( 'Quora URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[quoralink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[foursquarelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_foursquarelink_control', array( 'label' => esc_html__( 'Foursquare URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[foursquarelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[deviantartlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_deviantartlink_control', array( 'label' => esc_html__( 'DeviantArt URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[deviantartlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[imdblink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_imdblink_control', array( 'label' => esc_html__( 'IMDB URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[imdblink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[codepenlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_codepenlink_control', array( 'label' => esc_html__( 'Codepen URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[codepenlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[jsfiddlelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_jsfiddlelink_control', array( 'label' => esc_html__( 'JSFiddle URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[jsfiddlelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[stackoverflowlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_stackoverflowlink_control', array( 'label' => esc_html__( 'Stack Overflow URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[stackoverflowlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[stackexchangelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_stackexchangelink_control', array( 'label' => esc_html__( 'Stack Exchange URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[stackexchangelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[bsalink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_bsalink_control', array( 'label' => esc_html__( 'BuySellAds URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[bsalink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[web500pxlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_web500pxlink_control', array( 'label' => esc_html__( '500px URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[web500pxlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[ellolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_ellolink_control', array( 'label' => esc_html__( 'Ello URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[ellolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[goodreadslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_goodreadslink_control', array( 'label' => esc_html__( 'Goodreads URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[goodreadslink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[odnoklassnikilink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_odnoklassnikilink_control', array( 'label' => esc_html__( 'Odnoklassniki URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[odnoklassnikilink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[houzzlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_houzzlink_control', array( 'label' => esc_html__( 'Houzz URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[houzzlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[pocketlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_pocketlink_control', array( 'label' => esc_html__( 'Pocket URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[pocketlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[xinglink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_xinglink_control', array( 'label' => esc_html__( 'XING URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[xinglink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[googleplaylink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_googleplaylink_control', array( 'label' => esc_html__( 'Google Play URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[googleplaylink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[slidesharelink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_slidesharelink_control', array( 'label' => esc_html__( 'SlideShare URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[slidesharelink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[dropboxlink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_dropboxlink_control', array( 'label' => esc_html__( 'Dropbox URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[dropboxlink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[paypallink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_paypallink_control', array( 'label' => esc_html__( 'PayPal URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[paypallink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[viadeolink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_viadeolink_control', array( 'label' => esc_html__( 'Viadeo URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[viadeolink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[wikipedialink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_wikipedialink_control', array( 'label' => esc_html__( 'Wikipedia URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[wikipedialink]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[skypeusername]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'sanitize_text_field' ) );

    $wp_customize->add_control( 'cutemag_skypeusername_control', array( 'label' => esc_html__( 'Skype Username', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[skypeusername]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[emailaddress]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_email' ) );

    $wp_customize->add_control( 'cutemag_emailaddress_control', array( 'label' => esc_html__( 'Email Address', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[emailaddress]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[rsslink]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( 'cutemag_rsslink_control', array( 'label' => esc_html__( 'RSS Feed URL', 'cutemag' ), 'section' => 'cutemag_section_social', 'settings' => 'cutemag_options[rsslink]', 'type' => 'text' ) );


    /* Share Button options */
    $wp_customize->add_section( 'cutemag_section_share', array( 'title' => esc_html__( 'Share Buttons Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 260 ) );

    $wp_customize->add_setting( 'cutemag_options[hide_share_buttons_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_share_buttons_home_control', array( 'label' => esc_html__( 'Hide Share Buttons from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_share', 'settings' => 'cutemag_options[hide_share_buttons_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_share_text_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_share_text_home_control', array( 'label' => esc_html__( 'Hide Share Text from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_share', 'settings' => 'cutemag_options[hide_share_text_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[share_text_home]', array( 'default' => esc_html__( 'Share:', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_share_text_home_control', array( 'label' => esc_html__( 'Share Text for Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_share', 'settings' => 'cutemag_options[share_text_home]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_share_twitter_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_share_twitter_home_control', array( 'label' => esc_html__( 'Hide Twitter Share Button from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_share', 'settings' => 'cutemag_options[hide_share_twitter_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_share_facebook_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_share_facebook_home_control', array( 'label' => esc_html__( 'Hide Facebook Share Button from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_share', 'settings' => 'cutemag_options[hide_share_facebook_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_share_pinterest_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_share_pinterest_home_control', array( 'label' => esc_html__( 'Hide Pinterest Share Button from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_share', 'settings' => 'cutemag_options[hide_share_pinterest_home]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_share_linkedin_home]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_share_linkedin_home_control', array( 'label' => esc_html__( 'Hide Linkedin Share Button from Posts Summaries', 'cutemag' ), 'section' => 'cutemag_section_share', 'settings' => 'cutemag_options[hide_share_linkedin_home]', 'type' => 'checkbox', ) );


    /* Footer options */
    $wp_customize->add_section( 'cutemag_section_footer', array( 'title' => esc_html__( 'Footer Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 280 ) );

    $wp_customize->add_setting( 'cutemag_options[footer_text]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_footer_text_control', array( 'label' => esc_html__( 'Footer copyright notice', 'cutemag' ), 'section' => 'cutemag_section_footer', 'settings' => 'cutemag_options[footer_text]', 'type' => 'text', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_footer_widgets]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_footer_widgets_control', array( 'label' => esc_html__( 'Hide Footer Widgets', 'cutemag' ), 'section' => 'cutemag_section_footer', 'settings' => 'cutemag_options[hide_footer_widgets]', 'type' => 'checkbox', ) );


    /* Search and 404 Page options */
    $wp_customize->add_section( 'cutemag_section_search_404', array( 'title' => esc_html__( 'Search and 404 Pages Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 340 ) );

    $wp_customize->add_setting( 'cutemag_options[hide_search_results_heading]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_search_results_heading_control', array( 'label' => esc_html__( 'Hide Search Results Heading', 'cutemag' ), 'section' => 'cutemag_section_search_404', 'settings' => 'cutemag_options[hide_search_results_heading]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[search_results_heading]', array( 'default' => esc_html__( 'Search Results for:', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_search_results_heading_control', array( 'label' => esc_html__( 'Search Results Heading', 'cutemag' ), 'description' => esc_html__( 'Enter a sentence to display before the search query.', 'cutemag' ), 'section' => 'cutemag_section_search_404', 'settings' => 'cutemag_options[search_results_heading]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[no_search_heading]', array( 'default' => esc_html__( 'Nothing Found', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_no_search_heading_control', array( 'label' => esc_html__( 'No Search Results Heading', 'cutemag' ), 'description' => esc_html__( 'Enter a heading to display when no search results are found.', 'cutemag' ), 'section' => 'cutemag_section_search_404', 'settings' => 'cutemag_options[no_search_heading]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[no_search_results]', array( 'default' => esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_no_search_results_control', array( 'label' => esc_html__( 'No Search Results Message', 'cutemag' ), 'description' => esc_html__( 'Enter a message to display when no search results are found.', 'cutemag' ), 'section' => 'cutemag_section_search_404', 'settings' => 'cutemag_options[no_search_results]', 'type' => 'textarea' ) );

    $wp_customize->add_setting( 'cutemag_options[error_404_heading]', array( 'default' => esc_html__( 'Oops! That page can not be found.', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_error_404_heading_control', array( 'label' => esc_html__( '404 Error Page Heading', 'cutemag' ), 'description' => esc_html__( 'Enter the heading for the 404 error page.', 'cutemag' ), 'section' => 'cutemag_section_search_404', 'settings' => 'cutemag_options[error_404_heading]', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cutemag_options[error_404_message]', array( 'default' => esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cutemag' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_html', ) );

    $wp_customize->add_control( 'cutemag_error_404_message_control', array( 'label' => esc_html__( 'Error 404 Message', 'cutemag' ), 'description' => esc_html__( 'Enter a message to display on the 404 error page.', 'cutemag' ), 'section' => 'cutemag_section_search_404', 'settings' => 'cutemag_options[error_404_message]', 'type' => 'textarea', ) );

    $wp_customize->add_setting( 'cutemag_options[hide_404_search]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_hide_404_search_control', array( 'label' => esc_html__( 'Hide Search Box from 404 Page', 'cutemag' ), 'section' => 'cutemag_section_search_404', 'settings' => 'cutemag_options[hide_404_search]', 'type' => 'checkbox', ) );


    /* Other options */
    $wp_customize->add_section( 'cutemag_section_other_options', array( 'title' => esc_html__( 'Other Options', 'cutemag' ), 'panel' => 'cutemag_main_options_panel', 'priority' => 600 ) );

    $wp_customize->add_setting( 'cutemag_options[enable_widgets_block_editor]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_enable_widgets_block_editor_control', array( 'label' => esc_html__( 'Enable Gutenberg Widget Block Editor', 'cutemag' ), 'section' => 'cutemag_section_other_options', 'settings' => 'cutemag_options[enable_widgets_block_editor]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[disable_loading_animation]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_disable_loading_animation_control', array( 'label' => esc_html__( 'Disable Site Loading Animation', 'cutemag' ), 'section' => 'cutemag_section_other_options', 'settings' => 'cutemag_options[disable_loading_animation]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[disable_fitvids]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_disable_fitvids_control', array( 'label' => esc_html__( 'Disable FitVids.JS', 'cutemag' ), 'description' => esc_html__( 'You can disable fitvids.js script if you are not using videos on your website or if you do not want fluid width videos in your post content.', 'cutemag' ), 'section' => 'cutemag_section_other_options', 'settings' => 'cutemag_options[disable_fitvids]', 'type' => 'checkbox', ) );

    $wp_customize->add_setting( 'cutemag_options[disable_backtotop]', array( 'default' => false, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'cutemag_sanitize_checkbox', ) );

    $wp_customize->add_control( 'cutemag_disable_backtotop_control', array( 'label' => esc_html__( 'Disable Back to Top Button', 'cutemag' ), 'section' => 'cutemag_section_other_options', 'settings' => 'cutemag_options[disable_backtotop]', 'type' => 'checkbox', ) );


    /* Upgrade to pro options */
    $wp_customize->add_section( 'cutemag_section_upgrade', array( 'title' => esc_html__( 'Upgrade to Pro Version', 'cutemag' ), 'priority' => 400 ) );
    
    $wp_customize->add_setting( 'cutemag_options[upgrade_text]', array( 'default' => '', 'sanitize_callback' => '__return_false', ) );
    
    $wp_customize->add_control( new CuteMag_Customize_Static_Text_Control( $wp_customize, 'cutemag_upgrade_text_control', array(
        'label'       => esc_html__( 'CuteMag Pro', 'cutemag' ),
        'section'     => 'cutemag_section_upgrade',
        'settings' => 'cutemag_options[upgrade_text]',
        'description' => esc_html__( 'Do you enjoy CuteMag? Upgrade to CuteMag Pro now and get:', 'cutemag' ).
            '<ul class="cutemag-customizer-pro-features">' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Color Options', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Font Options', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( '1/2/3/4 Columns for Posts Summaries', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Thumbnail Sizes Options for Posts Summaries', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Switch between Boxed or Full Layout Type', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Layout Options for Posts/Pages - (Sidebar + Content) / (Content + Sidebar) / (One Column) / (One Column + Bottom Sidebar)', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Layout Options for Non-Singular Pages - (Sidebar + Content) / (Content + Sidebar) / (One Column) / (One Column + Bottom Sidebar)', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Width Change Options for Full Website/Main Content/Sidebar', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ajax Powered Featured Posts Widgets (Recent/Categories/Tags/PostIDs based)', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ajax Powered Tabbed Widget (Recent/Categories/Tags/PostIDs based)', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Custom Page Templates', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Custom Post Templates', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Settings Panel to Control Options in Each Post', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Settings Panel to Control Options in Each Page', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Control Layout Style/Website Width/Header Style/Footer Style of each Post/Page', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Capability to Add Different Header Images for Each Post/Page with Unique Link, Title and Description', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'About and Social Widget - 60+ Social Buttons', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'News Ticker (Recent/Categories/Tags/PostIDs based) - It can display posts according to Likes/Views/Comments/Dates/... and there are many options.', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Header Styles with Width Options - (Logo + Header Banner) / (Full Width Header)', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Footer with Layout Options (1/2/3/4/5/6 Columns)', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Posts Views Counter', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Posts Likes System', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Infinite Scroll and Load More Button', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Post Share Buttons with Options - 25+ Social Networks are Supported', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Related Posts (Categories/Tags/Author/PostIDs based) with Options', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Author Bio Box with Social Buttons - 60+ Social Buttons', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to add Ads under Post Title and under Post Content', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Enable/Disable Mobile View from Primary and Secondary Menus', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Ability to Disable Google Fonts - for faster loading', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Sticky Menu/Sticky Sidebar with enable/disable capability', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Post Navigation with Thumbnails', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'More Widget Areas', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Built-in Contact Form', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'WooCommerce Compatible', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Yoast SEO Breadcrumbs Support', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Search Engine Optimized', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Full RTL Language Support', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Random Posts Button in Header', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'Many Useful Customizer Theme options', 'cutemag' ) . '</li>' .
                '<li><i class="fas fa-check" aria-hidden="true"></i> ' . esc_html__( 'More Features...', 'cutemag' ) . '</li>' .
            '</ul>'.
            '<strong><a href="'.CUTEMAG_PROURL.'" class="button button-primary" target="_blank"><i class="fas fa-shopping-cart" aria-hidden="true"></i> ' . esc_html__( 'Upgrade To CuteMag PRO', 'cutemag' ) . '</a></strong>'
    ) ) );

}

add_action( 'customize_register', 'cutemag_register_theme_customizer' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cutemag_customize_partial_blogname() {
    bloginfo( 'name' );
}
/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cutemag_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

function cutemag_customizer_js_scripts() {
    wp_enqueue_script('cutemag-theme-customizer-js', get_template_directory_uri() . '/assets/js/customizer.js', array( 'jquery', 'customize-preview' ), NULL, true);
}
add_action( 'customize_preview_init', 'cutemag_customizer_js_scripts' );