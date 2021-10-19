<?php

function bosa_blog_dark_default_styles(){

	// Begin Style
	$css = '<style>';

	if( get_theme_mod( 'skin_select', 'dark' ) == 'dark' ){
		$css .= '
			body,
			body.custom-background,
			.site-content {
			  	background-color: #000000;
			  	color: #c7c7c7;
			}
			h1, h2, h3, h4, h5, h6, .entry-title, #primary article .entry-title, body.single .page-title, body.page .page-title,
			.highlight-post-slider .post .entry-content .entry-title {
			  	color: #ffffff;
			}
			table th, table td {
				border-color: #262626;
			}
			input[type=text], input[type=email], 
			input[type=url], input[type=password], 
			input[type=search], input[type=number], 
			input[type=tel], input[type=range], 
			input[type=date], input[type=month], 
			input[type=week], input[type=time], 
			input[type=datetime], 
			input[type=datetime-local], 
			input[type=color],
			textarea,
			.select2-container--default .select2-selection--single {
			  background-color: #000000;
			  border-color: #262626;
			  color: #ffffff;
			}
			input[type=text]:focus, 
			input[type=text]:active, 
			input[type=email]:focus, 
			input[type=email]:active, 
			input[type=url]:focus, 
			input[type=url]:active, 
			input[type=password]:focus, 
			input[type=password]:active, 
			input[type=search]:focus, 
			input[type=search]:active, 
			input[type=number]:focus, 
			input[type=number]:active, 
			input[type=tel]:focus, 
			input[type=tel]:active, 
			input[type=range]:focus, 
			input[type=range]:active, 
			input[type=date]:focus, 
			input[type=date]:active, 
			input[type=month]:focus, 
			input[type=month]:active, 
			input[type=week]:focus, 
			input[type=week]:active, 
			input[type=time]:focus, 
			input[type=time]:active, 
			input[type=datetime]:focus, 
			input[type=datetime]:active, 
			input[type=datetime-local]:focus, 
			input[type=datetime-local]:active, 
			input[type=color]:focus, 
			input[type=color]:active,
			textarea:focus,
			textarea:active {
			  	border-color: #ffffff;
			}
			.button-outline {
			  	border-color: #e6e6e6;
			  	color: #e6e6e6;
			}
			.button-outline:hover, 
			.button-outline:active, 
			.button-outline:focus {
		  		border-color: #086abd;
			  	color: #ffffff;
			}
			.button-text,
			#primary .post .button-text {
			  	color: #e6e6e6;
			}
			.button-text:hover, 
			.button-text:focus, 
			.button-text:active {
			  	color: #086abd;
			}
			blockquote {
				background-color: #1a1a1a;
			  	color: #c7c7c7;
			}
			.wp-block-quote cite {
				color: #c7c7c7;
			}
			blockquote:before {
				background-color: #1a1a1a;
			  	border-bottom-color: #cccccc;
			  	border-top-color: #cccccc;
			}
			blockquote:after {
			  	background-color: #000000;
			  	color: #cccccc;
			}
			.header-four .header-group {
				background-color: #000000;
			}
			.header-one .header-contact ul li, .header-one .header-contact ul li a, 
			.header-one .social-profile ul li a, 
			.header-one .header-icons .search-icon, 
			.header-two .header-contact ul li, 
			.header-two .header-contact ul li a, 
			.header-two .social-profile ul li a, 
			.header-two .header-icons .search-icon, 
			.header-three .header-navigation ul.menu > li > a, 
			.header-three .alt-menu-icon .iconbar-label, 
			.header-three .social-profile ul li a {
				color: #d5d5d5;
			}
			.header-three .alt-menu-icon .icon-bar, 
			.header-three .alt-menu-icon .icon-bar:before, 
			.header-three .alt-menu-icon .icon-bar:after {
				background-color: #d5d5d5;
			}
			.site-header .site-branding .site-title,
			.site-header .site-branding .site-description {
				color: #FFFFFF;
			}
			.site-header.sticky-header .fixed-header {
				background-color: #000000;
			}
			body:not(.home) .site-header .bottom-header {
			    border-color: #000000;
			}
			.post:not(.list-post) .entry-content {
			  	border-color: #1a1a1a;
			}
			body:not(.custom-background), body.custom-background .site-content .container {
				background-color: #000000;
			}
			.main-navigation ul.menu > li > a:hover, 
			.main-navigation ul.menu > li > a:focus, 
			.main-navigation ul.menu > li > a:active {
			  	color: #086abd;
			}
			.main-navigation ul.menu ul {
			  	background-color: #050505;
			}
			.main-navigation ul.menu ul li {
			  	border-color: #1a1a1a;
			}
			.main-navigation ul.menu ul li a {
				color: #b1b1b1;
			}
			.main-navigation ul.menu ul li a:hover, 
			.main-navigation ul.menu ul li a:focus, 
			.main-navigation ul.menu ul li a:active {
			  	color: #086abd;
			}
			.site-header .bottom-header,
			.site-header .top-header,
			.site-header .mid-header,
			.site-footer {
			  	background-color: #000000;
			}
			.site-header.header-two .top-header {
				background-color: transparent;
			}
			.site-header .top-header,
			.header-three .mid-header,
			.mid-header {
			  	border-bottom-color: #292929;
			}
			.header-search {
				background-color: #000000;
			}
			.header-search .search-form .search-button,
			.header-search .close-button {
				color: #969696;
			}
			.header-sidebar .widget,
			#offcanvas-menu .header-contact, 
			#offcanvas-menu .social-profile, 
			#offcanvas-menu .header-btn-wrap, 
			#offcanvas-menu .header-search-wrap, 
			#offcanvas-menu .header-navigation, 
			#offcanvas-menu .header-date, 
			offcanvas-menu .header-advertisement-banner {
				background-color: #131313;
			}
			#offcanvas-menu .header-contact ul li,
			#offcanvas-menu .header-contact ul li a, 
			#offcanvas-menu .header-contact ul li span, 
			#offcanvas-menu .header-contact ul li i,
			#offcanvas-menu .social-profile ul li a {
				color: #FFFFFF;
			}
			.home .site-content {
			    border-top: 1px solid #292929;
			}
			.site-content {
				border-top-color: #292929;
			}
			.site-header .site-branding .site-title {
			  	color: #ffffff;
			}
			.site-header .main-navigation ul.menu > li > a, 
			.social-profile ul li a,
			.site-header .header-icons .search-icon {
				color: #d5d5d5;
			}
			.header-two .alt-menu-icon .icon-bar, 
			.header-two .alt-menu-icon .icon-bar:before, 
			.header-two .alt-menu-icon .icon-bar:after {
				background-color: #d5d5d5;
			}
			.section-banner .slick-slide {
			  	background-color: #060606;
			}
			.section-banner .post {
			  	background-color: #000000;
			}
			.post .entry-text,
			#primary .post .entry-text {
				color: #c7c7c7;
			}
			.section-banner .slick-control ul li {
			  	background-color: #000000;
			}
			.highlight-post-slider .post,
			.wrap-ralated-posts .post .entry-content {
			  	background-color: #000000;
			}
			.site-content .list-post,
			.site-content .single-post {
				border-bottom-color: #1a1a1a;
			}
			.page-numbers {
				border-color: #1a1a1a;
			}
			.sticky {
				-webkit-box-shadow: none;
    			-moz-box-shadow: none;
    			-ms-box-shadow: none;
    			-o-box-shadow: none;
    			box-shadow: none;
    			border: 2px solid #1a1a1a;
			}
			.site-footer h1, 
			.site-footer h2, 
			.site-footer h3, 
			.site-footer h4, 
			.site-footer h5, 
			.site-footer h6 {
				color: #ffffff;
			}
			.site-footer .widget .widget-title:before {
				background-color: #ffffff;
			}
			.site-footer .site-info a {
			  	color: #ffffff;
			}
			.site-footer .site-info a:hover, 
			.site-footer .site-info a:focus, 
			.site-footer .site-info a:active {
			  	color: #086abd;
			}
			.site-footer .footer-menu ul li {
			  	border-color: #2A2A2A;
			}
			.site-footer .widget .widget-title:before {
			  	background-color: #ffffff;
			}
			.breadcrumb-wrap .breadcrumbs {
			  	background-color: #080808;
			}
			.comments-area .comment-list .comment-body {
			  	background-color: #000000;
			  	border-color: #1a1a1a;
			}
			.comments-area .comment-list .comment-author .avatar {
			  	background-color: #1a1a1a;
			  	border-color: #000000;
			}
			.comments-area .comment-respond .comment-form .comment-notes {
			  	color: #cccccc;
			}
			.comments-area .comment-respond .comment-form .comment-notes span {
			  	color: #ffffff;
			}
			.author-info .author-content-wrap {
			  	background-color: #060606;
			}
			.post-navigation {
			  	border-bottom-color: #1a1a1a;
			  	border-top-color: #1a1a1a;
			}
			.comment-navigation .nav-previous a, 
			.comment-navigation .nav-next a,
			.post-navigation .nav-previous a,
			.post-navigation .nav-next a {
			  	color: #cccccc;
			}
			.comment-navigation .nav-previous a:hover, 
			.comment-navigation .nav-previous a:focus, 
			.comment-navigation .nav-previous a:active, 
			.comment-navigation .nav-next a:hover, 
			.comment-navigation .nav-next a:focus, 
			.comment-navigation .nav-next a:active,
			.post-navigation .nav-previous a:hover,
			.post-navigation .nav-previous a:focus,
			.post-navigation .nav-previous a:active,
			.post-navigation .nav-next a:hover,
			.post-navigation .nav-next a:focus,
			.post-navigation .nav-next a:active {
			  	color: #086abd;
			}
			.comments-area .comment-respond label {
			  	color: #e6e6e6;
			}
			body.woocommerce .woocommerce-result-count,
			body.woocommerce .woocommerce-ordering select,
			body.woocommerce select {
			  	background-color: #0d0d0d;
			  	border-color: #0d0d0d;
			  	color: #cccccc;
			}
			body.woocommerce ul.products li.product .price,
			body.woocommerce-page ul.products li.product .price {
			  	color: #ffffff;
			}
			body.woocommerce ul .product-inner, 
			body.woocommerce-page ul .product-inner {
			  	border-color: #1a1a1a;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs:before {
			  	border-color: #333333;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li {
			  	background-color: #333333;
			  	border-color: #333333;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li:before {
			  	box-shadow: 2px 2px 0 #333333;
			  	border-color: #333333;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li:after {
			  	box-shadow: -2px 2px 0 #333333;
			  	border-color: #333333;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
			  	background-color: #000000;
			  	border-bottom-color: #000000;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li.active:before {
			  	box-shadow: 2px 2px 0 #000000;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li.active:after {
			  	box-shadow: -2px 2px 0 #000000;
			}
			body.woocommerce div.product .woocommerce-tabs ul.tabs li a {
			  	color: #d6d6d6;
			}
			.woocommerce ul.products.columns-3 li.product, 
			.woocommerce-page ul.products.columns-3 li.product {
				border-right-color: #454545;
			}
			.product .product-compare-wishlist {
				border-top-color: #454545;
			}
			.woocommerce .woocommerce-tabs .woocommerce-Tabs-panel {
				border-left-color: #333333;
    			border-right-color: #333333;
    			border-bottom-color: #333333;
			}
			.product-inner ~ a.yith-wcqv-button {
				border-color: #454545;
				color: #454545;
			}
			.widget ul li {
			  	border-bottom-color: #1a1a1a;
			}
			.widget ul li a {
				color: #FFFFFF;
			}
			.widget .tagcloud a {
			  	color: #e6e6e6;
			}
			.widget .tagcloud a:hover, 
			.widget .tagcloud a:focus, 
			.widget .tagcloud a:active {
			  	color: #ffffff;
			}
			.latest-posts-widget .post {
			  	border-bottom-color: #1a1a1a;
			}
			.widget_calendar table {
			    border-color: #1a1a1a;
			}
			.widget.widget_calendar table thead th {
			    border-right-color: #1a1a1a;
			}
			.widget_calendar table th, 
			.widget_calendar table td {
			    border-bottom-color: #1a1a1a;
			}
			body.search-results .hentry,
			body.search-results .product {
			  	border-color: #1a1a1a;
			}
			.slicknav_btn .slicknav_icon span,
			.slicknav_btn .slicknav_icon span:before,
			.slicknav_btn .slicknav_icon span:after {
			  	background-color: #ffffff;
			}
			.slicknav_btn.slicknav_open span {
			  	background-color: transparent;
			}
			.section-banner .main-slider-three .post {
			  	background-color: transparent;
			}
			.slicknav_menu .slicknav_nav {
			  	background-color: #000000;
			}
			.slicknav_menu ul.slicknav_nav {
			  	background-color: #000000;
			}
			.slicknav_menu ul.slicknav_nav li > a {
			  	border-top-color: #1a1a1a;
			  	color: #cccccc;
			}
			.mobile-menu-container .slicknav_menu .slicknav_nav li {
				border-top-color: #1a1a1a;
			}
			#offcanvas-menu {
			  	background-color: #060606;
			}
			.woocommerce-Reviews {
			  	color: #404040;
			}
			body.site-layout-box, body.site-layout-frame {
			  	background-color: #0a0a0a;
			}
			body.site-layout-box .site, body.site-layout-frame .site {
			  	background-color: #000000;
			}
			.breadcrumb-wrap {
			    background-color: transparent;
			}
			.site-header [class*="header-btn-"].button-outline {
				border-color: #969696;
				color: #969696;
			}
			.bottom-footer,
			.site-footer .social-profile ul li a, 
			.footer-menu ul li a {
				color: #cccccc;
			}
			.site-footer .social-profile ul li a {
				background-color: rgba(255, 255, 255, 0.1);
			}
			.woocommerce div.product p.price {
				color: #FFFFFF;
			}
			.woocommerce .product_meta,
			#add_payment_method .cart-collaterals .cart_totals tr td, 
			#add_payment_method .cart-collaterals .cart_totals tr th, 
			.woocommerce-cart .cart-collaterals .cart_totals tr td, 
			.woocommerce-cart .cart-collaterals .cart_totals tr th, 
			.woocommerce-checkout .cart-collaterals .cart_totals tr td, 
			.woocommerce-checkout .cart-collaterals .cart_totals tr th {
				border-top-color: #333333;
			}
			body.woocommerce ul.products.columns-3 li.product, 
			body.woocommerce-page ul.products.columns-3 li.product,
			.woocommerce .woocommerce-MyAccount-navigation ul li,
			#add_payment_method table.cart td.actions .coupon .input-text, 
			.woocommerce-cart table.cart td.actions .coupon .input-text, 
			.woocommerce-checkout table.cart td.actions .coupon .input-text {
				border-color: #333333;
			}
			.woocommerce-error, 
			.woocommerce-info, 
			.woocommerce-message,
			#add_payment_method #payment, 
			.woocommerce-cart #payment, 
			.woocommerce-checkout #payment,
			.select2-dropdown {
				background-color: #1a1a1a;
				color: #cccccc;
			}
			.comment-respond .comment-form .comment-notes span,
			.woocommerce-Reviews,
			.woocommerce-tabs .comment-respond label,
			.comment-respond .comment-form .comment-notes {
				color: #cccccc;
			}
			.select2-container--default .select2-selection--single .select2-selection__rendered {
				color: #ffffff;
			}
			body .woocommerce .woocommerce-MyAccount-navigation ul li a {
				color: #cccccc;
			}
			body.woocommerce a.added_to_cart, body.woocommerce-page a.added_to_cart {
				color: #cccccc;
				border-color: #333333;
			}
			#add_payment_method #payment ul.payment_methods, 
			.woocommerce-cart #payment ul.payment_methods, 
			.woocommerce-checkout #payment ul.payment_methods,
			.woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register {
				border-color: #333333;
			}
			body .select2-container--default .select2-results__option[aria-selected=true], 
			body .select2-container--default .select2-results__option[data-selected=true] {
				background-color: inherit;
			}
			.widget.widget_recently_viewed_products li .product-title, 
			.widget.widget_recent_reviews li .product-title, 
			.widget.widget_products .product_list_widget li .product-title {
				color: #ffffff;
			}
			@media only screen and (max-width: 991px) {
			  	.header-search-wrap .search-button {
			    	color: #ffffff;
			  	}
			  	.mobile-menu-container .slicknav_menu .slicknav_menutxt,
			  	.alt-menu-icon .iconbar-label {
					color: #D5D5D5;
				}
				header.site-header .alt-menu-icon .icon-bar, 
				header.site-header .alt-menu-icon .icon-bar:before, 
				header.site-header .alt-menu-icon .icon-bar:after,
				.mobile-menu-container .slicknav_menu .slicknav_btn .slicknav_icon span, 
				.mobile-menu-container .slicknav_menu .slicknav_btn .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_menu .slicknav_btn .slicknav_icon span:first-child:after {
					background-color: #D5D5D5;
				}
			}
			@media only screen and (max-width: 575px) {
				.comments-area .comment-list .comment-metadata {
					border-top-color: #1a1a1a;
				}
			}
		';
	}

	$header_image_height = get_theme_mod( 'header_image_height', 140 );
	$css .= '
		@media only screen and (min-width: 992px) {
			.site-header:not(.sticky-header) .header-image-wrap {
				height: '. esc_attr( $header_image_height ) .'px;
				width: 100%;
				position: relative;
			}
		}
	';

	$feature_posts_height = get_theme_mod( 'feature_posts_height', 320 );
	$css .= '
		.feature-posts-layout-one .feature-posts-image,
		.feature-posts-content-wrap .feature-posts-image {
			height: '. esc_attr( $feature_posts_height ) .'px;
			overflow: hidden;
		}
	';

	// End Style
	$css .= '</style>';

	// return generated & compressed CSS
	echo str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css); 
}
add_action( 'wp_head', 'bosa_blog_dark_default_styles', 99 );