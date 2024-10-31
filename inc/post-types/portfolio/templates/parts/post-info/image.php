<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

if ( has_post_thumbnail() ) {
	?>
	<div class="qodef-e-image">
		<?php the_post_thumbnail(); ?>
	</div>
<?php } ?>
