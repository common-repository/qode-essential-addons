<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( have_posts() ) {
	while ( have_posts() ) :
		the_post();

		// Hook to include additional content before post item.
		do_action( 'qode_essential_addons_action_before_portfolio_item' );

		$item_layout = apply_filters( 'qode_essential_addons_filter_portfolio_single_layout', '' );

		// Include post item.
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo apply_filters( 'qode_essential_addons_filter_portfolio_single_template', qode_essential_addons_get_template_part( 'post-types/portfolio', 'variations/' . $item_layout . '/layout/' . $item_layout ) );

		// Hook to include additional content after post item.
		do_action( 'qode_essential_addons_action_after_portfolio_item' );

	endwhile;
} else {
	// Include global posts not found.
	qode_essential_addons_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();
