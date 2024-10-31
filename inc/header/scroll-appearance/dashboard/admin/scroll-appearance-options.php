<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_scroll_appearance_header_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_scroll_appearance_header_options( $page ) {

		if ( $page ) {
			$scroll_appearance_tab = $page->add_tab_element(
				array(
					'name'       => 'tab-header-scroll-appearance',
					'icon'       => 'fa fa-cog',
					'title'      => esc_html__( 'Scroll Appearance Settings', 'qode-essential-addons' ),
					'dependency' => array(
						'hide' => array(
							'qodef_header_layout' => array(
								'values'        => qode_essential_addons_dependency_for_scroll_appearance_options(),
								'default_value' => apply_filters( 'qode_essential_addons_filter_header_layout_default_option_value', '' ),
							),
						),
					),
				)
			);

			$section = $scroll_appearance_tab->add_section_element(
				array(
					'name' => 'qodef_header_scroll_appearance_section',
				)
			);

			$section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_header_scroll_appearance',
					'title'         => esc_html__( 'Header Scroll Appearance', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose how header will act on scroll', 'qode-essential-addons' ),
					'options'       => apply_filters( 'qode_essential_addons_filter_header_scroll_appearance_option', array( 'none' => esc_html__( 'None', 'qode-essential-addons' ) ) ),
					'default_value' => 'none',
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_header_scroll_appearance_options_map', $page, $section );
		}
	}

	add_action( 'qode_essential_addons_action_after_header_options_map', 'qode_essential_addons_add_scroll_appearance_header_options', 15 );
}
