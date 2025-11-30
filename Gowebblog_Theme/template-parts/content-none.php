<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * Used in index.php, archive.php, search.php
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="no-results not-found py-16">
	<div class="text-center">
		<h1 class="font-heading text-4xl md:text-5xl font-bold mb-6 leading-tight fade-in-section">
			<?php esc_html_e( 'Nothing Found', 'gowebblog' ); ?>
		</h1>

		<div class="page-content fade-in-section">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p class="text-secondary text-lg mb-8">
					<?php
					printf(
						wp_kses(
							/* translators: 1: link to WP admin new post page */
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'gowebblog' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						),
						esc_url( admin_url( 'post-new.php' ) )
					);
					?>
				</p>

			<?php elseif ( is_search() ) : ?>

				<p class="text-secondary text-lg mb-8">
					<?php
					printf(
						/* translators: %s: search query */
						esc_html__( 'Sorry, but nothing matched your search terms: %s. Please try again with some different keywords.', 'gowebblog' ),
						'<strong>' . get_search_query() . '</strong>'
					);
					?>
				</p>

			<?php else : ?>

				<p class="text-secondary text-lg mb-8">
					<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'gowebblog' ); ?>
				</p>

			<?php endif; ?>

			<!-- Search Form -->
			<div class="max-w-md mx-auto mt-12">
				<?php get_search_form(); ?>
			</div>

			<!-- Action Buttons -->
			<div class="flex flex-col sm:flex-row gap-4 justify-center mt-12">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center justify-center px-8 py-3 bg-white text-black font-semibold rounded-lg hover:bg-white/90 transition-colors">
					<i class="fa-solid fa-home mr-2"></i>
					<?php esc_html_e( 'Go Home', 'gowebblog' ); ?>
				</a>
				
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="inline-flex items-center justify-center px-8 py-3 border border-white/20 rounded-full text-sm font-semibold hover:bg-white hover:text-black transition-all duration-300">
					<i class="fa-solid fa-newspaper mr-2"></i>
					<?php esc_html_e( 'Browse Blog', 'gowebblog' ); ?>
				</a>
			</div>
		</div><!-- .page-content -->
	</section><!-- .no-results -->