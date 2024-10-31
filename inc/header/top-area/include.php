<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

include_once QODE_ESSENTIAL_ADDONS_INC_PATH . '/header/top-area/class-qodeessentialaddons-top-area.php';
include_once QODE_ESSENTIAL_ADDONS_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}
