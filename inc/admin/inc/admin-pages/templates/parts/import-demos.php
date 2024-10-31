<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-section-box qodef-section-import-demos">
	<div class="qodef-section-box-image">
		<img src="<?php echo esc_url( QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/assets/img/import-demos.jpg' ); ?>" alt="<?php esc_attr_e( 'Import Demos', 'qode-essential-addons' ); ?>" />
	</div>
	<div class="qodef-section-box-content">
		<h2><?php esc_html_e( 'Import Demos', 'qode-essential-addons' ); ?></h2>
		<p class="qodef-large"><?php esc_html_e( 'Beautiful sets of free demos', 'qode-essential-addons' ); ?></p>
		<a class="qodef-btn qodef-btn-solid" href="<?php echo esc_url( admin_url( 'admin.php?page=qode_essential_addons_import_menu' ) ); ?>"><?php esc_html_e( 'Import Demos', 'qode-essential-addons' ); ?></a>
	</div>
</div>