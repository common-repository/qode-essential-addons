<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_product_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_product_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_product_list_layouts', 'qode_essential_addons_add_product_list_variation_info_below' );
}

if ( ! function_exists( 'qode_essential_addons_add_product_list_options_info_on_hover' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function qode_essential_addons_add_product_list_options_info_on_hover( $options ) {
		$info_on_hover_options = array();

		$image_hover_background_color = array(
			'field_type' => 'color',
			'name'       => 'image_hover_background_color',
			'title'      => esc_html__( 'Image Hover Background Color', 'qode-essential-addons' ),
			'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => '',
					),
				),
			),
		);

		$info_on_hover_options[] = $image_hover_background_color;

		return array_merge( $options, $info_on_hover_options );
	}

	add_filter( 'qode_essential_addons_filter_portfolio_list_extra_options', 'qode_essential_addons_add_product_list_options_info_on_hover' );
}
