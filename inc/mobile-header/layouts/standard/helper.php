<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_standard_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function qode_essential_addons_add_standard_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['standard'] = array(
			'image' => QODE_ESSENTIAL_ADDONS_MOBILE_HEADER_LAYOUTS_URL_PATH . '/standard/assets/img/standard-header.png',
			'label' => esc_html__( 'Standard', 'qode-essential-addons' ),
		);

		return $header_layout_options;
	}

	add_filter( 'qode_essential_addons_filter_mobile_header_layout_option', 'qode_essential_addons_add_standard_mobile_header_global_option' );
}

if ( ! function_exists( 'qode_essential_addons_add_standard_mobile_header_as_default_global_option' ) ) {
	/**
	 * This function set default value for global mobile header option map
	 */
	function qode_essential_addons_add_standard_mobile_header_as_default_global_option() {
		return 'standard';
	}

	add_filter( 'qode_essential_addons_filter_mobile_header_layout_default_option', 'qode_essential_addons_add_standard_mobile_header_as_default_global_option' );
}

if ( ! function_exists( 'qode_essential_addons_register_standard_mobile_header_layout' ) ) {
	/**
	 * This function add header layout into global options list
	 *
	 * @param array $mobile_header_layouts
	 *
	 * @return array
	 */
	function qode_essential_addons_register_standard_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layouts['standard'] = 'QodeEssentialAddons_Mobile_Header_Standard';

		return $mobile_header_layouts;
	}

	add_filter( 'qode_essential_addons_filter_register_mobile_header_layouts', 'qode_essential_addons_register_standard_mobile_header_layout' );
}
