<?php
/** 
 * Customize Heading control class.
 *
 * @package businessexpo
 * 
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class businessexpo_Customize_Upgrade_Control
 */
class businessexpo_Customize_Upgrade_Control extends businessexpo_Customize_Base_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'businessexpo-upgrade';

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		$upgrade_to_pro_link = 'https://wpfrank.com/wordpress-themes/businessexpo-premium/';
		?>

		<div class="businessexpo-upgrade-pro-message" style="display:none;";>
			<# if ( data.label ) { #><h4 class="customize-control-title"><?php echo wp_kses_post( 'Upgrade to <a href="'.$upgrade_to_pro_link.'" target="_blank" > businessexpo Pro </a> to add more', 'businessexpo'); ?> {{{ data.label }}} <?php esc_html_e( 'and get the other premium features.', 'businessexpo') ?></h4><# } #>
		</div>

		<?php
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {

	}

}