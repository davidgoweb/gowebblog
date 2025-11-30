/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	'use strict';

	// Get all navigation elements
	const siteNavigation = document.getElementById( 'site-navigation' );
	const mobileMenuBtn = document.getElementById( 'mobile-menu-btn' );
	const closeMenuBtn = document.getElementById( 'close-menu-btn' );
	const mobileMenu = document.getElementById( 'mobile-menu' );
	const mobileLinks = document.querySelectorAll( '.mobile-link' );

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	// Return early if the mobile menu doesn't exist.
	if ( ! mobileMenu || ! mobileMenuBtn || ! closeMenuBtn ) {
		return;
	}

	// Toggle mobile menu
	function toggleMenu() {
		mobileMenu.classList.toggle( 'translate-x-full' );
		document.body.classList.toggle( 'overflow-hidden' );
	}

	// Add event listeners
	if ( mobileMenuBtn ) {
		mobileMenuBtn.addEventListener( 'click', toggleMenu );
	}

	if ( closeMenuBtn ) {
		closeMenuBtn.addEventListener( 'click', toggleMenu );
	}

	if ( mobileLinks ) {
		mobileLinks.forEach( function( link ) {
			link.addEventListener( 'click', toggleMenu );
		} );
	}

	// Escape key to close menu
	document.addEventListener( 'keydown', function( e ) {
		if ( e.key === 'Escape' && ! mobileMenu.classList.contains( 'translate-x-full' ) ) {
			toggleMenu();
		}
	} );

	// Get the dropdown toggle button.
	const dropdownToggle = siteNavigation.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	// No dropdown toggle button found.
	if ( ! dropdownToggle.length ) {
		return;
	}

	// Add event listeners to dropdown toggle buttons.
	dropdownToggle.forEach( function( button ) {
		button.addEventListener( 'click', function( e ) {
			e.preventDefault();

			// Toggle the dropdown menu.
			const dropdown = button.nextElementSibling;
			if ( dropdown ) {
				dropdown.classList.toggle( 'sub-menu--visible' );
				button.setAttribute( 'aria-expanded', dropdown.classList.contains( 'sub-menu--visible' ) );
			}
		} );
	} );

	// Close dropdown menus when clicking outside
	document.addEventListener( 'click', function( e ) {
		if ( ! siteNavigation.contains( e.target ) ) {
			const dropdowns = siteNavigation.querySelectorAll( '.sub-menu--visible' );
			dropdowns.forEach( function( dropdown ) {
				dropdown.classList.remove( 'sub-menu--visible' );
				const toggle = dropdown.previousElementSibling;
				if ( toggle ) {
					toggle.setAttribute( 'aria-expanded', 'false' );
				}
			} );
		}
	} );

	// Handle keyboard navigation for dropdown menus
	dropdownToggle.forEach( function( button ) {
		button.addEventListener( 'keydown', function( e ) {
			const dropdown = button.nextElementSibling;
			
			// Enter or Space key
			if ( ( e.key === 'Enter' || e.key === ' ' ) ) {
				e.preventDefault();
				dropdown.classList.toggle( 'sub-menu--visible' );
				button.setAttribute( 'aria-expanded', dropdown.classList.contains( 'sub-menu--visible' ) );
			}
			
			// Escape key
			if ( e.key === 'Escape' && dropdown.classList.contains( 'sub-menu--visible' ) ) {
				dropdown.classList.remove( 'sub-menu--visible' );
				button.setAttribute( 'aria-expanded', 'false' );
				button.focus();
			}
		} );
	} );

	// Add focus trap for mobile menu
	function trapFocus( element ) {
		const focusableEls = element.querySelectorAll(
			'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
		);
		const firstFocusableEl = focusableEls[0];
		const lastFocusableEl = focusableEls[ focusableEls.length - 1 ];

		element.addEventListener( 'keydown', function( e ) {
			if ( e.key === 'Tab' ) {
				if ( e.shiftKey ) {
					/* shift + tab */ 
					if ( document.activeElement === firstFocusableEl ) {
						lastFocusableEl.focus();
						e.preventDefault();
					}
				} else {
					/* tab */ 
					if ( document.activeElement === lastFocusableEl ) {
						firstFocusableEl.focus();
						e.preventDefault();
					}
				}
			}
		} );
	}

	// Apply focus trap to mobile menu when open
	if ( mobileMenu ) {
		const observer = new MutationObserver( function( mutations ) {
			mutations.forEach( function( mutation ) {
				if ( mutation.attributeName === 'class' ) {
					if ( ! mobileMenu.classList.contains( 'translate-x-full' ) ) {
						trapFocus( mobileMenu );
					}
				}
			} );
		} );

		observer.observe( mobileMenu, { attributes: true } );
	}

}() );