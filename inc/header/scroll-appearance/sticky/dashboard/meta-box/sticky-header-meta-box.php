<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_sticky_header_meta_options' ) ) {
	/**
	 * Function that add additional meta box options for current module
	 *
	 * @param object $section
	 */
	function qode_essential_addons_add_sticky_header_meta_options( $section ) {

		if ( $section ) {

			$sticky_section = $section->add_section_element(
				array(
					'name'       => 'qodef_sticky_header_section',
					'dependency' => array(
						'show' => array(
							'qodef_header_scroll_appearance' => array(
								'values'        => 'sticky',
								'default_value' => '',
							),
						),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_height',
					'title'       => esc_html__( 'Sticky Header Height', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a sticky header height', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sticky_header_appearance',
					'title'       => esc_html__( 'Sticky Header Appearance', 'qode-essential-addons' ),
					'description' => esc_html__( 'Select the appearance of sticky header when you scrolling the page', 'qode-essential-addons' ),
					'options'     => array(
						''     => esc_html__( 'Default', 'qode-essential-addons' ),
						'down' => esc_html__( 'Show Sticky on Scroll Down/Up', 'qode-essential-addons' ),
						'up'   => esc_html__( 'Show Sticky on Scroll Up', 'qode-essential-addons' ),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_scroll_amount',
					'title'       => esc_html__( 'Sticky Scroll Amount', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter scroll amount for sticky header to appear', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_side_padding',
					'title'       => esc_html__( 'Sticky Header Side Padding', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter side padding for sticky header area', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px or %', 'qode-essential-addons' ),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_sticky_header_background_color',
					'title'       => esc_html__( 'Sticky Header Background Color', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter sticky header background color', 'qode-essential-addons' ),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_sticky_header_border_color',
					'title'       => esc_html__( 'Sticky Header Border Color', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a border color for the sticky header', 'qode-essential-addons' ),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_border_width',
					'title'       => esc_html__( 'Sticky Header Border Width', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a width for the sticky header borders', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_sticky_header_border_style',
					'title'       => esc_html__( 'Sticky Header Border Style', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose sticky header border style', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_get_select_type_options_pool( 'border_style' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_sticky_header_meta_map', $sticky_section );

			$sticky_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_sticky_header_box_shadow',
					'title'       => esc_html__( 'Sticky Header Box Shadow', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter sticky header box shadow', 'qode-essential-addons' ),
				)
			);
		}
	}

	add_action( 'qode_essential_addons_action_after_header_scroll_appearance_meta_options_map', 'qode_essential_addons_add_sticky_header_meta_options', 10, 2 );
}

if ( ! function_exists( 'qode_essential_addons_add_sticky_header_logo_meta_options' ) ) {
	/**
	 * Function that add additional header logo meta box options
	 *
	 * @param object $logo_tab
	 * @param array $header_page
	 * @param array $logo_image_section
	 */
	function qode_essential_addons_add_sticky_header_logo_meta_options( $logo_tab, $header_page, $logo_image_section ) {

		if ( $header_page ) {
			$logo_image_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_sticky',
					'title'       => esc_html__( 'Logo - Sticky', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose sticky logo image', 'qode-essential-addons' ),
					'multiple'    => 'no',
				)
			);
		}
	}

	add_action( 'qode_essential_addons_action_after_header_logo_image_section_meta_map', 'qode_essential_addons_add_sticky_header_logo_meta_options', 10, 3 );
}

if ( ! function_exists( 'qode_essential_addons_add_sticky_header_logo_svg_meta_options' ) ) {
	/**
	 * Function that add additional header logo options
	 *
	 * @param object $page
	 * @param array $header_tab
	 * @param array $logo_svg_path_section
	 */
	function qode_essential_addons_add_sticky_header_logo_svg_meta_options( $page, $header_tab, $logo_svg_path_section ) {

		if ( $header_tab ) {
			$logo_svg_path_section->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_logo_sticky_svg_path',
					'title'       => esc_html__( 'Logo Sticky - SVG Path', 'qode-essential-addons' ),
					'description' => esc_html__( 'Enter your logo icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'qode-essential-addons' ),
				)
			);
		}
	}

	add_action( 'qode_essential_addons_action_before_header_logo_svg_path_section_meta_map', 'qode_essential_addons_add_sticky_header_logo_svg_meta_options', 10, 3 );
}
