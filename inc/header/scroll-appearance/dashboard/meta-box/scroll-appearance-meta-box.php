<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_scroll_appearance_header_meta_options' ) ) {
	/**
	 * Function that add header meta options for this module
	 */
	function qode_essential_addons_add_scroll_appearance_header_meta_options( $header_tab, $custom_sidebars ) {

		if ( $header_tab ) {

			$section = $header_tab->add_section_element(
				array(
					'name'       => 'qodef_header_scroll_appearance_section',
					'title'      => esc_html__( 'Scroll Appearance Section', 'qode-essential-addons' ),
					'dependency' => array(
						'hide' => array(
							'qodef_header_layout' => array(
								'values'        => qode_essential_addons_dependency_for_scroll_appearance_options(),
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
					'field_type'  => 'select',
					'name'        => 'qodef_header_scroll_appearance',
					'title'       => esc_html__( 'Header Scroll Appearance', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose how header will act on scroll', 'qode-essential-addons' ),
					'options'     => apply_filters(
						'qode_essential_addons_filter_header_scroll_appearance_option',
						array(
							''     => esc_html__( 'Default', 'qode-essential-addons' ),
							'none' => esc_html__( 'None', 'qode-essential-addons' ),
						)
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_header_scroll_appearance_meta_options_map', $section, $custom_sidebars );
		}
	}

	add_action( 'qode_essential_addons_action_after_page_header_meta_map', 'qode_essential_addons_add_scroll_appearance_header_meta_options', 15, 2 );
}
