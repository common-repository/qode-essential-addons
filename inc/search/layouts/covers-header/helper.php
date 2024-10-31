<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_register_covers_header_search_layout' ) ) {
	/**
	 * Function that add variation layout into global list
	 *
	 * @param array $search_layouts
	 *
	 * @return array
	 */
	function qode_essential_addons_register_covers_header_search_layout( $search_layouts ) {
		$search_layouts['covers-header'] = 'QodeEssentialAddons_Search_Covers_Header';

		return $search_layouts;
	}

	add_filter( 'qode_essential_addons_filter_register_search_layouts', 'qode_essential_addons_register_covers_header_search_layout' );
}
