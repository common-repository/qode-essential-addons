<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_single_navigation_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 */
	function qode_essential_addons_add_portfolio_single_navigation_meta_box( $page, $general_tab ) {

		if ( $page ) {

			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_back_to_link',
					'title'       => esc_html__( 'Back To Link', 'qode-essential-addons' ),
					'description' => esc_html__( 'Choose "Back To" page to link from album single', 'qode-essential-addons' ),
					'options'     => qode_essential_addons_framework_get_pages( true ),
				)
			);
		}
	}

	add_action( 'qode_essential_addons_action_after_portfolio_meta_box_map', 'qode_essential_addons_add_portfolio_single_navigation_meta_box', 10, 2 );
}
