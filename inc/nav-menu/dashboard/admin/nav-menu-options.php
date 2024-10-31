<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_nav_menu_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_nav_menu_options( $page ) {

		if ( $page ) {
			$main_menu_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header-main-menu',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Main Menu Settings', 'qode-essential-addons' ),
				)
			);

			$section = $main_menu_tab->add_section_element(
				array(
					'name' => 'qodef_nav_menu_section',
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_dropdown_top_position',
					'title'       => esc_html__( 'Dropdown Position', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter value in percentage of entire header height', 'qode-essential-addons' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_dropdown_background_color',
					'title'       => esc_html__( 'Dropdown Background Color', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set header menu dropdown color', 'qode-essential-addons' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_dropdown_box_shadow',
					'title'       => esc_html__( 'Dropdown Box Shadow', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set header menu dropdown box shadow in format: x-offset y-offset blue spread color (e.g. 1px 3px 20px 4px #ccc)', 'qode-essential-addons' ),
				)
			);

			do_action( 'qode_essential_addons_after_dropdown_background_color', $section );

			$nav_menu_typography_section = $main_menu_tab->add_section_element(
				array(
					'name'  => 'qodef_nav_menu_typography_section',
					'title' => esc_html__( 'Main Menu Typography', 'qode-essential-addons' ),
				)
			);

			$first_level_typography_row = $nav_menu_typography_section->add_row_element(
				array(
					'name'  => 'qodef_first_level_typography_row',
					'title' => esc_html__( 'Menu First Level Typography', 'qode-essential-addons' ),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_nav_1st_lvl_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_nav_1st_lvl_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_nav_1st_lvl_active_color',
					'title'      => esc_html__( 'Active Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			do_action( 'qode_essential_addons_after_nav_1st_lvl_active_color', $first_level_typography_row );

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_nav_1st_lvl_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_nav_1st_lvl_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_nav_1st_lvl_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_nav_1st_lvl_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_nav_1st_lvl_font_weight',
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
					'name'       => 'qodef_nav_1st_lvl_text_transform',
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
					'name'       => 'qodef_nav_1st_lvl_font_style',
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
					'name'       => 'qodef_nav_1st_lvl_text_decoration',
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
					'name'       => 'qodef_nav_1st_lvl_hover_text_decoration',
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
					'name'        => 'qodef_nav_1st_lvl_hover_text_decoration_draw',
					'title'       => esc_html__( 'Draw Hover/Active Text Decoration', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
					'description' => esc_html__( 'Initial text decoration will be ignored', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_nav_1st_lvl_margin',
					'title'      => esc_html__( 'Margin Left/Right', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);
			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_nav_1st_lvl_padding',
					'title'      => esc_html__( 'Padding Left/Right', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row = $nav_menu_typography_section->add_row_element(
				array(
					'name'  => 'qodef_second_level_typography_row',
					'title' => esc_html__( 'Menu Second Level Typography', 'qode-essential-addons' ),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_nav_2nd_lvl_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_nav_2nd_lvl_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_nav_2nd_lvl_active_color',
					'title'      => esc_html__( 'Active Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			do_action( 'qode_essential_addons_after_nav_2nd_lvl_active_color', $second_level_typography_row );

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_nav_2nd_lvl_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_nav_2nd_lvl_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_nav_2nd_lvl_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_nav_2nd_lvl_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_nav_2nd_lvl_font_weight',
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
					'name'       => 'qodef_nav_2nd_lvl_text_transform',
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
					'name'       => 'qodef_nav_2nd_lvl_font_style',
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
					'name'       => 'qodef_nav_2nd_lvl_text_decoration',
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
					'name'       => 'qodef_nav_2nd_lvl_hover_text_decoration',
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
					'name'        => 'qodef_nav_2nd_lvl_hover_text_decoration_draw',
					'title'       => esc_html__( 'Draw Hover/Active Text Decoration', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
					'description' => esc_html__( 'Initial text decoration will be ignored', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_nav_2st_lvl_offset',
					'title'       => esc_html__( 'Left/Right Dropdown Offset', 'qode-essential-addons' ),
					'description' => esc_html__( 'Input a value for the left/right dropdown alignment relative to the parent item', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);
		}
	}

	add_action( 'qode_essential_addons_action_after_header_options_map', 'qode_essential_addons_nav_menu_options' );
}
