<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( qode_essential_addons_framework_is_installed( 'elementor' ) ) {
	include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/elementor/helper.php';
	include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/elementor/class-qodeessentialaddons-elementor-section-handler.php';
	include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/elementor/class-qodeessentialaddons-elementor-container-handler.php';
}
