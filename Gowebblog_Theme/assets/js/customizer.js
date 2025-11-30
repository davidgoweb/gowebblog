( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		$( '.site-title a' ).text( value );
	} );
	wp.customize( 'blogdescription', function( value ) {
		$( '.site-description' ).text( value );
	} );

	// Theme colors.
	const colorSettings = [
		'primary_color',
		'secondary_color',
		'accent_color',
		'dark_color',
		'darker_color',
		'card_color'
	];

	colorSettings.forEach( function( setting ) {
		wp.customize( setting, function( value ) {
			// Update CSS custom properties.
			$( ':root' ).css( {
				'--' + setting.replace( '_', '-' ) : value
			} );
		} );
	} );

	// Header CTA text.
	wp.customize( 'gowebblog_cta_text', function( value ) {
		$( 'header .px-6.py-2.5.border.border-white\\/20.rounded-full.text-sm.font-semibold.hover\\:bg-white.hover\\:text-black.transition-all.duration-300' ).text( value );
	} );

	// Header CTA link.
	wp.customize( 'gowebblog_cta_link', function( value ) {
		$( 'header .px-6.py-2.5.border.border-white\\/20.rounded-full.text-sm.font-semibold.hover\\:bg-white.hover\\:text-black.transition-all.duration-300' ).attr( 'href', value );
	} );

	// Show/hide tagline.
	wp.customize( 'gowebblog_show_tagline', function( value ) {
		if ( value ) {
			$( '.site-description' ).show();
		} else {
			$( '.site-description' ).hide();
		}
	} );

	// Sidebar position.
	wp.customize( 'gowebblog_sidebar_position', function( value ) {
		$( 'body' ).removeClass( 'sidebar-left sidebar-right sidebar-none' );
		$( 'body' ).addClass( 'sidebar-' + value );
	} );

	// Excerpt length.
	wp.customize( 'gowebblog_excerpt_length', function( value ) {
		// This will be handled server-side, but we can update the preview
		// by triggering a partial refresh if needed.
	} );

} )( jQuery );