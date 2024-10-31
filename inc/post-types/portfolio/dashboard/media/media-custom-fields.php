<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_image_portfolio_single_options' ) ) {
	/**
	 * Function that add general image size options for this module
	 */
	function qode_essential_addons_add_image_portfolio_single_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope' => 'image',
				'type'  => 'attachment',
				'slug'  => 'qodef_image_masonry',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_image_portfolio_masonry_size',
					'title'       => esc_html__( 'Image Size', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose image size for portfolio single item - Masonry Layout', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);
		}
	}

	add_action( 'qode_essential_addons_action_framework_custom_media_fields', 'qode_essential_addons_add_image_portfolio_single_options', 15 );
}
