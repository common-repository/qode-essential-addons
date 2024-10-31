<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_demos_list' ) ) {
	/**
	 * Function that return list of demoes if exists
	 *
	 * @return array
	 */
	function qode_essential_addons_demos_list( $list_type = 'demos' ) {
		$demos           = array();
		$transient_name  = 'qode_essential_addons_demos_list_' . str_replace( '.', '_', QODE_ESSENTIAL_ADDONS_VERSION );
		$transient_value = get_transient( $transient_name );

		if ( false !== $transient_value ) {
			$demos = $transient_value;
		} else {

			if ( ini_get( 'allow_url_fopen' ) && defined( 'QI_INC_ROOT' ) ) {
				// phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged, WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
				$demos_file_content = @file_get_contents( QODE_ESSENTIAL_ADDONS_DEMOS_JSON . '/demos.json' );

				if ( ! empty( $demos_file_content ) ) {
					$demos = json_decode( $demos_file_content, true );
				}
			}
		}

		if ( ! empty( $demos ) ) {
			set_transient( $transient_name, $demos, MONTH_IN_SECONDS );
		}

		$demos = apply_filters( 'qode_essential_addons_filter_demos_list', $demos );

		if ( isset( $demos[ $list_type ] ) ) {
			return $demos[ $list_type ];
		}

		return $demos;
	}
}

if ( ! function_exists( 'qode_essential_addons_demos_list_has_elements' ) ) {
	/**
	 * Function that check is demos list has elements
	 *
	 * @return bool
	 */
	function qode_essential_addons_demos_list_has_elements( $has_elements ) {
		$demos = qode_essential_addons_demos_list();
		if ( ! empty( $demos ) ) {
			$has_elements = true;
		}

		return $has_elements;
	}

	add_filter( 'qode_essential_addons_filter_import_visible', 'qode_essential_addons_demos_list_has_elements' );
}

if ( ! function_exists( 'qode_essential_addons_decode_content' ) ) {
	/**
	 * Function that decode content
	 *
	 * @return array/bool
	 */
	function qode_essential_addons_decode_content( $url ) {
		$content = qode_essential_addons_get_file_content( $url );

		if ( false !== $content ) {
			$decoded_content = json_decode( $content, true );

			return $decoded_content;
		}

		return false;
	}
}
if ( ! function_exists( 'qode_essential_addons_get_file_content' ) ) {
	/**
	 * Function that return file content
	 *
	 * @return bool
	 */
	function qode_essential_addons_get_file_content( $url ) {
		$response = wp_remote_get( $url );

		if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
			return wp_remote_retrieve_body( $response );
		}

		return false;
	}
}

if ( ! function_exists( 'qode_essential_addons_demos_prepare_list_of_search_predictions' ) ) {
	function qode_essential_addons_demos_prepare_list_of_search_predictions( $global_variables ) {
		$category_names = array();
		$color_names    = array();
		$demo_names     = array();

		// remove white space from beginning of string.
		$regex = '/^\s+/m';

		$categories = qode_essential_addons_demos_list( 'categories' );
		foreach ( $categories as $slug => $name ) {
			$category_names[] = preg_replace( $regex, '', $name );
		}

		$colors = qode_essential_addons_demos_list( 'colors' );
		foreach ( $colors as $slug => $name ) {
			$color_names[] = preg_replace( $regex, '', $name );
		}

		$tags = qode_essential_addons_demos_list( 'tags' );
		foreach ( $tags as $slug => $name ) {
			$demo_names[] = preg_replace( $regex, '', $name );
		}

		$demos = qode_essential_addons_demos_list();
		foreach ( $demos as $demo ) {
			$demo_names[] = preg_replace( $regex, '', $demo['demo_name'] );
		}

		$global_variables['demosSearchPredictions'] = array_merge( $category_names, $color_names, $demo_names );

		return $global_variables;
	}

	add_filter( 'qode_essential_addons_filter_localize_import_js', 'qode_essential_addons_demos_prepare_list_of_search_predictions' );
}

if ( ! function_exists( 'qode_essential_addons_prepare_demos_options_for_import' ) ) {
	function qode_essential_addons_prepare_demos_options_for_import( array $options ) {

		if ( count( $options ) > 0 ) {

			foreach ( $options as $option_key => $option_value ) {
				if ( empty( $option_value['file_url'] ) ) {
					unset( $options[ $option_key ] );
				}
			}
		}

		return $options;
	}
}
