<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_woocommerce_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_woocommerce_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'woocommerce',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'WooCommerce', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global WooCommerce Options', 'qode-essential-addons' ),
				'layout'      => 'tabbed',
			)
		);

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-list',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Product List', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after section module options.
			do_action( 'qode_essential_addons_action_before_woo_product_list_options_map', $list_tab );

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_columns',
					'title'       => esc_html__( 'Number of Columns', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a default number of columns for shop pages', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_space',
					'title'       => esc_html__( 'Space Between Items', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose space between items displayed items in shop list', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'items_space' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_woo_product_list_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose a default sidebar layout for shop pages', 'qode-essential-addons' ),
					'default_value' => 'no-sidebar',
					'options'       => qode_essential_addons_get_select_type_options_pool( 'sidebar_layouts', false ),
				)
			);

			$custom_sidebars = qode_essential_addons_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$list_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_woo_product_list_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'qode-essential-addons' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on shop pages', 'qode-essential-addons' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_product_list_title_tag',
					'title'       => esc_html__( 'Title Tag', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a default heading tag for product list item titles on shop pages', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'title_tag' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'no',
					'name'          => 'qodef_woo_product_list_center_content',
					'title'         => esc_html__( 'Center Content', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will center product content on shop pages', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'yes',
					'name'          => 'qodef_woo_product_list_show_category',
					'title'         => esc_html__( 'Show Product Category', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will show product category on shop pages', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'yes',
					'name'          => 'qodef_woo_product_list_show_price',
					'title'         => esc_html__( 'Show Product Price', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will show product price on shop pages', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'default_value' => 'yes',
					'name'          => 'qodef_woo_product_list_show_rating',
					'title'         => esc_html__( 'Show Product Rating', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will show product rating on shop pages', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_woo_product_list_content_background_color',
					'title'       => esc_html__( 'Content Background Color', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a background color for the content area', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_woo_product_list_image_hover_background_color',
					'title'       => esc_html__( 'Image Hover Background Color', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose an image hover background color', 'qode-essential-addons' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_product_list_image_border_radius',
					'title'       => esc_html__( 'Image Border Radius', 'qode-essential-addons' ),
					'description' => esc_html__( 'Format: Top Right Bottom Left (10px 5px 8px 5px)', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after section module options.
			do_action( 'qode_essential_addons_action_after_woo_product_list_options_map', $list_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-single',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Product Single', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after section module options.
			do_action( 'qode_essential_addons_action_first_woo_product_single_options_map', $single_tab );

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_woo_single_title_tag',
					'title'       => esc_html__( 'Title Tag', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose title tag for product on single product page', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'title_tag' ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_woo_single_enable_zoom',
					'title'         => esc_html__( 'Enable Zoom on Image', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enable zoom on product main image', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_woo_single_image_border_radius',
					'title'       => esc_html__( 'Image Border Radius', 'qode-essential-addons' ),
					'description' => esc_html__( 'Format: Top Right Bottom Left (10px 5px 8px 5px)', 'qode-essential-addons' ),
				)
			);

			// Hook to include additional options after section module options.
			do_action( 'qode_essential_addons_action_after_woo_product_single_options_map', $single_tab );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_woo_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_woocommerce_options', qode_essential_addons_get_admin_options_map_position( 'woocommerce' ) );
}
