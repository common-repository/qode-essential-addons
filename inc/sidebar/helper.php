<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_get_main_sidebar_config' ) ) {
	/**
	 * Function that return config variables for main sidebar area
	 *
	 * @return array
	 */
	function qode_essential_addons_get_main_sidebar_config() {

		// Config variables.
		$config = apply_filters(
			'qode_essential_addons_filter_main_sidebar_config',
			array(
				'title_tag'   => 'h4',
				'title_class' => 'qodef-widget-title',
			)
		);

		return $config;
	}

	add_filter( 'qode_essential_addons_filter_framework_main_sidebar_config', 'qode_essential_addons_get_main_sidebar_config' );
}

if ( ! function_exists( 'qode_essential_addons_register_main_sidebar' ) ) {
	/**
	 * Function that registers theme's main sidebar area
	 */
	function qode_essential_addons_register_main_sidebar() {

		if ( qode_essential_addons_is_qode_theme_installed() ) {
			// Sidebar config variables.
			$config = qode_essential_addons_get_main_sidebar_config();

			register_sidebar(
				array(
					'id'            => 'main-sidebar',
					'name'          => esc_html__( 'Main Sidebar', 'qode-essential-addons' ),
					'description'   => esc_html__( 'In order to display widgets inside this area you need to set sidebar layout option inside general options or meta box options', 'qode-essential-addons' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="main-sidebar">',
					'after_widget'  => '</div>',
					'before_title'  => '<' . esc_attr( $config['title_tag'] ) . ' class="' . esc_attr( $config['title_class'] ) . '">',
					'after_title'   => '</' . esc_attr( $config['title_tag'] ) . '>',
				)
			);
		}
	}

	// Permission 1 is set to main sidebar be at the first place.
	add_action( 'widgets_init', 'qode_essential_addons_register_main_sidebar', 1 );
}

if ( ! function_exists( 'qode_essential_addons_set_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function qode_essential_addons_set_custom_sidebar_name( $sidebar_name ) {
		$option = qode_essential_addons_get_post_value_through_levels( 'qodef_page_custom_sidebar' );

		if ( ! empty( $option ) ) {
			$sidebar_name = $option;
		}

		return $sidebar_name;
	}

	// @WPThemeHookList.
	// permission 5 is set to global option check be at the first place.
	add_filter( 'the_two_filter_sidebar_name', 'qode_essential_addons_set_custom_sidebar_name', 5 );
	add_filter( 'the_q_filter_sidebar_name', 'qode_essential_addons_set_custom_sidebar_name', 5 );
	add_filter( 'qi_filter_sidebar_name', 'qode_essential_addons_set_custom_sidebar_name', 5 );
	add_filter( 'qi_gutenberg_filter_sidebar_name', 'qode_essential_addons_set_custom_sidebar_name', 5 );
}

if ( ! function_exists( 'qode_essential_addons_set_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function qode_essential_addons_set_sidebar_layout( $layout ) {
		$option = qode_essential_addons_get_post_value_through_levels( 'qodef_page_sidebar_layout' );

		if ( ! empty( $option ) ) {
			$layout = $option;
		}

		return $layout;
	}

	// @WPThemeHookList.
	// permission 5 is set to global option check be at the first place.
	add_filter( 'the_two_filter_sidebar_layout', 'qode_essential_addons_set_sidebar_layout', 5 );
	add_filter( 'the_q_filter_sidebar_layout', 'qode_essential_addons_set_sidebar_layout', 5 );
	add_filter( 'qi_filter_sidebar_layout', 'qode_essential_addons_set_sidebar_layout', 5 );
	add_filter( 'qi_gutenberg_filter_sidebar_layout', 'qode_essential_addons_set_sidebar_layout', 5 );
}

if ( ! function_exists( 'qode_essential_addons_set_page_sidebar_widget_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_page_sidebar_widget_styles( $style ) {
		$styles        = array();
		$margin_bottom = qode_essential_addons_get_option_value( 'admin', 'qodef_page_sidebar_widgets_margin_bottom' );

		if ( ! empty( $margin_bottom ) ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $margin_bottom, true ) ) {
				$styles['margin-bottom'] = $margin_bottom;
			} else {
				$styles['margin-bottom'] = intval( $margin_bottom ) . 'px';
			}
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-sidebar .widget', $styles );
		}

		$title_styles        = array();
		$title_margin_bottom = qode_essential_addons_get_option_value( 'admin', 'qodef_page_sidebar_widgets_title_margin_bottom' );

		if ( ! empty( $title_margin_bottom ) ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $title_margin_bottom, true ) ) {
				$title_styles['margin-bottom'] = $title_margin_bottom;
			} else {
				$title_styles['margin-bottom'] = intval( $title_margin_bottom ) . 'px';
			}
		}

		if ( ! empty( $title_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-sidebar .widget .qodef-widget-title', $title_styles );
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_page_sidebar_widget_styles' );
}
