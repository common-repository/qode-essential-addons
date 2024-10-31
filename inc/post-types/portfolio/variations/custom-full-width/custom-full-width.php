<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_single_variation_custom_full_width' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_single_variation_custom_full_width( $variations ) {
		$variations['custom-full-width'] = esc_html__( 'Custom Full Width', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_single_layout_options', 'qode_essential_addons_add_portfolio_single_variation_custom_full_width' );
}
