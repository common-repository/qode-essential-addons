<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_product_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function qode_essential_addons_add_product_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'QodeEssentialAddons_Product_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'qode_essential_addons_filter_register_shortcodes', 'qode_essential_addons_add_product_list_shortcode' );
}

if ( class_exists( 'QodeEssentialAddons_List_Shortcode' ) ) {
	class QodeEssentialAddons_Product_List_Shortcode extends QodeEssentialAddons_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'product' );
			$this->set_post_type_taxonomy( 'product_cat' );
			$this->set_post_type_additional_taxonomies( array( 'product_tag', 'product_type' ) );
			$this->set_layouts( apply_filters( 'qode_essential_addons_filter_product_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'qode_essential_addons_filter_portfolio_list_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( QODE_ESSENTIAL_ADDONS_PLUGINS_URL_PATH . '/woocommerce/shortcodes/product-list' );
			$this->set_base( 'qode_essential_addons_product_list' );
			$this->set_name( esc_html__( 'Product List Essentials', 'qode-essential-addons' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of products', 'qode-essential-addons' ) );
			$this->set_category( esc_html__( 'Qode Essential Addons', 'qode-essential-addons' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'qode-essential-addons' ),
				)
			);
			$this->map_list_options(
				array(
					'include_option' => apply_filters( 'qode_essential_addons_filter_product_list_list_option', array() ),
				)
			);
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'filterby',
					'title'         => esc_html__( 'Filter By', 'qode-essential-addons' ),
					'options'       => array(
						''             => esc_html__( 'Default', 'qode-essential-addons' ),
						'on_sale'      => esc_html__( 'On Sale', 'qode-essential-addons' ),
						'featured'     => esc_html__( 'Featured', 'qode-essential-addons' ),
						'top_rated'    => esc_html__( 'Top Rated', 'qode-essential-addons' ),
						'best_selling' => esc_html__( 'Best Selling', 'qode-essential-addons' ),
					),
					'default_value' => '',
					'group'         => esc_html__( 'Query', 'qode-essential-addons' ),
					'dependency'    => array(
						'show' => array(
							'additional_params' => array(
								'values'        => '',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'show_category',
					'title'      => esc_html__( 'Show Category', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'show_price',
					'title'      => esc_html__( 'Show Price', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'show_rating',
					'title'      => esc_html__( 'Show Rating', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'center_content',
					'title'      => esc_html__( 'Center Content', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'content_background_color',
					'title'      => esc_html__( 'Content Background Color', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'content_padding',
					'title'       => esc_html__( 'Content Padding', 'qode-essential-addons' ),
					'group'       => esc_html__( 'Layout Spacing', 'qode-essential-addons' ),
					'description' => esc_html__( 'Format: Top Right Bottom Left (10px 5px 8px 5px)', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'post_info_margin_bottom',
					'title'      => esc_html__( 'Post Info Margin Bottom', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout Spacing', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'price_margin_top',
					'title'      => esc_html__( 'Price Margin Top', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout Spacing', 'qode-essential-addons' ),
					'dependency' => array(
						'show' => array(
							'center_content' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'rating_margin_top',
					'title'      => esc_html__( 'Rating Margin Top', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout Spacing', 'qode-essential-addons' ),
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_essential_addons_framework_call_shortcode( 'qode_essential_addons_product_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type'] = $this->get_post_type();

			// Additional query args.
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( qode_essential_addons_get_query_params( $atts ) );
			$atts['data_attr']      = apply_filters( 'qode_essential_addons_filter_product_list_data_attr', array(), $atts );

			$atts['this_shortcode'] = $this;

			return qode_essential_addons_get_template_part( 'plugins/woocommerce/shortcodes/product-list', 'templates/content', $atts['behavior'], $atts );
		}

		public function get_additional_query_args( $atts ) {
			$args = parent::get_additional_query_args( $atts );

			if ( ! empty( $atts['filterby'] ) ) {
				switch ( $atts['filterby'] ) {
					case 'on_sale':
						$args['no_found_rows'] = 1;
						$args['post__in']      = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
						break;
					case 'featured':
						// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
						$args['tax_query'] = WC()->query->get_tax_query();

						$args['tax_query'][] = array(
							'taxonomy'         => 'product_visibility',
							'terms'            => 'featured',
							'field'            => 'name',
							'operator'         => 'IN',
							'include_children' => false,
						);
						break;
					case 'top_rated':
						// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
						$args['meta_key'] = '_wc_average_rating';
						$args['order']    = 'DESC';
						$args['orderby']  = 'meta_value_num';
						break;
					case 'best_selling':
						// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
						$args['meta_key'] = 'total_sales';
						$args['order']    = 'DESC';
						$args['orderby']  = 'meta_value_num';
						break;
				}
			}

			return $args;
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-woo-shortcode';
			$holder_classes[] = 'qodef-woo-shortcode-product-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			if ( ! empty( $atts['center_content'] ) && 'yes' === $atts['center_content'] ) {
				$holder_classes[] = 'qodef-alignment--centered';
			}
			$holder_classes[] = ! empty( $atts['content_background_color'] ) ? 'qodef-content-has-background-color' : '';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes      = $this->init_item_classes();
			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_content_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['content_background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['content_background_color'];
			}

			if ( '' !== $atts['content_padding'] ) {
				$all_content_padding = explode( ' ', $atts['content_padding'] );
				$exploded_padding    = '';
				foreach ( $all_content_padding as $single_padding ) {
					$exploded_padding .= intval( $single_padding ) . 'px ';
				}
				$styles[] = 'padding: ' . $exploded_padding;
			}

			return $styles;
		}

		public function get_image_hover_background_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['image_hover_background_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['image_hover_background_color'];
			}

			return $styles;
		}

		public function get_post_info_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['post_info_margin_bottom'] ) {
				$styles[] = 'margin-bottom: ' . intval( $atts['post_info_margin_bottom'] ) . 'px';
			}

			return $styles;
		}

		public function get_price_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['price_margin_top'] ) {
				$styles[] = 'margin-top: ' . intval( $atts['price_margin_top'] ) . 'px';
			}

			return $styles;
		}

		public function get_rating_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['rating_margin_top'] ) {
				$styles[] = 'margin-top: ' . intval( $atts['rating_margin_top'] ) . 'px';
			}

			return $styles;
		}
	}
}
