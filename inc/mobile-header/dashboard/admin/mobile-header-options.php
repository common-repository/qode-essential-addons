<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_mobile_header_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_mobile_header_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'mobile-header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Mobile Header', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Mobile Header Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-mobile-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'qode-essential-addons' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_mobile_header_layout',
					'title'         => esc_html__( 'Mobile Header Layout', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose a mobile header layout to set for your website', 'qode-essential-addons' ),
					'args'          => array( 'images' => true ),
					'default_value' => apply_filters( 'qode_essential_addons_filter_mobile_header_layout_default_option', '' ),
					'options'       => apply_filters( 'qode_essential_addons_filter_mobile_header_layout_option', $mobile_header_layout_options = array() ),
				)
			);

			$opener_section = $general_tab->add_section_element(
				array(
					'name'  => 'qodef_mobile_header_opener_section',
					'title' => esc_html__( 'Mobile Header Open Icon Styles', 'qode-essential-addons' ),
				)
			);

			$opener_section_row = $opener_section->add_row_element(
				array(
					'name' => 'qodef_mobile_header_opener_row',
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_header_opener_color',
					'title'      => esc_html__( 'Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_mobile_header_opener_hover_color',
					'title'      => esc_html__( 'Hover Color', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$opener_section_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_mobile_header_opener_size',
					'title'      => esc_html__( 'Icon Size', 'qode-essential-addons' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'qode-essential-addons' ),
					),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_mobile_header_opener_options_map', $opener_section_row );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_mobile_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_mobile_header_options', qode_essential_addons_get_admin_options_map_position( 'mobile-header' ) );
}
