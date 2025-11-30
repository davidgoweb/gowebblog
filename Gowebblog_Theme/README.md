# Gowebblog Theme

A clean, modern, and performant WordPress blog theme built with Tailwind CSS.

## Features

- Clean, modern design with dark theme
- Built with Tailwind CSS for utility-first styling
- Fully responsive design
- Custom logo support
- Custom menu support
- Featured image support
- Widget-ready sidebar and footer areas
- SEO optimized
- Accessibility ready
- Cross-browser compatible
- Customizer options for colors and layout
- Translation ready

## Installation

1. Download the theme files to your WordPress installation's `wp-content/themes` directory
2. Activate the theme through the WordPress admin dashboard
3. Configure theme options through Appearance > Customize

## Development

### Prerequisites

- Node.js and npm
- WordPress development environment

### Build Process

The theme uses Tailwind CSS with a build process. To develop:

1. Install dependencies:
   ```bash
   npm install
   ```

2. Run development build (watches for changes):
   ```bash
   npm run watch
   ```

3. Run production build (minified CSS):
   ```bash
   npm run build
   ```

### File Structure

```
Gowebblog_Theme/
├── style.css                 # WordPress theme header
├── index.php                 # Blog home page
├── single.php                 # Single blog post
├── page.php                  # Static pages
├── archive.php               # Category/tag archives
├── 404.php                  # Error page
├── header.php                 # Site header
├── footer.php                 # Site footer
├── functions.php              # Theme functions
├── assets/
│   ├── css/
│   │   └── main.css       # Compiled CSS (do not edit directly)
│   └── js/
│       ├── navigation.js     # Navigation functionality
│       └── customizer.js    # Customizer preview
├── src/
│   └── css/
│       └── input.css        # Source CSS (edit this file)
├── inc/
│   ├── template-tags.php      # Custom template tags
│   ├── template-functions.php # Theme helper functions
│   ├── customizer.php      # Customizer settings
│   └── jetpack.php          # Jetpack compatibility
├── template-parts/
│   ├── content-home.php     # Blog post excerpt
│   ├── content-single.php   # Full blog post
│   └── content-none.php     # No content found
├── package.json              # Node dependencies
├── tailwind.config.js         # Tailwind configuration
├── postcss.config.js         # PostCSS configuration
└── .gitignore               # Git ignore rules
```

### Customization

#### Colors

The theme includes a color customizer in Appearance > Customize > Theme Colors. You can modify:

- Primary Color
- Secondary Color  
- Accent Color
- Dark Color
- Darker Color
- Card Color

#### Typography

The theme uses Google Fonts:
- Plus Jakarta Sans (body text)
- Syne (headings)

#### Layout Options

- Sidebar position (left, right, or none)
- Excerpt length
- Header CTA text and link

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

This theme is licensed under GPLv2 or later.

## Credits

- Designed and developed by Davidgoweb
- Built with Tailwind CSS
- WordPress theme framework

## Changelog

### Version 1.00
- Initial release
- Basic WordPress theme functionality
- Tailwind CSS integration
- Responsive design
- Customizer options