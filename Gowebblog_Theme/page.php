<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main py-16">
			<div class="max-w-4xl mx-auto px-6">
				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-content fade-in-section' ); ?>>
						<header class="entry-header mb-12">
							<?php the_title( '<h1 class="entry-title font-heading text-4xl md:text-5xl font-bold mb-8 leading-tight">', '</h1>' ); ?>
							
							<!-- Featured Image -->
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="rounded-2xl overflow-hidden mb-12">
									<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
								</div>
							<?php endif; ?>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php
							the_content();

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gowebblog' ),
									'after'  => '</div>',
								)
							);
							?>
						</div><!-- .entry-content -->

						<?php if ( get_edit_post_link() ) : ?>
							<footer class="entry-footer mt-12 pt-8 border-t border-white/10">
								<?php
								edit_post_link(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post */
											__( 'Edit <span class="screen-reader-text">%s</span>', 'gowebblog' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										get_the_title()
									),
									'<span class="edit-link text-sm text-secondary hover:text-white transition-colors">',
									'</span>'
								);
								?>
							</footer><!-- .entry-footer -->
						<?php endif; ?>
					</article><!-- #post-<?php the_ID(); ?> -->

					<!-- Comments -->
					<?php if ( comments_open() || get_comments_number() ) : ?>
						<div class="mt-16 pt-8 border-t border-white/10">
							<?php comments_template(); ?>
						</div>
					<?php endif; ?>

					<?php
				endwhile; // End of the loop.
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();