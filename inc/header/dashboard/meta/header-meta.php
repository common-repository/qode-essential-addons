<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_page_header_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_page_header_meta_box( $page ) {

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Settings', 'qode-essential-addons' ),
					'description' => esc_html__( 'Header layout settings', 'qode-essential-addons' ),
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_layout',
					'title'       => esc_html__( 'Header Layout', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose a header layout to set for this page', 'qode-essential-addons' ),
					'args'        => array( 'images' => true ),
					'options'     => qode_essential_addons_header_radio_to_select_options( apply_filters( 'qode_essential_addons_filter_header_layout_option', array() ) ),
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_header_widget_areas',
					'title'         => esc_html__( 'Show Header Widget Areas', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose if you want to show or hide header widget areas', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$custom_sidebars = qode_essential_addons_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {

				$section = $header_tab->add_section_element(
					array(
						'name'       => 'qodef_header_custom_widget_area_section',
						'dependency' => array(
							'show' => array(
								'qodef_show_header_widget_areas' => array(
									'values'        => 'yes',
									'default_value' => 'yes',
								),
							),
						),
					)
				);

				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_one',
						'title'       => esc_html__( 'Choose Custom Header Widget Area', 'qode-essential-addons' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area', 'qode-essential-addons' ),
						'options'     => $custom_sidebars,
					)
				);

				// Hook to include additional options after module options.
				do_action( 'qode_essential_addons_action_after_custom_widget_area_header_meta_map', $section, $custom_sidebars );
			}

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_page_header_meta_map', $header_tab, $custom_sidebars );
		}
	}

	add_action( 'qode_essential_addons_action_after_general_meta_box_map', 'qode_essential_addons_add_page_header_meta_box' );
}

if ( ! function_exists( 'qode_essential_addons_add_general_header_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function qode_essential_addons_add_general_header_meta_box_callback( $callbacks ) {
		$callbacks['header'] = 'qode_essential_addons_add_page_header_meta_box';

		return $callbacks;
	}

	add_filter( 'qode_essential_addons_filter_general_meta_box_callbacks', 'qode_essential_addons_add_general_header_meta_box_callback' );
}
