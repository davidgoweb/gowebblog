<?php
/**
 * Gowebblog Theme Functions
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function gowebblog_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'gowebblog' ),
			'footer'  => esc_html__( 'Footer Quick Links Menu', 'gowebblog' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'gowebblog_custom_background_args',
			array(
				'default-color' => '0a0a0a',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for wide and full alignment.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );
}
add_action( 'after_setup_theme', 'gowebblog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function gowebblog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gowebblog_content_width', 1200 );
}
add_action( 'after_setup_theme', 'gowebblog_content_width', 0 );

/**
 * Register widget area.
 */
function gowebblog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'gowebblog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'gowebblog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'gowebblog' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add footer widgets here.', 'gowebblog' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="text-lg font-bold mb-6">',
			'after_title'   => '</h5>',
		)
	);
}
add_action( 'widgets_init', 'gowebblog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gowebblog_scripts() {
	// Enqueue the main stylesheet.
	wp_enqueue_style(
		'gowebblog-style',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		filemtime( get_template_directory() . '/assets/css/main.css' )
	);

	// Enqueue Google Fonts.
	wp_enqueue_style(
		'gowebblog-fonts',
		'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Syne:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	// Enqueue Font Awesome.
	wp_enqueue_style(
		'gowebblog-fontawesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
		array(),
		'6.4.0'
	);

	// Enqueue main JavaScript file.
	wp_enqueue_script(
		'gowebblog-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		filemtime( get_template_directory() . '/assets/js/navigation.js' ),
		true
	);

	// Enqueue TOC JavaScript file (only for single posts with TOC).
	if ( is_singular() && gowebblog_has_headings() ) {
		wp_enqueue_script(
			'gowebblog-toc',
			get_template_directory_uri() . '/assets/js/toc.js',
			array(),
			filemtime( get_template_directory() . '/assets/js/toc.js' ),
			true
		);
	}

	// Enqueue comments script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Add inline scripts for mobile menu and animations.
	wp_add_inline_script(
		'gowebblog-navigation',
		"
		document.addEventListener('DOMContentLoaded', function() {
			// Mobile Menu Toggle
			const menuBtn = document.getElementById('mobile-menu-btn');
			const closeMenuBtn = document.getElementById('close-menu-btn');
			const mobileMenu = document.getElementById('mobile-menu');
			const mobileLinks = document.querySelectorAll('.mobile-link');

			if (menuBtn && closeMenuBtn && mobileMenu) {
				function toggleMenu() {
					mobileMenu.classList.toggle('translate-x-full');
					document.body.classList.toggle('overflow-hidden');
				}

				menuBtn.addEventListener('click', toggleMenu);
				closeMenuBtn.addEventListener('click', toggleMenu);
				
				mobileLinks.forEach(link => {
					link.addEventListener('click', toggleMenu);
				});
			}

			// Intersection Observer for Scroll Animations
			const observerOptions = {
				threshold: 0.1,
				rootMargin: '0px 0px -50px 0px'
			};

			const observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
					}
				});
			}, observerOptions);

			document.querySelectorAll('.fade-in-section').forEach(section => {
				observer.observe(section);
			});


			// Newsletter form submission
			const newsletterForm = document.querySelector('form');
			if (newsletterForm && newsletterForm.querySelector('input[type=\"email\"]')) {
				newsletterForm.addEventListener('submit', function(e) {
					e.preventDefault();
					const emailInput = this.querySelector('input[type=\"email\"]');
					const email = emailInput.value;
					
					if (email) {
						// Show success message
						const button = this.querySelector('button');
						const originalText = button.textContent;
						button.textContent = 'Subscribed!';
						button.classList.add('bg-green-500', 'hover:bg-green-600');
						button.classList.remove('bg-white', 'hover:bg-white/90', 'text-black');
						button.disabled = true;
						
						// Reset after 3 seconds
						setTimeout(() => {
							button.textContent = originalText;
							button.classList.remove('bg-green-500', 'hover:bg-green-600');
							button.classList.add('bg-white', 'hover:bg-white/90', 'text-black');
							button.disabled = false;
							emailInput.value = '';
						}, 3000);
					}
				});
			}
		});
		"
	);
}
add_action( 'wp_enqueue_scripts', 'gowebblog_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load Custom Post Types
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Set GitHub repository image as featured image for toolbox items
 *
 * @param int $post_id The post ID.
 */
function gowebblog_set_github_featured_image( $post_id ) {
	// Check if this is a toolbox post
	if ( get_post_type( $post_id ) !== 'toolbox' ) {
		return;
	}

	// Check if it's an auto-draft or revision
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	// Check if the post already has a featured image
	if ( has_post_thumbnail( $post_id ) ) {
		return;
	}

	// Get the GitHub URL from the custom field
	$github_url = get_post_meta( $post_id, '_toolbox_repo_url', true );

	if ( ! $github_url ) {
		return;
	}

	// Only process GitHub URLs
	if ( strpos( $github_url, 'github.com' ) === false ) {
		return;
	}

	// Add a transient to prevent multiple requests in a short time
	$transient_key = 'github_image_' . $post_id;
	if ( get_transient( $transient_key ) ) {
		return;
	}
	
	// Set transient for 5 minutes to prevent repeated requests
	set_transient( $transient_key, 'processing', 300 );

	// Get HTML content using wp_remote_get
	$response = wp_remote_get( $github_url );

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		// Delete transient on error so we can try again later
		delete_transient( $transient_key );
		return;
	}

	$html = wp_remote_retrieve_body( $response );

	// Find the og:image URL using regex
	if ( preg_match( '/<meta property="og:image" content="([^"]+)"/', $html, $matches ) ) {
		$image_url = $matches[1];
		
		// Download the image and set it as featured image
		gowebblog_download_and_set_featured_image( $post_id, $image_url, $github_url );
	}
	
	// Delete transient after processing
	delete_transient( $transient_key );
}
add_action( 'save_post', 'gowebblog_set_github_featured_image' );

