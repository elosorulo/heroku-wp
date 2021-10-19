<?php
get_header();

global $woocommerce;
$theid = wc_get_page_id('shop');
$slider = get_post_meta( $theid, 'slider_chkbx', true );
if ($slider) :
    get_template_part('index-home/index','slider');
endif;

?>
	<!--breadcrumb Woocommerce.php-->
	<?php get_template_part('breadcrumb'); ?>
	<!--/breadcrumb-->
	
<!-- /Page Title Section -->
<div class="clearfix"></div>
<!-- Blog Section with Sidebar -->
<section id="site-content" class="section theme-light menu-overlap">
	<div class="container">
		<div class="row">	
			<!--Woocommerce-Blog Section-->
			<div class="col-md-<?php echo ( !is_active_sidebar( 'woocommerce' ) ? '12' :'8' ); ?> col-xs-12">
				<div class="blog-page">
					<div class="post-woocommerce">
						<?php woocommerce_content(); ?>
					</div>	
				</div>	
			</div>	
			<!--/Woocommerce-Blog Section-->
			<?php get_sidebar('woocommerce'); ?>
		</div>
	</div>
</section>
<!-- /Blog Section with Sidebar -->
<?php get_footer(); ?>