<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/class-qodeessentialaddons-product-list-shortcode.php';

foreach ( glob( QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
