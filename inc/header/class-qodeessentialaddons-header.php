<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

abstract class QodeEssentialAddons_Header {
	private $overriding_whole_header = false;
	private $layout;
	private $layout_slug = '';
	private $search_layout;
	protected $default_header_height;
	protected $header_height;

	public function __construct() {
		$this->set_header_height();

		add_filter( 'qode_essential_addons_action_before_main_css', array( $this, 'enqueue_assets' ) );
		add_filter( 'qode_essential_addons_action_before_main_css', array( $this, 'enqueue_additional_assets' ) );
		add_filter( 'qode_essential_addons_filter_localize_main_js', array( $this, 'set_global_javascript_variables' ) );
		add_filter( 'qode_essential_addons_filter_content_margin', array( $this, 'get_content_margin' ) );
		add_filter( 'qode_essential_addons_filter_title_padding', array( $this, 'get_title_padding' ) );
		add_filter( 'qode_essential_addons_filter_add_inline_style', array( $this, 'set_inline_header_styles' ) );

		// @WPThemeHookList.
		add_filter( 'the_two_filter_header_inner_class', array( $this, 'set_header_inner_classes' ) );
		add_filter( 'the_q_filter_header_inner_class', array( $this, 'set_header_inner_classes' ) );
		add_filter( 'qi_filter_header_inner_class', array( $this, 'set_header_inner_classes' ) );
		add_filter( 'qi_gutenberg_filter_header_inner_class', array( $this, 'set_header_inner_classes' ) );

		add_filter( 'qode_essential_addons_filter_header_inner_class', array( $this, 'set_header_inner_classes' ) );

		add_filter( 'qode_essential_addons_filter_nav_menu_header_selector', array( $this, 'set_nav_menu_header_selector' ) );
		add_filter( 'qode_essential_addons_filter_nav_menu_narrow_header_selector', array( $this, 'set_nav_menu_narrow_header_selector' ) );
	}

	public function get_layout() {
		return $this->layout;
	}

	public function set_layout( $layout ) {
		$this->layout = $layout;
	}

	public function get_layout_slug() {
		return $this->layout_slug;
	}

	public function set_layout_slug( $layout_slug ) {
		$this->layout_slug = $layout_slug;
	}

	public function get_search_layout() {
		return $this->search_layout;
	}

	public function set_search_layout( $search_layout ) {
		$this->search_layout = $search_layout;
	}

	public function is_whole_header_override() {
		return $this->overriding_whole_header;
	}

	public function set_overriding_whole_header( $overriding_whole_header ) {
		$this->overriding_whole_header = $overriding_whole_header;
	}

	/**
	 * swap dash with underscore
	 *
	 * header slug must be same as folder name, we're using dash as delimiter
	 * options and metaboxes, we're using underscore as delimiter
	 *
	 * @return mixed
	 */
	public function get_formatted_layout() {
		return str_replace( '-', '_', $this->get_layout() );
	}

	public function load_template( $parameters = array() ) {
		$parameters = apply_filters( 'qode_essential_addons_filter_header_template', $parameters );

		return qode_essential_addons_get_template_part( 'header/layouts/' . $this->get_layout(), 'templates/' . $this->get_layout(), $this->get_layout_slug(), $parameters );
	}

	public function enqueue_assets() {
		wp_enqueue_script( 'hoverIntent' );
	}

	public function enqueue_additional_assets() {
		return false;
	}

	public function set_global_javascript_variables( $global_vars ) {
		$global_vars['headerHeight'] = $this->header_height;

		return $global_vars;
	}

	public function get_header_transparency() {
		$background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_background_color' );

		if ( ! empty( $background_color ) ) {
			// hex color is valid.
			return ! preg_match( '/^#[a-f0-9]{6}$/i', $background_color );
		}

		return false;
	}

	public function content_behind_header() {
		$content_behind_header = qode_essential_addons_get_post_value_through_levels( 'qodef_content_behind_header' );

		return 'yes' === $content_behind_header;
	}

	public function get_content_margin( $margin ) {

		if ( $this->get_header_transparency() || $this->content_behind_header() ) {

			$header_layout = qode_essential_addons_get_post_value_through_levels( 'qodef_header_layout' );

			if ( 'boxed' === $header_layout ) {
				$boxed_header_margin = qode_essential_addons_get_post_value_through_levels( 'qodef_boxed_header_top_bottom_margin' );
				$add_margin          = ! empty( $boxed_header_margin ) ? intval( $boxed_header_margin * 2 ) : 100;

				$margin += $add_margin;
			}

			$margin += $this->header_height;
		}

		return $margin;
	}

