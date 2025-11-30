<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<section class="py-24 min-h-screen flex items-center">
		<div class="max-w-4xl mx-auto px-6 text-center">
			<div class="fade-in-section">
				<h1 class="font-heading text-6xl md:text-8xl font-bold mb-8 leading-tight">
					404
				</h1>
				
				<h2 class="font-heading text-3xl md:text-4xl font-bold mb-6 leading-tight">
					<?php esc_html_e( 'Page Not Found', 'gowebblog' ); ?>
				</h2>
				
				<p class="text-secondary text-lg md:text-xl leading-relaxed mb-12 max-w-2xl mx-auto">
					<?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'gowebblog' ); ?>
				</p>
				
				<div class="flex flex-col sm:flex-row gap-4 justify-center">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center justify-center px-8 py-3 bg-white text-black font-semibold rounded-lg hover:bg-white/90 transition-colors">
						<i class="fa-solid fa-home mr-2"></i>
						<?php esc_html_e( 'Go Home', 'gowebblog' ); ?>
					</a>
					
					<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="inline-flex items-center justify-center px-8 py-3 border border-white/20 rounded-full text-sm font-semibold hover:bg-white hover:text-black transition-all duration-300">
						<i class="fa-solid fa-newspaper mr-2"></i>
						<?php esc_html_e( 'Browse Blog', 'gowebblog' ); ?>
					</a>
				</div>
				
				<!-- Search Form -->
				<div class="mt-16 max-w-md mx-auto">
					<h3 class="text-lg font-semibold mb-6"><?php esc_html_e( 'Search for something else:', 'gowebblog' ); ?></h3>
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</section>

<?php
get_footer();