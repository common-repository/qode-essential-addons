<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( is_active_sidebar( 'qodef-side-area' ) ) {
	?>
	<div id="qodef-side-area" <?php qode_essential_addons_framework_class_attribute( $holder_classes ); ?>>
		<?php
		qode_essential_addons_template_part( 'side-area', 'templates/close-icon' );
		?>
		<div id="qodef-side-area-inner">
			<?php dynamic_sidebar( 'qodef-side-area' ); ?>
		</div>
	</div>
<?php } ?>
