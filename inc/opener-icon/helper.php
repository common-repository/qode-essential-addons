<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_get_opener_icon_html_content' ) ) {
	/**
	 * Returns html for opener icon sources
	 *
	 * @param string $option_name - option name
	 * @param bool $is_close_icon
	 *
	 * @return string/html
	 */
	function qode_essential_addons_get_opener_icon_html_content( $option_name, $is_close_icon = false ) {
		$html = '';

		if ( empty( $option_name ) ) {
			return '';
		}

		$icon_svg_path       = qode_essential_addons_get_option_value( 'admin', 'qodef_' . esc_attr( $option_name ) . '_icon_svg_path' );
		$close_icon_svg_path = qode_essential_addons_get_option_value( 'admin', 'qodef_' . esc_attr( $option_name ) . '_close_icon_svg_path' );

		if ( $is_close_icon ) {
			$html .= $close_icon_svg_path;
		} else {
			$html .= $icon_svg_path;
		}

		return $html;
	}
}
