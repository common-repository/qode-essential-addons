<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_include_image_sizes' ) ) {
	/**
	 * Function that includes icons
	 */
	function qode_essential_addons_include_image_sizes() {
		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/media/*/include.php' ) as $image_size ) {
			include_once $image_size;
		}
	}

	add_action( 'qode_essential_addons_action_framework_before_images_register', 'qode_essential_addons_include_image_sizes' );
}
