<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="container nav-inner">
        <?php
        if (function_exists('the_custom_logo')) :
            the_custom_logo();
        endif;
        ?>
        <div class="logo">
            <?php
            if (function_exists('the_custom_logo') && has_custom_logo()) :
                // Custom logo is already displayed above
            else :
            ?>
                <div style="width:24px;height:24px;background:#fff;border-radius:4px;"></div>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>
        </div>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-links',
                    'container'      => false,
                    'fallback_cb'    => 'dev_projects_primary_menu_fallback',
                )
            );
            ?>
        </nav>
        
        <a href="#" class="btn btn-primary" style="font-size: 0.8rem;"><?php _e('Newsletter', 'dev-projects'); ?></a>
    </div>
</header>

<?php
/**
 * Fallback menu for primary navigation
 */
function dev_projects_primary_menu_fallback() {
    echo '<ul class="nav-links">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'dev-projects') . '</a></li>';
    
    // Add project archive link
    $project_archive_link = get_post_type_archive_link('project');
    if ($project_archive_link) {
        echo '<li><a href="' . esc_url($project_archive_link) . '">' . __('Projects', 'dev-projects') . '</a></li>';
    }
    
    // Add bookmarks page if it exists
    $bookmarks_page = get_page_by_path('bookmarks');
    if ($bookmarks_page) {
        echo '<li><a href="' . esc_url(get_permalink($bookmarks_page->ID)) . '">' . __('Bookmarks', 'dev-projects') . '</a></li>';
    }
    
    // Add sponsors page if it exists
    $sponsors_page = get_page_by_path('sponsors');
    if ($sponsors_page) {
        echo '<li><a href="' . esc_url(get_permalink($sponsors_page->ID)) . '">' . __('Sponsors', 'dev-projects') . '</a></li>';
    }
    
    echo '</ul>';
}
?>