/**
 * Download an image from URL and set it as featured image
 *
 * @param int    $post_id   The post ID.
 * @param string $image_url The image URL to download.
 * @param string $source_url The source URL for reference.
 */
function gowebblog_download_and_set_featured_image( $post_id, $image_url, $source_url = '' ) {
	// Include necessary WordPress files
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// Download the image to temporary file
	$tmp = download_url( $image_url );
	
	if ( is_wp_error( $tmp ) ) {
		return;
	}

	// Get file info
	$file_array = array(
		'name'     => basename( $image_url ),
		'tmp_name' => $tmp,
	);

	// Check if the file is an image
	$file_info = wp_check_filetype_and_ext( $file_array['tmp_name'], $file_array['name'] );
	
	if ( ! in_array( $file_info['ext'], array( 'jpg', 'jpeg', 'png', 'gif', 'webp' ), true ) ) {
		// Delete the temporary file
		@unlink( $tmp );
		return;
	}

	// Upload the image to WordPress Media Library
	$attachment_id = media_handle_sideload( $file_array, $post_id );
	
	if ( is_wp_error( $attachment_id ) ) {
		// Delete the temporary file
		@unlink( $tmp );
		return;
	}

	// Set the image as featured image
	set_post_thumbnail( $post_id, $attachment_id );

	// Add source URL as attachment meta if provided
	if ( $source_url ) {
		update_post_meta( $attachment_id, 'source_url', $source_url );
	}
}

/**
 * Add IDs to heading tags for table of contents
 *
 * @param string $content The post content.
 * @return string Modified content with IDs added to headings.
 */
function gowebblog_add_heading_ids( $content ) {
	// Pattern to match h2, h3, h4, h5, h6 tags without ID attribute
	$pattern = '/<(h[2-6])([^>]*)>(.*?)<\/h[2-6]>/i';
	
	$content = preg_replace_callback( $pattern, function( $matches ) {
		$tag = $matches[1]; // h2, h3, etc.
		$attributes = $matches[2]; // existing attributes
		$text = $matches[3]; // heading text
		
		// Check if ID already exists
		if ( preg_match( '/id\s*=\s*["\'][^"\']*["\']/', $attributes ) ) {
			return $matches[0]; // Return unchanged if ID exists
		}
		
		// Create ID from heading text
		$id = sanitize_title( $text );
		
		// Ensure ID is unique
		static $used_ids = array();
		$original_id = $id;
		$counter = 1;
		
		while ( in_array( $id, $used_ids ) ) {
			$id = $original_id . '-' . $counter;
			$counter++;
		}
		
		$used_ids[] = $id;
		
		// Return heading with ID added
		return '<' . $tag . $attributes . ' id="' . esc_attr( $id ) . '">' . $text . '</' . $tag . '>';
	}, $content );
	
	return $content;
}
add_filter( 'the_content', 'gowebblog_add_heading_ids' );

/**
 * Output custom CSS from customizer settings.
 */
function gowebblog_customizer_css() {
	?>
	<style type="text/css">
		:root {
			--primary-color: <?php echo esc_attr( get_theme_mod( 'primary_color', '#ffffff' ) ); ?>;
			--secondary-color: <?php echo esc_attr( get_theme_mod( 'secondary_color', '#999999' ) ); ?>;
			--accent-color: <?php echo esc_attr( get_theme_mod( 'accent_color', '#d1d5db' ) ); ?>;
			--dark-color: <?php echo esc_attr( get_theme_mod( 'dark_color', '#121212' ) ); ?>;
			--darker-color: <?php echo esc_attr( get_theme_mod( 'darker_color', '#0a0a0a' ) ); ?>;
			--card-color: <?php echo esc_attr( get_theme_mod( 'card_color', '#1c1c1c' ) ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'gowebblog_customizer_css' );

/**
 * Custom Walker for Footer Menu
 */
class Footer_Menu_Walker extends Walker_Nav_Menu {
	/**
	 * Start the element output.
	 *
	 * @param string   $output  Used to append additional content (passed by reference).
	 * @param WP_Post  $item    Menu item data object.
	 * @param int      $depth   Depth of menu item. Used for padding.
	 * @param stdClass $args    An object of wp_nav_menu() arguments.
	 * @param int      $id      Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= '<li' . $id . $class_names . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = isset( $args->before ) ? $args->before : '';
		$item_output .= '<a' . $attributes . ' class="text-secondary hover:text-white transition-colors text-sm">';
		$item_output .= isset( $args->link_before ) ? $args->link_before : '';
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= isset( $args->link_after ) ? $args->link_after : '';
		$item_output .= '</a>';
		$item_output .= isset( $args->after ) ? $args->after : '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}