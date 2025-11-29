<?php get_header(); ?>

<main class="container">
    
    <?php if (is_post_type_archive('project')) : ?>
        
        <header class="page-header">
            <?php
            $tag = get_queried_object();
            if ($tag) :
            ?>
                <h1><?php printf(__('Projects tagged: %s', 'dev-projects'), '<span style="color: var(--accent-color);">' . esc_html($tag->name) . '</span>'); ?></h1>
            <?php else : ?>
                <h1><?php _e('All Projects', 'dev-projects'); ?></h1>
            <?php endif; ?>
        </header>
        
        <?php get_template_part('template-parts/project', 'filters'); ?>
        
    <?php elseif (is_tax('project_tag')) : ?>
        
        <header class="page-header">
            <?php
            $tag = get_queried_object();
            if ($tag) :
            ?>
                <h1><?php printf(__('Projects tagged: %s', 'dev-projects'), '<span style="color: var(--accent-color);">' . esc_html($tag->name) . '</span>'); ?></h1>
            <?php endif; ?>
        </header>
        
        <?php get_template_part('template-parts/project', 'filters'); ?>
        
    <?php else : ?>
        
        <header class="page-header">
            <h1><?php the_archive_title(); ?></h1>
        </header>
        
    <?php endif; ?>

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
            <p><?php _e('No projects found. Try adjusting your filters or search terms.', 'dev-projects'); ?></p>
        <?php
        endif;
        
        wp_reset_postdata();
        ?>
    </div>

</main>

<?php get_footer(); ?>