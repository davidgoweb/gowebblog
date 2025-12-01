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
            <div class="max-w-6xl mx-auto px-6">
                <?php
                // Query toolbox items
                $toolbox_query = gowebblog_get_toolbox_items( array(
                    'posts_per_page' => -1,
                ) );
                
                if ( $toolbox_query->have_posts() ) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php
                        while ( $toolbox_query->have_posts() ) :
                            $toolbox_query->the_post();
                            get_template_part( 'template-parts/content', 'toolbox' );
                        endwhile;
                        ?>
                    </div>
                <?php else : ?>
                    <div class="text-center py-12">
                        <p class="text-xl text-gray-400"><?php esc_html_e( 'No toolbox items found.', 'gowebblog' ); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php wp_reset_postdata(); ?>
            </div>
        </main>
    </div>

<?php
get_footer();