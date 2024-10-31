<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_single_navigation_options' ) ) {
	/**
	 * Function that add additional custom post type single global options
	 *
	 * @param object $page
	 */
	function qode_essential_addons_add_portfolio_single_navigation_options( $page ) {

		if ( $page ) {

			$section_navigation = $page->add_section_element(
				array(
					'name'        => 'qodef_portfolio_navigation_section',
					'title'       => esc_html__( 'Navigation Settings', 'qode-essential-addons' ),
					'description' => esc_html__( 'Navigation that will be displayed on portfolio page', 'qode-essential-addons' ),
				)
			);

			$section_navigation->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_enable_navigation',
					'title'         => esc_html__( 'Navigation', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will turn on portfolio navigation functionality', 'qode-essential-addons' ),
					'default_value' => 'yes',
				)
			);

			$section_navigation->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_navigation_through_same_category',
					'title'         => esc_html__( 'Navigation Through Same Category', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Enabling this option will make portfolio navigation sort through current category', 'qode-essential-addons' ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'qodef_portfolio_enable_navigation' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							),
						),
					),
				)
			);
		}

		do_action( 'qode_essential_addons_action_after_portfolio_options_single_navigation', $page, $section_navigation );
	}

	add_action( 'qode_essential_addons_action_after_portfolio_options_single', 'qode_essential_addons_add_portfolio_single_navigation_options' );
}
