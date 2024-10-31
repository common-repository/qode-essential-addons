<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_dependency_for_scroll_appearance_options' ) ) {
	/**
	 * Function which return dependency values for global module options
	 *
	 * @return array
	 */
	function qode_essential_addons_dependency_for_scroll_appearance_options() {
		return apply_filters( 'qode_essential_addons_filter_header_scroll_appearance_hide_option', $hide_dep_options = array() );
	}
}
