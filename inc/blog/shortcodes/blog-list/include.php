<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

include_once QODE_ESSENTIAL_ADDONS_INC_PATH . '/blog/shortcodes/blog-list/class-qodeessentialaddons-blog-list-shortcode.php';

foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
