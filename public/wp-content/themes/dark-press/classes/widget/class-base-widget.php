<?php
/**
 * Base class for widget
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */

abstract class Dark_Press_Base_Widget extends WP_Widget {


    public function __construct( $id_base, $name, $widget_options = array(), $control_options = array() ){
        parent::__construct( $id_base, $name, $widget_options, $control_options );        
    }

    /**
     * Get Markup for related fields
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    protected function generate_fields(){

        foreach( $this->fields as $id => $field ): $field[ 'id' ] = $id; ?>
            <p>
                <?php if( $field[ 'type'] != 'checkbox' && isset( $field[ 'label' ] ) ): ?>
                    <label for="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ); ?>">
                        <?php echo esc_html( $field[ 'label' ] ); ?>
                    </label><br>
                <?php endif;
                
                switch ( $field[ 'type' ] ) {
                    case 'dropdown-posts':
                        $this->get_html_dropdown_posts( $field );
                    break;

                    case 'dropdown-pages':
                        $this->get_html_dropdown_pages( $field );
                    break;

                    case 'dropdown-menus':
                        $this->get_html_dropdown_menus( $field );
                    break;

                    case 'dropdown-categories':
                        $this->get_html_dropdown_categories( $field );
                    break;

                    case 'text':
                    case 'number':
                    case 'email':
                    case 'file':
                    case 'url':
                        $this->get_html_text( $field );	
                    break;

                    case 'select':
                        $this->get_html_select( $field );
                    break;

                    case 'radio':
                        $this->get_html_radio( $field );
                    break;

                    case 'checkbox':
                        $this->get_html_checkbox( $field );
                    break;

                    case 'textarea':
                        $this->get_html_textarea( $field );
                    break;

                    case 'description':
                        $this->get_html_description( $field );
                    break;

                    case 'color':
                        $this->get_html_color( $field );
                    break;

                    default:
                        echo esc_html__( 'Type Not Supported.', 'dark-press' );
                    break;
                }
                if( $field[ 'type'] == 'checkbox' && isset( $field[ 'label' ] ) ): ?>
                    <label for="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ); ?>">
                        <?php echo esc_html( $field[ 'label' ] ); ?>
                    </label>
                <?php endif; ?>
            </p>
        <?php
        endforeach;

    }

    /**
     * make needed options for widget
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function get_html_dropdown_categories( $field ) {
        $dropdown = wp_dropdown_categories(
            array(
                'name'              => 'dropdown-categories-' . $this->get_field_id( $field[ 'id' ] ),
                'echo'              => 0,
                'show_option_none'  => esc_html__( '&mdash; Select &mdash;', 'dark-press' ),
                'option_none_value' => '0',
                'selected'          => esc_html( $field[ 'current_value' ] ),
            )
        );

        # Hackily add in the data link parameter.
        $dropdown = str_replace( '<select', '<select class="widefat" name="' . $this->get_field_name( $field[ 'id' ] ).'"', $dropdown );
        
        echo $dropdown;
    }

    /**
     * Description
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function get_html_description( $field ){
        if( isset( $field[ 'description' ] ) ):?>
            <p>
                <?php echo esc_html( $field[ 'description' ] ); ?>
            </p>
        <?php endif;
    }

    /**
     * MarkUp for teext area
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function get_html_textarea( $field ){ ?>
        <textarea class="widefat" rows="8" name="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ); ?>"><?php echo wp_kses_post( $field[ 'current_value' ] ); ?>
        </textarea>
    <?php }

    /**
     * MarkUp for checkbox
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function get_html_checkbox( $field ){ ?>
        <input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ); ?>" <?php checked( ! empty( $field[ 'current_value' ] ) ); ?>>
    <?php }

    /**
     * MarkUp for color
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */

    public function get_html_color( $field ){?>
        <input type="text" id="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>" 
                value="<?php echo $field[ 'current_value' ] ?>",
                class="darkpress-widget-color-picker"
                data-default-color= <?php echo esc_attr( $field[ 'default' ] ) ?>,
                name="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>"
        />
    <?php }

    /**
     * MarkUp for radio button
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function get_html_radio( $field ){?>
        <?php foreach( $field[ 'choices' ] as $key => $value ): ?>
            <input type="radio"
            id="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ) . '-' . esc_attr( $key ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>" 
            value="<?php echo esc_attr( $key ); ?>" <?php checked( $key, $field[ 'current_value' ] ); ?>>

            <label for="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ) . '-' . esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></label>

        <?php endforeach;
    }

    /**
     * MarkUp for Select
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */

    public function get_html_select( $field ){ ?>
        <select name="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>" 
            id="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ); ?>" class="widefat">

            <?php foreach( $field[ 'choices' ] as $key => $value ): ?>
                <option value="<?php echo esc_attr( $key ); ?>" 
                    <?php selected( $key, $field[ 'current_value' ] ); ?>>
                    <?php echo esc_html( $value ); ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php }

