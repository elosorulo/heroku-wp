<?php
/**
 * Theme copyright template
 *
 * @since 1.0.0
 *
 * @package Dark Press WordPress Theme
 */ ?>
 <div class="col-xs-12 col-sm-6">
  	<span id="<?php echo esc_attr( Dark_Press_Helper::with_prefix( 'copyright' ) ); ?>">
      <?php
        printf( '%1$s <a href="%2$s" target="_blank"> %3$s </a> | %4$s | %5$s <a href="https://wpfellows.com" target="_blank" >%6$s </a>',
        esc_html__( 'Proudly powered by', 'dark-press' ),
        esc_url( __( 'https://wordpress.org', 'dark-press') ),
        esc_html__( 'WordPress', 'dark-press' ),
        esc_html__( 'Theme: Dark Press', 'dark-press' ),
        esc_html__( 'By: ', 'dark-press' ),
        esc_html__( 'WPFellows', 'dark-press' )
      )
      ?>
  	</span>	                 	
 </div>