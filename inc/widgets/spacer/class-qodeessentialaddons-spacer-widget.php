<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_spacer_widget' ) ) {
	/**
	 * function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function qode_essential_addons_add_spacer_widget( $widgets ) {
		$widgets[] = 'QodeEssentialAddons_Spacer_Widget';

		return $widgets;
	}

	add_filter( 'qode_essential_addons_filter_register_widgets', 'qode_essential_addons_add_spacer_widget' );
}

if ( class_exists( 'QodeEssentialAddons_Framework_Widget' ) ) {
	class QodeEssentialAddons_Spacer_Widget extends QodeEssentialAddons_Framework_Widget {

		public function map_widget() {
			$this->set_base( 'qode_essential_addons_spacer' );
			$this->set_name( esc_html__( 'Qode Spacer', 'qode-essential-addons' ) );
			$this->set_description( esc_html__( 'Add a spacer element into widget areas', 'qode-essential-addons' ) );
			$this->set_widget_option(
				array(
					'field_type'    => 'select',
					'name'          => 'spacer_type',
					'title'         => esc_html__( 'Spacer Type', 'qode-essential-addons' ),
					'options'       => array(
						'horizontal' => esc_html__( 'Horizontal', 'qode-essential-addons' ),
						'vertical'   => esc_html__( 'Vertical', 'qode-essential-addons' ),
					),
					'default_value' => 'horizontal',
				)
			);
			$this->set_widget_option(
				array(
					'field_type'    => 'text',
					'name'          => 'spacer_size',
					'title'         => esc_html__( 'Spacer Size', 'qode-essential-addons' ),
					'default_value' => '50',
				)
			);
		}

		public function render( $atts ) {
			$classes = array();

			if ( ! empty( $atts['spacer_type'] ) ) {
				$classes[] = 'qodef--' . esc_attr( $atts['spacer_type'] );
			}

			$styles = array();

			if ( ! empty( $atts['spacer_size'] ) ) {
				switch ( $atts['spacer_type'] ) {
					case 'vertical':
						if ( qode_essential_addons_framework_string_ends_with_space_units( $atts['spacer_size'], true ) ) {
							$styles[] = 'height: ' . esc_attr( $atts['spacer_size'] );
						} else {
							$styles[] = 'height: ' . intval( $atts['spacer_size'] ) . 'px';
						}
						break;
					default:
						if ( qode_essential_addons_framework_string_ends_with_space_units( $atts['spacer_size'], true ) ) {
							$styles[] = 'width: ' . esc_attr( $atts['spacer_size'] );
						} else {
							$styles[] = 'width: ' . intval( $atts['spacer_size'] ) . 'px';
						}
						break;
				}
			}

			printf(
				'<div class="qodef-spacer-widget %s" %s></div>',
				esc_attr( implode( ' ', $classes ) ),
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				qode_essential_addons_framework_get_inline_style( $styles )
			);
		}
	}
}
