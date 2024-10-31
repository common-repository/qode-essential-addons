<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-meta-box">
	<div class="qodef-meta-box-holder">
		<?php $metabox['args']['box']->render(); ?>
		<?php
		wp_nonce_field(
			'qode_essential_addons_framework_meta_box_' . $metabox['args']['box']->get_slug() . '_save',
			'qode_essential_addons_framework_meta_box_' . $metabox['args']['box']->get_slug() . '_save'
		);
		?>
	</div>
</div>
