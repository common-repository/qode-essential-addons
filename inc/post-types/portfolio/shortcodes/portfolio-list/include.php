<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

include_once QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio/shortcodes/portfolio-list/class-qodeessentialaddons-portfolio-list-shortcode.php';

foreach ( glob( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
