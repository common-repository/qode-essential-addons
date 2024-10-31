<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function qode_essential_addons_include_portfolio_single_post_navigation_template() {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo apply_filters( 'qode_essential_addons_filter_single_post_navigation_template', qode_essential_addons_get_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' ) );
	}

	add_action( 'qode_essential_addons_action_after_portfolio_single_item', 'qode_essential_addons_include_portfolio_single_post_navigation_template' );
}

if ( ! function_exists( 'qode_essential_addons_portfolio_navigation_classes' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function qode_essential_addons_portfolio_navigation_classes( $classes ) {
		$classes[] = 'qodef-m-inner';

		return $classes;
	}

	add_action( 'qode_essential_addons_filter_portfolio_navigation_classes', 'qode_essential_addons_portfolio_navigation_classes' );
}

if ( ! function_exists( 'qode_essential_addons_portfolio_navigation_holder_classes' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function qode_essential_addons_portfolio_navigation_holder_classes( $classes ) {
		$classes[] = 'qodef-m-holder';

		return $classes;
	}

	add_action( 'qode_essential_addons_filter_portfolio_navigation_holder_classes', 'qode_essential_addons_portfolio_navigation_holder_classes' );
}
