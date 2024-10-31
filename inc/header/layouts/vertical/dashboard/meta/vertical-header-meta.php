<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_vertical_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_vertical_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_vertical_header_section',
				'title'      => esc_html__( 'Vertical Header', 'qode-essential-addons' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'vertical',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a background color for the header', 'qode-essential-addons' ),
			)
		);

		do_action( 'qode_essential_addons_action_after_vertical_header_background_color_meta_map', $section );

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a default header border color', 'qode-essential-addons' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_vertical_header_border_width',
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
				'name'        => 'qodef_vertical_header_border_style',
				'title'       => esc_html__( 'Header Border Style', 'qode-essential-addons' ),
				'description' => esc_html__( 'Choose header border style', 'qode-essential-addons' ),
				'options'     => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
			)
		);

		do_action( 'qode_essential_addons_action_after_vertical_header_meta_map', $section );
	}

	add_action( 'qode_essential_addons_action_after_page_header_meta_map', 'qode_essential_addons_add_vertical_header_meta' );
}
