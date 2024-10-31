<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-import-demos">
	<div class="qodef-import-demos-inner">
		<?php qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/demos-import-list', '', $params ); ?>
	</div>
</div>

<div class="qodef-demo-single">
	<?php
	if ( isset( $single_demo ) && '' !== $single_demo ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo qode_essential_addons_framework_get_template_part(
			QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc',
			'admin-pages',
			'sub-pages/import/templates/content-single',
			'',
			array(
				'demo'          => $single_demo,
				'demo_key'      => $single_demo_id,
				'content_files' => $content_files,
			)
		);
	}
	?>
</div>

