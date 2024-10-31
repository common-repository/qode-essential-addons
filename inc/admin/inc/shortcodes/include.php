<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/shortcodes/class-qodeessentialaddons-framework-shortcodes.php';
require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/shortcodes/class-qodeessentialaddons-framework-shortcode.php';

foreach ( glob( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/shortcodes/translators/*/*-translator.php' ) as $translator ) {
	require_once $translator;
}
