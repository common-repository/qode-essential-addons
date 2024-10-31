<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_register_product_for_meta_options' ) ) {
	/**
	 * Function that register product post type for meta box options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function qode_essential_addons_register_product_for_meta_options( $post_types ) {
		$post_types[] = 'product';

		return $post_types;
	}

	add_filter( 'qode_essential_addons_filter_framework_meta_box_save', 'qode_essential_addons_register_product_for_meta_options' );
	add_filter( 'qode_essential_addons_filter_framework_meta_box_remove', 'qode_essential_addons_register_product_for_meta_options' );
}

if ( ! function_exists( 'qode_essential_addons_woo_get_global_product' ) ) {
	/**
	 * Function that return global WooCommerce object
	 *
	 * @return object
	 */
	function qode_essential_addons_woo_get_global_product() {
		global $product;

		return $product;
	}
}

if ( ! function_exists( 'qode_essential_addons_woo_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param int $position
	 * @param string $map
	 *
	 * @return int
	 */
	function qode_essential_addons_woo_set_admin_options_map_position( $position, $map ) {

		if ( 'woocommerce' === $map ) {
			$position = 70;
		}

		return $position;
	}

	add_filter( 'qode_essential_addons_filter_admin_options_map_position', 'qode_essential_addons_woo_set_admin_options_map_position', 10, 2 );
}

if ( ! function_exists( 'qode_essential_addons_include_woocommerce_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function qode_essential_addons_include_woocommerce_shortcodes() {
		foreach ( glob( QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/woocommerce/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_essential_addons_action_framework_before_shortcodes_register', 'qode_essential_addons_include_woocommerce_shortcodes' );
}

if ( ! function_exists( 'qode_essential_addons_woo_product_get_rating_html' ) ) {
	/**
	 * Function that return ratings templates
	 *
	 * @param string $html - contains html content
	 * @param float $rating
	 *
	 * @return string
	 */
	function qode_essential_addons_woo_product_get_rating_html( $html, $rating ) {

		if ( ! empty( $rating ) ) {
			$html  = '<div class="qodef-m-inner">';
			$html .= '<div class="qodef-m-star qodef--initial">';
			for ( $i = 0; $i < 5; $i++ ) {
				$html .= qode_essential_addons_get_svg_icon( 'star', 'qodef-m-star-item' );
			}
			$html .= '</div>';
			$html .= '<div class="qodef-m-star qodef--active" style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
			for ( $i = 0; $i < 5; $i++ ) {
				$html .= qode_essential_addons_get_svg_icon( 'star', 'qodef-m-star-item' );
			}
			$html .= '</div>';
			$html .= '</div>';
		}

		return $html;
	}
}

if ( ! function_exists( 'qode_essential_addons_woo_get_product_categories' ) ) {
	/**
	 * Function that render product categories
	 *
	 * @param string $before
	 * @param string $after
	 *
	 * @return string
	 */
	function qode_essential_addons_woo_get_product_categories( $before = '', $after = '' ) {
		global $product;

		return ! empty( $product ) ? wc_get_product_category_list( $product->get_id(), '<span class="qodef-category-separator"></span>', $before, $after ) : '';
	}
}

if ( ! function_exists( 'qode_essential_addons_woo_product_list_columns' ) ) {
	/**
	 * Function that set number of columns for main shop page
	 *
	 * @return int
	 */
	function qode_essential_addons_woo_product_list_columns() {
		$option = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_columns' );

		if ( ! empty( $option ) ) {
			$columns = intval( $option );
		} else {
			$columns = 3;
		}

		return $columns;
	}

	add_filter( 'loop_shop_columns', 'qode_essential_addons_woo_product_list_columns' );
}


if ( ! function_exists( 'qode_essential_addons_woo_product_list_space' ) ) {
	/**
	 * Function that set space between items on shop page
	 *
	 * @return int
	 */
	function qode_essential_addons_woo_product_list_space( $classes ) {
		$space = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_space' );

		if ( ! empty( $space ) ) {
			$classes[] = 'qodef-gutter--' . $space;
		}

		return $classes;
	}

	add_filter( 'qi_filter_woo_product_list_item_classes', 'qode_essential_addons_woo_product_list_space' );
}

if ( ! function_exists( 'qode_essential_addons_is_woo_archive_page' ) ) {
	/**
	 * Function that return is WooCommerce archive page
	 *
	 * @return bool
	 */
	function qode_essential_addons_is_woo_archive_page() {
		$is_archive = ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product_category' ) && is_product_category() ) || ( function_exists( 'is_product_tag' ) && is_product_tag() );

		return $is_archive;
	}
}

if ( ! function_exists( 'qode_essential_addons_set_woo_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function qode_essential_addons_set_woo_sidebar_layout( $layout ) {

		if ( qode_essential_addons_is_woo_archive_page() ) {
			$option = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_sidebar_layout' );

			if ( isset( $option ) && ! empty( $option ) ) {
				$layout = $option;
			}
		}

		return $layout;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_sidebar_layout', 'qode_essential_addons_set_woo_sidebar_layout' );
	add_filter( 'the_q_filter_sidebar_layout', 'qode_essential_addons_set_woo_sidebar_layout' );
	add_filter( 'qi_filter_sidebar_layout', 'qode_essential_addons_set_woo_sidebar_layout' );
	add_filter( 'qi_gutenberg_filter_sidebar_layout', 'qode_essential_addons_set_woo_sidebar_layout' );
}

if ( ! function_exists( 'qode_essential_addons_set_woo_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function qode_essential_addons_set_woo_custom_sidebar_name( $sidebar_name ) {

		if ( qode_essential_addons_is_woo_archive_page() ) {
			$option = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_custom_sidebar' );

			if ( isset( $option ) && ! empty( $option ) ) {
				$sidebar_name = $option;
			}
		}

		return $sidebar_name;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_sidebar_name', 'qode_essential_addons_set_woo_custom_sidebar_name' );
	add_filter( 'the_q_filter_sidebar_name', 'qode_essential_addons_set_woo_custom_sidebar_name' );
	add_filter( 'qi_filter_sidebar_name', 'qode_essential_addons_set_woo_custom_sidebar_name' );
	add_filter( 'qi_gutenberg_filter_sidebar_name', 'qode_essential_addons_set_woo_custom_sidebar_name' );
}

if ( ! function_exists( 'qode_essential_addons_set_woo_product_list_item_title_tag' ) ) {
	/**
	 * Function that return title tag value for product item
	 *
	 * @param string $title_tag
	 *
	 * @return string
	 */
	function qode_essential_addons_set_woo_product_list_item_title_tag( $title_tag ) {
		$option = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_title_tag' );

		if ( isset( $option ) && ! empty( $option ) ) {
			$title_tag = $option;
		}

		return $title_tag;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_woo_product_list_item_title_tag', 'qode_essential_addons_set_woo_product_list_item_title_tag' );
	add_filter( 'the_q_filter_woo_product_list_item_title_tag', 'qode_essential_addons_set_woo_product_list_item_title_tag' );
	add_filter( 'qi_filter_woo_product_list_item_title_tag', 'qode_essential_addons_set_woo_product_list_item_title_tag' );
	add_filter( 'qi_gutenberg_filter_woo_product_list_item_title_tag', 'qode_essential_addons_set_woo_product_list_item_title_tag' );
}

if ( ! function_exists( 'qode_essential_addons_set_woo_product_single_item_title_tag' ) ) {
	/**
	 * Function that return title tag value for product item
	 *
	 * @param string $title_tag
	 *
	 * @return string
	 */
	function qode_essential_addons_set_woo_product_single_item_title_tag( $title_tag ) {
		$option = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_single_title_tag' );

		if ( isset( $option ) && ! empty( $option ) ) {
			$title_tag = $option;
		}

		return $title_tag;
	}

	// @WPThemeHookList.
	add_filter( 'the_two_filter_woo_product_single_item_title_tag', 'qode_essential_addons_set_woo_product_single_item_title_tag' );
	add_filter( 'the_q_filter_woo_product_single_item_title_tag', 'qode_essential_addons_set_woo_product_single_item_title_tag' );
	add_filter( 'qi_filter_woo_product_single_item_title_tag', 'qode_essential_addons_set_woo_product_single_item_title_tag' );
	add_filter( 'qi_gutenberg_filter_woo_product_single_item_title_tag', 'qode_essential_addons_set_woo_product_single_item_title_tag' );
}

if ( ! function_exists( 'qode_essential_addons_set_product_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_product_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$category_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_product_category' );
		$category_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_product_category' );

		if ( ! empty( $category_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-woo-product-list .qodef-woo-product-categories',
					'.qodef-woo-shortcode-product-list .qodef-woo-product-categories',
				),
				$category_styles
			);

			// If text decoration is set through the option, override default link style for product info.
			if ( isset( $category_styles['text-decoration'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'.qodef-woo-product-list .qodef-woo-product-categories a',
						'.qodef-woo-shortcode-product-list .qodef-woo-product-categories a',
					),
					array(
						'text-decoration' => 'inherit',
					)
				);
			}
		}

		if ( ! empty( $category_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-woo-product-list .qodef-woo-product-categories a:hover',
					'.qodef-woo-product-list .qodef-woo-product-categories a:focus',
					'.qodef-woo-shortcode-product-list .qodef-woo-product-categories a:hover',
					'.qodef-woo-shortcode-product-list .qodef-woo-product-categories a:focus',
				),
				$category_hover_styles
			);
		}

		$price_styles        = qode_essential_addons_get_typography_styles( $scope, 'qodef_product_price' );
		$price_single_styles = qode_essential_addons_get_typography_styles( $scope, 'qodef_product_single_price' );

		if ( ! empty( $price_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array_merge(
					array(
						'#qodef-woo-page .price',
						'.qodef-woo-shortcode .price',
					),
					array(
						'body[class*="theme-qi"] .widget.woocommerce.widget_products ul li .amount',
						'body[class*="theme-qi"] .widget.woocommerce.widget_recent_reviews ul li .amount',
						'body[class*="theme-qi"] .widget.woocommerce.widget_recently_viewed_products ul li .amount',
						'body[class*="theme-qi"] .widget.woocommerce.widget_top_rated_products ul li .amount',
					)
				),
				$price_styles
			);
		}

		if ( ! empty( $price_single_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .entry-summary .price',
				),
				$price_single_styles
			);
		}

		$price_discount_styles        = array();
		$price_discount_color         = qode_essential_addons_get_option_value( 'admin', 'qodef_product_price_discount_color' );
		$price_single_discount_styles = array();
		$price_single_discount_color  = qode_essential_addons_get_option_value( 'admin', 'qodef_product_single_price_discount_color' );

		if ( ! empty( $price_discount_color ) ) {
			$price_discount_styles['color'] = $price_discount_color;
		}

		if ( ! empty( $price_single_discount_color ) ) {
			$price_single_discount_styles['color'] = $price_single_discount_color;
		}

		if ( ! empty( $price_discount_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page .price del',
					'.qodef-woo-shortcode .price del',
				),
				$price_discount_styles
			);
		}

		if ( ! empty( $price_single_discount_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .entry-summary .price del',
				),
				$price_single_discount_styles
			);
		}

		$label_styles      = qode_essential_addons_get_typography_styles( $scope, 'qodef_product_label' );
		$info_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_product_info' );
		$info_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_product_info' );

		if ( ! empty( $label_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .product_meta > *',
				),
				$label_styles
			);

			if ( isset( $label_styles['color'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'#qodef-woo-page .qodef-woo-ratings .qodef-m-star',
						'#qodef-woo-page.qodef--single #review_form .comment-form-rating a',
					),
					array(
						'color' => $label_styles['color'],
					)
				);
			}
		}

		if ( ! empty( $info_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .product_meta > * > a',
					'#qodef-woo-page.qodef--single .product_meta > * > span',
					'#qodef-woo-page.qodef--single .shop_attributes td',
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .comment-text .meta time',
				),
				$info_styles
			);
		}

		if ( ! empty( $info_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .product_meta > * > a:hover',
					'#qodef-woo-page.qodef--single .product_meta > * > a:focus',
				),
				$info_hover_styles
			);
		}

		$cart_dropdown_styles           = array();
		$cart_dropdown_width            = qode_essential_addons_get_option_value( 'admin', 'qodef_product_cart_width' );
		$cart_dropdown_background_color = qode_essential_addons_get_option_value( 'admin', 'qodef_product_cart_background_color' );
		$cart_dropdown_padding          = qode_essential_addons_get_option_value( 'admin', 'qodef_product_cart_padding' );

		if ( ! empty( $cart_dropdown_width ) ) {
			$cart_dropdown_styles['width'] = intval( $cart_dropdown_width ) . 'px';
		}

		if ( ! empty( $cart_dropdown_background_color ) ) {
			$cart_dropdown_styles['background-color'] = $cart_dropdown_background_color;
		}

		if ( ! empty( $cart_dropdown_padding ) ) {
			$cart_dropdown_styles['padding'] = intval( $cart_dropdown_padding ) . 'px';
		}

		if ( ! empty( $cart_dropdown_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-page-header .widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content',
				),
				$cart_dropdown_styles
			);
		}

		$cart_item_styles        = array();
		$cart_item_margin_bottom = qode_essential_addons_get_option_value( 'admin', 'qodef_product_cart_item_margin_bottom' );

		if ( ! empty( $cart_item_margin_bottom ) ) {
			$cart_item_styles['margin-bottom'] = intval( $cart_item_margin_bottom ) . 'px';
		}

		if ( ! empty( $cart_item_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.widget.woocommerce.widget_shopping_cart .widget_shopping_cart_content ul li',
				),
				$cart_item_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_product_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_woo_draw_classes' ) ) {

	function qode_essential_addons_set_woo_draw_classes( $classes ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$category_draw_classes = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_product_category' );
		$info_draw_classes     = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_product_info' );

		if ( ! empty( $category_draw_classes ) ) {
			$classes[] = $category_draw_classes;
		}

		if ( ! empty( $info_draw_classes ) ) {
			$classes[] = $info_draw_classes;
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_set_woo_draw_classes' );
}

if ( ! function_exists( 'qode_essential_addons_add_woo_product_list_grid_classes' ) ) {
	/**
	 * Function that set space between items on shop page
	 *
	 * @return int
	 */
	function qode_essential_addons_add_woo_product_list_grid_classes( $classes ) {
		$classes[] = 'qodef-grid';

		return $classes;
	}

	add_filter( 'qi_filter_woo_product_list_item_classes', 'qode_essential_addons_add_woo_product_list_grid_classes' );
}

if ( ! function_exists( 'qode_essential_addons_add_woo_item_grid_classes' ) ) {

	function qode_essential_addons_add_woo_item_grid_classes( $classes ) {

		if ( 'product' == get_post_type() ) {
			$classes[] = 'qodef-grid-item';
		}

		return $classes;
	}

	add_filter( 'woocommerce_post_class', 'qode_essential_addons_add_woo_item_grid_classes' );
}

if ( ! function_exists( 'qode_essential_addons_woocommerce_review_gravatar_size' ) ) {
	function qode_essential_addons_woocommerce_review_gravatar_size() {
		return '132';
	}

	add_filter( 'woocommerce_review_gravatar_size', 'qode_essential_addons_woocommerce_review_gravatar_size' );
}

if ( ! function_exists( 'qode_essential_addons_qi_product_thumbnail_id' ) ) {
	function qode_essential_addons_qi_product_thumbnail_id( $thumbnail_id, $product_id ) {

		if ( get_post_meta( $product_id, 'qodef_product_list_image', true ) !== '' ) {
			$thumbnail_id = get_post_meta( $product_id, 'qodef_product_list_image', true );
		}

		return $thumbnail_id;
	}

	add_filter( 'qi_addons_for_elementor_filter_product_list_thumbnail_id', 'qode_essential_addons_qi_product_thumbnail_id', 10, 2 );
	add_filter( 'qi_addons_for_elementor_filter_product_slider_thumbnail_id', 'qode_essential_addons_qi_product_thumbnail_id', 10, 2 );
}

if ( ! function_exists( 'qode_essential_addons_qi_woo_single_gallery_zoom' ) ) {
	function qode_essential_addons_qi_woo_single_gallery_zoom() {
		$zoom = qode_essential_addons_get_option_value( 'admin', 'qodef_woo_single_enable_zoom' );

		if ( 'no' === $zoom ) {
			remove_theme_support( 'wc-product-gallery-zoom' );
		}
	}

	// 7 is to be before woocommerce enqueue assets.
	add_action( 'wp_enqueue_scripts', 'qode_essential_addons_qi_woo_single_gallery_zoom', 7 );
}

if ( ! function_exists( 'qode_essential_addons_qi_woo_list_image_style' ) ) {
	function qode_essential_addons_qi_woo_list_image_style( $styles ) {
		$image_border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_image_border_radius' );

		if ( '' !== $image_border_radius ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $image_border_radius, true ) ) {
				$styles[] = 'border-radius: ' . $image_border_radius;
			} else {
				$styles[] = 'border-radius: ' . intval( $image_border_radius ) . 'px';
			}
		}

		return $styles;
	}

	add_filter( 'qi_filter_woo_product_list_item_image_style', 'qode_essential_addons_qi_woo_list_image_style' );
}

if ( ! function_exists( 'qode_essential_addons_qi_woo_list_image_inner_style' ) ) {
	function qode_essential_addons_qi_woo_list_image_inner_style( $styles ) {

		$image_hover_background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_product_list_image_hover_background_color' );

		if ( '' !== $image_hover_background_color ) {
			$styles[] = 'background-color: ' . $image_hover_background_color;
		}

		return $styles;
	}

	add_filter( 'qi_filter_woo_product_list_item_image_inner_style', 'qode_essential_addons_qi_woo_list_image_inner_style' );
}

if ( ! function_exists( 'qode_essential_addons_qi_woo_single_image_style' ) ) {
	function qode_essential_addons_qi_woo_single_image_style( $styles ) {

		$image_border_radius = qode_essential_addons_get_post_value_through_levels( 'qodef_woo_single_image_border_radius' );

		if ( '' !== $image_border_radius ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $image_border_radius, true ) ) {
				$border_radius = $image_border_radius;
			} else {
				$border_radius = intval( $image_border_radius ) . 'px';
			}

			$styles .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .woocommerce-product-gallery figure > .woocommerce-product-gallery__image',
				),
				array( 'border-radius' => $border_radius )
			);
		}

		return $styles;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_qi_woo_single_image_style' );
}
