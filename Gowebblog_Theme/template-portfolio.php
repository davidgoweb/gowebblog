<?php
/**
 * Template Name: Portfolio Template
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
                        </header>

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
                        </div>
                    </article>

                    <?php
                endwhile; // End of the loop.
                ?>
            </div>
        </main>
    </div>

<?php
get_footer();