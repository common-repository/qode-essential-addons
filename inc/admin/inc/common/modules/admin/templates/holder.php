<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-admin-page-v4">
	<form method="post" id="qode_essential_addons_framework_ajax_form" data-options-name="<?php echo esc_attr( $options_name ); ?>">
		<div class="qodef-admin-header">
			<div class="qodef-header-left">
				<div class="qodef-header-left-inner">
					<a href="#" class="qodef-mobile-nav-opener">
						<?php qode_essential_addons_framework_svg_icon( 'opener', 'qodef-opener-icon' ); ?>
					</a>
					<div class="qodef-logo-holder">
						<a href="https://qodeinteractive.com" target="_blank">
							<img src="<?php echo esc_url( QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/common/modules/admin/assets/img/logo-qode-interactive.png' ); ?>" alt="<?php esc_attr_e( 'Admin Qode Interactive image', 'qode-essential-addons' ); ?>" height="47"/>
						</a>
					</div>
					<div class="qodef-search-holder">
						<?php qode_essential_addons_framework_svg_icon( 'search', 'qodef-search-icon' ); ?>
						<input class="qodef-search-field qodef-input" value=""
							   placeholder="<?php esc_attr_e( 'Search Options', 'qode-essential-addons' ); ?>">
						<?php qode_essential_addons_framework_svg_icon( 'spinner', 'qodef-search-loading qodef-hidden' ); ?>
					</div>
				</div>
			</div>
			<div class="qodef-header-right">
				<div class="qodef-header-right-inner">
					<div class="qodef-save-success">
						<p class="qodef-field-description"><?php esc_html_e( 'Saved!', 'qode-essential-addons' ); ?></p>
					</div>
					<div class="qodef-save-reset-loading"><?php qode_essential_addons_framework_svg_icon( 'spinner', 'qodef-save-reset-loading-spinner' ); ?></div>
					<div class="qodef-form-save-holder">
						<input type="submit" class="qodef-btn qodef-btn-solid qodef-save-reset-button" name="qodef_save"
							   value="<?php esc_attr_e( 'Save Changes', 'qode-essential-addons' ); ?>"/>
					</div>
					<div class="qodef-form-reset-holder">
						<input onclick="return confirm('<?php esc_html_e( 'Are you sure? You will reset all options to default values. This will also apply on already imported demo.', 'qode-essential-addons' ); ?>');"
							   type="submit" class="qodef-btn qodef-btn-outlined qodef-save-reset-button"
							   name="qodef_reset" value="<?php esc_attr_e( 'Reset All', 'qode-essential-addons' ); ?>"/>
					</div>
				</div>
			</div>
		</div>
		<div class="qodef-admin-content">
			<?php $options->render_navigation(); ?>
			<?php $options->render_content(); ?>
		</div>
		<?php wp_nonce_field( 'qode_essential_addons_framework_ajax_save_nonce', 'qode_essential_addons_framework_ajax_save_nonce' ); ?>
	</form>
</div>
