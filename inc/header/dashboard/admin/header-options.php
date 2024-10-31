<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_header_options' ) ) {
	/**
	 * Function that add header options for this module
	 */
	function qode_essential_addons_add_header_options() {
		$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

		$page = $qode_essential_addons_framework->add_options_page(
			array(
				'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Header', 'qode-essential-addons' ),
				'description' => esc_html__( 'Global Header Options', 'qode-essential-addons' ),
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'qode-essential-addons' ),
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_header_layout',
					'title'         => esc_html__( 'Header Layout', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Choose a header layout to set for your website', 'qode-essential-addons' ),
					'args'          => array( 'images' => true ),
					'options'       => apply_filters( 'qode_essential_addons_filter_header_layout_option', $header_layout_options = array() ),
					'default_value' => apply_filters( 'qode_essential_addons_filter_header_layout_default_option_value', '' ),
				)
			);

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'qode_essential_addons_action_default_options_init', 'qode_essential_addons_add_header_options', qode_essential_addons_get_admin_options_map_position( 'header' ) );
}
