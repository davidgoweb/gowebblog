# Footer Quick Links Menu Feature

This feature allows you to customize the "Quick Links" section in the footer using WordPress menus.

## How to Use

### 1. Create a Menu
1. Go to your WordPress Dashboard → Appearance → Menus
2. Click "Create a new menu"
3. Give your menu a name (e.g., "Footer Quick Links")
4. Add menu items (pages, posts, custom links, etc.)
5. Save the menu

### 2. Assign the Menu to Footer Location
1. While editing the menu, go to the "Menu Settings" section at the bottom
2. Check the box for "Footer Quick Links Menu" location
3. Save the menu

### 3. Configure in Customizer
1. Go to Appearance → Customize
2. Navigate to "Footer Options" section
3. Select your created menu from the "Footer Quick Links Menu" dropdown
4. Click "Publish"

## Fallback Behavior

If no menu is selected or if the selected menu is empty, the theme will display the default quick links:
- About
- Services
- Portfolio
- Blog
- Contact

## Technical Implementation

The feature consists of:

1. **Menu Registration**: A new menu location "Footer Quick Links Menu" is registered in `functions.php`

2. **Customizer Settings**: Added a new section "Footer Options" in the customizer with a dropdown to select the footer menu

3. **Footer Display**: The `footer.php` file checks if a menu is selected and displays it using a custom walker class

4. **Custom Walker**: The `Footer_Menu_Walker` class formats the menu items with the appropriate CSS classes

## Files Modified

- `functions.php`: Added menu registration and Footer_Menu_Walker class
- `inc/customizer.php`: Added footer options section and menu selector
- `footer.php`: Updated to use the selected menu or fallback to default links

## Styling

The menu items automatically inherit the same styling as the original quick links:
- Text color: Secondary color with hover state to white
- Font size: Small (text-sm)
- Transition: Smooth color transition
- Spacing: Vertical spacing between items