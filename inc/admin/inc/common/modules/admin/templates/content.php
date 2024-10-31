<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-tabs-content">
	<?php
	foreach ( $pages as $page_object ) { ?>
		<?php
		$page_slug    = $page_object->get_slug();
		$section_slug = empty( $page_slug ) ? $options_name : $options_name . '_' . $page_slug;
		?>
		<div class="tab-content qodef-hide-pane" data-section="<?php echo esc_attr( $section_slug ); ?>">
			<div class="tab-pane">
				<div class="qodef-tab-content">
					<div class="qodef-page-title">
						<span class="qodef-page-title-text"><?php echo esc_html( $page_object->get_title() ); ?></span>
						<span class="qodef-title-separator">/</span>
						<span class="qodef-page-description"><?php echo esc_html( $page_object->get_description() ); ?></span>
					</div>
					<?php if ( $banner_enabled ) : ?>
						<div class="qodef-page-banner">
							<div class="qodef-page-banner-content">
								<h2><?php esc_html_e( 'Upgrade to Qi Premium.', 'qode-essential-addons' ); ?></h2>
								<h2><?php esc_html_e( 'Get all widgets and options.', 'qode-essential-addons' ); ?></h2>
								<a href="https://qodeinteractive.com/products/plugins/qi-theme/?utm_source=theme-options&utm_medium=qi-essentials&utm_campaign=gopremium" target="_blank" class="qodef-btn qodef-btn-solid"><?php esc_html_e( 'Upgrade Now', 'qode-essential-addons' ); ?></a>
							</div>
							<div class="qodef-page-banner-image">
								<img src="<?php echo esc_url( QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/modules/admin/assets/img/upgrade-banner.png' ); ?>" alt="<?php esc_attr_e( 'Upgrade Image', 'qode-essential-addons' ); ?>" />
							</div>
						</div>
					<?php endif; ?>
					<?php $page_object->render(); ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
