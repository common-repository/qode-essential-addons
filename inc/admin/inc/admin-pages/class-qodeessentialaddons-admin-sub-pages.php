<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class QodeEssentialAddons_Admin_Sub_Pages {
	private $base;
	private $menu_name;
	private $title;
	private $position;
	private $atts = array();

	public function __construct() {
		$this->add_sub_page();
	}

	abstract public function add_sub_page();

	public function get_base() {
		return $this->base;
	}

	public function set_base( $base ) {
		$this->base = $base;
	}

	public function get_menu_name() {
		return $this->menu_name;
	}

	public function set_menu_name( $menu_name ) {
		$this->menu_name = $menu_name;
	}

	public function get_title() {
		return $this->title;
	}

	public function set_title( $title ) {
		$this->title = $title;
	}

	public function get_position() {
		return $this->position;
	}

	public function set_position( $position ) {
		$this->position = $position;
	}

	public function get_atts() {
		return $this->atts;
	}

	public function set_atts( $atts ) {
		$this->atts = $atts;
	}

	public function render() {
		$args                = $this->get_atts();
		$args['this_object'] = $this;
		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/holder', '', $args );
	}

	public function get_header() {
		$object      = ! empty( $object ) ? $object : $this;
		$global_atts = $this->get_atts();
		$slug        = isset( $global_atts['header_slug'] ) ? $global_atts['header_slug'] : '';
	
		$args = array(
			'menu_slug'  => $object->get_menu_name(),
			'menu_title' => $object->get_title(),
			'menu_url'   => admin_url( 'admin.php?page=' . QodeEssentialAddons_Admin_General_Page::get_instance()->get_menu_name() ),
		);

		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/header', $slug, $args );
	}

	public function get_footer() {
		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/footer' );
	}

	public function get_sidebar() {
		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'templates/sidebar' );
	}

	public function get_content() {
		qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc/admin-pages', 'sub-pages/' . $this->get_base(), 'templates/' . $this->get_base(), '', $this->get_atts() );
	}
}
