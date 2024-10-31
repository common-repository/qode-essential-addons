<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_add_import_sub_page_to_list' ) ) {
	/**
	 * Function that add additional sub page item into general page list
	 *
	 * @param array $sub_pages
	 *
	 * @return array
	 */
	function qode_essential_addons_add_import_sub_page_to_list( $sub_pages ) {
		$demos = qode_essential_addons_demos_list();

		if ( ! empty( $demos ) ) {
			$sub_pages[] = 'QodeEssentialAddons_Admin_Page_Import';
		}

		return $sub_pages;
	}

	add_filter( 'qode_essential_addons_filter_add_sub_page', 'qode_essential_addons_add_import_sub_page_to_list' );
}

if ( class_exists( 'QodeEssentialAddons_Admin_Sub_Pages' ) ) {
	class QodeEssentialAddons_Admin_Page_Import extends QodeEssentialAddons_Admin_Sub_Pages {


		public function __construct() {

			parent::__construct();

			add_action( 'qode_essential_addons_action_additional_scripts', array( $this, 'set_additional_scripts' ) );
			add_action( 'wp_ajax_open_demo_single', array( $this, 'open_demo_single' ) );
			add_action( 'wp_ajax_qode_essential_addons_reload_demo_import', array( $this, 'reload_demo_import' ) );
			add_filter( 'admin_body_class', array( $this, 'add_admin_body_classes' ) );
		}

		public function add_sub_page() {
			$this->set_base( 'import' );
			$this->set_menu_name( 'qode_essential_addons_import_menu' );
			$this->set_title( esc_html__( 'Import', 'qode-essential-addons' ) );
			$this->set_position( 10 );
		}

		public function render() {
			$args                = $this->get_atts();
			$args['this_object'] = $this;
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$args['holder_classes'] = isset( $_GET['demo-id'] ) ? 'qodef-demo-import-single-opened' : '';

			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/holder', '', $args );
		}

		public function generate_import_list_params() {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$demo_id = isset( $_GET['demo-id'] ) ? sanitize_text_field( wp_unslash( $_GET['demo-id'] ) ) : '';

			$params                    = array();
			$params['import_title']    = esc_html__( 'Find a Qi demo you wish to import', 'qode-essential-addons' );
			$params['demos']           = qode_essential_addons_demos_list();
			$params['categories']      = qode_essential_addons_demos_list( 'categories' );
			$params['colors']          = qode_essential_addons_demos_list( 'colors' );
			$params['filters']         = $this->filter_list();
			$params['this_object']     = $this;
			$params['page_name']       = $this->get_menu_name();
			$params['enabled_premium'] = apply_filters( 'qode_essential_addons_filter_enabled_premium_plugin', false );
			$params['single_demo']     = ! empty( $demo_id ) ? $params['demos'][ $demo_id ] : '';
			$params['single_demo_id']  = $demo_id ?? '';
			$params['content_files']   = ! empty( $demo_id ) ? $this->count_files( $params['demos'][ $demo_id ] ) : '';

			return $params;
		}

		public function get_content() {
			$params = $this->generate_import_list_params();
			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/content', 'demos', $params );
		}

		public function set_additional_scripts() {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( isset( $_GET['page'] ) && sanitize_text_field( wp_unslash( $_GET['page'] ) ) === $this->get_menu_name() ) {
				wp_enqueue_style( 'swiper', QODE_ESSENTIAL_ADDONS_URL_PATH . '/assets/plugins/swiper/swiper.min.css', array(), '8.4.5' );
				wp_enqueue_script( 'isotope', QODE_ESSENTIAL_ADDONS_INC_URL_PATH . '/masonry/assets/js/plugins/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
				wp_enqueue_script( 'packery', QODE_ESSENTIAL_ADDONS_INC_URL_PATH . '/masonry/assets/js/plugins/packery-mode.pkgd.min.js', array( 'jquery' ), '2.0.1', true );
				wp_enqueue_script( 'swiper', QODE_ESSENTIAL_ADDONS_URL_PATH . '/assets/plugins/swiper/swiper.min.js', array( 'jquery' ), '8.4.5', true );
				wp_enqueue_script( 'easyautocomplete', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/assets/plugins/easyautocomplete/jquery.easy-autocomplete.min.js', array( 'jquery' ), '1.3.5', true );
				// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NoExplicitVersion
				wp_enqueue_script( 'qodef-qode-essential-addons-import', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/sub-pages/import/assets/js/import.js', array( 'jquery' ), false, true );
				wp_enqueue_style( 'select2', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/assets/plugins/select2/select2.min.css', array(), '4.0.13' );
				wp_enqueue_script( 'select2', QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/assets/plugins/select2/select2.full.min.js', array(), '4.0.13', true );

				wp_localize_script(
					'qodef-qode-essential-addons-import',
					'qodefAdminImport',
					array(
						'vars' => apply_filters( 'qode_essential_addons_filter_localize_import_js', array() ),
					)
				);
			}
		}

		public function add_admin_body_classes( $classes ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( isset( $_GET['page'] ) && strpos( sanitize_text_field( wp_unslash( $_GET['page'] ) ), $this->get_menu_name() ) !== false ) {
				$classes = $classes . ' qodef-framework-admin';
			}

			return $classes;
		}

		public function render_filter() {
			$params                = array();
			$params['this_object'] = $this;
			$params['filters']     = $this->filter_list();

			qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH, 'inc/import', 'templates/filter', '', $params );
		}

		public function filter_list() {
			$demos       = qode_essential_addons_demos_list();
			$filter_list = array();

			foreach ( $demos as $demo ) {

				if ( isset( $demo['demo_filters'] ) && is_array( $demo['demo_filters'] ) ) {

					foreach ( $demo['demo_filters'] as $filter ) {
						if ( ! in_array( $filter, $filter_list, true ) ) {
							$filter_list[] = $filter;
						}
					}
				}
			}

			return $filter_list;
		}

		public function open_demo_single() {
			if ( isset( $_POST ) && ! empty( $_POST ) && isset( $_POST['demoId'] ) && '' !== $_POST['demoId'] ) {
				check_ajax_referer( 'qode_essential_addons_demo_import_nonce', 'nonce' );
				$demo_id = sanitize_text_field( wp_unslash( $_POST['demoId'] ) );
				$args    = array(
					'demo_id' => $demo_id,
				);

				if ( '' !== $demo_id ) {
					$demos                 = qode_essential_addons_demos_list();
					$demo                  = $demos[ $demo_id ];
					$args['demo']          = $demo;
					$args['demo_key']      = $demo_id;
					$args['content_files'] = $this->count_files( $demos[ $demo_id ] );
					$html                  = qode_essential_addons_framework_get_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/content-single', '', $args );

					qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Demo Opened', 'qode-essential-addons' ), $html );
				}
			}

			wp_die();
		}

		public function count_files( $demo ) {
			$files         = array();
			$content_files = 0;
			$other_files   = 0;

			if ( isset( $demo['demo_file_url'] ) ) {
				// posts + terms from xml file.
				$content_files += 2;

				// attachments from xml file.
				$chunk_files    = QodeEssentialAddons_Framework_Import_General::get_instance()->get_chunk_number();
				$content_files += $chunk_files;
			}
			if ( isset( $demo['demo_widgets_file_url'] ) ) {
				$other_files++;
			}
			if ( isset( $demo['demo_settings_page_file_url'] ) ) {
				$other_files++;
			}
			if ( isset( $demo['demo_menu_settings_file_url'] ) ) {
				$other_files++;
			}
			if ( isset( $demo['demo_import_options'] ) ) {
				$other_files++;
			}

			$files['content_files'] = $content_files;
			$files['other_files']   = $other_files;

			return $files;
		}

		public function reload_demo_import() {
			check_ajax_referer( 'qode_essential_addons_reload_demo_import', 'nonce' );

			$transients = apply_filters( 'qode_essential_addons_filter_demos_transients', array( 'qode_essential_addons_demos_list_' . str_replace( '.', '_', QODE_ESSENTIAL_ADDONS_VERSION ) ) );

			if ( is_array( $transients ) && count( $transients ) ) {
				foreach ( $transients as $transient_name ) {
					delete_transient( $transient_name );
				}
			}

			$params = $this->generate_import_list_params();

			$html = qode_essential_addons_framework_get_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/demos-import-list', '', $params );

			qode_essential_addons_framework_get_ajax_status( 'success', esc_html__( 'Demos Reloaded', 'qode-essential-addons' ), $html );

			wp_die();
		}
	}
}
