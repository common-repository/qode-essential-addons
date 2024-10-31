<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Framework_Elementor_Translator {
	private static $instance;

	public function __construct() {
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_category' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'add_inline_style' ) );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function generate_option_params( $shortcode ) {
		$shortcode_options = $shortcode->get_options();
		$formatted_options = array();

		if ( $shortcode->get_is_parent_shortcode() ) {
			$children = $shortcode->get_child_elements();

			foreach ( $children as $child ) {
				$child_object = qode_essential_addons_framework_get_framework_root()->get_shortcodes()->get_shortcode( $child );

				$shortcode_options['elements_of_child_widget'] = array(
					'field_type' => 'repeater',
					'name'       => 'elements_of_child_widget',
					'title'      => $child_object->get_name(),
					'items'      => array(),
				);

				foreach ( $child_object->get_options() as $child_option_key => $child_option ) {

					$visibility = isset( $child_option['visibility'] ) ? $child_option['visibility'] : array();
					if ( ! isset( $visibility['map_for_page_builder'] ) || ( isset( $visibility['map_for_page_builder'] ) && true === $visibility['map_for_page_builder'] ) ) {
						$shortcode_options['elements_of_child_widget']['items'][] = $child_option;
					}
				}

				if ( $child_object->get_is_parent_shortcode() ) {
					$shortcode_options['elements_of_child_widget']['items'][] = array(
						'field_type' => 'html',
						'name'       => 'content',
						'title'      => esc_html__( 'Content', 'qode-essential-addons' ),
					);
				}
			}
		}

		foreach ( $shortcode_options as $option_key => $option ) {
			$formatted_options = array_merge_recursive( $formatted_options, $this->generate_options_array( $option_key, $option ) );
		}

		return $formatted_options;
	}

	public function generate_options_array( $option_key, $option ) {
		$formatted_options = array();

		// Visibility Options.
		$visibility = isset( $option['visibility'] ) ? $option['visibility'] : array();
		$group      = isset( $option['group'] ) ? str_replace( ' ', '-', strtolower( $option['group'] ) ) . '-elementor' : 'general';

		if ( ! isset( $visibility['map_for_page_builder'] ) || ( isset( $visibility['map_for_page_builder'] ) && true === $visibility['map_for_page_builder'] ) ) {
			$formatted_options[ $group ]['fields'][ $option_key ]['field_type'] = $option['field_type'];
			$formatted_options[ $group ]['fields'][ $option_key ]['label']      = $option['title'];

			if ( isset( $option['default_value'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['default'] = $option['default_value'];
			}
			if ( isset( $option['options'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['options'] = $option['options'];

				if ( ! isset( $option['default_value'] ) && ! empty( key( $option['options'] ) ) ) {
					$formatted_options[ $group ]['fields'][ $option_key ]['default'] = key( $option['options'] );
				}
			}
			if ( isset( $option['description'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['description'] = $option['description'];
			}
			if ( isset( $option['multiple'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['multiple'] = $option['multiple'];
			}
			if ( isset( $option['alpha'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['alpha'] = $option['alpha'];
			}
			if ( isset( $option['size_units'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['size_units'] = $option['size_units'];
			}
			if ( isset( $option['range'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['range'] = $option['range'];
			}
			if ( isset( $option['allowed_dimensions'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['allowed_dimensions'] = $option['allowed_dimensions'];
			}
			if ( isset( $option['placeholder'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['placeholder'] = $option['placeholder'];
			}
			if ( isset( $option['selector'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['selector'] = $option['selector'];
			}
			if ( isset( $option['selectors'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['selectors'] = $option['selectors'];
			}
			if ( isset( $option['selectors_dictionary'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['selectors_dictionary'] = $option['selectors_dictionary'];
			}
			if ( isset( $option['responsive'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['responsive_enabled'] = $option['responsive'];
			}
			if ( isset( $option['devices'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['devices'] = $option['devices'];
			}
			if ( isset( $option['prefix_class'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['prefix_class'] = $option['prefix_class'];
			}
			if ( isset( $option['exclude_options'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['exclude'] = $option['exclude_options'];
			}
			if ( isset( $option['media_types'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['media_types'] = $option['media_types'];
			}
			if ( isset( $option['types'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['types'] = $option['types'];
			}

			// Dependency Options.

			if ( isset( $option['dependency'] ) ) {
				if ( isset( $option['dependency']['show'] ) ) {
					$dependency     = $option['dependency']['show'];
					$dependency_key = key( $dependency );

					if ( '' === $dependency[ $dependency_key ]['values'] ) {
						$option['condition'] = array(
							$dependency_key => array( '' ),
						);
					} else {
						$option['condition'] = array(
							$dependency_key => $dependency[ $dependency_key ]['values'],
						);
					}
					$formatted_options[ $group ]['fields'][ $option_key ]['condition'] = $option['condition'];
				}

				if ( isset( $option['dependency']['hide'] ) ) {
					$dependency     = $option['dependency']['hide'];
					$dependency_key = key( $dependency );

					if ( '' === $dependency[ $dependency_key ]['values'] ) {
						$option['condition'] = array(
							$dependency_key . '!' => array( '' ),
						);
					} else {
						$option['condition'] = array(
							$dependency_key . '!' => $dependency[ $dependency_key ]['values'],
						);
					}

					$formatted_options[ $group ]['fields'][ $option_key ]['condition'] = $option['condition'];
				}
			}

			// Repeater Options.
			if ( 'repeater' === $option['field_type'] ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['title_field'] = esc_html__( 'Item', 'qode-essential-addons' );

				foreach ( $option['items'] as $item_key => $item_value ) {
					$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['label']      = $item_value['title'];
					$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['field_type'] = $item_value['field_type'];

					if ( isset( $item_value['default_value'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['default'] = $item_value['default_value'];
					}

					if ( isset( $item_value['multiple'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['multiple'] = $item_value['multiple'];
					}

					if ( isset( $item_value['alpha'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['alpha'] = $item_value['alpha'];
					}

					if ( isset( $item_value['options'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['options'] = $item_value['options'];
					}

					if ( isset( $item_value['description'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['description'] = $item_value['description'];
					}
					if ( isset( $item_value['size_units'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['size_units'] = $item_value['size_units'];
					}

					if ( isset( $item_value['range'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['range'] = $item_value['range'];
					}

					if ( isset( $item_value['allowed_dimensions'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['allowed_dimensions'] = $item_value['allowed_dimensions'];
					}

					if ( isset( $item_value['placeholder'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['placeholder'] = $item_value['placeholder'];
					}

					if ( isset( $item_value['selector'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['selector'] = $item_value['selector'];
					}

					if ( isset( $item_value['selectors'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['selectors'] = $item_value['selectors'];
					}
					if ( isset( $item_value['selectors_dictionary'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['selectors_dictionary'] = $item_value['selectors_dictionary'];
					}
					if ( isset( $item_value['responsive'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['responsive_enabled'] = $item_value['responsive'];
					}
					if ( isset( $item_value['exclude_options'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['exclude'] = $item_value['exclude_options'];
					}
					if ( isset( $item_value['devices'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['devices'] = $item_value['devices'];
					}
					if ( isset( $item_value['media_types'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['media_types'] = $item_value['media_types'];
					}
					if ( isset( $item_value['types'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['types'] = $item_value['types'];
					}

					if ( isset( $item_value['dependency'] ) ) {
						if ( isset( $item_value['dependency']['show'] ) ) {
							$dependency     = $item_value['dependency']['show'];
							$dependency_key = key( $dependency );

							if ( '' === $dependency[ $dependency_key ]['values'] ) {
								$item_value['condition'] = array(
									$dependency_key => array( '' ),
								);
							} else {
								$item_value['condition'] = array(
									$dependency_key => $dependency[ $dependency_key ]['values'],
								);
							}

							$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['condition'] = $item_value['condition'];
						}

						if ( isset( $item_value['dependency']['hide'] ) ) {
							$dependency     = $item_value['dependency']['hide'];
							$dependency_key = key( $dependency );

							if ( '' === $dependency[ $dependency_key ]['values'] ) {
								$item_value['condition'] = array(
									$dependency_key . '!' => array( '' ),
								);
							} else {
								$item_value['condition'] = array(
									$dependency_key . '!' => $dependency[ $dependency_key ]['values'],
								);
							}

							$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['condition'] = $item_value['condition'];
						}
					}
				}
			}
		}

		return $formatted_options;
	}

	public function enqueue_scripts() {
		// Enqueue page builder global style.
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_style( 'qode-framework-elementor', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/shortcodes/translators/elementor/assets/css/elementor.css' );

		// Get shortcodes styles and register it during the front-end loading, scripts are enqueued on shortcodes loading.
		$shortcodes = qode_essential_addons_framework_get_framework_root()->get_shortcodes()->get_shortcodes();

		if ( ! empty( $shortcodes ) && is_array( $shortcodes ) ) {
			foreach ( $shortcodes as $key => $shortcode ) {
				$shortcode_styles = $shortcode->get_necessary_styles();

				if ( is_array( $shortcode_styles ) && count( $shortcode_styles ) > 0 ) {
					foreach ( $shortcode_styles as $style_key => $style ) {

						if ( ! $style['registered'] ) {
							// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
							wp_register_style( $style_key, $style['url'] );
						}
					}
				}
			}
		}
	}

	public function add_inline_style() {
		$shortcodes = qode_essential_addons_framework_get_framework_root()->get_shortcodes()->get_shortcodes();
		$style      = apply_filters( 'qode_essential_addons_filter_framework_add_elementor_inline_style', $style = '' );

		if ( ! empty( $shortcodes ) && is_array( $shortcodes ) ) {
			ksort( $shortcodes );

			foreach ( $shortcodes as $key => $shortcode ) {
				$shortcode_path = $shortcode->get_shortcode_path();

				if ( isset( $shortcode_path ) && ! empty( $shortcode_path ) ) {
					$icon      = $shortcode->get_is_child_shortcode() ? 'dashboard_child_icon' : 'dashboard_icon';
					$icon_path = $shortcode_path . '/assets/img/' . esc_attr( $icon ) . '.png';

					$style .= '.qodef-custom-elementor-icon.' . str_replace( '_', '-', $key ) . '{
						background-image: url("' . $icon_path . '") !important;
					}';
				}
			}
		}

		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'qode-framework-elementor', $style );
		}
	}

	public function add_elementor_widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'qode',
			array(
				'title' => esc_html__( 'Qode', 'qode-essential-addons' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	public function format_params( $params, $object ) {
		$image_params = $object->get_options_key_by_type( 'image' );

		if ( is_array( $image_params ) && count( $image_params ) > 0 ) {
			foreach ( $image_params as $image_param ) {
				if ( ! empty( $params[ $image_param ] ) ) {
					$option = $object->get_option( $image_param );

					if ( isset( $option['multiple'] ) && 'yes' === $option['multiple'] ) {
						$gallery_array = array();

						foreach ( $params[ $image_param ] as $gallery_item_key => $gallery_item ) {
							$gallery_array[] = $gallery_item['id'];
						}

						$params[ $image_param ] = implode( ',', $gallery_array );
					} else {
						$params[ $image_param ] = $params[ $image_param ]['id'];
					}
				}
			}
		}

		$repeater_params = $object->get_options_key_by_type( 'repeater' );

		if ( is_array( $repeater_params ) && count( $repeater_params ) > 0 ) {
			foreach ( $repeater_params as $repeater_param ) {

				if ( ! empty( $params[ $repeater_param ] ) ) {
					$option = $object->get_option( $repeater_param );

					foreach ( $option['items'] as $item_key => $item ) {

						if ( 'image' == $item['field_type'] ) {

							if ( ! isset( $item['multiple'] ) || ( isset( $item['multiple'] ) && 'yes' !== $item['multiple'] ) ) {
								foreach ( $params[ $repeater_param ] as $repeater_item_key => $repeater_item ) {
									$params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ] = $params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ]['id'];
								}
							} else {
								foreach ( $params[ $repeater_param ] as $repeater_item_key => $repeater_item ) {
									$gallery_repeater_array = array();

									foreach ( $params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ] as $gallery_repeater_item_key => $gallery_repeater_item ) {
										$gallery_repeater_array[] = $gallery_repeater_item['id'];
									}

									$params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ] = implode( ',', $gallery_repeater_array );
								}
							}
						}
					}
				}

				$params[ $repeater_param ] = rawurlencode( wp_json_encode( $params[ $repeater_param ] ) );
			}
		}

		if ( ! empty( $params['elements_of_child_widget'] ) ) {
			foreach ( $object->get_child_elements() as $child ) {
				$params['content'] = '';

				foreach ( $params['elements_of_child_widget'] as $child_elements ) {
					$params['content'] .= '[';
					$params['content'] .= $child;
					$params['content'] .= ' ';

					foreach ( $child_elements as $child_element_key => $child_element ) {
						if ( 'content' != $child_element_key ) {
							$params['content'] .= $child_element_key . '="' . $child_element . '" ';
						}
					}

					if ( isset( $child_elements['content'] ) ) {
						$params['content'] .= ']' . $child_elements['content'];
					}

					$params['content'] .= '[/';
					$params['content'] .= $child;
					$params['content'] .= ']';
				}
			}
		}

		return $params;
	}

	public function convert_options_types_to_elementor_types( $option ) {
		$type = $option['field_type'];

		switch ( $type ) :
			case 'text':
				$elementor_type = \Elementor\Controls_Manager::TEXT;
				break;
			case 'link':
				$elementor_type = \Elementor\Controls_Manager::URL;
				break;
			case 'textarea':
			case 'textarea_html':
				$elementor_type = \Elementor\Controls_Manager::TEXTAREA;
				break;
			case 'html':
				$elementor_type = \Elementor\Controls_Manager::WYSIWYG;
				break;
			case 'code':
				$elementor_type = \Elementor\Controls_Manager::CODE;
				break;
			case 'select':
				$elementor_type = \Elementor\Controls_Manager::SELECT;
				break;
			case 'choose':
				$elementor_type = \Elementor\Controls_Manager::CHOOSE;
				break;
			case 'checkbox':
				$elementor_type = \Elementor\Controls_Manager::SWITCHER;
				break;
			case 'color':
				$elementor_type = \Elementor\Controls_Manager::COLOR;
				break;
			case 'hidden':
				$elementor_type = \Elementor\Controls_Manager::HIDDEN;
				break;
			case 'image':
				if ( isset( $option['multiple'] ) && 'yes' === $option['multiple'] ) {
					$elementor_type = \Elementor\Controls_Manager::GALLERY;
				} else {
					$elementor_type = \Elementor\Controls_Manager::MEDIA;
				}
				break;
			case 'date':
				$elementor_type = \Elementor\Controls_Manager::DATE_TIME;
				break;
			case 'slider':
				$elementor_type = \Elementor\Controls_Manager::SLIDER;
				break;
			case 'dimensions':
				$elementor_type = \Elementor\Controls_Manager::DIMENSIONS;
				break;
			case 'repeater':
				$elementor_type = \Elementor\Controls_Manager::REPEATER;
				break;
			case 'divider':
				$elementor_type = \Elementor\Controls_Manager::DIVIDER;
				break;
			case 'number':
				$elementor_type = \Elementor\Controls_Manager::NUMBER;
				break;
			case 'select2':
				$elementor_type = \Elementor\Controls_Manager::SELECT2;
				break;
			case 'typography':
				$elementor_type = \Elementor\Group_Control_Typography::get_type();
				break;
			case 'fonts':
				$elementor_type = \Elementor\Controls_Manager::FONT;
				break;
			case 'text_shadow':
				$elementor_type = \Elementor\Group_Control_Text_Shadow::get_type();
				break;
			case 'box_shadow':
				$elementor_type = \Elementor\Group_Control_Box_Shadow::get_type();
				break;
			case 'border':
				$elementor_type = \Elementor\Group_Control_Border::get_type();
				break;
			case 'background':
				$elementor_type = \Elementor\Group_Control_Background::get_type();
				break;
			case 'image_size':
				$elementor_type = \Elementor\Group_Control_Image_Size::get_type();
				break;
			default:
				$elementor_type = \Elementor\Controls_Manager::TEXT;
				break;
		endswitch;

		return $elementor_type;
	}

	public function create_controls( $elementor_object, $shortcode_object ) {
		$controls = $this->generate_option_params( $shortcode_object );

		foreach ( $controls as $control_key => $control ) {
			$tab = \Elementor\Controls_Manager::TAB_CONTENT;

			// If options group contain Style word put that options inside Elementor Style tab.
			if ( strpos( $control_key, 'style' ) !== false ) {
				$tab = \Elementor\Controls_Manager::TAB_STYLE;
			}

			$elementor_object->start_controls_section(
				$control_key,
				array(
					'label' => ucwords( str_replace( array( '-elementor', '-' ), array( '', ' ' ), $control_key ) ),
					'tab'   => $tab,
				)
			);

			foreach ( $control['fields'] as $field_key => $field ) {
				if ( isset( $field['field_type'] ) && 'repeater' == $field['field_type'] ) {
					$repeater = new \Elementor\Repeater();

					foreach ( $field['items'] as $item_key => $item ) {
						$item['type'] = $this->convert_options_types_to_elementor_types( $item );
						if ( isset( $item['field_type'] ) && in_array( $item['field_type'], qode_essential_addons_framework_elementor_get_group_types(), true ) ) {
							$repeater->add_group_control(
								$item['type'],
								array_merge(
									array(
										'name' => $item_key,
									),
									$item
								)
							);
						} elseif ( isset( $item['responsive_enabled'] ) && true === $item['responsive_enabled'] ) {
							$repeater->add_responsive_control(
								$item_key,
								$item
							);
						} else {
							$repeater->add_control(
								$item_key,
								$item
							);
						}
					}

					$field['fields'] = $repeater->get_controls();
					unset( $field['items'] );
				}

				$field['type'] = $this->convert_options_types_to_elementor_types( $field );

				if ( isset( $field['field_type'] ) && in_array( $field['field_type'], qode_essential_addons_framework_elementor_get_group_types(), true ) ) {
					$elementor_object->add_group_control(
						$field['type'],
						array_merge(
							array(
								'name' => $field_key,
							),
							$field
						)
					);
				} elseif ( isset( $field['responsive_enabled'] ) && true === $field['responsive_enabled'] ) {
					$elementor_object->add_responsive_control(
						$field_key,
						$field
					);
				} else {
					$elementor_object->add_control(
						$field_key,
						$field
					);
				}
			}

			$elementor_object->end_controls_section();
		}

		// Add predefined developer tab content for each shortcode element.
		$elementor_object->start_controls_section(
			'developer_tools',
			array(
				'label' => esc_html__( 'Developer Tools', 'qode-essential-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$elementor_object->add_control(
			'shortcode_snippet',
			array(
				'label'   => esc_html__( 'Show Shortcode Snippet', 'qode-essential-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'no',
				'options' => array(
					'no'  => esc_html__( 'No', 'qode-essential-addons' ),
					'yes' => esc_html__( 'Yes', 'qode-essential-addons' ),
				),
			)
		);

		$elementor_object->end_controls_section();
	}

	private function get_shortcode_snippet( $shortcode_object, $params ) {
		$atts = array();

		if ( empty( $shortcode_object ) || ! is_object( $shortcode_object ) ) {
			return '';
		}

		if ( ! empty( $params ) ) {
			foreach ( $params as $key => $value ) {
				if ( is_array( $value ) || 'shortcode_snippet' === $key ) {
					continue;
				}

				$atts[] = $key . '="' . esc_attr( $value ) . '"';
			}
		}

		return sprintf(
			'<textarea rows="3" readonly>[%s %s]</textarea>',
			$shortcode_object->get_base(),
			implode( ' ', $atts )
		);
	}

	public function create_render( $shortcode_object, $params ) {
		$params = $this->format_params( $params, $shortcode_object );

		if ( isset( $params['shortcode_snippet'] ) && 'yes' === $params['shortcode_snippet'] ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $this->get_shortcode_snippet( $shortcode_object, array_filter( $params ) );
		} else {

			// Handle nested shortcodes.
			if ( isset( $params['content'] ) ) {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $shortcode_object->render( $params, $params['content'] );
			} else {
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $shortcode_object->render( $params );
			}
		}
	}

	public function set_scripts( $shortcode ) {
		$shortcode_deps = array();

		if ( is_array( $shortcode->get_scripts() ) && count( $shortcode->get_scripts() ) > 0 ) {
			foreach ( $shortcode->get_scripts() as $handle_key => $handle ) {
				$shortcode_deps[] = $handle_key;
			}
		}

		return $shortcode_deps;
	}

	public function set_necessary_styles( $shortcode ) {
		$shortcode_deps = array();

		if ( is_array( $shortcode->get_necessary_styles() ) && count( $shortcode->get_necessary_styles() ) > 0 ) {
			foreach ( $shortcode->get_necessary_styles() as $handle_key => $handle ) {
				$shortcode_deps[] = $handle_key;
			}
		}

		return $shortcode_deps;
	}
}

if ( ! function_exists( 'qode_essential_addons_framework_get_elementor_translator' ) ) {
	/**
	 * Function that return page builder module instance
	 */
	function qode_essential_addons_framework_get_elementor_translator() {
		if ( qode_essential_addons_framework_is_installed( 'elementor' ) ) {
			return QodeEssentialAddons_Framework_Elementor_Translator::get_instance();
		}
	}
}

if ( ! function_exists( 'qode_essential_addons_framework_init_elementor_translator' ) ) {
	/**
	 * Function that initialize page builder module
	 */
	function qode_essential_addons_framework_init_elementor_translator() {
		qode_essential_addons_framework_get_elementor_translator();
	}

	add_action( 'init', 'qode_essential_addons_framework_init_elementor_translator', 1 );
}

if ( ! function_exists( 'qode_essential_addons_framework_elementor_get_group_types' ) ) {
	function qode_essential_addons_framework_elementor_get_group_types() {
		$group_types = array(
			'typography',
			'text_shadow',
			'box_shadow',
			'border',
			'background',
			'image_size',
		);

		return $group_types;
	}
}

if ( ! function_exists( 'qode_essential_addons_framework_elementor_get_tab_controls_types' ) ) {
	function qode_essential_addons_framework_elementor_get_tab_controls_types() {
		$tabs_types = array(
			'start_controls_tabs',
			'start_controls_tab',
			'end_controls_tab',
			'end_controls_tabs',
		);

		return $tabs_types;
	}
}
