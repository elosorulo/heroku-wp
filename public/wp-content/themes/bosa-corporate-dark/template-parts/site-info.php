<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Corporate Dark
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-corporate-dark' ) ) );
		echo esc_html( date( 'Y' ) );
		printf( esc_html__( ' Bosa Corporate Dark. Powered by', 'bosa-corporate-dark' ) );
	?>
	<a href="<?php echo esc_url( __( '//bosathemes.com', 'bosa-corporate-dark' ) ); ?>" target="_blank">
		<?php
			printf( esc_html__( 'Bosa Themes', 'bosa-corporate-dark' ) );
		?>
	</a>
</div><!-- .site-info -->