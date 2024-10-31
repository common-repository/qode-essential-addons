<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_page_logo_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_page_logo_meta_box( $page ) {

		if ( $page ) {

			$logo_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-logo',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Logo Settings', 'qode-essential-addons' ),
				)
			);

			$header_logo_section = $logo_tab->add_section_element(
				array(
					'name' => 'qodef_header_logo_section',
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a height for the logo', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_padding',
					'title'       => esc_html__( 'Logo Padding', 'qode-essential-addons' ),
					'description' => esc_html__( 'Input values for default logo padding (top right bottom left)', 'qode-essential-addons' ),
				)
			);

			$logo_source = apply_filters(
				'qode_essential_addons_filter_logo_sources',
				array(
					''      => esc_html__( 'Default', 'qode-essential-addons' ),
					'image' => esc_html__( 'Image', 'qode-essential-addons' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_logo_source',
					'title'         => esc_html__( 'Logo Source', 'qode-essential-addons' ),
					'options'       => $logo_source,
					'args'          => array(
						'custom_class' => ( count( $logo_source ) <= 2 ) ? 'qodef-hidden' : '',
					),
					'default_value' => '',
				)
			);

			$logo_image_section = $header_logo_section->add_section_element(
				array(
					'name'       => 'qodef_logo_image_section',
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
								'values'        => array( 'image', '' ),
								'default_value' => '',
							),
						),
					),
				)
			);

			$logo_image_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_main',
					'title'       => esc_html__( 'Logo - Main', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose main logo image', 'qode-essential-addons' ),
					'multiple'    => 'no',
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_page_logo_meta_map', $logo_tab, $header_logo_section );
		}
	}

	add_action( 'qode_essential_addons_action_after_general_meta_box_map', 'qode_essential_addons_add_page_logo_meta_box' );
}

if ( ! function_exists( 'qode_essential_addons_add_general_logo_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function qode_essential_addons_add_general_logo_meta_box_callback( $callbacks ) {
		$callbacks['logo'] = 'qode_essential_addons_add_page_logo_meta_box';

		return $callbacks;
	}

	add_filter( 'qode_essential_addons_filter_general_meta_box_callbacks', 'qode_essential_addons_add_general_logo_meta_box_callback' );
}
