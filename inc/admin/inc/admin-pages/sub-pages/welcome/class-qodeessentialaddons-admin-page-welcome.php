<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_welcome_sub_page_to_list' ) ) {
	/**
	 * Function that add additional sub page item into general page list
	 *
	 * @param array $sub_pages
	 *
	 * @return array
	 */
	function qode_essential_addons_add_welcome_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'QodeEssentialAddons_Admin_Page_Welcome';

		return $sub_pages;
	}

	add_filter( 'qode_essential_addons_filter_add_sub_page', 'qode_essential_addons_add_welcome_sub_page_to_list' );
}

if ( class_exists( 'QodeEssentialAddons_Admin_Sub_Pages' ) ) {
	class QodeEssentialAddons_Admin_Page_Welcome extends QodeEssentialAddons_Admin_Sub_Pages {

		public function __construct() {
			parent::__construct();
			
			add_action( 'qode_essential_addons_action_additional_scripts', array( $this, 'set_additional_scripts' ) );
		}

		public function add_sub_page() {
			$this->set_base( 'welcome' );
			$this->set_menu_name( QODE_ESSENTIAL_ADDONS_GENERAL_MENU_NAME );
			$this->set_title( esc_html__( 'Welcome Page', 'qode-essential-addons' ) );
			$this->set_atts( $this->set_atributtes() );
			$this->set_position( 1 );
		}
		
		public function set_atributtes() {
			$atts = array(
				'import_visible' => apply_filters( 'qode_essential_addons_filter_import_visible', false ),
				'header_slug'    => 'empty',
			);

			return $atts;
		}

		public function set_additional_scripts() {

			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( isset( $_GET['page'] ) && $_GET['page'] === $this->get_menu_name() ) {
				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
				wp_enqueue_script( 'mailchimp', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/assets/plugins/mailchimp/mailchimp.min.js', array( 'jquery' ), false, true );
			}
		}
	}
}
