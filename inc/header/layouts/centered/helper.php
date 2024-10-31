<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_centered_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function qode_essential_addons_add_centered_header_global_option( $header_layout_options ) {
		$header_layout_options['centered'] = array(
			'image' => QODE_ESSENTIAL_ADDONS_HEADER_LAYOUTS_URL_PATH . '/centered/assets/img/centered-header.png',
			'label' => esc_html__( 'Centered', 'qode-essential-addons' ),
		);

		return $header_layout_options;
	}

	add_filter( 'qode_essential_addons_filter_header_layout_option', 'qode_essential_addons_add_centered_header_global_option' );
}

if ( ! function_exists( 'qode_essential_addons_register_centered_header_layout' ) ) {
	/**
	 * Function which add header layout into global list
	 *
	 * @param array $header_layouts
	 *
	 * @return array
	 */
	function qode_essential_addons_register_centered_header_layout( $header_layouts ) {
		$header_layouts['centered'] = 'QodeEssentialAddons_Centered_Header';

		return $header_layouts;
	}

	add_filter( 'qode_essential_addons_filter_register_header_layouts', 'qode_essential_addons_register_centered_header_layout' );
}
