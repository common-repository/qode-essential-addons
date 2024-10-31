<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_is_side_area_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function qode_essential_addons_is_side_area_enabled() {
		$is_enabled = is_active_widget( false, false, 'qode_essential_addons_side_area_opener' );

		return apply_filters( 'qode_essential_addons_filter_enable_side_area', $is_enabled );
	}
}

if ( ! function_exists( 'qode_essential_addons_register_side_area_style' ) ) {
	/**
	 * Function that include modules 3rd party scripts
	 */
	function qode_essential_addons_register_side_area_style() {
		if ( qode_essential_addons_is_side_area_enabled() ) {
			wp_enqueue_style( 'perfect-scrollbar', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array(), '1.5.3' );
		}
	}

	add_action( 'qode_essential_addons_action_before_main_css', 'qode_essential_addons_register_side_area_style' );
}

if ( ! function_exists( 'qode_essential_addons_register_side_area_scripts' ) ) {
	/**
	 * Function that include modules 3rd party scripts
	 */
	function qode_essential_addons_register_side_area_scripts() {
		if ( qode_essential_addons_is_side_area_enabled() ) {
			wp_enqueue_script( 'perfect-scrollbar', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js', array( 'jquery' ), '1.5.3', true );
		}
	}

	add_action( 'qode_essential_addons_action_before_main_js', 'qode_essential_addons_register_side_area_scripts' );
}

if ( ! function_exists( 'qode_essential_addons_load_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function qode_essential_addons_load_side_area() {

		if ( qode_essential_addons_is_side_area_enabled() ) {
			$params = array(
				'holder_classes' => '',
			);

			$skin = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_widgets_skin' );

			if ( ! empty( $skin ) ) {
				$params['holder_classes'] = 'qodef-widgets-skin--' . esc_attr( $skin );
			}

			qode_essential_addons_template_part( 'side-area', 'templates/side-area', '', $params );
		}
	}

	add_action( 'wp_footer', 'qode_essential_addons_load_side_area', 10 );
}

if ( ! function_exists( 'qode_essential_addons_get_side_area_config' ) ) {
	/**
	 * Function that return config variables for side area
	 *
	 * @return array
	 */
	function qode_essential_addons_get_side_area_config() {

		// Config variables.
		$config = apply_filters(
			'qode_essential_addons_filter_side_area_config',
			array(
				'title_tag'   => 'h4',
				'title_class' => 'qodef-widget-title',
			)
		);

		return $config;
	}
}

if ( ! function_exists( 'qode_essential_addons_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function qode_essential_addons_register_side_area_sidebar() {

		// Sidebar config variables.
		$config = qode_essential_addons_get_side_area_config();

		register_sidebar(
			array(
				'id'            => 'qodef-side-area',
				'name'          => esc_html__( 'Side Area', 'qode-essential-addons' ),
				'description'   => esc_html__( 'Widgets added here will appear in side area', 'qode-essential-addons' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s" data-area="side-area">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . esc_attr( $config['title_tag'] ) . ' class="' . esc_attr( $config['title_class'] ) . '">',
				'after_title'   => '</' . esc_attr( $config['title_tag'] ) . '>',
			)
		);
	}

	add_action( 'widgets_init', 'qode_essential_addons_register_side_area_sidebar' );
}

if ( ! function_exists( 'qode_essential_addons_include_side_area_widget' ) ) {
	/**
	 * Function that includes widgets
	 */
	function qode_essential_addons_include_side_area_widget() {
		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/side-area/widgets/*/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_essential_addons_action_framework_before_widgets_register', 'qode_essential_addons_include_side_area_widget' );
}

if ( ! function_exists( 'qode_essential_addons_set_side_area_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_set_side_area_styles( $style ) {
		$area_styles       = array();
		$background_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_background_color' );
		$background_image  = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_background_image' );
		$padding           = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_padding' );
		$content_alignment = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_content_alignment' );

		if ( ! empty( $background_color ) ) {
			$area_styles['background'] = $background_color;
		}

		if ( ! empty( $background_image ) ) {
			$area_styles['background-image']    = 'url(' . esc_url( qode_essential_addons_get_attachment_image_url( $background_image, 'full' ) ) . ')';
			$area_styles['background-repeat']   = 'no-repeat';
			$area_styles['background-size']     = 'cover';
			$area_styles['background-position'] = 'center';
		}

		if ( ! empty( $padding ) ) {
			$area_styles['padding'] = $padding;
		}

		if ( ! empty( $content_alignment ) ) {
			$area_styles['text-align'] = $content_alignment;
		}

		if ( ! empty( $area_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-side-area', $area_styles );
		}

		$cover_styles           = array();
		$cover_background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_cover_background_color' );

		if ( ! empty( $cover_background_color ) ) {
			$cover_styles['background-color'] = $cover_background_color;
		}

		if ( ! empty( $cover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-side-area-cover', $cover_styles );
		}

		$opener_wrapper_styles   = array();
		$opener_wrapper_bg_color = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_opener_background_color' );
		$opener_side_padding     = qode_essential_addons_get_post_value_through_levels( 'qodef_side_opener_side_padding' );

		if ( ! empty( $opener_wrapper_bg_color ) ) {
			$opener_wrapper_styles['background-color'] = $opener_wrapper_bg_color;
		}

		if ( ! empty( $opener_side_padding ) ) {
			$opener_wrapper_styles['padding'] = '0 ' . intval( $opener_side_padding ) . 'px';
		}

		if ( ! empty( $opener_wrapper_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-side-area-opener', $opener_wrapper_styles );
		}

		$opener_styles = array();
		$opener_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_opener_color' );
		$opener_size   = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_opener_size' );

		if ( ! empty( $opener_color ) ) {
			$opener_styles['color'] = $opener_color;
		}

		if ( ! empty( $opener_size ) ) {
			$opener_styles['width'] = intval( $opener_size ) . 'px';
		}

		if ( ! empty( $opener_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-side-area-opener .qodef-m-icon', $opener_styles );
		}

		$opener_hover_styles = array();
		$opener_hover_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_opener_hover_color' );

		if ( ! empty( $opener_hover_color ) ) {
			$opener_hover_styles['color'] = $opener_hover_color;
		}

		if ( ! empty( $opener_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'.qodef-side-area-opener:hover .qodef-m-icon',
					'.qodef-side-area-opener:focus .qodef-m-icon',
				),
				$opener_hover_styles
			);
		}

		$close_icon_styles    = array();
		$close_icon_color     = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_close_icon_color' );
		$close_icon_size      = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_close_icon_size' );
		$close_icon_top_pos   = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_close_icon_top_position' );
		$close_icon_right_pos = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_close_icon_right_position' );

		if ( ! empty( $close_icon_color ) ) {
			$close_icon_styles['color'] = $close_icon_color;
		}

		if ( ! empty( $close_icon_size ) ) {
			$close_icon_styles['width'] = intval( $close_icon_size ) . 'px';
		}

		if ( '' !== $close_icon_top_pos ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $close_icon_top_pos ) ) {
				$close_icon_styles['top'] = $close_icon_top_pos;
			} else {
				$close_icon_styles['top'] = intval( $close_icon_top_pos ) . 'px';
			}
		}

		if ( '' !== $close_icon_right_pos ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $close_icon_right_pos ) ) {
				$close_icon_styles['right'] = $close_icon_right_pos;
			} else {
				$close_icon_styles['right'] = intval( $close_icon_right_pos ) . 'px';
			}
		}

		if ( ! empty( $close_icon_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-side-area-close .qodef-m-icon', $close_icon_styles );
		}

		$close_icon_hover_styles = array();
		$close_icon_hover_color  = qode_essential_addons_get_post_value_through_levels( 'qodef_side_area_close_icon_hover_color' );

		if ( ! empty( $close_icon_hover_color ) ) {
			$close_icon_hover_styles['color'] = $close_icon_hover_color;
		}

		if ( ! empty( $close_icon_hover_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style(
				array(
					'#qodef-side-area-close:hover .qodef-m-icon',
					'#qodef-side-area-close:focus .qodef-m-icon',
				),
				$close_icon_hover_styles
			);
		}

		return $style;
	}

	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_set_side_area_styles' );
}
