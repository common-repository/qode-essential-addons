<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_include_portfolio_media_fields' ) ) {
	/**
	 * Function that include module custom media options
	 */
	function qode_essential_addons_include_portfolio_media_fields() {
		foreach ( glob( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/portfolio/dashboard/media/*.php' ) as $media ) {
			include_once $media;
		}
	}

	add_action( 'qode_essential_addons_action_framework_custom_media_fields', 'qode_essential_addons_include_portfolio_media_fields' );
}

if ( ! function_exists( 'qode_essential_addons_generate_portfolio_single_layout' ) ) {
	/**
	 * Function that return default layout for custom post type single page
	 *
	 * @return string
	 */
	function qode_essential_addons_generate_portfolio_single_layout() {
		$portfolio_template = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_single_layout' );
		$portfolio_template = ! empty( $portfolio_template ) ? $portfolio_template : 'images-big';

		return $portfolio_template;
	}

	add_filter( 'qode_essential_addons_filter_portfolio_single_layout', 'qode_essential_addons_generate_portfolio_single_layout' );
}

if ( ! function_exists( 'qode_essential_addons_get_portfolio_holder_classes' ) ) {
	/**
	 * Function that return classes for the main portfolio holder
	 *
	 * @return string
	 */
	function qode_essential_addons_get_portfolio_holder_classes() {
		$classes = array( 'qodef-portfolio-single' );

		$item_layout        = qode_essential_addons_generate_portfolio_single_layout();
		$content_order      = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_single_content_order' );
		$info_text_position = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_single_info_item_text_position' );

		if ( ! empty( $item_layout ) ) {
			$classes[] = 'qodef-layout--' . $item_layout;
		}

		if ( ! empty( $content_order ) ) {
			$classes[] = 'qodef-content-order--' . $content_order;
		}

		if ( ! empty( $info_text_position ) ) {
			$classes[] = 'qodef-info-text-position--' . $info_text_position;
		}

		return implode( ' ', $classes );
	}
}

if ( ! function_exists( 'qode_essential_addons_set_portfolio_single_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function qode_essential_addons_set_portfolio_single_body_classes( $classes ) {
		$item_layout = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_single_layout' );

		if ( is_singular( 'portfolio-item' ) && ! empty( $item_layout ) ) {
			$classes[] = 'qodef-layout--' . $item_layout;
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_set_portfolio_single_body_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_portfolio_single_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function qode_essential_addons_set_portfolio_single_grid_gutter_classes( $classes ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$option = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_single_grid_gutter' );

			if ( ! empty( $option ) ) {
				$classes = 'qodef-gutter--' . esc_attr( $option );
			}
		}

		return $classes;
	}

	add_filter( 'qode_essential_addons_filter_grid_gutter_classes', 'qode_essential_addons_set_portfolio_single_grid_gutter_classes' );
}

if ( ! function_exists( 'qode_essential_addons_generate_portfolio_archive_with_shortcode' ) ) {
	/**
	 * Function that executes portfolio list shortcode with params on archive pages
	 *
	 * @param string $tax - type of taxonomy
	 * @param string $tax_slug - slug of taxonomy
	 *
	 */
	function qode_essential_addons_generate_portfolio_archive_with_shortcode( $tax, $tax_slug ) {
		$params = apply_filters( 'qode_essential_addons_filter_generate_portfolio_archive_with_shortcode', $params = array() );

		$params['additional_params']        = 'tax';
		$params['tax']                      = $tax;
		$params['tax_slug']                 = $tax_slug;
		$params['layout']                   = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_archive_item_layout' );
		$params['columns']                  = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_archive_columns' );
		$params['space']                    = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_archive_space' );
		$params['content_order']            = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_content_order' );
		$params['content_background_color'] = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_content_background_color' );
		$params['center_content']           = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_center_content' );
		$params['show_button']              = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_show_button' );
		$params['enable_pagination']        = 'yes';

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo QodeEssentialAddons_Portfolio_List_Shortcode::call_shortcode( $params );
	}
}

if ( ! function_exists( 'qode_essential_addons_fix_portfolio_archive_shortcode_pagination' ) ) {
	/**
	 * Function that fix portfolio list shortcode pagination on archive pages
	 *
	 * @param array $query_string - type of taxonomy
	 *
	 * @return array
	 */
	function qode_essential_addons_fix_portfolio_archive_shortcode_pagination( $query_string ) {

		if ( is_admin() || ! is_array( $query_string ) ) {
			return $query_string;
		}

		if ( key_exists( 'portfolio-category', $query_string ) || key_exists( 'portfolio-tag', $query_string ) ) {
			$query_string['posts_per_page'] = 2;
		}

		return $query_string;
	}

	add_filter( 'request', 'qode_essential_addons_fix_portfolio_archive_shortcode_pagination' );
}

if ( ! function_exists( 'qode_essential_addons_portfolio_breadcrumbs_title' ) ) {
	/**
	 * Improve main breadcrumbs template with additional cases
	 *
	 * @param string|html $wrap_child
	 * @param array       $settings
	 *
	 * @return string
	 */
	function qode_essential_addons_portfolio_breadcrumbs_title( $wrap_child, $settings ) {
		$taxonomies = get_object_taxonomies( array( 'post_type' => 'portfolio-item' ) );

		foreach ( $taxonomies as $taxonomy ) {
			if ( is_tax( $taxonomy ) ) {
				$wrap_child  = '';
				$term_object = get_term( get_queried_object_id(), $taxonomy );

				if ( isset( $term_object->parent ) && 0 !== $term_object->parent ) {
					$parent      = get_term( $term_object->parent );
					$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
				}

				$wrap_child .= sprintf( $settings['current_item'], single_cat_title( '', false ) );
			}
		}

		if ( is_singular( 'portfolio-item' ) ) {
			$wrap_child = '';
			$post_terms = wp_get_post_terms( get_the_ID(), 'portfolio-category' );

			if ( ! empty( $post_terms ) ) {
				$post_term = $post_terms[0];
				if ( isset( $post_term->parent ) && 0 !== $post_term->parent ) {
					$parent      = get_term( $post_term->parent );
					$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
				}
				$wrap_child .= sprintf( $settings['link'], get_term_link( $post_term ), $post_term->name ) . $settings['separator'];
			}

			$wrap_child .= sprintf( $settings['current_item'], get_the_title() );
		}

		return $wrap_child;
	}

	add_filter( 'qode_essential_addons_filter_breadcrumbs_content', 'qode_essential_addons_portfolio_breadcrumbs_title', 10, 2 );
}

if ( ! function_exists( 'qode_essential_addons_portfolio_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param int    $position
	 * @param string $map
	 *
	 * @return int
	 */
	function qode_essential_addons_portfolio_set_admin_options_map_position( $position, $map ) {

		if ( 'portfolio' === $map ) {
			$position = 50;
		}

		return $position;
	}

	add_filter( 'qode_essential_addons_filter_admin_options_map_position', 'qode_essential_addons_portfolio_set_admin_options_map_position', 10, 2 );
}

if ( ! function_exists( 'qode_essential_addons_get_portfolio_single_post_taxonomies' ) ) {
	/**
	 * Function that return single post taxonomies list
	 *
	 * @param int $post_id
	 *
	 * @return array
	 */
	function qode_essential_addons_get_portfolio_single_post_taxonomies( $post_id ) {
		$options = array();

		if ( ! empty( $post_id ) ) {
			$options['portfolio-tag']      = wp_get_post_terms( $post_id, 'portfolio-tag' );
			$options['portfolio-category'] = wp_get_post_terms( $post_id, 'portfolio-category' );
		}

		return $options;
	}
}

if ( ! function_exists( 'qode_essential_addons_set_portfolio_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_portfolio_styles( $style ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$media_style = array();

		$category_styles       = qode_essential_addons_get_typography_styles( $scope, 'qodef_portfolio_category' );
		$category_hover_styles = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_portfolio_category' );
		$label_styles          = qode_essential_addons_get_typography_styles( $scope, 'qodef_portfolio_label' );
		$label_margin          = qode_essential_addons_get_option_value( 'admin', 'qodef_portfolio_label_margin_bottom' );
		$info_styles           = qode_essential_addons_get_typography_styles( $scope, 'qodef_portfolio_info' );
		$info_hover_styles     = qode_essential_addons_get_typography_hover_styles( $scope, 'qodef_portfolio_info' );
		$space_between_images  = qode_essential_addons_get_option_value( 'admin', 'qodef_portfolio_single_image_spacing' );

		if ( ! empty( $category_styles ) ) {

			if ( isset( $category_styles['color'] ) ) {
				$style .= qode_essential_addons_framework_dynamic_style(
					array(
						'.qodef-portfolio-list .qodef-e-info-category',
					),
					array(
						'color' => $category_styles['color'],
					)
				);
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-portfolio-list .qodef-e-info-category a',
					'.qodef-e-content-follow .qodef-e-content .qodef-e-category-holder .qodef-e-info-category',
				),
				$category_styles
			);
		}

		if ( ! empty( $category_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-portfolio-list .qodef-e-info-category a:hover',
					'.qodef-portfolio-list .qodef-e-info-category a:focus',
				),
				$category_hover_styles
			);
		}

		$label_styles_additional = array();

		if ( ! empty( $label_margin ) || '0' === $label_margin ) {
			if ( qode_essential_addons_framework_string_ends_with_typography_units( $label_margin ) ) {
				$label_styles_additional['margin-bottom'] = $label_margin;
			} else {
				$label_styles_additional['margin-bottom'] = $label_margin . 'px';
			}

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-portfolio-single .qodef-portfolio-info .qodef-style--meta',
					'.qodef-portfolio-single.qodef-info-text-position--adjacent .qodef-portfolio-info .qodef-style--meta',
				),
				$label_styles_additional
			);
		}

		if ( ! empty( $label_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-portfolio-single .qodef-portfolio-info .qodef-style--meta',
					'.qodef-portfolio-single.qodef-info-text-position--adjacent .qodef-portfolio-info .qodef-style--meta',
					'.qodef-portfolio-project-info .qodef-e-label',
				),
				$label_styles
			);
		}

		if ( ! empty( $info_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-portfolio-single .qodef-portfolio-info p',
					'.qodef-portfolio-single .qodef-portfolio-info a',
					'.qodef-portfolio-single .qodef-portfolio-info .qodef-e > span',
					'.qodef-portfolio-project-info .qodef-e-info-data',
					'.qodef-portfolio-project-info .qodef-e-info-data a',
				),
				$info_styles
			);
		}

		if ( ! empty( $info_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-portfolio-single .qodef-portfolio-info a:hover',
					'.qodef-portfolio-project-info .qodef-e-info-data a:hover',
				),
				$info_hover_styles
			);
		}

		if ( ! empty( $space_between_images ) ) {
			$media_style['margin-bottom'] = $space_between_images . 'px !important';

			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-portfolio-single .qodef-media .qodef-grid-item:not(:last-child)',
				),
				$media_style
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_portfolio_styles' );
}

