<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_product_meta_boxes' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_product_meta_boxes( $page ) {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope' => array( 'product' ),
				'type'  => 'meta',
				'slug'  => 'product',
				'title' => esc_html__( 'Product Settings', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_product_list_image',
					'title'       => esc_html__( 'Product List Image', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose an image for "masonry behavior" product list. Upload image to be displayed on product list instead of featured image', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_product',
					'title'       => esc_html__( 'Image Dimension', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose an image layout for "masonry behavior" product list. If you are using fixed image proportions on the list, choose an option other than default', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_product_list_meta_box_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_meta_boxes_init', 'qode_essential_addons_add_product_meta_boxes' );
}
