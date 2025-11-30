<?php
/**
 * The template for displaying single projects
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
            <div class="max-w-4xl mx-auto px-6">
                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'project-single fade-in-section' ); ?>>
                        <header class="entry-header mb-12">
                            <?php the_title( '<h1 class="entry-title font-heading text-4xl md:text-5xl font-bold mb-6 leading-tight">', '</h1>' ); ?>
                            
                            <!-- Project Meta -->
                            <div class="flex flex-wrap items-center gap-4 text-gray-400 mb-8">
                                <div class="flex items-center gap-2">
                                    <i class="far fa-calendar"></i>
                                    <span><?php echo esc_html( get_the_date() ); ?></span>
                                </div>
                                
                                <?php
                                // Display project categories
                                $categories = get_the_terms( get_the_ID(), 'project-category' );
                                if ( $categories && ! is_wp_error( $categories ) ) : ?>
                                    <div class="flex items-center gap-2">
                                        <i class="far fa-folder"></i>
                                        <div class="flex flex-wrap gap-2">
                                            <?php foreach ( $categories as $category ) : ?>
                                                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="hover:text-primary-color transition-colors">
                                                    <?php echo esc_html( $category->name ); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php
                                // Display project tags
                                $tags = get_the_terms( get_the_ID(), 'project-tag' );
                                if ( $tags && ! is_wp_error( $tags ) ) : ?>
                                    <div class="flex items-center gap-2">
                                        <i class="far fa-tags"></i>
                                        <div class="flex flex-wrap gap-2">
                                            <?php foreach ( $tags as $tag ) : ?>
                                                <a href="<?php echo esc_url( get_term_link( $tag ) ); ?>" class="hover:text-primary-color transition-colors">
                                                    #<?php echo esc_html( $tag->name ); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
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
                        
                        <!-- Project Links -->
                        <div class="project-links mt-12 pt-8 border-t border-white/10">
                            <h3 class="text-xl font-bold mb-6"><?php esc_html_e( 'Project Links', 'gowebblog' ); ?></h3>
                            <div class="flex flex-wrap gap-4">
                                <?php
                                $repo_url = get_post_meta( get_the_ID(), '_project_repo_url', true );
                                $demo_url = get_post_meta( get_the_ID(), '_project_demo_url', true );
                                
                                if ( $repo_url ) : ?>
                                    <a href="<?php echo esc_url( $repo_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 rounded-lg text-white hover:bg-white/20 transition-colors">
                                        <i class="fab fa-github"></i>
                                        <span><?php esc_html_e( 'View Repository', 'gowebblog' ); ?></span>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ( $demo_url ) : ?>
                                    <a href="<?php echo esc_url( $demo_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-color rounded-lg text-dark-color hover:opacity-90 transition-opacity">
                                        <i class="fas fa-external-link-alt"></i>
                                        <span><?php esc_html_e( 'Live Demo', 'gowebblog' ); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                    // Previous/next project navigation.
                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'gowebblog' ) . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'gowebblog' ) . '</span> <span class="nav-title">%title</span>',
                            'in_same_term'         => true,
                            'taxonomy'             => 'project-category',
                            'screen_reader_text' => __( 'Project navigation', 'gowebblog' ),
                        )
                    );
                    ?>

                <?php endwhile; // End of the loop. ?>
            </div>
        </main>
    </div>

<?php
get_footer();