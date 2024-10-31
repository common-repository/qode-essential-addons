<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_include_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function qode_essential_addons_include_widgets() {

		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_essential_addons_action_framework_before_widgets_register', 'qode_essential_addons_include_widgets' );
}

if ( ! function_exists( 'qode_essential_addons_register_widgets' ) ) {
	/**
	 * Function that register widgets
	 */
	function qode_essential_addons_register_widgets() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();
		$widgets                         = apply_filters( 'qode_essential_addons_filter_register_widgets', $widgets = array() );

		if ( ! empty( $widgets ) ) {
			foreach ( $widgets as $widget ) {
				$qode_essential_addons_framework->add_widget( new $widget() );
			}
		}
	}

	// Priority 11 set because include of files is called on default action 10.
	add_action( 'qode_essential_addons_action_framework_before_widgets_register', 'qode_essential_addons_register_widgets', 11 );
}
