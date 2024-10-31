<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$product = qode_essential_addons_woo_get_global_product();

if ( ! empty( $product ) ) {
	$price = $product->get_price_html();

	if ( ! empty( $price ) && 'no' !== $show_price ) { ?>
		<div class="qodef-woo-product-price price" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_price_styles( $params ) ); ?>><?php echo wp_kses_post( $price ); ?></div>
	<?php }
} ?>
