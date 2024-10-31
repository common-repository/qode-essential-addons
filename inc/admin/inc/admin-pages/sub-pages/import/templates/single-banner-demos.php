<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-admin-import-single-banner qodef-demos-banner">
	<div class="qodef-admin-single-banner-content">
		<h3><?php esc_html_e( 'View all demos', 'qode-essential-addons' ); ?></h3>
		<a class="qodef-btn qodef-btn-simple-light" href="https://qodeinteractive.com/qi-theme/?utm_source=dash&utm_medium=qodeessential&utm_campaign=welcome" target="_blank"><?php esc_html_e( 'Demo list', 'qode-essential-addons' ); ?></a>
	</div>
	<div class="qodef-admin-single-banner-image">
		<img src="<?php echo esc_url( QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/sub-pages/import/assets/img/demos-banner.png' ); ?>" alt="<?php esc_attr_e( 'Demos', 'qode-essential-addons' ); ?>"/>
	</div>
</div>
