# Project Post Type Usage Guide

This theme now includes a custom post type for "Projects" with additional fields for repository and demo URLs.

## Features

- **Custom Post Type**: "Project" with its own archive and single views
- **Custom Taxonomies**: Project Categories and Project Tags
- **Custom Meta Fields**: Repository URL and Demo URL
- **Template Files**: Dedicated templates for project archives and single projects
- **Helper Functions**: Easy-to-use functions for retrieving project data

## How to Use

### 1. Create Projects

1. Go to your WordPress admin dashboard
2. Click on "Projects" in the left menu
3. Click "Add New" to create a new project
4. Fill in the title, description, and add a featured image
5. In the "Project URLs" meta box, add:
   - Repository URL (e.g., GitHub, GitLab link)
   - Demo URL (optional - live demo link)
6. Assign categories and tags if needed
7. Publish the project

### 2. Display Projects

#### Portfolio Page
Create a page and assign it the "Portfolio Template" to display all projects.

#### Project Archive
The projects are automatically available at `/project/` URL.

#### Individual Projects
Each project has its own page at `/project/project-name/`.

### 3. Using Helper Functions

You can use these functions in your theme files:

```php
// Get repository URL
$repo_url = gowebblog_get_project_repo_url( $post_id );

// Get demo URL
$demo_url = gowebblog_get_project_demo_url( $post_id );

// Display repository link
gowebblog_the_project_repo_link( $post_id, 'Custom Text', 'custom-class' );

// Display demo link
gowebblog_the_project_demo_link( $post_id, 'Custom Text', 'custom-class' );

// Get all projects
$projects = gowebblog_get_projects( array(
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
) );

// Get featured projects
$featured = gowebblog_get_featured_projects( 3 );
```

### 4. Template Files

- `archive-project.php`: Template for project archive page
- `single-project.php`: Template for individual project pages
- `template-parts/content-project.php`: Reusable project card template
- `template-portfolio.php`: Portfolio page template that displays projects

### 5. Styling

Projects use the following CSS classes that you can style:
- `.project-card`: Main project card container
- `.project-links`: Container for repository and demo links
- `.project-repo-link`: Repository link styling
- `.project-demo-link`: Demo link styling

## Customization

### Adding More Fields

To add more custom fields to projects:

1. Edit the `gowebblog_project_urls_callback()` function in `/inc/post-types.php`
2. Add new input fields to the form table
3. Update the `gowebblog_save_project_urls()` function to save the new fields
4. Create helper functions in `/inc/template-functions.php` to retrieve the new fields

### Modifying Templates

You can customize the project display by editing:
- `archive-project.php` for the archive layout
- `single-project.php` for single project layout
- `template-parts/content-project.php` for the project card layout

## URL Structure

- Project Archive: `yoursite.com/project/`
- Single Project: `yoursite.com.com/project/project-name/`
- Project Category: `yoursite.com/project-category/category-name/`
- Project Tag: `yoursite.com/project-tag/tag-name/`

## Notes

- The project post type supports featured images
- Projects can be categorized and tagged
- Repository and demo URLs open in new tabs with proper security attributes
- All project templates are responsive and use the theme's design system
- Projects are included in WordPress search results