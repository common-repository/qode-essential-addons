<?php
/*
* Plugin Name: Qode Essential Addons
* Plugin URI: https://qodeinteractive.com
* Description: Qode Essential Addons enhances themes with various functionalities- Portfolio post type, Portfolio List, Blog List & Product List shortcodes and more.
* Author: Qode Interactive
* Author URI: https://qodeinteractive.com/
* Version: 1.6.4
* Text Domain: qode-essential-addons
*/

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! class_exists( 'QodeEssentialAddons' ) ) {
	class QodeEssentialAddons {
		private static $instance;

		public function __construct() {
			$this->before_init();

			add_action( 'qode_essential_addons_action_framework_load_dependent_plugins', array( $this, 'init' ) );
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function before_init() {
			require_once __DIR__ . '/constants.php';

			require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/class-qodeessentialaddons-framework.php';
		}

		public function init() {
			$this->require_core();

			add_filter( 'qode_essential_addons_filter_framework_register_admin_options', array( $this, 'create_core_options' ) );

			add_action( 'qode_essential_addons_action_framework_before_options_init_' . QODE_ESSENTIAL_ADDONS_OPTIONS_NAME, array( $this, 'init_core_options' ) );

			add_action( 'qode_essential_addons_action_framework_populate_meta_box', array( $this, 'init_core_meta_boxes' ) );

			// Include plugin assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_style' ), 15 );

			// Include plugin Gutenberg assets.
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_gutenberg_assets' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'add_gutenberg_inline_style' ), 15 );

			// Make plugin available for translation.
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ), 15 );

			// Add plugin's body classes.
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );

			// Hook to include additional modules when plugin loaded.
			do_action( 'qode_essential_addons_action_plugin_loaded' );
		}

		public function require_core() {
			require_once QODE_ESSENTIAL_ADDONS_ABS_PATH . '/helpers/helper.php';

			// Hook to include additional files before modules inclusion.
			do_action( 'qode_essential_addons_action_before_include_modules' );

			foreach ( glob( QODE_ESSENTIAL_ADDONS_INC_PATH . '/*/include.php' ) as $module ) {
				include_once $module;
			}

			// Hook to include additional files after modules inclusion.
			do_action( 'qode_essential_addons_action_after_include_modules' );
		}

		public function create_core_options( $options ) {

			if ( qode_essential_addons_is_qode_theme_installed() ) {
				$qode_essential_addons_options_admin = new QodeEssentialAddons_Framework_Options_Admin(
					QODE_ESSENTIAL_ADDONS_MENU_NAME,
					QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
					array(
						'label' => esc_html__( 'Options', 'qode-essential-addons' ),
					)
				);
				$options[]                           = $qode_essential_addons_options_admin;
			}

			return $options;
		}

		public function init_core_options() {

			if ( qode_essential_addons_is_qode_theme_installed() ) {
				$qode_essential_addons_framework = qode_essential_addons_framework_get_framework_root();

				if ( ! empty( $qode_essential_addons_framework ) ) {
					$page = $qode_essential_addons_framework->add_options_page(
						array(
							'scope'       => QODE_ESSENTIAL_ADDONS_OPTIONS_NAME,
							'type'        => 'admin',
							'slug'        => 'general',
							'title'       => esc_html__( 'General', 'qode-essential-addons' ),
							'description' => esc_html__( 'Global Theme Options', 'qode-essential-addons' ),
							'icon'        => 'fa fa-cog',
						)
					);

					// Hook to include additional options after default options.
					do_action( 'qode_essential_addons_action_default_options_init', $page );
				}
			}
		}

		public function init_core_meta_boxes() {

			if ( qode_essential_addons_is_qode_theme_installed() ) {
				do_action( 'qode_essential_addons_action_default_meta_boxes_init' );
			}
		}

		public function enqueue_assets() {
			// CSS and JS dependency variables.
			$style_dependency_array  = apply_filters( 'qode_essential_addons_filter_style_dependencies', array() );
			$script_dependency_array = apply_filters( 'qode_essential_addons_filter_script_dependencies', array( 'jquery' ) );

			// Enqueue plugin's 3rd party styles.
			wp_enqueue_style( 'swiper', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/plugins/swiper/swiper.min.css', array(), '5.4.5' );

			// Hook to include additional scripts before plugin's main style.
			do_action( 'qode_essential_addons_action_before_main_css' );

			// Enqueue plugin's main style.
			wp_enqueue_style( 'qode-essential-addons-style', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/css/main.min.css', $style_dependency_array, QODE_ESSENTIAL_ADDONS_VERSION );
			if ( ! qode_essential_addons_is_qode_theme_installed() ) {
				wp_enqueue_style( 'qode-essential-addons-theme-style', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/css/grid.min.css', $style_dependency_array, QODE_ESSENTIAL_ADDONS_VERSION );
			}

			// Hook to include additional scripts after plugin's main style.
			do_action( 'qode_essential_addons_action_after_main_css' );

			// Enqueue plugin's 3rd party scripts.
			wp_enqueue_script( 'jquery-ui-core' );
			// phpcs:ignore WordPress.WP.EnqueuedResourceParameters
			wp_enqueue_script( 'modernizr', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/plugins/modernizr/modernizr.js', array( 'jquery' ), false, true );
			// phpcs:ignore WordPress.WP.EnqueuedResourceParameters
			wp_enqueue_script( 'fslightbox', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/plugins/fslightbox/fslightbox.min.js', '', false, true );
			wp_enqueue_script( 'swiper', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/plugins/swiper/swiper.min.js', array( 'jquery' ), '5.4.5', true );

			// Hook to include additional scripts before plugin's main script.
			do_action( 'qode_essential_addons_action_before_main_js' );

			// Enqueue plugin's main script.
			wp_enqueue_script( 'qode-essential-addons-script', QODE_ESSENTIAL_ADDONS_URL_PATH . 'assets/js/main.min.js', $script_dependency_array, QODE_ESSENTIAL_ADDONS_VERSION, true );

			// Localize plugin's main script.
			$global = apply_filters(
				'qode_essential_addons_filter_localize_main_js',
				array(
					'adminBarHeight' => is_admin_bar_showing() ? 32 : 0,
					'iconArrowLeft'  => qode_essential_addons_get_svg_icon( 'slider-arrow-left' ),
					'iconArrowRight' => qode_essential_addons_get_svg_icon( 'slider-arrow-right' ),
					'iconClose'      => qode_essential_addons_get_svg_icon( 'close' ),
				)
			);

			wp_localize_script(
				'qode-essential-addons-script',
				'qodefGlobal',
				array(
					'vars' => $global,
				)
			);

			// Hook to include additional scripts after plugin's main script.
			do_action( 'qode_essential_addons_action_after_main_js' );
		}

		public function add_inline_style() {
			$style = apply_filters( 'qode_essential_addons_filter_add_inline_style', '' );

			if ( ! empty( $style ) ) {
				wp_add_inline_style( apply_filters( 'qode_essential_addons_filter_inline_style_handle', 'qode-essential-addons-style' ), $style );
			}
		}

		public function enqueue_gutenberg_assets() {
			// Hook to include additional scripts before plugin's main Gutenberg script.
			do_action( 'qode_essential_addons_action_before_main_gutenberg_js' );

			// Enqueue plugin's main script.
			// phpcs:ignore WordPress.WP.EnqueuedResourceParameters
			wp_enqueue_script( 'qode-essential-addons-gutenberg-editor', QODE_ESSENTIAL_ADDONS_INC_URL_PATH . '/gutenberg/assets/js/gutenberg-editor.js', array( 'wp-data' ), false, true );

			// Hook to include additional scripts after plugin's main Gutenberg script.
			do_action( 'qode_essential_addons_action_after_main_gutenberg_js' );
		}

		public function add_gutenberg_inline_style() {
			$style = apply_filters( 'qode_essential_addons_filter_add_gutenberg_inline_style', '' );

			if ( ! empty( $style ) ) {
				wp_add_inline_style( apply_filters( 'qode_essential_addons_filter_gutenberg_inline_style_handle', 'qi-gutenberg-blocks-style' ), $style );
			}
		}

		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'qode-essential-addons', false, QODE_ESSENTIAL_ADDONS_REL_PATH . '/languages' );
		}

		public function add_body_classes( $classes ) {
			$classes[] = 'qode-essential-addons-' . QODE_ESSENTIAL_ADDONS_VERSION;

			return $classes;
		}
	}

	QodeEssentialAddons::get_instance();
}

if ( ! function_exists( 'qode_essential_addons_activation_trigger' ) ) {
	/**
	 * Function that trigger hooks on plugin activation
	 */
	function qode_essential_addons_activation_trigger() {

		// Hook to add additional code on plugin activation.
		do_action( 'qode_essential_addons_action_on_activation' );
	}

	register_activation_hook( __FILE__, 'qode_essential_addons_activation_trigger' );
}

if ( ! function_exists( 'qode_essential_addons_deactivation_trigger' ) ) {
	/**
	 * Function that trigger hooks on plugin deactivation
	 */
	function qode_essential_addons_deactivation_trigger() {

		// Hook to add additional code on plugin deactivation.
		do_action( 'qode_essential_addons_action_on_deactivation' );
	}

	register_deactivation_hook( __FILE__, 'qode_essential_addons_deactivation_trigger' );
}
