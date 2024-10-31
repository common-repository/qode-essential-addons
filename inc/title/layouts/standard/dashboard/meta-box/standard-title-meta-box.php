<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_standard_title_layout_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_standard_title_layout_meta_box( $page ) {

		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'       => 'qodef_standard_title_section',
					'dependency' => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => array( '', 'standard' ),
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
					'field_type' => 'text',
					'name'       => 'qodef_page_title_subtitle',
					'title'      => esc_html__( 'Subtitle', 'qode-essential-addons' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_subtitle_tag',
					'title'         => esc_html__( 'Subtitle Tag', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'title_tag', false ),
					'default_value' => 'p',
				)
			);

			$section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_subtitle_color',
					'title'      => esc_html__( 'Subtitle Color', 'qode-essential-addons' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_page_title_subtitle_top_margin',
					'title'      => esc_html__( 'Subtitle Top Margin', 'qode-essential-addons' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_standard_title_layout_meta_box_map', $section );
		}
	}

	add_action( 'qode_essential_addons_action_after_page_title_meta_box_map', 'qode_essential_addons_add_standard_title_layout_meta_box' );
}
