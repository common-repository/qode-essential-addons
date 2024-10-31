<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_mobile_logo_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 * @param object $mobile_header_tab
	 */
	function qode_essential_addons_add_mobile_logo_options( $page, $mobile_header_tab ) {

		if ( $page ) {

			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-mobile-header',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Mobile Header Logo Options', 'qode-essential-addons' ),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_height',
					'title'       => esc_html__( 'Mobile Logo Height', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a default height for mobile logo', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_padding',
					'title'       => esc_html__( 'Mobile Logo Padding', 'qode-essential-addons' ),
					'description' => esc_html__( 'Input default values for mobile logo padding (top right bottom left)', 'qode-essential-addons' ),
				)
			);

			$logo_source = apply_filters( 'qode_essential_addons_filter_mobile_logo_sources', array( 'image' => esc_html__( 'Image', 'qode-essential-addons' ) ) );

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_mobile_logo_source',
					'title'         => esc_html__( 'Mobile Logo Source', 'qode-essential-addons' ),
					'options'       => $logo_source,
					'args'          => array(
						'custom_class' => ( count( $logo_source ) === 1 ) ? 'qodef-hidden' : '',
					),
					'default_value' => 'image',
				)
			);

			$logo_image_section = $mobile_header_tab->add_section_element(
				array(
					'name'       => 'qodef_mobile_logo_image_section',
					'dependency' => array(
						'show' => array(
							'qodef_mobile_logo_source' => array(
								'values'        => 'image',
								'default_value' => 'image',
							),
						),
					),
				)
			);

			$logo_image_section->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_mobile_logo_main',
					'title'         => esc_html__( 'Mobile Logo', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose main mobile logo image', 'qode-essential-addons' ),
					'default_value' => '',
					'multiple'      => 'no',
				)
			);

			// Hook to include additional options after section part.
			do_action( 'qode_essential_addons_action_after_mobile_logo_image_section_options_map', $page, $mobile_header_tab, $logo_image_section );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_mobile_logo_options_map', $page );
		}
	}

	add_action( 'qode_essential_addons_action_after_header_logo_options_map', 'qode_essential_addons_add_mobile_logo_options', 10, 2 );
}
