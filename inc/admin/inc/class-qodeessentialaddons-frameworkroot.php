<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_FrameworkRoot {
	private static $instance;
	private $admin_options;
	private $meta_options;
	private $attachment_options;
	private $custom_post_types;
	private $shortcodes;
	private $image_sizes;
	private $widgets;
	private $custom_sidebars;

	private function __construct() {
		do_action( 'qode_essential_addons_action_framework_before_framework_root_init' );

		add_action( 'after_setup_theme', array( $this, 'load_admin_pages' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_options_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_cpt_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_shortcode_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_media_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_sidebar_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_widget_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_admin_notice_files' ), 5 );

		do_action( 'qode_essential_addons_action_framework_after_framework_root_init' );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function load_admin_pages() {
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/admin-pages/include.php';
	}

	public function load_options_files() {
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/common/include.php';
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/fonts/include.php';

		$this->admin_options   = array();
		$admin_options_classes = apply_filters( 'qode_essential_addons_filter_framework_register_admin_options', $this->admin_options );

		if ( ! empty( $admin_options_classes ) ) {
			foreach ( $admin_options_classes as $class ) {
				$this->set_admin_option( $class );
			}
		}

		$this->meta_options       = new QodeEssentialAddons_Framework_Options_Meta();
		$this->attachment_options = new QodeEssentialAddons_Framework_Options_Attachment();
	}

	public function load_cpt_files() {
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/post-types/include.php';

		$this->custom_post_types = new QodeEssentialAddons_Framework_Custom_Post_Types();
	}

	public function load_shortcode_files() {
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/shortcodes/include.php';

		$this->shortcodes = new QodeEssentialAddons_Framework_Shortcodes();
	}

	public function load_media_files() {
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/media/include.php';

		$this->image_sizes = new QodeEssentialAddons_Framework_Image_Sizes();
	}

	public function load_sidebar_files() {
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/sidebar/include.php';

		$this->custom_sidebars = new QodeEssentialAddons_Framework_Custom_Sidebar();
	}

	public function load_widget_files() {
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/widgets/include.php';

		$this->widgets = new QodeEssentialAddons_Framework_Widgets();
	}

	public function load_admin_notice_files() {
		require_once QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/admin-notice/include.php';
	}

	public function get_admin_options() {
		return $this->admin_options;
	}

	public function set_admin_option( QodeEssentialAddons_Framework_Options_Admin $options ) {
		$key                         = $options->get_options_name();
		$this->admin_options[ $key ] = $options;

		return $this->admin_options[ $key ];
	}

	public function get_admin_option( $key ) {
		if ( is_array( $key ) ) {
			$key = $key[0];
		}

		return $this->admin_options[ $key ];
	}

	public function get_meta_options() {
		return $this->meta_options;
	}

	public function get_attachment_options() {
		return $this->attachment_options;
	}

	public function get_custom_post_types() {
		return $this->custom_post_types;
	}

	public function get_custom_post_type_names() {
		$cpt_names = array();

		foreach ( (array) $this->custom_post_types as $items ) {
			foreach ( $items as $item => $value ) {
				$cpt_names[ $item ] = $item;
			}
		}

		return $cpt_names;
	}

	public function get_custom_post_type_taxonomies( $cpt_slug = '' ) {
		$taxonomies = array();

		if ( ! empty( $cpt_slug ) ) {
			$cpt_taxonomies = get_object_taxonomies( $cpt_slug );

			foreach ( $cpt_taxonomies as $cpt_taxonomy ) {
				$taxonomies[ $cpt_taxonomy ] = ucwords( str_replace( array( '-' ), array( ' ' ), $cpt_taxonomy ) );
			}
		} else {
			$cpt_names = qode_essential_addons_framework_get_framework_root()->get_custom_post_type_names();

			foreach ( $cpt_names as $cpt_name ) {
				$cpt_taxonomies = get_object_taxonomies( $cpt_name );

				foreach ( $cpt_taxonomies as $cpt_taxonomy ) {
					$taxonomies[ $cpt_taxonomy ] = ucwords( str_replace( array( '-' ), array( ' ' ), $cpt_taxonomy ) );
				}
			}
		}

		return $taxonomies;
	}

	public function get_shortcodes() {
		return $this->shortcodes;
	}

	public function get_widgets() {
		return $this->widgets;
	}

	public function get_custom_sidebars() {
		return $this->custom_sidebars;
	}

	public function add_options_page( $params ) {
		$page = false;
		if ( isset( $params['type'] ) && ! empty( $params['type'] ) ) {
			if ( 'admin' === $params['type'] ) {
				$scope = isset( $params['scope'] ) ? $params['scope'] : '';
				if ( ! empty( $scope ) ) {
					$page = new QodeEssentialAddons_Framework_Page_Admin( $params );
					$this->get_admin_option( $scope )->add_option_page( $page );
				}
			} elseif ( 'meta' === $params['type'] ) {
				$page = new QodeEssentialAddons_Framework_Page_Meta( $params );
				$this->get_meta_options()->add_option_page( $page );
			} elseif ( 'attachment' === $params['type'] ) {
				$page = new QodeEssentialAddons_Framework_Page_Attachment( $params );
				$this->get_attachment_options()->add_option_page( $page );
			}
		}

		return $page;
	}

	public function add_custom_post_type( QodeEssentialAddons_Framework_Custom_Post_Type $cpt ) {
		if ( $cpt ) {
			$this->get_custom_post_types()->add_custom_post_type( $cpt );
		}

		return $cpt;
	}

	public function add_shortcode( QodeEssentialAddons_Framework_Shortcode $shortcode ) {
		if ( $shortcode ) {
			$this->get_shortcodes()->add_shortcode( $shortcode );
		}

		return $shortcode;
	}

	public function add_widget( QodeEssentialAddons_Framework_Widget $widget ) {
		if ( $widget ) {
			$this->get_widgets()->add_widget( $widget );
		}

		return $widget;
	}
}

if ( ! function_exists( 'qode_essential_addons_framework_get_framework_root' ) ) {
	/**
	 * Main instance of Framework Root.
	 *
	 * Returns the main instance of QodeEssentialAddons_FrameworkRoot to prevent the need to use globals.
	 *
	 * @since  1.0
	 * @return QodeEssentialAddons_FrameworkRoot
	 */
	function qode_essential_addons_framework_get_framework_root() {
		return QodeEssentialAddons_FrameworkRoot::get_instance();
	}
}
