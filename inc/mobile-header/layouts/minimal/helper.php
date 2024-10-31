<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_minimal_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function qode_essential_addons_add_minimal_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['minimal'] = array(
			'image' => QODE_ESSENTIAL_ADDONS_MOBILE_HEADER_LAYOUTS_URL_PATH . '/minimal/assets/img/minimal-header.png',
			'label' => esc_html__( 'Minimal', 'qode-essential-addons' ),
		);

		return $header_layout_options;
	}

	add_filter( 'qode_essential_addons_filter_mobile_header_layout_option', 'qode_essential_addons_add_minimal_mobile_header_global_option' );
}

if ( ! function_exists( 'qode_essential_addons_register_minimal_mobile_header_layout' ) ) {
	/**
	 * This function add header layout into global options list
	 *
	 * @param array $mobile_header_layouts
	 *
	 * @return array
	 */
	function qode_essential_addons_register_minimal_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layouts['minimal'] = 'QodeEssentialAddons_Mobile_Header_Minimal';

		return $mobile_header_layouts;
	}

	add_filter( 'qode_essential_addons_filter_register_mobile_header_layouts', 'qode_essential_addons_register_minimal_mobile_header_layout' );
}
