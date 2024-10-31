<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-page-v4-essential-addons qodef-admin-page-v4 qodef-dashboard-admin qodef-admin-content-grid">
	<?php $this_object->get_header(); ?>
	<div class="qodef-admin-content qodef-admin-grid qodef-admin-layout--columns qodef-admin-col-num--1 qodef-admin-gutter--normal">
		<div class="qodef-admin-grid-inner">
			<div class="qodef-admin-container qodef-admin-grid-item qodef-admin-col--12">
				<?php $this_object->get_content(); ?>
			</div>
		</div>
	</div>
</div>
