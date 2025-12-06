<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom navigation walker for desktop menu
 */
class Gowebblog_Nav_Walker extends Walker_Nav_Menu {
	/**
	 * Starts the element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$output .= $n . $t . '<a' . $id . $class_names . ' href="' . esc_attr( $item->url ) . '">';
		
		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		}
		
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Custom navigation walker for mobile menu
 */
class Gowebblog_Mobile_Nav_Walker extends Walker_Nav_Menu {
	/**
	 * Starts the element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'mobile-link';
		
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$output .= $n . $t . '<a' . $id . $class_names . ' href="' . esc_attr( $item->url ) . '">';
		
		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		
		if ( '_blank' === $item->target && empty( $item->xfn ) ) {
			$atts['rel'] = 'noopener noreferrer';
		}
		
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Add custom image sizes
 */
function gowebblog_image_sizes() {
	add_image_size( 'gowebblog-thumb', 80, 80, true );
	add_image_size( 'gowebblog-medium', 300, 200, true );
	add_image_size( 'gowebblog-large', 600, 400, true );
}
add_action( 'after_setup_theme', 'gowebblog_image_sizes' );

/**
 * Custom search form
 */
function gowebblog_search_form( $form ) {
	$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
		<label class="screen-reader-text" for="s">' . esc_html__( 'Search for:', 'gowebblog' ) . '</label>
		<div class="relative">
			<input type="search" class="search-field w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:outline-none focus:border-white/20 transition-colors" placeholder="' . esc_attr__( 'Search...', 'gowebblog' ) . '" value="' . get_search_query() . '" name="s" />
			<button type="submit" class="search-submit absolute right-2 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-white/10 rounded-full flex items-center justify-center hover:bg-white/20 transition-colors">
				<i class="fa-solid fa-search text-sm"></i>
			</button>
		</div>
	</form>';
	
	return $form;
}
add_filter( 'get_search_form', 'gowebblog_search_form' );

/**
 * Custom excerpt more
 */
function gowebblog_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'gowebblog_excerpt_more' );

/**
 * Custom excerpt length
 */
function gowebblog_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'gowebblog_excerpt_length' );

/**
 * Add body classes
 */
function gowebblog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	
	return $classes;
}
add_filter( 'body_class', 'gowebblog_body_classes' );

/**
 * Add post classes
 */
function gowebblog_post_classes( $classes ) {
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}
	
	return $classes;
}
add_filter( 'post_class', 'gowebblog_post_classes' );


/**
 * Add customizer settings
 */
function gowebblog_customize_register_social( $wp_customize ) {
	$wp_customize->add_section(
		'gowebblog_social',
		array(
			'title'    => __( 'Social Media', 'gowebblog' ),
			'priority' => 35,
		)
	);
	
	$social_settings = array(
		'linkedin_url'    => __( 'LinkedIn URL', 'gowebblog' ),
		'github_url'      => __( 'GitHub URL', 'gowebblog' ),
		'twitter_url'     => __( 'Twitter URL', 'gowebblog' ),
		'contact_email'    => __( 'Contact Email', 'gowebblog' ),
		'newsletter_action' => __( 'Newsletter Form Action', 'gowebblog' ),
	);
	
	foreach ( $social_settings as $setting => $label ) {
		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'postMessage',
			)
		);
		
		$wp_customize->add_control(
			$setting,
			array(
				'label'   => $label,
				'section' => 'gowebblog_social',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'gowebblog_customize_register_social' );

/**
 * Get toolbox repository URL
 *
 * @param int $post_id The post ID.
 * @return string The repository URL or empty string.
 */
function gowebblog_get_toolbox_repo_url( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	return get_post_meta( $post_id, '_toolbox_repo_url', true );
}

/**
 * Get toolbox demo URL
 *
 * @param int $post_id The post ID.
 * @return string The demo URL or empty string.
 */
function gowebblog_get_toolbox_demo_url( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	return get_post_meta( $post_id, '_toolbox_demo_url', true );
}

/**
 * Display toolbox repository link
 *
 * @param int $post_id The post ID.
 * @param string $text The link text.
 * @param string $class Additional CSS classes.
 */
function gowebblog_the_toolbox_repo_link( $post_id = 0, $text = '', $class = '' ) {
	$repo_url = gowebblog_get_toolbox_repo_url( $post_id );
	
	if ( ! $repo_url ) {
		return;
	}
	
	$text = $text ? $text : __( 'View Repository', 'gowebblog' );
	$class = $class ? ' ' . $class : '';
	
	printf(
		'<a href="%s" target="_blank" rel="noopener noreferrer" class="toolbox-repo-link%s"><i class="fab fa-github"></i> %s</a>',
		esc_url( $repo_url ),
		esc_attr( $class ),
		esc_html( $text )
	);
}

/**
 * Display toolbox demo link
 *
 * @param int $post_id The post ID.
 * @param string $text The link text.
 * @param string $class Additional CSS classes.
 */
function gowebblog_the_toolbox_demo_link( $post_id = 0, $text = '', $class = '' ) {
	$demo_url = gowebblog_get_toolbox_demo_url( $post_id );
	
	if ( ! $demo_url ) {
		return;
	}
	
	$text = $text ? $text : __( 'Live Demo', 'gowebblog' );
	$class = $class ? ' ' . $class : '';
	
	printf(
		'<a href="%s" target="_blank" rel="noopener noreferrer" class="toolbox-demo-link%s"><i class="fas fa-external-link-alt"></i> %s</a>',
		esc_url( $demo_url ),
		esc_attr( $class ),
		esc_html( $text )
	);
}

/**
 * Get all toolbox items
 *
 * @param array $args Additional query arguments.
 * @return WP_Query The toolbox items query.
 */
function gowebblog_get_toolbox_items( $args = array() ) {
	$defaults = array(
		'post_type'      => 'toolbox',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
	
	return new WP_Query( array_merge( $defaults, $args ) );
}

/**
 * Get featured toolbox items
 *
 * @param int $count Number of toolbox items to return.
 * @return WP_Query The featured toolbox items query.
 */
function gowebblog_get_featured_toolbox_items( $count = 6 ) {
	return gowebblog_get_toolbox_items( array(
		'posts_per_page' => $count,
	) );
}

/**
 * Get related toolbox items based on categories
 *
 * @param int $post_id Current post ID.
 * @param int $number Number of posts to return.
 * @return WP_Query Related toolbox items query.
 */
function gowebblog_get_related_toolbox_items( $post_id, $number = 3 ) {
	$categories = wp_get_post_terms( $post_id, 'toolbox-category' );
	
	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		return new WP_Query(); // Return empty query if no categories
	}
	
	$category_ids = wp_list_pluck( $categories, 'term_id' );
	
	$args = array(
		'post_type'      => 'toolbox',
		'posts_per_page' => $number,
		'post__not_in'   => array( $post_id ),
		'tax_query'      => array(
			array(
				'taxonomy' => 'toolbox-category',
				'field'    => 'term_id',
				'terms'    => $category_ids,
			),
		),
		'orderby'        => 'rand',
	);
	
	return new WP_Query( apply_filters( 'gowebblog_related_toolbox_items_args', $args, $post_id ) );
}