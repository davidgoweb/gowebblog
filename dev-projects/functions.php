<?php
/**
 * Dev Projects Theme Functions
 *
 * @package DevProjects
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function dev_projects_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1568, 9999);

    // Register navigation menus.
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary Menu', 'dev-projects'),
            'footer'  => esc_html__('Footer Menu', 'dev-projects'),
        )
    );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        )
    );

    // Add support for core custom logo.
    add_theme_support(
        'custom-logo',
        array(
            'height'               => 100,
            'width'                => 300,
            'flex-width'           => true,
            'flex-height'          => true,
            'unlink-homepage-logo' => true,
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // Add support for custom line height controls.
    add_theme_support('custom-line-height');

    // Add support for link color control.
    add_theme_support('link-color');

    // Add support for experimental cover block spacing.
    add_theme_support('custom-spacing');

    // Set content width.
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'dev_projects_setup');

/**
 * Register widget areas.
 */
function dev_projects_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Footer Widgets', 'dev-projects'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here to appear in your footer.', 'dev-projects'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'dev_projects_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function dev_projects_scripts() {
    // Enqueue main stylesheet.
    wp_enqueue_style(
        'dev-projects-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );

    // Enqueue navigation script.
    wp_enqueue_script(
        'dev-projects-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        wp_get_theme()->get('Version'),
        array(
            'in_footer' => false,
            'strategy'  => 'defer',
        )
    );

    // Enqueue filtering script.
    wp_enqueue_script(
        'dev-projects-filtering',
        get_template_directory_uri() . '/assets/js/filtering.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );

    // Localize filtering script.
    wp_localize_script(
        'dev-projects-filtering',
        'devProjects',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('dev_projects_filter_nonce'),
        )
    );
}
add_action('wp_enqueue_scripts', 'dev_projects_scripts');

/**
 * Register Custom Post Type: Projects
 */
function dev_projects_register_post_type() {
    $labels = array(
        'name'                  => _x('Projects', 'Post type general name', 'dev-projects'),
        'singular_name'         => _x('Project', 'Post type singular name', 'dev-projects'),
        'menu_name'             => _x('Projects', 'Admin Menu text', 'dev-projects'),
        'name_admin_bar'         => _x('Project', 'Add New on Toolbar', 'dev-projects'),
        'add_new'               => __('Add New', 'dev-projects'),
        'add_new_item'          => __('Add New Project', 'dev-projects'),
        'new_item'              => __('New Project', 'dev-projects'),
        'edit_item'             => __('Edit Project', 'dev-projects'),
        'view_item'             => __('View Project', 'dev-projects'),
        'all_items'             => __('All Projects', 'dev-projects'),
        'search_items'           => __('Search Projects', 'dev-projects'),
        'parent_item_colon'     => __('Parent Project:', 'dev-projects'),
        'not_found'             => __('No projects found.', 'dev-projects'),
        'not_found_in_trash'  => __('No projects found in Trash.', 'dev-projects'),
        'featured_image'        => _x('Project Cover Image', 'Overrides the "Featured Image" phrase for this post type.', 'dev-projects'),
        'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase for this post type.', 'dev-projects'),
        'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase for this post type.', 'dev-projects'),
        'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase for this post type.', 'dev-projects'),
        'archives'              => _x('Project archives', 'The post type archive label used in nav menus.', 'dev-projects'),
        'insert_into_item'      => _x('Insert into project', 'Overrides the "Insert into post" phrase', 'dev-projects'),
        'uploaded_to_this_item' => _x('Uploaded to this project', 'Overrides the "Uploaded to this post" phrase', 'dev-projects'),
        'filter_items_list'     => _x('Filter projects list', 'Screen reader text for the filter links heading on the post type listing screen.', 'dev-projects'),
        'items_list_navigation' => _x('Projects list navigation', 'Screen reader text for the pagination heading on the post type listing screen.', 'dev-projects'),
        'items_list'            => _x('Projects list', 'Screen reader text for the items list heading on the post type listing screen.', 'dev-projects'),
    );

    $args = array(
        'label'                 => __('Projects', 'dev-projects'),
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'project'),
        'capability_type'        => 'post',
        'hierarchical'           => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'author'),
        'show_in_rest'          => true,
        'rest_base'             => 'projects',
        'rest_controller_class'   => 'WP_REST_Posts_Controller',
    );

    register_post_type('project', $args);
}
add_action('init', 'dev_projects_register_post_type');

/**
 * Register Custom Taxonomy: Project Tags
 */
function dev_projects_register_taxonomy() {
    $labels = array(
        'name'              => _x('Project Tags', 'taxonomy general name', 'dev-projects'),
        'singular_name'     => _x('Project Tag', 'taxonomy singular name', 'dev-projects'),
        'search_items'      => __('Search Project Tags', 'dev-projects'),
        'all_items'         => __('All Project Tags', 'dev-projects'),
        'parent_item'       => __('Parent Project Tag', 'dev-projects'),
        'parent_item_colon' => __('Parent Project Tag:', 'dev-projects'),
        'edit_item'         => __('Edit Project Tag', 'dev-projects'),
        'update_item'       => __('Update Project Tag', 'dev-projects'),
        'add_new_item'      => __('Add New Project Tag', 'dev-projects'),
        'new_item_name'     => __('New Project Tag Name', 'dev-projects'),
        'menu_name'         => __('Project Tags', 'dev-projects'),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column'  => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'project-tag'),
        'show_in_rest'      => true,
    );

    register_taxonomy('project_tag', array('project'), $args);
}
add_action('init', 'dev_projects_register_taxonomy');

