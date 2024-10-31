<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_minimal_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_minimal_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_header_section',
				'title'      => esc_html__( 'Minimal Header', 'qode-essential-addons' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'minimal',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_minimal_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Set content to be in grid', 'qode-essential-addons' ),
				'default_value' => '',
				'options'       => qode_essential_addons_get_select_type_options_pool( 'no_yes' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_height',
				'title'       => esc_html__( 'Header Height', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a height for the header', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set side padding for the header area', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'qode-essential-addons' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a background color for the header', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a border color for the header', 'qode-essential-addons' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_border_width',
				'title'       => esc_html__( 'Header Border Width', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a width for the header borders', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_minimal_header_border_style',
				'title'       => esc_html__( 'Header Border Style', 'qode-essential-addons' ),
				'description' => esc_html__( 'Choose header border style', 'qode-essential-addons' ),
				'options'     => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_minimal_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'qode-essential-addons' ),
				'default_value' => '',
				'options'       => array(
					''       => esc_html__( 'Default', 'qode-essential-addons' ),
					'center' => esc_html__( 'Center', 'qode-essential-addons' ),
					'right'  => esc_html__( 'Right', 'qode-essential-addons' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type' => 'select',
				'name'       => 'qodef_minimal_header_logo_centered',
				'title'      => esc_html__( 'Logo Centered', 'qode-essential-addons' ),
				'options'    => qode_essential_addons_get_select_type_options_pool( 'no_yes' ),
				'dependency' => array(
					'show' => array(
						'qodef_minimal_header_menu_position' => array(
							'values'        => 'center',
							'default_value' => '',
						),
					),
				),
				'args'       => array(
					'custom_class' => 'qodef-no-indent',
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_widgets_side_margin',
				'title'       => esc_html__( 'Header Widgets Side Margin', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a side margin size for the header widgets', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
				),
			)
		);

		// Hook to include additional options after module options.
		do_action( 'qode_essential_addons_action_after_minimal_header_meta_map', $section );
	}

	add_action( 'qode_essential_addons_action_after_page_header_meta_map', 'qode_essential_addons_add_minimal_header_meta' );
}
