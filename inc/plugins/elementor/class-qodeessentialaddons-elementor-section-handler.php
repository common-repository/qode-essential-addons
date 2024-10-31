<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class QodeEssentialAddons_Elementor_Section_Handler {
	private static $instance;

	public function __construct() {
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_grid_options' ) );
		add_action( 'elementor/frontend/before_enqueue_styles', array( $this, 'enqueue_styles' ), 9 );
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9 );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function render_grid_options( $section ) {
		$section->start_controls_section(
			'qodef_grid_row',
			[
				'label' => esc_html__( 'Qode Essential Addons Grid', 'qode-essential-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'qode-essential-addons' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'   => esc_html__( 'No', 'qode-essential-addons' ),
					'grid' => esc_html__( 'Yes', 'qode-essential-addons' ),
				],
				'prefix_class' => 'qodef-elementor-content-',
			]
		);

		$section->add_control(
			'qodef_grid_row_behavior',
			[
				'label'        => esc_html__( 'Grid Row Behavior', 'qode-essential-addons' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => [
					''      => esc_html__( 'Default', 'qode-essential-addons' ),
					'right' => esc_html__( 'Extend Grid Right', 'qode-essential-addons' ),
					'left'  => esc_html__( 'Extend Grid Left', 'qode-essential-addons' ),
				],
				'condition'    => [
					'qodef_enable_grid_row' => 'grid',
				],
				'prefix_class' => 'qodef-extended-grid qodef-extended-grid--',
			]
		);

		$section->add_control(
			'qodef_reset_grid_row_behavior',
			[
				'label'        => esc_html__( 'Reset Grid Row Behavior', 'qode-essential-addons' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => [
					''     => esc_html__( 'Never', 'qode-essential-addons' ),
					'1024' => esc_html__( 'Below 1024px', 'qode-essential-addons' ),
				],
				'condition'    => [
					'qodef_grid_row_behavior' => [ 'right', 'left' ],
				],
				'prefix_class' => 'qodef-extended-grid-reset qodef-extended-grid-reset--',
			]
		);

		$section->end_controls_section();
	}

	public function enqueue_styles() {
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters
		wp_enqueue_style( 'qode-essential-addons-elementor', QODE_ESSENTIAL_ADDONS_PLUGINS_URL_PATH . '/elementor/assets/css/elementor.min.css' );
	}

	public function enqueue_scripts() {
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters
		wp_enqueue_script( 'qode-essential-addons-elementor', QODE_ESSENTIAL_ADDONS_PLUGINS_URL_PATH . '/elementor/assets/js/elementor.js', array( 'jquery', 'elementor-frontend' ) );
	}
}

if ( ! function_exists( 'qode_essential_addons_init_elementor_section_handler' ) ) {
	/**
	 * Function that initialize main page builder handler
	 */
	function qode_essential_addons_init_elementor_section_handler() {
		QodeEssentialAddons_Elementor_Section_Handler::get_instance();
	}

	add_action( 'init', 'qode_essential_addons_init_elementor_section_handler', 1 );
}
