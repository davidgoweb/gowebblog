<?php get_header(); ?>

<main class="container">
    
    <section class="hero">
        <h1><?php _e('Discover Amazing<br>Open-source Projects', 'dev-projects'); ?></h1>
        <p><?php 
            $description = get_bloginfo('description');
            if ($description) {
                echo esc_html($description);
            } else {
                _e('Curating the best open-source projects, hidden gems, and innovative tools that are shaping the future of development.', 'dev-projects');
            }
        ?></p>
        
        <?php get_template_part('template-parts/search', 'form'); ?>
        
        <div class="json-block">
            <div>{</div>
            <div style="padding-left: 20px;">
                <span class="key">"mission"</span>: <span class="string">"showcase_amazing_projects"</span>,
            </div>
            <div style="padding-left: 20px;">
                <span class="key">"focus"</span>: [<span class="string">"innovation"</span>, <span class="string">"quality"</span>],
            </div>
            <div style="padding-left: 20px;">
                <span class="key">"status"</span>: <span class="string">"actively_curated"</span>
            </div>
            <div>}</div>
        </div>

        <div class="stats">
            <?php
            $stats = dev_projects_get_stats();
            ?>
            <div class="stat-item">
                <span class="stat-num"><?php echo esc_html($stats['total_projects']); ?>+</span>
                <span class="stat-label"><?php _e('Projects', 'dev-projects'); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-num">100%</span>
                <span class="stat-label"><?php _e('Open Source', 'dev-projects'); ?></span>
            </div>
            <div class="stat-item">
                <span class="stat-num">∞</span>
                <span class="stat-label"><?php _e('Possibilities', 'dev-projects'); ?></span>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/project', 'filters'); ?>

    <div class="grid-header">
        <h2><?php _e('Featured Projects', 'dev-projects'); ?></h2>
        <div style="display:flex; gap:10px;">
            <span class="tag" style="background:var(--text-main); color:black;"><?php _e('Latest', 'dev-projects'); ?></span>
            <span class="tag"><?php _e('Trending', 'dev-projects'); ?></span>
        </div>
    </div>

    <div class="projects-grid" id="projects-container">
        <?php
        $args = array(
            'post_type' => 'project',
            'post_status' => 'publish',
            'posts_per_page' => 12,
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
        );
        
        $query = new WP_Query($args);
        
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                get_template_part('template-parts/content', 'project');
            endwhile;
            
            // Pagination
            $total_pages = $query->max_num_pages;
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

    <div class="grid-header" style="margin-top: 60px;">
        <h2><?php _e('Sponsored Project', 'dev-projects'); ?></h2>
    </div>
    
    <div class="projects-grid">
        <article class="card" style="border-color: var(--accent-color); background: rgba(59, 130, 246, 0.05);">
            <div class="card-header">
                <span class="tag" style="background:var(--accent-color); color:white; border:none;"><?php _e('Promoted', 'dev-projects'); ?></span>
            </div>
            <h3 style="color: var(--accent-color);"><?php _e('Showcase Your Project Here', 'dev-projects'); ?></h3>
            <p><?php _e('Get your open-source project in front of thousands of developers. Claim this spot today.', 'dev-projects'); ?></p>
            <div class="card-footer">
                <div class="author"><?php bloginfo('name'); ?></div>
                <a href="#" class="btn btn-primary" style="background: var(--accent-color); color:white;"><?php _e('Sponsor', 'dev-projects'); ?></a>
            </div>
        </article>
    </div>

    <div class="newsletter-box">
        <h3><?php _e('Did you like these projects?', 'dev-projects'); ?></h3>
        <p><?php _e('Join our newsletter and get weekly top stories like this delivered to your inbox.', 'dev-projects'); ?></p>
        <div class="input-group">
            <input type="email" placeholder="<?php esc_attr_e('Enter your email...', 'dev-projects'); ?>">
            <button class="btn btn-primary"><?php _e('Subscribe', 'dev-projects'); ?></button>
        </div>
    </div>

</main>

<?php get_footer(); ?>