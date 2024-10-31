<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<h2><?php echo esc_html( $this_object->get_title() ); ?></h2>
<table class="qodef-page-v4 form-table qodef-table-wrapper qodef-section-wrapper <?php echo esc_attr( $class ); ?>">
	<tbody>
	<?php
	foreach ( $this_object->get_children() as $child ) {
		$child->render();
	}
	?>
	</tbody>
</table>
