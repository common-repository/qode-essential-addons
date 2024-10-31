<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_minimal_mobile_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_tab
	 */
	function qode_essential_addons_add_minimal_mobile_header_options( $page, $general_tab ) {

		$section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'qode-essential-addons' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values'        => 'minimal',
							'default_value' => 'standard',
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
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Header Height', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a default mobile header height', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set default mobile header area side padding', 'qode-essential-addons' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'qode-essential-addons' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'qode-essential-addons' ),
				'description' => esc_html__( 'Set a default mobile header background color', 'qode-essential-addons' ),
			)
		);
	}

	add_action( 'qode_essential_addons_action_after_mobile_header_options_map', 'qode_essential_addons_add_minimal_mobile_header_options', 10, 2 );
}
