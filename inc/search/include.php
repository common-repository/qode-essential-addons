<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

include_once QODE_ESSENTIAL_ADDONS_INC_PATH . '/search/class-qodeessentialaddons-search.php';
include_once QODE_ESSENTIAL_ADDONS_INC_PATH . '/search/helper.php';
include_once QODE_ESSENTIAL_ADDONS_INC_PATH . '/search/dashboard/admin/search-options.php';

foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/search/layouts/*/include.php' ) as $layout ) {
	include_once $layout;
}
