<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_set_general_typography_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_typography_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$body_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_p', 'body' );
		$p_styles          = qode_essential_addons_get_typography_styles( $scope, 'qodef_p', 'p' );
		$h1_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_h1' );
		$h1_link_styles    = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_h1_link' );
		$h2_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_h2' );
		$h2_link_styles    = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_h2_link' );
		$h3_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_h3' );
		$h3_link_styles    = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_h3_link' );
		$h4_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_h4' );
		$h4_link_styles    = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_h4_link' );
		$h5_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_h5' );
		$h5_link_styles    = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_h5_link' );
		$h6_styles         = qode_essential_addons_get_typography_styles( $scope, 'qodef_h6' );
		$h6_link_styles    = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_h6_link' );
		$link_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_link' );
		$link_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_link' );

		if ( ! empty( $body_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( 'body', $body_styles );

			$mfp_style = $body_styles;
			unset( $mfp_style['color'] );
			$style .= qode_essential_addons_framework_dynamic_style( '.mfp-bottom-bar .mfp-counter, .mfp-bottom-bar .mfp-title', $mfp_style );
		}

		if ( ! empty( $p_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( 'p', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h1',
					'.qodef-h1',
				),
				$h1_styles
			);
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h2',
					'.qodef-h2',
				),
				$h2_styles
			);

			$unset_values = array( 'margin-top', 'margin-bottom' );
			foreach ( $unset_values as $unset_value ) {
				if ( isset( $h2_styles[ $unset_value ] ) ) {
					unset( $h2_styles[ $unset_value ] );
				}
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--checkout #customer_details h3',
					'#qodef-woo-page.qodef--checkout #order_review_heading',
				),
				$h2_styles
			);
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h3',
					'.qodef-h3',
				),
				$h3_styles
			);

			$unset_values = array( 'margin-top', 'margin-bottom' );
			foreach ( $unset_values as $unset_value ) {
				if ( isset( $h3_styles[ $unset_value ] ) ) {
					unset( $h3_styles[ $unset_value ] );
				}
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-Reviews-title',
					'#qodef-woo-page.qodef--single #review_form .comment-reply-title',
					'#qodef-woo-page.qodef--cart .cart_totals > h2',
					'#qodef-woo-page.qodef--cart .cross-sells > h2',
					'.woocommerce-page div.woocommerce > .cart-empty',
					'body[class*="theme-qi"] #qodef-related-posts .qodef-m-title',
				),
				$h3_styles
			);
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h4',
					'.qodef-h4',
				),
				$h4_styles
			);
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h5',
					'.qodef-h5',
				),
				$h5_styles
			);

			$unset_values = array( 'margin-top', 'margin-bottom' );
			foreach ( $unset_values as $unset_value ) {
				if ( isset( $h5_styles[ $unset_value ] ) ) {
					unset( $h5_styles[ $unset_value ] );
				}
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.woocommerce-page div.woocommerce .shop_table th',
					'#qodef-woo-page.qodef--cart .shop_table td.product-name a',
				),
				$h5_styles
			);

			if ( isset( $h5_styles['color'] ) ) {
				unset( $h5_styles['color'] );
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li a',
				),
				$h5_styles
			);
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h6',
					'.qodef-h6',
				),
				$h6_styles
			);

			$unset_values = array( 'margin-top', 'margin-bottom' );
			foreach ( $unset_values as $unset_value ) {
				if ( isset( $h6_styles[ $unset_value ] ) ) {
					unset( $h6_styles[ $unset_value ] );
				}
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-sidebar .widget.widget_recent_entries ul li a',
					'#qodef-page-sidebar .wp-block-latest-posts li a',
					'#qodef-page-wrapper .widget.woocommerce a .product-title',
					'#qodef-woo-page.qodef--single .shop_attributes th',
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-review__author',
				),
				$h6_styles
			);
		}

		if ( ! empty( $link_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( array( 'a', 'p a' ), $link_styles );
		}

		if ( ! empty( $link_hover_styles ) ) {
			// Remove default outline style on focus - needs to be by default because of the WordPress theme standards.
			$link_hover_styles['outline'] = 'none';

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'a:hover',
					'p a:hover',
					'a:focus',
					'p a:focus',
					'.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a',
					'#qodef-woo-page.qodef--single .woocommerce-product-rating .woocommerce-review-link:hover',
					'.qodef-page-title .qodef-breadcrumbs a:hover',
					'#qodef-page-comments-list .qodef-comment-item .qodef-e-links a:hover',
				),
				$link_hover_styles
			);
		}

		// Headings hover style.

		if ( ! empty( $h1_link_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'h1 a:hover',
						'h1 a:focus',
					),
					array(
						'.qodef-woo-shortcode-product-list .qodef-woo-product-inner:hover h1.qodef-woo-product-title',
					)
				),
				$h1_link_styles
			);
		}

		if ( ! empty( $h2_link_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'h2 a:hover',
						'h2 a:focus',
					),
					array(
						'.qodef-woo-shortcode-product-list .qodef-woo-product-inner:hover h2.qodef-woo-product-title',
					)
				),
				$h2_link_styles
			);
		}

		if ( ! empty( $h3_link_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'h3 a:hover',
						'h3 a:focus',
					),
					array(
						'.qodef-woo-shortcode-product-list .qodef-woo-product-inner:hover h3.qodef-woo-product-title',
					)
				),
				$h3_link_styles
			);
		}

		if ( ! empty( $h4_link_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'h4 a:hover',
						'h4 a:focus',
					),
					array(
						'.qodef-woo-shortcode-product-list .qodef-woo-product-inner:hover h4.qodef-woo-product-title',
					)
				),
				$h4_link_styles
			);
		}

		if ( ! empty( $h5_link_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'h5 a:hover',
						'h5 a:focus',
					),
					array(
						'#qodef-woo-page.qodef--cart .shop_table td.product-name a:hover',
						'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li a:hover',
						'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li.active a',
						'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li.ui-state-active a',
						'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li.ui-state-hover a',
						'.qodef-woo-shortcode-product-list .qodef-woo-product-inner:hover h5.qodef-woo-product-title',
					)
				),
				$h5_link_styles
			);
		}

		if ( ! empty( $h6_link_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'h6 a:hover',
						'h6 a:focus',
					),
					array(
						'#qodef-page-sidebar .widget.widget_recent_entries ul li a:hover',
						'#qodef-page-sidebar .wp-block-latest-posts li a:hover',
						'.qodef-woo-shortcode-product-list .qodef-woo-product-inner:hover h6.qodef-woo-product-title',
					)
				),
				$h6_link_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_general_typography_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_general_typography_responsive_1440_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_typography_responsive_1440_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$p_styles  = qode_essential_addons_get_typography_styles( $scope, 'qodef_p_responsive_1440' );
		$h1_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h1_responsive_1440' );
		$h2_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h2_responsive_1440' );
		$h3_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h3_responsive_1440' );
		$h4_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h4_responsive_1440' );
		$h5_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h5_responsive_1440' );
		$h6_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h6_responsive_1440' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( 'body', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h1',
					'.qodef-h1',
				),
				$h1_styles
			);
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h2',
					'.qodef-h2',
				),
				$h2_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--checkout #customer_details h3',
					'#qodef-woo-page.qodef--checkout #order_review_heading',
				),
				$h2_styles
			);
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h3',
					'.qodef-h3',
				),
				$h3_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-Reviews-title',
					'#qodef-woo-page.qodef--single #review_form .comment-reply-title',
					'#qodef-woo-page.qodef--cart .cart_totals > h2',
					'#qodef-woo-page.qodef--cart .cross-sells > h2',
					'.woocommerce-page div.woocommerce > .cart-empty',
					'body[class*="theme-qi"] #qodef-related-posts .qodef-m-title',
				),
				$h3_styles
			);
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h4',
					'.qodef-h4',
				),
				$h4_styles
			);
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h5',
					'.qodef-h5',
				),
				$h5_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li a',
					'.woocommerce-page div.woocommerce .shop_table th',
					'#qodef-woo-page.qodef--cart .shop_table td.product-name a',
				),
				$h5_styles
			);
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h6',
					'.qodef-h6',
				),
				$h6_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-sidebar .widget.widget_recent_entries ul li a',
					'#qodef-page-sidebar .wp-block-latest-posts li a',
					'#qodef-woo-page.qodef--single .shop_attributes th',
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-review__author',
				),
				$h6_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_responsive_1440_inline_style', 'qode_essential_addons_set_general_typography_responsive_1440_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_general_typography_responsive_1366_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_typography_responsive_1366_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$p_styles  = qode_essential_addons_get_typography_styles( $scope, 'qodef_p_responsive_1366' );
		$h1_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h1_responsive_1366' );
		$h2_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h2_responsive_1366' );
		$h3_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h3_responsive_1366' );
		$h4_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h4_responsive_1366' );
		$h5_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h5_responsive_1366' );
		$h6_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h6_responsive_1366' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( 'body', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h1',
					'.qodef-h1',
				),
				$h1_styles
			);
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h2',
					'.qodef-h2',
				),
				$h2_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--checkout #customer_details h3',
					'#qodef-woo-page.qodef--checkout #order_review_heading',
				),
				$h2_styles
			);
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h3',
					'.qodef-h3',
				),
				$h3_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-Reviews-title',
					'#qodef-woo-page.qodef--single #review_form .comment-reply-title',
					'#qodef-woo-page.qodef--cart .cart_totals > h2',
					'#qodef-woo-page.qodef--cart .cross-sells > h2',
					'.woocommerce-page div.woocommerce > .cart-empty',
					'body[class*="theme-qi"] #qodef-related-posts .qodef-m-title',
				),
				$h3_styles
			);
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h4',
					'.qodef-h4',
				),
				$h4_styles
			);
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h5',
					'.qodef-h5',
				),
				$h5_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li a',
					'.woocommerce-page div.woocommerce .shop_table th',
					'#qodef-woo-page.qodef--cart .shop_table td.product-name a',
				),
				$h5_styles
			);
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h6',
					'.qodef-h6',
				),
				$h6_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-sidebar .widget.widget_recent_entries ul li a',
					'#qodef-page-sidebar .wp-block-latest-posts li a',
					'#qodef-woo-page.qodef--single .shop_attributes th',
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-review__author',
				),
				$h6_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_responsive_1366_inline_style', 'qode_essential_addons_set_general_typography_responsive_1366_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_general_typography_responsive_1024_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_typography_responsive_1024_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$p_styles  = qode_essential_addons_get_typography_styles( $scope, 'qodef_p_responsive_1024' );
		$h1_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h1_responsive_1024' );
		$h2_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h2_responsive_1024' );
		$h3_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h3_responsive_1024' );
		$h4_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h4_responsive_1024' );
		$h5_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h5_responsive_1024' );
		$h6_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h6_responsive_1024' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( 'body', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h1',
					'.qodef-h1',
				),
				$h1_styles
			);
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h2',
					'.qodef-h2',
				),
				$h2_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--checkout #customer_details h3',
					'#qodef-woo-page.qodef--checkout #order_review_heading',
				),
				$h2_styles
			);
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h3',
					'.qodef-h3',
				),
				$h3_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-Reviews-title',
					'#qodef-woo-page.qodef--single #review_form .comment-reply-title',
					'#qodef-woo-page.qodef--cart .cart_totals > h2',
					'#qodef-woo-page.qodef--cart .cross-sells > h2',
					'.woocommerce-page div.woocommerce > .cart-empty',
					'body[class*="theme-qi"] #qodef-related-posts .qodef-m-title',
				),
				$h3_styles
			);
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h4',
					'.qodef-h4',
				),
				$h4_styles
			);
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h5',
					'.qodef-h5',
				),
				$h5_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li a',
					'.woocommerce-page div.woocommerce .shop_table th',
					'#qodef-woo-page.qodef--cart .shop_table td.product-name a',
				),
				$h5_styles
			);
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h6',
					'.qodef-h6',
				),
				$h6_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-sidebar .widget.widget_recent_entries ul li a',
					'#qodef-page-sidebar .wp-block-latest-posts li a',
					'#qodef-woo-page.qodef--single .shop_attributes th',
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-review__author',
				),
				$h6_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_responsive_1024_inline_style', 'qode_essential_addons_set_general_typography_responsive_1024_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_general_typography_responsive_768_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_typography_responsive_768_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$p_styles  = qode_essential_addons_get_typography_styles( $scope, 'qodef_p_responsive_768' );
		$h1_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h1_responsive_768' );
		$h2_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h2_responsive_768' );
		$h3_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h3_responsive_768' );
		$h4_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h4_responsive_768' );
		$h5_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h5_responsive_768' );
		$h6_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h6_responsive_768' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( 'body', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h1',
					'.qodef-h1',
				),
				$h1_styles
			);
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h2',
					'.qodef-h2',
				),
				$h2_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--checkout #customer_details h3',
					'#qodef-woo-page.qodef--checkout #order_review_heading',
				),
				$h2_styles
			);
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h3',
					'.qodef-h3',
				),
				$h3_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-Reviews-title',
					'#qodef-woo-page.qodef--single #review_form .comment-reply-title',
					'#qodef-woo-page.qodef--cart .cart_totals > h2',
					'#qodef-woo-page.qodef--cart .cross-sells > h2',
					'.woocommerce-page div.woocommerce > .cart-empty',
					'body[class*="theme-qi"] #qodef-related-posts .qodef-m-title',
				),
				$h3_styles
			);
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h4',
					'.qodef-h4',
				),
				$h4_styles
			);
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h5',
					'.qodef-h5',
				),
				$h5_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li a',
					'.woocommerce-page div.woocommerce .shop_table th',
					'#qodef-woo-page.qodef--cart .shop_table td.product-name a',
				),
				$h5_styles
			);
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h6',
					'.qodef-h6',
				),
				$h6_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-sidebar .widget.widget_recent_entries ul li a',
					'#qodef-page-sidebar .wp-block-latest-posts li a',
					'#qodef-woo-page.qodef--single .shop_attributes th',
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-review__author',
				),
				$h6_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_responsive_768_inline_style', 'qode_essential_addons_set_general_typography_responsive_768_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_general_typography_responsive_680_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_general_typography_responsive_680_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$p_styles  = qode_essential_addons_get_typography_styles( $scope, 'qodef_p_responsive_680' );
		$h1_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h1_responsive_680' );
		$h2_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h2_responsive_680' );
		$h3_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h3_responsive_680' );
		$h4_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h4_responsive_680' );
		$h5_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h5_responsive_680' );
		$h6_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_h6_responsive_680' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( 'body', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h1',
					'.qodef-h1',
				),
				$h1_styles
			);
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h2',
					'.qodef-h2',
				),
				$h2_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--checkout #customer_details h3',
					'#qodef-woo-page.qodef--checkout #order_review_heading',
				),
				$h2_styles
			);
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h3',
					'.qodef-h3',
				),
				$h3_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-Reviews-title',
					'#qodef-woo-page.qodef--single #review_form .comment-reply-title',
					'#qodef-woo-page.qodef--cart .cart_totals > h2',
					'#qodef-woo-page.qodef--cart .cross-sells > h2',
					'.woocommerce-page div.woocommerce > .cart-empty',
					'body[class*="theme-qi"] #qodef-related-posts .qodef-m-title',
				),
				$h3_styles
			);
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h4',
					'.qodef-h4',
				),
				$h4_styles
			);
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h5',
					'.qodef-h5',
				),
				$h5_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-tabs .wc-tabs li a',
					'.woocommerce-page div.woocommerce .shop_table th',
					'#qodef-woo-page.qodef--cart .shop_table td.product-name a',
				),
				$h5_styles
			);
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'h6',
					'.qodef-h6',
				),
				$h6_styles
			);

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-sidebar .widget.widget_recent_entries ul li a',
					'#qodef-page-sidebar .wp-block-latest-posts li a',
					'#qodef-woo-page.qodef--single .shop_attributes th',
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-review__author',
				),
				$h6_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_responsive_680_inline_style', 'qode_essential_addons_set_general_typography_responsive_680_styles' );
}
