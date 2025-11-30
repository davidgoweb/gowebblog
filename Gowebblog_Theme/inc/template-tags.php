<?php
/**
 * Custom template tags for this theme
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Estimated reading time for post content
 *
 * @param int $post_id Post ID.
 * @return string Reading time in minutes.
 */
function gowebblog_estimated_reading_time( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$post    = get_post( $post_id );
	
	$word_count = str_word_count( strip_tags( $post->post_content ) );
	$reading_time = ceil( $word_count / 200 ); // Assuming 200 words per minute reading speed
	
	return apply_filters( 'gowebblog_estimated_reading_time', $reading_time, $post_id );
}

/**
 * Check if post has headings for table of contents
 *
 * @param int $post_id Post ID.
 * @return bool True if post has headings.
 */
function gowebblog_has_headings( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$post    = get_post( $post_id );
	
	// Check for h2 and h3 tags in content
	$has_h2 = preg_match( '/<h2[^>]*>/i', $post->post_content );
	$has_h3 = preg_match( '/<h3[^>]*>/i', $post->post_content );
	
	return apply_filters( 'gowebblog_has_headings', ( $has_h2 || $has_h3 ), $post_id );
}

/**
 * Generate table of contents from post headings
 *
 * @param int $post_id Post ID.
 * @return string HTML for table of contents.
 */
function gowebblog_get_table_of_contents( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$post    = get_post( $post_id );
	
	if ( ! gowebblog_has_headings( $post_id ) ) {
		return '';
	}
	
	// Extract headings from content
	preg_match_all( '/<h([2-6])[^>]*id="([^"]*)"[^>]*>(.*?)<\/h[2-6]>/i', $post->post_content, $matches );
	
	if ( empty( $matches[0] ) ) {
		return '';
	}
	
	$toc = '<ul class="space-y-3">';
	
	foreach ( $matches[0] as $index => $heading ) {
		$level   = $matches[1][ $index ];
		$id      = $matches[2][ $index ];
		$title   = strip_tags( $matches[3][ $index ] );
		$padding = ( $level - 2 ) * 4; // h2 = 0, h3 = 4, h4 = 8, etc.
		
		$toc .= sprintf(
			'<li><a href="#%s" class="block text-sm text-secondary hover:text-white transition-colors py-2 border-l-2 border-transparent hover:border-white/20 pl-%d" style="padding-left: %dpx;">%s</a></li>',
			esc_attr( $id ),
			esc_attr( 4 + $padding ),
			16 + $padding,
			esc_html( $title )
		);
	}
	
	$toc .= '</ul>';
	
	return apply_filters( 'gowebblog_table_of_contents', $toc, $post_id );
}

/**
 * Get related posts based on categories
 *
 * @param int $post_id Current post ID.
 * @param int $number Number of posts to return.
 * @return WP_Query Related posts query.
 */
function gowebblog_get_related_posts( $post_id, $number = 3 ) {
	$categories = wp_get_post_categories( $post_id );
	
	if ( empty( $categories ) ) {
		return new WP_Query(); // Return empty query if no categories
	}
	
	$category_ids = wp_list_pluck( $categories, 'term_id' );
	
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $number,
		'post__not_in'   => array( $post_id ),
		'category__in'    => $category_ids,
		'orderby'        => 'rand',
	);
	
	return new WP_Query( apply_filters( 'gowebblog_related_posts_args', $args, $post_id ) );
}

/**
 * Get post thumbnail with fallback
 *
 * @param int   $post_id Post ID.
 * @param string $size Thumbnail size.
 * @param array  $attr Image attributes.
 * @return string HTML for thumbnail.
 */
function gowebblog_get_thumbnail( $post_id = 0, $size = 'thumbnail', $attr = array() ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, $size, $attr );
	}
	
	// Fallback to placeholder
	$title   = get_the_title( $post_id );
	$width   = 600;
	$height  = 400;
	
	if ( 'thumbnail' === $size ) {
		$width  = 80;
		$height = 80;
	} elseif ( 'medium' === $size ) {
		$width  = 300;
		$height = 200;
	} elseif ( 'large' === $size ) {
		$width  = 1024;
		$height = 683;
	}
	
	$default_attr = array(
		'src'   => "https://dummyimage.com/{$width}x{$height}/222/fff?text=" . urlencode( $title ),
		'class'  => "attachment-{$size} size-{$size}",
		'alt'    => $title,
		'width'   => $width,
		'height'  => $height,
	);
	
	$attr = wp_parse_args( $attr, $default_attr );
	
	return sprintf( '<img %s>', gowebblog_get_html_attributes( $attr ) );
}

/**
 * Convert array to HTML attributes string
 *
 * @param array $attr Attributes array.
 * @return string HTML attributes.
 */
function gowebblog_get_html_attributes( $attr ) {
	$html = '';
	
	foreach ( $attr as $key => $value ) {
		$html .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
	}
	
	return $html;
}

/**
 * Custom excerpt with custom length
 *
 * @param int  $length Excerpt length.
 * @param bool $more Whether to show "more" link.
 * @return string Custom excerpt.
 */
function gowebblog_custom_excerpt( $length = 55, $more = true ) {
	$excerpt = get_the_excerpt();
	
	if ( ! $excerpt ) {
		$excerpt = get_the_content();
		$excerpt = wp_strip_all_tags( $excerpt );
		$excerpt = substr( $excerpt, 0, $length );
		$excerpt = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
	}
	
	if ( $more ) {
		$excerpt .= '...';
	}
	
	return apply_filters( 'gowebblog_custom_excerpt', $excerpt, $length, $more );
}