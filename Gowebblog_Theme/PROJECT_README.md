# Toolbox Post Type Usage Guide

This theme now includes a custom post type for "Toolbox" with additional fields for repository and demo URLs, perfect for sharing your personal discoveries on the internet.

## Features

- **Custom Post Type**: "Toolbox" with its own archive and single views
- **Custom Taxonomies**: Toolbox Categories and Toolbox Tags
- **Custom Meta Fields**: Repository URL and Demo URL
- **Template Files**: Dedicated templates for toolbox archives and single toolbox items
- **Helper Functions**: Easy-to-use functions for retrieving toolbox data

## How to Use

### 1. Create Toolbox Items

1. Go to your WordPress admin dashboard
2. Click on "Toolbox" in the left menu
3. Click "Add New" to create a new toolbox item
4. Fill in the title, description, and add a featured image
5. In the "Toolbox URLs" meta box, add:
   - Repository URL (e.g., GitHub, GitLab link)
   - Demo URL (optional - live demo link)
   - How I Use This Tool (detailed description of how you leverage the tool)
6. Assign categories and tags if needed
7. Publish the toolbox item

### 2. Display Toolbox Items

#### Toolbox Archive (Default)
The toolbox items are automatically available at `/toolbox/` URL and use the portfolio layout by default.

#### Portfolio Template
Any page assigned the "Portfolio Template" will display a list of all toolbox items.

#### Individual Toolbox Items
Each toolbox item has its own page at `/toolbox/toolbox-item-name/`.

### 3. Using Helper Functions

You can use these functions in your theme files:

```php
// Get repository URL
$repo_url = gowebblog_get_toolbox_repo_url( $post_id );

// Get demo URL
$demo_url = gowebblog_get_toolbox_demo_url( $post_id );

// Display repository link
gowebblog_the_toolbox_repo_link( $post_id, 'Custom Text', 'custom-class' );

// Display demo link
gowebblog_the_toolbox_demo_link( $post_id, 'Custom Text', 'custom-class' );

// Get all toolbox items
$toolbox_items = gowebblog_get_toolbox_items( array(
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
) );

// Get featured toolbox items
$featured = gowebblog_get_featured_toolbox_items( 3 );
```

### 4. Template Files

- `archive-toolbox.php`: Template for toolbox archive page
- `single-toolbox.php`: Template for individual toolbox item pages
- `template-parts/content-toolbox.php`: Reusable toolbox item card template
- `template-portfolio.php`: Portfolio page template that displays toolbox items

### 5. Styling

Toolbox items use the following CSS classes that you can style:
- `.toolbox-card`: Main toolbox item card container
- `.toolbox-links`: Container for repository and demo links
- `.toolbox-repo-link`: Repository link styling
- `.toolbox-demo-link`: Demo link styling

## Customization

### Adding More Fields

To add more custom fields to toolbox items:

1. Edit the `gowebblog_toolbox_urls_callback()` function in `/inc/post-types.php`
2. Add new input fields to the form table
3. Update the `gowebblog_save_toolbox_urls()` function to save the new fields
4. Create helper functions in `/inc/template-functions.php` to retrieve the new fields

### Modifying Templates

You can customize the toolbox display by editing:
- `archive-toolbox.php` for the archive layout
- `single-toolbox.php` for single toolbox item layout
- `template-parts/content-toolbox.php` for the toolbox item card layout

## URL Structure

- Toolbox Archive: `yoursite.com/toolbox/`
- Single Toolbox Item: `yoursite.com/toolbox/toolbox-item-name/`
- Toolbox Category: `yoursite.com/toolbox-category/category-name/`
- Toolbox Tag: `yoursite.com/toolbox-tag/tag-name/`

## Notes

- The toolbox post type supports featured images
- Toolbox items can be categorized and tagged
- Repository and demo URLs open in new tabs with proper security attributes
- All toolbox templates are responsive and use the theme's design system
- Toolbox items are included in WordPress search results