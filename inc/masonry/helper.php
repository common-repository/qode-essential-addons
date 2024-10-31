<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_register_masonry_scripts' ) ) {
	/**
	 * Function that include modules 3rd party scripts
	 */
	function qode_essential_addons_register_masonry_scripts() {
		wp_register_script( 'isotope', QODE_ESSENTIAL_ADDONS_INC_URL_PATH . '/masonry/assets/js/plugins/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
		wp_register_script( 'packery', QODE_ESSENTIAL_ADDONS_INC_URL_PATH . '/masonry/assets/js/plugins/packery-mode.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
	}

	add_action( 'qode_essential_addons_action_before_main_js', 'qode_essential_addons_register_masonry_scripts' );
}

if ( ! function_exists( 'qode_essential_addons_include_masonry_scripts' ) ) {
	/**
	 * Function that include modules 3rd party scripts
	 */
	function qode_essential_addons_include_masonry_scripts() {
		wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'packery' );
	}
}

if ( ! function_exists( 'qode_essential_addons_enqueue_masonry_scripts_for_shortcodes' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts for shortcodes
	 *
	 * @param array $atts
	 */
	function qode_essential_addons_enqueue_masonry_scripts_for_shortcodes( $atts ) {

		if ( isset( $atts['behavior'] ) && 'masonry' === $atts['behavior'] ) {
			qode_essential_addons_include_masonry_scripts();
		}
	}

	add_action( 'qode_essential_addons_action_list_shortcodes_load_assets', 'qode_essential_addons_enqueue_masonry_scripts_for_shortcodes' );
}

if ( ! function_exists( 'qode_essential_addons_register_masonry_scripts_for_list_shortcodes' ) ) {
	/**
	 * Function that set module 3rd party scripts for list shortcodes
	 *
	 * @param array $scripts
	 *
	 * @return array
	 */
	function qode_essential_addons_register_masonry_scripts_for_list_shortcodes( $scripts ) {

		$scripts['isotope'] = array(
			'registered' => true,
		);
		$scripts['packery'] = array(
			'registered' => true,
		);

		return $scripts;
	}

	add_filter( 'qode_essential_addons_filter_register_list_shortcode_scripts', 'qode_essential_addons_register_masonry_scripts_for_list_shortcodes' );
}
