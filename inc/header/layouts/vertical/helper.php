<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_vertical_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function qode_essential_addons_add_vertical_header_global_option( $header_layout_options ) {
		$header_layout_options['vertical'] = array(
			'image' => QODE_ESSENTIAL_ADDONS_HEADER_LAYOUTS_URL_PATH . '/vertical/assets/img/vertical-header.png',
			'label' => esc_html__( 'Vertical', 'qode-essential-addons' ),
		);

		return $header_layout_options;
	}

	add_filter( 'qode_essential_addons_filter_header_layout_option', 'qode_essential_addons_add_vertical_header_global_option' );
}

if ( ! function_exists( 'qode_essential_addons_register_vertical_header_layout' ) ) {
	/**
	 * Function which add header layout into global list
	 *
	 * @param array $header_layouts
	 *
	 * @return array
	 */
	function qode_essential_addons_register_vertical_header_layout( $header_layouts ) {
		$header_layouts['vertical'] = 'QodeEssentialAddons_Vertical_Header';

		return $header_layouts;
	}

	add_filter( 'qode_essential_addons_filter_register_header_layouts', 'qode_essential_addons_register_vertical_header_layout' );
}

if ( ! function_exists( 'qode_essential_addons_vertical_header_nav_menu_grid' ) ) {
	/**
	 * Function which set grid class name for current header layout
	 *
	 * @param string $grid_class
	 *
	 * @return string
	 */
	function qode_essential_addons_vertical_header_nav_menu_grid( $grid_class ) {
		$header = qode_essential_addons_get_post_value_through_levels( 'qodef_header_layout' );

		if ( 'vertical' === $header ) {
			return false;
		}

		return $grid_class;
	}

	add_filter( 'qode_essential_addons_filter_drop_down_grid', 'qode_essential_addons_vertical_header_nav_menu_grid' );
}

if ( ! function_exists( 'qode_essential_addons_register_vertical_menu' ) ) {
	/**
	 * Function which add additional main menu navigation into global list
	 *
	 * @param array $menus
	 *
	 * @return array
	 */
	function qode_essential_addons_register_vertical_menu( $menus ) {
		$menus['vertical-menu-navigation'] = esc_html__( 'Vertical Navigation', 'qode-essential-addons' );

		return $menus;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_register_navigation_menus', 'qode_essential_addons_register_vertical_menu' );
	add_filter( 'the_q_filter_register_navigation_menus', 'qode_essential_addons_register_vertical_menu' );
	add_filter( 'qi_filter_register_navigation_menus', 'qode_essential_addons_register_vertical_menu' );
	add_filter( 'qi_gutenberg_filter_register_navigation_menus', 'qode_essential_addons_register_vertical_menu' );
}

if ( ! function_exists( 'qode_essential_addons_vertical_header_hide_top_area' ) ) {
	/**
	 * Function that set dependency option value for specific module layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function qode_essential_addons_vertical_header_hide_top_area( $options ) {
		$options[] = 'vertical';

		return $options;
	}

	add_filter( 'qode_essential_addons_filter_top_area_hide_option', 'qode_essential_addons_vertical_header_hide_top_area' );
}

if ( ! function_exists( 'qode_essential_addons_vertical_header_hide_scroll_appearance' ) ) {
	/**
	 * Function that set dependency option value for specific module layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function qode_essential_addons_vertical_header_hide_scroll_appearance( $options ) {
		$options[] = 'vertical';

		return $options;
	}

	add_filter( 'qode_essential_addons_filter_header_scroll_appearance_hide_option', 'qode_essential_addons_vertical_header_hide_scroll_appearance' );
}
