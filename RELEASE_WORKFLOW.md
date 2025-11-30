# WordPress Theme Auto Release Workflow

This GitHub Actions workflow automatically builds and releases your WordPress theme when you push commits containing "release version" in the commit message.

## Important: Repository Permissions

For this workflow to work properly, ensure that your repository has the correct permissions:

1. Go to your repository on GitHub
2. Click on **Settings** → **Actions** → **General**
3. Under "Workflow permissions", select **Read and write permissions**
4. Check the box for **Allow GitHub Actions to create and approve pull requests**
5. Click **Save**

The workflow file already includes the necessary permissions (`contents: write` and `releases: write`), but the repository settings must allow these permissions.

## How It Works

1. **Trigger**: The workflow triggers on pushes to the main/master branch when the commit message contains "release version"
2. **Build Process**:
   - Sets up Node.js environment
   - Installs npm dependencies
   - Builds the CSS using Tailwind CSS
3. **Version Management**:
   - Extracts version number from commit message (e.g., "release version 1.2.3")
   - If no version is found, uses the current date (e.g., "2023.11.30")
   - Updates version in `style.css` and `package.json`
4. **Release Creation**:
   - Creates a zip file with the theme (excluding development files)
   - Creates a GitHub Release with the version tag
   - Uploads the zip file as a release asset
   - Commits version updates back to the repository

## How to Use

1. Make your changes to the theme
2. Commit with a message containing "release version" and optionally the version number:
   ```
   git commit -m "release version 1.2.3: Fixed navigation bug and improved performance"
   ```
   or simply:
   ```
   git commit -m "release version: Added new feature"
   ```
3. Push to your main/master branch:
   ```
   git push origin main
   ```
4. The workflow will automatically:
   - Build the CSS
   - Create a release with the specified version (or date-based version)
   - Upload the theme zip file to the release

## Release Files

The generated zip file excludes development files and only includes:
- Theme PHP files
- Compiled CSS
- JavaScript files
- Assets
- Required WordPress theme files

## Manual Installation

After the release is created, users can:
1. Download the zip file from the GitHub Releases page
2. In WordPress admin, go to Appearance > Themes > Add New
3. Click "Upload Theme" and select the zip file
4. Activate the theme

## Version Format

The workflow recognizes semantic versioning (e.g., 1.2.3) in commit messages. If no version is specified, it will use the current date in YYYY.MM.DD format.

## Troubleshooting

- Make sure your commit message contains "release version" (case-insensitive)
- Ensure you're pushing to the main or master branch
- Check the Actions tab in GitHub for workflow status and any errors