<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_side_area_opener_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function qode_essential_addons_add_side_area_opener_widget( $widgets ) {
		$widgets[] = 'QodeEssentialAddons_Side_Area_Opener_Widget';

		return $widgets;
	}

	add_filter( 'qode_essential_addons_filter_register_widgets', 'qode_essential_addons_add_side_area_opener_widget' );
}

if ( class_exists( 'QodeEssentialAddons_Framework_Widget' ) ) {
	class QodeEssentialAddons_Side_Area_Opener_Widget extends QodeEssentialAddons_Framework_Widget {

		public function map_widget() {
			$this->set_base( 'qode_essential_addons_side_area_opener' );
			$this->set_name( esc_html__( 'Qode Side Area Opener', 'qode-essential-addons' ) );
			$this->set_description( esc_html__( 'Display a "hamburger" icon that opens the side area', 'qode-essential-addons' ) );
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'sidea_area_opener_margin',
					'title'       => esc_html__( 'Opener Margin', 'qode-essential-addons' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'qode-essential-addons' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'side_area_opener_color',
					'title'      => esc_html__( 'Opener Color', 'qode-essential-addons' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'side_area_opener_background_color',
					'title'      => esc_html__( 'Opener Background Color', 'qode-essential-addons' ),
				)
			);
		}

		public function render( $atts ) {
			$styles = array();

			if ( ! empty( $atts['side_area_opener_color'] ) ) {
				$styles[] = 'color: ' . $atts['side_area_opener_color'] . ';';
			}

			if ( ! empty( $atts['side_area_opener_background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['side_area_opener_background_color'] . ';';
			}

			if ( ! empty( $atts['sidea_area_opener_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['sidea_area_opener_margin'];
			}

			$custom_opener_icon = qode_essential_addons_get_opener_icon_html_content( 'side_area' );
			$opener_classes     = array();
			if ( empty( $custom_opener_icon ) ) {
				$opener_classes[] = 'qodef--predefined';
			}
			?>
			<a href="javascript:void(0)" class="qodef-opener-icon qodef-m qodef-side-area-opener <?php echo esc_attr( implode( ' ', $opener_classes ) ); ?>" <?php qode_essential_addons_framework_inline_style( $styles ); ?> aria-expanded="false" aria-label="<?php esc_attr_e( 'Open the side area', 'qode-essential-addons' ); ?>">
				<span class="qodef-m-icon">
					<?php
					if ( ! empty( $custom_opener_icon ) ) {
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo qode_essential_addons_get_opener_icon_html_content( 'side_area' );
					} else {
						qode_essential_addons_render_svg_icon( 'plus' );
					}
					?>
				</span>
			</a>
			<?php
		}
	}
}
