<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post format part.
		qode_essential_addons_template_part( 'blog', 'templates/parts/post-format/link', '', $params );
		?>
	</div>
</article>
