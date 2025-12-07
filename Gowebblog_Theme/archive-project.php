<?php
/**
 * The template for displaying archive of projects
 * Uses the portfolio template structure
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
            <div class="max-w-6xl mx-auto px-6">
                <header class="page-header mb-12">
                    <?php
                    the_archive_title( '<h1 class="page-title font-heading text-4xl md:text-5xl font-bold mb-4">', '</h1>' );
                    the_archive_description( '<div class="archive-description text-lg text-gray-400">', '</div>' );
                    ?>
                </header>
                
                <?php if ( have_posts() ) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php
                        // Start the Loop.
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', 'project' );
                        endwhile;
                        ?>
                    </div>

                    <?php
                    // Previous/next page navigation.
                    the_posts_pagination(
                        array(
                            'mid_size'           => 2,
                            'prev_text'          => __( '<i class="fa-solid fa-chevron-left"></i>', 'gowebblog' ),
                            'next_text'          => __( '<i class="fa-solid fa-chevron-right"></i>', 'gowebblog' ),
                            'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'gowebblog' ) . ' </span>',
                            'class'              => 'gowebblog-pagination',
                        )
                    );
                    ?>

                <?php else : ?>
                    <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

<?php
get_footer();