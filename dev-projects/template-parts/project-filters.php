<div class="project-filters">
    <h4><?php _e('Filter by Tags:', 'dev-projects'); ?></h4>
    <div class="filter-tags">
        <span class="filter-tag active" data-tag="all">
            <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" style="color: inherit; text-decoration: none;">
                <?php _e('All', 'dev-projects'); ?>
            </a>
        </span>
        
        <?php
        $tags = get_terms(array(
            'taxonomy' => 'project_tag',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC'
        ));
        
        if ($tags && !is_wp_error($tags)) :
            foreach ($tags as $tag) :
        ?>
            <span class="filter-tag" data-tag="<?php echo esc_attr($tag->slug); ?>">
                <a href="<?php echo esc_url(get_term_link($tag)); ?>" style="color: inherit; text-decoration: none;">
                    <?php echo esc_html($tag->name); ?>
                </a>
            </span>
        <?php
            endforeach;
        endif;
        ?>
    </div>
    
    <div class="filter-dropdown">
        <label for="difficulty-filter"><?php _e('Difficulty:', 'dev-projects'); ?></label>
        <select id="difficulty-filter" class="difficulty-filter">
            <option value=""><?php _e('All Levels', 'dev-projects'); ?></option>
            <option value="beginner"><?php _e('Beginner', 'dev-projects'); ?></option>
            <option value="intermediate"><?php _e('Intermediate', 'dev-projects'); ?></option>
            <option value="advanced"><?php _e('Advanced', 'dev-projects'); ?></option>
        </select>
    </div>
</div>