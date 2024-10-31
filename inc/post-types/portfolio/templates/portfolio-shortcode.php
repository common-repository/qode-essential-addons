<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-grid-item">
	<?php
	$queried_tax           = get_queried_object();
	$queried_taxonomy      = ! empty( $queried_tax->taxonomy ) ? $queried_tax->taxonomy : '';
	$queried_taxonomy_slug = ! empty( $queried_tax->slug ) ? $queried_tax->slug : '';

	qode_essential_addons_generate_portfolio_archive_with_shortcode( $queried_taxonomy, $queried_taxonomy_slug );
	?>
</div>
