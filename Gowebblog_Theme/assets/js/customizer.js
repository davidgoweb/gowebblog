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
			var cssVar = '--' + setting.replace( '_', '-' );
			$( ':root' ).css( cssVar, value );
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

	// Hero image.
	wp.customize( 'gowebblog_hero_image', function( value ) {
		value.bind( function( newImageId ) {
			var heroImage = $( '#about .order-1.lg\\:order-2 img' );
			if ( newImageId ) {
				// Get the image URL from the attachment ID
				wp.media.attachment( newImageId ).fetch().then( function( attachment ) {
					var imageUrl = attachment.get('url');
					if ( imageUrl ) {
						// Update the hero image in the preview
						heroImage.attr( 'src', imageUrl );
					}
				});
			} else {
				// Revert to default image
				var defaultImageUrl = heroImage.data('default') ||
				                      wp.customize.settings.url.template + '/assets/img/cover.png';
				heroImage.attr( 'src', defaultImageUrl );
			}
		});
	});

	// Hero heading text.
	wp.customize( 'gowebblog_hero_heading', function( value ) {
		value.bind( function( newHeading ) {
			$( '#about .order-2.lg\\:order-1 h4' ).text( newHeading );
		} );
	} );

	// Hero subtitle text.
	wp.customize( 'gowebblog_hero_subtitle', function( value ) {
		value.bind( function( newSubtitle ) {
			$( '#about .order-2.lg\\:order-1 h1 .text-secondary' ).text( newSubtitle );
		} );
	} );

	// Hero description text.
	wp.customize( 'gowebblog_hero_description', function( value ) {
		value.bind( function( newDescription ) {
			$( '#about .order-2.lg\\:order-1 p.text-secondary' ).text( newDescription );
		} );
	} );

	// Hero skill tag 1.
	wp.customize( 'gowebblog_hero_skill_1', function( value ) {
		value.bind( function( newSkill ) {
			$( '#about .order-2.lg\\:order-1 .flex.flex-wrap.gap-3.mb-10 span:first-child' ).text( newSkill );
		} );
	} );

	// Hero skill tag 2.
	wp.customize( 'gowebblog_hero_skill_2', function( value ) {
		value.bind( function( newSkill ) {
			$( '#about .order-2.lg\\:order-1 .flex.flex-wrap.gap-3.mb-10 span:nth-child(2)' ).text( newSkill );
		} );
	} );

	// Hero skill tag 3.
	wp.customize( 'gowebblog_hero_skill_3', function( value ) {
		value.bind( function( newSkill ) {
			$( '#about .order-2.lg\\:order-1 .flex.flex-wrap.gap-3.mb-10 span:nth-child(3)' ).text( newSkill );
		} );
	} );

	// 404 Page Options
	// 404 page title.
	wp.customize( 'gowebblog_404_title', function( value ) {
		value.bind( function( newTitle ) {
			$( '.error404 h2' ).text( newTitle );
		} );
	} );

	// 404 page description.
	wp.customize( 'gowebblog_404_description', function( value ) {
		value.bind( function( newDescription ) {
			$( '.error404 p.text-secondary' ).text( newDescription );
		} );
	} );

	// "Go Home" button text.
	wp.customize( 'gowebblog_404_go_home_text', function( value ) {
		value.bind( function( newText ) {
			$( '.error404 a[href*="' + wp.customize.settings.url.home + '"]' ).each( function() {
				if ( $(this).text().includes( 'Go Home' ) || $(this).find('.fa-home').length > 0 ) {
					$(this).contents().filter( function() {
						return this.nodeType === 3;
					} ).replaceWith( newText );
				}
			} );
		} );
	} );

	// "Browse Blog" button text.
	wp.customize( 'gowebblog_404_browse_blog_text', function( value ) {
		value.bind( function( newText ) {
			$( '.error404 a' ).each( function() {
				if ( $(this).find('.fa-newspaper').length > 0 ) {
					$(this).contents().filter( function() {
						return this.nodeType === 3;
					} ).replaceWith( newText );
				}
			} );
		} );
	} );

	// Show/hide "Go Home" button.
	wp.customize( 'gowebblog_404_show_go_home', function( value ) {
		value.bind( function( showButton ) {
			$( '.error404 a' ).each( function() {
				if ( $(this).find('.fa-home').length > 0 ) {
					if ( showButton ) {
						$(this).show();
					} else {
						$(this).hide();
					}
				}
			} );
		} );
	} );

	// Show/hide "Browse Blog" button.
	wp.customize( 'gowebblog_404_show_browse_blog', function( value ) {
		value.bind( function( showButton ) {
			$( '.error404 a' ).each( function() {
				if ( $(this).find('.fa-newspaper').length > 0 ) {
					if ( showButton ) {
						$(this).show();
					} else {
						$(this).hide();
					}
				}
			} );
		} );
	} );

	// Show/hide search functionality.
	wp.customize( 'gowebblog_404_show_search', function( value ) {
		value.bind( function( showSearch ) {
			if ( showSearch ) {
				$( '.error404 .mt-16' ).show();
			} else {
				$( '.error404 .mt-16' ).hide();
			}
		} );
	} );

	// Footer description text.
	wp.customize( 'gowebblog_footer_description', function( value ) {
		value.bind( function( newDescription ) {
			$( '.footer-brand-description' ).text( newDescription );
		} );
	} );

	// Show/hide footer description.
	wp.customize( 'gowebblog_show_footer_description', function( value ) {
		value.bind( function( showDescription ) {
			if ( showDescription ) {
				$( '.footer-brand-description' ).show();
			} else {
				$( '.footer-brand-description' ).hide();
			}
		} );
	} );

} )( jQuery );