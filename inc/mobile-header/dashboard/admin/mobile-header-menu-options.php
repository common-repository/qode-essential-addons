<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_mobile_header_menu_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_mobile_header_menu_options( $page ) {

		if ( $page ) {
			$mobile_header_menu_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-mobile-header-menu',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Mobile Menu Settings', 'qode-essential-addons' ),
				)
			);

			$mobile_menu_typography_section = $mobile_header_menu_tab->add_section_element(
				array(
					'name'        => 'qodef_mobile_menu_typography_section',
					'title'       => esc_html__( 'Mobile Menu Typography', 'qode-essential-addons' ),
					'description' => esc_html__( 'Please note that in case minimal mobile header layout is chosen full screen menu typography will be applied', 'qode-essential-addons' ),
				)
			);

			$first_level_typography_row = $mobile_menu_typography_section->add_row_element(
				array(
					'name'  => 'qodef_mobile_first_level_typography_row',
					'title' => esc_html__( 'Menu First Level Typography', 'qode-essential-addons' ),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_menu_1st_lvl_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_menu_1st_lvl_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_menu_1st_lvl_active_color',
					'title'      => esc_html__( 'Active Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			do_action( 'qode_essential_addons_after_mobile_1st_lvl_active_color', $first_level_typography_row );

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_mobile_menu_1st_lvl_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_mobile_menu_1st_lvl_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_mobile_menu_1st_lvl_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_mobile_menu_1st_lvl_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_1st_lvl_font_weight',
					'title'      => esc_html__( 'Font Weight', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_1st_lvl_text_transform',
					'title'      => esc_html__( 'Text Transform', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_1st_lvl_font_style',
					'title'      => esc_html__( 'Font Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_1st_lvl_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_1st_lvl_hover_text_decoration',
					'title'      => esc_html__( 'Hover/Active Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_mobile_menu_1st_lvl_hover_text_decoration_draw',
					'title'       => esc_html__( 'Draw Hover/Active Text Decoration', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
					'description' => esc_html__( 'Initial text decoration will be ignored', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row = $mobile_menu_typography_section->add_row_element(
				array(
					'name'  => 'qodef_mobile_second_level_typography_row',
					'title' => esc_html__( 'Menu Second Level Typography', 'qode-essential-addons' ),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_menu_2nd_lvl_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_menu_2nd_lvl_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_menu_2nd_lvl_active_color',
					'title'      => esc_html__( 'Active Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			do_action( 'qode_essential_addons_after_mobile_2nd_lvl_active_color', $second_level_typography_row );

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_mobile_menu_2nd_lvl_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_mobile_menu_2nd_lvl_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_mobile_menu_2nd_lvl_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_mobile_menu_2nd_lvl_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_2nd_lvl_font_weight',
					'title'      => esc_html__( 'Font Weight', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_2nd_lvl_text_transform',
					'title'      => esc_html__( 'Text Transform', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_2nd_lvl_font_style',
					'title'      => esc_html__( 'Font Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_2nd_lvl_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_mobile_menu_2nd_lvl_hover_text_decoration',
					'title'      => esc_html__( 'Hover/Active Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$second_level_typography_row->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_mobile_menu_2nd_lvl_hover_text_decoration_draw',
					'title'       => esc_html__( 'Draw Hover/Active Text Decoration', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
					'description' => esc_html__( 'Initial text decoration will be ignored', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);
		}
	}

	add_action( 'qode_essential_addons_action_after_mobile_header_options_map', 'qode_essential_addons_mobile_header_menu_options' );
}
