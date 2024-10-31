<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-single-holder qodef-admin-content-grid">
	<div class="qodef-single-top">
		<h2><?php echo esc_html( $demo['demo_name'] ); ?></h2>
		<a href="#"
		   class="qodef-return-to-demo-list qodef-btn qodef-btn-outlined"><?php esc_html_e( 'Back to Demo List', 'qode-essential-addons' ); ?></a>
	</div>
	<div class="qodef-single-content">
		<div class="qodef-single-demo-images">
			<?php
			if ( isset( $demo['demo_image_url'] ) && ! isset( $demo['demo_additional_images_urls'] ) ) {
				qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/image', '', $params );
			} elseif ( isset( $demo['demo_image_url'] ) && isset( $demo['demo_additional_images_urls'] ) ) {
				qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/additional-images', '', $params );
			}
			?>
		</div>
		<div class="qodef-single-demo-actions">
			<?php qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/plugins', '', $params ); ?>
			<?php qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/form', '', $params ); ?>
		</div>
	</div>
	<div class="qodef-single-banners">
		<?php qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/single-banner-demos', '', $params ); ?>
		<?php qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/single-banner-widgets', '', $params ); ?>
	</div>
</div>
