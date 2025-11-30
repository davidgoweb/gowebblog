<?php
/**
 * The template for displaying search results pages
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<section class="py-16">
		<div class="max-w-7xl mx-auto px-6">
			<header class="page-header mb-16 text-center fade-in-section">
				<?php if ( have_posts() ) : ?>
					<h1 class="page-title font-heading text-4xl md:text-5xl font-bold">
						<?php
						/* translators: %s: search query */
						printf( esc_html__( 'Search Results for: %s', 'gowebblog' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				<?php else : ?>
					<h1 class="page-title font-heading text-4xl md:text-5xl font-bold">
						<?php esc_html_e( 'Nothing Found', 'gowebblog' ); ?>
					</h1>
				<?php endif; ?>
			</header><!-- .page-header -->

			<?php if ( have_posts() ) : ?>
				<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
					<?php
					// Start the Loop.
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content-home' );
					endwhile;
					?>
				</div>

				<!-- Pagination -->
				<div class="mt-16 flex justify-center">
					<?php
					the_posts_pagination(
						array(
							'mid_size'          => 2,
							'prev_text'         => __( '<i class="fa-solid fa-arrow-left"></i> Previous', 'gowebblog' ),
							'next_text'         => __( 'Next <i class="fa-solid fa-arrow-right"></i>', 'gowebblog' ),
							'screen_reader_text' => __( 'Posts navigation', 'gowebblog' ),
							'class'             => 'flex gap-2 text-sm font-medium',
						)
					);
					?>
				</div>

			<?php else : ?>
				<div class="text-center max-w-3xl mx-auto">
					<p class="text-secondary text-lg mb-8">
						<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'gowebblog' ); ?>
					</p>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

<?php
get_footer();
