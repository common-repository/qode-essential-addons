<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_single_variation_slider_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_single_variation_slider_big( $variations ) {
		$variations['slider-big'] = esc_html__( 'Slider - Big', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_single_layout_options', 'qode_essential_addons_add_portfolio_single_variation_slider_big' );
}
