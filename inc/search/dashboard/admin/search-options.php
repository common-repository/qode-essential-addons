<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_search_options' ) ) {
	/**
	 * Function that add global options for current module
	 */
	function qode_essential_addons_search_options() {
		$qode_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'search',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Search', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Search Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_search_background_color',
					'title'      => esc_html__( 'Search Area Background Color', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_search_border_color',
					'title'      => esc_html__( 'Search Border Color', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_border_width',
					'title'      => esc_html__( 'Search Border Width', 'qode-essential-addons' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_search_border_style',
					'title'      => esc_html__( 'Search Border Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_search_icon_svg_path',
					'title'       => esc_html__( 'Search Open Icon SVG Path', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your search open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'qode-essential-addons' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_search_close_icon_svg_path',
					'title'       => esc_html__( 'Search Close Icon SVG Path', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your search close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'qode-essential-addons' ),
				)
			);

			$opener_section = $page->add_section_element(
				array(
					'name'  => 'qodef_search_opener_section',
					'title' => esc_html__( 'Search Open Icon', 'qode-essential-addons' ),
				)
			);

			$opener_section_row = $opener_section->add_row_element(
				array(
					'name'  => 'qodef_search_opener_row',
					'title' => esc_html__( 'Open Icon Styles', 'qode-essential-addons' ),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_search_opener_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_search_opener_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_opener_size',
					'title'      => esc_html__( 'Icon Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_search_opener_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_opener_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_opener_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_opener_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_search_opener_font_weight',
					'title'      => esc_html__( 'Font Weight', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_search_opener_text_transform',
					'title'      => esc_html__( 'Text Transform', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_search_opener_font_style',
					'title'      => esc_html__( 'Font Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$close_icon_section = $page->add_section_element(
				array(
					'name'  => 'qodef_search_close_icon_section',
					'title' => esc_html__( 'Search Close Icon', 'qode-essential-addons' ),
				)
			);

			$close_icon_section_row = $close_icon_section->add_row_element(
				array(
					'name'  => 'qodef_search_close_icon_row',
					'title' => esc_html__( 'Close Icon Styles', 'qode-essential-addons' ),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_search_close_icon_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_search_close_icon_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$close_icon_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_close_icon_size',
					'title'      => esc_html__( 'Icon Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$input_field_section = $page->add_section_element(
				array(
					'name'  => 'qodef_search_input_field_section',
					'title' => esc_html__( 'Search Input Field', 'qode-essential-addons' ),
				)
			);

			$input_field_section_row = $input_field_section->add_row_element(
				array(
					'name'  => 'qodef_search_input_field_row',
					'title' => esc_html__( 'Open Input Field Styles', 'qode-essential-addons' ),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_search_input_field_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_search_input_field_focus_color',
					'title'      => esc_html__( 'Focus Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_search_input_field_font_family',
					'title'      => esc_html__( 'Font Family', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_input_field_font_size',
					'title'      => esc_html__( 'Font Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_input_field_line_height',
					'title'      => esc_html__( 'Line Height', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_search_input_field_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_search_input_field_font_weight',
					'title'      => esc_html__( 'Font Weight', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_search_input_field_text_transform',
					'title'      => esc_html__( 'Text Transform', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$input_field_section_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_search_input_field_font_style',
					'title'      => esc_html__( 'Font Style', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_search_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_search_options', qode_essential_addons_get_admin_options_map_position( 'search' ) );
}
