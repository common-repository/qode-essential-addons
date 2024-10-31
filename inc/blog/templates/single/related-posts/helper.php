<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( ! function_exists( 'qode_essential_addons_include_blog_single_related_posts_template' ) ) {
	/**
	 * Function which includes additional module on single posts page
	 */
	function qode_essential_addons_include_blog_single_related_posts_template() {
		if ( is_singular( 'post' ) ) {
			include_once QODE_ESSENTIAL_ADDONS_INC_PATH . '/blog/templates/single/related-posts/templates/related-posts.php';
		}
	}

	// @WPThemeHookList.
	add_action( 'the_two_action_after_page_content_holder', 'qode_essential_addons_include_blog_single_related_posts_template' );
	add_action( 'the_q_action_after_page_content_holder', 'qode_essential_addons_include_blog_single_related_posts_template' );
	add_action( 'qi_action_after_page_content_holder', 'qode_essential_addons_include_blog_single_related_posts_template' );
	add_action( 'qi_gutenberg_action_after_page_content_holder', 'qode_essential_addons_include_blog_single_related_posts_template' );
}
