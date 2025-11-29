<article <?php post_class('card'); ?> id="post-<?php the_ID(); ?>">
    <div class="card-header">
        <?php
        $tags = get_the_terms(get_the_ID(), 'project_tag');
        if ($tags && !is_wp_error($tags)) :
            $first_tag = $tags[0];
        ?>
            <span class="tag"><?php echo esc_html($first_tag->name); ?></span>
        <?php endif; ?>
        <div class="card-icon">
            <?php
            // Display icon based on technology or first tag
            $technology = get_post_meta(get_the_ID(), '_technology', true);
            $icon = '💻'; // Default icon
            
            if ($technology) {
                // Simple icon mapping based on technology
                $tech_lower = strtolower($technology);
                if (strpos($tech_lower, 'javascript') !== false || strpos($tech_lower, 'js') !== false) {
                    $icon = '📜';
                } elseif (strpos($tech_lower, 'python') !== false) {
                    $icon = '🐍';
                } elseif (strpos($tech_lower, 'php') !== false) {
                    $icon = '🐘';
                } elseif (strpos($tech_lower, 'react') !== false) {
                    $icon = '⚛️';
                } elseif (strpos($tech_lower, 'vue') !== false) {
                    $icon = '💚';
                } elseif (strpos($tech_lower, 'angular') !== false) {
                    $icon = '🅰️';
                } elseif (strpos($tech_lower, 'wordpress') !== false) {
                    $icon = '📝';
                } elseif (strpos($tech_lower, 'security') !== false) {
                    $icon = '🛡️';
                } elseif (strpos($tech_lower, 'editor') !== false) {
                    $icon = '📝';
                } elseif (strpos($tech_lower, 'cli') !== false) {
                    $icon = '💻';
                }
            }
            echo esc_html($icon);
            ?>
        </div>
    </div>
    
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    
    <div class="card-meta">
        <span><?php echo esc_html($technology); ?></span>
        <span class="dot"></span>
        <span><?php echo get_the_date(); ?></span>
    </div>
    
    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
    
    <div class="card-footer">
        <div class="author">
            <div class="author-img">
                <?php echo get_avatar(get_the_author_meta('ID'), 24); ?>
            </div>
            <span>@<?php echo esc_html(get_the_author_meta('user_login')); ?></span>
        </div>
        <a href="<?php the_permalink(); ?>" class="btn btn-outline" style="padding: 4px 12px; font-size: 0.8rem;"><?php _e('View', 'dev-projects'); ?></a>
    </div>
</article>