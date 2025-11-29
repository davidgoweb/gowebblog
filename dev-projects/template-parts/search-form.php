<div class="search-form">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <label>
            <span class="screen-reader-text"><?php _e('Search for:', 'dev-projects'); ?></span>
            <input type="search" 
                   class="search-field" 
                   placeholder="<?php esc_attr_e('Search projects...', 'dev-projects'); ?>" 
                   value="<?php echo get_search_query(); ?>" 
                   name="s" />
        </label>
        <button type="submit" class="btn btn-primary"><?php _e('Search', 'dev-projects'); ?></button>
    </form>
</div>