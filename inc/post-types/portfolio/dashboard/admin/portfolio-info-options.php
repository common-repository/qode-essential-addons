<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_info_typography_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_portfolio_info_typography_options( $page ) {

		if ( $page ) {
			$portfolio_info_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-portfolio-info',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Portfolio Info Typography', 'qode-essential-addons' ),
				)
			);

			$portfolio_category_typography_section = $portfolio_info_tab->add_section_element(
				array(
					'name'  => 'qodef_portfolio_category_typography_section',
					'title' => esc_html__( 'Category Typography', 'qode-essential-addons' ),
				)
			);

			$portfolio_category_typography_row = $portfolio_category_typography_section->add_row_element(
				array(
					'name'  => 'qodef_portfolio_category_typography_row',
					'title' => esc_html__( 'Portfolio List Category Styles', 'qode-essential-addons' ),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_portfolio_category_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_portfolio_category_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_category_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_category_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_category_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_category_font_weight',
					'title'      => esc_html__( 'Font Weight', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_category_text_transform',
					'title'      => esc_html__( 'Text Transform', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_category_font_style',
					'title'      => esc_html__( 'Font Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_category_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_link_typography_row = $portfolio_category_typography_section->add_row_element(
				array(
					'name'  => 'qodef_portfolio_category_link_typography_row',
					'title' => esc_html__( 'Portfolio List Category Hover Styles', 'qode-essential-addons' ),
				)
			);

			$portfolio_category_link_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_portfolio_category_hover_color',
					'title'      => esc_html__( 'Link Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_category_hover_text_decoration',
					'title'      => esc_html__( 'Link Hover Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_category_link_typography_row->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_category_hover_text_decoration_draw',
					'title'       => esc_html__( 'Draw Hover Text Decoration', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
					'description' => esc_html__( 'Initial text decoration will be ignored', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_section = $portfolio_info_tab->add_section_element(
				array(
					'name'  => 'qodef_general_typography_portfolio_info',
					'title' => esc_html__( 'General Typography', 'qode-essential-addons' ),
				)
			);

			$portfolio_label_typography_row = $portfolio_info_typography_section->add_row_element(
				array(
					'name'  => 'qodef_portfolio_label_typography_row',
					'title' => esc_html__( 'Portfolio Info Label Styles', 'qode-essential-addons' ),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_portfolio_label_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_portfolio_label_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_label_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_label_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_label_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_label_font_weight',
					'title'      => esc_html__( 'Font Weight', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_label_text_transform',
					'title'      => esc_html__( 'Text Transform', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_label_font_style',
					'title'      => esc_html__( 'Font Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_label_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_label_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_label_margin_bottom',
					'title'      => esc_html__( 'Margin Bottom', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$portfolio_info_typography_row = $portfolio_info_typography_section->add_row_element(
				array(
					'name'  => 'qodef_portfolio_info_typography_row',
					'title' => esc_html__( 'Portfolio Info Styles', 'qode-essential-addons' ),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_portfolio_info_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_portfolio_info_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_info_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_info_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_info_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_info_font_weight',
					'title'      => esc_html__( 'Font Weight', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_info_text_transform',
					'title'      => esc_html__( 'Text Transform', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_info_font_style',
					'title'      => esc_html__( 'Font Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_info_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_link_typography_row = $portfolio_info_typography_section->add_row_element(
				array(
					'name'  => 'qodef_portfolio_info_link_typography_row',
					'title' => esc_html__( 'Portfolio Info Link Styles', 'qode-essential-addons' ),
				)
			);

			$portfolio_info_link_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_portfolio_info_hover_color',
					'title'      => esc_html__( 'Link Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_link_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_portfolio_info_hover_text_decoration',
					'title'      => esc_html__( 'Link Hover Text Decoration', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$portfolio_info_link_typography_row->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_info_hover_text_decoration_draw',
					'title'       => esc_html__( 'Draw Hover Text Decoration', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
					'description' => esc_html__( 'Initial text decoration will be ignored', 'qode-essential-addons' ),
					'args'        => array(
						'col_width' => 3,
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_portfolio_typography_options_map', $portfolio_info_tab );
		}
	}

	add_action( 'qode_essential_addons_action_after_portfolio_options_map', 'qode_essential_addons_add_portfolio_info_typography_options' );
}
