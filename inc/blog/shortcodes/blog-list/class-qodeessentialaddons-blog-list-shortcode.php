<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_blog_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function qode_essential_addons_add_blog_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'QodeEssentialAddons_Blog_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'qode_essential_addons_filter_register_shortcodes', 'qode_essential_addons_add_blog_list_shortcode' );
}

if ( class_exists( 'QodeEssentialAddons_List_Shortcode' ) ) {
	class QodeEssentialAddons_Blog_List_Shortcode extends QodeEssentialAddons_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'post' );
			$this->set_post_type_taxonomy( 'category' );
			$this->set_post_type_additional_taxonomies( array( 'post_tag' ) );
			$this->set_layouts( apply_filters( 'qode_essential_addons_filter_blog_list_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( QODE_ESSENTIAL_ADDONS_INC_URL_PATH . '/blog/shortcodes/blog-list' );
			$this->set_base( 'qode_essential_addons_blog_list' );
			$this->set_name( esc_html__( 'Blog List Essentials', 'qode-essential-addons' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of blog posts', 'qode-essential-addons' ) );
			$this->set_category( esc_html__( 'Qode Essential Addons', 'qode-essential-addons' ) );
			$this->set_scripts(
				apply_filters( 'qode_essential_addons_filter_blog_list_register_scripts', array() )
			);
			$this->set_necessary_styles(
				apply_filters( 'qode_essential_addons_filter_blog_list_register_styles', array() )
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
					'include_option' => apply_filters( 'qode_essential_addons_filter_blog_list_list_option', array() ),
				)
			);
			$this->map_query_options();

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'quote_link_tag',
					'title'         => esc_html__( 'Quote / Link Tag', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'title_tag', false ),
					'default_value' => 'h3',
					'group'         => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->map_layout_options( array( 'layouts' => $this->get_layouts() ) );
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'show_excerpt',
					'title'      => esc_html__( 'Show Excerpt', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'excerpt_length',
					'title'      => esc_html__( 'Excerpt Length', 'qode-essential-addons' ),
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
					'field_type' => 'select',
					'name'       => 'show_media',
					'title'      => esc_html__( 'Show Media', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'show_date',
					'title'      => esc_html__( 'Show Date', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
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
					'name'       => 'show_author',
					'title'      => esc_html__( 'Show Author', 'qode-essential-addons' ),
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
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'show_info_on_quote',
					'title'      => esc_html__( 'Show Info on Quote Posts', 'qode-essential-addons' ),
					'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
					'group'      => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'content_background_color',
					'title'      => esc_html__( 'Content Background Color', 'qode-essential-addons' ),
					'selectors'  => array(
						'{{WRAPPER}} .qodef-blog-shortcode .qodef-blog-item .qodef-e-content' => 'background-color: {{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'dimensions',
					'name'       => 'content_padding',
					'title'      => esc_html__( 'Content Padding', 'qode-essential-addons' ),
					'size_units' => array( 'px', '%', 'em' ),
					'responsive' => true,
					'selectors'  => array(
						'{{WRAPPER}} .qodef-blog-shortcode .qodef-blog-item .qodef-e-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'group'      => esc_html__( 'Spacing Style', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'slider',
					'name'       => 'post_info_margin_bottom',
					'title'      => esc_html__( 'Post Info Margin Bottom', 'qode-essential-addons' ),
					'size_units' => array( 'px', '%', 'em' ),
					'responsive' => true,
					'selectors'  => array(
						'{{WRAPPER}} .qodef-blog-shortcode .qodef-blog-item .qodef-e-info.qodef-info--top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					),
					'group'      => esc_html__( 'Spacing Style', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'slider',
					'name'       => 'excerpt_margin_top',
					'title'      => esc_html__( 'Title Margin Bottom', 'qode-essential-addons' ),
					'size_units' => array( 'px', '%', 'em' ),
					'responsive' => true,
					'selectors'  => array(
						'{{WRAPPER}} .qodef-blog-shortcode .qodef-blog-item .qodef-e-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					),
					'group'      => esc_html__( 'Spacing Style', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'slider',
					'name'       => 'read_more_margin_top',
					'title'      => esc_html__( 'Button Margin Top', 'qode-essential-addons' ),
					'size_units' => array( 'px', '%', 'em' ),
					'responsive' => true,
					'selectors'  => array(
						'{{WRAPPER}} .qodef-blog-shortcode .qodef-blog-item .qodef-e-read-more' => 'margin-top: {{SIZE}}{{UNIT}};',
					),
					'group'      => esc_html__( 'Spacing Style', 'qode-essential-addons' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'slider',
					'name'       => 'item_margin_bottom',
					'title'      => esc_html__( 'Additional Item Margin Bottom', 'qode-essential-addons' ),
					'size_units' => array( 'px', '%', 'em' ),
					'range'      => array(
						'px' => array(
							'min' => 0,
							'max' => 300,
						),
					),
					'responsive' => true,
					'selectors'  => array(
						'{{WRAPPER}} .qodef-blog-shortcode .qodef-blog-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .qodef-blog-shortcode:not(.qodef-col-num--1) article .qodef-e-inner' => 'margin-bottom: 0;',
					),
					'group'      => esc_html__( 'Spacing Style', 'qode-essential-addons' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_essential_addons_framework_call_shortcode( 'qode_essential_addons_blog_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			parent::load_assets();

			$is_allowed = apply_filters( 'qode_essential_addons_filter_load_blog_list_assets', false, $this->get_atts() );

			if ( $is_allowed ) {
				wp_enqueue_style( 'wp-mediaelement' );
				wp_enqueue_script( 'wp-mediaelement' );
				wp_enqueue_script( 'mediaelement-vimeo' );
			}
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type'] = $this->get_post_type();

			// Additional query args.
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( qode_essential_addons_get_query_params( $atts ) );
			$atts['data_attr']      = apply_filters( 'qode_essential_addons_filter_blog_list_data_attr', array(), $atts );
			$atts['this_shortcode'] = $this;

			return qode_essential_addons_get_template_part( 'blog/shortcodes/blog-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-blog-shortcode';
			if ( ! empty( $atts['layout'] ) && 'standard' === $atts['layout'] ) {
				$holder_classes[] = 'qodef--list';
			}
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
			$item_classes[]    = 'qodef-blog-item';
			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_content_styles( $atts ) {
			$styles = array();

			// Fallback for old content_padding textfield.
			if ( is_string( $atts['content_padding'] ) && '' !== $atts['content_padding'] ) {
				$all_content_padding = explode( ' ', $atts['content_padding'] );
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

			// Fallback for old post_info_margin_bottom textfield.
			if ( is_string( $atts['post_info_margin_bottom'] ) && '' !== $atts['post_info_margin_bottom'] ) {
				$styles[] = 'margin-bottom: ' . intval( $atts['post_info_margin_bottom'] ) . 'px';
			}

			return $styles;
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			// Fallback for old excerpt_margin_top textfield.
			if ( is_string( $atts['excerpt_margin_top'] ) && '' !== $atts['excerpt_margin_top'] ) {
				$styles[] = 'margin-bottom: ' . intval( $atts['excerpt_margin_top'] ) . 'px';
			}

			return $styles;
		}

		public function get_read_more_styles( $atts ) {
			$styles = array();

			// Fallback for old read_more_margin_top textfield.
			if ( is_string( $atts['read_more_margin_top'] ) && '' !== $atts['read_more_margin_top'] ) {
				$styles[] = 'margin-top: ' . intval( $atts['read_more_margin_top'] ) . 'px';
			}

			return $styles;
		}
	}
}
