<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_set_elements_svg_icon' ) ) {
	/**
	 * Function that set svg icon layout for buttons arrow
	 *
	 * @param string $icon
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string
	 */
	function qode_essential_addons_set_elements_svg_icon( $icon, $name, $class_name ) {
		$button_icon_layout        = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_icon_layout' );
		$button_icon_layout_custom = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_custom_icon_svg_path' );
		$slider_left_icon          = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_slider_arrow_left_icon_svg_path' );
		$slider_right_icon         = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_slider_arrow_right_icon_svg_path' );
		$pagination_left_icon      = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_pagination_arrow_left_icon_svg_path' );
		$pagination_right_icon     = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_pagination_arrow_right_icon_svg_path' );
		$pagination_back_to_link   = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_pagination_back_to_link_icon_svg_path' );

		if ( 'button-arrow' === $name && ! empty( $button_icon_layout ) ) {
			$new_button_layout = qode_essential_addons_get_button_svg_icon( $button_icon_layout, $class_name );

			if ( 'disable' === $button_icon_layout ) {
				return '';
			} elseif ( ! empty( $new_button_layout ) || ! empty( $button_icon_layout_custom ) ) {
				if ( ! empty( $button_icon_layout_custom ) ) {
					return '<div class="qodef-custom-icon qodef-theme-button-icon">' . $button_icon_layout_custom . '</div>';
				} elseif ( ! empty( $new_button_layout ) ) {
					return $new_button_layout;
				}
			}
		} elseif ( 'slider-arrow-left' === $name && ! empty( $slider_left_icon ) ) {
			return $slider_left_icon;
		} elseif ( 'slider-arrow-right' === $name && ! empty( $slider_right_icon ) ) {
			return $slider_right_icon;
		} elseif ( 'pagination-arrow-left' === $name && ! empty( $pagination_left_icon ) ) {
			return $pagination_left_icon;
		} elseif ( 'pagination-arrow-right' === $name && ! empty( $pagination_right_icon ) ) {
			return $pagination_right_icon;
		} elseif ( 'pagination-burger' === $name && ! empty( $pagination_back_to_link ) ) {
			return $pagination_back_to_link;
		}

		return $icon;
	}

	add_filter( 'qode_essential_addons_filter_svg_icon', 'qode_essential_addons_set_elements_svg_icon', 15, 3 );

	// @WPThemeHookList.
	add_filter( 'the_two_filter_svg_icon', 'qode_essential_addons_set_elements_svg_icon', 15, 3 );
	add_filter( 'the_q_filter_svg_icon', 'qode_essential_addons_set_elements_svg_icon', 15, 3 );
	add_filter( 'qi_filter_svg_icon', 'qode_essential_addons_set_elements_svg_icon', 15, 3 );
	add_filter( 'qi_gutenberg_filter_svg_icon', 'qode_essential_addons_set_elements_svg_icon', 15, 3 );
}

