<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<div class="qodef-filter-holder">
	<div class="qodef-filter-holder-inner">
		<div class="qodef-filter-group qodef-filter-category">
			<h6 class="qodef-filter-group-title"><?php esc_html_e( 'Categories', 'qode-essential-addons' ); ?></h6>
			<ul class="qodef-filter-list">
				<li class="qodef-filter-item qodef-demos-filter qodef-demos-current" data-filter-title="all" data-filter="">
					<span class="qodef-filter-item-name"><?php esc_html_e( 'All Categories', 'qode-essential-addons' ); ?></span>
				</li>
				<?php foreach ( $categories as $slug => $name ) { ?>
					<li class="qodef-filter-item qodef-demos-filter" data-taxonomy="category" data-filter-title="<?php echo esc_attr( $name ); ?>" data-filter=".demo-category-<?php echo esc_attr( $slug ); ?>">
						<span class="qodef-filter-item-name"><?php echo esc_attr( $name ); ?></span>
					</li>
				<?php } ?>
			</ul>
		</div>
		<div class="qodef-filter-group qodef-filter-color">
			<h6 class="qodef-filter-group-title"><?php esc_html_e( 'Colors', 'qode-essential-addons' ); ?></h6>
			<ul class="qodef-filter-list">
				<li class="qodef-filter-item qodef-demos-filter qodef-demos-current" data-filter-title="all" data-filter="">
					<span class="qodef-filter-item-name"><?php esc_html_e( 'All Colors', 'qode-essential-addons' ); ?></span>
				</li>
				<?php foreach ( $colors as $slug => $name ) { ?>
					<li class="qodef-filter-item qodef-demos-filter" data-taxonomy="color" data-filter-title="<?php echo esc_attr( $name ); ?>" data-filter=".demo-color-<?php echo esc_attr( $slug ); ?>">
						<span class="qodef-filter-item-color <?php echo esc_attr( $slug ); ?>"></span>
						<span class="qodef-filter-item-name"><?php echo esc_attr( $name ); ?></span>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
