<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

abstract class QodeEssentialAddons_List_Shortcode extends QodeEssentialAddons_Framework_Shortcode {
	private $post_type;
	private $post_type_taxonomy;
	private $post_type_additional_taxonomies = array();
	private $layouts                         = array();
	private $extra_options                   = array();

	public function __construct() {
		parent::__construct();

		$this->register_list_scripts();
	}

	public function get_post_type() {
		return $this->post_type;
	}

	public function set_post_type( $post_type ) {
		$this->post_type = $post_type;
	}

	public function get_post_type_taxonomy() {
		return $this->post_type_taxonomy;
	}

	public function set_post_type_taxonomy( $post_type_taxonomy ) {
		$this->post_type_taxonomy = $post_type_taxonomy;
	}

	public function get_post_type_additional_taxonomies() {
		return $this->post_type_additional_taxonomies;
	}

	public function set_post_type_additional_taxonomies( $post_type_additional_taxonomies ) {
		$this->post_type_additional_taxonomies = $post_type_additional_taxonomies;
	}

	public function get_layouts() {
		return $this->layouts;
	}

	public function set_layouts( $layouts ) {
		$this->layouts = $layouts;
	}

	public function get_extra_options() {
		return $this->extra_options;
	}

	public function set_extra_options( $extra_options ) {
		$this->extra_options = $extra_options;
	}

