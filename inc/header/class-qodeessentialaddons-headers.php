<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Headers {
	private static $instance;
	private $layout_meta;
	private $layouts;
	private $header_object;

	public function __construct() {

		// Includes header layouts.
		$this->include_elements();

		// Set module variables.
		// wp hook is set because we need to wait global wp_query object to instance in order to get page id.
		add_action( 'wp', array( $this, 'set_variables' ) );

		// Overrides default header template of theme.
		add_action( 'wp', array( $this, 'render_template' ) );

		// Includes header scroll appearance template.
		add_action( 'the_two_action_after_page_header_inner', array( $this, 'scroll_appearance' ) );
		add_action( 'the_q_action_after_page_header_inner', array( $this, 'scroll_appearance' ) );
		add_action( 'qi_action_after_page_header_inner', array( $this, 'scroll_appearance' ) );
		add_action( 'qi_gutenberg_action_after_page_header_inner', array( $this, 'scroll_appearance' ) );

		// Add module body classes.
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );

		// Add widget areas.
		add_action( 'widgets_init', array( $this, 'add_header_widget_areas' ) );
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

	public function get_header_object() {
		return $this->header_object;
	}

	public function set_header_object( $header_object ) {
		$this->header_object = $header_object;
	}

	public function include_elements() {

		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/header/dashboard/*/*.php' ) as $admin ) {
			include_once $admin;
		}

		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/header/layouts/*/include.php' ) as $layout ) {
			include_once $layout;
		}

		foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/header/*/include.php' ) as $header_part ) {
			include_once $header_part;
		}
	}

	public function set_variables() {
		$layout_meta = qode_essential_addons_get_post_value_through_levels( 'qodef_header_layout' );
		$layouts     = apply_filters( 'qode_essential_addons_filter_register_header_layouts', $header_layouts_option = array() );

		$this->set_layout_meta( $layout_meta );
		$this->set_layouts( $layouts );

		if ( ! empty( $layout_meta ) && ! empty( $layouts ) ) {
			foreach ( $layouts as $key => $value ) {
				if ( $layout_meta === $key ) {

					$this->set_header_object( $value::get_instance() );
				}
			}
		}
	}

	public function load_template() {
		// template is properly escaped inside html file.
		$header_object = $this->get_header_object();

		if ( ! empty( $header_object ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $header_object->load_template();
		}
	}

	public function render_template() {
		$header_object = $this->get_header_object();

		if ( ! empty( $header_object ) ) {
			$template_hook = '';

			// @WPThemeHookOverridingTemplates.
			if ( qode_essential_addons_framework_is_installed( 'the-two-theme' ) ) {
				$template_hook = $header_object->is_whole_header_override() ? 'the_two_filter_header_template' : 'the_two_filter_header_content_template';
			}
			if ( qode_essential_addons_framework_is_installed( 'the-q-theme' ) ) {
				$template_hook = $header_object->is_whole_header_override() ? 'the_q_filter_header_template' : 'the_q_filter_header_content_template';
			}
			if ( qode_essential_addons_framework_is_installed( 'qi-theme' ) ) {
				$template_hook = $header_object->is_whole_header_override() ? 'qi_filter_header_template' : 'qi_filter_header_content_template';
			}
			if ( qode_essential_addons_framework_is_installed( 'qi-gutenberg-theme' ) ) {
				$template_hook = $header_object->is_whole_header_override() ? 'qi_gutenberg_filter_header_template' : 'qi_gutenberg_filter_header_content_template';
			}

			if ( ! empty( $template_hook ) ) {
				add_filter( $template_hook, array( $this, 'load_template' ), 11 );
			}
		}
	}

	public function add_body_classes( $classes ) {
		$header_object = $this->get_header_object();

		if ( ! empty( $header_object ) ) {
			$header_layout            = qode_essential_addons_get_post_value_through_levels( 'qodef_header_layout' );
			$header_scroll_appearance = qode_essential_addons_get_post_value_through_levels( 'qodef_header_scroll_appearance' );

			$classes[] = ! empty( $header_layout ) ? 'qodef-header--' . $header_layout : '';
			$classes[] = ! empty( $header_scroll_appearance ) ? 'qodef-header-appearance--' . $header_scroll_appearance : '';

			if ( ! empty( $header_object ) ) {
				$classes[] = $header_object->get_header_transparency() ? 'qodef-header--transparent' : '';
				$classes[] = $header_object->content_behind_header() ? 'qodef-content--behind-header' : '';
			}
		}

		return $classes;
	}

	public function scroll_appearance() {
		$header_object = $this->get_header_object();

		if ( ! empty( $header_object ) ) {
			$appearance_type = qode_essential_addons_get_post_value_through_levels( 'qodef_header_scroll_appearance' );

			$slug = '';

			if ( 'standard' === $header_object->get_layout() ) {
				$slug = qode_essential_addons_get_post_value_through_levels( 'qodef_standard_header_menu_position' );
			}

			if ( 'minimal' === $header_object->get_layout() ) {
				$slug = qode_essential_addons_get_post_value_through_levels( 'qodef_minimal_header_menu_position' );
			}

			if ( 'boxed' === $header_object->get_layout() ) {
				$slug = qode_essential_addons_get_post_value_through_levels( 'qodef_boxed_header_menu_position' );
			}

			if ( file_exists( QODE_ESSENTIAL_ADDONS_HEADER_LAYOUTS_PATH . '/' . $header_object->get_layout() . '/templates/' . $appearance_type . '.php' ) ) {
				$scroll_appearance_layout = 'layouts/' . $header_object->get_layout();
			} else {
				$scroll_appearance_layout = 'scroll-appearance/' . $appearance_type;
			}

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo apply_filters( 'qode_essential_addons_filter_scroll_appearance_template', qode_essential_addons_get_template_part( 'header/' . $scroll_appearance_layout, 'templates/' . $appearance_type, $slug, array() ), $header_object );
		}
	}

	public function add_header_widget_areas() {

		if ( qode_essential_addons_is_qode_theme_installed() ) {
			register_sidebar(
				array(
					'id'            => 'qodef-header-widget-area-one',
					'name'          => esc_html__( 'Header - Widget Area', 'qode-essential-addons' ),
					'description'   => esc_html__( 'Widgets added here will appear in header widget area', 'qode-essential-addons' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s qodef-header-widget-area-one" data-area="header-widget-one">',
					'after_widget'  => '</div>',
				)
			);

			// Hooks that allows you to add additional header widgets area.
			do_action( 'qode_essential_addons_action_additional_header_widgets_area' );
		}
	}
}

QodeEssentialAddons_Headers::get_instance();
