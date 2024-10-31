<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_list_variation_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_list_variation_info_follow( $variations ) {
		$variations['info-follow'] = esc_html__( 'Info Follow', 'qode-essential-addons' );

		return $variations;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_list_layouts', 'qode_essential_addons_add_portfolio_list_variation_info_follow' );
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_list_info_follow_options' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_list_info_follow_options( $options ) {
		$info_follow = array();

		$category_color = array(
			'field_type' => 'color',
			'name'       => 'category_color',
			'title'      => esc_html__( 'Category Color', 'qode-essential-addons' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-follow',
						'default-value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
		);

		$category_underline = array(
			'field_type' => 'select',
			'name'       => 'category_underline',
			'title'      => esc_html__( 'Category Underline', 'qode-essential-addons' ),
			'options'    => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-follow',
						'default-value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
		);

		$info_follow[] = $category_color;
		$info_follow[] = $category_underline;

		return array_merge( $options, $info_follow );
	}

	add_filter( 'qode_essential_addons_filter_portfolio_list_extra_options', 'qode_essential_addons_add_portfolio_list_info_follow_options' );
}
