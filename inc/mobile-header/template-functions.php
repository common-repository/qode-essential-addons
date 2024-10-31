<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_render_mobile_header_logo_image' ) ) {
	/**
	 * This function print header logo image
	 *
	 * @param array $parameters
	 */
	function qode_essential_addons_render_mobile_header_logo_image( $parameters = array() ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo qode_essential_addons_get_mobile_header_logo_image( $parameters );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_mobile_header_logo_image' ) ) {
	/**
	 * Function that return logo image html for current module
	 *
	 * @return string that contains html content
	 */
	function qode_essential_addons_get_mobile_header_logo_image() {
		$logo_height     = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_height' );
		$logo_source     = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_source' );
		$main_logo_id    = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_main' );
		$logo_svg_path   = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_svg_path' );
		$logo_text       = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_text' );
		$customizer_logo = qode_essential_addons_get_customizer_logo();

		$logo_classes = array();
		if ( ! empty( $logo_height ) ) {
			$logo_classes[] = 'qodef-height--set';
		} else {
			$logo_classes[] = 'qodef-height--not-set';
		}

		if ( ! empty( $logo_source ) ) {
			$logo_classes[] = 'qodef-source--' . esc_attr( $logo_source );
		}

		$parameters = array(
			'logo_classes' => implode( ' ', $logo_classes ),
		);

		$available_logos = apply_filters(
			'qode_essential_addons_filter_available_mobile_header_logo_images',
			array(
				'main' => 'main',
			),
			$parameters
		);

		$logo_html  = array();
		$is_enabled = false;

		if ( 'svg-path' === $logo_source && ! empty( $logo_svg_path ) ) {
			$logo_html['logo_main_image'] = apply_filters( 'qode_essential_addons_filter_mobile_header_logo_svg_path', $logo_svg_path, $parameters );

			$is_enabled = true;
		} elseif ( 'textual' === $logo_source && ! empty( $logo_text ) ) {
			$logo_html['logo_main_image'] = esc_html( apply_filters( 'qode_essential_addons_filter_mobile_header_logo_textual', $logo_text, $parameters ) );

			$is_enabled = true;
		} else {
			foreach ( $available_logos as $logo_key => $option_value ) {
				$logo_html[ 'logo_' . $logo_key . '_image' ] = '';

				$logo_image_id = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_' . $option_value );

				// Check if logo image is set, if not set main mobile logo image as default.
				if ( ! empty( $main_logo_id ) && ( ( 'main' === $logo_key && empty( $logo_image_id ) ) || empty( $logo_image_id ) ) ) {
					$logo_image_id = $main_logo_id;
				}

				if ( ! empty( $logo_image_id ) ) {
					$logo_image_attr = array(
						'class'    => 'qodef-header-logo-image qodef--' . str_replace( '_', '-', $logo_key ),
						'itemprop' => 'image',
						'alt'      => sprintf( '%s %s', esc_attr__( 'logo', 'qode-essential-addons' ), str_replace( '_', ' ', $logo_key ) ),
					);

					$image      = qode_essential_addons_get_attachment_image( $logo_image_id, 'full', false, $logo_image_attr );
					$image_html = ! empty( $image ) ? $image : qode_essential_addons_framework_get_image_html_from_src( $logo_image_id, $logo_image_attr );

					$logo_html[ 'logo_' . $logo_key . '_image' ] = qode_essential_addons_framework_wp_kses_html( 'img', $image_html );

					$is_enabled = true;
				}
			}

			if ( empty( $logo_html['logo_main_image'] ) && ! empty( $customizer_logo ) ) {
				$logo_html['logo_main_image'] = $customizer_logo;
				$is_enabled                   = true;
			}
		}

		$parameters['logo_image'] = implode( '', apply_filters( 'qode_essential_addons_filter_mobile_header_logo_image_html', $logo_html, $parameters ) );

		if ( $is_enabled ) {
			return apply_filters( 'qode_essential_addons_filter_get_mobile_header_logo_image', qode_essential_addons_get_template_part( 'mobile-header/templates', 'parts/mobile-logo', '', $parameters ), $parameters, $logo_html );
		}
	}
}

if ( ! function_exists( 'qode_essential_addons_set_mobile_header_logo_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_mobile_header_logo_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$logo_styles  = array();
		$logo_height  = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_height' );
		$logo_padding = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_padding' );

		if ( ! empty( $logo_height ) ) {
			$logo_styles['height'] = intval( $logo_height ) . 'px';
		}

		if ( ! empty( $logo_padding ) ) {
			$logo_styles['padding'] = esc_attr( $logo_padding );
		}

		if ( ! empty( $logo_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-mobile-header .qodef-mobile-header-logo-link',
				),
				$logo_styles
			);
		}

		// Logo SVG Source.
		$svg_styles     = array();
		$svg_icon_color = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_svg_path_color' );

		if ( ! empty( $svg_icon_color ) ) {
			$svg_styles['color'] = $svg_icon_color;
		}

		if ( ! empty( $svg_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-mobile-header .qodef-mobile-header-logo-link.qodef-source--svg-path', $svg_styles );
		}

		$svg_icon_styles = array();
		$svg_icon_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_svg_path_size' );

		if ( ! empty( $svg_icon_size ) ) {
			if ( qode_essential_addons_framework_string_ends_with_typography_units( $svg_icon_size ) ) {
				$svg_icon_styles['width'] = $svg_icon_size;
			} else {
				$svg_icon_styles['width'] = intval( $svg_icon_size ) . 'px';
			}
		}

		if ( ! empty( $svg_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-mobile-header .qodef-mobile-header-logo-link.qodef-source--svg-path svg', $svg_icon_styles );
		}

		$svg_hover_styles     = array();
		$svg_icon_hover_color = qode_essential_addons_get_post_value_through_levels( 'qodef_mobile_logo_svg_path_hover_color' );

		if ( ! empty( $svg_icon_hover_color ) ) {
			$svg_hover_styles['color'] = $svg_icon_hover_color;
		}

		if ( ! empty( $svg_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-mobile-header .qodef-mobile-header-logo-link.qodef-source--svg-path:hover',
				),
				$svg_hover_styles
			);
		}

		// Logo Textual Source.
		$textual_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_mobile_logo_text', '', null );
		$textual_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_mobile_logo_text', null );

		if ( ! empty( $textual_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-mobile-header .qodef-mobile-header-logo-link.qodef-source--textual', $textual_styles );
		}

		if ( ! empty( $textual_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-mobile-header .qodef-mobile-header-logo-link.qodef-source--textual:hover', $textual_hover_styles );
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_mobile_header_logo_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_mobile_header_logo_image' ) ) {
	/**
	 * Function that return logo image html for current module
	 *
	 * @param string $template - contains html content
	 *
	 * @return string that contains html content
	 */
	function qode_essential_addons_set_mobile_header_logo_image( $template ) {
		$mobile_image = qode_essential_addons_get_mobile_header_logo_image();

		if ( ! empty( $mobile_image ) ) {
			return $mobile_image;
		}

		return $template;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_mobile_header_logo_template', 'qode_essential_addons_set_mobile_header_logo_image' );
	add_filter( 'the_q_filter_mobile_header_logo_template', 'qode_essential_addons_set_mobile_header_logo_image' );
	add_filter( 'qi_filter_mobile_header_logo_template', 'qode_essential_addons_set_mobile_header_logo_image' );
	add_filter( 'qi_gutenberg_filter_mobile_header_logo_template', 'qode_essential_addons_set_mobile_header_logo_image' );
}
