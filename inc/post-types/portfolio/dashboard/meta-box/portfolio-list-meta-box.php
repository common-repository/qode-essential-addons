<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_portfolio_item_list_meta_boxes( $page ) {

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'qode-essential-addons' ),
					'description' => esc_html__( 'Portfolio list settings', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_portfolio_list_image',
					'title'       => esc_html__( 'Portfolio List Image', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose an image for "masonry behavior" portfolio list. Upload image to be displayed on portfolio list instead of featured image', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_portfolio_item',
					'title'       => esc_html__( 'Image Dimension', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose an image layout for "masonry behavior" portfolio list. If you are using fixed image proportions on the list, choose an option other than default', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_item_padding',
					'title'       => esc_html__( 'Portfolio Item Custom Padding', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}

	add_action( 'qode_essential_addons_action_after_portfolio_meta_box_map', 'qode_essential_addons_add_portfolio_item_list_meta_boxes' );
}
