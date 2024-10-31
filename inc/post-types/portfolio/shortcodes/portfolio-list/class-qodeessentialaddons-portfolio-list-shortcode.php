<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_portfolio_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function qode_essential_addons_add_portfolio_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'QodeEssentialAddons_Portfolio_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'qode_essential_addons_filter_register_shortcodes', 'qode_essential_addons_add_portfolio_list_shortcode' );
}

if ( class_exists( 'QodeEssentialAddons_List_Shortcode' ) ) {
	class QodeEssentialAddons_Portfolio_List_Shortcode extends QodeEssentialAddons_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( apply_filters( 'qode_essential_addons_filter_set_portfolio_additional_taxonomies', array( 'portfolio-tag' ) ) );
			$this->set_layouts( apply_filters( 'qode_essential_addons_filter_portfolio_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'qode_essential_addons_filter_portfolio_list_extra_options', array(), $this ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( QODE_ESSENTIAL_ADDONS_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list' );
			$this->set_base( 'qode_essential_addons_portfolio_list' );
			$this->set_name( esc_html__( 'Portfolio List Essentials', 'qode-essential-addons' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of portfolios', 'qode-essential-addons' ) );
			$this->set_category( esc_html__( 'Qode Essential Addons', 'qode-essential-addons' ) );
			$this->set_scripts(
				apply_filters( 'qode_essential_addons_filter_portfolio_list_register_assets', array() )
			);

			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'qode-essential-addons' ),
				)
			);
			$this->map_list_options(
				array(
					'include_option' => apply_filters( 'qode_essential_addons_filter_portfolio_list_list_option', array() ),
				)
			);
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'custom_padding',
					'title'         => esc_html__( 'Use Item Custom Padding', 'qode-essential-addons' ),
					'group'         => esc_html__( 'Layout', 'qode-essential-addons' ),
					'default_value' => 'no',
					'options'       => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
				)
			);
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
					'name'       => 'show_button',
					'title'      => esc_html__( 'Show Button', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
					'dependency' => array(
						'show' => array(
							'layout' => array(
								'values'        => 'info-on-hover',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'center_content',
					'title'      => esc_html__( 'Center Content', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
					'dependency' => array(
						'hide' => array(
							'layout' => array(
								'values'        => 'info-follow',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'content_order',
					'title'         => esc_html__( 'Content Order', 'qode-essential-addons' ),
					'options'       => array(
						'category-first' => esc_html__( 'Category First', 'qode-essential-addons' ),
						'title-first'    => esc_html__( 'Title First', 'qode-essential-addons' ),
					),
					'default_value' => 'category-first',
					'group'         => esc_html__( 'Layout', 'qode-essential-addons' ),
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
					'description' => esc_html__( 'Format: Top Right Bottom Left', 'qode-essential-addons' ),
					'dependency'  => array(
						'hide' => array(
							'layout' => array(
								'values'        => 'info-follow',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'overlay_color',
					'title'      => esc_html__( 'Image Overlay Color', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'overlay_hover_color',
					'title'      => esc_html__( 'Image Overlay Hover Color', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
					'dependency' => array(
						'hide' => array(
							'layout' => array(
								'values'        => 'info-on-hover',
								'default_value' => '',
							),
						),
					),
				)
			);

			$hover_options = apply_filters(
				'qode_essential_addons_filter_portfolio_list_hovers',
				array(
					''         => esc_html__( 'Default', 'qode-essential-addons' ),
					'zoom'     => esc_html__( 'Zoom In', 'qode-essential-addons' ),
					'zoom-out' => esc_html__( 'Zoom Out', 'qode-essential-addons' ),
					'move'     => esc_html__( 'Move', 'qode-essential-addons' ),
					'none'     => esc_html__( 'None', 'qode-essential-addons' ),
				)
			);

			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'image_hover',
					'title'      => esc_html__( 'Image Hover', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
					'options'    => $hover_options,
					'dependency' => array(
						'show' => array(
							'layout' => array(
								'values'        => array( 'info-follow', 'info-below', 'info-above' ),
								'default_value' => '',
							),
						),
					),
				)
			);

			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'image_zoom_origin',
					'title'      => esc_html__( 'Image Hover Zoom Origin', 'qode-essential-addons' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
					'options'    => array(
						''       => esc_html__( 'Center', 'qode-essential-addons' ),
						'top'    => esc_html__( 'Top', 'qode-essential-addons' ),
						'bottom' => esc_html__( 'Bottom', 'qode-essential-addons' ),
						'left'   => esc_html__( 'Left', 'qode-essential-addons' ),
						'right'  => esc_html__( 'Right', 'qode-essential-addons' ),
					),
					'dependency' => array(
						'show' => array(
							'image_hover' => array(
								'values'        => array( 'zoom', 'zoom-out' ),
								'default_value' => 'zoom',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'title_padding',
					'title'       => esc_html__( 'Title Padding', 'qode-essential-addons' ),
					'group'       => esc_html__( 'Layout Spacing', 'qode-essential-addons' ),
					'description' => esc_html__( 'Format: Top Right Bottom Left', 'qode-essential-addons' ),
					'dependency'  => array(
						'show' => array(
							'layout' => array(
								'values'        => 'info-follow',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'post_info_margin_bottom',
					'title'       => esc_html__( 'Post Info Margin', 'qode-essential-addons' ),
					'description' => esc_html__( 'Format: Top Right Bottom Left', 'qode-essential-addons' ),
					'group'       => esc_html__( 'Layout Spacing', 'qode-essential-addons' ),
				)
			);
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_essential_addons_framework_call_shortcode( 'qode_essential_addons_portfolio_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			parent::load_assets();

			do_action( 'qode_essential_addons_action_portfolio_list_load_assets', $this->get_atts() );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type'] = $this->get_post_type();

			// Additional query args.
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']   = new \WP_Query( qode_essential_addons_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['data_attr']      = apply_filters( 'qode_essential_addons_filter_portfolio_list_data_attr', array(), $atts );

			$atts['this_shortcode'] = $this;

			return qode_essential_addons_get_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			if ( ! empty( $atts['center_content'] ) && 'yes' === $atts['center_content'] ) {
				$holder_classes[] = 'qodef-alignment--centered';
			}
			if ( ! empty( $atts['center_content'] ) && 'yes' === $atts['center_content'] && 'no' === $atts['show_button'] ) {
				$holder_classes[] = 'qodef-alignment-vertical--centered';
			}

			$holder_classes[] = ! empty( $atts['content_background_color'] ) ? 'qodef-content-has-background-color' : '';
			$holder_classes[] = ! empty( $atts['image_hover'] ) ? 'qodef-image--hover-' . $atts['image_hover'] : '';
			$holder_classes[] = ! empty( $atts['image_zoom_origin'] ) ? 'qodef-image--hover-from-' . $atts['image_zoom_origin'] : '';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_holder_styles( $atts ) {

			$styles = array();

			if ( ! empty( $atts['gradient_color_1'] ) ) {
				$styles[] = '--qode-gradient-color-1: ' . $atts['gradient_color_1'];
			}

			if ( ! empty( $atts['gradient_color_2'] ) ) {
				$styles[] = '--qode-gradient-color-2: ' . $atts['gradient_color_2'];
			}

			if ( ! empty( $atts['gradient_color_3'] ) ) {
				$styles[] = '--qode-gradient-color-3: ' . $atts['gradient_color_3'];
			}

			return $styles;
		}


		public function get_list_item_style( $atts ) {
			$styles = array();

			if ( isset( $atts['custom_padding'] ) && 'yes' === $atts['custom_padding'] ) {
				$styles[] = 'margin: ' . get_post_meta( get_the_ID(), 'qodef_portfolio_item_padding', true );
			}

			return $styles;
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

		public function get_overlay_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['overlay_color'] ) ) {
				$styles[] = '--q-overlay-color: ' . $atts['overlay_color'];
			}

			if ( ! empty( $atts['overlay_hover_color'] ) ) {
				$styles[] = '--q-overlay-hover-color: ' . $atts['overlay_hover_color'];
			}

			return $styles;
		}

		public function get_title_specific_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['title_padding'] ) {
				$all_content_padding = explode( ' ', $atts['title_padding'] );
				$exploded_padding    = '';
				foreach ( $all_content_padding as $single_padding ) {
					$exploded_padding .= intval( $single_padding ) . 'px ';
				}
				$styles[] = 'padding: ' . $exploded_padding;
			}

			return $styles;
		}

		public function get_post_info_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['category_color'] ) ) {
				$styles[] = 'color: ' . $atts['category_color'];
			}

			if ( ! empty( $atts['category_underline'] ) && 'yes' === $atts['category_underline'] ) {
				$styles[] = 'text-decoration: underline';
			}

			if ( '' !== $atts['post_info_margin_bottom'] ) {
				$all_content_margin = explode( ' ', $atts['post_info_margin_bottom'] );
				$exploded_margin    = '';
				foreach ( $all_content_margin as $single_margin ) {
					$exploded_margin .= intval( $single_margin ) . 'px ';
				}
				$styles[] = 'margin: ' . $exploded_margin;
			}

			return $styles;
		}

		public function get_button_styles( $atts ) {
			$styles = array();

			if ( isset( $atts['button_margin'] ) && '' !== $atts['button_margin'] ) {
				$all_content_margin = explode( ' ', $atts['button_margin'] );
				$exploded_margin    = '';
				foreach ( $all_content_margin as $single_margin ) {
					$exploded_margin .= intval( $single_margin ) . 'px ';
				}
				$styles[] = 'margin: ' . $exploded_margin;
			}

			return $styles;
		}
	}
}
