<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_button_widget' ) ) {
	/**
	 * function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function qode_essential_addons_add_button_widget( $widgets ) {
		if ( qode_essential_addons_is_qode_theme_installed() ) {
			$widgets[] = 'QodeEssentialAddons_Button_Widget';
		}

		return $widgets;
	}

	add_filter( 'qode_essential_addons_filter_register_widgets', 'qode_essential_addons_add_button_widget' );
}

if ( class_exists( 'QodeEssentialAddons_Framework_Widget' ) ) {
	class QodeEssentialAddons_Button_Widget extends QodeEssentialAddons_Framework_Widget {

		public function map_widget() {
			$this->set_base( 'qode_essential_addons_button' );
			$this->set_name( esc_html__( 'Qode Button', 'qode-essential-addons' ) );
			$this->set_description( esc_html__( 'Add a button element into widget areas', 'qode-essential-addons' ) );
			$this->set_widget_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_type',
					'title'         => esc_html__( 'Button Type', 'qode-essential-addons' ),
					'options'       => array(
						'filled' => esc_html__( 'Filled', 'qode-essential-addons' ),
						'simple' => esc_html__( 'Textual', 'qode-essential-addons' ),
					),
					'default_value' => 'filled',
				)
			);
			$this->set_widget_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_size',
					'title'         => esc_html__( 'Button Filled Type Size', 'qode-essential-addons' ),
					'options'       => array(
						''      => esc_html__( 'Default', 'qode-essential-addons' ),
						'small' => esc_html__( 'Small', 'qode-essential-addons' ),
					),
					'default_value' => '',
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_text',
					'title'      => esc_html__( 'Button Text', 'qode-essential-addons' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_link',
					'title'      => esc_html__( 'Link', 'qode-essential-addons' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_link_target',
					'title'         => esc_html__( 'Link Target', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'button_margin',
					'title'       => esc_html__( 'Button Margin', 'qode-essential-addons' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'qode-essential-addons' ),
				)
			);
		}

		public function render( $atts ) {
			$classes                   = array();
			$button_icon_layout        = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_icon_layout' );
			$button_icon_layout_custom = qode_essential_addons_get_post_value_through_levels( 'qodef_elements_buttons_custom_icon_svg_path' );

			$icon = qi_get_svg_icon( 'button-arrow', 'qodef-theme-button-icon' );

			if ( 'disable' === $button_icon_layout ) {
				$icon = '';
			} elseif ( ! empty( $button_icon_layout ) || ! empty( $button_icon_layout_custom ) ) {
				if ( ! empty( $button_icon_layout_custom ) ) {
					$icon = '<div class="qodef-custom-icon qodef-theme-button-icon">' . $button_icon_layout_custom . '</div>';
				} else {
					$icon = qode_essential_addons_get_button_svg_icon( $button_icon_layout, 'qodef-theme-button-icon' );
				}
			}

			if ( ! empty( $atts['button_type'] ) ) {
				$classes[] = 'qodef--' . esc_attr( $atts['button_type'] );
			} else {
				$classes[] = 'qodef--filled';
			}

			if ( 'filled' === $atts['button_type'] && ! empty( $atts['button_size'] ) ) {
				$classes[] = 'qodef-size--' . esc_attr( $atts['button_size'] );
			}

			if ( ! empty( $icon ) ) {
				$classes[] = 'qodef--with-icon';
			}

			$styles = array();

			if ( '' !== $atts['button_margin'] ) {
				$styles[] = 'margin: ' . esc_attr( $atts['button_margin'] );
			}

			if ( ! empty( $atts['button_text'] ) && ! empty( $atts['button_link'] ) ) {
				printf(
					'<a class="qodef-theme-button  %s" href="%s" target="%s" %s><span class="qodef-m-text">%s</span>%s</a>',
					esc_attr( implode( ' ', $classes ) ),
					esc_url( $atts['button_link'] ),
					esc_attr( $atts['button_link_target'] ),
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					qode_essential_addons_framework_get_inline_style( $styles ),
					wp_kses_post( $atts['button_text'] ),
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					$icon
				);
			}
		}
	}
}
