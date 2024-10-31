<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-grid-item">
	<div class="qodef-portfolio qodef-m <?php echo esc_attr( qode_essential_addons_get_portfolio_holder_classes() ); ?>">
		<?php
		// Include portfolio posts loop.
		qode_essential_addons_template_part( 'post-types/portfolio', 'templates/parts/loop' );
		?>
	</div>
</div>
