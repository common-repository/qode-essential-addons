<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-filter-holder-top">
	<div class="qodef-filter-group qodef-filter-status">
		<a href="javascript:void(0)" class="qodef-filter-item qodef-demos-current" data-filter-title="all" data-filter=""><?php esc_html_e( 'All', 'qode-essential-addons' ); ?></a>
		<a href="javascript:void(0)" class="qodef-filter-item" data-taxonomy='status' data-filter-title="Free" data-filter=".demo-status-free"><?php esc_html_e( 'Free', 'qode-essential-addons' ); ?></a>
		<a href="javascript:void(0)" class="qodef-filter-item" data-taxonomy='status' data-filter-title="Premium" data-filter=".demo-status-premium"><?php esc_html_e( 'Premium', 'qode-essential-addons' ); ?></a>
	</div>
	<div class="qodef-filter-number-of-results"></div>
	<div class="qodef-filter-search">
		<input type="text" class="quicksearch" placeholder="<?php esc_attr_e( 'Search demos by keyword...', 'qode-essential-addons' ); ?>"/>
	</div>
</div>
