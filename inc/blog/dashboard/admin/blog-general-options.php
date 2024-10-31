<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_blog_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function qode_essential_addons_add_blog_general_options( $page ) {

		if ( $page ) {

			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-blog-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General', 'qode-essential-addons' ),
				)
			);

			$quote_link_section = $general_tab->add_section_element(
				array(
					'name'  => 'qodef_blog_quote_link',
					'title' => esc_html__( 'Quote/Link', 'qode-essential-addons' ),
				)
			);

			$quote_link_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_blog_list_quote_link_tag',
					'title'         => esc_html__( 'Quote/Link Title Tag', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'title_tag' ),
					'default_value' => '',
				)
			);
			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_blog_list_quote_link_end_options_map', $quote_link_section );

			// Hook to include additional options after module options.
			do_action( 'qode_essential_addons_action_after_blog_list_general_options_map', $general_tab );
		}
	}

	add_action( 'qode_essential_addons_action_before_blog_options_map', 'qode_essential_addons_add_blog_general_options' );
}
