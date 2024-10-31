<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_restaurant_menu_list_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function qode_essential_addons_add_restaurant_menu_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'QodeEssentialAddons_Restaurant_Menu_Shortcode';

		return $shortcodes;
	}

	add_filter( 'qode_essential_addons_filter_register_shortcodes', 'qode_essential_addons_add_restaurant_menu_list_shortcode' );
}

if ( class_exists( 'QodeEssentialAddons_Shortcode' ) ) {
	class QodeEssentialAddons_Restaurant_Menu_Shortcode extends QodeEssentialAddons_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( QODE_ESSENTIAL_ADDONS_SHORTCODES_URL_PATH . '/restaurant-menu' );
			$this->set_base( 'qode_essential_addons_restaurant_menu_list' );
			$this->set_name( esc_html__( 'Restaurant Menu List Essentials', 'qode-essential-addons' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of restaurant menu', 'qode-essential-addons' ) );
			$this->set_category( esc_html__( 'Qode Essential Addons', 'qode-essential-addons' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'title_tag',
					'title'      => esc_html__( 'Title Tag', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'title_tag' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'title_color',
					'title'      => esc_html__( 'Title Color', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'description_color',
					'title'      => esc_html__( 'Description Color', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'price_color',
					'title'      => esc_html__( 'Price Color', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'line_color',
					'title'      => esc_html__( 'Line Color', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Menu Items', 'qode-essential-addons' ),
					'items'      => array(
						array(
							'field_type' => 'text',
							'name'       => 'item_title',
							'title'      => esc_html__( 'Title', 'qode-essential-addons' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'item_description',
							'title'      => esc_html__( 'Description', 'qode-essential-addons' ),
						),
						array(
							'field_type' => 'text',
							'name'       => 'item_price',
							'title'      => esc_html__( 'Price', 'qode-essential-addons' ),
						),
					),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			$atts['this_shortcode'] = $this;

			return qode_essential_addons_get_template_part( 'shortcodes/restaurant-menu', 'templates/holder', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-restaurant-menu';

			return implode( ' ', $holder_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . esc_attr( $atts['title_color'] );
			}

			return $styles;
		}

		public function get_description_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['description_color'] ) ) {
				$styles[] = 'color: ' . esc_attr( $atts['description_color'] );
			}

			return $styles;
		}

		public function get_price_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['price_color'] ) ) {
				$styles[] = 'color: ' . esc_attr( $atts['price_color'] );
			}

			return $styles;
		}

		public function get_line_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['line_color'] ) ) {
				$styles[] = 'border-color: ' . esc_attr( $atts['line_color'] );
			}

			return $styles;
		}
	}
}
