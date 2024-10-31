<?php

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}
?>
<?php qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/filter', '', $params ); ?>
<div class="qodef-demos-holder">
	<div class="qodef-import-top">
		<div class="qodef-import-top-title-holder">
			<h1 class="qodef-h2"><?php echo esc_html( $import_title ); ?></h1>
		</div>
		<div class="qodef-import-top-actions-holder">
			<a href="#" class="qodef-import-top-button qodef-import-top-reload-button">
				<span><?php echo esc_html__( 'Reload', 'qode-essential-addons' ); ?></span>
				<svg x="0px" y="0px" width="16.497px" height="14.063px" viewBox="0 0 16.497 14.063" enable-background="new 0 0 16.497 14.063" xml:space="preserve">
						<g>
							<path d="M16.242,6.223L13.5,8.965c-0.141,0.141-0.329,0.211-0.563,0.211c-0.234,0-0.422-0.07-0.563-0.211L9.668,6.223
								c-0.329-0.375-0.329-0.75,0-1.125c0.375-0.328,0.75-0.328,1.125,0l1.512,1.512c-0.118-1.406-0.691-2.602-1.723-3.586
								C9.55,2.039,8.332,1.547,6.926,1.547c-1.477,0-2.737,0.533-3.779,1.6C2.104,4.213,1.582,5.508,1.582,7.031
								c0,1.524,0.521,2.818,1.564,3.885c1.042,1.067,2.314,1.6,3.814,1.6c1.078,0,2.086-0.316,3.023-0.949
								c0.188-0.141,0.387-0.193,0.598-0.158s0.375,0.146,0.492,0.334c0.304,0.422,0.246,0.786-0.176,1.09
								c-1.172,0.821-2.484,1.23-3.938,1.23c-1.922,0-3.563-0.686-4.922-2.057C0.68,10.635,0,8.977,0,7.031
								c0-1.945,0.68-3.604,2.039-4.975C3.398,0.686,5.039,0,6.961,0c1.781,0,3.334,0.61,4.658,1.828c1.324,1.219,2.068,2.73,2.232,4.535
								l1.23-1.266c0.375-0.328,0.75-0.328,1.125,0C16.582,5.473,16.594,5.848,16.242,6.223z"></path>
						</g>
					</svg>
			</a>

			<?php wp_nonce_field( 'qode_essential_addons_reload_demo_import', 'qode_essential_addons_reload_demo_import' ); ?>
		</div>
	</div>
	<?php qode_essential_addons_framework_template_part( QODE_ESSENTIAL_ADDONS_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/import/templates/filter-top', '', $params ); ?>
	<div class="qodef-grid-inner">
		<div class="qodef-import-demos-grid-sizer"></div>
		<div class="qodef-import-demos-grid-gutter"></div>
		<?php
		foreach ( $demos as $demo_id => $demo ) :

			$item_classes = array();
			if ( ! empty( $demo['categories'] ) ) {
				foreach ( $demo['categories'] as $key => $value ) {
					$item_classes[] = 'demo-category-' . $key;
				}
			}
			if ( ! empty( $demo['colors'] ) ) {
				foreach ( $demo['colors'] as $key => $value ) {
					$item_classes[] = 'demo-color-' . $key;
				}
			}
			if ( ! empty( $demo['status'] ) ) {
				$item_classes[] = 'demo-status-' . $demo['status'];
			}
			$import_link_enabled = true;

			if ( 'premium' === $demo['status'] && true !== $enabled_premium ) {
				$import_link_enabled = false;
			}

			?>
			<article class="qodef-import-demo <?php echo esc_attr( implode( ' ', $item_classes ) ); ?>">
				<div class="qodef-import-demo-inner">
					<div class="qodef-import-demo-image">
						<div class="qodef-lazy-load"><img itemprop="image" data-image="<?php echo esc_url( $demo['demo_image_url'] ); ?>" width="470" height="540" src="<?php echo esc_url( QODE_ESSENTIAL_ADDONS_ADMIN_URL_PATH . '/inc/admin-pages/sub-pages/import/assets/img/demo-placeholder.jpg' ); ?>" alt="<?php echo esc_attr( $demo['demo_name'] ); ?>" /></div>
						<div class="qodef-overlay">
							<?php if ( $import_link_enabled ) : ?>
								<a class="qodef-import-demo-link" data-demo-id="<?php echo esc_attr( $demo_id ); ?>" href="<?php echo add_query_arg( array( 'item-id' => esc_attr( $demo_id ) ), menu_page_url( $page_name, false ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
									<span><?php esc_html_e( 'Import', 'qode-essential-addons' ); ?></span>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="13px" height="11px" viewBox="0 0 13 11" xml:space="preserve">
											<g>
												<g>
													<path d="M7.017,0.498v6.258l2.225-2.118C9.479,4.39,9.721,4.384,9.966,4.624c0.248,0.238,0.242,0.472-0.016,0.7L6.855,8.313
														C6.813,8.375,6.759,8.416,6.694,8.437C6.63,8.458,6.565,8.468,6.501,8.468S6.372,8.458,6.308,8.437
														C6.243,8.416,6.189,8.375,6.146,8.313L3.052,5.324c-0.258-0.229-0.263-0.462-0.016-0.7c0.247-0.24,0.489-0.234,0.726,0.015
														l2.224,2.118V0.498c0-0.146,0.048-0.265,0.145-0.358S6.351,0,6.501,0c0.15,0,0.274,0.047,0.371,0.14S7.017,0.353,7.017,0.498z"/>
												</g>
												<path d="M12.855,5.878c-0.097-0.093-0.22-0.14-0.371-0.14c-0.149,0-0.273,0.047-0.37,0.14s-0.146,0.213-0.146,0.358v3.767H1.032
													V6.237c0-0.146-0.048-0.265-0.145-0.358s-0.221-0.14-0.371-0.14c-0.151,0-0.274,0.047-0.371,0.14S0.001,6.091,0.001,6.237L0,11
													h0.001H13V6.237C13,6.091,12.952,5.972,12.855,5.878z"/>
											</g>
										</svg>
								</a>
							<?php else : ?>
								<a class="qodef-upgrade-link" target="_blank" href="https://qodeinteractive.com/products/plugins/qi-theme/">
									<span><?php esc_html_e( 'Import', 'qode-essential-addons' ); ?></span>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="13px" height="11px" viewBox="0 0 13 11" xml:space="preserve">
												<g>
													<g>
														<path d="M7.017,0.498v6.258l2.225-2.118C9.479,4.39,9.721,4.384,9.966,4.624c0.248,0.238,0.242,0.472-0.016,0.7L6.855,8.313
															C6.813,8.375,6.759,8.416,6.694,8.437C6.63,8.458,6.565,8.468,6.501,8.468S6.372,8.458,6.308,8.437
															C6.243,8.416,6.189,8.375,6.146,8.313L3.052,5.324c-0.258-0.229-0.263-0.462-0.016-0.7c0.247-0.24,0.489-0.234,0.726,0.015
															l2.224,2.118V0.498c0-0.146,0.048-0.265,0.145-0.358S6.351,0,6.501,0c0.15,0,0.274,0.047,0.371,0.14S7.017,0.353,7.017,0.498z"/>
													</g>
													<path d="M12.855,5.878c-0.097-0.093-0.22-0.14-0.371-0.14c-0.149,0-0.273,0.047-0.37,0.14s-0.146,0.213-0.146,0.358v3.767H1.032
														V6.237c0-0.146-0.048-0.265-0.145-0.358s-0.221-0.14-0.371-0.14c-0.151,0-0.274,0.047-0.371,0.14S0.001,6.091,0.001,6.237L0,11
														h0.001H13V6.237C13,6.091,12.952,5.972,12.855,5.878z"/>
												</g>
											</svg>
								</a>
							<?php endif; ?>
							<a class="qodef-view-demo-link" href="<?php echo esc_url( $demo['demo_preview_url'] ); ?>" target="_blank">
								<span><?php esc_html_e( 'View', 'qode-essential-addons' ); ?></span>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="9px" height="9px" viewBox="0 0 9 9" xml:space="preserve">
										<g>
											<path fill="#010101" d="M0.164,8.067c0.013-0.014,6.985-6.983,6.985-6.983L2.332,1.06C1.963,1.075,1.779,0.9,1.781,0.533
												c0-0.367,0.184-0.542,0.55-0.526h6.134C8.544-0.008,8.617,0,8.68,0.032C8.744,0.064,8.8,0.103,8.848,0.151
												C8.897,0.199,8.936,0.255,8.97,0.318C9,0.383,9.008,0.454,8.992,0.534v6.13c0.017,0.366-0.158,0.551-0.526,0.55
												c-0.368,0.001-0.544-0.183-0.527-0.55L7.916,1.85L0.93,8.832C0.818,8.944,0.69,9,0.547,9C0.054,9-0.182,8.413,0.164,8.067z"/>
										</g>
										</svg>
							</a>
						</div>
					</div>
					<div class="qodef-import-demo-text">
						<h4 class="qodef-import-demo-title">
							<a href="<?php echo esc_url( $demo['demo_preview_url'] ); ?>" target="_blank">
								<?php echo esc_attr( $demo['demo_name'] ); ?>
								<?php if ( 'premium' == $demo['status'] ) { ?>
									<span class="qodef-premium-label"><?php echo wp_kses_post( $demo['status'] ); ?></span>
								<?php } ?>
							</a>
						</h4>
						<div class="qodef-filter-category-holder">
							<?php
							foreach ( $demo['categories'] as $slug => $name ) {
								echo '<span>' . wp_kses_post( $name ) . '</span>';
							}
							?>
						</div>
						<div class="qodef-filter-color-holder">
							<?php
							foreach ( $demo['colors'] as $slug => $name ) {
								echo '<span>' . wp_kses_post( $name ) . '</span>';
							}
							?>
						</div>
						<div class="qodef-filter-tag-holder">
							<?php
							foreach ( $demo['tags'] as $slug => $name ) {
								echo '<span>' . wp_kses_post( $name ) . '</span>';
							}
							?>
						</div>
					</div>
				</div>
			</article>
		<?php endforeach; ?>
		<?php wp_nonce_field( 'qode_essential_addons_demo_import_nonce', 'qode_essential_addons_demo_import_nonce' ); ?>
	</div>
</div>
