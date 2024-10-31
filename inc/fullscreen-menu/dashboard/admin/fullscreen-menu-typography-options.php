<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_fullscreen_menu_typography_options' ) ) {
	/**
	 * Function that add additional header menu layout global options
	 *
	 * @param object $page
	 */
	function qode_essential_addons_fullscreen_menu_typography_options( $page ) {

		if ( $page ) {

			$fullscreen_menu_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-fullscreen-menu-settings',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Fullscreen Menu Settings', 'qode-essential-addons' ),
				)
			);

			$typography_section = $fullscreen_menu_tab->add_section_element(
				array(
					'name'  => 'qodef_fullscreen_typography_section',
					'title' => esc_html__( 'Fullscreen Menu Typography', 'qode-essential-addons' ),
				)
			);

			$first_level_typography_row = $typography_section->add_row_element(
				array(
					'name'  => 'qodef_first_level_typography_row',
					'title' => esc_html__( 'Menu First Level Typography', 'qode-essential-addons' ),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_1st_lvl_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_1st_lvl_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_1st_lvl_active_color',
					'title'      => esc_html__( 'Active Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			do_action( 'qode_essential_addons_after_fullscreen_1st_lvl_active_color', $first_level_typography_row );

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_fullscreen_1st_lvl_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$first_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_1st_lvl_font_weight',
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
					'name'       => 'qodef_fullscreen_1st_lvl_text_transform',
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
					'name'       => 'qodef_fullscreen_1st_lvl_font_style',
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
					'name'       => 'qodef_fullscreen_1st_lvl_text_decoration',
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
					'name'       => 'qodef_fullscreen_1st_lvl_hover_text_decoration',
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
					'name'        => 'qodef_fullscreen_1st_lvl_hover_text_decoration_draw',
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
					'name'       => 'qodef_fullscreen_1st_lvl_margin',
					'title'      => esc_html__( 'Margin Top/Bottom', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row = $typography_section->add_row_element(
				array(
					'name'  => 'qodef_second_level_typography_row',
					'title' => esc_html__( 'Menu Second Level Typography', 'qode-essential-addons' ),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_2nd_lvl_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_2nd_lvl_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_fullscreen_2nd_lvl_active_color',
					'title'      => esc_html__( 'Active Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			do_action( 'qode_essential_addons_after_fullscreen_2nd_lvl_active_color', $second_level_typography_row );

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_fullscreen_2nd_lvl_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_2nd_lvl_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_2nd_lvl_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_2nd_lvl_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$second_level_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_fullscreen_2nd_lvl_font_weight',
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
					'name'       => 'qodef_fullscreen_2nd_lvl_text_transform',
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
					'name'       => 'qodef_fullscreen_2nd_lvl_font_style',
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
					'name'       => 'qodef_fullscreen_2nd_lvl_text_decoration',
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
					'name'       => 'qodef_fullscreen_2nd_lvl_hover_text_decoration',
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
					'name'        => 'qodef_fullscreen_2nd_lvl_hover_text_decoration_draw',
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
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_2nd_lvl_margin',
					'title'      => esc_html__( 'Margin Top/Bottom', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$typography_responsive_section = $fullscreen_menu_tab->add_section_element(
				array(
					'name'  => 'qodef_fullscreen_typography_responsive_section',
					'title' => esc_html__( 'Fullscreen Menu Typography Responsive', 'qode-essential-addons' ),
				)
			);

			/* 1024 styles */
			$first_level_responsive_1024_typography_row = $typography_responsive_section->add_row_element(
				array(
					'name'  => 'qodef_first_level_typography_responsive_1024_row',
					'title' => esc_html__( 'Menu First Level Typography Responsive 1024', 'qode-essential-addons' ),
				)
			);

			$first_level_responsive_1024_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_responsive_1024_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$first_level_responsive_1024_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_responsive_1024_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$first_level_responsive_1024_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_responsive_1024_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			/* 680 styles */
			$first_level_responsive_680_typography_row = $typography_responsive_section->add_row_element(
				array(
					'name'  => 'qodef_first_level_typography_responsive_680_row',
					'title' => esc_html__( 'Menu First Level Typography Responsive 680', 'qode-essential-addons' ),
				)
			);

			$first_level_responsive_680_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_responsive_680_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$first_level_responsive_680_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_responsive_680_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$first_level_responsive_680_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_fullscreen_1st_lvl_responsive_680_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);
		}
	}

	add_action( 'qode_essential_addons_action_after_fullscreen_menu_options_map', 'qode_essential_addons_fullscreen_menu_typography_options', 15 );
}
