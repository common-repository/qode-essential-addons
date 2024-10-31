<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_logo_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_logo_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Logo Options', 'qode-essential-addons' ),
				'layout'      => 'tabbed',
			)
		);

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Header Logo Options', 'qode-essential-addons' ),
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'qode-essential-addons' ),
					'description' => esc_html__( 'Set a default logo height', 'qode-essential-addons' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_padding',
					'title'       => esc_html__( 'Logo Padding', 'qode-essential-addons' ),
					'description' => esc_html__( 'Input values for default logo padding (top right bottom left)', 'qode-essential-addons' ),
				)
			);

			$logo_source = apply_filters( 'qode_essential_addons_filter_logo_sources', array( 'image' => esc_html__( 'Image', 'qode-essential-addons' ) ) );

			$header_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_logo_source',
					'title'         => esc_html__( 'Logo Source', 'qode-essential-addons' ),
					'options'       => $logo_source,
					'args'          => array(
						'custom_class' => ( count( $logo_source ) === 1 ) ? 'qodef-hidden' : '',
					),
					'default_value' => 'image',
				)
			);

			$logo_image_section = $header_tab->add_section_element(
				array(
					'name'       => 'qodef_logo_image_section',
					'dependency' => array(
						'show' => array(
							'qodef_logo_source' => array(
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
					'name'          => 'qodef_logo_main',
					'title'         => esc_html__( 'Logo - Main', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose main logo image', 'qode-essential-addons' ),
					'default_value' => apply_filters( 'qode_essential_addons_filter_default_logo_image', '' ),
					'multiple'      => 'no',
				)
			);

			// Hook to include additional options after section part.
			do_action( 'qode_essential_addons_action_after_header_logo_image_section_options_map', $page, $header_tab, $logo_image_section );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_header_logo_options_map', $page, $header_tab );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_logo_options', qode_essential_addons_get_admin_options_map_position( 'logo' ) );
}
