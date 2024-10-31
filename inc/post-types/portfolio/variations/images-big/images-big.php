<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_single_variation_images_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_single_variation_images_big( $variations ) {
		$variations['images-big'] = esc_html__( 'Images - Big', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_single_layout_options', 'qode_essential_addons_add_portfolio_single_variation_images_big' );
}

if ( ! function_exists( 'qode_essential_addons_set_default_portfolio_single_variation_compact' ) ) {
	/**
	 * Function that set default variation layout for current module
	 *
	 * @return string
	 */
	function qode_essential_addons_set_default_portfolio_single_variation_compact() {
		return 'images-big';
	}

	add_filter( 'qode_essential_addons_filter_portfolio_single_layout_default_value', 'qode_essential_addons_set_default_portfolio_single_variation_compact' );
}
