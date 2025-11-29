# Dev Projects WordPress Theme

A dark-themed WordPress theme for showcasing open-source projects with card-based layout and filtering capabilities.

## Features

- **Custom Post Type**: Projects with custom fields for GitHub URL, Demo URL, Technology, and Difficulty
- **Custom Taxonomy**: Project Tags for categorization and filtering
- **Responsive Design**: Mobile-friendly layout that works on all devices
- **Dark Theme**: Modern dark color scheme with blue accent colors
- **Search Functionality**: Advanced search with live filtering
- **Tag Filtering**: Filter projects by tags and difficulty level
- **Widget Ready**: Footer widget areas for additional content
- **SEO Optimized**: Semantic HTML5 structure with proper meta tags
- **Accessibility**: Screen reader support and keyboard navigation

## Installation

1. Download the theme files
2. Upload the `dev-projects` folder to your WordPress installation at `/wp-content/themes/`
3. Activate the theme from the WordPress admin panel under "Appearance > Themes"
4. Configure the theme settings under "Appearance > Customize"

## Theme Structure

```
dev-projects/
├── style.css                    # Main stylesheet with WordPress theme header
├── index.php                    # Homepage template
├── single.php                   # Single project view template
├── archive.php                  # Archive and filtered project views
├── search.php                   # Search results page
├── header.php                    # Site header
├── footer.php                    # Site footer
├── functions.php                 # Theme functionality and custom post types
├── template-parts/               # Reusable template parts
│   ├── content-project.php      # Project card template
│   ├── content-single.php       # Single project content
│   ├── search-form.php         # Search form
│   └── project-filters.php     # Tag/category filters
├── assets/                      # Static assets
│   ├── css/                    # Additional stylesheets
│   └── js/                     # JavaScript files
│       ├── navigation.js          # Mobile menu functionality
│       └── filtering.js           # Project filtering
└── README.md                    # This file
```

## Custom Post Type: Projects

The theme includes a custom post type "Projects" with the following fields:

- **Title**: Project name
- **Content**: Project description and details
- **Featured Image**: Project thumbnail/cover image
- **GitHub URL**: Link to source repository
- **Demo URL**: Link to live demo
- **Technology**: Programming language/framework used
- **Difficulty**: Beginner/Intermediate/Advanced
- **Tags**: Project categories for filtering

## Custom Taxonomy: Project Tags

Projects can be categorized using tags for better organization and filtering. Tags can be managed from the WordPress admin panel.

## Theme Customization

### Colors

The theme uses CSS custom properties that can be customized:

- `--bg-body`: Main background color (default: #09090b)
- `--bg-card`: Card background color (default: #18181b)
- `--text-main`: Main text color (default: #e4e4e7)
- `--text-muted`: Muted text color (default: #a1a1aa)
- `--accent-color`: Accent color (default: #3b82f6)
- `--border-color`: Border color (default: #27272a)

### Logo

Upload a custom logo through the WordPress customizer under "Site Identity".

### Menus

Configure navigation menus under "Appearance > Menus":
- **Primary Menu**: Main navigation in header
- **Footer Menu**: Links in footer area

### Widgets

Add widgets to the footer area under "Appearance > Widgets".

## Usage

### Adding New Projects

1. Go to WordPress Admin > Projects > Add New
2. Fill in the project details
3. Add tags for categorization
4. Set featured image
5. Publish the project

### Managing Projects

Projects can be managed from the WordPress admin panel under "Projects". You can:
- Edit existing projects
- Add new projects
- Manage tags
- View project statistics

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Opera (latest)

## WordPress Compatibility

- WordPress 5.3 or higher
- PHP 7.2 or higher

## License

This theme is licensed under the GNU General Public License v2 or later.

## Support

For support and documentation, please visit [your-support-website].

## Changelog

### Version 1.0.0
- Initial release
- Custom post type for projects
- Custom taxonomy for project tags
- Responsive design
- Search and filtering functionality
- Dark theme with customizable colors