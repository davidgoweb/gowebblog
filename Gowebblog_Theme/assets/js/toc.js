/**
 * Table of Contents Interactive Features
 *
 * Handles TOC toggle functionality, active state tracking,
 * and smooth scrolling for table of contents.
 */

( function() {
	'use strict';

	// Wait for DOM to be ready
	document.addEventListener( 'DOMContentLoaded', function() {
		initTOCFeatures();
	});

	function initTOCFeatures() {
		// Get all TOC containers
		const tocContainers = document.querySelectorAll( '.toc-container' );
		
		if ( ! tocContainers.length ) {
			return;
		}

		// Initialize each TOC container
		tocContainers.forEach( function( container ) {
			initToggleFeature( container );
			initActiveTracking( container );
			initSmoothScrolling( container );
		});
	}

	// Initialize toggle functionality
	function initToggleFeature( container ) {
		const toggleBtn = container.querySelector( '.toc-toggle' );
		const toggleText = container.querySelector( '.toc-toggle-text' );
		const toggleIcon = container.querySelector( '.toc-toggle-icon' );
		
		if ( ! toggleBtn ) {
			return;
		}

		// Check if TOC should be collapsed by default (more than 10 items)
		const tocLinks = container.querySelectorAll( '.toc-link' );
		const shouldCollapseByDefault = tocLinks.length > 10;
		
		if ( shouldCollapseByDefault ) {
			container.classList.add( 'toc-collapsed' );
			if ( toggleText ) {
				toggleText.textContent = 'Show More';
			}
		}

		// Toggle click handler
		toggleBtn.addEventListener( 'click', function( e ) {
			e.preventDefault();
			container.classList.toggle( 'toc-collapsed' );
			
			if ( toggleText ) {
				toggleText.textContent = container.classList.contains( 'toc-collapsed' ) 
					? 'Show More' 
					: 'Show Less';
			}
		});
	}

	// Initialize active state tracking
	function initActiveTracking( container ) {
		const tocLinks = container.querySelectorAll( '.toc-link' );
		
		if ( ! tocLinks.length ) {
			return;
		}

		// Create intersection observer for headings
		const headingObserver = new IntersectionObserver( function( entries ) {
			let activeId = null;
			
			// Find the heading that's currently most visible
			entries.forEach( function( entry ) {
				if ( entry.isIntersecting ) {
					// Check if this is the most visible heading
					const rect = entry.boundingClientRect;
					const isVisible = rect.top >= 0 && rect.top <= window.innerHeight * 0.5;
					
					if ( isVisible ) {
						activeId = entry.target.id;
					}
				}
			});

			// Update active state
			if ( activeId ) {
				updateActiveState( tocLinks, activeId );
			}
		}, {
			rootMargin: '-20% 0px -70% 0px'
		});

		// Observe all headings
		tocLinks.forEach( function( link ) {
			const targetId = link.getAttribute( 'href' ).substring( 1 );
			const targetHeading = document.getElementById( targetId );
			
			if ( targetHeading ) {
				headingObserver.observe( targetHeading );
			}
		});

		// Also update on scroll as a fallback
		let scrollTimeout;
		window.addEventListener( 'scroll', function() {
			clearTimeout( scrollTimeout );
			scrollTimeout = setTimeout( function() {
				updateActiveFromScrollPosition( tocLinks );
			}, 50 );
		});
	}

	// Update active state for TOC links
	function updateActiveState( links, activeId ) {
		links.forEach( function( link ) {
			const href = link.getAttribute( 'href' );
			
			if ( href === '#' + activeId ) {
				link.classList.add( 'toc-active' );
			} else {
				link.classList.remove( 'toc-active' );
			}
		});
	}

	// Update active state based on scroll position
	function updateActiveFromScrollPosition( links ) {
		const scrollY = window.pageYOffset;
		let activeLink = null;
		
		links.forEach( function( link ) {
			const targetId = link.getAttribute( 'href' ).substring( 1 );
			const targetHeading = document.getElementById( targetId );
			
			if ( targetHeading ) {
				const rect = targetHeading.getBoundingClientRect();
				const absoluteTop = rect.top + scrollY;
				
				// Check if this heading is in view or above
				if ( absoluteTop <= scrollY + 100 ) {
					activeLink = link;
				}
			}
		});

		// Update active states
		if ( activeLink ) {
			links.forEach( function( link ) {
				link.classList.remove( 'toc-active' );
			});
			activeLink.classList.add( 'toc-active' );
		}
	}

	// Initialize smooth scrolling
	function initSmoothScrolling( container ) {
		const tocLinks = container.querySelectorAll( '.toc-link' );
		
		tocLinks.forEach( function( link ) {
			link.addEventListener( 'click', function( e ) {
				e.preventDefault();
				
				const targetId = this.getAttribute( 'href' ).substring( 1 );
				const targetHeading = document.getElementById( targetId );
				
				if ( targetHeading ) {
					const headerOffset = 80; // Adjust based on header height
					const elementPosition = targetHeading.getBoundingClientRect().top;
					const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
					
					window.scrollTo( {
						top: offsetPosition,
						behavior: 'smooth'
					});
					
					// Update active state immediately
					updateActiveState( tocLinks, targetId );
				}
			});
		});
	}

	// Handle keyboard navigation
	document.addEventListener( 'keydown', function( e ) {
		// Check if focus is within a TOC
		const focusedElement = document.activeElement;
		if ( focusedElement && focusedElement.classList.contains( 'toc-link' ) ) {
			const tocLinks = Array.from( focusedElement.parentElement.parentElement.querySelectorAll( '.toc-link' ) );
			const currentIndex = tocLinks.indexOf( focusedElement );
			
			// Arrow key navigation
			if ( e.key === 'ArrowDown' && currentIndex < tocLinks.length - 1 ) {
				e.preventDefault();
				tocLinks[ currentIndex + 1 ].focus();
			} else if ( e.key === 'ArrowUp' && currentIndex > 0 ) {
				e.preventDefault();
				tocLinks[ currentIndex - 1 ].focus();
			}
		}
	});

})();