<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_search_opener_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 **/
	function qode_essential_addons_add_search_opener_widget( $widgets ) {
		$widgets[] = 'QodeEssentialAddons_Search_Opener_Widget';

		return $widgets;
	}

	add_filter( 'qode_essential_addons_filter_register_widgets', 'qode_essential_addons_add_search_opener_widget' );
}

if ( class_exists( 'QodeEssentialAddons_Framework_Widget' ) ) {
	class QodeEssentialAddons_Search_Opener_Widget extends QodeEssentialAddons_Framework_Widget {

		public function map_widget() {
			$this->set_base( 'qode_essential_addons_search_opener' );
			$this->set_name( esc_html__( 'Qode Search Opener', 'qode-essential-addons' ) );
			$this->set_description( esc_html__( 'Display a "search" icon that opens the search form', 'qode-essential-addons' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'search_icon_color',
					'title'      => esc_html__( 'Icon Color', 'qode-essential-addons' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'search_icon_hover_color',
					'title'      => esc_html__( 'Icon Hover Color', 'qode-essential-addons' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'search_icon_margin',
					'title'       => esc_html__( 'Icon Margin', 'qode-essential-addons' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'qode-essential-addons' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'search_icon_label',
					'title'      => esc_html__( 'Enable Search Icon Label', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no', false ),
				)
			);
		}

		public function render( $atts ) {
			$styles = array();

			if ( ! empty( $atts['search_icon_color'] ) ) {
				$styles[] = 'color: ' . $atts['search_icon_color'] . ';';
			}

			if ( ! empty( $atts['search_icon_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['search_icon_margin'] . ';';
			}

			$custom_icon  = qode_essential_addons_get_opener_icon_html_content( 'search' );
			$icon_classes = array();
			if ( empty( $custom_icon ) ) {
				$icon_classes[] = 'qodef--predefined';
			}
			?>
			<a href="javascript:void(0)" class="qodef-opener-icon qodef-m qodef-search-opener <?php echo esc_attr( implode( ' ', $icon_classes ) ); ?>" <?php qode_essential_addons_framework_inline_style( $styles ); ?> <?php qode_essential_addons_framework_inline_attr( $atts['search_icon_hover_color'], 'data-hover-color' ); ?>>
				<span class="qodef-m-icon">
					<?php
					if ( ! empty( $custom_icon ) ) {
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo qode_essential_addons_get_opener_icon_html_content( 'search' );
					} else {
						qode_essential_addons_render_svg_icon( 'search' );
					}
					?>
				</span>
				<?php if ( 'no' !== $atts['search_icon_label'] ) { ?>
					<span class="qodef-m-text"><?php esc_html_e( 'Search', 'qode-essential-addons' ); ?></span>
				<?php } ?>
			</a>
			<?php
		}
	}
}