/**
 * Add custom meta boxes for projects
 */
function dev_projects_add_meta_boxes() {
    add_meta_box(
        'project_details',
        __('Project Details', 'dev-projects'),
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'dev_projects_add_meta_boxes');

/**
 * Display custom meta box content
 */
function dev_projects_meta_box_callback($post) {
    wp_nonce_field('dev_projects_save_meta_data', 'dev_projects_meta_box_nonce');
    
    $github_url = get_post_meta($post->ID, '_github_url', true);
    $demo_url = get_post_meta($post->ID, '_demo_url', true);
    $technology = get_post_meta($post->ID, '_technology', true);
    $difficulty = get_post_meta($post->ID, '_difficulty', true);
    
    echo '<div class="project-meta-fields">';
    echo '<div class="form-field">';
    echo '<label for="github_url">' . __('GitHub URL', 'dev-projects') . '</label>';
    echo '<input type="url" id="github_url" name="github_url" value="' . esc_attr($github_url) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="form-field">';
    echo '<label for="demo_url">' . __('Demo URL', 'dev-projects') . '</label>';
    echo '<input type="url" id="demo_url" name="demo_url" value="' . esc_attr($demo_url) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="form-field">';
    echo '<label for="technology">' . __('Technology', 'dev-projects') . '</label>';
    echo '<input type="text" id="technology" name="technology" value="' . esc_attr($technology) . '" size="25" />';
    echo '</div>';
    
    echo '<div class="form-field">';
    echo '<label for="difficulty">' . __('Difficulty', 'dev-projects') . '</label>';
    echo '<select id="difficulty" name="difficulty">';
    echo '<option value="" ' . selected($difficulty, '', false) . '>' . __('Select Difficulty', 'dev-projects') . '</option>';
    echo '<option value="beginner" ' . selected($difficulty, 'beginner', false) . '>' . __('Beginner', 'dev-projects') . '</option>';
    echo '<option value="intermediate" ' . selected($difficulty, 'intermediate', false) . '>' . __('Intermediate', 'dev-projects') . '</option>';
    echo '<option value="advanced" ' . selected($difficulty, 'advanced', false) . '>' . __('Advanced', 'dev-projects') . '</option>';
    echo '</select>';
    echo '</div>';
    echo '</div>';
}

/**
 * Save custom meta data
 */
function dev_projects_save_meta_data($post_id) {
    if (!isset($_POST['dev_projects_meta_box_nonce']) || !wp_verify_nonce($_POST['dev_projects_meta_box_nonce'], 'dev_projects_save_meta_data')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('github_url', 'demo_url', 'technology', 'difficulty');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        } else {
            delete_post_meta($post_id, '_' . $field);
        }
    }
}
add_action('save_post', 'dev_projects_save_meta_data');

/**
 * AJAX filter projects
 */
function dev_projects_filter_projects() {
    check_ajax_referer('dev_projects_filter_nonce', 'nonce');
    
    $tag = isset($_POST['tag']) ? sanitize_text_field($_POST['tag']) : '';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    
    $args = array(
        'post_type' => 'project',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    
    if (!empty($tag)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'project_tag',
                'field'    => 'slug',
                'terms'    => $tag,
            ),
        );
    }
    
    if (!empty($search)) {
        $args['s'] = $search;
    }
    
    $query = new WP_Query($args);
    
    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'project');
        }
    } else {
        echo '<p>' . __('No projects found.', 'dev-projects') . '</p>';
    }
    $output = ob_get_clean();
    
    wp_reset_postdata();
    
    wp_send_json_success(array('html' => $output));
}
add_action('wp_ajax_dev_projects_filter', 'dev_projects_filter_projects');
add_action('wp_ajax_nopriv_dev_projects_filter', 'dev_projects_filter_projects');

/**
 * Get project statistics
 */
function dev_projects_get_stats() {
    $total_projects = wp_count_posts(array('post_type' => 'project', 'post_status' => 'publish'));
    $total_tags = wp_count_terms('project_tag');
    
    return array(
        'total_projects' => $total_projects->publish,
        'total_tags' => $total_tags,
    );
}

/**
 * Custom excerpt length
 */
function dev_projects_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'dev_projects_custom_excerpt_length');

/**
 * Custom excerpt more
 */
function dev_projects_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'dev_projects_custom_excerpt_more');

/**
 * Add CSS for admin meta boxes
 */
function dev_projects_admin_css() {
    echo '<style>
        .project-meta-fields .form-field {
            margin-bottom: 15px;
        }
        .project-meta-fields label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .project-meta-fields input,
        .project-meta-fields select {
            width: 100%;
            max-width: 400px;
        }
    </style>';
}
add_action('admin_head', 'dev_projects_admin_css');