<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

// Hook to include additional content before page content holder.
do_action( 'qode_essential_addons_action_before_portfolio_content_holder' );
?>
<main id="qodef-page-content" class="qodef-grid qodef-layout--columns <?php echo esc_attr( qode_essential_addons_get_grid_gutter_classes() ); ?>">
	<div class="qodef-grid-inner">
		<?php
		// Include portfolio template.
		$content = isset( $content ) ? $content : '';
		qode_essential_addons_template_part( 'post-types/portfolio', 'templates/portfolio', $content );
		?>
	</div>
</main>
<?php
// Hook to include additional content after main page content holder.
do_action( 'qode_essential_addons_action_after_portfolio_content_holder' );
?>
