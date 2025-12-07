<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
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
				<?php
				the_archive_title( '<h1 class="page-title font-heading text-4xl md:text-5xl font-bold">', '</h1>' );
				the_archive_description( '<div class="archive-description text-secondary text-lg mt-4 max-w-3xl mx-auto">', '</div>' );
				?>
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
							'prev_text'         => __( '<i class="fa-solid fa-chevron-left"></i>', 'gowebblog' ),
							'next_text'         => __( '<i class="fa-solid fa-chevron-right"></i>', 'gowebblog' ),
							'screen_reader_text' => __( 'Posts navigation', 'gowebblog' ),
							'class'             => 'gowebblog-pagination',
						)
					);
					?>
				</div>

			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>

<?php
get_footer();