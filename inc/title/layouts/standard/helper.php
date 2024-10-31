<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_register_standard_title_layout' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $layouts
	 *
	 * @return array
	 */
	function qode_essential_addons_register_standard_title_layout( $layouts ) {
		$layouts['standard'] = 'QodeEssentialAddons_Standard_Title';

		return $layouts;
	}

	add_filter( 'qode_essential_addons_filter_register_title_layouts', 'qode_essential_addons_register_standard_title_layout' );
}

if ( ! function_exists( 'qode_essential_addons_add_standard_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function qode_essential_addons_add_standard_title_layout_option( $layouts ) {
		$layouts['standard'] = esc_html__( 'Standard', 'qode-essential-addons' );

		return $layouts;
	}

	add_filter( 'qode_essential_addons_filter_title_layout_options', 'qode_essential_addons_add_standard_title_layout_option' );
}

if ( ! function_exists( 'qode_essential_addons_get_standard_title_layout_subtitle_text' ) ) {
	/**
	 * Function that render current page subtitle text
	 */
	function qode_essential_addons_get_standard_title_layout_subtitle_text() {
		$subtitle_meta = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_subtitle' );
		$subtitle      = array( 'subtitle' => ! empty( $subtitle_meta ) ? $subtitle_meta : '' );

		return apply_filters( 'qode_essential_addons_filter_standard_title_layout_subtitle_text', $subtitle );
	}
}
