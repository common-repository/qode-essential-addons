<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
	woocommerce_template_loop_add_to_cart();
}
