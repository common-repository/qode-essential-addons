<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

$categories = qode_essential_addons_woo_get_product_categories();

if ( ! empty( $categories ) && 'no' !== $show_category ) { ?>
	<div class="qodef-woo-product-categories" <?php qode_essential_addons_framework_inline_style( $this_shortcode->get_post_info_styles( $params ) ); ?>><?php echo wp_kses_post( $categories ); ?></div>
<?php } ?>
