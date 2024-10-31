<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_top_area_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_header_tab
	 */
	function qode_essential_addons_add_top_area_options( $page, $general_header_tab ) {

		$top_area_section = $general_header_tab->add_section_element(
			array(
				'name'       => 'qodef_top_area_section',
				'title'      => esc_html__( 'Top Area', 'qode-essential-addons' ),
				'dependency' => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values'        => qode_essential_addons_dependency_for_top_area_options(),
							'default_value' => apply_filters( 'qode_essential_addons_filter_header_layout_default_option_value', '' ),
						),
					),
				),
			)
		);

		$top_area_section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_top_area_header',
				'title'         => esc_html__( 'Top Area', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Enable top area', 'qode-essential-addons' ),
			)
		);

		$top_area_options_section = $top_area_section->add_section_element(
			array(
				'name'       => 'qodef_top_area_options_section',
				'dependency' => array(
					'show' => array(
						'qodef_top_area_header' => array(
							'values'        => 'yes',
							'default_value' => 'no',
						),
					),
				),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_top_area_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Set content to be in grid', 'qode-essential-addons' ),
				'default_value' => 'no',
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_set_top_area_header_content_alignment',
				'title'       => esc_html__( 'Content Alignment', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set widgets content alignment inside top header area', 'qode-essential-addons' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'qode-essential-addons' ),
					'center' => esc_html__( 'Center', 'qode-essential-addons' ),
				),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_height',
				'title'       => esc_html__( 'Top Area Height', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a height for the top area (default value is 40px)', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
				),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type' => 'text',
				'name'       => 'qodef_top_area_header_side_padding',
				'title'      => esc_html__( 'Top Area Side Padding', 'qode-essential-addons' ),
				'args'       => array(
					'suffix' => esc_html__( 'px or %', 'qode-essential-addons' ),
				),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_background_color',
				'title'       => esc_html__( 'Top Area Background Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a default background color for the top area', 'qode-essential-addons' ),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_border_color',
				'title'       => esc_html__( 'Top Area Border Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a border color for the top area', 'qode-essential-addons' ),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_border_width',
				'title'       => esc_html__( 'Top Area Border Width', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a width for the top area border', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
				),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_top_area_header_border_style',
				'title'       => esc_html__( 'Top Area Border Style', 'qode-essential-addons' ),
				'description' => esc_html__( 'Choose top area border style', 'qode-essential-addons' ),
				'options'     => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_top_area_header_widgets_skin',
				'title'       => esc_html__( 'Widgets Skin', 'qode-essential-addons' ),
				'description' => esc_html__( 'Choose a predefined widget stylization for top area widget elements', 'qode-essential-addons' ),
				'options'     => array(
					''      => esc_html__( 'Default', 'qode-essential-addons' ),
					'light' => esc_html__( 'Light', 'qode-essential-addons' ),
					'white' => esc_html__( 'White', 'qode-essential-addons' ),
				),
			)
		);

		do_action( 'qode_essential_addons_action_after_top_area_header_options_map', $top_area_options_section );
	}

	add_action( 'qode_essential_addons_action_after_header_options_map', 'qode_essential_addons_add_top_area_options', 20, 2 );
}
