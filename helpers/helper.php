<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_is_qode_theme_installed' ) ) {
	/**
	 * Function that check is Qode theme installed
	 *
	 * @return bool
	 */
	function qode_essential_addons_is_qode_theme_installed() {
		return apply_filters( 'qode_essential_addons_filter_is_qode_theme_installed', false );
	}
}

if ( ! function_exists( 'qode_essential_addons_list_sc_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 */
	function qode_essential_addons_list_sc_template_part( $module, $template, $slug = '', $params = array() ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo qode_essential_addons_get_list_sc_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_list_sc_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function qode_essential_addons_get_list_sc_template_part( $module, $template, $slug = '', $params = array() ) {
		$root = QODE_ESSENTIAL_ADDONS_INC_PATH;

		return qode_essential_addons_framework_get_list_sc_template_part( $root, $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'qode_essential_addons_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 */
	function qode_essential_addons_template_part( $module, $template, $slug = '', $params = array() ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo qode_essential_addons_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function qode_essential_addons_get_template_part( $module, $template, $slug = '', $params = array() ) {
		$root = QODE_ESSENTIAL_ADDONS_INC_PATH;

		return qode_essential_addons_framework_get_template_part( $root, $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_option_value' ) ) {
	/**
	 * Function that returns option value using framework function but providing it's own scope
	 *
	 * @param string $type option type
	 * @param string $name name of option
	 * @param string $default_value option default value
	 * @param int $post_id id of
	 *
	 * @return string value of option
	 */
	function qode_essential_addons_get_option_value( $type, $name, $default_value = '', $post_id = null ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		return qode_essential_addons_framework_get_option_value( $scope, $type, $name, $default_value, $post_id );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_post_value_through_levels' ) ) {
	/**
	 * Function that returns meta value if exists, otherwise global value using framework function but providing it's own scope
	 *
	 * @param string $name name of option
	 * @param int $post_id id of
	 *
	 * @return string|array value of option
	 */
	function qode_essential_addons_get_post_value_through_levels( $name, $post_id = null ) {
		$scope = QODE_ESSENTIAL_ADDONS_OPTIONS_NAME;

		return qode_essential_addons_framework_get_post_value_through_levels( $scope, $name, $post_id );
	}
}

if ( ! function_exists( 'qode_essential_addons_remove_default_post_meta_custom_fields' ) ) {
	/**
	 * Function that remove default custom post types for meta options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function qode_essential_addons_remove_default_post_meta_custom_fields( $post_types ) {
		$post_types[] = 'post';
		$post_types[] = 'page';

		return $post_types;
	}

	add_filter( 'qode_essential_addons_filter_framework_meta_box_remove', 'qode_essential_addons_remove_default_post_meta_custom_fields' );
}

if ( ! function_exists( 'qode_essential_addons_general_meta_box_callbacks' ) ) {
	/**
	 * Function that return general meta box callback functions
	 *
	 * @return array
	 */
	function qode_essential_addons_general_meta_box_callbacks() {
		return apply_filters( 'qode_essential_addons_filter_general_meta_box_callbacks', array() );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_query_params' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param array $atts - options value
	 *
	 * @return array
	 */
	function qode_essential_addons_get_query_params( $atts ) {
		$post_type      = isset( $atts['post_type'] ) && ! empty( $atts['post_type'] ) ? $atts['post_type'] : 'post';
		$posts_per_page = isset( $atts['posts_per_page'] ) && ! empty( $atts['posts_per_page'] ) ? $atts['posts_per_page'] : 12;

		$args = array(
			'post_status'         => 'publish',
			'post_type'           => esc_attr( $post_type ),
			'posts_per_page'      => $posts_per_page,
			'orderby'             => esc_attr( $atts['orderby'] ),
			'order'               => esc_attr( $atts['order'] ),
			'ignore_sticky_posts' => 1,
		);

		if ( isset( $atts['next_page'] ) && ! empty( $atts['next_page'] ) ) {
			$args['paged'] = intval( $atts['next_page'] );
		} elseif ( ! empty( max( 1, get_query_var( is_front_page() ? 'page' : 'paged' ) ) ) ) {
			$args['paged'] = max( 1, get_query_var( is_front_page() ? 'page' : 'paged' ) );
		} else {
			$args['paged'] = 1;
		}

		if ( isset( $atts['additional_query_args'] ) && ! empty( $atts['additional_query_args'] ) ) {
			foreach ( $atts['additional_query_args'] as $key => $value ) {
				$args[ esc_attr( $key ) ] = $value;
			}
		}

		return apply_filters( 'qode_essential_addons_filter_query_params', $args, $atts );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_grid_gutter_classes' ) ) {
	/**
	 * Function that returns classes for the gutter when sidebar is enabled
	 *
	 * @return string
	 */
	function qode_essential_addons_get_grid_gutter_classes() {
		return apply_filters( 'qode_essential_addons_filter_grid_gutter_classes', 'qodef-gutter--huge' );
	}
}

if ( ! function_exists( 'qode_essential_addons_render_svg_icon' ) ) {
	/**
	 * Function that print svg html icon
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 */
	function qode_essential_addons_render_svg_icon( $name, $class_name = '' ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo qode_essential_addons_get_svg_icon( $name, $class_name );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string
	 */
	function qode_essential_addons_get_svg_icon( $name, $class_name = '' ) {
		$html  = '';
		$class = isset( $class_name ) && ! empty( $class_name ) ? 'class="' . esc_attr( $class_name ) . '"' : '';

		switch ( $name ) {
			case 'menu':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="20" height="13" x="0px" y="0px" viewBox="0 0 21.3 13.7" xml:space="preserve" aria-hidden="true"><rect x="10.1" y="-9.1" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 11.5 -9.75)" width="1" height="20"/><rect x="10.1" y="-3.1" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 17.5 -3.75)" width="1" height="20"/><rect x="10.1" y="2.9" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 23.5 2.25)" width="1" height="20"/></svg>';
				break;
			case 'search':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 29.5 29.4" xml:space="preserve"><g><path d="M29.3,27.3L27.5,29l-8.4-8.4c-2,1.6-4.4,2.4-7.1,2.4c-3.1,0-5.8-1.1-8-3.3c-2.2-2.2-3.3-4.9-3.3-8s1.1-5.8,3.3-8c2.2-2.2,4.9-3.3,8-3.3s5.8,1.1,8,3.3c2.2,2.2,3.3,4.9,3.3,8c0,2.7-0.8,5-2.4,7.1L29.3,27.3z M4.9,19c1.9,1.9,4.3,2.9,7.1,2.9c2.8,0,5.1-1,7.1-3c2-2,3-4.4,3-7.1c0-2.8-1-5.1-3-7.1c-2-2-4.4-3-7.1-3c-2.8,0-5.1,1-7.1,3c-2,2-3,4.4-3,7.1C1.9,14.6,2.9,17,4.9,19z"/></g></svg>';
				break;
			case 'plus':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 29.5 29.4" xml:space="preserve"><polygon points="28.8,12.7 16.8,12.7 16.8,0.7 12.8,0.7 12.8,12.7 0.8,12.7 0.8,16.7 12.8,16.7 12.8,28.7 16.8,28.7 16.8,16.7 28.8,16.7 "/></svg>';
				break;
			case 'close':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 9.1 9.1" xml:space="preserve"><g><path d="M8.5,0L9,0.6L5.1,4.5L9,8.5L8.5,9L4.5,5.1L0.6,9L0,8.5L4,4.5L0,0.6L0.6,0L4.5,4L8.5,0z"/></g></svg>';
				break;
			case 'star':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="16" height="15" x="0px" y="0px" viewBox="0 0 16.2 15.2" xml:space="preserve"><g><g><path d="M16.1,5.8l-5,3.5l1.9,5.7l-4.9-3.6l-4.9,3.6l1.9-5.7l-5-3.5h6.1l1.9-5.7L10,5.8H16.1z"/></g></g></svg>';
				break;
			case 'menu-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true"><g><path d="M 13.8,24.196c 0.39,0.39, 1.024,0.39, 1.414,0l 6.486-6.486c 0.196-0.196, 0.294-0.454, 0.292-0.71 c0-0.258-0.096-0.514-0.292-0.71L 15.214,9.804c-0.39-0.39-1.024-0.39-1.414,0c-0.39,0.39-0.39,1.024,0,1.414L 19.582,17 L 13.8,22.782C 13.41,23.172, 13.41,23.806, 13.8,24.196z"></path></g></svg>';
				break;
			case 'menu-arrow-bottom':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 7.3 4.1" xml:space="preserve" aria-hidden="true"><polyline class="st0" points="3.6,4.1 0.1,0.1 7.1,0.1 3.6,4.1 "/></svg>';
				break;
			case 'slider-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 34.2 32.3" xml:space="preserve" style="stroke-width: 2;"><line x1="0.5" y1="16" x2="33.5" y2="16"/><line x1="0.3" y1="16.5" x2="16.2" y2="0.7"/><line x1="0" y1="15.4" x2="16.2" y2="31.6"/></svg>';
				break;
			case 'slider-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 34.2 32.3" xml:space="preserve" style="stroke-width: 2;"><line x1="0" y1="16" x2="33" y2="16"/><line x1="17.3" y1="0.7" x2="33.2" y2="16.5"/><line x1="17.3" y1="31.6" x2="33.5" y2="15.4"/></svg>';
				break;
			case 'pagination-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1015 771" xml:space="preserve"><polygon points="998.1,471.5 348.4,471.5 519.6,642.7 403.6,758.6 150.5,505.5 34.5,389.5 150.5,273.5 403.6,20.4 519.6,136.4 348.4,307.5 998.1,307.5 "/></svg>';
				break;
			case 'pagination-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1015 771" xml:space="preserve"><polygon points="34.5,307.5 684.2,307.5 513,136.4 629,20.4 882.1,273.5 998.1,389.5 882.1,505.5 629,758.6 513,642.7 684.2,471.5 34.5,471.5 "/></svg>';
				break;
			case 'pagination-burger':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="27" height="27" x="0px" y="0px" viewBox="0 0 29 29" xml:space="preserve"><rect x="1" y="1" width="10" height="10"/><rect x="18" y="1" width="10" height="10"/><rect x="1" y="18" width="10" height="10"/><rect x="18" y="18" width="10" height="10"/></svg>';
				break;
			case 'spinner':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path></svg>';
				break;
			case 'link':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 248.5 126.8" xml:space="preserve"><g><path d="M171.8,32.1c2.6,6.4,3.8,13.2,3.8,20.5v20.5h-30.8V52.6c0-6-1.9-10.9-5.8-14.7s-8.8-5.8-14.7-5.8H52.6c-6,0-10.9,1.9-14.7,5.8s-5.8,8.8-5.8,14.7v20.5c0,6,1.9,10.9,5.8,14.7s8.7,5.8,14.7,5.8h10.3c1.3,6,3.6,11.5,7,16.7c3.4,5.1,6.6,8.8,9.6,10.9l3.8,3.2H52.6c-14.1,0-26.2-5-36.2-15.1c-10-10-15.1-22.1-15.1-36.2V52.6c0-14.1,5-26.2,15.1-36.2c10-10,22.1-15.1,36.2-15.1h71.8c10.3,0,19.7,2.9,28.5,8.6C161.6,15.8,167.9,23.2,171.8,32.1z M196.1,1.4c14.1,0,26.2,5,36.2,15.1c10,10,15.1,22.1,15.1,36.2v20.5c0,14.1-5,26.2-15.1,36.2c-10,10-22.1,15.1-36.2,15.1h-71.8c-21.8,0-37.4-10.3-46.8-30.8c-3-7.3-4.5-14.1-4.5-20.5V52.6h30.8v20.5c0,6,1.9,10.9,5.8,14.7s8.7,5.8,14.7,5.8h71.8c6,0,10.9-1.9,14.7-5.8s5.8-8.7,5.8-14.7V52.6c0-6-1.9-10.9-5.8-14.7s-8.8-5.8-14.7-5.8h-10.3c-1.3-6-3.6-11.5-7-16.7c-3.4-5.1-6.6-8.7-9.6-10.9l-3.8-3.2H196.1z"/></g></svg>';
				break;
			case 'quote':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 190.5 148" xml:space="preserve"><g><path d="M37.7,146.3L2.1,124.6C19.3,100,28.2,74.1,28.8,46.7V2.3H90v38.8c0,19.3-5,38.8-15.1,58.4C64.9,119,52.5,134.6,37.7,146.3z M133.7,146.3l-35.6-21.7c17.2-24.5,26.2-50.5,26.8-77.9V2.3h61.2v38.8c0,19.3-5,38.8-15.1,58.4C160.9,119,148.5,134.6,133.7,146.3z"/></g></svg>';
				break;
			case 'date':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 14.6 14.6" xml:space="preserve"><path d="M10.9,1.3V0.2h-0.6v1.2H4.3V0.2H3.7v1.2H0.2v13.1h14.3V1.3H10.9z M10.9,1.9v1.2h-0.6V1.9H10.9z M4.3,1.9v1.2H3.7V1.9H4.3z M13.8,13.8H0.8V4.9h13.1V13.8z"/></svg>';
				break;
			case 'category':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 16.1 14.9" xml:space="preserve"><path d="M14.6,0.3c0.3,0,0.6,0.1,0.9,0.3s0.4,0.5,0.4,0.9v10.6c0,0.3-0.1,0.6-0.4,0.9s-0.5,0.4-0.9,0.4H9.3c-0.6,0-0.9,0.2-0.9,0.7v0.5H8H7.8v-0.5c0-0.5-0.3-0.7-0.9-0.7H1.5c-0.3,0-0.6-0.1-0.9-0.4c-0.2-0.2-0.4-0.5-0.4-0.9V1.5c0-0.3,0.1-0.6,0.4-0.9c0.2-0.2,0.5-0.3,0.9-0.3h5.6c0.4,0,0.7,0.1,1,0.4c0.2-0.3,0.6-0.4,1-0.4H14.6z M7.8,13.2V1.7c0-0.2-0.1-0.4-0.3-0.5C7.3,1,7,0.9,6.8,0.9H1.5c-0.4,0-0.6,0.2-0.6,0.6v10.6c0,0.2,0.1,0.3,0.2,0.5s0.3,0.2,0.4,0.2h5.3C7.3,12.8,7.6,12.9,7.8,13.2zM15.2,12.1V1.5c0-0.4-0.2-0.6-0.6-0.6h-1.2v4.9l-1.8-1.2L9.8,5.7V0.9H9.3C9,0.9,8.8,1,8.6,1.2C8.4,1.3,8.3,1.5,8.3,1.7v11.5c0.1-0.3,0.4-0.4,0.9-0.4h5.3c0.2,0,0.3-0.1,0.4-0.2S15.2,12.3,15.2,12.1z M10.4,0.9v3.7l0.9-0.5l0.3-0.2l0.3,0.2l0.9,0.5V0.9H10.4z"/></svg>';
				break;
			case 'author':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 15.9 15.9" xml:space="preserve"><path d="M2.5,2.5C4,1,5.8,0.2,7.9,0.2c2.1,0,3.9,0.8,5.5,2.3c1.5,1.5,2.3,3.3,2.3,5.5c0,2.1-0.8,3.9-2.3,5.5c-1.5,1.5-3.3,2.3-5.5,2.3c-2.1,0-3.9-0.8-5.5-2.3C1,11.9,0.2,10,0.2,7.9C0.2,5.8,1,4,2.5,2.5z M12.9,2.9c-1.4-1.4-3.1-2.1-5-2.1c-2,0-3.6,0.7-5,2.1C1.5,4.3,0.9,6,0.9,7.9c0,1.7,0.6,3.2,1.7,4.5c1-0.4,2.1-0.8,3.3-1.2c0.1,0,0.1-0.2,0.1-0.4c0-0.4,0-0.7-0.1-0.9C5.7,9.7,5.6,9.3,5.5,8.8C5.3,8.5,5.1,8.1,5,7.6c-0.1-0.4-0.1-0.7,0-1V6.5c0.1-0.2,0-0.7-0.1-1.4C4.8,4.5,5,3.8,5.5,3.2c0.5-0.6,1.2-1,2.2-1h0.7c1,0,1.7,0.4,2.2,1c0.5,0.6,0.7,1.3,0.6,1.9c-0.1,0.7-0.2,1.2-0.1,1.4c0,0,0,0,0,0.1c0.1,0.2,0.1,0.6,0,1c-0.1,0.5-0.3,0.9-0.5,1.2c-0.1,0.5-0.2,0.9-0.3,1.2c-0.1,0.3-0.2,0.6-0.2,0.9c0,0.2,0,0.4,0.1,0.4c1.2,0.4,2.4,0.8,3.5,1.2c1.1-1.3,1.7-2.8,1.7-4.5C15,6,14.3,4.3,12.9,2.9z"/></svg>';
				break;
			case 'comment-reply':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 15.4 12.7" xml:space="preserve"><g><path d="M15.2,11v1.3h-0.4L14,11c-0.9-1.5-1.9-2.5-2.9-3C10,7.5,8.9,7.2,7.7,7.2v3.1l-7.5-5l7.5-5v3.1c2.4,0.1,4.2,0.8,5.6,2.2C14.5,7,15.2,8.7,15.2,11z M14.5,10.7c0-0.2,0-0.4,0-0.7c0-0.3-0.1-0.8-0.4-1.6c-0.2-0.8-0.6-1.4-1.1-2c-0.5-0.6-1.2-1.1-2.3-1.6C9.8,4.3,8.5,4.1,7,4.1V1.6L1.3,5.3L7,9.1V6.6c1.8,0,3.3,0.3,4.4,0.9C12.6,8.1,13.6,9.2,14.5,10.7z"/></g></svg>';
				break;
			case 'comment-edit':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 14.3 13.3" xml:space="preserve"><path d="M11.2,12.6V5.2l0.6-0.6v8.5H0.2V2.4h9.3L8.9,3H0.7v9.6H11.2z M6.5,7.9l6.2-6l0.4,0.4L6.6,8.6H5.4V7.5L12,1.2l0.4,0.4l-6.2,6L6.5,7.9z M14,0.7c0.1,0.1,0.1,0.3,0.1,0.4c0,0.1,0,0.2-0.1,0.4l-0.4,0.4l-0.8-0.7l-0.4-0.4l0.4-0.4c0.1-0.1,0.3-0.1,0.4-0.1c0.1,0,0.2,0,0.4,0.1L14,0.7z"/></svg>';
				break;
			case 'button-arrow':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1015 771" xml:space="preserve"><polygon points="34.5,307.5 684.2,307.5 513,136.4 629,20.4 882.1,273.5 998.1,389.5 882.1,505.5 629,758.6 513,642.7 684.2,471.5 34.5,471.5 "/></svg>';
				break;
			case 'back-to-top':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1015 771" xml:space="preserve"><polygon points="34.5,307.5 684.2,307.5 513,136.4 629,20.4 882.1,273.5 998.1,389.5 882.1,505.5 629,758.6 513,642.7 684.2,471.5 34.5,471.5 "/></svg>';
				break;
		}

		return apply_filters( 'qode_essential_addons_filter_svg_icon', $html, $name, $class_name );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_button_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string
	 */
	function qode_essential_addons_get_button_svg_icon( $name, $class_name = '' ) {
		$html  = '';
		$class = isset( $class_name ) && ! empty( $class_name ) ? 'class="' . esc_attr( $class_name ) . '"' : '';

		switch ( $name ) {
			case 'the-two':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1015 771" xml:space="preserve"><polygon points="34.5,307.5 684.2,307.5 513,136.4 629,20.4 882.1,273.5 998.1,389.5 882.1,505.5 629,758.6 513,642.7 684.2,471.5 34.5,471.5 "/></svg>';
				break;
			case 'the-q':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="6.7px" height="11.4px" viewBox="0 0 6.7 11.4" xml:space="preserve"><path d="M6.4,5L1.7,0.3c-0.4-0.4-1-0.4-1.3,0C0.1,0.5,0,0.7,0,1s0.1,0.5,0.4,0.7l3.8,4l-3.9,4C0.1,9.8,0,10.1,0,10.4  c0,0.3,0.1,0.5,0.3,0.7c0.2,0.2,0.4,0.3,0.7,0.3c0,0,0,0,0,0c0.2,0,0.5-0.1,0.7-0.3l4.7-4.7C6.5,6.2,6.7,6,6.7,5.7  C6.7,5.4,6.6,5.1,6.4,5z"></path></svg>';
				break;
			case 'the-q-4':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8.89 8.89" width="9" height="9"><path d="M8.73.27h0A.74.74,0,0,0,8.51.12h0A.61.61,0,0,0,8.16.06H.8a.74.74,0,0,0,0,1.48H6.4L.27,7.67A.75.75,0,0,0,.79,8.94a.79.79,0,0,0,.53-.22L7.47,2.57V8.2A.74.74,0,0,0,9,8.2V.8A.77.77,0,0,0,8.73.27Z" transform="translate(-0.05 -0.06)"></path></svg>';
				break;
			case 'the-q-5':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="20" height="11" viewBox="0 0 20 11"><path d="M1.074,4.265H17.012L13.55,1.212a0.564,0.564,0,0,1-.025-1A0.762,0.762,0,0,1,14.67.239l4.888,4.248a0.445,0.445,0,0,1,.2.221,0.718,0.718,0,0,1,0,.531,0.443,0.443,0,0,1-.2.221L14.67,9.707a0.761,0.761,0,0,1-1.146.022,0.564,0.564,0,0,1,.025-1l3.463-3.053H1.074a0.86,0.86,0,0,1-.586-0.2A0.644,0.644,0,0,1,.259,4.973V4.663l0.229-.2a0.86,0.86,0,0,1,.586-0.2h0Z"></path></svg>';
				break;
			case 'the-q-6':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="22.65" height="16.41" viewBox="0 0 22.65 16.41"><path d="M22.47,9.33l-7,7a1.19,1.19,0,0,1-1.68-1.68l5.05-5H1.33A1.15,1.15,0,0,1,.17,8.54a.13.13,0,0,1,0-.06A1.12,1.12,0,0,1,1.26,7.33h.07l17.5,0-5-5a1.18,1.18,0,0,1,0-1.65,1.2,1.2,0,0,1,1.67,0l7,7a1.17,1.17,0,0,1,0,1.67Z" transform="translate(-0.17 -0.3)"></path></svg>';
				break;
			case 'the-q-7':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="8.3px" height="14px" viewBox="-128.8 390 8.3 14" xml:space="preserve"><path d="M-128.8,403.1v-12.1c0-0.8,1.1-1.3,1.7-0.7l6.4,6.1c0.4,0.4,0.4,1,0,1.3l-6.4,6.1  C-127.8,404.3-128.8,403.9-128.8,403.1z"></path></svg>';
				break;
			case 'the-q-9':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="11.5" height="12.17" viewBox="0 0 11.5 12.17"><g><g><path d="M11.21,6.8,6.12,11.88a1,1,0,0,1-.71.29,1,1,0,0,1-.7-.29l-.59-.58a1.05,1.05,0,0,1-.29-.71,1,1,0,0,1,.29-.71L6.41,7.59H.91a.93.93,0,0,1-.91-1v-1a.93.93,0,0,1,.91-1h5.5L4.12,2.29a1,1,0,0,1,0-1.41L4.71.3a1,1,0,0,1,.7-.3,1,1,0,0,1,.71.3l5.09,5.08a1,1,0,0,1,.29.71A1,1,0,0,1,11.21,6.8Z"/></g></g></svg>';
				break;
			case 'the-q-15':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="11.5" height="12.17" viewBox="0 0 11.5 12.17"><g><g><path d="M11.21,6.8,6.12,11.88a1,1,0,0,1-.71.29,1,1,0,0,1-.7-.29l-.59-.58a1.05,1.05,0,0,1-.29-.71,1,1,0,0,1,.29-.71L6.41,7.59H.91a.93.93,0,0,1-.91-1v-1a.93.93,0,0,1,.91-1h5.5L4.12,2.29a1,1,0,0,1,0-1.41L4.71.3a1,1,0,0,1,.7-.3,1,1,0,0,1,.71.3l5.09,5.08a1,1,0,0,1,.29.71A1,1,0,0,1,11.21,6.8Z"/></g></g></svg>';
				break;
			case 'the-q-23':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="8.693px" height="8.508px" viewBox="0 0 8.693 8.508" xml:space="preserve"><g><path d="M3.917,8.363C3.872,8.311,3.849,8.258,3.849,8.201V4.614c0-0.057-0.022-0.085-0.068-0.085H0.347c-0.057,0-0.11-0.02-0.162-0.06C0.135,4.43,0.109,4.382,0.109,4.325c0-0.125,0.034-0.264,0.102-0.417c0.068-0.153,0.17-0.229,0.306-0.229H3.73c0.045,0,0.076-0.008,0.093-0.025S3.849,3.6,3.849,3.543V0.636c0-0.159,0.102-0.286,0.306-0.382s0.363-0.145,0.476-0.145c0.057,0,0.11,0.022,0.162,0.068C4.844,0.222,4.869,0.273,4.869,0.33v3.247c0,0.045,0.003,0.074,0.009,0.085c0.005,0.012,0.014,0.017,0.025,0.017s0.022,0,0.034,0h3.451c0.068,0,0.127,0.025,0.178,0.077c0.051,0.051,0.066,0.105,0.043,0.161C8.541,4.121,8.472,4.274,8.406,4.376C8.337,4.478,8.23,4.529,8.082,4.529H4.938c-0.045,0-0.068,0.023-0.068,0.068v3.434c0,0.147-0.096,0.252-0.289,0.314S4.212,8.439,4.053,8.439C4.008,8.439,3.962,8.414,3.917,8.363z"/></g></svg>';
				break;
			case 'the-q-26':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="14.2px" height="13.6px" viewBox="0 0 14.2 13.6" xml:space="preserve" style="stroke:currentColor;stroke-width:1.8397;fill:none"><path d="M7.4,12.3l5.5-5.5L7.4,1.3 M12.2,6.8H0.9"></path></svg>';
				break;
			case 'the-q-28':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9"><path d="M.5,1.15A.59.59,0,0,1,.52,1,.23.23,0,0,1,.62.89.19.19,0,0,1,.73.8a.4.4,0,0,1,.15,0H4.63a.36.36,0,0,1,.26.11A.33.33,0,0,1,5,1.15a.33.33,0,0,1-.11.27.35.35,0,0,1-.26.1H1.79l7.59,7.6a.31.31,0,0,1,.12.26.3.3,0,0,1-.12.25.3.3,0,0,1-.51,0L1.25,2.06V4.89a.33.33,0,0,1-.11.27.35.35,0,0,1-.26.1.36.36,0,0,1-.27-.1A.37.37,0,0,1,.5,4.89Z" transform="translate(-0.5 -0.77)"></path></svg>';
				break;
			case 'the-q-38':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="5.4px" height="9.9px" viewBox="0 0 5.4 9.9" xml:space="preserve" style="stroke:currentColor;stroke-width:1.3;stroke-miterlimit:10;fill:none"><polyline points="0.5,0.4 4.5,4.9 0.5,9.4 "></polyline></svg>';
				break;
			case 'the-q-42':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="45" height="13.688" viewBox="0 0 45 13.688"><path d="M42.627,8.2H0V6.8H42.627l-5.1-5.1,1.055-1.055L45,6.973V8.027l-6.416,6.328L37.441,13.3Z" transform="translate(0 -0.656)"/></svg>';
				break;
			case 'the-q-54':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="4.6px" height="7.6px" viewBox="0 0 4.6 7.6" xml:space="preserve"><path d="M0.1,7.4L0.1,7.4C0.1,7.3,0,7.2,0,7.1V0.5c0-0.1,0-0.2,0.1-0.3v0c0.3-0.2,0.5-0.2,0.7,0l3.6,3.3l0,0c0.1,0.1,0.1,0.2,0.1,0.3c0,0.1,0,0.2-0.1,0.3L0.9,7.4C0.6,7.6,0.4,7.6,0.1,7.4z"/></g></svg>';
				break;
			case 'the-q-55':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="6" height="10" viewBox="0 0 6 10"><path d="M.19,9.79h0A.61.61,0,0,1,0,9.32V.68A.51.51,0,0,1,.19.25v0a.64.64,0,0,1,1,0L5.77,4.54l0,0A.53.53,0,0,1,6,5a.5.5,0,0,1-.19.42L1.14,9.79A.64.64,0,0,1,.19,9.79Z"></path></svg>';
				break;
			case 'the-q-79':
				$html = '<svg ' . $class . ' x="0px" y="0px" viewBox="0 0 18.4 16.1" style="fill:none;stroke:currentColor;stroke-width:2;stroke-miterlimit:10;" xml:space="preserve"><path d="M10.2,0.7"/><polyline points="10.2,0.7 17,8.1 9.8,15.4"/><line x1="0" y1="7.9" x2="17" y2="8.1"/></svg>';
				break;
		}

		return apply_filters( 'qode_essential_addons_filter_button_svg_icon', $html, $name, $class_name );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_custom_sidebars' ) ) {
	/**
	 * Function that return custom sidebars
	 *
	 * @param bool $enable_default - add first element empty for default value
	 *
	 * @return array
	 */
	function qode_essential_addons_get_custom_sidebars( $enable_default = true ) {
		$sidebars = array();

		if ( class_exists( 'QodeEssentialAddons_Framework_Custom_Sidebar' ) ) {
			$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

			$sidebars = $qode_essential_addons_framework->get_custom_sidebars()->get_custom_sidebars( $enable_default );
		}

		return $sidebars;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_customizer_logo' ) ) {
	/**
	 * Function that returns customizer image
	 *
	 * @return string that contains html for logo image
	 */
	function qode_essential_addons_get_customizer_logo() {
		$customizer_image = '';
		$customizer_logo  = get_custom_logo();

		if ( ! empty( $customizer_logo ) ) {
			$customizer_logo_id = get_theme_mod( 'custom_logo' );

			if ( $customizer_logo_id ) {
				$customizer_logo_id_attr = array(
					'class'    => 'qodef-header-logo-image qodef--main qodef--customizer',
					'itemprop' => 'logo',
				);

				$image_alt = get_post_meta( $customizer_logo_id, '_wp_attachment_image_alt', true );
				if ( empty( $image_alt ) ) {
					$customizer_logo_id_attr['alt'] = get_bloginfo( 'name', 'display' );
				}

				$customizer_image = qode_essential_addons_get_attachment_image( $customizer_logo_id, 'full', false, $customizer_logo_id_attr );
			}
		}

		return $customizer_image;
	}
}

if ( ! function_exists( 'qode_essential_addons_add_responsive_inline_style' ) ) {
	/**
	 * Function that generates global inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function qode_essential_addons_add_responsive_inline_style( $style ) {
		$full_style = '';

		$responsive_sizes = array( '1440', '1366', '1024', '768', '680' );
		foreach ( $responsive_sizes as $responsive_size ) {
			$responsive_style = apply_filters( 'qode_essential_addons_filter_add_responsive_' . $responsive_size . '_inline_style', $responsive_style = '' );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string  = '@media only screen and (max-width: ' . $responsive_size . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		$responsive_range_sizes = array( '1366_1440', '1024_1366', '768_1024', '680_768' );
		foreach ( $responsive_range_sizes as $responsive_range_size ) {
			$responsive_style = apply_filters( 'qode_essential_addons_filter_add_responsive_' . $responsive_range_size . '_inline_style', $responsive_style = '' );
			$responsive_range = explode( '_', $responsive_range_size );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string  = '@media only screen and (min-width: ' . ( intval( $responsive_range[0] ) + 1 ) . 'px) and (max-width: ' . $responsive_range[1] . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		if ( ! empty( $full_style ) ) {
			$style = $style . $full_style;
		}

		return $style;
	}

	// Permission 12 is set in order to load it last.
	add_filter( 'qode_essential_addons_filter_add_inline_style', 'qode_essential_addons_add_responsive_inline_style', 12 );
}

if ( ! function_exists( 'qode_essential_addons_print_custom_css_in_footer' ) ) {
	/**
	 * Function that generates global inline styles inside footer area
	 *
	 * @return string
	 */
	function qode_essential_addons_print_custom_css_in_footer() {
		$full_style = '';

		$responsive_sizes = array( '1440', '1366', '1280', '1024', '768', '680' );
		foreach ( $responsive_sizes as $responsive_size ) {
			$responsive_style = apply_filters( 'qode_essential_addons_filter_add_responsive_' . $responsive_size . '_inline_style_in_footer', '' );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string  = '@media only screen and (max-width: ' . $responsive_size . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		$responsive_range_sizes = array( '1366_1440', '1280_1366', '1024_1280', '768_1024', '680_768' );
		foreach ( $responsive_range_sizes as $responsive_range_size ) {
			$responsive_style = apply_filters( 'qode_essential_addons_filter_add_responsive_' . $responsive_range_size . '_inline_style_in_footer', $responsive_style = '' );
			$responsive_range = explode( '_', $responsive_range_size );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string  = '@media only screen and (min-width: ' . ( intval( $responsive_range[0] ) + 1 ) . 'px) and (max-width: ' . $responsive_range[1] . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		if ( '' !== $full_style ) {
			echo '<div id="qode-essential-addons-page-inline-style" data-style="' . esc_attr( $full_style ) . '"></div>';
		}
	}

	// 999 permission is set in order to add inline style been at the last place.
	add_action( 'wp_footer', 'qode_essential_addons_print_custom_css_in_footer', 999 );
}

if ( ! function_exists( 'qode_essential_addons_get_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position
	 *
	 * @param string $map
	 *
	 * @return int
	 */
	function qode_essential_addons_get_admin_options_map_position( $map ) {
		$position = 10;

		switch ( $map ) {
			case 'general':
				$position = 1;
				break;
			case 'logo':
				$position = 2;
				break;
			case 'fonts':
				$position = 4;
				break;
			case 'typography':
				$position = 6;
				break;
			case 'header':
				$position = 8;
				break;
			case 'mobile-header':
				$position = 10;
				break;
			case 'elements':
				$position = 12;
				break;
			case 'title':
				$position = 14;
				break;
			case 'sidebar':
				$position = 16;
				break;
			case 'footer':
				$position = 18;
				break;
			case 'search':
				$position = 20;
				break;
			case 'side-area':
				$position = 22;
				break;
			case 'blog':
				$position = 24;
				break;
			case '404':
				$position = 100;
				break;
		}

		return apply_filters( 'qode_essential_addons_filter_admin_options_map_position', $position, $map );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_variations_options_map' ) ) {
	/**
	 * Function that return options map for module variations
	 *
	 * @param array $variations
	 * @param boolean $default_empty
	 *
	 * @return array
	 */
	function qode_essential_addons_get_variations_options_map( $variations, $default_empty = false ) {
		$map = array();

		if ( ! empty( $variations ) ) {
			$map['visibility'] = count( $variations ) > 1;

			reset( $variations );
			$map['default_value'] = key( $variations );

			if ( $default_empty ) {
				$map['default_value'] = '';
			}
		} else {
			$map['visibility']    = false;
			$map['default_value'] = '';
		}

		return $map;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_select_type_options_pool' ) ) {
	/**
	 * Function that returns array with pool of options for select fields in framework
	 *
	 *
	 * @param string $type - type of select field
	 * @param bool $enable_default - add first element empty for default value
	 * @param array $exclude - array of items to exclude
	 * @param array $include - array of items to include
	 *
	 * @return array escaped output
	 */
	function qode_essential_addons_get_select_type_options_pool( $type, $enable_default = true, $exclude = array(), $include = array() ) {
		$options = array();
		if ( $enable_default ) {
			$options[''] = esc_html__( 'Default', 'qode-essential-addons' );
		}
		switch ( $type ) {
			case 'content_width':
				$options['1400'] = esc_html__( '1400px', 'qode-essential-addons' );
				$options['1300'] = esc_html__( '1300px', 'qode-essential-addons' );
				$options['1200'] = esc_html__( '1200px', 'qode-essential-addons' );
				$options['1100'] = esc_html__( '1100px', 'qode-essential-addons' );
				$options['1000'] = esc_html__( '1000px', 'qode-essential-addons' );
				$options['800']  = esc_html__( '800px', 'qode-essential-addons' );
				break;
			case 'title_tag':
				$options['h1'] = 'H1';
				$options['h2'] = 'H2';
				$options['h3'] = 'H3';
				$options['h4'] = 'H4';
				$options['h5'] = 'H5';
				$options['h6'] = 'H6';
				$options['p']  = 'P';
				break;
			case 'link_target':
				$options['_self']  = esc_html__( 'Same Window', 'qode-essential-addons' );
				$options['_blank'] = esc_html__( 'New Window', 'qode-essential-addons' );
				break;
			case 'border_style':
				$options['solid']  = esc_html__( 'Solid', 'qode-essential-addons' );
				$options['dashed'] = esc_html__( 'Dashed', 'qode-essential-addons' );
				$options['dotted'] = esc_html__( 'Dotted', 'qode-essential-addons' );
				break;
			case 'font_weight':
				$options['100'] = esc_html__( 'Thin (100)', 'qode-essential-addons' );
				$options['200'] = esc_html__( 'Extra Light (200)', 'qode-essential-addons' );
				$options['300'] = esc_html__( 'Light (300)', 'qode-essential-addons' );
				$options['400'] = esc_html__( 'Normal (400)', 'qode-essential-addons' );
				$options['500'] = esc_html__( 'Medium (500)', 'qode-essential-addons' );
				$options['600'] = esc_html__( 'Semi Bold (600)', 'qode-essential-addons' );
				$options['700'] = esc_html__( 'Bold (700)', 'qode-essential-addons' );
				$options['800'] = esc_html__( 'Extra Bold (800)', 'qode-essential-addons' );
				$options['900'] = esc_html__( 'Black (900)', 'qode-essential-addons' );
				break;
			case 'font_style':
				$options['normal']  = esc_html__( 'Normal', 'qode-essential-addons' );
				$options['italic']  = esc_html__( 'Italic', 'qode-essential-addons' );
				$options['oblique'] = esc_html__( 'Oblique', 'qode-essential-addons' );
				$options['initial'] = esc_html__( 'Initial', 'qode-essential-addons' );
				$options['inherit'] = esc_html__( 'Inherit', 'qode-essential-addons' );
				break;
			case 'text_transform':
				$options['none']       = esc_html__( 'None', 'qode-essential-addons' );
				$options['capitalize'] = esc_html__( 'Capitalize', 'qode-essential-addons' );
				$options['uppercase']  = esc_html__( 'Uppercase', 'qode-essential-addons' );
				$options['lowercase']  = esc_html__( 'Lowercase', 'qode-essential-addons' );
				$options['initial']    = esc_html__( 'Initial', 'qode-essential-addons' );
				$options['inherit']    = esc_html__( 'Inherit', 'qode-essential-addons' );
				break;
			case 'text_decoration':
				$options['none']         = esc_html__( 'None', 'qode-essential-addons' );
				$options['underline']    = esc_html__( 'Underline', 'qode-essential-addons' );
				$options['overline']     = esc_html__( 'Overline', 'qode-essential-addons' );
				$options['line-through'] = esc_html__( 'Line-Through', 'qode-essential-addons' );
				$options['initial']      = esc_html__( 'Initial', 'qode-essential-addons' );
				$options['inherit']      = esc_html__( 'Inherit', 'qode-essential-addons' );
				break;
			case 'list_behavior':
				$options['columns'] = esc_html__( 'Gallery', 'qode-essential-addons' );
				$options['masonry'] = esc_html__( 'Masonry', 'qode-essential-addons' );
				break;
			case 'columns_number':
				$options['1'] = esc_html__( 'One', 'qode-essential-addons' );
				$options['2'] = esc_html__( 'Two', 'qode-essential-addons' );
				$options['3'] = esc_html__( 'Three', 'qode-essential-addons' );
				$options['4'] = esc_html__( 'Four', 'qode-essential-addons' );
				$options['5'] = esc_html__( 'Five', 'qode-essential-addons' );
				$options['6'] = esc_html__( 'Six', 'qode-essential-addons' );
				break;
			case 'items_space':
				$options['enormous'] = esc_html__( 'Enormous (60)', 'qode-essential-addons' );
				$options['huge']     = esc_html__( 'Huge (34)', 'qode-essential-addons' );
				$options['large']    = esc_html__( 'Large (25)', 'qode-essential-addons' );
				$options['medium']   = esc_html__( 'Medium (20)', 'qode-essential-addons' );
				$options['normal']   = esc_html__( 'Normal (15)', 'qode-essential-addons' );
				$options['small']    = esc_html__( 'Small (10)', 'qode-essential-addons' );
				$options['tiny']     = esc_html__( 'Tiny (5)', 'qode-essential-addons' );
				$options['no']       = esc_html__( 'No (0)', 'qode-essential-addons' );
				break;
			case 'order_by':
				$options['date']       = esc_html__( 'Date', 'qode-essential-addons' );
				$options['ID']         = esc_html__( 'ID', 'qode-essential-addons' );
				$options['menu_order'] = esc_html__( 'Menu Order', 'qode-essential-addons' );
				$options['name']       = esc_html__( 'Post Name', 'qode-essential-addons' );
				$options['rand']       = esc_html__( 'Random', 'qode-essential-addons' );
				$options['title']      = esc_html__( 'Title', 'qode-essential-addons' );
				break;
			case 'order':
				$options['DESC'] = esc_html__( 'Descending', 'qode-essential-addons' );
				$options['ASC']  = esc_html__( 'Ascending', 'qode-essential-addons' );
				break;
			case 'columns_responsive':
				$options['predefined'] = esc_html__( 'Predefined', 'qode-essential-addons' );
				$options['custom']     = esc_html__( 'Custom', 'qode-essential-addons' );
				break;
			case 'yes_no':
				$options['yes'] = esc_html__( 'Yes', 'qode-essential-addons' );
				$options['no']  = esc_html__( 'No', 'qode-essential-addons' );
				break;
			case 'no_yes':
				$options['no']  = esc_html__( 'No', 'qode-essential-addons' );
				$options['yes'] = esc_html__( 'Yes', 'qode-essential-addons' );
				break;
			case 'sidebar_layouts':
				$options['no-sidebar']       = esc_html__( 'No Sidebar', 'qode-essential-addons' );
				$options['sidebar-33-right'] = esc_html__( 'Sidebar 1/3 Right', 'qode-essential-addons' );
				$options['sidebar-25-right'] = esc_html__( 'Sidebar 1/4 Right', 'qode-essential-addons' );
				$options['sidebar-33-left']  = esc_html__( 'Sidebar 1/3 Left', 'qode-essential-addons' );
				$options['sidebar-25-left']  = esc_html__( 'Sidebar 1/4 Left', 'qode-essential-addons' );
				break;
			case 'icon_source':
				$options['icon_pack']  = esc_html__( 'Icon Pack', 'qode-essential-addons' );
				$options['svg_path']   = esc_html__( 'SVG Path', 'qode-essential-addons' );
				$options['predefined'] = esc_html__( 'Predefined', 'qode-essential-addons' );
				break;
			case 'list_image_dimension':
				$options['full']      = esc_html__( 'Original', 'qode-essential-addons' );
				$options['thumbnail'] = esc_html__( 'Thumbnail', 'qode-essential-addons' );
				$options['medium']    = esc_html__( 'Medium', 'qode-essential-addons' );
				$options['large']     = esc_html__( 'Large', 'qode-essential-addons' );
				$options['custom']    = esc_html__( 'Custom', 'qode-essential-addons' );
				$options              = apply_filters( 'qode_essential_addons_filter_framework_pool_list_image_dimension', $options );
				break;
		}

		if ( ! empty( $exclude ) ) {
			foreach ( $exclude as $e ) {
				if ( array_key_exists( $e, $options ) ) {
					unset( $options[ $e ] );
				}
			}
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $options ) ) {
					$options[ $key ] = $value;
				}
			}
		}

		return apply_filters( 'qode_essential_addons_filter_select_type_option', $options, $type, $enable_default, $exclude );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_space_value' ) ) {
	/**
	 * Function that returns spacing value based on selected option
	 *
	 * @param string $text_value - textual value of spacing
	 *
	 * @return int
	 */
	function qode_essential_addons_get_space_value( $text_value ) {
		switch ( $text_value ) {
			case 'enormous':
				return 60;
			case 'huge':
				return 34;
			case 'large':
				return 25;
			case 'medium':
				return 20;
			case 'normal':
				return 15;
			case 'small':
				return 10;
			case 'tiny':
				return 5;
			default:
				return is_int( $text_value ) ? $text_value : 0;
		}
	}
}

if ( ! function_exists( 'qode_essential_addons_get_typography_styles' ) ) {
	/**
	 * Generates typography styles
	 *
	 * @param string $scope
	 * @param string $field_name
	 * @param string $selector
	 *
	 * @return array
	 */
	function qode_essential_addons_get_typography_styles( $scope, $field_name, $selector = '', $post_id = -1 ) {
		$color                = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_color', $post_id );
		$font_family          = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_font_family', $post_id );
		$font_size            = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_font_size', $post_id );
		$line_height          = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_line_height', $post_id );
		$letter_spacing       = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_letter_spacing', $post_id );
		$font_weight          = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_font_weight', $post_id );
		$text_transform       = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_text_transform', $post_id );
		$font_style           = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_font_style', $post_id );
		$text_decoration      = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_text_decoration', $post_id );
		$margin_top           = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_margin_top', $post_id );
		$margin_bottom        = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_margin_bottom', $post_id );
		$text_decoration_draw = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_hover_text_decoration_draw', $post_id );

		$styles = array();

		if ( 'p' !== $selector ) {

			if ( ! empty( $color ) ) {
				$styles['color'] = $color;
			}

			if ( isset( $font_family ) && false !== $font_family && '-1' !== $font_family && '' !== $font_family ) {
				$styles['font-family'] = qode_essential_addons_framework_get_formatted_font_family( $font_family );
			}

			if ( ! empty( $font_size ) ) {
				if ( qode_essential_addons_framework_string_ends_with_typography_units( $font_size ) ) {
					$styles['font-size'] = $font_size;
				} else {
					$styles['font-size'] = intval( $font_size ) . 'px';
				}
			}

			if ( ! empty( $line_height ) ) {
				if ( qode_essential_addons_framework_string_ends_with_typography_units( $line_height ) ) {
					$styles['line-height'] = $line_height;
				} else {
					$styles['line-height'] = floatval( $line_height ) . 'px';
				}
			}

			if ( ! empty( $font_style ) ) {
				$styles['font-style'] = $font_style;
			}

			if ( ! empty( $font_weight ) ) {
				$styles['font-weight'] = $font_weight;
			}

			if ( ! empty( $text_decoration ) && 'yes' !== $text_decoration_draw ) {
				$styles['text-decoration'] = $text_decoration;
			}

			if ( '' !== $letter_spacing && ! is_bool( $letter_spacing ) ) {
				if ( qode_essential_addons_framework_string_ends_with_typography_units( $letter_spacing ) ) {
					$styles['letter-spacing'] = $letter_spacing;
				} else {
					$styles['letter-spacing'] = floatval( $letter_spacing ) . 'px';
				}
			}

			if ( ! empty( $text_transform ) ) {
				$styles['text-transform'] = $text_transform;
			}
		}

		if ( 'body' !== $selector ) {

			if ( ! empty( $margin_top ) ) {
				if ( qode_essential_addons_framework_string_ends_with_space_units( $margin_top, true ) ) {
					$styles['margin-top'] = $margin_top;
				} else {
					$styles['margin-top'] = intval( $margin_top ) . 'px';
				}
			}

			if ( ! empty( $margin_bottom ) ) {
				if ( qode_essential_addons_framework_string_ends_with_space_units( $margin_bottom, true ) ) {
					$styles['margin-bottom'] = $margin_bottom;
				} else {
					$styles['margin-bottom'] = intval( $margin_bottom ) . 'px';
				}
			}
		}

		return $styles;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_typography_hover_styles' ) ) {
	/**
	 * Generates hover typography styles
	 *
	 * @param string $scope
	 * @param string $field_name
	 *
	 * @return array
	 */
	function qode_essential_addons_get_typography_hover_styles( $scope, $field_name, $post_id = -1 ) {
		$hover_color                = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_hover_color', $post_id );
		$hover_text_decoration      = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_hover_text_decoration', $post_id );
		$hover_text_decoration_draw = qode_essential_addons_framework_get_post_value_through_levels( $scope, $field_name . '_hover_text_decoration_draw', $post_id );

		$styles = array();

		if ( ! empty( $hover_color ) ) {
			$styles['color'] = $hover_color;
		}

		if ( ! empty( $hover_text_decoration ) && 'yes' !== $hover_text_decoration_draw ) {
			$styles['text-decoration'] = $hover_text_decoration;
		}

		if ( ! empty( $hover_text_decoration ) && 'yes' === $hover_text_decoration_draw ) {
			$styles['text-decoration'] = 'none';
		}

		return $styles;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_typography_draw_classes' ) ) {

	function qode_essential_addons_get_typography_draw_classes( $scope, $field_name ) {
		$draw_hover_decoration = qode_essential_addons_framework_get_option_value( $scope, 'admin', $field_name . '_hover_text_decoration_draw' );
		$hover_decoration      = qode_essential_addons_framework_get_option_value( $scope, 'admin', $field_name . '_hover_text_decoration' );
		$set_hover_decoration  = ( 'underline' === $hover_decoration ) || ( 'overline' === $hover_decoration ) || ( 'line-through' === $hover_decoration );

		$classes          = '';
		$field_name_class = str_replace( array( ' ', '_' ), '-', $field_name );
		$classes         .= ( 'yes' === $draw_hover_decoration ) && $set_hover_decoration ? $field_name_class . '--draw-hover-' . $hover_decoration : '';

		return $classes;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_custom_post_type_related_posts' ) ) {
	/**
	 * Function which return related posts for forward post item
	 *
	 * @param int $post_id
	 * @param array $allowed_types
	 *
	 * @return array
	 */
	function qode_essential_addons_get_custom_post_type_related_posts( $post_id, $allowed_types ) {
		$related_posts = array();

		if ( ! empty( $post_id ) && ! empty( $allowed_types ) ) {
			foreach ( $allowed_types as $key => $value ) {
				$term_ids = array();

				if ( ! empty( $value ) ) {
					foreach ( $value as $term ) {
						$term_ids[] = $term->term_id;
					}
				}

				if ( ! empty( $term_ids ) ) {
					$related_posts_by_term = qode_essential_addons_get_custom_post_type_related_posts_by_term( $post_id, $term_ids, $key );

					if ( ! empty( $related_posts_by_term->posts ) ) {
						$items_id = array();

						foreach ( $related_posts_by_term->posts as $related_post ) {
							$items_id[] = $related_post->ID;
						}

						$related_posts = array(
							'items' => implode( ',', $items_id ),
						);

						return $related_posts;
					}
				}
			}
		}

		return $related_posts;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_custom_post_type_related_posts_by_term' ) ) {
	/**
	 * Function which return related posts query object
	 *
	 * @param int $post_id
	 * @param array $term_ids
	 * @param string $slug
	 *
	 * @return WP_Query
	 */
	function qode_essential_addons_get_custom_post_type_related_posts_by_term( $post_id, $term_ids, $slug ) {
		$args = apply_filters(
			'qode_essential_addons_filter_custom_post_type_related_posts_by_term',
			array(
				'post_status'    => 'publish',
				'post_type'      => get_post_type( $post_id ),
				'post__not_in'   => array( $post_id ),
				$slug . '__in'   => $term_ids,
				'orderby'        => 'rand',
				'posts_per_page' => 6,
			)
		);

		$related_posts = new \WP_Query( $args );

		return $related_posts;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_custom_post_type_taxonomy_query_args' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param array $params - options value
	 * @param array $include - additional query arguments
	 *
	 * @return array
	 */
	function qode_essential_addons_get_custom_post_type_taxonomy_query_args( $params, $include = array() ) {
		$args = array();

		if ( isset( $params['taxonomy'] ) && ! empty( $params['taxonomy'] ) ) {
			$args['taxonomy'] = $params['taxonomy'];
		}

		if ( isset( $params['posts_per_page'] ) && ! empty( $params['posts_per_page'] ) ) {
			$args['number'] = $params['posts_per_page'];
		}

		if ( isset( $params['orderby'] ) && ! empty( $params['orderby'] ) ) {
			$args['orderby'] = $params['orderby'];
		}

		if ( isset( $params['order'] ) && ! empty( $params['order'] ) ) {
			$args['order'] = $params['order'];
		}

		$args['hide_empty'] = isset( $params['hide_empty'] ) && 'yes' === $params['hide_empty'];

		if ( isset( $params['taxonomy_ids'] ) && ! empty( $params['taxonomy_ids'] ) ) {
			$args['include'] = explode( ',', trim( $params['taxonomy_ids'] ) );
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $args ) ) {
					$args[ $key ] = $value;
				}
			}
		}

		return $args;
	}
}

if ( ! function_exists( 'qode_essential_addons_get_custom_post_type_excerpt' ) ) {
	/**
	 * Return excerpt text for current custom post type item
	 *
	 * @param int $excerpt_length
	 * @param string $custom_excerpt
	 *
	 * @return string
	 */
	function qode_essential_addons_get_custom_post_type_excerpt( $excerpt_length, $custom_excerpt = '' ) {
		$excerpt      = '';
		$item_excerpt = get_the_excerpt();

		if ( empty( $item_excerpt ) && ! empty( $custom_excerpt ) ) {
			$item_excerpt = esc_html( $custom_excerpt );
		}

		if ( empty( $excerpt_length ) ) {
			// 180 is number of characters.
			$excerpt_length = apply_filters( 'qode_essential_addons_filter_post_excerpt_length', 180 );
		}

		if ( ! empty( $item_excerpt ) ) {
			$excerpt = ( $excerpt_length > 0 ) ? substr( $item_excerpt, 0, intval( $excerpt_length ) ) : $item_excerpt;
		}

		return wp_strip_all_tags( strip_shortcodes( $excerpt ) );
	}
}

if ( ! function_exists( 'qode_essential_addons_render_page_builder_post_content' ) ) {
	/**
	 * Function that print post content unmodified by page builder
	 *
	 * @param int $id post id
	 */
	function qode_essential_addons_render_page_builder_post_content( $id ) {

		if ( qode_essential_addons_framework_is_installed( 'elementor' ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo qode_essential_addons_get_elementor_instance()->frontend->get_builder_content( $id, true );
		} else {
			the_content();
		}
	}
}

if ( ! function_exists( 'qode_essential_addons_get_attachment_image' ) ) {
	/**
	 * Function that returns attachment image with applied wpml object id filter to enable WPML media translation
	 *
	 * @return string
	 */
	function qode_essential_addons_get_attachment_image( $attachment_id, $size = 'thumbnail', $icon = false, $attr = '' ): string {
		$attachment_id = apply_filters( 'wpml_object_id', $attachment_id, 'attachment', true );

		return wp_get_attachment_image( $attachment_id, $size, $icon, $attr );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_attachment_image_src' ) ) {
	/**
	 * Function that returns attachment image src with applied wpml object id filter to enable WPML media translation
	 *
	 * @return array|false
	 */
	function qode_essential_addons_get_attachment_image_src( $attachment_id, $size = 'thumbnail', $icon = false ) {
		$attachment_id = apply_filters( 'wpml_object_id', $attachment_id, 'attachment', true );

		return wp_get_attachment_image_src( $attachment_id, $size, $icon );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_attachment_image_url' ) ) {
	/**
	 * Function that returns attachment image url with applied wpml object id filter to enable WPML media translation
	 *
	 * @return string|false
	 */
	function qode_essential_addons_get_attachment_image_url( $attachment_id, $size = 'thumbnail', $icon = false ) {
		$attachment_id = apply_filters( 'wpml_object_id', $attachment_id, 'attachment', true );

		return wp_get_attachment_image_url( $attachment_id, $size, $icon );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_attachment_url' ) ) {
	/**
	 * Function that returns attachment url with applied wpml object id filter to enable WPML media translation
	 *
	 * @return string|false
	 */
	function qode_essential_addons_get_attachment_url( $attachment_id ) {
		$attachment_id = apply_filters( 'wpml_object_id', $attachment_id, 'attachment', true );

		return wp_get_attachment_url( $attachment_id );
	}
}

if ( ! function_exists( 'qode_essential_addons_get_attachment_thumb_url' ) ) {
	/**
	 * Function that returns attachment thumb url with applied wpml object id filter to enable WPML media translation
	 *
	 * @return string|false
	 */
	function qode_essential_addons_get_attachment_thumb_url( $attachment_id ) {
		$attachment_id = apply_filters( 'wpml_object_id', $attachment_id, 'attachment', true );

		return wp_get_attachment_thumb_url( $attachment_id );
	}
}