    /**
     * MarkUp for text field
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function get_html_text( $field ){ ?>

        <input type="<?php echo esc_attr( $field[ 'type' ] ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>" 
        <?php if( 'number' == $field[ 'type' ] ){
            if( isset( $field[ 'max' ] ) ){
                echo 'max="' . absint( $field[ 'max' ] ) . '"';
            }

            if( isset( $field[ 'min' ] ) ){
                echo 'min="' . absint( $field[ 'min' ] ) . '"';
            }
        } ?> 
        id="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ); ?>"
        value="<?php echo esc_attr( $field[ 'current_value' ] ); ?>"
        >
    <?php }

    /**
     * MarkUp for text field
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
   public function get_html_dropdown_pages( $field ){
       $args = array(
        'name'     => $this->get_field_name( $field[ 'id' ] ),
        'id'       => $this->get_field_id( $field[ 'id' ] ),
        'class'    => 'widefat',
        'selected' => $field[ 'current_value' ]
      );
      wp_dropdown_pages( $args );
   }

   /**
    * MarkUp for dropdown post
    *
    * @static
    * @access public
    * @since 1.0.0
    *
    * @package Dark Press WordPress Theme
    */
    public function get_html_dropdown_posts( $field, $post_type = 'post' ){
        $posts = get_posts( array( 
            'posts_per_page' => -1,
            'post_type'      => $post_type,
            'post_status'    => 'publish'
        ) );
        ?>

        <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ); ?>">

            <option value='0'><?php echo esc_html( '--Select Page--', 'dark-press' ); ?> </option>
            <?php foreach ( $posts as $post ): ?>
                <option value="<?php echo esc_attr( $post->ID ); ?>" 
                <?php selected( $post->ID, $field[ 'current_value' ] ); ?>>
                <?php echo esc_html( $post->post_title ); ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php }

    /**
     * MarkUp for menu
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function get_html_dropdown_menus( $field ){
    $menus = wp_get_nav_menus(); ?>
        <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $field[ 'id' ] ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $field[ 'id' ] ) ); ?>">
            <option value="0"><?php echo esc_html__( '&mdash; Select &mdash;', 'dark-press' ); ?></option>
            <?php foreach ( $menus as $menu ) : ?>
                <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $field[ 'current_value' ], $menu->term_id ); ?>>
                <?php echo esc_html( $menu->name ); ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php }

    /**
     * Update action
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        foreach( $this->fields as $id => $field ):
            $instance[ $id ] = $this->sanitize( $field, $new_instance[ $id ] );
        endforeach;

        return $instance;
    }

    /**
     * Form
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function form( $instance ){
        foreach( $this->fields as $key => $field ){
            $this->fields[ $key ][ 'default' ] = isset( $field[ 'default' ] ) ? $field[ 'default' ] : null;
            $this->fields[ $key ][ 'current_value' ] = isset( $instance[ $key ] ) ? $instance[ $key ] : $this->fields[ $key ][ 'default' ];
        }
        $this->generate_fields();
    }

    /**
     * Sanitize
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function sanitize( $field, $value ){

        if ( isset( $field[ 'sanitize_callback' ] ) && is_callable( $field[ 'sanitize_callback' ] ) ) {
            $value = call_user_func( $field[ 'sanitize_callback' ], $field, $value );
            return $value;
        }

        if( ! isset( $field[ 'default' ] ) ){
            $field[ 'default' ] = null;
        }

        switch( $field[ 'type' ] ){ 
            case 'dropdown-posts':
            case 'dropdown-pages':
            case 'dropdown-categories':
                $value = absint( $value );
            break;

            case 'url':
                $value = esc_url_raw( $value );
            break;

            case 'email':
                $value = sanitize_email( $value );
            break;

            case 'text':
                $value = sanitize_text_field( $value );
            break;

            case 'number':

                if( is_numeric( $value ) ){

                    if( isset( $field[ 'max' ] ) ){
                        if( $value > $field[ 'max' ] ){
                            $value = $field[ 'default' ];
                        }
                    }

                    if( isset( $field[ 'min' ] ) ){
                        if( $value < $field[ 'min' ] ){
                            $value = $field[ 'default' ];
                        }
                    }
                }else{
                    $value = $field[ 'default' ];
                }
            break;

            case 'select':
            case 'radio':
                $value = esc_attr( $value );
                $value = array_key_exists( $value, $field[ 'choices' ] ) ? $value : $field[ 'default' ];
            break;

            case 'checkbox':
                $value = ! empty( $value );
            break;

            case 'textarea':
                $value = wp_kses_post( $value );
            break;

            case 'color':
                $value = sanitize_text_field( $value );
            break;
        }
        return $value;
    }

    /**
     * Defaults
     *
     * @static
     * @access public
     * @since 1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public function init_defaults( $instance ){
        if( ! is_array( $instance ) ){
            $instance = array();
        }

        foreach( $this->fields as $id => $field ){
            if( !isset( $instance[ $id ] ) ){
                $instance[ $id ] = isset( $field[ 'default' ] ) ? $field[ 'default' ] : null;
            }

            $instance[ $id ] = $this->sanitize( $field, $instance[ $id ] );
        }
        return $instance;
    }
}