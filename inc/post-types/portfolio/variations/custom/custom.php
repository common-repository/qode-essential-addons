<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_single_variation_custom' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_single_variation_custom( $variations ) {
		$variations['custom'] = esc_html__( 'Custom', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_single_layout_options', 'qode_essential_addons_add_portfolio_single_variation_custom' );
}
