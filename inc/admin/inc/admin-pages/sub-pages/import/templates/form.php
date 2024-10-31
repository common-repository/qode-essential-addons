<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<form method="post" class="qodef-import-form"
	data-confirm-message="<?php esc_attr_e( 'Are you sure, you want to import Demo Data now?', 'qode-essential-addons' ); ?>"
	data-empty-import-type-message="<?php esc_attr_e( 'Please select import type!', 'qode-essential-addons' ); ?>"
	data-content-files="<?php echo esc_attr( $content_files['content_files'] ); ?>"
	data-other-files="<?php echo esc_attr( $content_files['other_files'] ); ?>">
	<input type="hidden" class="qodef-import-demo" value="<?php echo esc_attr( $demo_key ); ?>"/>
	<div class="qodef-form-section">
		<h4 class="qodef-import-label"><?php esc_html_e( 'Import type', 'qode-essential-addons' ); ?></h4>
		<select name="import_option" class="qodef-import-option qodef-select2" data-option-name="import_option"
				data-option-type="selectbox">
			<option value="none"><?php esc_html_e( 'Please Select', 'qode-essential-addons' ); ?></option>
			<?php if ( ! empty( $demo['demo_file_url'] ) || ! empty( $demo['demo_widgets_file_url'] ) || ! empty( qode_essential_addons_prepare_demos_options_for_import( $demo['demo_import_options'] ) ) ) : ?>
				<option value="complete"><?php esc_html_e( 'All', 'qode-essential-addons' ); ?></option>
			<?php endif; ?>
			<?php if ( ! empty( $demo['demo_file_url'] ) ) : ?>
				<option value="content"><?php esc_html_e( 'Content', 'qode-essential-addons' ); ?></option>
			<?php endif; ?>
			<?php if ( ! empty( $demo['demo_widgets_file_url'] ) ) : ?>
				<option value="widgets"><?php esc_html_e( 'Widgets', 'qode-essential-addons' ); ?></option>
			<?php endif; ?>
			<?php if ( ! empty( qode_essential_addons_prepare_demos_options_for_import( $demo['demo_import_options'] ) ) ) : ?>
				<option value="options"><?php esc_html_e( 'Options', 'qode-essential-addons' ); ?></option>
			<?php endif; ?>
		</select>
	</div>
	<div class="qodef-form-section qodef-form-section-attachments">
		<h4 class="qodef-form-label"><?php esc_html_e( 'Import Attachments', 'qode-essential-addons' ); ?></h4>
		<div class="qodef-import-checkbox-toggle qodef-import-field">
			<input type="checkbox" class="qodef-import-attachments" id="import_attachments" name="import_attachments"
					value="yes" checked/>
			<label for="import_attachments"><?php esc_attr_e( 'Import Attachments', 'qode-essential-addons' ); ?></label>
		</div>
	</div>
	<div class="qodef-form-section qodef-form-section-progress">
		<span class="qodef-progress-label"><?php esc_html_e( 'The import process may take some time. Please be patient.', 'qode-essential-addons' ); ?></span>
		<progress id="qodef-progress-bar" value="0" max="100"></progress>
		<span class="qodef-progress-percent"><?php esc_attr_e( '0%', 'qode-essential-addons' ); ?></span>
	</div>
	<div class="qodef-form-section qodef-form-section-messages">
		<p class="qodef-import-is-completed"><?php esc_html_e( 'Import is completed', 'qode-essential-addons' ); ?></p>
		<p class="qodef-import-went-wrong"><?php esc_html_e( 'Something went wrong.', 'qode-essential-addons' ); ?> <a
					href="https://helpcenter.qodeinteractive.com"
					target="_blank"><?php esc_html_e( 'Please contact support.', 'qode-essential-addons' ); ?></a></p>
		<?php if ( ini_get( 'allow_url_fopen' ) ) { ?>
		<input type="submit" class="qodef-btn qodef-btn-solid-red"
				value="<?php esc_attr_e( 'Import Demo', 'qode-essential-addons' ); ?>" name="import"
				id="qodef-import-demo-data"/>
		<?php } else { ?>
			<div class="qodef-allow-url-fopen-error">
				<p><?php esc_html_e( 'In order to complete the import process successfully, the \'allow_url_fopen\' has to be enabled on your server.', 'qode-essential-addons' ); ?></p>
			</div>
		<?php } ?>
	</div>
	<?php wp_nonce_field( 'qodef_import_nonce', 'qodef_import_nonce' ); ?>
</form>