	public function map_list_options( $params = array() ) {
		$group            = isset( $params['group'] ) ? $params['group'] : null;
		$exclude_option   = isset( $params['exclude_option'] ) ? $params['exclude_option'] : array();
		$include_option   = isset( $params['include_option'] ) ? $params['include_option'] : array();
		$exclude_behavior = isset( $params['exclude_behavior'] ) ? $params['exclude_behavior'] : array();
		$exclude_columns  = isset( $params['exclude_columns'] ) ? $params['exclude_columns'] : array();
		$include_columns  = isset( $params['include_columns'] ) ? $params['include_columns'] : array();

		if ( empty( $exclude_behavior ) || ! in_array( 'behavior', $exclude_behavior, true ) ) {
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'behavior',
					'title'         => esc_html__( 'List Appearance', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'list_behavior', false, $exclude_behavior ),
					'default_value' => 'columns',
					'group'         => $group,
				)
			);
		}
		if ( empty( $exclude_behavior ) || ! in_array( 'masonry', $exclude_behavior, true ) ) {
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'masonry_images_proportion',
					'title'         => esc_html__( 'Image Proportions', 'qode-essential-addons' ),
					'options'       => array(
						''      => esc_html__( 'Original', 'qode-essential-addons' ),
						'fixed' => esc_html__( 'Fixed', 'qode-essential-addons' ),
					),
					'default_value' => '',
					'group'         => $group,
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => 'masonry',
								'default_value' => 'columns',
							),
						),
					),
				)
			);
		}

		if ( empty( $exclude_option ) || ! in_array( 'images_proportion', $exclude_option, true ) ) {
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'images_proportion',
					'default_value' => 'full',
					'title'         => esc_html__( 'Image Proportions', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'list_image_dimension', false ),
					'group'         => $group,
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => array( '', 'columns', 'slider' ),
								'default_value' => 'columns',
							),
						),
					),
				)
			);
		}

		if ( empty( $exclude_option ) || ! in_array( 'columns', $exclude_option, true ) ) {
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns',
					'title'         => esc_html__( 'Number of Columns', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number', true, $exclude_columns, $include_columns ),
					'default_value' => '3',
					'group'         => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_responsive',
					'title'         => esc_html__( 'Columns Responsive', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_responsive' ),
					'default_value' => 'predefined',
					'group'         => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_1680',
					'title'         => esc_html__( 'Number of Columns 1441px - 1680px', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '3',
					'dependency'    => array(
						'show' => array(
							'columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => 'predefined',
							),
						),
					),
					'group'         => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_1440',
					'title'         => esc_html__( 'Number of Columns 1367px - 1440px', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '3',
					'dependency'    => array(
						'show' => array(
							'columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => 'predefined',
							),
						),
					),
					'group'         => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_1366',
					'title'         => esc_html__( 'Number of Columns 1025px - 1366px', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '3',
					'dependency'    => array(
						'show' => array(
							'columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => 'predefined',
							),
						),
					),
					'group'         => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_1024',
					'title'         => esc_html__( 'Number of Columns 769px - 1024px', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '3',
					'dependency'    => array(
						'show' => array(
							'columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => 'predefined',
							),
						),
					),
					'group'         => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_768',
					'title'         => esc_html__( 'Number of Columns 681px - 768px', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '3',
					'dependency'    => array(
						'show' => array(
							'columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => 'predefined',
							),
						),
					),
					'group'         => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_680',
					'title'         => esc_html__( 'Number of Columns 481px - 680px', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '3',
					'dependency'    => array(
						'show' => array(
							'columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => 'predefined',
							),
						),
					),
					'group'         => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'columns_480',
					'title'         => esc_html__( 'Number of Columns 0 - 480px', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'columns_number' ),
					'default_value' => '3',
					'dependency'    => array(
						'show' => array(
							'columns_responsive' => array(
								'values'        => 'custom',
								'default_value' => 'predefined',
							),
						),
					),
					'group'         => $group,
				)
			);
		}

		$this->set_option(
			array(
				'field_type'    => 'select',
				'name'          => 'space',
				'title'         => esc_html__( 'Space Between Items', 'qode-essential-addons' ),
				'options'       => qode_essential_addons_get_select_type_options_pool( 'items_space' ),
				'default_value' => 'normal',
				'group'         => $group,
			)
		);

		if ( empty( $exclude_option ) || ! in_array( 'columns', $exclude_option, true ) ) {
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'enable_pagination',
					'title'         => esc_html__( 'Enable Pagination', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => $group,
				)
			);
		}

		if ( empty( $exclude_behavior ) || ! in_array( 'slider', $exclude_behavior, true ) ) {
			$params['dependency'] = array(
				'show' => array(
					'behavior' => array(
						'values'        => 'slider',
						'default_value' => 'columns',
					),
				),
			);
			$this->map_slider_options( $params );
		}

		do_action( 'qode_essential_addons_action_map_additional_options', $this, $group, $include_option );
	}

	public function map_slider_options( $params = array() ) {
		$group      = isset( $params['group'] ) ? $params['group'] : null;
		$dependency = isset( $params['dependency'] ) ? $params['dependency'] : array();

		$this->set_option(
			array(
				'field_type' => 'select',
				'name'       => 'slider_loop',
				'title'      => esc_html__( 'Enable Slider Loop', 'qode-essential-addons' ),
				'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
				'dependency' => $dependency,
				'group'      => $group,
			)
		);
		$this->set_option(
			array(
				'field_type' => 'select',
				'name'       => 'slider_autoplay',
				'title'      => esc_html__( 'Enable Slider Autoplay', 'qode-essential-addons' ),
				'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
				'dependency' => $dependency,
				'group'      => $group,
			)
		);
		$this->set_option(
			array(
				'field_type'  => 'text',
				'name'        => 'slider_speed',
				'title'       => esc_html__( 'Slide Duration', 'qode-essential-addons' ),
				'description' => esc_html__( 'Default value is 5000 (ms)', 'qode-essential-addons' ),
				'dependency'  => $dependency,
				'group'       => $group,
			)
		);
		$this->set_option(
			array(
				'field_type'  => 'text',
				'name'        => 'slider_speed_animation',
				'title'       => esc_html__( 'Slide Animation Duration', 'qode-essential-addons' ),
				'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 800.', 'qode-essential-addons' ),
				'dependency'  => $dependency,
				'group'       => $group,
			)
		);
		$this->set_option(
			array(
				'field_type' => 'select',
				'name'       => 'slider_navigation',
				'title'      => esc_html__( 'Enable Slider Navigation', 'qode-essential-addons' ),
				'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
				'dependency' => $dependency,
				'group'      => $group,
			)
		);
		$this->set_option(
			array(
				'field_type' => 'select',
				'name'       => 'slider_pagination',
				'title'      => esc_html__( 'Enable Slider Pagination', 'qode-essential-addons' ),
				'options'    => qode_essential_addons_get_select_type_options_pool( 'yes_no' ),
				'dependency' => $dependency,
				'group'      => $group,
			)
		);
	}

	public function get_list_classes( $atts ) {
		$holder_classes = array();

		$holder_classes[] = 'qodef-grid';
		$holder_classes[] = ! empty( $atts['behavior'] ) && 'slider' === $atts['behavior'] ? 'qodef-swiper-container' : 'qodef-layout--' . $atts['behavior'];
		$holder_classes[] = ! empty( $atts['behavior'] ) && 'masonry' === $atts['behavior'] && ! empty( $atts['masonry_images_proportion'] ) && 'fixed' === $atts['masonry_images_proportion'] ? 'qodef-items--fixed' : '';
		$holder_classes[] = ! empty( $atts['space'] ) ? 'qodef-gutter--' . $atts['space'] : '';
		$holder_classes[] = ! empty( $atts['columns'] ) ? 'qodef-col-num--' . $atts['columns'] : '';
		$holder_classes[] = ! empty( $atts['borders'] ) ? 'qodef-borders--' . $atts['borders'] : '';

		$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';

		if ( ! empty( $atts['columns_responsive'] ) && 'custom' === $atts['columns_responsive'] ) {
			$holder_classes[] = 'qodef-responsive--custom';
			$holder_classes[] = ! empty( $atts['columns_1680'] ) ? 'qodef-col-num--1680--' . $atts['columns_1680'] : 'qodef-col-num--1680--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_1440'] ) ? 'qodef-col-num--1440--' . $atts['columns_1440'] : 'qodef-col-num--1440--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_1366'] ) ? 'qodef-col-num--1366--' . $atts['columns_1366'] : 'qodef-col-num--1366--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_1024'] ) ? 'qodef-col-num--1024--' . $atts['columns_1024'] : 'qodef-col-num--1024--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_768'] ) ? 'qodef-col-num--768--' . $atts['columns_768'] : 'qodef-col-num--768--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_680'] ) ? 'qodef-col-num--680--' . $atts['columns_680'] : 'qodef-col-num--680--' . $atts['columns'];
			$holder_classes[] = ! empty( $atts['columns_480'] ) ? 'qodef-col-num--480--' . $atts['columns_480'] : 'qodef-col-num--480--' . $atts['columns'];
		} else {
			$holder_classes[] = 'qodef-responsive--predefined';
		}

		$holder_classes = apply_filters( 'qode_essential_addons_filter_list_classes', $holder_classes, $atts );

		return $holder_classes;
	}

	public function get_list_item_classes( $atts ) {
		$item_classes = array();

		$item_classes[] = ! empty( $atts['behavior'] ) && 'slider' === $atts['behavior'] ? 'swiper-slide' : 'qodef-grid-item';

		if ( ! empty( $atts['image_dimension'] ) ) {
			$item_classes[] = $atts['image_dimension']['class'];
		}

		return $item_classes;
	}

	public function get_list_item_image_dimension( $atts ) {
		$image_dimension = array();

		if ( ! empty( $atts['behavior'] ) && 'masonry' === $atts['behavior'] && ! empty( $atts['masonry_images_proportion'] ) && 'fixed' === $atts['masonry_images_proportion'] ) {
			$masonry_image_dimension_name = 'qodef_masonry_image_dimension_' . str_replace( '-', '_', $atts['post_type'] );
			$image_dimension              = qode_essential_addons_get_custom_image_size_meta( 'meta-box', $masonry_image_dimension_name, get_the_ID() );
		}

		if ( ! empty( $atts['behavior'] ) && in_array( $atts['behavior'], array( 'columns', 'slider' ), true ) ) {
			$image_dimension = array(
				'size'  => $atts['images_proportion'],
				'class' => qode_essential_addons_get_custom_image_size_class_name( $atts['images_proportion'] ),
			);
		}

		return $image_dimension;
	}

	public function get_slider_data( $atts, $include = array() ) {
		$data = array();

		$data['slidesPerView'] = isset( $atts['columns'] ) ? $atts['columns'] : 1;
		// double half space for slider.
		$data['spaceBetween']   = isset( $atts['space'] ) ? ( qode_essential_addons_get_space_value( $atts['space'] ) * 2 ) : 0;
		$data['loop']           = isset( $atts['slider_loop'] ) ? 'no' !== $atts['slider_loop'] : true;
		$data['autoplay']       = isset( $atts['slider_autoplay'] ) ? 'no' !== $atts['slider_autoplay'] : true;
		$data['speed']          = isset( $atts['slider_speed'] ) ? $atts['slider_speed'] : '';
		$data['speedAnimation'] = isset( $atts['slider_speed_animation'] ) ? $atts['slider_speed_animation'] : '';

		if ( ! empty( $atts['columns_responsive'] ) && 'custom' === $atts['columns_responsive'] ) {
			$data['customStages']      = true;
			$data['slidesPerView1680'] = ! empty( $atts['columns_1680'] ) ? $atts['columns_1680'] : $atts['columns'];
			$data['slidesPerView1440'] = ! empty( $atts['columns_1440'] ) ? $atts['columns_1440'] : $atts['columns'];
			$data['slidesPerView1366'] = ! empty( $atts['columns_1366'] ) ? $atts['columns_1366'] : $atts['columns'];
			$data['slidesPerView1024'] = ! empty( $atts['columns_1024'] ) ? $atts['columns_1024'] : $atts['columns'];
			$data['slidesPerView768']  = ! empty( $atts['columns_768'] ) ? $atts['columns_768'] : $atts['columns'];
			$data['slidesPerView680']  = ! empty( $atts['columns_680'] ) ? $atts['columns_680'] : $atts['columns'];
			$data['slidesPerView480']  = ! empty( $atts['columns_480'] ) ? $atts['columns_480'] : $atts['columns'];
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $data ) ) {
					$data[ $key ] = $value;
				}
			}
		}

		return wp_json_encode( $data );
	}

	public function map_query_options( $params = array() ) {
		$group                = isset( $params['group'] ) ? $params['group'] : esc_html__( 'Query', 'qode-essential-addons' );
		$post_type            = isset( $params['post_type'] ) ? $params['post_type'] : 'post';
		$taxonomies_formatted = array();
		$exclude_option       = isset( $params['exclude_option'] ) ? $params['exclude_option'] : array();
		$exclude_order_by     = isset( $params['exclude_order_by'] ) ? $params['exclude_order_by'] : array();
		$include_order_by     = isset( $params['include_order_by'] ) ? $params['include_order_by'] : array();

		if ( ! empty( $post_type ) ) {
			$main_taxonomy = $this->get_post_type_taxonomy();
			$taxonomies    = array_filter( array_merge( array( ! empty( $main_taxonomy ) ? $main_taxonomy : '' ), $this->get_post_type_additional_taxonomies() ) );

			if ( ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $taxonomy ) {
					$taxonomies_formatted[ $taxonomy ] = ucwords( str_replace( array( '_', '-' ), array( ' ', ' ' ), $taxonomy ) );
				}
			}
		}

		$this->set_option(
			array(
				'field_type'    => 'text',
				'name'          => 'posts_per_page',
				'title'         => esc_html__( 'Posts per Page', 'qode-essential-addons' ),
				'default_value' => '9',
				'group'         => $group,
			)
		);
		$this->set_option(
			array(
				'field_type'    => 'select',
				'name'          => 'orderby',
				'title'         => esc_html__( 'Order By', 'qode-essential-addons' ),
				'options'       => qode_essential_addons_get_select_type_options_pool( 'order_by', true, $exclude_order_by, $include_order_by ),
				'default_value' => 'date',
				'group'         => $group,
			)
		);
		$this->set_option(
			array(
				'field_type'    => 'select',
				'name'          => 'order',
				'title'         => esc_html__( 'Order', 'qode-essential-addons' ),
				'options'       => qode_essential_addons_get_select_type_options_pool( 'order' ),
				'default_value' => 'DESC',
				'group'         => $group,
			)
		);

		if ( empty( $exclude_option ) || ! in_array( 'additional_params', $exclude_option, true ) ) {

			do_action( 'qode_essential_addons_action_map_query_options_before_additional', $group );

			$additional_params = apply_filters(
				'qode_essential_addons_filter_map_additional_query_params',
				array(
					''       => esc_html__( 'No', 'qode-essential-addons' ),
					'id'     => esc_html__( 'Post IDs', 'qode-essential-addons' ),
					'tax'    => esc_html__( 'Taxonomy Slug', 'qode-essential-addons' ),
					'author' => esc_html__( 'Author Name', 'qode-essential-addons' ),
				)
			);

			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'additional_params',
					'title'      => esc_html__( 'Additional Params', 'qode-essential-addons' ),
					'options'    => $additional_params,
					'group'      => $group,
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'post_ids',
					'title'       => esc_html__( 'Posts IDs', 'qode-essential-addons' ),
					'description' => esc_html__( 'Separate post IDs with commas', 'qode-essential-addons' ),
					'group'       => $group,
					'dependency'  => array(
						'show' => array(
							'additional_params' => array(
								'values'        => 'id',
								'default_value' => '',
							),
						),
					),
				)
			);
			if ( ! empty( $taxonomies_formatted ) ) {
				$this->set_option(
					array(
						'field_type' => 'select',
						'name'       => 'tax',
						'title'      => esc_html__( 'Taxonomy', 'qode-essential-addons' ),
						'options'    => $taxonomies_formatted,
						'group'      => $group,
						'dependency' => array(
							'show' => array(
								'additional_params' => array(
									'values'        => 'tax',
									'default_value' => '',
								),
							),
						),
					)
				);
				$this->set_option(
					array(
						'field_type' => 'text',
						'name'       => 'tax_slug',
						'title'      => esc_html__( 'Taxonomy Slug', 'qode-essential-addons' ),
						'group'      => $group,
						'dependency' => array(
							'show' => array(
								'additional_params' => array(
									'values'        => 'tax',
									'default_value' => '',
								),
							),
						),
					)
				);
				$this->set_option(
					array(
						'field_type'  => 'text',
						'name'        => 'tax__in',
						'title'       => esc_html__( 'Taxonomy IDs', 'qode-essential-addons' ),
						'description' => esc_html__( 'Separate taxonomy IDs with commas', 'qode-essential-addons' ),
						'group'       => $group,
						'dependency'  => array(
							'show' => array(
								'additional_params' => array(
									'values'        => 'tax',
									'default_value' => '',
								),
							),
						),
					)
				);
			}
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'author_slug',
					'title'      => esc_html__( 'Author Slug', 'qode-essential-addons' ),
					'group'      => $group,
					'dependency' => array(
						'show' => array(
							'additional_params' => array(
								'values'        => 'author',
								'default_value' => '',
							),
						),
					),
				)
			);

			do_action( 'qode_essential_addons_action_map_query_options_after_additional', $group );
		}
	}

	public function get_additional_query_args( $atts ) {
		$args = array();

		if ( ! empty( $atts['additional_params'] ) && 'id' === $atts['additional_params'] ) {
			$post_ids         = explode( ',', $atts['post_ids'] );
			$args['orderby']  = 'post__in';
			$args['post__in'] = $post_ids;
		}

		if ( ! empty( $atts['additional_params'] ) && 'tax' === $atts['additional_params'] ) {
			$taxonomy_values = array();

			$slug = isset( $atts['tax_slug'] ) ? $atts['tax_slug'] : '';
			$ids  = isset( $atts['tax__in'] ) ? $atts['tax__in'] : '';

			if ( ! empty( $ids ) && empty( $slug ) ) {
				$taxonomy_values['field'] = 'term_id';
				$taxonomy_values['terms'] = is_array( $ids ) ? array_map( 'intval', $ids ) : array_map( 'intval', explode( ',', str_replace( ' ', '', $ids ) ) );
			} elseif ( ! empty( $slug ) ) {
				$taxonomy_values['field'] = 'slug';
				$taxonomy_values['terms'] = $slug;
			}

			if ( ! empty( $atts['tax'] ) && ! empty( $taxonomy_values ) ) {
				// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				$args['tax_query'] = array( array_merge( array( 'taxonomy' => $atts['tax'] ), $taxonomy_values ) );
			}
		}

		if ( ! empty( $atts['additional_params'] ) && 'author' === $atts['additional_params'] ) {
			$args['author_name'] = $atts['author_slug'];
		}

		$args = apply_filters( 'qode_essential_addons_filter_additional_query_args', $args, $atts, $this->get_post_type() );

		return $args;
	}

	public function map_layout_options( $params = array() ) {
		$layouts                 = isset( $params['layouts'] ) ? $params['layouts'] : array();
		$exclude_option          = isset( $params['exclude_option'] ) ? $params['exclude_option'] : array();
		$default_value_title_tag = isset( $params['default_value_title_tag'] ) ? $params['default_value_title_tag'] : 'h5';

		$layout_visibility_field_type = count( $layouts ) > 1 ? 'select' : 'hidden';

		$default_value = '';
		if ( ! empty( $layouts ) ) {
			reset( $layouts );
			$default_value = key( $layouts );
		}

		$this->set_option(
			array(
				'field_type'    => $layout_visibility_field_type,
				'name'          => 'layout',
				'title'         => esc_html__( 'Item Layout', 'qode-essential-addons' ),
				'options'       => $layouts,
				'default_value' => $default_value,
				'group'         => esc_html__( 'Layout', 'qode-essential-addons' ),
			)
		);

		if ( empty( $exclude_option ) || ! in_array( 'title_tag', $exclude_option, true ) ) {
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'qode-essential-addons' ),
					'options'       => qode_essential_addons_get_select_type_options_pool( 'title_tag' ),
					'default_value' => $default_value_title_tag,
					'group'         => esc_html__( 'Layout', 'qode-essential-addons' ),
				)
			);
		}
	}

	public function map_extra_options() {
		$extra_options = $this->get_extra_options();

		if ( ! empty( $extra_options ) ) {
			foreach ( $extra_options as $option ) {
				$this->set_option( $option );
			}
		}
	}

	public function register_list_scripts() {
		$scripts      = $this->get_scripts();
		$list_scripts = apply_filters( 'qode_essential_addons_filter_register_list_shortcode_scripts', isset( $scripts ) ? $scripts : array() );

		$this->set_scripts( $list_scripts );
	}

	public function load_assets() {
		do_action( 'qode_essential_addons_action_list_shortcodes_load_assets', $this->get_atts() );
	}
}
