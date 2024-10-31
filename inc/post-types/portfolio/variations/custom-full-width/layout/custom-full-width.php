<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

// Hook to include additional content before portfolio single item.
do_action( 'qode_essential_addons_action_before_portfolio_single_item' );
?>
	<article <?php post_class( 'qodef-portfolio-single-item qodef-e' ); ?>>
		<div class="qodef-e-inner">
			<div class="qodef-e-content">
				<div class="qodef-grid-inner">
					<div class="qodef-grid-itemqodef-portfolio-info">
						<?php qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php
// Hook to include additional content after portfolio single item.
do_action( 'qode_essential_addons_action_after_portfolio_single_item' );
?>