if ( ! function_exists( 'qode_essential_addons_set_elements_input_fields_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_elements_input_fields_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$label_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_elements_label' );

		if ( ! empty( $label_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'label',
				),
				$label_styles
			);

			if ( isset( $label_styles['color'] ) && ! empty( $label_styles ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'#qodef-page-comments-form .qodef-comment-form .comment-form-cookies-consent',
						'.qodef-woo-results .woocommerce-result-count',
						'.widget.woocommerce.widget_price_filter .price_slider_amount .price_label',
					),
					array(
						'color' => $label_styles['color'],
					)
				);
			}
		}

		$input_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_elements_input_fields' );
		$fields_bg_color      = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_background_color' );
		$fields_border_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_color' );
		$fields_border_width  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_width' );
		$fields_border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_radius' );
		$fields_border_style  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_style' );
		$fields_padding       = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_padding' );

		if ( ! empty( $fields_bg_color ) ) {
			$input_styles['background-color'] = $fields_bg_color;
		}

		if ( ! empty( $fields_border_color ) ) {
			$input_styles['border-color'] = $fields_border_color;
		}

		if ( '' !== $fields_border_width ) {
			$input_styles['border-width'] = $fields_border_width;
		}

		if ( '' !== $fields_border_radius ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $fields_border_radius, true ) ) {
				$input_styles['border-radius'] = $fields_border_radius;
			} else {
				$input_styles['border-radius'] = intval( $fields_border_radius ) . 'px';
			}
		}

		if ( ! empty( $fields_border_style ) ) {
			$input_styles['border-style'] = esc_attr( $fields_border_style );
		}

		if ( '' !== $fields_padding ) {
			$input_styles['padding'] = esc_attr( $fields_padding );
		}

		if ( ! empty( $input_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'input[type="text"]',
					'input[type="email"]',
					'input[type="url"]',
					'input[type="password"]',
					'input[type="number"]',
					'input[type="tel"]',
					'input[type="search"]',
					'input[type="date"]',
					'textarea',
					'select',
					'body .select2-container--default .select2-selection--single',
					'body .select2-container--default .select2-selection--multiple',
					'.widget[class*="_search"] button.qodef-search-form-button',
					'.wp-block-search .wp-block-search__input',
					'.wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper',
					'.widget.widget_block .wp-block-woocommerce-product-search input',
				),
				$input_styles
			);
		}

		// Connected with input border color, since those borders appear on blog single page, so all border colors on page should be consistent.
		if ( ! empty( $fields_border_color ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-blog.qodef--single .qodef-blog-item .qodef-e-content',
					'#qodef-author-info',
					'#qodef-page-comments-list',
					'#qodef-page-comments-list .qodef-comment-item',
					'#qodef-related-posts',
				),
				array(
					'border-color' => $fields_border_color,
					'border-width' => $fields_border_width,
				)
			);
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'table tr',
					'table td',
					'table th',
					'#qodef-woo-page.qodef--cart .cart_totals .shop_table .order-total',
					'#qodef-woo-page.qodef--cart .cross-sells .shop_table .order-total',
					'#qodef-woo-page.qodef--cart .cart_totals>h2',
					'#qodef-woo-page.qodef--cart .cross-sells>h2',
					'#qodef-woo-page.qodef--checkout #order_review table tr td:first-child',
					'#qodef-woo-page.qodef--checkout #order_review table tr th:first-child',
					'#qodef-woo-page.qodef--checkout #order_review table',
					'#qodef-woo-page.qodef--checkout .wc_payment_methods li',
					'.woocommerce-error',
					'.woocommerce-info',
					'.woocommerce-message',
					'#qodef-woo-page.qodef--single .woocommerce-tabs',
				),
				array(
					'border-color' => $fields_border_color,
				)
			);
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range',
					'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle',
					'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs:before',
				),
				array( 'background-color' => $fields_border_color )
			);
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.widget[class*="_search"] button',
					'.widget .wp-block-search button',
					'.qodef-search .qodef-search-form .qodef-search-form-button',
				),
				array( 'color' => $fields_border_color )
			);
		}

		$input_focus_styles        = array();
		$fields_focus_color        = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_focus_color' );
		$fields_bg_focus_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_background_focus_color' );
		$fields_border_focus_color = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_input_fields_border_focus_color' );

		if ( ! empty( $fields_focus_color ) ) {
			$input_focus_styles['color'] = $fields_focus_color;
		}

		if ( ! empty( $fields_bg_focus_color ) ) {
			$input_focus_styles['background-color'] = $fields_bg_focus_color;
		}

		if ( ! empty( $fields_border_focus_color ) ) {
			$input_focus_styles['border-color'] = $fields_border_focus_color;

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.widget[class*="_search"] button:hover',
					'.widget[class*="_search"] button:focus',
					'.widget .wp-block-search button:hover',
					'.widget .wp-block-search button:focus',
					'.qodef-search .qodef-search-form .qodef-search-form-button:hover',
				),
				array( 'color' => $fields_border_focus_color )
			);
		}

		if ( ! empty( $input_focus_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'input[type="text"]:focus',
					'input[type="email"]:focus',
					'input[type="url"]:focus',
					'input[type="password"]:focus',
					'input[type="number"]:focus',
					'input[type="tel"]:focus',
					'input[type="search"]:focus',
					'input[type="date"]:focus',
					'textarea:focus',
					'select:focus',
					'body .select2-container--default .select2-selection--single:focus',
					'body .select2-container--default .select2-selection--multiple:focus',
					'.widget[class*="_search"] button.qodef-search-form-button:hover',
					'.wp-block-search .wp-block-search__input:focus',
				),
				$input_focus_styles
			);
		}

		$button_styles        = qode_essential_addons_get_typography_styles( $scope, 'qodef_elements_buttons' );
		$button_bg_color      = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_background_color' );
		$button_border_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_color' );
		$button_border_width  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_width' );
		$button_border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_radius' );
		$button_border_style  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_style' );
		$button_box_shadow    = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_box_shadow' );
		$button_padding       = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_padding' );

		if ( ! empty( $button_bg_color ) ) {
			$button_styles['background-color'] = $button_bg_color;
		}

		if ( ! empty( $button_border_color ) ) {
			$button_styles['border-color'] = $button_border_color;
		}

		if ( '' !== $button_border_width ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $button_border_width, true ) ) {
				$button_styles['border-width'] = $button_border_width;
			} else {
				$button_styles['border-width'] = intval( $button_border_width ) . 'px';
			}
			$button_styles['border-style'] = 'solid';
		}

		if ( '' !== $button_border_radius ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $button_border_radius, true ) ) {
				$button_styles['border-radius'] = $button_border_radius;
			} else {
				$button_styles['border-radius'] = intval( $button_border_radius ) . 'px';
			}
		}

		if ( ! empty( $button_border_style ) ) {
			$button_styles['border-style'] = esc_attr( $button_border_style );
		}

		if ( ! empty( $button_box_shadow ) ) {
			$button_styles['box-shadow'] = esc_attr( $button_box_shadow );
		}

		if ( '' !== $button_padding ) {
			$button_styles['padding'] = esc_attr( $button_padding );
		}

		if ( ! empty( $button_styles ) ) {
			if ( isset( $button_styles['margin-top'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'input[type="submit"]',
						'.form-submit button[type="submit"]',
					),
					array(
						'margin-top' => $button_styles['margin-top'],
					)
				);

				unset( $button_styles['margin-top'] );
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'input[type="submit"]',
					'button[type="submit"]',
					'.qodef-theme-button.qodef--filled',
					'button.qodef-theme-button.qodef--filled',
					'#qodef-woo-page .added_to_cart',
					'#qodef-woo-page .button',
					'.qodef-woo-shortcode .added_to_cart',
					'.qodef-woo-shortcode .button',
					'.widget.woocommerce .button',
					'.woocommerce-page div.woocommerce>.return-to-shop a',
					'.woocommerce-account .button',
					'#qodef-page-header .widget.woocommerce.widget_shopping_cart .buttons a',
					'.widget.woocommerce.widget_shopping_cart .buttons a',
				),
				$button_styles
			);
		}

		$button_hover_styles       = array();
		$button_hover_color        = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_hover_color' );
		$button_bg_hover_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_background_hover_color' );
		$button_border_hover_color = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_border_hover_color' );

		if ( ! empty( $button_hover_color ) ) {
			$button_hover_styles['color'] = $button_hover_color;
		}

		if ( ! empty( $button_bg_hover_color ) ) {
			$button_hover_styles['background-color'] = $button_bg_hover_color;
		}

		if ( ! empty( $button_border_hover_color ) ) {
			$button_hover_styles['border-color'] = $button_border_hover_color;
		}

		if ( ! empty( $button_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'input[type="submit"]:hover',
					'button[type="submit"]:hover',
					'input[type="submit"]:focus',
					'button[type="submit"]:focus',
					'.qodef-theme-button.qodef--filled:hover',
					'button.qodef-theme-button.qodef--filled:hover',
					'.qodef-theme-button.qodef--filled:focus',
					'button.qodef-theme-button.qodef--filled:focus',
					'#qodef-woo-page .added_to_cart:hover',
					'#qodef-woo-page .button:hover',
					'.qodef-woo-shortcode .added_to_cart:hover',
					'.qodef-woo-shortcode .button:hover',
					'.widget.woocommerce .button:hover',
					'#qodef-woo-page .added_to_cart:focus',
					'#qodef-woo-page .button:focus',
					'.qodef-woo-shortcode .added_to_cart:focus',
					'.qodef-woo-shortcode .button:focus',
					'.widget.woocommerce .button:focus',
					'.woocommerce-page div.woocommerce>.return-to-shop a:hover',
					'.woocommerce-page div.woocommerce>.return-to-shop a:focus',
					'.woocommerce-account .button:hover',
					'.woocommerce-account .button:focus',
					'#qodef-page-header .widget.woocommerce.widget_shopping_cart .buttons a:hover',
					'.widget.woocommerce.widget_shopping_cart .buttons a:hover',
				),
				$button_hover_styles
			);
		}

		$button_icon_styles = array();
		$button_icon_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_icon_size' );
		$button_icon_margin = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_icon_margin_left' );

		if ( ! empty( $button_icon_size ) ) {
			if ( qode_essential_addons_framework_string_ends_with_typography_units( $button_icon_size ) ) {
				$button_icon_styles['width'] = $button_icon_size;
			} else {
				$button_icon_styles['width'] = intval( $button_icon_size ) . 'px';
			}
		}

		if ( ! empty( $button_icon_margin ) ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $button_icon_margin, true ) ) {
				$button_icon_styles['margin-left'] = $button_icon_margin;
			} else {
				$button_icon_styles['margin-left'] = intval( $button_icon_margin ) . 'px';
			}
		}

		if ( ! empty( $button_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-theme-button .qodef-theme-button-icon',
					'button.qodef-theme-button .qodef-theme-button-icon',
					'#qodef-woo-page .added_to_cart .qodef-theme-button-icon',
					'#qodef-woo-page .button .qodef-theme-button-icon',
					'.qodef-woo-shortcode .added_to_cart .qodef-theme-button-icon',
					'.qodef-woo-shortcode .button .qodef-theme-button-icon',
					'.qodef-blog-shortcode .qodef-blog-item .qodef-e-read-more-link .qodef-theme-button-icon',
					'.qodef-portfolio-list .qodef-theme-button .qodef-theme-button-icon',
				),
				$button_icon_styles
			);
		}

		$button_simple_icon_styles = array();
		$button_simple_icon_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_simple_icon_color' );

		if ( ! empty( $button_simple_icon_color ) ) {
			$button_simple_icon_styles['color'] = $button_simple_icon_color;
		}

		if ( ! empty( $button_simple_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-theme-button.qodef--simple .qodef-theme-button-icon',
					'button.qodef-theme-button.qodef--simple .qodef-theme-button-icon',
				),
				$button_simple_icon_styles
			);
		}

		$button_simple_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_elements_buttons_simple' );

		if ( ! empty( $button_simple_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-theme-button.qodef--simple',
					'button.qodef-theme-button.qodef--simple',
					'.qodef-woo-shortcode-product-list.qodef-item-layout--info-on-image .qodef-woo-product-inner .added_to_cart',
					'.qodef-woo-shortcode-product-list.qodef-item-layout--info-on-image .qodef-woo-product-inner .button',
					'#qodef-woo-page .qodef-woo-to-swap .button',
					'#qodef-woo-page .qodef-woo-to-swap .added_to_cart',
				),
				$button_simple_styles
			);
		}

		$button_simple_hover_styles               = array();
		$button_simple_hover_color                = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_simple_hover_color' );
		$button_simple_hover_text_decoration      = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_simple_hover_text_decoration' );
		$button_simple_hover_text_decoration_draw = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_simple_hover_text_decoration_draw' );

		if ( ! empty( $button_simple_hover_color ) ) {
			$button_simple_hover_styles['color'] = $button_simple_hover_color;
		}

		if ( ! empty( $hover_text_decoration ) && 'no' === $button_simple_hover_text_decoration_draw ) {
			$button_simple_hover_styles['text-decoration'] = $button_simple_hover_text_decoration;
		}

		if ( ! empty( $hover_text_decoration ) && 'no' !== $button_simple_hover_text_decoration_draw ) {
			$button_simple_hover_styles['text-decoration'] = 'none';
		}

		if ( ! empty( $button_simple_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-theme-button.qodef--simple:hover',
					'button.qodef-theme-button.qodef--simple:hover',
					'.qodef-woo-shortcode-product-list.qodef-item-layout--info-on-image .qodef-woo-product-inner .added_to_cart:hover',
					'.qodef-woo-shortcode-product-list.qodef-item-layout--info-on-image .qodef-woo-product-inner .button:hover',
					'#qodef-woo-page .qodef-woo-to-swap .button:hover',
					'#qodef-woo-page .qodef-woo-to-swap .added_to_cart:hover',
					'.qodef-theme-button.qodef--simple:focus',
					'button.qodef-theme-button.qodef--simple:focus',
					'.qodef-woo-shortcode-product-list.qodef-item-layout--info-on-image .qodef-woo-product-inner .added_to_cart:focus',
					'.qodef-woo-shortcode-product-list.qodef-item-layout--info-on-image .qodef-woo-product-inner .button:focus',
					'#qodef-woo-page .qodef-woo-to-swap .button:focus',
					'#qodef-woo-page .qodef-woo-to-swap .added_to_cart:focus',
				),
				$button_simple_hover_styles
			);
		}

		$slider_arrow_styles   = array();
		$slider_arrow_color    = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_slider_arrow_color' );
		$slider_arrow_bg_color = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_slider_arrow_background_color' );

		if ( ! empty( $slider_arrow_color ) ) {
			$slider_arrow_styles['color'] = $slider_arrow_color;
		}

		if ( ! empty( $slider_arrow_bg_color ) ) {
			$slider_arrow_styles['background-color'] = $slider_arrow_bg_color;
		}

		if ( ! empty( $slider_arrow_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-swiper-container .swiper-button-next',
					'.qodef-swiper-container .swiper-button-prev',
				),
				$slider_arrow_styles
			);
		}

		$slider_arrow_svg_styles = array();
		$slider_arrow_svg_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_slider_arrow_size' );

		if ( ! empty( $slider_arrow_svg_size ) ) {
			$slider_arrow_svg_styles['width'] = intval( $slider_arrow_svg_size ) . 'px';
		}

		if ( ! empty( $slider_arrow_svg_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-swiper-container .swiper-button-next svg',
					'.qodef-swiper-container .swiper-button-prev svg',
				),
				$slider_arrow_svg_styles
			);
		}

		$slider_arrow_hover_styles   = array();
		$slider_arrow_hover_color    = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_slider_arrow_hover_color' );
		$slider_arrow_bg_hover_color = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_slider_arrow_background_hover_color' );

		if ( ! empty( $slider_arrow_hover_color ) ) {
			$slider_arrow_hover_styles['color'] = $slider_arrow_hover_color;
		}

		if ( ! empty( $slider_arrow_bg_hover_color ) ) {
			$slider_arrow_hover_styles['background-color'] = $slider_arrow_bg_hover_color;
		}

		if ( ! empty( $slider_arrow_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-swiper-container .swiper-button-next:hover',
					'.qodef-swiper-container .swiper-button-prev:hover',
				),
				$slider_arrow_hover_styles
			);
		}

		$pagination_arrow_styles = array();
		$pagination_arrow_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_pagination_arrow_color' );

		if ( ! empty( $pagination_arrow_color ) ) {
			$pagination_arrow_styles['color'] = $pagination_arrow_color;
		}

		if ( ! empty( $pagination_arrow_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-single-portfolio-navigation .qodef-m-nav',
					'.qodef-m-pagination.qodef--wp .page-numbers',
					'.qodef-m-pagination.qodef--wp .page-numbers.next',
					'.qodef-m-pagination.qodef--wp .page-numbers.prev',
					'#qodef-woo-page .woocommerce-pagination .page-numbers',
					'#qodef-woo-page .woocommerce-pagination .page-numbers.next',
					'#qodef-woo-page .woocommerce-pagination .page-numbers.prev',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers.next',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers.prev',
				),
				$pagination_arrow_styles
			);
		}

		$pagination_arrow_svg_styles = array();
		$pagination_arrow_size       = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_pagination_arrow_size' );

		if ( ! empty( $pagination_arrow_size ) ) {
			$pagination_arrow_svg_styles['width'] = intval( $pagination_arrow_size ) . 'px';
		}

		if ( ! empty( $pagination_arrow_svg_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-single-portfolio-navigation .qodef-m-nav svg',
					'.qodef-m-pagination.qodef--wp .page-numbers.prev svg',
					'.qodef-m-pagination.qodef--wp .page-numbers.next svg',
					'#qodef-woo-page .woocommerce-pagination .page-numbers.prev svg',
					'#qodef-woo-page .woocommerce-pagination .page-numbers.next svg',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers.prev svg',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers.next svg',
				),
				$pagination_arrow_svg_styles
			);
		}

		$pagination_arrow_hover_styles = array();
		$pagination_arrow_hover_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_pagination_arrow_hover_color' );

		if ( ! empty( $pagination_arrow_hover_color ) ) {
			$pagination_arrow_hover_styles['color'] = $pagination_arrow_hover_color;
		}

		if ( ! empty( $pagination_arrow_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-single-portfolio-navigation .qodef-m-nav:hover',
					'.qodef-m-pagination.qodef--wp .page-numbers:hover',
					'.qodef-m-pagination.qodef--wp .page-numbers.current',
					'.qodef-m-pagination.qodef--wp .page-numbers.next:hover',
					'.qodef-m-pagination.qodef--wp .page-numbers.prev:hover',
					'#qodef-woo-page .woocommerce-pagination .page-numbers:hover',
					'#qodef-woo-page .woocommerce-pagination .page-numbers.current',
					'#qodef-woo-page .woocommerce-pagination .page-numbers.next:hover',
					'#qodef-woo-page .woocommerce-pagination .page-numbers.prev:hover',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers:hover',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers.current',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers.prev:hover',
					'.qodef-shortcode .qodef-m-pagination.qodef--standard .page-numbers.next:hover',
				),
				$pagination_arrow_hover_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_elements_input_fields_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_button_simple_draw_classes' ) ) {

	function qode_essential_addons_set_button_simple_draw_classes( $classes ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$field_name = 'qodef_elements_buttons_simple';

		$draw_hover_decoration = qode_essential_addons_framework_get_option_value( $scope, 'admin', $field_name . '_hover_text_decoration_draw' );
		$hover_decoration      = qode_essential_addons_framework_get_option_value( $scope, 'admin', $field_name . '_hover_text_decoration' );
		$set_hover_decoration  = ( 'underline' === $hover_decoration ) || ( 'overline' === $hover_decoration ) || ( 'line-through' === $hover_decoration );

		$button_simple_class  = '';
		$field_name_class     = str_replace( array( ' ', '_' ), '-', $field_name );
		$button_simple_class .= ( 'no' !== $draw_hover_decoration ) && $set_hover_decoration ? $field_name_class . '--draw-hover-' . $hover_decoration . '-' . $draw_hover_decoration : '';

		if ( ! empty( $button_simple_class ) ) {
			$classes [] = $button_simple_class;
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_set_button_simple_draw_classes' );
}
