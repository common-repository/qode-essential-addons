<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Top_Area {
	private static $instance;
	private $is_top_area_enabled;
	private $is_top_area_transparent;
	private $top_area_height;
	private $is_header_transparent;

	public function __construct() {
		// after header.
		add_action( 'wp', array( $this, 'set_variables' ), 11 );

		// @WPThemeHookList.
		add_action( 'the_two_action_before_page_header', array( $this, 'load_template' ) );
		add_action( 'the_q_action_before_page_header', array( $this, 'load_template' ) );
		add_action( 'qi_action_before_page_header', array( $this, 'load_template' ) );
		add_action( 'qi_gutenberg_action_before_page_header', array( $this, 'load_template' ) );

		add_filter( 'qode_essential_addons_filter_localize_main_js', array( $this, 'set_global_javascript_variables' ) );
		add_filter( 'qode_essential_addons_filter_content_margin', array( $this, 'get_content_margin' ) );
		add_filter( 'qode_essential_addons_filter_title_padding', array( $this, 'get_title_padding' ) );
		add_filter( 'qode_essential_addons_filter_add_inline_style', array( $this, 'set_inline_top_area_styles' ) );
		add_filter( 'qode_essential_addons_filter_top_area_inner_class', array( $this, 'set_grid_class' ) );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function is_top_area_enabled() {
		$top_area_enabled = 'yes' === qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header' );

		if ( is_404() ) {
			$top_area_enabled = false;
		}

		$this->is_top_area_enabled = $top_area_enabled;
	}

	public function set_top_area_height() {
		if ( $this->is_top_area_enabled ) {
			$height         = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_height' );
			$top_bar_height = ! empty( $height ) ? $height : 40;

			$this->top_area_height = intval( $top_bar_height );
		} else {
			$this->top_area_height = 0;
		}
	}

	public function is_top_area_transparent() {
		$background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_background_color' );

		if ( ! empty( $background_color ) ) {
			// hex color is valid.
			if ( preg_match( '/^#[a-f0-9]{6}$/i', $background_color ) ) {
				$this->is_top_area_transparent = false;
			} else {
				$this->is_top_area_transparent = true;
			}
		} else {
			$this->is_top_area_transparent = false;
		}
	}

	public function set_variables() {
		$header_object = QodeEssentialAddons_Headers::get_instance()->get_header_object();

		$this->is_top_area_enabled();
		$this->is_top_area_transparent();
		$this->set_top_area_height();
		$this->is_header_transparent = ! empty( $header_object ) ? ( $header_object->get_header_transparency() || $header_object->content_behind_header() ) : false;
	}

	public function load_template() {
		$parameters = array(
			'show_header_area' => $this->is_top_area_enabled,
		);

		qode_essential_addons_template_part( 'header/top-area/', 'templates/top-area', '', $parameters );
	}

	public function set_global_javascript_variables( $global_vars ) {
		$global_vars['topAreaHeight'] = $this->top_area_height;

		return $global_vars;
	}

	public function content_behind_header() {
		$content_behind_header = qode_essential_addons_get_post_value_through_levels( 'qodef_content_behind_header' );

		return 'yes' === $content_behind_header;
	}

	public function get_content_margin( $margin ) {
		if ( ( $this->is_top_area_transparent && $this->is_header_transparent ) || $this->content_behind_header() ) {
			$margin += $this->top_area_height;
		}

		return $margin;
	}

	public function get_title_padding( $padding ) {
		if ( ( $this->is_top_area_transparent && $this->is_header_transparent ) || $this->content_behind_header() ) {
			$padding += $this->top_area_height;
		}

		return $padding;
	}

	public function set_inline_top_area_styles( $style ) {
		$styles = array();

		$background_color = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_background_color' );

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-top-area', $styles );
		}

		$inner_styles = array();

		$height       = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_height' );
		$side_padding = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_side_padding' );
		$border_color = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_border_color' );
		$border_width = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_border_width' );
		$border_style = qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_border_style' );

		if ( ! empty( $height ) ) {
			$inner_styles['height'] = intval( $height ) . 'px';
		}

		if ( '' !== $side_padding ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $side_padding ) ) {
				$inner_styles['padding-left']  = $side_padding;
				$inner_styles['padding-right'] = $side_padding;
			} else {
				$inner_styles['padding-left']  = intval( $side_padding ) . 'px';
				$inner_styles['padding-right'] = intval( $side_padding ) . 'px';
			}
		}

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

		if ( ! empty( $inner_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '#qodef-top-area-inner', $inner_styles );
		}

		return $style;
	}

	public function set_grid_class( $classes ) {
		$classes[] = 'yes' === qode_essential_addons_get_post_value_through_levels( 'qodef_top_area_header_in_grid' ) ? 'qodef-content-grid' : '';

		return $classes;
	}
}

QodeEssentialAddons_Top_Area::get_instance();
