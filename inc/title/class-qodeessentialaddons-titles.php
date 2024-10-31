<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Titles {
	private static $instance;
	private $layout_meta;
	private $layouts;
	private $title_object;

	public function __construct() {

		// Includes title layouts.
		$this->include_layouts();

		// Set module variables.
		// wp hook is set because we need to wait global wp_query object to instance in order to get page id.
		add_action( 'wp', array( $this, 'set_variables' ) );

		// Overrides default title template of theme.
		add_action( 'wp', array( $this, 'render_template' ) );

		// Add title area classes.
		// @WPThemeHookList.
		add_filter( 'the_two_filter_page_title_classes', array( $this, 'add_page_title_classes' ) );
		add_filter( 'the_q_filter_page_title_classes', array( $this, 'add_page_title_classes' ) );
		add_filter( 'qi_filter_page_title_classes', array( $this, 'add_page_title_classes' ) );
		add_filter( 'qi_gutenberg_filter_page_title_classes', array( $this, 'add_page_title_classes' ) );

		// Add title area inline styles.
		add_filter( 'qode_essential_addons_filter_add_inline_style', array( $this, 'add_inline_styles' ) );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function get_layout_meta() {
		return $this->layout_meta;
	}

	public function set_layout_meta( $layout_meta ) {
		$this->layout_meta = $layout_meta;
	}

	public function get_layouts() {
		return $this->layouts;
	}

	public function set_layouts( $layouts ) {
		$this->layouts = $layouts;
	}

	public function get_title_object() {
		return $this->title_object;
	}

	public function set_title_object( $title_object ) {
		$this->title_object = $title_object;
	}

	public function include_layouts() {

		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/title/dashboard/*/*.php' ) as $admin ) {
			include_once $admin;
		}

		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/title/layouts/*/include.php' ) as $layout ) {
			include_once $layout;
		}
	}

	public function set_variables() {
		$layout_meta = qode_essential_addons_get_post_value_through_levels( 'qodef_title_layout' );
		$layouts     = apply_filters( 'qode_essential_addons_filter_register_title_layouts', $layouts = array() );
		$this->set_layout_meta( $layout_meta );
		$this->set_layouts( $layouts );

		if ( ! empty( $layout_meta ) && ! empty( $layouts ) ) {
			foreach ( $layouts as $key => $value ) {
				if ( $layout_meta === $key ) {
					$this->set_title_object( $value::get_instance() );
				}
			}
		}
	}

	public function render_template() {
		$title_object = $this->get_title_object();

		if ( ! empty( $title_object ) ) {
			$template_hook = '';

			// @WPThemeHookOverridingTemplates.
			if ( qode_essential_addons_framework_is_installed( 'the-two-theme' ) ) {
				$template_hook = $title_object->overriding_whole_title ? 'the_two_filter_title_template' : 'the_two_filter_title_content_template';
			}
			if ( qode_essential_addons_framework_is_installed( 'the-q-theme' ) ) {
				$template_hook = $title_object->overriding_whole_title ? 'the_q_filter_title_template' : 'the_q_filter_title_content_template';
			}
			if ( qode_essential_addons_framework_is_installed( 'qi-theme' ) ) {
				$template_hook = $title_object->overriding_whole_title ? 'qi_filter_title_template' : 'qi_filter_title_content_template';
			}
			if ( qode_essential_addons_framework_is_installed( 'qi-gutenberg-theme' ) ) {
				$template_hook = $title_object->overriding_whole_title ? 'qi_gutenberg_filter_title_template' : 'qi_gutenberg_filter_title_content_template';
			}

			if ( ! empty( $template_hook ) ) {
				add_filter( $template_hook, array( $this, 'load_template' ) );
			}
		}
	}

	public function load_template() {
		// template is properly escaped inside html file.
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $this->get_title_object()->load_template();
	}

	public function add_page_title_classes( $classes ) {
		$layout             = qode_essential_addons_get_post_value_through_levels( 'qodef_title_layout' );
		$text_alignment     = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_text_alignment' );
		$vertical_alignment = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_vertical_text_alignment' );
		$image_params       = qode_essential_addons_get_page_title_image_params();

		if ( ! empty( $layout ) ) {
			$classes[] = 'qodef-title--' . $layout;
		}

		if ( ! empty( $text_alignment ) ) {
			$classes[] = 'qodef-alignment--' . $text_alignment;
		}

		if ( ! empty( $vertical_alignment ) ) {
			$classes[] = 'qodef-vertical-alignment--' . $vertical_alignment;
		}

		if ( ! empty( $image_params['image'] ) ) {
			$classes[] = 'qodef--has-image';

			if ( ! empty( $image_params['image_behavior'] ) ) {
				$classes[] = 'qodef-image--' . $image_params['image_behavior'];
			}
		}

		return $classes;
	}

	public function add_inline_styles( $style ) {
		$styles = array();

		$height                   = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_height' );
		$height_mobile            = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_height_on_smaller_screens' );
		$title_padding            = apply_filters( 'qode_essential_addons_filter_title_padding', 0 );
		$title_padding_mobile     = apply_filters( 'qode_essential_addons_filter_title_padding_mobile', 0 );
		$side_padding             = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_side_padding' );
		$side_padding_mobile      = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_side_padding_mobile' );
		$title_vertical_alignment = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_vertical_text_alignment' );
		$background_color         = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_background_color' );
		$border_color             = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_border_color' );
		$border_width             = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_border_width' );
		$border_style             = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_border_style' );
		$image_params             = qode_essential_addons_get_page_title_image_params();

		if ( ! empty( $height ) ) {
			$styles['height'] = intval( $height ) . 'px';
		}

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $border_color ) ) {
			$styles['border-bottom-color'] = $border_color;

			if ( empty( $border_width ) ) {
				$styles['border-bottom-width'] = '1px';
			}
		}

		if ( ! empty( $border_width ) ) {
			$styles['border-bottom-width'] = intval( $border_width ) . 'px';
		}

		if ( ! empty( $border_style ) ) {
			$styles['border-bottom-style'] = $border_style;
		}

		if ( ! empty( $image_params['image'] ) && '' === $image_params['image_behavior'] ) {
			$styles['background-image'] = 'url(' . esc_url( qode_essential_addons_get_attachment_image_url( $image_params['image'], 'full' ) ) . ')';
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-page-title', $styles );
		}

		$content_styles = array();

		if ( 0 !== $title_padding && 'header-bottom' === $title_vertical_alignment ) {
			$content_styles['padding-top'] = intval( $title_padding ) . 'px';
		}

		if ( ! empty( $side_padding ) ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $side_padding ) ) {
				$content_styles['padding-left']  = $side_padding;
				$content_styles['padding-right'] = $side_padding;
			} else {
				$content_styles['padding-left']  = intval( $side_padding ) . 'px';
				$content_styles['padding-right'] = intval( $side_padding ) . 'px';
			}
		}

		if ( ! empty( $content_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-page-title .qodef-m-content, .qodef-page-title .qodef-m-content.qodef-content-full-width', $content_styles );
		}

		$title_styles = array();

		$title_color = qode_essential_addons_get_post_value_through_levels( 'qodef_page_title_color' );

		if ( ! empty( $title_color ) ) {
			$title_styles['color'] = $title_color;
		}

		if ( ! empty( $title_styles ) ) {
			$style .= qode_essential_addons_framework_dynamic_style( '.qodef-page-title .qodef-m-title', $title_styles );
		}

		// Responsive styles - start.
		$title_styles_mobile = array();

		if ( ! empty( $height_mobile ) ) {
			$title_styles_mobile['height'] = intval( $height_mobile ) . 'px';
		}

		if ( ! empty( $title_styles_mobile ) ) {
			$style .= qode_essential_addons_framework_dynamic_style_responsive( '.qodef-page-title', $title_styles_mobile, '', '1024' );
		}

		$content_styles_mobile = array();

		if ( 0 !== $title_padding_mobile ) {
			$content_styles_mobile['padding-top'] = intval( $title_padding_mobile ) . 'px';
		}

		if ( ! empty( $side_padding_mobile ) ) {
			if ( qode_essential_addons_framework_string_ends_with_space_units( $side_padding_mobile ) ) {
				$content_styles_mobile['padding-left']  = $side_padding_mobile;
				$content_styles_mobile['padding-right'] = $side_padding_mobile;
			} else {
				$content_styles_mobile['padding-left']  = intval( $side_padding_mobile ) . 'px';
				$content_styles_mobile['padding-right'] = intval( $side_padding_mobile ) . 'px';
			}
		}

		if ( ! empty( $content_styles_mobile ) ) {
			$style .= qode_essential_addons_framework_dynamic_style_responsive(
				'.qodef-page-title .qodef-m-content, .qodef-page-title .qodef-m-content.qodef-content-full-width',
				$content_styles_mobile,
				'',
				'1024'
			);
		}

		// Responsive styles - end.

		return $style;
	}
}

QodeEssentialAddons_Titles::get_instance();
