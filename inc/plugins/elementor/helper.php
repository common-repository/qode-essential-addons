<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_get_elementor_instance' ) ) {
	/**
	 * Function that return page builder module instance
	 */
	function qode_essential_addons_get_elementor_instance() {
		return \Elementor\Plugin::instance();
	}
}

if ( ! function_exists( 'qode_essential_addons_get_elementor_widgets_manager' ) ) {
	/**
	 * Function that return page builder widget module instance
	 */
	function qode_essential_addons_get_elementor_widgets_manager() {
		return qode_essential_addons_get_elementor_instance()->widgets_manager;
	}
}

if ( ! function_exists( 'qode_essential_addons_load_elementor_widgets' ) ) {
	/**
	 * Function that include modules into page builder
	 */
	function qode_essential_addons_load_elementor_widgets() {
		include_once QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/elementor/class-qodeessentialaddons-elementor-widget-base.php';

		$widgets = array();
		foreach ( glob( QODE_ESSENTIAL_ADDONS_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $shortcode ) {

			if ( basename( $shortcode ) !== 'dashboard' ) {

				foreach ( glob( $shortcode . '/*-elementor.php' ) as $shortcode_load ) {
					$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
				}
			}
		}

		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
		}

		foreach ( glob( QODE_ESSENTIAL_ADDONS_CPT_PATH . '/*', GLOB_ONLYDIR ) as $post_type ) {

			if ( basename( $post_type ) !== 'dashboard' ) {

				foreach ( glob( $post_type . '/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
					$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
				}
			}
		}

		foreach ( glob( QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
		}

		foreach ( glob( QODE_ESSENTIAL_ADDONS_PLUGINS_PATH . '/*/post-types/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
			$widgets[ basename( $shortcode_load ) ] = $shortcode_load;
		}

		$additional_widgets = apply_filters( 'qode_essential_addons_filter_additional_widgets_load', array() );

		$widgets = array_merge( $widgets, $additional_widgets );

		if ( ! empty( $widgets ) ) {
			ksort( $widgets );

			foreach ( $widgets as $widget ) {
				include_once $widget;
			}
		}
	}

	if ( version_compare( ELEMENTOR_VERSION, '3.5.0', '>' ) ) {
		add_action( 'elementor/widgets/register', 'qode_essential_addons_load_elementor_widgets' );
	} else {
		add_action( 'elementor/widgets/widgets_registered', 'qode_essential_addons_load_elementor_widgets' );
	}
}

if ( ! function_exists( 'qode_essential_addons_register_new_elementor_widget' ) ) {
	/**
	 * Function that register a new widget type.
	 *
	 * @param \Elementor\Widget_Base $widget_instance Elementor Widget.
	 */
	function qode_essential_addons_register_new_elementor_widget( $widget_instance ) {

		if ( version_compare( ELEMENTOR_VERSION, '3.5.0', '>' ) ) {
			qode_essential_addons_get_elementor_widgets_manager()->register( $widget_instance );
		} else {
			qode_essential_addons_get_elementor_widgets_manager()->register_widget_type( $widget_instance );
		}
	}
}
