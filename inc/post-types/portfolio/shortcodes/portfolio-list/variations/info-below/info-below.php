<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_list_layouts', 'qode_essential_addons_add_portfolio_list_variation_info_below' );
}
