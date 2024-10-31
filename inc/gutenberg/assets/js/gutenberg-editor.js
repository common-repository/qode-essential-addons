// Set custom editor scripts on page loaded.
document.addEventListener(
	'DOMContentLoaded',
	function () {
		qodefSetBodyClasses();
	}
);

// Set preview screen body class.
const qodefSetBodyClasses = () => {

	if ( typeof wp === 'object' && typeof wp.data === 'object' ) {
		var wpData           = wp.data;
		var initialScreen    = 'desktop';
		var $currentDocument = document;

		$currentDocument.body.classList.add( 'qode-essential-addons--' + initialScreen );

		wpData.subscribe(
			() =>
			{
				// Timeout is set in order to wait a little to iframe loaded.
				setTimeout(
					function () {
						var currentPageData = wpData.select( 'core/edit-post' );

						if ( currentPageData !== null && typeof currentPageData !== 'undefined' ) {
							var currentScreen      = typeof wpData.select( 'core/editor' )?.getDeviceType === 'function' ? wpData.select( 'core/editor' )?.getDeviceType()?.toLowerCase() : currentPageData.__experimentalGetPreviewDeviceType().toLowerCase(),
								$currentPageEditor = document.querySelector( '.edit-post-visual-editor__content-area' ) || document.querySelector( '#site-editor' ),
								$previewPanel      = document.querySelector( '.block-editor-block-preview__content iframe' ) || document.querySelector( '.edit-post-visual-editor iframe' ),
								$iframeElement     = '';

							if ( $previewPanel ) {
								$iframeElement = $previewPanel;
							} else if ( $currentPageEditor ) {
								$iframeElement = $currentPageEditor.querySelector( 'iframe[name="editor-canvas"]' );
							}

							$currentDocument = $iframeElement ? $iframeElement.contentDocument : document;

							// Check if preview screens changed.
							if (
								typeof currentScreen !== 'undefined' &&
								initialScreen !== currentScreen &&
								['tablet', 'mobile', 'desktop'].includes( currentScreen )
							) {

								if ( document ) {
									document.body.classList.remove( 'qode-essential-addons--tablet' );
									document.body.classList.remove( 'qode-essential-addons--mobile' );
									document.body.classList.remove( 'qode-essential-addons--desktop' );

									document.body.classList.add( 'qode-essential-addons--' + currentScreen );
								}

								if ( $currentDocument ) {
									$currentDocument.body.classList.remove( 'qode-essential-addons--tablet' );
									$currentDocument.body.classList.remove( 'qode-essential-addons--mobile' );
									$currentDocument.body.classList.remove( 'qode-essential-addons--desktop' );

									$currentDocument.body.classList.add( 'qode-essential-addons--' + currentScreen );
								}

								initialScreen = currentScreen;
							}
						}
					},
					1000
				);
			}
		);
	}
}