if ( ! function_exists( 'qode_essential_addons_set_portfolio_draw_classes' ) ) {

	function qode_essential_addons_set_portfolio_draw_classes( $classes ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		$category_draw_classes = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_portfolio_category' );
		$info_draw_classes     = qode_essential_addons_get_typography_draw_classes( $scope, 'qodef_portfolio_info' );

		if ( ! empty( $category_draw_classes ) ) {
			$classes [] = $category_draw_classes;
		}

		if ( ! empty( $info_draw_classes ) ) {
			$classes [] = $info_draw_classes;
		}

		return $classes;
	}

	add_filter( 'body_class', 'qode_essential_addons_set_portfolio_draw_classes' );
}

if ( ! function_exists( 'qode_essential_addons_set_portfolio_full_width_class' ) ) {

	function qode_essential_addons_set_portfolio_full_width_class( $classes ) {

		$slug               = 'full-width';
		$portfolio_template = qode_essential_addons_get_post_value_through_levels( 'qodef_portfolio_single_layout' );
		$slug_length        = strlen( $slug );
		$is_full_width      = substr( $portfolio_template, - $slug_length ) === $slug;

		if ( ! empty( $portfolio_template ) && $is_full_width && is_singular( 'portfolio-item' ) ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'qi_filter_page_inner_classes', 'qode_essential_addons_set_portfolio_full_width_class' );
}
