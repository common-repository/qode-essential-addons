<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_page_sidebar_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_page_sidebar_meta_box( $page ) {

		if ( $page ) {

			$sidebar_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-sidebar',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Sidebar Settings', 'qode-essential-addons' ),
				)
			);

			$sidebar_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_sidebar_layout',
					'title'       => esc_html__( 'Sidebar Layout', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a sidebar layout', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'sidebar_layouts' ),
				)
			);

			$custom_sidebars = qode_essential_addons_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$sidebar_tab->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_page_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'qode-essential-addons' ),
						'description' => esc_html__( 'Choose a custom sidebar', 'qode-essential-addons' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_page_sidebar_meta_box_map', $sidebar_tab );
		}
	}

	add_action( 'qode_essential_addons_action_after_general_meta_box_map', 'qode_essential_addons_add_page_sidebar_meta_box' );
}

if ( ! function_exists( 'qode_essential_addons_add_general_page_sidebar_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function qode_essential_addons_add_general_page_sidebar_meta_box_callback( $callbacks ) {
		$callbacks['page-sidebar'] = 'qode_essential_addons_add_page_sidebar_meta_box';

		return $callbacks;
	}

	add_filter( 'qode_essential_addons_filter_general_meta_box_callbacks', 'qode_essential_addons_add_general_page_sidebar_meta_box_callback' );
}
