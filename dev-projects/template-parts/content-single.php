<article id="post-<?php the_ID(); ?>" <?php post_class('article-container'); ?>>
    <header class="article-header">
        <?php
        $tags = get_the_terms(get_the_ID(), 'project_tag');
        if ($tags && !is_wp_error($tags)) :
            $first_tag = $tags[0];
        ?>
            <div class="tag" style="margin-bottom: 15px; color: var(--accent-color); border-color: rgba(59,130,246,0.2);"><?php echo esc_html($first_tag->name); ?></div>
        <?php endif; ?>
        
        <h1 class="article-title"><?php the_title(); ?></h1>
        
        <div class="article-meta">
            <div class="author-info">
                <div class="author-img">
                    <?php echo get_avatar(get_the_author_meta('ID'), 28); ?>
                </div>
                <span>@<?php echo esc_html(get_the_author_meta('user_login')); ?></span>
            </div>
            <span class="dot"></span>
            <span><?php echo get_the_date(); ?></span>
            <span class="dot"></span>
            <span><?php echo dev_projects_get_post_views(); ?> <?php _e('Impressions', 'dev-projects'); ?></span>
        </div>
    </header>

    <?php if (has_post_thumbnail()) : ?>
    <div class="article-hero-img">
        <?php the_post_thumbnail('full'); ?>
    </div>
    <?php endif; ?>

    <div class="project-links">
        <div>
            <h4 style="color:#fff; margin-bottom:4px;"><?php _e('Ready to try it?', 'dev-projects'); ?></h4>
            <p style="color:var(--text-muted); font-size:0.9rem;"><?php _e('Check out the source code and documentation.', 'dev-projects'); ?></p>
        </div>
        <?php
        $github_url = get_post_meta(get_the_ID(), '_github_url', true);
        $demo_url = get_post_meta(get_the_ID(), '_demo_url', true);
        
        if ($github_url) :
        ?>
            <a href="<?php echo esc_url($github_url); ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261 1.187-.769.599-2.234-.599-2.234v-2.234c-3.338.726-4.033-1.416-4.033-1.416 0-.546.453-1.543 1.237-1.543 2.234 0 3.338.726 4.033 1.416 4.033 1.416 0 4.765-1.589 8.199-3.305 11.387.599.111.793-.261 1.187-.769.599-2.234-.599-2.234v-2.234c-3.338.726-4.033-1.416-4.033-1.416 0-.546.453-1.543 1.237-1.543 2.234 0 3.338.726 4.033 1.416 4.033 1.416 0 4.765-1.589 8.199-3.305 11.387.599.111.793-.261 1.187-.769.599-2.234-.599-2.234z"/></svg>
                <?php _e('View on GitHub', 'dev-projects'); ?>
            </a>
        <?php endif; ?>
        
        <?php if ($demo_url) : ?>
            <a href="<?php echo esc_url($demo_url); ?>" class="btn btn-outline" target="_blank" rel="noopener noreferrer">
                <?php _e('Live Demo', 'dev-projects'); ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="article-content">
        <?php
        the_content();
        
        // Display custom fields
        $technology = get_post_meta(get_the_ID(), '_technology', true);
        $difficulty = get_post_meta(get_the_ID(), '_difficulty', true);
        
        if ($technology || $difficulty) :
        ?>
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 8px; padding: 20px; margin: 30px 0;">
                <h3 style="color: #fff; margin-bottom: 15px;"><?php _e('Project Details', 'dev-projects'); ?></h3>
                
                <?php if ($technology) : ?>
                <p><strong><?php _e('Technology:', 'dev-projects'); ?></strong> <?php echo esc_html($technology); ?></p>
                <?php endif; ?>
                
                <?php if ($difficulty) : ?>
                <p><strong><?php _e('Difficulty:', 'dev-projects'); ?></strong> 
                    <?php
                    $difficulty_labels = array(
                        'beginner' => __('Beginner', 'dev-projects'),
                        'intermediate' => __('Intermediate', 'dev-projects'),
                        'advanced' => __('Advanced', 'dev-projects'),
                    );
                    echo isset($difficulty_labels[$difficulty]) ? esc_html($difficulty_labels[$difficulty]) : esc_html($difficulty);
                    ?>
                </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
        // Display tags
        if ($tags && !is_wp_error($tags) && count($tags) > 1) :
        ?>
            <div style="margin-top: 30px;">
                <h4 style="color: #fff; margin-bottom: 15px;"><?php _e('Tags', 'dev-projects'); ?></h4>
                <div class="filter-tags">
                    <?php foreach ($tags as $tag) : ?>
                        <span class="filter-tag">
                            <a href="<?php echo esc_url(get_term_link($tag)); ?>" style="color: inherit; text-decoration: none;">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (comments_open() || get_comments_number()) : ?>
        <div class="comments-section" style="margin-top: 60px;">
            <?php comments_template(); ?>
        </div>
    <?php endif; ?>
</article>

<?php
/**
 * Get post views (simple implementation)
 */
function dev_projects_get_post_views() {
    $count = get_post_meta(get_the_ID(), '_post_views', true);
    
    if ($count === '') {
        // Set initial views count
        $count = rand(50, 200); // Random initial count for demo
        update_post_meta(get_the_ID(), '_post_views', $count);
    }
    
    return intval($count);
}

/**
 * Increment post views when viewed
 */
function dev_projects_increment_post_views($post_id) {
    $count = get_post_meta($post_id, '_post_views', true);
    $count = intval($count) + 1;
    update_post_meta($post_id, '_post_views', $count);
}
add_action('wp_head', function() {
    if (!is_single() || !get_query_var('p')) {
        return;
    }
    
    $post_id = get_queried_object_id();
    if (!$post_id) {
        return;
    }
    
    // Only increment once per session
    if (!isset($_SESSION['post_viewed_' . $post_id])) {
        dev_projects_increment_post_views($post_id);
        $_SESSION['post_viewed_' . $post_id] = true;
    }
});
?>