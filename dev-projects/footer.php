<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-left">
                <h4><?php bloginfo('name'); ?></h4>
                <p style="color:var(--text-muted); max-width:300px;">
                    <?php 
                    $description = get_bloginfo('description');
                    if ($description) {
                        echo esc_html($description);
                    } else {
                        _e('Discovering and showcasing the best open-source projects and hidden gems in the developer community.', 'dev-projects');
                    }
                    ?>
                </p>
            </div>
            <div class="footer-right">
                <h4><?php _e('Legal', 'dev-projects'); ?></h4>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'nav-links',
                        'container'      => false,
                        'fallback_cb'    => 'dev_projects_footer_menu_fallback',
                    )
                );
                ?>
            </div>
        </div>
        
        <?php if (is_active_sidebar('sidebar-1')) : ?>
        <div class="footer-widgets">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </div>
        <?php endif; ?>
        
        <div class="copyright">
            © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Built for the community.', 'dev-projects'); ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * Fallback menu for footer navigation
 */
function dev_projects_footer_menu_fallback() {
    echo '<div class="nav-links" style="flex-direction: column; gap: 10px; margin-top:15px;">';
    
    // Add about page if it exists
    $about_page = get_page_by_path('about');
    if ($about_page) {
        echo '<a href="' . esc_url(get_permalink($about_page->ID)) . '">' . __('About Us', 'dev-projects') . '</a>';
    }
    
    // Add privacy policy page if it exists
    $privacy_page = get_page_by_path('privacy-policy');
    if ($privacy_page) {
        echo '<a href="' . esc_url(get_permalink($privacy_page->ID)) . '">' . __('Privacy Policy', 'dev-projects') . '</a>';
    }
    
    // Add cookie policy page if it exists
    $cookie_page = get_page_by_path('cookie-policy');
    if ($cookie_page) {
        echo '<a href="' . esc_url(get_permalink($cookie_page->ID)) . '">' . __('Cookie Policy', 'dev-projects') . '</a>';
    }
    
    echo '</div>';
}
?>