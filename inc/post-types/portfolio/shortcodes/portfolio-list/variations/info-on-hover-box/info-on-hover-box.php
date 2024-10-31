<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_list_variation_info_on_hover_box' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_list_variation_info_on_hover_box( $variations ) {
		$variations['info-on-hover-box'] = esc_html__( 'Info On Hover Box', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_list_layouts', 'qode_essential_addons_add_portfolio_list_variation_info_on_hover_box' );
}
