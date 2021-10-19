<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Blog Dark
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-blog-dark' ) ) );
		echo esc_html( date( 'Y' ) );
		printf( esc_html__( ' Bosa Blog Dark. Powered by', 'bosa-blog-dark' ) );
	?>
	<a href="<?php echo esc_url( __( '//bosathemes.com', 'bosa-blog-dark' ) ); ?>" target="_blank">
		<?php
			printf( esc_html__( 'Bosa Themes', 'bosa-blog-dark' ) );
		?>
	</a>
</div><!-- .site-info -->