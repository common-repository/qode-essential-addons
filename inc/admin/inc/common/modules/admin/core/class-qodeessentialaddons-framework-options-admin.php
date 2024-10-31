<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Framework_Options_Admin extends QodeEssentialAddons_Framework_Options {
	private $menu_name;
	private $options_name;
	private $menu_label;
	private $icon_path;

	public function __construct( $menu_name = 'qode_essential_addons_framework_menu', $options_name = 'qode_essential_addons_framework_options', $params = array() ) {
		parent::__construct();

		$this->menu_name    = $menu_name;
		$this->options_name = $options_name;

		$this->menu_label = ! empty( $params['label'] ) ? $params['label'] : esc_html__( 'Qode Options', 'qode-essential-addons' );
		$this->icon_path  = ! empty( $params['icon_path'] ) ? $params['icon_path'] : QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/modules/admin/assets/img/admin-logo-icon.png';

		add_action( 'init', array( $this, 'init_options' ), 11 );

		add_action( 'admin_menu', array( $this, 'framework_menu' ) );

		// 999 is set to be at the last place in admin bar.
		add_action( 'admin_bar_menu', array( $this, 'framework_admin_bar_menu' ), 999 );

		add_action( 'wp_ajax_qode_essential_addons_action_framework_save_options_' . $this->get_options_name(), array( $this, 'save_options' ) );

		add_action( 'wp_ajax_qode_essential_addons_action_framework_reset_options_' . $this->get_options_name(), array( $this, 'reset_options' ) );

		// 5 is set to be same permission as Gutenberg plugin have.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_framework_options_scripts' ), 5 );

		add_filter( 'admin_body_class', array( $this, 'add_admin_body_classes' ) );
	}

	public function get_menu_name() {
		return $this->menu_name;
	}

	public function get_options_name() {
		return $this->options_name;
	}

	public function get_menu_label() {
		return $this->menu_label;
	}

	public function get_icon_path() {
		return $this->icon_path;
	}

	public function framework_menu() {

		do_action( 'qode_essential_addons_action_framework_before_options_map', $this->get_menu_name() );

		$child_elements = $this->get_child_elements();

		if ( ! empty( $child_elements ) ) {
			add_submenu_page(
				QODE_ESSENTIAL_ADDONS_GENERAL_MENU_NAME,
				$this->get_menu_label(),
				$this->get_menu_label(),
				'edit_theme_options',
				$this->get_menu_name(),
				array(
					$this,
					'render_options',
				),
				1000
			);
		}

		do_action( 'qode_essential_addons_action_framework_after_options_map', $this->get_menu_name() );
	}

	public function framework_admin_bar_menu( $wp_admin_bar ) {
		$menu_name = $this->get_menu_name();

		if ( current_user_can( 'edit_theme_options' ) && ! empty( $menu_name ) && ! is_admin() ) {
			$menu_id = esc_attr( str_replace( '_', '-', $menu_name ) . '-admin-bar-options' );

			$args = array(
				'id'    => $menu_id,
				'title' => sprintf( '<span class="ab-icon dashicons-before dashicons-admin-generic"></span> %s', esc_html( $this->get_menu_label() ) ),
				'href'  => esc_url( admin_url( 'admin.php?page=' . esc_attr( $menu_name ) ) ),
			);

			$wp_admin_bar->add_node( $args );
		}
	}

	public function init_options() {

		do_action( 'qode_essential_addons_action_framework_before_options_init_' . $this->get_options_name(), $this->get_options_name() );

		if ( ! get_option( $this->get_options_name() ) ) {
			add_option( $this->get_options_name(), $this->get_options() );
		}

		$this->populate_options();

		do_action( 'qode_essential_addons_action_framework_after_options_init_' . $this->get_options_name(), $this->get_options_name() );
	}

	public function populate_options() {

		do_action( 'qode_essential_addons_action_framework_before_options_populate', $this->get_options_name() );

		$db_options = get_option( $this->get_options_name() );

		if ( is_array( $db_options ) && ! empty( $db_options ) ) {
			$this->set_options( array_merge( $this->get_options(), get_option( $this->get_options_name() ) ) );
		}

		$this->register_options();

		do_action( 'qode_essential_addons_action_framework_after_options_populate', $this->get_options_name() );
	}

	public function register_options() {

		do_action( 'qode_essential_addons_action_framework_before_options_registered', $this->get_options_name() );

		register_setting( $this->get_menu_label(), $this->get_options_name() );

		do_action( 'qode_essential_addons_action_framework_after_options_registered', $this->get_options_name() );
	}

	public function save_options() {

		if ( current_user_can( 'edit_theme_options' ) ) {
			$_REQUEST = stripslashes_deep( $_REQUEST );

			unset( $_REQUEST['action'] );

			check_ajax_referer( 'qode_essential_addons_framework_ajax_save_nonce', 'qode_essential_addons_framework_ajax_save_nonce' );

			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			$options_name = $_REQUEST['options_name'];
			unset( $_REQUEST['options_name'] );

			if ( $options_name === $this->get_options_name() ) {

				do_action( 'qode_essential_addons_action_framework_before_framework_option_save', $this->get_options(), $_REQUEST );

				$this->set_options( array_merge( $this->get_options(), $_REQUEST ) );

				update_option( $this->get_options_name(), $this->get_options() );

				esc_html_e( 'Saved', 'qode-essential-addons' );

				do_action( 'qode_essential_addons_action_framework_after_framework_option_save' );

			} else {
				esc_html_e( 'Wrong options trigger', 'qode-essential-addons' );
			}

			die();
		}
	}

	public function reset_options() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			$_REQUEST = stripslashes_deep( $_REQUEST );

			unset( $_REQUEST['action'] );

			check_ajax_referer( 'qode_essential_addons_framework_ajax_save_nonce', 'qode_essential_addons_framework_ajax_save_nonce' );

			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			$options_name = $_REQUEST['options_name'];
			unset( $_REQUEST['options_name'] );

			if ( $options_name === $this->get_options_name() ) {

				delete_option( $this->get_options_name() );

				esc_html_e( 'Options reset to default', 'qode-essential-addons' );

				do_action( 'qode_essential_addons_action_framework_after_framework_option_reset' );

			} else {
				esc_html_e( 'Wrong options trigger', 'qode-essential-addons' );
			}

			die();
		}
	}

	public function render_options() {
		$params                 = array();
		$params['options']      = $this;
		$params['options_name'] = $this->get_options_name();

		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH, 'inc/common', 'modules/admin/templates/holder', '', $params );
	}

	public function render_navigation() {
		$params                 = array();
		$params['pages']        = $this->get_child_elements();
		$params['options_name'] = $this->get_options_name();
		$params['menu_label']   = $this->get_menu_label();
		$params['use_icons']    = false;

		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH, 'inc/common', 'modules/admin/templates/navigation', '', $params );
	}

	public function render_content() {
		$params                   = array();
		$pages                    = $this->get_child_elements();
		$params['pages']          = $pages;
		$params['options_name']   = $this->get_options_name();
		$params['banner_enabled'] = apply_filters( 'qode_essential_addons_filter_options_upgrade_banner', true );

		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH, 'inc/common', 'modules/admin/templates/content', '', $params );
	}

	public function enqueue_framework_options_scripts() {
		// check if page is options page.
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['page'] ) && strpos( sanitize_text_field( wp_unslash( $_GET['page'] ) ), $this->get_menu_name() ) !== false ) {
			$this->enqueue_dashboard_framework_scripts();
		}
	}

	public function add_admin_body_classes( $classes ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( isset( $_GET['page'] ) && strpos( sanitize_text_field( wp_unslash( $_GET['page'] ) ), $this->get_menu_name() ) !== false ) {
			$classes = $classes . ' qodef-framework-admin';
		}

		return $classes;
	}
}
