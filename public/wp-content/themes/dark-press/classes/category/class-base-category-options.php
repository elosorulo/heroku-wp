<?php
/**
 * Class to add field on category edit page
 *
 * @static
 * @access public
 * @return object
 * @since  1.0.0
 *
 * @package Dark Press WordPress Theme
 */

class Dark_Press_Category_Fields extends Dark_Press_Helper{

    public static $cat_meta = array(); 

    public function __construct(){
        # add extra fields to category edit form callback function
        add_action ( 'category_edit_form_fields', array( __CLASS__,'extra_category_fields') );

        # save extra category extra fields hook
        add_action ( 'edited_category', array( __CLASS__, 'save_extra_category_fileds' ) );

        # enqueue script for admin end
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_scripts' ), 999 );
    }

    /**
     * Enqueue styles and scripts on admin end
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public static function admin_scripts( $hook ){
        if( 'term.php' == $hook || 'widgets.php' == $hook ){
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker' );  
            
            $scripts = array(
                array(
                    'handler'   => self::with_prefix( 'admin-script' ),
                    'script'     => 'assets/js/admin.js',
                    'in_footer' => true,
                ),
            );
            self::enqueue( $scripts );
        }
    }

    /**
     * Add extra fields to category edit form callback function
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public static function extra_category_fields( $tag ) {        
        self::$cat_meta = get_option( "category_$tag->term_id" );

        $list_fields = apply_filters( self::with_prefix( 'add-category-fields' ), array() );

        if( !empty( $list_fields ) ){
            foreach ( $list_fields as $k => $v ) { ?>
                <tr class="form-field">
                    <th scope="row" valign="top"><label for="<?php echo esc_html( $k ); ?>"><?php echo esc_html( $v[ 'label' ] ); ?></label></th>
                    <td>
                        <?php self::get_markup( $k, $v );?>
                    </td>
                </tr>
            <?php }
        }

        wp_nonce_field( self::with_prefix( 'category_nonce' ), self::with_prefix( 'name_cat_nonce' ) );
    }

    /**
     * Get markup for the types
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public static function get_markup( $id, $fields ){
        switch( $fields[ 'type' ] ){
            case 'textarea': ?>
                <textarea name="category_meta[<?php echo esc_html( $id ); ?>]" id="<?php echo esc_html( $id ); ?>" style="width:60%;"><?php echo isset( self::$cat_meta[ $id ] ) ? self::$cat_meta[ $id ] : ''; ?></textarea><br/>
                <?php if( isset( $fields[ 'description' ] ) ): ?>
                    <span class="description"><?php echo esc_html( $fields[ 'description' ] ); ?></span>
                <?php endif; ?>

                <?php break;

            case 'color':?>
                <input type="text" id="<?php echo esc_html( $id ); ?>" 
                        value="<?php echo isset( self::$cat_meta[ $id ] ) ? self::$cat_meta[ $id ] : '#000000' ?>"class="darkpress-color-picker"
                        data-default-color= "#000000"
                        name="category_meta[<?php echo esc_html( $id ); ?>]" 
                />
                <?php break;
            default: ?>

                <input type="text" name="category_meta[<?php echo esc_html( $id ); ?>]" id="<?php echo esc_html( $id ); ?>" size="3" style="width:60%;" value="<?php echo isset( self::$cat_meta[ $id ] ) ? self::$cat_meta[ $id ] : ''; ?>"><br />
                <?php if( isset( $fields[ 'description' ] ) ): ?>
                        <span class="description"><?php echo esc_html( $fields[ 'description' ] ); ?></span>
                <?php endif; ?>

        <?php }
    }

    /**
     * save hook for form
     *
     * @static
     * @access public
     * @return object
     * @since  1.0.0
     *
     * @package Dark Press WordPress Theme
     */
    public static function save_extra_category_fileds( $term_id ) {

        $p = wp_unslash( $_POST );

        if ( empty( $p ) || ! isset(  $p[ self::with_prefix( 'name_cat_nonce' ) ] ) || ! wp_verify_nonce( $p[ self::with_prefix( 'name_cat_nonce' ) ], self::with_prefix( 'category_nonce' ) ) ) {
            return;
        }

        if ( isset( $p[ 'category_meta' ] ) ) {
            $cat_meta = get_option( 'category_$term_id' );
            $cat_keys = array_keys( $p[ 'category_meta' ] );
                foreach ( $cat_keys as $key ){
                if ( isset( $p[ 'category_meta' ][ $key ] ) ){
                    $cat_meta[ $key ] = $p[ 'category_meta' ][ $key ];
                }
            }

            # save the option array
            update_option( "category_$term_id", $cat_meta );
        }
    }
}

new Dark_Press_Category_Fields();
