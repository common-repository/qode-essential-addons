<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_choosen_google_fonts_list' ) ) {
	/**
	 * Function that returns array of custom fonts
	 *
	 * @return array
	 */
	function qode_essential_addons_choosen_google_fonts_list() {
		$google_fonts_list = array();
		$google_fonts      = qode_essential_addons_get_option_value( 'admin', 'qodef_choose_google_fonts' );

		if ( ! empty( $google_fonts ) ) {
			foreach ( $google_fonts as $google_font ) {
				$google_fonts_list[] = qode_essential_addons_framework_get_formatted_font_family( $google_font['qodef_choose_google_font'] );
			}
		}

		return $google_fonts_list;
	}
}

if ( ! function_exists( 'qode_essential_addons_add_choosen_google_fonts_to_list' ) ) {
	/**
	 * Function that returns array of custom fonts
	 *
	 * @param array $complete_fonts_array
	 *
	 * @return array
	 */
	function qode_essential_addons_add_choosen_google_fonts_to_list( $complete_fonts_array ) {
		$google_fonts_list = array();
		$google_fonts      = qode_essential_addons_choosen_google_fonts_list();

		if ( ! empty( $google_fonts ) ) {
			foreach ( $google_fonts as $google_font ) {
				$google_font_key                       = qode_essential_addons_framework_get_formatted_font_family( $google_font, true );
				$google_fonts_list[ $google_font_key ] = $google_font;
			}
		}

		return array_merge( $complete_fonts_array, $google_fonts_list );
	}

	add_filter( 'qode_essential_addons_filter_framework_complete_fonts_list', 'qode_essential_addons_add_choosen_google_fonts_to_list' );
}

if ( ! function_exists( 'qode_essential_addons_disable_google_font' ) ) {
	/**
	 * Function that remove google fonts from fonts array
	 *
	 * @param array $fonts
	 *
	 * @return array
	 */
	function qode_essential_addons_disable_google_font( $fonts ) {

		if ( 'no' === qode_essential_addons_get_post_value_through_levels( 'qodef_enable_google_fonts' ) ) {
			return array();
		}

		return $fonts;
	}

	add_filter( 'qode_essential_addons_filter_framework_google_fonts', 'qode_essential_addons_disable_google_font' );
}

if ( ! function_exists( 'qode_essential_addons_add_google_fonts_to_define_font_list' ) ) {
	/**
	 * Function that add font into global font list for font link inclusion
	 *
	 * @param array $fonts
	 *
	 * @return array
	 */
	function qode_essential_addons_add_google_fonts_to_define_font_list( $fonts ) {
		$font_field_array = qode_essential_addons_choosen_google_fonts_list();

		if ( count( $font_field_array ) > 0 ) {
			foreach ( $font_field_array as $font_option ) {
				$fonts[] = str_replace( '+', ' ', $font_option );
			}
		}

		return $fonts;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_google_fonts_list', 'qode_essential_addons_add_google_fonts_to_define_font_list' );
	add_filter( 'the_q_filter_google_fonts_list', 'qode_essential_addons_add_google_fonts_to_define_font_list' );
	add_filter( 'qi_filter_google_fonts_list', 'qode_essential_addons_add_google_fonts_to_define_font_list' );
	add_filter( 'qi_gutenberg_filter_google_fonts_list', 'qode_essential_addons_add_google_fonts_to_define_font_list' );
}

if ( ! function_exists( 'qode_essential_addons_add_weights_to_font_weight_list' ) ) {
	/**
	 * Function that add font weight into global font list for font link inclusion
	 *
	 * @param array $font_weights
	 *
	 * @return array
	 */
	function qode_essential_addons_add_weights_to_font_weight_list( $font_weights ) {
		$options = qode_essential_addons_get_post_value_through_levels( 'qodef_google_fonts_weight' );

		if ( ! empty( $options ) ) {
			$font_weights = array_merge( $font_weights, array_filter( $options, 'strlen' ) );
		}

		return $font_weights;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_google_fonts_weight_list', 'qode_essential_addons_add_weights_to_font_weight_list' );
	add_filter( 'the_q_filter_google_fonts_weight_list', 'qode_essential_addons_add_weights_to_font_weight_list' );
	add_filter( 'qi_filter_google_fonts_weight_list', 'qode_essential_addons_add_weights_to_font_weight_list' );
	add_filter( 'qi_gutenberg_filter_google_fonts_weight_list', 'qode_essential_addons_add_weights_to_font_weight_list' );
}

if ( ! function_exists( 'qode_essential_addons_add_subsets_to_subset_list' ) ) {
	/**
	 * Function that add font subsets into global font list for font link inclusion
	 *
	 * @param array $font_subsets
	 *
	 * @return array
	 */
	function qode_essential_addons_add_subsets_to_subset_list( $font_subsets ) {
		$options = qode_essential_addons_get_post_value_through_levels( 'qodef_google_fonts_subset' );

		if ( ! empty( $options ) ) {
			$font_subsets = array_merge( $font_subsets, array_filter( $options, 'strlen' ) );
		}

		return $font_subsets;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_google_fonts_subset_list', 'qode_essential_addons_add_subsets_to_subset_list' );
	add_filter( 'the_q_filter_google_fonts_subset_list', 'qode_essential_addons_add_subsets_to_subset_list' );
	add_filter( 'qi_filter_google_fonts_subset_list', 'qode_essential_addons_add_subsets_to_subset_list' );
	add_filter( 'qi_gutenberg_filter_google_fonts_subset_list', 'qode_essential_addons_add_subsets_to_subset_list' );
}
