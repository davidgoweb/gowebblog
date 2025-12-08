<?php
/**
 * The template for displaying archive of toolbox items
 *
 * Uses a portfolio template structure with modern design
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
            <div class="max-w-7xl mx-auto px-6">
                <!-- Archive Header with SEO optimization -->
                <header class="page-header mb-16 fade-in-section">
                    <!-- Breadcrumb for better navigation -->
                    <nav class="flex items-center text-sm text-secondary mb-6" aria-label="<?php esc_attr_e( 'Breadcrumb', 'gowebblog' ); ?>">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors">
                            <i class="fa-solid fa-home mr-2"></i>
                            <?php esc_html_e( 'Home', 'gowebblog' ); ?>
                        </a>
                        <i class="fa-solid fa-chevron-right mx-2 text-xs"></i>
                        <span class="font-medium"><?php esc_html_e( 'Toolbox', 'gowebblog' ); ?></span>
                    </nav>
                    
                    <?php
                    $archive_title = '';
                    $archive_description = '';
                    
                    // Check if we're viewing a category
                    if ( is_tax() ) {
                        $queried_object = get_queried_object();
                        if ( $queried_object ) {
                            $archive_title = sprintf(
                                /* translators: %s: category name */
                                esc_html__( 'Category: %s', 'gowebblog' ),
                                '<span class="text-primary">' . esc_html( $queried_object->name ) . '</span>'
                            );
                            $archive_description = sprintf(
                                /* translators: %s: category description */
                                esc_html__( 'Browse all tools and utilities in the %s category.', 'gowebblog' ),
                                esc_html( $queried_object->description ? $queried_object->description : $queried_object->name )
                            );
                        }
                    } elseif ( is_tag() ) {
                        $archive_title = esc_html__( 'Tag Archive', 'gowebblog' );
                        $archive_description = esc_html__( 'Browse all tools and utilities tagged with specific keywords.', 'gowebblog' );
                    } else {
                        $archive_title = esc_html__( 'Toolbox Archive', 'gowebblog' );
                        $archive_description = esc_html__( 'Explore my complete collection of tools, utilities, and experiments built with modern technologies.', 'gowebblog' );
                    }
                    
                    // SEO-friendly archive title and description
                    the_archive_title( '<h1 class="page-title font-heading text-4xl md:text-5xl font-bold mb-4">' . $archive_title . '</h1>' );
                    the_archive_description( '<div class="archive-description text-lg text-gray-300 max-w-3xl">' . $archive_description . '</div>' );
                    ?>
                </header>
                
                <!-- Filter Section for Categories and Tags -->
                <div class="mb-12 fade-in-section">
                    <div class="flex flex-wrap gap-4 justify-center">
                        <?php
                        // Display category filter
                        $categories = get_terms( array(
                            'taxonomy' => 'toolbox-category',
                            'orderby' => 'name',
                            'hide_empty' => false,
                        ) );
                        
                        if ( ! empty( $categories ) && ! is_tax() ) : ?>
                            <div class="category-filter">
                                <button class="category-filter-btn <?php echo is_tax() && get_queried_object() && get_queried_object()->term_id === $categories[0]->term_id ? 'active' : ''; ?>" 
                                        onclick="location.href='<?php echo esc_url( get_term_link( $categories[0] ) ); ?>'">
                                    <?php echo esc_html( $categories[0]->name ); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        // Display tag filter
                        $tags = get_terms( array(
                            'taxonomy' => 'toolbox-tag',
                            'orderby' => 'name',
                            'hide_empty' => false,
                        ) );
                        
                        if ( ! empty( $tags ) && ! is_tag() ) : ?>
                            <div class="tag-filter">
                                <button class="tag-filter-btn <?php echo is_tag() && get_queried_object() && get_queried_object()->term_id === $tags[0]->term_id ? 'active' : ''; ?>" 
                                        onclick="location.href='<?php echo esc_url( get_term_link( $tags[0] ) ); ?>'">
                                    #<?php echo esc_html( $tags[0]->name ); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( ! empty( $categories ) || ! empty( $tags ) ) : ?>
                            <div class="filter-divider">
                                <span class="text-secondary text-sm"><?php esc_html_e( 'or', 'gowebblog' ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if ( have_posts() ) : ?>
                    <!-- Modern Grid Layout -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-16">
                        <?php
                            // Start the Loop.
                            while ( have_posts() ) :
                                the_post();
                                ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'toolbox-card group fade-in-section' ); ?>>
                                    <!-- Card Container -->
                                    <div class="relative h-full flex flex-col">
                                        <!-- Image Container with 2:1 aspect ratio -->
                                        <div class="relative aspect-[2/1] overflow-hidden rounded-t-2xl bg-gradient-to-br from-card to-darker border border-white/10">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <a href="<?php the_permalink(); ?>" class="block w-full h-full" aria-label="<?php echo esc_attr( sprintf( __( 'View details for %s', 'gowebblog' ), get_the_title() ); ?>">
                                                    <img src="<?php echo esc_url( get_the_post_thumbnail_url( null, 'medium_large' ) ); ?>"
                                                         alt="<?php echo esc_attr( get_the_title() ); ?>"
                                                         class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105 group-hover:opacity-90"
                                                         loading="lazy">
                                            </a>
                                            <?php else : ?>
                                                <?php
                                                // Try to get GitHub image directly if no featured image
                                                $github_url = gowebblog_get_toolbox_repo_url( get_the_ID() );
                                                if ( $github_url && strpos( $github_url, 'github.com' ) !== false ) :
                                                    // Check if we have a cached GitHub image
                                                    $image_url = get_transient( 'github_image_url_' . get_the_ID() );
                                                    if ( ! $image_url ) :
                                                        // Try to get GitHub image directly
                                                        $response = wp_remote_get( $github_url );
                                                        if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) :
                                                            $html = wp_remote_retrieve_body( $response );
                                                            if ( preg_match( '/<meta property="og:image" content="([^"]+)"/', $html, $matches ) ) :
                                                                $image_url = $matches[1];
                                                                // Cache image URL for 1 hour
                                                                set_transient( 'github_image_url_' . get_the_ID(), $image_url, HOUR_IN_SECONDS );
                                                            endif;
                                                        endif;
                                                    endif;
                                                    
                                                    if ( $image_url ) : ?>
                                                        <a href="<?php the_permalink(); ?>" class="block w-full h-full" aria-label="<?php echo esc_attr( sprintf( __( 'View details for %s', 'gowebblog' ), get_the_title() ); ?>">
                                                            <img src="<?php echo esc_url( $image_url ); ?>" 
                                                                 alt="<?php echo esc_attr( get_the_title() ); ?> - GitHub Repository Image" 
                                                                 class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105 group-hover:opacity-90"
                                                                 loading="lazy">
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="<?php the_permalink(); ?>" class="block w-full h-full" aria-label="<?php echo esc_attr( sprintf( __( 'View details for %s', 'gowebblog' ), get_the_title() ); ?>">
                                                            <div class="w-full h-full flex items-center justify-center">
                                                                <div class="text-center p-8">
                                                                    <i class="fab fa-github text-4xl text-white/20 mb-4"></i>
                                                                    <p class="text-white/40 text-sm"><?php echo esc_html( get_the_title() ); ?></p>
                                                                </div>
                                                            </a>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <a href="<?php the_permalink(); ?>" class="block w-full h-full" aria-label="<?php echo esc_attr( sprintf( __( 'View details for %s', 'gowebblog' ), get_the_title() ); ?>">
                                                        <div class="w-full h-full flex items-center justify-center">
                                                            <div class="text-center p-8">
                                                                <i class="fas fa-code text-4xl text-white/20 mb-4"></i>
                                                                <p class="text-white/40 text-sm"><?php echo esc_html( get_the_title() ); ?></p>
                                                            </div>
                                                        </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <!-- Overlay Icons -->
                                            <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <?php
                                                $repo_url = gowebblog_get_toolbox_repo_url( get_the_ID() );
                                                $demo_url = gowebblog_get_toolbox_demo_url( get_the_ID() );
                                                
                                                if ( $repo_url ) : ?>
                                                    <div class="w-8 h-8 rounded-full bg-black/60 backdrop-blur-sm flex items-center justify-center" title="<?php esc_attr_e( 'GitHub Repository', 'gowebblog' ); ?>">
                                                        <i class="fab fa-github text-xs text-white"></i>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if ( $demo_url ) : ?>
                                                    <div class="w-8 h-8 rounded-full bg-black/60 backdrop-blur-sm flex items-center justify-center" title="<?php esc_attr_e( 'Live Demo', 'gowebblog' ); ?>">
                                                        <i class="fas fa-globe text-xs text-white"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <!-- Content Area -->
                                        <div class="bg-card/80 backdrop-blur-sm border border-white/10 border-t-0 rounded-b-2xl p-6 flex-1 flex flex-col">
                                            <!-- Category Badge -->
                                            <?php
                                            $categories = get_the_terms( get_the_ID(), 'toolbox-category' );
                                            if ( $categories && ! is_wp_error( $categories ) ) : ?>
                                                <div class="mb-3">
                                                    <span class="text-xs px-3 py-1 bg-primary/20 text-primary rounded-full font-medium">
                                                        <?php echo esc_html( $categories[0]->name ); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <!-- Title -->
                                            <h2 class="font-heading text-lg font-bold mb-3 line-clamp-2 flex-1">
                                                <a href="<?php the_permalink(); ?>" class="text-white hover:text-primary transition-colors duration-300" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>
                                            
                                            <!-- Tags -->
                                            <?php
                                            $tags = get_the_terms( get_the_ID(), 'toolbox-tag' );
                                            if ( $tags && ! is_wp_error( $tags ) ) : ?>
                                                <div class="flex flex-wrap gap-2 mb-4">
                                                    <?php foreach ( $tags as $tag ) : ?>
                                                        <span class="text-xs px-2 py-1 bg-white/10 rounded-full text-white/70 hover:bg-white/20 transition-colors">
                                                            #<?php echo esc_html( $tag->name ); ?>
                                                        </span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <!-- Excerpt -->
                                            <div class="text-secondary text-sm leading-relaxed mb-4 line-clamp-3">
                                                <?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?>
                                            </div>
                                            
                                            <!-- Meta Information -->
                                            <div class="flex items-center text-xs text-secondary mb-4">
                                                <span class="flex items-center mr-4">
                                                    <i class="far fa-calendar mr-2"></i>
                                                    <?php echo esc_html( get_the_date() ); ?>
                                                </span>
                                                <span class="flex items-center">
                                                    <i class="far fa-clock mr-2"></i>
                                                    <?php echo esc_html( human_time_diff( get_the_time(), current_time( 'timestamp' ) ) ); ?>
                                                </span>
                                            </div>
                                            
                                            <!-- View Details Button -->
                                            <div class="mt-auto">
                                                <a href="<?php the_permalink(); ?>" 
                                                   class="inline-flex items-center justify-center w-full py-2 px-4 bg-gradient-to-r from-primary/20 to-primary/10 hover:from-primary/30 hover:to-primary/20 text-primary rounded-lg transition-all duration-300 text-sm font-medium" 
                                                   rel="bookmark"
                                                   aria-label="<?php echo esc_attr( sprintf( __( 'View full details for %s', 'gowebblog' ), get_the_title() ); ?>">
                                                    <?php esc_html_e( 'View Details', 'gowebblog' ); ?>
                                                    <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            endwhile;
                            ?>
                        </div>
                    
                    <!-- Enhanced Pagination -->
                    <div class="mt-16 flex justify-center fade-in-section">
                        <?php
                        the_posts_pagination(
                            array(
                                'mid_size'           => 2,
                                'prev_text'          => __( '<span class="flex items-center"><i class="fa-solid fa-chevron-left mr-2"></i>' . __( 'Previous', 'gowebblog' ) . '</span>', 'gowebblog' ),
                                'next_text'          => __( '<span class="flex items-center">' . __( 'Next', 'gowebblog' ) . '<i class="fa-solid fa-chevron-right ml-2"></i></span>', 'gowebblog' ),
                                'screen_reader_text' => __( 'Posts navigation', 'gowebblog' ),
                                'class'              => 'gowebblog-pagination',
                                'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'gowebblog' ) . ' </span>',
                                'aria_current' => __( 'Current page', 'gowebblog' ),
                            )
                        );
                        ?>
                    </div>
                    
                    <!-- SEO Schema for Toolbox Items -->
                    <script type="application/ld+json">
                    {
                        "@context": "https://schema.org",
                        "@type": "CollectionPage",
                        "name": "<?php echo esc_js( is_tax() ? get_queried_object()->name : esc_html__( 'Toolbox', 'gowebblog' ) ); ?>",
                        "description": "<?php echo esc_js( is_tax() ? get_queried_object()->description : esc_html__( 'Collection of tools and utilities built with modern technologies', 'gowebblog' ) ); ?>",
                        "url": "<?php echo esc_url( get_pagenum_link() ); ?>",
                        "mainEntity": {
                            "@type": "ItemList",
                            "itemListElement": [
                                <?php
                                // Reset the post data
                                rewind_posts();
                                $post_count = 0;
                                while ( have_posts() ) : the_post();
                                    if ( $post_count > 0 ) echo ',';
                                    $post_count++;
                                    ?>
                                    {
                                        "@type": "ListItem",
                                        "position": <?php echo $post_count; ?>,
                                        "name": "<?php echo esc_js( get_the_title() ); ?>",
                                        "description": "<?php echo esc_js( wp_trim_words( get_the_excerpt(), 30 ) ); ?>",
                                        "url": "<?php echo esc_js( get_the_permalink() ); ?>",
                                        "image": "<?php echo esc_js( has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'medium_large' ) : '' ); ?>",
                                        "datePublished": "<?php echo esc_js( get_the_date( 'c' ) ); ?>",
                                        "category": "<?php 
                                            $categories = get_the_terms( get_the_ID(), 'toolbox-category' );
                                            echo esc_js( $categories && ! is_wp_error( $categories ) ? $categories[0]->name : '' ); 
                                        ?>"
                                    }
                                <?php endwhile; ?>
                            ]
                        }
                    }
                    </script>
                    
                <?php else : ?>
                    <!-- No Results Message -->
                    <div class="text-center py-16 fade-in-section">
                        <div class="max-w-2xl mx-auto">
                            <div class="bg-card/50 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                                <i class="fas fa-search text-4xl text-white/20 mb-4"></i>
                                <h3 class="text-xl font-bold mb-4"><?php esc_html_e( 'No tools found', 'gowebblog' ); ?></h3>
                                <p class="text-secondary mb-6"><?php esc_html_e( 'Sorry, no tools matched your criteria. Try browsing different categories or check back later.', 'gowebblog' ); ?></p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="<?php echo esc_url( get_post_type_archive_link( 'toolbox' ) ); ?>" class="flex-1 py-2 px-4 bg-primary text-white rounded-lg text-center font-medium hover:bg-primary/80 transition-colors">
                                        <?php esc_html_e( 'Browse All Tools', 'gowebblog' ); ?>
                                    </a>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex-1 py-2 px-4 bg-card border border-white/20 text-white rounded-lg text-center font-medium hover:bg-white/10 transition-colors">
                                        <?php esc_html_e( 'Back to Home', 'gowebblog' ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

<?php
get_footer();