	public function get_title_padding( $padding ) {

		if ( $this->get_header_transparency() || $this->content_behind_header() ) {
			$padding += $this->header_height;
		}

		return $padding;
	}

	public function set_header_height() {
		$header_height = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_height' );
		$header_height = ! empty( $header_height ) ? intval( $header_height ) : $this->default_header_height;

		$this->header_height = apply_filters( 'qode_essential_addons_filter_set_header_height', $header_height );
	}

	public function set_header_inner_classes( $class ) {
		// Check is content in grid.
		$class[] = 'yes' === qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_in_grid' ) ? 'qodef-content-grid' : '';

		return $class;
	}

	public function set_inline_header_styles( $style ) {
		$styles = array();

		$height           = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_height' );
		$background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_background_color' );

		if ( '' !== $height ) {
			$styles['height'] = intval( $height ) . 'px';
		}

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-header--' . $this->get_layout() . ' #qodef-page-header', $styles );
		}

		$inner_styles = array();

		$side_padding = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_side_padding' );
		$border_color = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_border_color' );
		$border_width = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_border_width' );
		$border_style = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_border_style' );

		if ( '' !== $side_padding ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $side_padding ) ) {
				$inner_styles['padding-left']  = $side_padding;
				$inner_styles['padding-right'] = $side_padding;
			} else {
				$inner_styles['padding-left']  = intval( $side_padding ) . 'px';
				$inner_styles['padding-right'] = intval( $side_padding ) . 'px';
			}
		}

		if ( strpos( $this->get_formatted_layout(), 'vertical' ) !== false ) {

			if ( ! empty( $border_color ) ) {
				$inner_styles['border-right-color'] = $border_color;

				if ( empty( $border_width ) ) {
					$inner_styles['border-right-width'] = '1px';
				}
			}

			if ( ! empty( $border_width ) ) {
				$inner_styles['border-right-width'] = intval( $border_width ) . 'px';
			}

			if ( ! empty( $border_style ) ) {
				$inner_styles['border-right-style'] = $border_style;
			}
		} elseif ( strpos( $this->get_formatted_layout(), 'boxed' ) !== false ) {

			if ( ! empty( $border_color ) ) {
				$inner_styles['border-color'] = $border_color;

				if ( empty( $border_width ) ) {
					$inner_styles['border-width'] = '1px';
				}
			}

			if ( ! empty( $border_width ) ) {
				$inner_styles['border-width'] = intval( $border_width ) . 'px';
			}

			if ( ! empty( $border_style ) ) {
				$inner_styles['border-style'] = $border_style;
			}
		} else {

			if ( ! empty( $border_color ) ) {
				$inner_styles['border-bottom-color'] = $border_color;

				if ( empty( $border_width ) ) {
					$inner_styles['border-bottom-width'] = '1px';
				}
			}

			if ( ! empty( $border_width ) ) {
				$inner_styles['border-bottom-width'] = intval( $border_width ) . 'px';
			}

			if ( ! empty( $border_style ) ) {
				$inner_styles['border-bottom-style'] = $border_style;
			}
		}

		if ( ! empty( $inner_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-header--' . $this->get_layout() . ' #qodef-page-header-inner', $inner_styles );
		}

		$widgets_styles      = array();
		$widgets_side_margin = qode_essential_addons_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_widgets_side_margin' );

		if ( '' !== $widgets_side_margin ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $widgets_side_margin ) ) {
				$widgets_styles['margin-left']  = $widgets_side_margin;
				$widgets_styles['margin-right'] = $widgets_side_margin;
			} else {
				$widgets_styles['margin-left']  = intval( $widgets_side_margin ) . 'px';
				$widgets_styles['margin-right'] = intval( $widgets_side_margin ) . 'px';
			}
		}

		if ( ! empty( $widgets_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-page-header .qodef-widget-holder .widget', $widgets_styles );
		}

		return $style;
	}

	public function set_nav_menu_header_selector( $selector ) {
		return $selector;
	}

	public function set_nav_menu_narrow_header_selector( $selector ) {
		return $selector;
	}
}
