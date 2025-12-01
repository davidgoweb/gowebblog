<?php
/**
 * Template part for displaying toolbox item cards
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gowebblog
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'toolbox-card bg-card-color rounded-xl overflow-hidden border border-white/10 hover:border-white/20 transition-all duration-300 fade-in-section' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="aspect-video overflow-hidden">
            <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover transition-transform duration-300 hover:scale-105' ) ); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="p-6">
        <header class="entry-header mb-4">
            <?php
            the_title( '<h2 class="entry-title font-heading text-xl font-bold mb-2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            
            // Display toolbox categories
            $categories = get_the_terms( get_the_ID(), 'toolbox-category' );
            if ( $categories && ! is_wp_error( $categories ) ) {
                echo '<div class="flex flex-wrap gap-2 mb-3">';
                foreach ( $categories as $category ) {
                    echo '<a href="' . esc_url( get_term_link( $category ) ) . '" class="text-xs px-2 py-1 bg-white/10 rounded-full text-white/80 hover:bg-white/20 transition-colors">' . esc_html( $category->name ) . '</a>';
                }
                echo '</div>';
            }
            ?>
        </header>

        <div class="entry-summary text-gray-300 mb-6">
            <?php the_excerpt(); ?>
        </div>

        <div class="toolbox-links flex gap-4">
            <?php
            $repo_url = get_post_meta( get_the_ID(), '_toolbox_repo_url', true );
            $demo_url = get_post_meta( get_the_ID(), '_toolbox_demo_url', true );
            
            if ( $repo_url ) : ?>
                <a href="<?php echo esc_url( $repo_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 rounded-lg text-sm text-white hover:bg-white/20 transition-colors">
                    <i class="fab fa-github"></i>
                    <span><?php esc_html_e( 'Repository', 'gowebblog' ); ?></span>
                </a>
            <?php endif; ?>
            
            <?php if ( $demo_url ) : ?>
                <a href="<?php echo esc_url( $demo_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-color rounded-lg text-sm text-dark-color hover:opacity-90 transition-opacity">
                    <i class="fas fa-external-link-alt"></i>
                    <span><?php esc_html_e( 'Live Demo', 'gowebblog' ); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <div class="mt-4">
            <a href="<?php the_permalink(); ?>" class="text-primary-color hover:underline text-sm font-medium">
                <?php esc_html_e( 'View Details', 'gowebblog' ); ?> <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</article>