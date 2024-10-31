<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/admin-pages/class-qodeessentialaddons-admin-general-page.php';
require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/admin-pages/class-qodeessentialaddons-admin-sub-pages.php';

foreach ( glob( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/admin-pages/sub-pages/*/include.php' ) as $sub_page ) {
	require_once $sub_page;
}
