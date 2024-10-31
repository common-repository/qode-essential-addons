<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

abstract class QodeEssentialAddons_Title {
	protected $slug;
	public $overriding_whole_title = false;
	public $parameters             = array();

	public function load_template() {
		return qode_essential_addons_get_template_part( 'title/layouts/' . $this->slug, 'templates/' . $this->slug, '', $this->parameters );
	}
}
