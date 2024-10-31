<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

include_once QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio/helper.php';

foreach ( glob( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio/dashboard/admin/*.php' ) as $module ) {
	include_once $module;
}

foreach ( glob( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}

foreach ( glob( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}

foreach ( glob( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio/templates/single/*/include.php' ) as $single_part ) {
	include_once $single_part;
}
