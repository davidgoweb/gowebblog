<?php get_header(); ?>

<main class="container">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div class="breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'dev-projects'); ?></a> / <span style="color: #fff;"><?php _e('Project Details', 'dev-projects'); ?></span>
    </div>

    <?php get_template_part('template-parts/content', 'single'); ?>

    <?php
        // Related projects
        $tags = wp_get_post_terms(get_the_ID(), 'project_tag');
        if ($tags && !is_wp_error($tags)) :
            $tag_ids = wp_list_pluck($tags, 'term_id');
            
            $related_args = array(
                'post_type' => 'project',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'project_tag',
                        'field' => 'term_id',
                        'terms' => $tag_ids,
                        'operator' => 'IN',
                    ),
                ),
            );
            
            $related_query = new WP_Query($related_args);
            
            if ($related_query->have_posts()) :
        ?>
                <div class="grid-header" style="margin-top: 80px;">
                    <h2><?php _e('Related Projects', 'dev-projects'); ?></h2>
                </div>
                
                <div class="projects-grid">
                    <?php
                    while ($related_query->have_posts()) : $related_query->the_post();
                        get_template_part('template-parts/content', 'project');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
        <?php
            endif;
        endif;
        ?>

    <?php endwhile; endif; ?>

    <div class="newsletter-box">
        <h3><?php _e('Did you like this read?', 'dev-projects'); ?></h3>
        <p><?php _e('Join our newsletter and you will get weekly top stories like this delivered to your inbox.', 'dev-projects'); ?></p>
        <div class="input-group">
            <input type="email" placeholder="<?php esc_attr_e('Enter your email...', 'dev-projects'); ?>">
            <button class="btn btn-primary"><?php _e('Subscribe', 'dev-projects'); ?></button>
        </div>
    </div>

</main>

<?php get_footer(); ?>