<?php get_header(); ?>

<main class="container">
    
    <header class="page-header">
        <?php
        $search_query = get_search_query();
        if ($search_query) :
        ?>
            <h1><?php printf(__('Search Results for: %s', 'dev-projects'), '<span style="color: var(--accent-color);">' . esc_html($search_query) . '</span>'); ?></h1>
        <?php else : ?>
            <h1><?php _e('Search Projects', 'dev-projects'); ?></h1>
        <?php endif; ?>
    </header>
    
    <?php get_template_part('template-parts/search', 'form'); ?>
    
    <div class="projects-grid" id="projects-container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', 'project');
            endwhile;
            
            // Pagination
            $total_pages = $GLOBALS['wp_query']->max_num_pages;
            if ($total_pages > 1) :
                $current_page = max(1, get_query_var('paged'));
                ?>
                <div class="pagination">
                    <?php
                    $args = array(
                        'base' => add_query_arg('paged', '%#%', esc_url(get_pagenum_link(1))),
                        'format' => '?page=%#%',
                        'current' => $current_page,
                        'total' => $total_pages,
                        'prev_text' => __('&laquo; Previous', 'dev-projects'),
                        'next_text' => __('Next &raquo;', 'dev-projects'),
                        'type' => 'array',
                    );
                    
                    $args = apply_filters('dev_projects_pagination_args', $args);
                    
                    echo paginate_links($args);
                    ?>
                </div>
            <?php
            endif;
        else :
        ?>
            <div class="no-results">
                <h3><?php _e('No projects found', 'dev-projects'); ?></h3>
                <p><?php _e('Sorry, but nothing matched your search criteria. Please try again with different keywords.', 'dev-projects'); ?></p>
                
                <div class="search-suggestions">
                    <h4><?php _e('Search Suggestions:', 'dev-projects'); ?></h4>
                    <ul>
                        <li><?php _e('Try different keywords', 'dev-projects'); ?></li>
                        <li><?php _e('Check for spelling mistakes', 'dev-projects'); ?></li>
                        <li><?php _e('Use more general terms', 'dev-projects'); ?></li>
                        <li><?php _e('Browse by tags instead', 'dev-projects'); ?></li>
                    </ul>
                </div>
                
                <div style="margin-top: 30px;">
                    <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="btn btn-primary">
                        <?php _e('Browse All Projects', 'dev-projects'); ?>
                    </a>
                </div>
            </div>
        <?php
        endif;
        
        wp_reset_postdata();
        ?>
    </div>

</main>

<?php get_footer(); ?>