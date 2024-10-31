<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_standard_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function qode_essential_addons_add_standard_header_global_option( $header_layout_options ) {
		$header_layout_options['standard'] = array(
			'image' => QODE_ESSENTIAL_ADDONS_HEADER_LAYOUTS_URL_PATH . '/standard/assets/img/standard-header.png',
			'label' => esc_html__( 'Standard', 'qode-essential-addons' ),
		);

		return $header_layout_options;
	}

	add_filter( 'qode_essential_addons_filter_header_layout_option', 'qode_essential_addons_add_standard_header_global_option' );
}

if ( ! function_exists( 'qode_essential_addons_set_standard_header_as_default_global_option' ) ) {
	/**
	 * This function set header type as default option value for global header option map
	 */
	function qode_essential_addons_set_standard_header_as_default_global_option() {
		return 'standard';
	}

	add_filter( 'qode_essential_addons_filter_header_layout_default_option_value', 'qode_essential_addons_set_standard_header_as_default_global_option' );
}

if ( ! function_exists( 'qode_essential_addons_register_standard_header_layout' ) ) {
	/**
	 * Function which add header layout into global list
	 *
	 * @param array $header_layouts
	 *
	 * @return array
	 */
	function qode_essential_addons_register_standard_header_layout( $header_layouts ) {
		$header_layouts['standard'] = 'QodeEssentialAddons_Header_Standard';

		return $header_layouts;
	}

	add_filter( 'qode_essential_addons_filter_register_header_layouts', 'qode_essential_addons_register_standard_header_layout' );
}
