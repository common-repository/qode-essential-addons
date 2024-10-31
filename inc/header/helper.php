<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_header_radio_to_select_options' ) ) {
	/**
	 * Function that convert radio boxes into array
	 *
	 * @param array $radio_array
	 *
	 * @return array
	 */
	function qode_essential_addons_header_radio_to_select_options( $radio_array ) {
		$select_array = array( '' => esc_html__( 'Default', 'qode-essential-addons' ) );

		foreach ( $radio_array as $key => $value ) {
			$select_array[ $key ] = $value['label'];
		}

		return $select_array;
	}
}
