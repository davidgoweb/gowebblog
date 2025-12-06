<?php
/**
 * Jetpack Compatibility File
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function gowebblog_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container'      => 'main',
			'footer'         => 'page',
			'posts_per_page' => get_option( 'posts_per_page' ),
			'render'         => 'gowebblog_infinite_scroll_render',
			'footer_widgets'  => array( 'footer-1' ),
			'wrapper'        => false,
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details'    => array(
				'stylesheet' => 'gowebblog-style',
				'author'      => true,
				'categories'   => true,
				'tags'        => true,
			),
			'featured-images' => array(
				'archive'    => true,
				'post'       => true,
				'page'       => true,
			),
		)
	);

	// Add theme support for Social Menus.
	add_theme_support( 'jetpack-social-menu' );

	// Add theme support for Site Logo.
	add_theme_support(
		'site-logo',
		array(
			'size' => 'gowebblog-logo',
		)
	);
}
add_action( 'after_setup_theme', 'gowebblog_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function gowebblog_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content-home' );
		endif;
	}
}

/**
 * Remove sharing display from standard loop.
 */
function gowebblog_remove_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
add_action( 'loop_start', 'gowebblog_remove_share' );

/**
 * Add sharing to single post content.
 */
function gowebblog_add_share() {
	if ( function_exists( 'sharing_display' ) ) {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
		
		echo sharing_display();
	}
}
add_action( 'gowebblog_share_links', 'gowebblog_add_share' );

/**
 * Remove related posts from standard loop.
 */
function gowebblog_remove_related_posts() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) && is_single() ) {
		remove_filter( 'the_content', array( Jetpack_RelatedPosts::init(), 'filter_add_related_posts_to_content' ), 40 );
	}
}
add_action( 'wp_head', 'gowebblog_remove_related_posts' );

/**
 * Add related posts to single post.
 */
function gowebblog_add_related_posts() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) && is_single() ) {
		$related_posts = Jetpack_RelatedPosts::init()->get_for_post_id( get_the_ID() );
		
		if ( $related_posts && is_array( $related_posts ) ) {
			echo '<div class="related-posts mt-16 pt-8 border-t border-white/10">';
			echo '<h3 class="font-heading text-2xl font-bold mb-8 text-white">' . esc_html__( 'Related Posts', 'gowebblog' ) . '</h3>';
			echo '<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">';
			
			foreach ( $related_posts as $related_post ) {
				$post_id = $related_post['id'];
				setup_postdata( get_post( $post_id ) );
				?>
				<div class="related-post">
					<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="group block">
						<div class="img-zoom-container rounded-xl overflow-hidden mb-6 aspect-[3/2]">
							<?php if ( has_post_thumbnail( $post_id ) ) : ?>
								<img src="<?php echo esc_url( get_the_post_thumbnail_url( $post_id, 'medium_large' ) ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" class="img-zoom w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
							<?php else : ?>
								<img src="https://imagezt.davidgo.web.id/600x400/222/fff?text=<?php echo urlencode( get_the_title( $post_id ) ); ?>&fontSize=24&textWrap=true&textWrapWidth=90" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" class="img-zoom w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
							<?php endif; ?>
						</div>
						<h4 class="font-medium text-white text-sm mb-1 group-hover:text-pink-300 transition-colors line-clamp-2">
							<?php echo esc_html( get_the_title( $post_id ) ); ?>
						</h4>
						<p class="text-xs text-secondary">
							<?php echo esc_html( get_the_date( '', $post_id ) ); ?>
						</p>
					</a>
				</div>
				<?php
			}
			
			echo '</div>';
			echo '</div>';
		}
		
		wp_reset_postdata();
	}
}
add_action( 'gowebblog_related_posts', 'gowebblog_add_related_posts' );

/**
 * Custom logo size for Jetpack.
 */
function gowebblog_jetpack_logo_size() {
	add_image_size( 'gowebblog-logo', 400, 100 );
}
add_action( 'after_setup_theme', 'gowebblog_jetpack_logo_size' );

/**
 * Remove default Jetpack CSS.
 */
function gowebblog_remove_jetpack_css() {
	wp_deregister_style( 'jetpack_css' );
}
add_action( 'wp_print_styles', 'gowebblog_remove_jetpack_css' );